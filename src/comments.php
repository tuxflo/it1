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

isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
