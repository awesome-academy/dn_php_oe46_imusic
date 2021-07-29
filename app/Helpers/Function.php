<?php

if (!function_exists('loopNo')) {
    function loopNo($para, $loop)
    {
        return ($para->currentPage() - 1) * $para->perPage() + $loop->iteration;
    }
}

if (!function_exists('get_data_user'))
{
    function get_data_user($type,$field = 'id')
    {
        return Auth::guard($type)->user() ? Auth::guard($type)->user()->$field : '';
    }
}
