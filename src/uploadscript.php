<?php // Image Upload Script
    if (isset($_FILES["f"]) && ($_FILES["f"]["error"] == 0)){
               
        $imginfo = getimagesize($_FILES["f"]["tmp_name"]);

        if ($imginfo){ // file is image
            $allowed_mime = array( "image/jpeg" => "jpg", "image/png" => "png", "image/gif" => "gif",);

            if (isset($allowed_mime[$imginfo["mime"]])){
                // delete unallowed characters from filename, add correct mimetype 
                $fname = basename($_FILES["f"]["name"]); 
                $type = "." . $allowed_mime[$imginfo["mime"]];

                $fname = preg_replace("/\.(jpe?g|gif|png)$/i", "", $fname); 
                $fname = preg_replace("/[^a-zA-Z0-9_-]/", "", $fname); 
                $path = "img/" . $fname . $type;
                
                $count = 2;
                while (file_exists($path)){
                    $tmp = $fname . $count;
                    $path = "img/" . $tmp . $type;
                    $count++;
                }
                       
                // copy file to img/
                if (move_uploaded_file($_FILES["f"]["tmp_name"], $path)){
                    // print "fileuploaded successfully\n";
                }
            }
        }
    }
    header("Location: ./upload.php");
    die();
?>

