<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    protected $functionValidator;
    protected $function;

    protected function setUp(): void
    {
        $this->functionValidator = new functions\FunctionValidator();
        $this->function = new functions\Functions($this->functionValidator);
    }

    public function testNegative()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->function->countArgumentsWrapper([1,2,3]);
    }

}
