<?php
/**
 * Declares the delimiter_align() function.
 *
 * @package DelimiterAlign
 * @author  Luís Rodrigues <hello@goblindegook.net>
 * @license GPL 2.0+
 * @link    https://github.com/goblindegook/delimiter-align
 */

namespace goblindegook;

/**
 * Aligns and rebalances multiline strings around a delimiter.
 *
 * It turns this:
 *
 *     one: 1
 *     two: 2
 *     three: 3
 *
 * into this:
 *
 *     one:   1
 *     two:   2
 *     three: 3
 *
 * @param string $string    Multiline string to align.
 * @param string $delimiter Boundary string to align around (defaults to `:`).
 * @param array  $options   Alignment options.
 *                          * before: Prepended to the padded delimiter
 *                                    (defaults to empty).
 *                          * after:  Appended to the padded delimiter
 *                                    (defaults to ' ').
 *                          * pad:    Padding character (defaults to ' ').
 *                          * right:  Right-align the delimiter (defaults to
 *                                    false).
 *
 * @return string           Aligned multiline string.
 */
function delimiter_align( $string, $delimiter = ':', $options = array() )
{
    $before = isset( $options['before'] ) ? $options['before'] : '';
    $after  = isset( $options['after'] )  ? $options['after']  : ' ';
    $pad    = isset( $options['pad'] )    ? $options['pad']    : ' ';
    $right  = !empty( $options['right'] );

    $position = 0;

    $lines = explode( PHP_EOL, $string );

    foreach ( $lines as &$line ) {
        $line = explode( $delimiter, $line, 2 );

        if ( count( $line ) > 1 ) {
            $line[0]  = rtrim( $line[0] );
            $line[1]  = ltrim( $line[1] );
            $position = max( $position, strlen( $line[0] ) );
        }
    }

    foreach ( $lines as &$line ) {
        $padding          = str_pad( '', $position - strlen( $line[0] ), $pad );
        $padded_delimiter = $right ? $padding . $delimiter : $delimiter . $padding;
        $line             = implode( $before . $padded_delimiter . $after, $line );
    }

    $aligned_string = implode( PHP_EOL, $lines );

    return $aligned_string;
}
