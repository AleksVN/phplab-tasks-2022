<?php
/**
 * Implement the ParserInterface and following methods:
 * parseContent() - should return Movie object with following properties:
 * $title, $poster, $description.
 * For Class FilmixParserStrategy use simple PHP methods without any library for parsing page content.
 * Note: Use next namespace for FilmixParserStrategy Class - "namespace src\oop\app\src\Parsers;" (Like in this Interface)
 * Note: For this Parser (for example) you can user regular expression.
 * Attention: Think about why this Parser might have a Strategy word in name!!!
 */

namespace src\oop\app\src\Parsers;

use src\oop\app\src\Models\Movie;

class FilmixParserStrategy implements ParserInterface
{
    /**
     * @param string $siteContent
     * @return Movie
     */
    public function parseContent(string $siteContent): Movie
    {
        $movie = new Movie();

        preg_match('#<h1.*?>(.*?)</h1>#ius', $siteContent, $matches);
        $movie->setTitle($matches[1]);

        preg_match('#<a\sclass="fancybox".+?href="(.+?)"#ius', $siteContent, $matches);
        $movie->setPoster($matches[1]);

        preg_match('#<div\sclass="full-story">(.+?)</div>#iu', $siteContent, $matches);
        $movie->setDescription($matches[1]);

        return $movie;
    }
}

