<?php
  require_once("Article.php");
   if($_GET["suffix"]) {
      $filename = './articles/' . $_GET['suffix'] . '.json';
      $test = Article::fromJson($filename);
   }
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
    <div class="col-md-3">
      
    </div>
    <div class="col-md-9">
      <?php echo $test->getArticle(); ?>
    </div>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete <b><i class="title"></i></b> record, this procedure is irreversible.</p>
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
</html>
