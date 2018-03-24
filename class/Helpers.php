<?php

class Helper
{

    public static function get_icon($value)
    {
        return $value ? '<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>' : '<i class="fa fa-times fa-2x" aria-hidden="true"></i>';
    }

    public static function get_text($value, $text)
    {
        return $value == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' . $text : '<i class="fa fa-times" aria-hidden="true"></i><s>' . $text . "</s>";
    }

    public static function get_bg($value)
    {
        return $value ? "text-success-2" : "text-danger-2";
    }

    public static function get_mobile_icon($m)
    {
        if ($m == 'ios')
            return '<i class="fa fa-apple fa-2x apple-grey" aria-hidden="true"></i>';
        if ($m == 'android')
            return '<i class="fa fa-android fa-2x android-green" aria-hidden="true"></i>';
        if ($m == 'windows')
            return '<i class="fa fa-windows fa-2x windows-purple" aria-hidden="true"></i>';
        return '';
    }

    public static function cmp($a, $b)
    {
        if ($a->mean == $b->mean) {
            return 0;
        }
        return ($a->mean < $b->mean) ? -1 : 1;
    }

}

?>
