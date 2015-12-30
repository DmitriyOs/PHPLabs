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
$adressIsCorrupted = false;

function checkedWithoutError()
{
    global $adressIsCorrupted;
    if (!isset($_POST["addAdress"]) || strlen($_POST["addAdress"]) == 0) {
        $adressIsCorrupted = true;
        return false;
    } else
        return true;
}

function addElemToStorage()
{
    require_once("textstorageconnection.php");
    $mas = getArrayFromFile("buyers");
    $buyer = new buyer;
    $buyer->id = uniqid();
    $buyer->name = $_POST["addName"];
    $buyer->adress = $_POST["addAdress"];
    $buyer->phone = $_POST["addPhone"];
    $mas[count($mas)] = $buyer;
    writeArrayToFile("buyers", $mas);
}

if (isset($_POST["addNewOwner"])) {
    if (checkedWithoutError()) {
        addElemToStorage();
        echo "<h3 class=\"text-success\">Запись успешно добавлена</h3>";
    } else {
        echo "<h3 class=\"text-danger\">Запись не добавлена: ошибка ввода</h3>";
    }
}
?>

<h2>Добавление записи: Покупатели</h2>
<form method="post" action=formbuyer.php role=form>
    <div class="form-group">
        <legend>Введите ФИО</legend>
        <input type="text" required autofocus class="form-control" name=addName>
    </div>
    <div class="form-group<?php if ($adressIsCorrupted) echo " has-error" ?>">
        <legend>Введите адрес</legend>
        <?php if ($adressIsCorrupted) echo "<div class=\"text-danger\">Пожалуйста, введите адрес</div>"?>
        <input type="text" class="form-control" name=addAdress>
    </div>
    <div class="form-group">
        <legend>Введите телефон</legend>
        <input type="text" pattern="<?php echo $phonepattern; ?>" required title="Введите телефон" class="form-control"
               name=addPhone>
    </div>
    <button class="btn btn-success" type="submit" name=addNewOwner>Добавить</button>
</form>
<br>

<form action=start.php method=POST role=form>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Назад</button>
    </div>
</form>

</body>
</html>