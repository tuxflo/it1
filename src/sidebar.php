<?php
require_once("jsonList.php");
class Sidebar
{

  public function getSidebar($admin)
  {
    if($admin)
    {
            echo <<<HEREDOC
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
            </div>
            <div class="modal-body">
                <p>You are about to delete the post <b><i class="title"></i></b>, this procedure is irreversible.</p>
                <p>Do you want to proceed?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-ok">Delete</button>
            </div>
        </div>
    </div>
</div>
HEREDOC;
    }
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
            //$w->getDeleteConfirmation();
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
                <a href="./newpost.php?edit=1&suffix=' . $article['suffix'] . '">
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
