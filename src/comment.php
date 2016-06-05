<?php 
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
        
        if (isset(/*$_POST['Submit'],*/ $_POST['userName'], $_POST['userEmail'], $_POST['userComment'])){
            if (strlen($_POST['userName']) > 25 || strlen($_POST['userEmail']) > 50 || strlen($_POST['userComment']) > 2000){
                // print error
                echo "error";
                exit();
            }
        
            $comment = array();
            $comment["name"] = filter_var(trim($_POST['userName']), FILTER_SANITIZE_STRING);
            $comment["email"] = filter_var(trim($_POST['userEmail']), FILTER_SANITIZE_EMAIL);
            $comment["content"] = filter_var(trim($_POST['userComment']), FILTER_SANITIZE_STRING);

            if ($comment["name"] == "" || $comment["content"] == "" || !filter_var($comment["email"], FILTER_VALIDATE_EMAIL)) {
                // print error
                echo "error";
                exit();
            } 

            date_default_timezone_set("UTC");
            $comment["date"] = date('Y-m-d H:i:s');
            // TODO: write comment into json

            echo json_encode($comment);
            return; 
        }
        echo "error";
    }

// http://getbootstrap.com/examples/blog/
// https://jonsuh.com/blog/jquery-ajax-call-to-php-script-with-json-return/

?>
