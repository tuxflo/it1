<?php
class jsonList
{
  private $files = null;

  public function __construct()
  {
    //$this->updateList();
    //$file = file_get_contents('articles/list.json');

  }
  
  public function updateList()
  {
    $jsonfiles = array();
    $files = glob('articles/*.json', GLOB_BRACE);
    foreach($files as $file)
    {
      $tmp = file_get_contents($file);
      $tmp = json_decode($tmp, true);
      $tmparray = array(
        "date" => $tmp['date'],
        "suffix" => $tmp['suffix'],
        "title" => $tmp['title']
      );
      array_push($jsonfiles, $tmparray);
    }
    var_dump($jsonfiles);
    echo json_encode($jsonfiles);
    echo "<br>";
    $sortedArray = array();
    foreach ($jsonfiles as $key => $row)
    {
      $sortedArray[$key] = $row['date'];
    }
    array_multisort($sortedArray, SORT_ASC, $jsonfiles);
    echo "<br>";
    echo json_encode($jsonfiles);
  }

}
?>
