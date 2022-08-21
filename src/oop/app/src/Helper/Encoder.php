<?php

namespace src\oop\app\src\Helper;

class Encoder
{
    public function contentEncode(string $content, string $contentType) : string
    {
        preg_match('#charset=(.+)#', $contentType, $matches);

        if (mb_strtolower($matches[1]) !== 'utf-8') {
            return iconv($matches[1], mb_detect_encoding($content), $content);
        }

        return $content;
    }
}
