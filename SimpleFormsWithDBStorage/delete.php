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
require_once("dbconnection.php");


$id = $_POST["id"];
try {
    switch ($_POST["deleteObject"]) {
        case "Car":
            removeCarDB($id);
            break;
        case "Owner":
            removeOwnerDB($id);
            break;
        case "Buyer":
            removeBuyerDB($id);
            break;
    }
    ?>
    <h4>Запись успешно удалена</h4>
    <?php
} catch (Exception $e) {
    echo $e->getMessage();
}
?>
<form action=start.php method=POST role=form>
    <div class="form-group">
        <button class="btn btn-primary" type="submit">Назад</button>
    </div>
</form>

</body>
</html>