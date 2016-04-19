<?php
if(isset($_POST["suffix"]))
{
  $filename = "./articles/" . filter_var($_POST["suffix"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH) . ".json";
  if(file_exists($filename)) {
    echo 'The suffix ' . $_POST["suffix"] . " is already taken." . " Please choose a different one";
  }
  else
    echo '';
  //if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        //die();
    //}
}
?>
