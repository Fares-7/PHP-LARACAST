<?php

function url($value){
    if (($_SERVER['REQUEST_URI']==$value)){
        echo "bg-gray-900 text ";
    }
    return "";
}


function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

function abort($code =404){
    http_response_code($code);
    require "views/{$code}.php";
    die();
}

function RouteToController ($uri, $routes) {
    if (array_key_exists($uri, $routes)) {
        require $routes[$uri];
    } else {
        abort();
    }
}