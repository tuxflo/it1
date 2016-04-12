<?php
if(isset($_POST["url"]))
{
  if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
        die();
    }
  $filename = "./articles/" . filter_var($_POST["url"], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW|FILTER_FLAG_STRIP_HIGH);
  if(file_exists($filename)) {
    echo $_POST["url"] . " Already taken" . " please choose a different one";
  }
}
?>
