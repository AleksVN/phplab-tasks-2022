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

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->function->sayHello());
    }

    public function positiveDataProvider(): array
    {
        return [
            ['Hello', 'Hello']
        ];

    }

}

