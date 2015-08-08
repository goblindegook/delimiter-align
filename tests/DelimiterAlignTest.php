<?php

namespace goblindegook\Tests;

/**
 * Test the delimiterAlign function.
 */
class DelimiterAlignTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider fixtureProvider
     */
    public function testDelimiterAlign($file, $separator, $options) {
        $fixture = file_get_contents(__DIR__ . '/fixtures/' . $file);

        list($subject, $expected) = explode("----\n", $fixture);

        $actual = \goblindegook\delimiterAlign($subject, $separator, $options);

        $this->assertEquals($expected, $actual, $file);
    }

    public function fixtureProvider() {
        return array(
            array('basic.txt',     ':',   null),
            array('messy.txt',     ':',   null),
            array('indents.txt',   ':',   null),
            array('delimiter.txt', '-->', null),
            array('before.txt',    ':',   array('before' => ' ')),
            array('after.txt',     ':',   array('after' => '    ')),
            array('right.txt',     ':',   array('right' => true)),
            array('pad.txt',       '.',   array('before' => ' ', 'pad' => '.')),
            array('options.txt',   '=',   array('before' => ' ', 'right' => true)),
        );
    }

}
