<?php
function fileIsEmpty($path)
{
    //TODO: refactor and improve
    //because file with empty array not 0
    if (filesize($path) < 16)
        return true;
    else
        return false;
}

function getArrayFromFile($filename)
{
    $file_path = "storage/" . $filename . ".txt";
    $file = fopen($file_path, "rb") or die("File " . $filename . " not found. Please create storage/" . $filename . ".txt if it's first run");
    if (fileIsEmpty($file_path)) {
        $rows = array();
    } else {
        while (!flock($file, LOCK_EX + LOCK_NB)) {
            sleep(5);
        }
        $rows = unserialize(fread($file, filesize($file_path)));
        flock($file, LOCK_UN);
        fclose($file);
    }
    return $rows;
}

function writeArrayToFile($filename, $array)
{
    $file_path = "storage/" . $filename . ".txt";
    $file = fopen($file_path, "wb") or die("Unable to open file " . $filename);
    while (!flock($file, LOCK_EX + LOCK_NB)) {
        sleep(5);
    }
    fwrite($file, serialize($array));
    flock($file, LOCK_UN);
    fclose($file);
}

?>