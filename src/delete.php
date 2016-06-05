<?php
require_once("jsonList.php");
$list = new jsonList();
//$filename = './test.log';
//$oldname = "articles/" .$_POST['suffix'] . ".json";
//$newname = "articles/" .$_POST['suffix'] . ".bkp";
//rename($oldname, $newname);
$article= "articles/" . htmlentities($_POST['suffix']) . ".json";
unlink($article);
$list->updateList();
$string = '<script type="text/javascript">';
    $string .= 'window.location = "index.php?admin=1"';
    $string .= '</script>';

    echo $string;
?>
