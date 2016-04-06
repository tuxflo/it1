<?php
class jsonList
{
  private $files = null;

  public function __construct()
  {
    //$this->updateList();
    $file = file_get_contents('articles/list.json');

  }
  
  public function updateList()
  {
    $this->files = glob('articles/*.json', GLOB_BRACE);
    ksort($this->files);
  }

}
?>
