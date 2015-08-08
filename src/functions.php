<?php

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
 * @param  string $subject   Multiline string to align.
 * @param  string $delimiter Delimiter to align the string around.
 * @param  array  $options   Alignment options.
 *                           * before: Prepended to the padded delimiter
 *                                     (defaults to empty).
 *                           * after:  Appended to the padded delimiter
 *                                     (defaults to ' ').
 *                           * pad:    Padding character (defaults to ' ').
 *                           * right:  Right-align the delimiter (defaults to
 *                                     false).
 * @return string            Aligned multiline string.
 */
function delimiterAlign($subject, $delimiter = ':', $options = array()) {
    $before = isset($options['before']) ? $options['before'] : '';
    $after  = isset($options['after'])  ? $options['after']  : ' ';
    $pad    = isset($options['pad'])    ? $options['pad']    : ' ';
    $right  = !empty($options['right']);

    $position = 0;

    $lines = explode(PHP_EOL, $subject);

    foreach ($lines as &$line) {
        $line = explode($delimiter, $line, 2);

        if (count($line) < 2) {
            continue;
        }

        $line[0]  = rtrim($line[0]);
        $line[1]  = ltrim($line[1]);
        $position = max($position, strlen($line[0]));
    }

    foreach ($lines as &$line) {
        $padding         = str_pad('', $position - strlen($line[0]), $pad);
        $paddedDelimiter = $right ? $padding . $delimiter : $delimiter . $padding;
        $line            = implode($before . $paddedDelimiter . $after, $line);
    }

    $alignedSubject = implode(PHP_EOL, $lines);

    return $alignedSubject;
}
