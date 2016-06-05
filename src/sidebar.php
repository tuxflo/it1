<?php
//include("jsonList.php");
require_once("jsonList.php");
class Sidebar
{

  public function getSidebar($admin)
  {
    echo '
    <div class="col-md-3">
      <div class="">
        <div class="well">

          <header>
          <h4>Latest articles:</h4>
          </header>
          <ul class="sidebar list-unstyled">';
          $list = new jsonList();
          $tmp = $list->getArray();
          if($admin)
          {
            $w = new Warnings();
            $w->getDeleteConfirmation();
            echo '<script>';
            include("js/delete.js");
            echo '</script>';
          }
          $i = 0;
          foreach($tmp as $article)
          {
            $i++;
            if($i >= 10)
              break;
            echo '
            <li class="row">
              <div class="col-xs-8">
                <p><a href="posts.php?suffix=' . $article['suffix'];
              if($admin)
                echo '&admin=1';
              echo '">' . $article['title'];
            echo '</a></p>
                <em class="small">Posted on '. date("Y-m-d", $article['date']) . '</em>
              </div>';
            if($admin)
            echo ' 
            <div class="col-xs-4">
              <span class="pull-right">
                <a href="/newpost.php?edit=1&suffix=' . $article['suffix'] . '">
                <span class="glyphicon glyphicon-edit"></span></a>
                <a href="#" data-record-id="' . $article['suffix'] . '" data-record-title="' . $article['title'] . '" data-toggle="modal" data-target="#confirm-delete">
                 <span class="glyphicon glyphicon-remove-sign"></span></a>
              </span> </div>';
            echo '
            </li>';
          }
    echo '</ul>
        </div>
      </div>
    </div>';
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
