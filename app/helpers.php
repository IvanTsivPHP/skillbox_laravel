<?php

if (! function_exists('LoginAdmin')) {

    function LoginAdmin() {

        return (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin());

    }
}

if (! function_exists('CamelToArray')) {
    function CamelToArray($text) {
        $reg = '/(?<=[a-z])(?=[A-Z])/x';

        return preg_split($reg, $text);
    }
}

if (! function_exists('CollectTrimmed')) {
    function CollectTrimmed($text) {

        return collect(explode(',', trim($text)));
    }
}

