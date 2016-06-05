<!DOCTYPE html>
<html lang="en">
<?php
  require_once("Article.php");
  require_once("jsonList.php");
  require_once("sidebar.php");
  require_once("warnings.php");
  date_default_timezone_set("UTC");
  $list = new jsonList();
  $list->updateList();
  $sidebar = new Sidebar();
  $admin = false;
  $warnings = new Warnings();
  if(isset($_GET['admin']))
  {
    $tmp = htmlentities($_GET['admin']);
    if($tmp === '1' || $tmp === '0')
      $admin = (bool) $tmp;
  }
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The next generation Blog engine</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">
    <link rel="stylesheet" href="css/simplemde.min.css">
    <script src="js/simplemde.min.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-hover-dropdown.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
