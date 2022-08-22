<?php

namespace functions;

class FunctionValidator
{
    /**
     * @param $arg
     * @return void
     */
    public function isHelloArgumentWrapperException($arg): void
    {
        if (!is_string($arg)  && !is_int($arg)  && !is_bool($arg) ) {
            throw new \InvalidArgumentException("You can: string, integer, boolean");
        }
    }


    /**
     * @param ...$arg
     * @return void
     */
    public function isCountArgumentsWrapperException(...$arg): void
    {
        if (gettype(...$arg) !== 'string') {
            throw new \InvalidArgumentException("You can: string");
        }
    }
}
