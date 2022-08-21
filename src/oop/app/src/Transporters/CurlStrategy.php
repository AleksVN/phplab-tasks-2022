<?php
/**
 * getContent() - should return site page content.
 * For Class CurlStrategy use simple СURL PHP Library for getting the page content.
 * Note: Use next namespace for CurlStrategy Class - "namespace src\oop\app\src\Transporters;" (Like in this Interface)
 * Note: About СURL PHP you can read here:
 * https://www.php.net/manual/ru/book.curl.php
 * Attention: Think about why this Transporter might have a Strategy word in name!!!
 */

namespace src\oop\app\src\Transporters;

use Exception;
use src\oop\app\src\Helper\Encoder;

class CurlStrategy implements TransportInterface
{
    /**
     * @param string $url
     * @return string
     * @throws Exception
     */
    public function getContent(string $url): string
    {
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HEADER => false,
            )
        );
        $content = curl_exec($ch);
        curl_close($ch);

        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) === 429) {
            throw new Exception('StatusCode: 429. You need to make request later (runnig curl)');
        }

        $encoder = new Encoder();
        $contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

        return $encoder->contentEncode($content, $contentType);
    }
}
