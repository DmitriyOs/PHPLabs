<?php
require_once("objects.php");

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
global $mysqli;
$mysqli = new mysqli("localhost", "root", "root", "CarShop");
$mysqli->set_charset("UTF8");

/**
 * @param $car
 * @throws mysqli_sql_exception
 */
function addCarToDB($car)
{
    global $mysqli;
    $stmt = $mysqli->prepare("Insert into car(brand, color, date, price, percent) values (?,?,?,?,?)");
    $tmppercent = strlen($car->percent) == 0 ? NULL : $car->percent;
    $stmt->bind_param('sssii',
        $car->brand,
        $car->color,
        $car->date,
        $car->price,
        $tmppercent);
    try {
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        throw $e;
    } finally {
        $stmt->close();
    }
}

/**
 * @param $owner
 * @throws mysqli_sql_exception
 */
function addOwnerToDB($owner)
{
    global $mysqli;
    $stmt = $mysqli->prepare("Insert into owner(name, adress, phone) values (?,?,?)");
    $stmt->bind_param('sss', $owner->name, $owner->adress, $owner->phone);
    try {
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        throw $e;
    } finally {
        $stmt->close();
    }
}

/**
 * @param $buyer
 * @throws mysqli_sql_exception
 */
function addBuyerToDB($buyer)
{
    global $mysqli;
    $stmt = $mysqli->prepare("Insert into buyer(name, adress, phone) values (?,?,?)");
    $stmt->bind_param('sss', $buyer->name, $buyer->adress, $buyer->phone);
    try {
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        throw $e;
    } finally {
        $stmt->close();
    }
}

/**
 * @param $id
 * @throws Exception if entry wasn't found
 */
function removeCarDB($id)
{
    global $mysqli;
    $mysqli->query("Delete from car where id=\"$id\"");
    if ($mysqli->affected_rows < 1)
        throw new Exception("Entry with id=" . $id . " was not found");
}

/**
 * @param $id
 * @throws Exception if entry wasn't found
 */
function removeOwnerDB($id)
{
    global $mysqli;
    $mysqli->query("Delete from owner where id=\"$id\"");
    if ($mysqli->affected_rows < 1)
        throw new Exception("Entry with id=" . $id . " was not found");
}

/**
 * @param $id
 * @throws Exception if entry wasn't found
 */
function removeBuyerDB($id)
{
    global $mysqli;
    $mysqli->query("Delete from buyer where id=\"$id\"");
    if ($mysqli->affected_rows < 1)
        throw new Exception("Entry with id=" . $id . " was not found");
}

function getCarsDB()
{
    global $mysqli;
    $stmt = $mysqli->prepare("Select id, brand, color, date, price, percent from car");
    try {
        $stmt->execute();
        $result = array();
        $stmt->bind_result($result[0], $result[1], $result[2], $result[3], $result[4], $result[5]);
        $mas = array();
        while ($stmt->fetch()) {
            $car = new Car();
            $car->id = $result[0];
            $car->brand = $result[1];
            $car->color = $result[2];
            $car->date = $result[3];
            $car->price = $result[4];
            $car->percent = $result[5];
            $mas[count($mas)] = $car;
        }
    } catch (mysqli_sql_exception $e) {
        throw $e;
    } finally {
        $stmt->close();
    }
    return $mas;
}

function getOwnersDB()
{
    global $mysqli;
    $stmt = $mysqli->prepare("Select id, name, adress, phone from owner");
    try {
        $stmt->execute();
        $result = array();
        $stmt->bind_result($result[0], $result[1], $result[2], $result[3]);
        $mas = array();
        while ($stmt->fetch()) {
            $owner = new Owner();
            $owner->id = $result[0];
            $owner->name = $result[1];
            $owner->adress = $result[2];
            $owner->phone = $result[3];
            $mas[count($mas)] = $owner;
        }
    } catch (mysqli_sql_exception $e) {
        throw $e;
    } finally {
        $stmt->close();
    }
    return $mas;
}

function getBuyersDB()
{
    global $mysqli;
    $stmt = $mysqli->prepare("Select id, name, adress, phone from buyer");
    try {
        $stmt->execute();
        $result = array();
        $stmt->bind_result($result[0], $result[1], $result[2], $result[3]);
        $mas = array();
        while ($stmt->fetch()) {
            $buyer = new Buyer();
            $buyer->id = $result[0];
            $buyer->name = $result[1];
            $buyer->adress = $result[2];
            $buyer->phone = $result[3];
            $mas[count($mas)] = $buyer;
        }
    } catch (mysqli_sql_exception $e) {
        throw $e;
    } finally {
        $stmt->close();
    }
    return $mas;
}

?>