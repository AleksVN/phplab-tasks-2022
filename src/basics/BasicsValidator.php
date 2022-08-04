<?php

namespace basics;

class BasicsValidator implements BasicsValidatorInterface
{

    /**
     * @param int $minute
     * @return void
     */
    public function isMinutesException(int $minute): void
    {
        if ($minute > 60 or $minute < 0) {
            throw new \InvalidArgumentException('Хвилини повинні бути від 0 до 59');
        }
    }

    /**
     * @param int $year
     * @return void
     */
    public function isYearException(int $year): void
    {
        if ($year < 1900) {
            throw new \InvalidArgumentException('Рік повинени бути від 1900');
        }
    }

    /**
     * @param string $input
     * @return void
     */
    public function isValidStringException(string $input): void
    {
        if (strlen($input) !== 6) {
            throw new \InvalidArgumentException('Кількість символів у строці повинна дорівнювати 6');
        }
    }

}
