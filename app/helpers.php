<?php

if (! function_exists('LoginAdmin')) {

    function LoginAdmin() {

        return (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->isAdmin());

    }
}

