<?php

if (!function_exists('formatDateTime')) {
    function formatDateTime($date)
    {
        return \Carbon\Carbon::parse($date)->format(config('app.locale') != 'en' ? 'd/m/Y H:i:s' : 'm/d/Y H:i:s');
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date)
    {
        return \Carbon\Carbon::parse($date)->format(config('app.locale') != 'en' ? 'd/m/Y' : 'm/d/Y');
    }
}

if (!function_exists('formatTime')) {
    function formatTime($date)
    {
        return \Carbon\Carbon::parse($date)->format('H:i:s');
    }
}