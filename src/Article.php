<?php

class Article
{
  private $title = null;
  private $suffix = null;
  private $date = null;
  private $text = null;
  private $comments = array();
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
    if ($this->comments==null)
      return 0;
    else
      return count($this->comments);
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

  public function getArticle($admin)
  {
    date_default_timezone_set("UTC");
    $row = '
            <h3 class="title">' . $this->title . '</h3>
            <div class="row">
              <div class="col-sm-4">
              <p class="text-muted">
                <span class="glyphicon glyphicon-calendar"></span> '
              . date("F d, Y @ H:i", $this->date) . ' <span class="glyphicon glyphicon-comment"></span>' . $this->getNumberOfComments()
              .'</p>
              </div>';
    if($admin == true)
             $row .= '<div class="col-sm-4 col-sm-push-5">
                <a href="./newpost.php?edit=1&suffix=' . $this->getSuffix() . '">
                <span class="glyphicon glyphicon-edit"></span> Edit Post</a>
                <a href="#" data-record-id="' . $this->getSuffix() . '" data-record-title="' . $this->getTitle() . '" data-toggle="modal" data-target="#confirm-delete">
                 <span class="glyphicon glyphicon-remove-sign"></span> Delete Post</a></div>';
            $row .= '</div>
              <p>' . $this->parsedown->text($this->text) . '</p>
          </div>';
    return $row;
  }

  //return the first 16 lines of the article text
  public function getPreview($admin)
  {
    $tmp = explode("\n", $this->text);
    $tmp = array_slice($tmp, 0, 16);
    $preview = implode("\n", $tmp);

    date_default_timezone_set("UTC");
    $row = '
    <div class="row">
            <div class="col-sm-12">
            <h3 class="title"> <a href="./posts.php?suffix=' . $this->getSuffix();
    //echo "Test";
    if($admin)
      $row .= "&admin=1";
    
    $row .= '">' . $this->title . '</a></h3>
              <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> '
              . date("F d, Y @ H:i", $this->date) . ' <span class="glyphicon glyphicon-comment"></span>' . $this->getNumberOfComments()
              .'</p>' . $this->parsedown->text($preview);

              //check if "read more" link is necessary
              if(count($tmp) > 15)
              {
                $row .= '
<p class="text-muted" style="float:right"><a href="./posts.php?suffix=' . $this->getSuffix();
                if($admin)
                  $row .= "&admin=1";
                $row .= '">Read more...</a></p>';
              }
              $row .= '
            </div>
          </div>';
    return $row;
  }
  
  public function addComment($comment, $filename){

    if ($this->comments==null){
      $this->comments = array($comment);
    } 
    else{
      // inserts new comment before all other comments 
      array_unshift($this->comments, $comment);
    }
    $data = array(
      'title' => $this->title,
      'suffix' =>  $this->suffix,
      'date' =>  $this->date,
      'text' =>  $this->text,
      'number_of_comments' =>  $this->getNumberOfComments(),
      'comments' =>  $this->comments
    );
    $articleJSON = json_encode($data);
    $fp = fopen($filename, 'w');
    fwrite($fp, $articleJSON);
    fclose($fp);
  }

  public function getCommentsRaw(){
    return $this->comments;
  }

  public function getComments(){
    $commentHTML = "";  

    foreach($this->comments as $comment){  
        $commentHTML = $commentHTML . "<div><h4>" 
        . $comment["name"] . " " . "<small>" . $comment["date"] . "</small>"
        . "</h4>"
        . "<p>" . $comment["content"] . "</p>" 
        . "</div>";
    }
    return $commentHTML;
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
    $this->comments = $data['comments'];
  }
}
?>
