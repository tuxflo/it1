<?php
require_once("jsonList.php");

//echo $_POST['text'];
date_default_timezone_set('Europe/Berlin');
$data = array(
  'title' => $_POST['title'],
  'suffix' => $_POST['suffix'],
  'date' => time(),
  'text' => $_POST['text'],
  'number_of_comments' => 0,
  'comments' => ""
);


$article = json_encode($data);
$filename = 'articles/' . $data['suffix'] . '.json';
$fp = fopen($filename, 'w');
fwrite($fp, $article);
fclose($fp);
$list = new jsonList();
$list->updateList();
header("Location: index.php");
?>

<?php
require_once './Parsedown.php';
$Parsedown = new Parsedown();

$string = file_get_contents("$filename");
$json_a = json_decode($string, true);
$text = $json_a['text'];
?>
<!DOCTYPE html>
<html lang="en">


<body>
<h1>Todo add save page</h1>
</body>

</html>
