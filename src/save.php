<?php

//echo $_POST['text'];
$data = array(
  'title' => $_POST['title'],
  'url' => $_POST['url'],
  'date' => date("Y_m_d"),
  'text' => $_POST['text'],
  'comments' => ""
);


$article = json_encode($data);
echo $article;
?>
