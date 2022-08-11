<?php

namespace arrays;

class Arrays implements ArraysInterface
{

    public function repeatArrayValues(array $input): array
    {
        if ($input == []) {
            return [];
        } else {
            $arr = [];
            foreach ($input as $value) {
                for ($i = 1; $i <= $value; $i++) {
                    $arr[] = $value;
                }
            }

            return $arr;
        }
    }

    public function getUniqueValue(array $input): int
    {

        if (empty($input)) {
            return 0;
        } else {
            $arr = array_count_values($input);
            if (array_search(1, $arr)) {
                return array_search(1, $arr);
            } else {
                return 0;
            }
        }
    }

    public function groupByTag(array $array): array
    {
        $arrRes = [];

        foreach ($array as $valueArr) {
            foreach ($valueArr['tags'] as $tag) {
                do {
                    $arrRes[$tag][] = $valueArr['name'];
                } while (!isset ($arrRes[$tag]));
                sort($arrRes[$tag]);
            }
        }
        ksort($arrRes);

        return $arrRes;
    }

}
