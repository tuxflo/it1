<?php
require_once("jsonList.php");
$list = new jsonList();
$filename = './test.log';
$oldname = "articles/" .$_POST['suffix'] . ".json";
$newname = "articles/" .$_POST['suffix'] . ".bkp";
rename($oldname, $newname);
$list->updateList();
$string = '<script type="text/javascript">';
    $string .= 'window.location = "index.php"';
    $string .= '</script>';

    echo $string;
?>
