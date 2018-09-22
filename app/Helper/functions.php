<?php
/**
 * Created by PhpStorm.
 * User: Abby
 * Date: 2018/9/20
 * Time: 16:26
 */

function object_array($array) {
    if(is_object($array)) {
        $array = (array)$array;
    } if(is_array($array)) {
        foreach($array as $key=>$value) {
            $array[$key] = object_array($value);
        }
    }
    return $array;
}
