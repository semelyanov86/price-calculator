<?php

namespace App\Lib;

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
    protected $url;

    public $results = [];

    public $savedItems = 0;

    public $status = 1;

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
        $response = Http::asForm()->post($this->url, [
            'line' => '1',
            'price_lowertooltip' => '50',
            'page' => $page,
            'compare_type' => 'phone',
            'total' => 'n',
            'package_maxgb' => '240',
            'gb_uppertooltip' => '',
            'gb_lowertooltip' => '',
            'price_uppertooltip' => ''
        ]);
        $result = collect([]);
        if ($response->ok()) {
            $data = $response->body();
            $crawler = new Crawler($data);
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

}
