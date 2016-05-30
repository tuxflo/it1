<?php
  require_once("Article.php");
  require_once("sidebar.php");
  require_once("jsonList.php");
   if($_GET["suffix"]) {
      $filename = './articles/' . $_GET['suffix'] . '.json';
      $test = Article::fromJson($filename);
   }
  $admin = 0;
  if(isset($_GET['admin']))
  {
    if($_GET['admin'] === '1' || $GET['admin'] === '0')
      $admin = (bool) $_GET['admin'];
  }
?>
<!DOCTYPE html>
<html lang="en">

<?php include("head.html"); ?>
<body>

<script language="JavaScript" type="text/javascript">
    $("document").ready(function(){
        $("#commentButton").click(function() {
            //for testing
            var comment = [];
            comment["name"] = "x";
            var today = new Date();
            var strDate = 'Y-m-d'
                .replace('Y', today.getFullYear())
                .replace('m', today.getMonth()+1)
                .replace('d', today.getDate());
            comment["date"] = strDate;
            comment["content"] = "content";


            //$.getJSON("./newcomment.php", , function (comment){
                var commentHTML = "<div><h4>";
                commentHTML =  commentHTML.concat(comment["name"]); 
                commentHTML =  commentHTML.concat("</h4><p>"); 
                commentHTML =  commentHTML.concat(comment["date"]); 
                commentHTML =  commentHTML.concat("</p><p>"); 
                commentHTML =  commentHTML.concat(comment["content"]); 
                commentHTML =  commentHTML.concat("</p>"); 
                commentHTML =  commentHTML.concat("</div>"); 
                $("#comments").prepend(commentHTML);
            });
            //alert("Comment submitted successfully.);
        //});
    });
</script>

    <!-- Navigation -->
<?php include("nav.html"); ?>
    <!-- Page Content -->
<div class="row-fluid top30 pagetitle">
  
  <div class="container">
    
    <div class="row">
      <!--div class="col-md-12"><h1>Latest Posts</h1></div-->
    </div>
    
  </div>
</div>
<div class="container">
<?php
  $sidebar = new Sidebar();
  if($admin)
    $sidebar->getAdminSidebar();
  else
    $sidebar->getSidebar();
?>
    <div class="col-md-9">
      <?php echo $test->getArticle($admin); ?>
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

<div class="container">
    <div class="row">
        <div class="col-md-3">
           <!-- just a placeholder --> 
        </div>

        <div class="col-md-6"> 
            <!-- comment form--> 
            <div class="row"> 
                <div class="col-md-12" style="background-color:whitesmoke; border-radius: 10px;">
                    <!--form action="<?php /*echo htmlentities( $_SERVER['PHP_SELF'] )."?suffix=".htmlentities( $_GET["suffix"] );*/?>" onsubmit="onsubmit()" id="commentForm" method="post" enctype="multipart/form-data" required-->
                    <form id="commentForm" method="post" enctype="multipart/form-data" required>
                        <h3>Leave a comment</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <input id="name" class="form-control" type="text" name="userName" maxlength="25" placeholder="Name" required/>
                            </div>
                            <div class="col-md-6">
                                <input id="email" class="form-control" type="text" name="userEmail" maxlength="50" placeholder="Email" required/>
                                <br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="comment" class="form-control" type="text" name="userComment" maxlength="2000" rows="5" placeholder="Comment" required></textarea>
                                <br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input class="btn btn-primary pull-right" id="commentButton" type="submit" value="Submit" />
                                <br/>
                            </div>
                        </div>
                        <br/>
                     </form>
                </div>
            </div>

            <div class="row">
                <!-- comments start here-->
                <div class="col-md-12" id="comments">
                    <div class="">
                        <h4>Name</h4>
                        <p>Datum</p>
                        <p>Comment über mehrere Zeilen...</p>
                    </div>
                    <div class="">
                        <h4>Name</h4>
                        <p>Datum</p>
                        <p>Comment über mehrere Zeilen...</p>
                    </div>
                </div>
            </div> <!-- end comments row div-->
        </div>
        
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
