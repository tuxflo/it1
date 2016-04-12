<?php

class Article
{
  private $title = null;
  private $suffix = null;
  private $date = null;
  private $text = null;
  private $comments = null;
  private $parsedown = null;

  public function __construct()
  {
    require_once("Parsedown.php");
    $this->parsedown = new Parsedown();
  }

  public static function fromJson($filename)
  {
    $instance = new self();
    $instance->initFromJson($filename);
    return $instance;
  }

  public function getSuffix()
  {
    return $this->suffix;
  }

  public function getNumberOfComments()
  {
    //TODO
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

  public function getArticle()
  {
    $row = '
    <div class="row">
            <div class="col-sm-12"><a href="#" class=""></a>
            </div>
    </div> <!-- row -->
    <div class="row">
            <div class="col-sm-8">
            <h3 class="title">' . $this->title . '</h3>
              <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> '
              . date("F d, Y @ H:i", $this->date) . ' <span class="glyphicon glyphicon-comment"></span> 20<a href="/newpost.php?edit=1&suffix=' . $this->getSuffix() . '"<span style="float:right"><span class="glyphicon glyphicon-edit"></span> Edit Post</span></a>
              </p>
              <p>' . $this->parsedown->text($this->text) . '</p>
            </div>
          </div>';
    return $row;
  }

  //return the first 16 lines of the article text
  public function getPreview()
  {
    $tmp = explode("\n", $this->text);
    $tmp = array_slice($tmp, 0, 16);
    $preview = implode("\n", $tmp);

    $row = '
    <div class="row">
            <div class="col-sm-12">
            <h3 class="title"> <a href="/?suffix=' . $this->getSuffix() . '">' . $this->title . '</a></h3>
              <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> '
              . date("F d, Y @ H:i", $this->date) . ' <span class="glyphicon glyphicon-comment"></span> 20<a href="/newpost.php?edit=1&suffix=' . $this->getSuffix() . '"<span style="float:right"><span class="glyphicon glyphicon-edit"></span> Edit Post</span></a>
              </p>
              <p>' . $this->parsedown->text($preview) . '</p>';

              //check if "read more" link is necessary
              if(count($tmp) > 15)
              {
              $row .= '<p class="text-muted" style="float:right"><a href="#">Read more...</a></p>';
              }
              $row .= '
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
    $this->suffix = $data['suffix'];
    $this->date = $data['date'];
    $this->text = $data['text'];
  }
}
?>
