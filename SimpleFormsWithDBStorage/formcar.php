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
$colorIsCorrupted = false;
$dateIsCorrupted = false;

function checkedWithoutError()
{
    global $colorIsCorrupted, $dateIsCorrupted;
    if (!isset($_POST["addColor"])) {
        $colorIsCorrupted = true;
    }
    if (!isset($_POST["addDate"]["month"]) || $_POST["addDate"]["month"] == 0 || strlen($_POST["addDate"]["year"]) == 0) {
        $dateIsCorrupted = true;
    }
    if ($colorIsCorrupted || $dateIsCorrupted)
        return false;
    else
        return true;
}

function addElemToStorage()
{
    require_once("dbconnection.php");
    $car = new Car;
    $car->id = uniqid();
    $car->brand = $_POST["addBrand"];
    $colors = "";
    foreach ($_POST["addColor"] as $currentColor) {
        $colors .= $currentColor;
        $colors .= ", ";
    }
    $colors = substr($colors, 0, -2);
    $car->color = $colors;
    $car->date = $_POST["addDate"]["month"] . "." . $_POST["addDate"]["year"];
    $car->price = $_POST["addPrice"];
    $car->percent = $_POST["addPercent"];
    addCarToDB($car);
}

if (isset($_POST["addNewCar"])) {
    if (checkedWithoutError()) {
        addElemToStorage();
        echo "<h3 class=\"text-success\">Запись успешно добавлена</h3>";
    } else {
        echo "<h3 class=\"text-danger\">Запись не добавлена: ошибка ввода</h3>";
    }
}
?>

<h2>Добавление записи: автомобили</h2>

<form method="post" action=formcar.php role=form>
    <div class="form-group">
        <fieldset>
            <legend>Выберите марку авто</legend>
            <label class="radio-inline">
                <input type="radio" name="addBrand" value="BMW" checked autofocus>BMW</label>
            <label class="radio-inline"><input type="radio" name="addBrand" value="Audi">Audi</label>
            <label class="radio-inline"><input type="radio" name="addBrand" value="Mercedes">Mercedes</label>
        </fieldset>
    </div>
    <div class="form-group">
        <fieldset>
            <legend>Выберите цвет</legend>
            <?php if ($colorIsCorrupted) echo "<div class=\"text-danger\">Пожалуйста, выберите цвет</div>"?>
            <label class="checkbox-inline"><input type="checkbox" name=addColor[] value="Черный">Черный</label><br>
            <label class="checkbox-inline"><input type="checkbox" name=addColor[] value="Красный">Красный</label><br>
            <label class="checkbox-inline"><input type="checkbox" name=addColor[] value="Зеленый">Зеленый</label><br>
            <label class="checkbox-inline"><input type="checkbox" name=addColor[] value="Синий">Синий</label><br>
            <label class="checkbox-inline"><input type="checkbox" name=addColor[] value="Желтый">Желтый</label>
        </fieldset>
    </div>
    <div class="form-group<?php if ($dateIsCorrupted) echo " has-error" ?>">
        <legend>Выберите дату выпуска</legend>
        <?php if ($dateIsCorrupted) echo "<div class=\"text-danger\">Пожалуйста, введите корректную дату</div>"?>
        <select class="form-control" name="addDate[month]" title="Выберите месяц" size="1"
                style="display : inline; width: 120px">
            <option value="00" selected>Месяц</option>
            <option value="01">Январь</option>
            <option value="02">Февраль</option>
            <option value="03">Март</option>
            <option value="04">Апрель</option>
            <option value="05">Май</option>
            <option value="06">Июнь</option>
            <option value="07">Июль</option>
            <option value="08">Август</option>
            <option value="09">Сентябрь</option>
            <option value="10">Октябрь</option>
            <option value="11">Ноябрь</option>
            <option value="12">Декабрь</option>
        </select>
        <input type="text" pattern="[0-9]{4}" required title="Введите год" class="form-control" name=addDate[year]
               placeholder="Год"
               style="display : inline; width: 70px">
    </div>
    <div class="form-group">
        <legend>Введите цену</legend>
        <div class="input-group" style="width: 195px">
            <input type="text" pattern="[0-9]+" required title="Введите цену" class="form-control" name=addPrice>
            <span class="input-group-addon">у.е.</span>
        </div>
    </div>
    <div class="form-group">
        <legend>Введите процент фирме</legend>
        <div class="input-group" style="width: 95px">
            <input type="text" pattern="[0-9]{1,2}" title="Введите процент 0-99" class="form-control" name=addPercent>
            <span class="input-group-addon">%</span>
        </div>
    </div>
    <button class="btn btn-success" type="submit" name=addNewCar>Добавить</button>
</form>
<br>

<form action=start.php method=POST role=form>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Назад</button>
    </div>
</form>

</body>
</html>