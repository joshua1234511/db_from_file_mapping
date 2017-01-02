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
}