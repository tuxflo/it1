<!-- includes and head -->
<?php include("head.php");
   if(isset($_GET["suffix"])) {
      $filename = './articles/' . htmlentities($_GET['suffix']) . '.json';
      $test = Article::fromJson($filename);
   }
?>

<body>

<script language="JavaScript" type="text/javascript">
    $("document").ready(function(){
        $("#commentForm").submit(function(event) {
            event.preventDefault(); // Prevent the form from submitting via the browser

            var form = $(this);
            //$("#comments").prepend(form.serialize());
            request = $.ajax({
                type: form.attr('method'),
                url:  form.attr('action'),
                data: form.serialize()
            }).done(function(data){
                if (data != "error"){
                    var comment = JSON.parse(data);
                    var commentHTML ="<div><h4>" 
                                                +comment["name"] +" " +"<small>" +comment["date"] +"</small>"
                                         +"</h4>"
                                         +"<p>" +comment["content"] +"</p>" 
                                    +"</div>";   
                $("#comments").prepend(commentHTML);
                }
                alert("Invalid form data. Please enter your name, a vaild email address and your comment before submitting.");
                //$("#comments").prepend(data);
                //alert("Comment submitted successfully.");
            }).fail(function(data){
                alert("Error sending comment.");
            });
        });
    });
</script>

    <!-- Navigation -->
<?php include("nav.php"); ?>
    <!-- Page Content -->
<div class="row-fluid top30 pagetitle">
  
  <div class="container">
    
    <div class="row">
      <!--div class="col-md-12"><h1>Latest Posts</h1></div-->
    </div>
    
  </div>
</div>
<div class="container">
<?php $sidebar->getSidebar($admin); ?>
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
                    <form id="commentForm" action="./comment.php?"<?php echo"suffix=" .htmlentities($_GET["suffix"]); ?>       method="post" enctype="multipart/form-data" required>
                        <h3>Leave a comment</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <input id="userName" class="form-control" type="text" name="userName" maxlength="25" placeholder="Name" required/>
                            </div>
                            <div class="col-md-6">
                                <input id="userEmail" class="form-control" type="text" name="userEmail" maxlength="50" placeholder="Email" required/>
                                <br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea id="userComment" class="form-control" type="text" name="userComment" maxlength="2000" rows="5" placeholder="Comment" required></textarea>
                                <br/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input id="commentButton" class="btn btn-primary pull-right" type="submit" value="Submit" />
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
