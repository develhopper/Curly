<?php
include __DIR__."/../vendor/autoload.php";

use develhopper\Curly;

$curly=new Curly("http://example.com");

$result=$curly->send("POST",["test"=>"test"]);

var_dump($result);