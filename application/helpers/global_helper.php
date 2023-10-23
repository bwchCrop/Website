<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('coe_url')) {
    function coe_url($coe)
    {
        $url = '/coe/';
        $slug = $coe['slug'];

        return $url . $slug;
    }
}

if (! function_exists('day_maker')) {
    function day_maker($day)
    {

        $dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        return $dowMap[$day];
    }
}

if (! function_exists('time_maker')) {
    function time_maker($hour, $minute)
    {
        if ($minute === 0) {
            $minute = "00";
        }
        
        return "$hour:$minute";
    }
}

if (! function_exists('group_array')) {
    function group_array($property, $data) {
        $grouped_array = array();
    
        foreach($data as $value) {
            if(array_key_exists($property, $value)){
                $grouped_array[$value[$property]][] = $value;
            }else{
                $grouped_array[""][] = $value;
            }
        }
    
        return $grouped_array;
    }
}



