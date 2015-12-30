<?php
require_once("objects.php");

function cmpCarByBrand($a, $b)
{
    return strcmp($a->brand, $b->brand);
}

function cmpCarByPrice($a, $b)
{
    //return natsort($a->price, $b->price);
    return ($a->price < $b->price) ? -1 : 1;
}

function cmpOwnerByName($a, $b)
{
    return strcmp($a->name, $b->name);
}

function cmpOwnerByAdress($a, $b)
{
    return strcmp($a->adress, $b->adress);
}

function cmpBuyerByName($a, $b)
{
    return strcmp($a->name, $b->name);
}

function cmpBuyerByAdress($a, $b)
{
    return strcmp($a->adress, $b->adress);
}

?>