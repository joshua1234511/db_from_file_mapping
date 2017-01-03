<?php
class functions {
    static function valueCheck($x){
    	$x = ($x == '- ' ? 0 : $x);
    	$x = ($x == '' ? 0 : $x);
    	return $x;
    }
    static function valueCheckDate($x){
    	$x = ($x == '- ' ? date("Y-m-d") : $x);
    	$x = ($x == '' ? date("Y-m-d") : $x);
    	return $x;
    }
    static function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    static function random_color($color_array) {
        $color = functions::random_color_part() . functions::random_color_part() . functions::random_color_part();;
        if(in_array($color, $color_array)){
            return random_color($color_array);
        }
        else{
            return $color;
        }
    }
}