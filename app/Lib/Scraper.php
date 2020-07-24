<?php

namespace App\Lib;

use App\ScanQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
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

    private function getCrawler(int $page = 1) : ?Crawler
    {
        $response = Http::asForm()->post($this->url, [
//            'line' => '1',
//            'price_lowertooltip' => '50',
            'page' => $page,
            'compare_type' => $this->type,
//            'total' => 'n',
//            'package_maxgb' => '240',
//            'gb_uppertooltip' => '',
//            'gb_lowertooltip' => '',
//            'price_uppertooltip' => ''
        ]);
        if ($response->ok()) {
            $data = $response->body();
            $crawler = new Crawler($data);
            return $crawler;
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
                $result->push($node->text());
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
        $schedule->save();
        return $schedule;
    }

}
