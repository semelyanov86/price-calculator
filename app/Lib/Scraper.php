<?php

namespace App\Lib;

use App\ScanDataCellular;
use App\ScanQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

/**
 * Class Scraper
 *
 * handles and process scraping using specific link
 * first we work on the main filter expression which is the
 * the container of the items, then using annonymous callback
 * on the filter function we iterate and save the results
 * into the article table
 *
 * @package App\Lib
 */
class Scraper
{
    const ITEMS_PER_PAGE = 10;

    protected $url;

    public $results = [];

    public $savedItems = 0;

    public $status = 1;

    protected $type = 'phone';

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function handle()
    {
        $page = 1;
        $nodes = collect([]);
        $newNodes = $this->fetchFullContent($page);
        while ($newNodes->isNotEmpty()) {
            $nodes = $nodes->merge($newNodes);
            $page++;
            $newNodes = $this->fetchFullContent($page);
            echo $page . '/n';
        }
        file_put_contents(config('filesystems.disks.local.root') . '/dump.txt', print_r($nodes, true));
    }

    /*
     * schedule
     *
     * This method receive total number of items and calculates pages. Through this  number of pages we create cron tasks.
     */
    public function schedule($type = 'phone')
    {
        $this->type = $type;
        $page = 1;
        $crawler = $this->getCrawler($page);
        if ($crawler) {
            $items = $this->getTotalItems($crawler);
        } else {
            $items = 0;
        }
        $pages = $this->calcPages($items);
        if ($pages > 0) {
            for ($i = 1; $i <= $pages; $i++) {
                $this->createSchedule($i);
            }
        }
    }

    public function initQueue(ScanQueue $scanModel)
    {
        $params = json_decode($scanModel->scan_parameters, true);
        $crawler = $this->getCrawler(0, $params, $scanModel->proxy);
        if ($crawler) {
            $data = $this->getFullModel($crawler);
            if ($data->isNotEmpty()) {
                $data->each(function($item) {
                    $scanModel = $this->createModel($item);
                });
            }
            $scanModel->scan_finished = 1;
            $scanModel->scan_datetime = Carbon::now()->format('Y-m-d H:i:s');
            $scanModel->save();
        } else {
            $scanModel->response_code = 500;
            $scanModel->response_html = 'No response';
            $scanModel->save();
        }
    }

    protected function createModel(Collection $item) : ?ScanDataCellular
    {
        if ($item->isNotEmpty()) {
            $id = $item->get('parser');
            if ($id) {
                $scanDataModel = ScanDataCellular::where('parser', $id)->first();
                if ($scanDataModel) {
                    $html = $item->get('html');
                    if ($html !== $scanDataModel->html) {
                        $item->push(['html_changed' => $html]);
                        $item->push(['html_changed_datetime' => Carbon::now()->format('Y-m-d H:i:s')]);
                    }
                    $scanDataModel->update($item->toArray());
                    return $scanDataModel;
                } else {
                    return ScanDataCellular::create($item->toArray());
                }
            }
        }
    }

    protected function getFullModel(Crawler $crawler) : Collection
    {
        $result = collect([]);
        $datas = $crawler->filter('.package')->each(function (Crawler $package, $i) use ($result) {
            $simPrice = $this->getPackageSimPrice($package);
            $idCollect = $package->filter('.share-btn');
            if ($idCollect->count() > 0) {
                $id = $idCollect->first()->attr('data-target');
            } else {
                $id = null;
            }
            $titleCollect = $package->filter('.package_title');
            if ($titleCollect->count() > 0) {
                $title = $titleCollect->first()->text();
            } else {
                $title = null;
            }
            $companyCollect = $package->filter('input[name="company-name"]');
            if ($companyCollect->count() > 0) {
                $companyName = $companyCollect->attr('value');
            } else {
                $companyName = null;
            }
            $packagePriceCollect = $package->filter('input[name="package-price"]');
            if ($packagePriceCollect->count() > 0) {
                $packagePrice = $packagePriceCollect->attr('value');
            } else {
                $packagePrice = null;
            }
            $gbCollect = $package->filter('.item-cluster')->first()->filter('.logo1');
            if ($gbCollect->count() > 0) {
                $gb = $gbCollect->text();
            } else {
                $gb = null;
            }
            $minutesCollection = $package->filter('.item-cluster')->first()->filter('.logo2');
            if ($minutesCollection->count() > 0) {
                $minutes = $minutesCollection->text();
            } else {
                $minutes = null;
            }
            $smsCollection = $package->filter('.item-cluster')->first()->filter('.logo3');
            if ($smsCollection->count() > 0) {
                $sms = $smsCollection->text();
            } else {
                $sms = null;
            }
            $simCollection = $package->filter('.item-cluster')->first()->filter('.logo4');
            if ($simCollection->count() > 0) {
                $sim = $simCollection->text();
            } else {
                $sim = null;
            }

            $result->push(collect([
                'parser' => $this->parseId(trim($id)),
                'package_name' => trim($title),
                'html' => $package->html(),
                'provider_name' => $companyName,
                'package_gb' => $gb,
                'package_minutes' => $minutes,
                'package_sms' => $sms,
                'package_sim_price' => $sim,
                'package_month_price' => $packagePrice,
                'date' => Carbon::now()->format('Y-m-d'),
                'package_sim_connection_price' => $simPrice
            ]));

        });
        return $result;
    }

