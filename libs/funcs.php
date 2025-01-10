<?php

function debug($data, $die = false) { // форматированная распечатка данных
    echo "<pre>" . print_r($data, 1) . "</pre>";
    if($die) {
        die;
    }
}
