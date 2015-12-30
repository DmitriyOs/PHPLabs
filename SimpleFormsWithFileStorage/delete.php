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
require_once("textstorageconnection.php");
$target;
$id = $_POST["id"];
$isDeleted = false;

switch ($_POST["deleteObject"]) {
    case "Car":
        $target = "cars";
        break;
    case "Owner":
        $target = "owners";
        break;
    case "Buyer":
        $target = "buyers";
        break;
}
$mas = getArrayFromFile($target);
foreach ($mas as $k => $v) {
    if ($v->id == $id) {
        $isDeleted = true;
        unset($mas[$k]);
    }
}
$mas = array_values($mas);
writeArrayToFile($target, $mas);
if ($isDeleted)
    echo "<h4>Запись успешно удалена</h4>";
else
    echo "Запись не найдена";
?>
<form action=start.php method=POST role=form>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Назад</button>
    </div>
</form>
</body>
</html>