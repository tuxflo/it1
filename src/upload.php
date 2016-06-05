<?php include("head.php"); ?>

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
?>

<?php // delete script
  if (isset($_POST["_DELETE"]) && $_POST["_DELETE"]=='Delete'){
    $img = htmlentities($_POST['img']);
    unlink($img);
    header("Refresh:0");
  }
?>

<body>
    <!-- Navigation -->
<?php include("nav.php"); ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <?php 
                $sidebar->getSidebar(true); 
            ?>

            <div class="col-md-9">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="form-inline" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" /> 
                        <input type="file" name="f" />
                    </div>
                    <div class="form-group">
                        <input class="btn btn-primary pull-right" type="submit" value="Upload" />
                    </div>
                    <br/>
                </form>
                <br/>
            </div>

            <div class="col-md-9">
                <?php // gallery
                    $gallery = glob("img/*.{jpg,gif,png}", GLOB_BRACE);
                    foreach ($gallery as $img) {

                        $filename = explode('/', $img);
                        $tmp = htmlentities($_SERVER['PHP_SELF']);
                        echo <<<HEREDOC
                <div class="col-md-3" id="$filename[1]">
                    <div class="thumbnail">
                        <img src="$img" width="150px" heigth="120px" alt="$img">
                        <form action="$tmp" method="post" enctype="multipart/form-data" onsubmit="return checkDelete('$filename[1]')">
                            <div class="text-center">$filename[1]</div>
                            <div class="form-group">
                                <input type="hidden" name="img" value="$img" />
                                <input class="btn btn-primary center-block" type="submit" name="_DELETE" value="Delete"/>
                            </div>
                        </form>
                    </div>  <!-- thumbnail -->
                </div> <!-- col -->
HEREDOC;
                    }
      ?>
            </div>
        </div>
    </div>

  
<script language="JavaScript" type="text/javascript">
    function checkDelete(file){
        var msg = "You are about to delete the image ";
        msg = msg.concat(file);
        msg = msg.concat(", this procedure is irreversible. Do you want to proceed?")
        return confirm(msg);
    }
</script>

<?php include("foot_include.html"); ?>
</body>


</html>
