<?php
/**
 * getContent() - should return site page content.
 *
 * For Class GuzzleAdapter use GuzzleHttp Client for getting the page content. !!!! biblioteku
 * Note: Use next namespace for GuzzleAdapter Class - "namespace src\oop\app\src\Transporters;" (Like in this Interface)
 * Note: About GuzzleHttp Client you can read here:
 * https://docs.guzzlephp.org/en/stable/
 * Attention: Think about why this Transporter might have a Adapter word in name!!!
 *
 */

namespace src\oop\app\src\Transporters;

use Exception;
use GuzzleHttp\Client;
use src\oop\app\src\Helper\Encoder;

class GuzzleAdapter implements TransportInterface
{
    /**
     * @param string $url
     * @return string
     */
    public function getContent(string $url): string
    {
        $client = new Client();

        try {
            $response =  $client->get($url);
        } catch (Exception $e){
            echo 'You need to make request later (running Guzzle). Origin message: ' . $e->getMessage();
            exit();
        }

        $content = $response->getBody()->getContents();

        $encoder = new Encoder();
        $contentType = $response->getHeader('content-type')[0];

        return $encoder->contentEncode($content, $contentType);
    }
}
