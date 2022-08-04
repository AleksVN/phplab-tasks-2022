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
        $arr1 = explode('_', $input);
        $arr2 = [];
        foreach ($arr1 as $value) {
            $arr2[] = ucfirst($value);
        }
        $arr2[0] = lcfirst($arr2[0]);

        return implode($arr2);
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
        $arr = str_split($noun);
        $len = mb_strlen($noun);

        if ($arr[0] == $arr[$len - 1]) {
            $str = '';
            for ($i = 1; $i < $len - 1; $i++) {
                $str .= $arr[$i];
            }

            return ucfirst($arr[0]) . $str . $arr[$len - 1] . $str . $arr[$len - 1];

        } else {
            $str = '';
            for ($i = 1; $i < $len; $i++) {
                $str .= $arr[$i];
            }

            return 'The ' . ucfirst($arr[0]) . $str;
        }

    }

}
