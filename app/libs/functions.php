<?php

function dateTimeId($date){
    $d = date_create($date);
    $dx = date_format($d, "d-m-Y H:i:s");
    return $dx;
}

function dateId($date) {
    $d = date_create($date);
    $dx = date_format($d, "d-m-Y");
    return $dx;
}

function dateSys($date) {
    $d = date_create($date);
    $dx = date_format($d, "Y-m-d");
    return $dx;
}

function emptyElementExists($arr) {
    return array_search("", $arr) !== false;
}
