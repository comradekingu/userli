<?php

namespace App\Tests\Form\DataTransformer;

use App\Form\DataTransformer\TextToEmailTransformer;
use PHPUnit\Framework\TestCase;

class TextToEmailTransformerTest extends TestCase
{
    const DOMAIN = "systemli.org";

    /**
     * @dataProvider transformProvider
     */
    public function testTransform($input, $expected)
    {
        $this->assertEquals($expected, $this->getTransformer()->transform($input));
    }

    public function transformProvider()
    {
        return array(
            array("", ""),
            array(null, ""),
            array("louis@systemli.org", "louis")
        );
    }

    /**
     * @dataProvider reverseTransformProvider
     */
    public function testReverseTransform($input, $expected)
    {
        $this->assertEquals($expected, $this->getTransformer()->reverseTransform($input));
    }

    public function reverseTransformProvider()
    {
        return array(
            array("", ""),
            array(null, ""),
            array("louis", "louis@systemli.org")
        );
    }

    /**
     * @return TextToEmailTransformer
     */
    private function getTransformer()
    {
        return new TextToEmailTransformer(self::DOMAIN);
    }
}