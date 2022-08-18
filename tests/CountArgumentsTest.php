<?php

use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
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
        $this->assertEquals($expected, $this->function->countArguments(...$input));

    }

    public function positiveDataProvider(): array
    {
        return
            [
                [
                    ['one string'],
                    [
                        'argument_count' => 1,
                        'argument_values' => ['one string']
                    ],

                ],
                [
                    [],
                    [
                        'argument_count' => 0,
                        'argument_values' => []
                    ],

                ],
                [
                    ['string1', 'string2', 'string3'],
                    [
                        'argument_count' => 3,
                        'argument_values' => ['string1', 'string2', 'string3']
                    ],

                ],
            ];
    }
}
