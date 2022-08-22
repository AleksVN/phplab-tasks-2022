<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    protected $functionValidator;
    protected $function;

    protected function setUp(): void
    {
        $this->functionValidator = new functions\FunctionValidator();
        $this->function = new functions\Functions($this->functionValidator);
    }

    public function testPositive()
    {
        $this->assertEquals('Hello', $this->function->sayHello());
    }

}

