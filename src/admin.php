<?php
  require_once("Article.php");
  require_once("jsonList.php");
  require_once("sidebar.php");
  $list = new jsonList();
  $list->updateList();

  $pagenumber = 1;
  if(isset($_GET['page']))
    $pagenumber = $_GET['page'];

  if($pagenumber > $list->getArticleCount() + 1)
  {
    echo '<div class="container">
      <div class="alert alert-warning">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Warning!</strong> Invalid page value: ' . $pagenumber . ', redirecting to page 1.
      </div>';
    $pagenumber = 1;
  }
  $articles = $list->getArticlePage($pagenumber);

  //$first = Article::fromJson("articles/" . array_shift($articles)['suffix'] . ".json");
  //$second = Article::fromJson("articles/"  . array_shift($articles)['suffix'] . ".json");
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.html"); ?>
<body>
    <!-- Navigation -->
<?php include("nav.html"); ?>
    <!-- Page Content -->
<div class="row-fluid top30 pagetitle">
  
  <div class="container">
    
    <div class="row">
      <div class="col-md-12"><h1>Latest Posts</h1></div>
    </div>
    
  </div>
</div>
<div class="container">
  <div class="row">
<?php
  $sidebar = new Sidebar();
  $sidebar->getAdminSidebar();
?>
    <div class="col-md-9">
<?php
  if(! $list->getArticleCount())
    echo "No Articles right now...";
  else
  {
    foreach($articles as $article)
    {
      $a = array_pop($articles);
    $filename = "articles/" . $a['suffix'] . ".json";
    $tmp = Article::fromJson($filename);
      echo $tmp->getPreview(true);
      echo "<hr>";
    }
  }
?>
      <ul class="pagination pagination-lg pull-right">
<?php
for($i=1; $i<($list->getArticleCount() /2) +1; $i++)
{
  if($pagenumber == $i)
    echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
  else
    echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
}
?>
      </ul>
    </div> <!-- col-md-9 --!>
  </div>
</div>
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
    <br />
  </div>
</div>
    
<?php include("foot_include.html"); ?>
</body>
    <script>
        $('#confirm-delete').on('click', '.btn-ok', function(e) {
            var $modalDiv = $(e.delegateTarget);
            var id = $(this).data('recordId');
            //$.ajax({url: 'delete.php/' + id, type: 'DELETE'})
            $.post('delete.php', {'suffix':id}).then()
            $modalDiv.addClass('loading');
            setTimeout(function() {
                $modalDiv.modal('hide').removeClass('loading');
            }, 1000)
              window.location = "index.php";
        });
        $('#confirm-delete').on('show.bs.modal', function(e) {
            var data = $(e.relatedTarget).data();
            $('.title', this).text(data.recordTitle);
            $('.btn-ok', this).data('recordId', data.recordId);
        });
    </script>
<script>
$(document).ready(function(){
 
  $('.nav > li:nth-child(1)').toggleClass('active','deactive');
  $('.nav > li:nth-child(2)').toggleClass('active','deactive');
 
})
</script>
</html>
