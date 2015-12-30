<?php
$phonepattern = "(\+[0-9]{3}-[0-9]{2}-[0-9]{3}-[0-9]{2}-[0-9]{2})|(\+[0-9]{3}-[0-9]{3}-[0-9]{2}-[0-9]{2}-[0-9]{2})|(8[0-9]{10})|(8-[0-9]{4}-[0-9]{2}-[0-9]{2}-[0-9]{2})";

class Car
{
    public $id;
    public $brand;
    public $color;
    public $date;
    public $price;
    public $percent;
}

class Owner
{
    public $id;
    public $name;
    public $adress;
    public $phone;
}

class Buyer
{
    public $id;
    public $name;
    public $adress;
    public $phone;
}

?>