<?php

namespace App\Helpers;

class Helper
{

    //find the number range in an array
    public static function searchRange($nums, $target)
    {
        $res = [];
        for ($j = 0; $j < count($nums); $j++) {
            if ($nums[$j] == $target)
                $res[] = $j;
        }
        if (!count($res)) $res = [-1, -1];
        return $res;
    }

    // remove duplicate numbers from an array
    public static function removeDuplicate($array)
    {

        $result = [];
        for ($i = 0; $i < count($array); $i++) {

            if (in_array($array[$i], $result) == false) {
                
                $result[] = $array[$i];
            }
          
        }
        return $result;
    }

    //move zeros at the last of array
    public static function moveZero($array){
        
        $zeros = [];
        $result = [];
        for($i = 0; $i < count($array); $i++){
            if($array[$i] == 0){
                $zeros[] = $array[$i];
            }
            if($array[$i] != 0){
                $result[] = $array[$i];
            }
        }
        return array_merge($result, $zeros);

    }
}