    protected function getPackageSimPrice(Crawler $package) : string
    {
        $pResults = $package->filter('.inner_con_tent_in')->filter('p');
        if ($pResults->count() > 0) {
            $htmlRes = $pResults->first()->html();
            $result = collect(explode('<br>', $htmlRes))->filter(function ($value) {
                if (strpos(trim($value), '<b>SIM') !== false) {
                    return true;
                } else {
                    return false;
                }
            })->first();
            $resultArr = explode('</b>', trim($result));
            if (isset($resultArr[1])) {
                return trim($resultArr[1]);
            } else {
                return '';
            }
        } else {
            return '';
        }

    }

    protected function parseId(string $strId) : int
    {
        $idArr = explode('-', $strId);
        return (int) $idArr[1];
    }

    private function calcPages(int $items) : int
    {
        $result = (int) ceil($items / self::ITEMS_PER_PAGE);
        return $result;
    }

    private function getTotalItems(Crawler $crawler) : int
    {
        $items = $crawler->filter('#submit_button_package_total_number')->attr('value');
        return (int) $items;
    }

    private function getCrawler(int $page = 1, array $params = array(), $proxy = false) : ?Crawler
    {
        if (empty($params)) {
            $params = [
//            'line' => '1',
//            'price_lowertooltip' => '50',
                'page' => $page,
                'compare_type' => $this->type,
//            'total' => 'n',
//            'package_maxgb' => '240',
//            'gb_uppertooltip' => '',
//            'gb_lowertooltip' => '',
//            'price_uppertooltip' => ''
            ];
        }
        $options = array();
        if ($proxy) {
            $options['proxy'] = $proxy->proxy_ip . ':' . $proxy->port;
        }
        $response = Http::asForm()->withOptions($options)->post($this->url, $params);
        if ($response->ok()) {
            $data = $response->body();
            $crawler = new Crawler($data);
            return $crawler;
        } else {
            Log::error("Get server error during parser: " . $response->status());
        }
        return null;
    }


    /**
     * fetchFullContent
     *
     * this method pulls the full content of a single item using the
     * item url and selector
     *
     * @param $item_url
     * @param $selector
     * @return Collection
     */
    protected function fetchFullContent(int $page = 1, $selector = '.package') : Collection
    {
        $crawler = $this->getCrawler($page);
        $result = collect([]);
        if ($crawler) {
            $packagesData = $crawler->filter($selector);

            $nodes = $packagesData->each(function (Crawler $node, $i) use (&$result) {
                $result->push($node->html());
            });
        }
        return $result;
    }

    protected function save($data)
    {
        foreach ($data['title'] as $k => $val) {

            $checkExist = Article::where('source_link', $data['source_link'][$k])->first();

            if(!isset($checkExist->id)) {

                $article = new Article();

                $article->title = $val;

                $article->excerpt = isset($data['excerpt'][$k]) ? $data['excerpt'][$k] : "";

                $article->content = isset($data['content'][$k]) ? $data['content'][$k] : "";

                $article->image = isset($data['image'][$k]) ? $data['image'][$k] : "";

                $article->source_link = $data['source_link'][$k];

                $article->category_id = $data['category_id'][$k];

                $article->website_id = $data['website_id'][$k];

                $article->save();

                $this->savedItems++;
            }
        }
    }

    protected function getPayload(int $page) : array
    {
        return array(
            'page' => $page,
            'compare_type' => $this->type
        );
    }

    protected function createSchedule(int $i) : ScanQueue
    {
        $schedule = new ScanQueue();
        $schedule->scan_url = $this->url;
        $schedule->type = $this->type;
        $schedule->scan_parameters = json_encode($this->getPayload($i));
        $schedule->scan_datetime = Carbon::now();
        $schedule->scan_finished = 0;
        $schedule->tries = 0;
        $schedule->save();
        return $schedule;
    }

}
