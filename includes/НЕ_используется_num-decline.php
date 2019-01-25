<?php
/**
 * This class inclines words after numbers.
 *
 * Call examples:
 * num_decline ($num, 'book, books, books')
 * num_decline ($num, ['book', 'books', 'books'])
 * num_decline ($num, 'book', 'books', 'books')
 * num_decline ($num, 'book', 'books')
 *
 * @param  int|string    $number The number after which there will be a word. You can specify the number in the HTML tags.
 * @param string | array $titles Declination options or the first word for a multiple of 1.
 * @param string         $param2 The second word, unless specified in the $ titles parameter.
 * @param string         $param3 The third word, unless specified in the $ titles parameter.
 *
 * @return string 1 book, 2 books, 10 books.
 *
 * @since      1.0.0
 * @package    Show_External_Links
 * @subpackage Show_External_Links/includes
 * @author     webaction <web.dev.svb@gmail.com>
 */

class Num_Decline
{
    public static function declination ( $number, $titles, $param2 = '', $param3 = '' ) {

        if ( $param2 ) {
            $titles = [ $titles, $param2, $param3 ];
        }

        if ( is_string( $titles ) ) {
            $titles = preg_split( '/, */', $titles );
        }

        if ( empty( $titles[2] ) ) {
            $titles[2] = $titles[1];
        }

        $cases = [ 2, 0, 1, 1, 1, 2 ];

        $int_num = abs( intval( strip_tags( $number ) ) );

        return "$number " . $titles[ ( $int_num % 100 > 4 && $int_num % 100 < 20 ) ? 2 : $cases[ min( $int_num % 10, 5 ) ] ];
    }
}