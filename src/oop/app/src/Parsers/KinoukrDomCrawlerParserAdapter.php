<?php
/**
 * Implement the ParserInterface and following methods:
 * parseContent() - should return Movie object with following properties: $title, $poster, $description.
 * For Class KinoukrDomCrawlerParserAdapter use Symfony DomCrawler Component for parsing page content.
 */

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;
use Symfony\Component\DomCrawler\Crawler;

class KinoukrDomCrawlerParserAdapter implements ParserInterface
{
    /**
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        $crawler = new Crawler($siteContent);
        $movie = new Movie();
        $movie->setTitle($crawler->filter('h1')->text());
        $movie->setPoster($crawler->filter('.fposter a')->link()->getUri());
        $movie->setDescription($crawler->filter('#fdesc')->text());

        return $movie;

    }


}
