<?php
/**
 * Create Class - Scrapper with method getMovie().
 * getMovie() - should return Movie Class object.
 *
 * Note: Use next namespace for Scrapper Class - "namespace src\oop\app\src;"
 * Note: Dont forget to create variables for TransportInterface and ParserInterface objects.
 * Note: Also you can add your methods if needed.
 */

namespace src\oop\app\src;

use PHPUnit\Util\Exception;
use src\oop\app\src\Models\Movie;
use src\oop\app\src\Parsers\ParserInterface;
use src\oop\app\src\Transporters\TransportInterface;

class Scrapper
{
    /**
     * @var TransportInterface
     */
    private TransportInterface $transporter;

    /**
     * @var ParserInterface
     */
    private ParserInterface $parser;

    /**
     * @param TransportInterface $transporter
     * @param ParserInterface $parser
     */
    public function __construct(TransportInterface $transporter, ParserInterface $parser)
    {
        $this->transporter = $transporter;
        $this->parser = $parser;
    }

    /**
     * @param $url
     * @return Movie
     */
    public function getMovie($url): Movie
    {
        try {
            $siteContent = $this->transporter->getContent($url);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }

        $objMovie = $this->parser->parseContent($siteContent);

        return $objMovie;
    }
}
