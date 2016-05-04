<?php
require_once("jsonList.php");
class Sidebar()
{

  public function getSidebar()
  {
    echo <<<HEREDOC
    <div class="col-md-3">
      <div class="hidden-sm hidden-xs">
        <div class="well">

          <header>
          <h4>Latest articles:</h4>
          </header>
          <ul class="sidebar list-unstyled">
          $tmp = $list->getArray();
          foreach($tmp as $article)
          {
            <li class="row">
              <div class="col-md-9"> 
                <p class="pull-right"><a href="posts.php?suffix=' . $article['suffix'] . '">' . $article['title'] . '</a></p>
                <em class="small">Posted on '. date("Y-m-d", $article['date']) . '</em>
              </div>
            </li>';
          }
          </ul>
        </div>
      </div>
    </div>
HEREDOC;
  }

  public function getAdminSidebar()
  {
  }

}
?>
