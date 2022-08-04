<?php

namespace basics;

class Basics implements BasicsInterface
{

    /**
     * @var BasicsValidator
     */
    private BasicsValidator $validator;


    /**
     * @param BasicsValidator $validator
     */
    public function __construct(BasicsValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param int $minute
     * @return string
     * @throws \InvalidArgumentException
     */
    public function getMinuteQuarter(int $minute): string
    {
        $this->validator->isMinutesException($minute);

//        if ($minute <= 15) {
//            return 'first';
//        } elseif ($minute > 15 and $minute <= 30) {
//            return 'second';
//        } elseif ($minute > 30 and $minute <= 45) {
//            return 'third';
//        } elseif ($minute > 45 and $minute < 60) {
//            return 'fourth';
//        }

//        switch (true) {
//            case  ($minute <= 15 and $minute !== 0):
//                $result = "first";
//                break;
//            case  ($minute > 15 and $minute <= 30):
//                $result = 'second';
//                break;
//            case  ($minute > 30 and $minute <= 45):
//                $result = 'third';
//                break;
//            case  ($minute > 45 and $minute < 60):
//                $result = 'fourth';
//                break;
//            default:
//                $result = 'fourth';
//        }
//
//        return $result;

        $result = match (true) {
            $minute <= 15 and $minute !== 0 => "first",
            $minute > 15 and $minute <= 30 => 'second',
            $minute > 30 and $minute <= 45 => 'third',
            default => 'fourth',
        };

        return $result;

    }

    /**
     * @param int $year
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function isLeapYear(int $year): bool
    {
        $this->validator->isYearException($year);

        if ($year % 100 === 0 and $year % 400 !== 0) {
            return false;
        } elseif ($year % 4 === 0) {
            return true;
        } else {
            return false;
        }

    }

    /**
     * @param string $input
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function isSumEqual(string $input): bool
    {
        $this->validator->isValidStringException($input);

        $arr = str_split($input);

        if (($arr[0] + $arr[1] + $arr[2]) === ($arr[3] + $arr[4] + $arr[5])) {
            return true;
        } else {
            return false;
        }
    }
}
