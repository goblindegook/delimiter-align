<?php

namespace goblindegook\Tests;

/**
 * Test the delimiterAlign function.
 */
class DelimiterAlignTest extends \PHPUnit_Framework_TestCase {

    /**
     * @dataProvider fixture_provider
     */
    public function test_delimiter_align( $file, $separator, $options )
    {
        $fixture = file_get_contents( __DIR__ . '/fixtures/' . $file );

        list( $string, $expected ) = explode( "----\n", $fixture );

        $actual = \goblindegook\delimiter_align( $string, $separator, $options );

        $this->assertEquals( $expected, $actual, $file );
    }

    public function fixture_provider()
    {
        return array(
            array( 'basic.txt',     ':',   null ),
            array( 'messy.txt',     ':',   null ),
            array( 'indents.txt',   ':',   null ),
            array( 'delimiter.txt', '-->', null ),
            array( 'before.txt',    ':',   array( 'before' => ' ' ) ),
            array( 'after.txt',     ':',   array( 'after' => '    ' ) ),
            array( 'right.txt',     ':',   array( 'right' => true ) ),
            array( 'pad.txt',       '.',   array( 'before' => ' ', 'pad' => '.' ) ),
            array( 'options.txt',   '=',   array( 'before' => ' ', 'right' => true ) ),
        );
    }

}
