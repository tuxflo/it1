<?php
require_once("Parsedown.php");

class Article
{
  private $title = null;
  private $url = null;
  private $date = null;
  private $text = null;
  private $comments = null;
  private $parsedown = null;

  public function __construct()
  {
    $parsedown = new Parsedown();
  }

  public static function fromJson($filename)
  {
    $instance = new self();
    $instance->initFromJson($filename);
    return $instance;
  }

  public function setText($text)
  {
    $this->text = $text;
  }

  public function getText()
  {
    return $this->text;
  }

  public function getDate()
  {
    return $this->date;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function getPreview()
  {
  }

  public function getRow()
  {
    $row = '
    <div class="row">
            <div class="col-sm-4"><a href="#" class=""><img src="http://placehold.it/1280X720" class="img-responsive"></a>
            </div>
            <div class="col-sm-8">
            <h3 class="title">' . $this->title . '</h3>
              <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span>'
              . $this->date . 'July 23, 2014 @ 1:30 PM <span style="float:right"><span class="glyphicon glyphicon-comment"></span> 20</span>
              </p>
              <p>' . $parsedown.text($this->text) . '</p>

              <p class="text-muted">Presented by <a href="#">Ellen Richey</a></p>

            </div>
          </div>';
    return $row;
  }

  public function initFromJson($filename)
  {
    $file = file_get_contents($filename);
    //TODO Do error handeling here
    $data = json_decode($file, true);
    $this->title = $data['title'];
    $this->url = $data['url'];
    $this->date = $data['date'];
    $this->text = $data['text'];
  }
}
?>
