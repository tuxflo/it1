<?php
==== BASE ====
require_once("jsonList.php");
class Sidebar()
==== BASE ====
{

  public function getSidebar()
  {
    echo <<<HEREDOC1
    <div class="col-md-3">
        <div class="well">

          <header>
          <h4>Latest articles:</h4>
          </header>
          <ul class="sidebar list-unstyled">

HEREDOC1;
    $date_func = "date";
    date_default_timezone_set("UTC");
    $list = new jsonList();
    $tmp = $list->getArray();
    foreach($tmp as $article)
    {
        echo <<<HEREDOC2
            <li class="row">
              <div class="col-md-9"> 
                <p class="pull-right"><a href="posts.php?suffix={$article['suffix']}">{$article['title']}</a></p>
                <em class="small">Posted on {$date_func("Y-m-d", $article['date'])}</em>
              </div>
            </li>

HEREDOC2;
    }
    echo <<<HEREDOC3
          </ul>
        </div>
    </div>
HEREDOC3;
  }

  public function getAdminSidebar()
  {
    echo '
    <div class="col-md-3">
      <div class="hidden-sm hidden-xs">
        <div class="well">

          <header>
          <h4>Latest articles:</h4>
          </header>
          <ul class="sidebar list-unstyled">';
          $list = new jsonList();
          $tmp = $list->getArray();
          foreach($tmp as $article)
          {
            echo '
            <li class="row">
              <div class="col-md-9">
                <p><a href="posts.php?suffix=' . $article['suffix'] . '">' . $article['title'] . '</a></p>
                <em class="small">Posted on '. date("Y-m-d", $article['date']) . '</em>
              </div>
              <div class="col-md-3">
<span class="pull-right"><span class="glyphicon glyphicon-edit"></span><span class="glyphicon glyphicon-remove-sign"></span></span>
</p>
              </div>
            </li>';
          }
    echo '</ul>
        </div>
      </div>
    </div>';
  }

}
?>
