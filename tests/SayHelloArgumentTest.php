<?php

use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    protected $functionValidator;
    protected $function;

    protected function setUp(): void
    {
        $this->functionValidator = new functions\FunctionValidator();
        $this->function = new functions\Functions( $this->functionValidator);
    }

    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, $this->function->sayHelloArgument($input));
    }

    public function positiveDataProvider(): array
    {
        return [
            ['Vasya', 'Hello Vasya'],
            [8, 'Hello 8'],
            [true, 'Hello 1'],
        ];

    }
}
