<?php
/**
 * @project blue-dashboard
 * @author  Im A Feature
 * @email   im.not.a.bug.173@gmail.com
 * @date    12/3/2023
 * @time    9:29 PM
 **/

namespace app\helpers;

/**
 * String helper.
 */
class StringHelper
{

    /**
     * This function is used to truncate any long text.
     *
     * @param  string  $string
     * @param  int  $charsCount
     *
     * @return string
     */
    public static function textTruncate(string $string, int $charsCount = 50): string
    {
        $croppedText = substr($string, 0, $charsCount);

        return strlen($string) > $charsCount ? $croppedText.'...' : $string;
    }

    /**
     * This function is used to create SEO slug.
     *
     * @param  string  $convert
     * @param  string  $char
     *
     * @return string
     */
    public static function createSlug(string $convert, string $char = '-'): string
    {
        $vietnameseChar  = "à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ|è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ|ì|í|ị|ỉ|ĩ|ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ|ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ|ỳ|ý|ỵ|ỷ|ỹ|đ|À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ|È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ|Ì|Í|Ị|Ỉ|Ĩ|Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ|Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ|Ỳ|Ý|Ỵ|Ỷ|Ỹ|Đ";
        $unicodeChar     = "a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|a|e|e|e|e|e|e|e|e|e|e|e|i|i|i|i|i|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|o|u|u|u|u|u|u|u|u|u|u|u|y|y|y|y|y|d|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|A|E|E|E|E|E|E|E|E|E|E|E|I|I|I|I|I|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|O|U|U|U|U|U|U|U|U|U|U|U|Y|Y|Y|Y|Y|D";
        $vietnameseChars = explode("|", $vietnameseChar);
        $unicodeChars    = explode("|", $unicodeChar);
        $string          = strtolower(str_replace($vietnameseChars, $unicodeChars, $convert));
        $string          = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $string);

        return preg_replace("/[\/_|+ -]+/", $char, $string);
    }
}
