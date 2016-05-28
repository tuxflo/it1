<div class="container">
    <div class="row">
        <div class="col-md-8">

            <form action="<?php echo htmlentities( $_SERVER['PHP_SELF'] );?>" class="commentForm" method="post" enctype="multipart/form-data" required>
                Leave a comment
                <input id="name" type="text" name="userName" maxlength="25" placeholder="Name" required/>
                <input id="email" type="text" name="userEmail" maxlength="50" placeholder="Email" required/>
                <input id="comment" type="text" name="userComment" maxlength="2000" placeholder="Comment" required/>
                <input class="btn btn-primary" type="submit" value="Submit" />
            </form>

        </div>
    </div>
</div>

<div class="the-return">
  [HTML is replaced when successful.]
</div>


// http://getbootstrap.com/examples/blog/
// https://jonsuh.com/blog/jquery-ajax-call-to-php-script-with-json-return/

<?php 
    
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
    
        if (isset($_POST['Submit'], $_POST['userName'], $_POST['userEmail'], $_POST['userComment'])){
        
            if (strlen($_POST['userName']) > 25 || strlen($_POST['userEmail']) > 50 || strlen($_POST['userComment']) > 2000){
                // print error
                exit();
            }
        
            $comment["name"] = filter_var(trim($_POST['userName']), FILTER_SANITIZE_STRING);
            $comment["email"] = filter_var(trim($_POST['userEmail']), FILTER_SANITIZE_EMAIL);
            $comment["content"] = filter_var(trim($_POST['userComment']), FILTER_SANITIZE_STRING);
        
            if ($comment["name"] == "" || $comment["email"] == "" || !filter_var($comment["content"], FILTER_VALIDATE_EMAIL)) {
                // print error
                exit();
            } 
        }
        $comment["date"] = date('Y-m-d H:i:s');
        // TODO: write comment into json
        
        echo json_encode($comment);
    }
?>

// jQuery.getJSON(url[, data][, success]);
// $('#get-data').click(function() {

<script type="text/javascript">
$("document").ready(function(){
$(".commentForm").submit(function() {
    $.getJSON("./newcomment.php", , function (comment){
        $(".the-return").html(
            // TODO: display comment
            <div class="container">
                <div>
                    <h4>comment["name"]</h2>
                    <p>comment["date"]</p>
                    <p>comment["content"]</p>
                </div>
            </div>
            "Favorite beverage: " + data["favorite_beverage"] + "<br />Favorite restaurant: " + data["favorite_restaurant"] + "<br />Gender: " + data["gender"] + "<br />JSON: " + data["json"]
        );
        //alert("Comment submitted successfully.\n);
    
    });

});

</script>

isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
