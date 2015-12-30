<?php
function filterNames($mas, $forSearch)
{
    foreach ($mas as $k => $v) {
        if (strpos($v->name, $forSearch) === false) {
            unset($mas[$k]);
        }
    }
    return $mas;
}

function filterAdresses($mas, $forSearch)
{
    foreach ($mas as $k => $v) {
        if (strpos($v->adress, $forSearch) === false) {
            unset($mas[$k]);
        }
    }
    return $mas;
}

function filterShopname($mas, $forSearch)
{
    foreach ($mas as $k => $v) {
        if (strpos($v->shopname, $forSearch) === false) {
            unset($mas[$k]);
        }
    }
    return $mas;
}

function filterColors($mas, $forSearch)
{
    foreach ($mas as $k => $v) {
        if (strpos($v->color, $forSearch) === false) {
            unset($mas[$k]);
        }
    }
    return $mas;
}

?>