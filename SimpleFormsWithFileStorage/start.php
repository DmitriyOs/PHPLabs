<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
        body {
            margin: 10px;
        }
    </style>
</head>
<body>
<?php
require_once("objects.php");
require_once("sortRules.php");
require_once("filterHelp.php");

require_once("textstorageconnection.php");
$masCar = getArrayFromFile("cars");
$masOwner = getArrayFromFile("owners");
$masBuyer = getArrayFromFile("buyers");

if (isset($_POST["filter"])) {
    switch ($_POST["filter"]) {
        case "Car":
            filterCar();
            break;
        case "Owner":
            filterOwner();
            break;
        case "Buyer":
            filterBuyer();
            break;
    }
}

function filterCar()
{
    global $masCar;
    if ($_POST["sort"] == "brand") {
        usort($masCar, "cmpCarByBrand");
    }
    if ($_POST["sort"] == "price") {
        usort($masCar, "cmpCarByPrice");
    }
    if ($_POST["desc"] == "true")
        $masCar = array_reverse($masCar);
    if ($_POST["color"] != "none") {
        $masCar = filterColors($masCar, $_POST["color"]);
    }
}

function filterOwner()
{
    global $masOwner;
    if ($_POST["sort"] == "name") {
        usort($masOwner, "cmpOwnerByName");
    }
    if ($_POST["sort"] == "adress") {
        usort($masOwner, "cmpOwnerByAdress");
    }
    if ($_POST["desc"] == "true")
        $masOwner = array_reverse($masOwner);
    if ($_POST["find"] == "name" && strlen($_POST["forSearch"]) > 0) {
        $masOwner = filterNames($masOwner, $_POST["forSearch"]);
    }
    if ($_POST["find"] == "adress" && strlen($_POST["forSearch"]) > 0) {
        $masOwner = filterAdresses($masOwner, $_POST["forSearch"]);
    }
}

function filterBuyer()
{
    global $masBuyer;
    if ($_POST["sort"] == "name") {
        usort($masBuyer, "cmpBuyerByName");
    }
    if ($_POST["sort"] == "adress") {
        usort($masBuyer, "cmpBuyerByAdress");
    }
    if ($_POST["desc"] == "true")
        $masBuyer = array_reverse($masBuyer);
    if ($_POST["find"] == "name" && strlen($_POST["forSearch"]) > 0) {
        $masBuyer = filterNames($masBuyer, $_POST["forSearch"]);
    }
    if ($_POST["find"] == "adress" && strlen($_POST["forSearch"]) > 0) {
        $masBuyer = filterAdresses($masBuyer, $_POST["forSearch"]);
    }
}

?>
<h2>Автомобили</h2>

<form class="form-inline" method="post" action=start.php role=form>
    <div class="form-group"><label>Упорядочить по</label></div>
    <div class="form-group"><select name="sort" size="1">
            <option value="none" selected>без сортировки</option>
            <option value="brand">марка</option>
            <option value="price">цена</option>
        </select></div>
    <div class="form-group"><select name="desc" size="1">
            <option value="false" selected>по возрастанию</option>
            <option value="true">по убыванию</option>
        </select></div>
    <div class="form-group"><label>Подобрать цвет</label></div>
    <div class="form-group"><select name="color" size="1">
            <option value="none" selected>Любой</option>
            <option value="Черный">Черный</option>
            <option value="Красный">Красный</option>
            <option value="Зеленый">Зеленый</option>
            <option value="Синий">Синий</option>
            <option value="Желтый">Желтый</option>
        </select></div>
    <button type="submit" name="filter" value="Car">Применить</button>
</form>
<br>
<table class="table table-bordered table-condensed" style="width: 800px;">
    <thead>
    <tr>
        <th>Марка</th>
        <th>Цвет</th>
        <th>Дата выпуска</th>
        <th>Цена</th>
        <th>Процент фирме</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($masCar as $k => $v) {
        echo "<tr><th>$v->brand</th><th>$v->color</th><th>$v->date</th><th>$v->price</th><th>$v->percent</th>
            <th style=\"width : 50px\"><form action=delete.php method=post role=form>
                    <input type=hidden name=id value=$v->id>
                    <button type=submit name=deleteObject value=Car>Удалить</button></form>
            </th></tr>";
    }
    ?>
    </tbody>
</table>

<form action=formcar.php method=post role=form>
    <button type=submit name=showAddCarForm>Добавить запись</button>
</form>
<h2>Владельцы</h2>

<form class="form-inline" method="post" action=start.php role=form>
    <div class="form-group"><label>Упорядочить по</label></div>
    <div class="form-group"><select name="sort" size="1">
            <option value="none" selected>без сортировки</option>
            <option value="name">ФИО</option>
            <option value="adress">Адрес</option>
        </select></div>
    <div class="form-group"><select name="desc" size="1">
            <option value="false" selected>по возрастанию</option>
            <option value="true">по убыванию</option>
        </select></div>
    <div class="form-group"><label>Фильтр по</label></div>
    <div class="form-group"><select name="find" size="1">
            <option value="none" selected>без фильтра</option>
            <option value="name">ФИО</option>
            <option value="adress">Адрес</option>
        </select></div>
    <div class="form-group"><input type="text" name=forSearch></div>

    <button type="submit" name="filter" value="Owner">Применить</button>
</form>
<br>
<table class="table table-bordered table-condensed" style="width: 800px;">
    <thead>
    <tr>
        <th>ФИО</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($masOwner as $k => $v) {
        echo "<tr>
            <th>$v->name</th>
            <th>$v->adress</th>
            <th>$v->phone</th>
            <th style=\"width : 50px\"><form action=delete.php method=post role=form>
                    <input type=hidden name=id value=$v->id>
                    <button type=submit name=deleteObject value=Owner>Удалить</button></form>
            </th>
        </tr>";
    }
    ?>
    </tbody>
</table>

<form action=formowner.php method=post role=form>
    <button type=submit name=showAddOwnerForm>Добавить запись</button>
</form>
<h2>Покупатели</h2>

<form class="form-inline" method="post" action=start.php role=form>
    <div class="form-group"><label>Упорядочить по</label></div>
    <div class="form-group"><select name="sort" size="1">
            <option value="none" selected>без сортировки</option>
            <option value="name">ФИО</option>
            <option value="adress">Адрес</option>
        </select></div>
    <div class="form-group"><select name="desc" size="1">
            <option value="false" selected>по возрастанию</option>
            <option value="true">по убыванию</option>
        </select></div>
    <div class="form-group"><label>Фильтр по</label></div>
    <div class="form-group"><select name="find" size="1">
            <option value="none" selected>без фильтра</option>
            <option value="name">ФИО</option>
            <option value="adress">Адрес</option>
        </select></div>
    <div class="form-group"><input type="text" name=forSearch></div>

    <button type="submit" name="filter" value="Buyer">Применить</button>
</form>
<br>
<table class="table table-bordered table-condensed" style="width: 800px;">
    <thead>
    <tr>
        <th>ФИО</th>
        <th>Адрес</th>
        <th>Телефон</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($masBuyer as $k => $v) {
        echo "<tr>
            <th>$v->name</th><th>$v->adress</th><th>$v->phone</th>
            <th style=\"width : 50px\"><form action=delete.php method=post role=form>
                    <input type=hidden name=id value=$v->id>
                    <button type=submit name=deleteObject value=Buyer>Удалить</button></form>
            </th>
        </tr>";
    }
    ?>
    </tbody>
</table>
<form action=formbuyer.php method=post role=form>
    <button type=submit name=showAddBuyerForm>Добавить запись</button>
</form>
</body>
</html>