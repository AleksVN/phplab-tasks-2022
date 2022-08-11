<?php

namespace strings;

class Strings implements StringsInterface
{

    /**
     * @param string $input
     * @return string
     */
    public function snakeCaseToCamelCase(string $input): string
    {

        return preg_replace_callback('/(_)([a-z])/', function ($matches) {
            return strtoupper($matches[2]);
        }, $input);
    }

    /**
     * @param string $input
     * @return string
     */
    public function mirrorMultibyteString(string $input): string
    {
        $arr1 = explode(' ', $input);
        $arr2 = [];
        foreach ($arr1 as $value) {
            $w = '';
            for ($i = mb_strlen($value); $i >= 0; $i--) {
                $w .= mb_substr($value, $i, 1);
            }
            $arr2[] = $w;
        }

        return implode(' ', $arr2);
    }

    /**
     * @param string $noun
     * @return string
     */
    public function getBrandName(string $noun): string
    {
        if (substr($noun, 0, 1) == substr($noun, -1)) {
            return ucwords($noun) . substr($noun, 1);
        } else {
            return "The " . ucwords($noun);
        }
    }

}
