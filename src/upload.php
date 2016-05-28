<!--
    Der Menüeintrag „Edit Post“ und „Upload Picture“ kann auf die selbe
    Unterseite oder auch auf unterschiedliche verweisen. Dort gibt es
    ein Formular zum Upload von Bildern, eine Thumbnail-Galerie aller
    bereits hochgeladenen Bilder sowie einer tabellarischen Liste wie in
    (7). Alle Thumbnails sind mit dem Dateinamen des Bildes beschriftet
    und haben einen Button zum Löschen des Bildes. Zum Upload sind
    nur Bild-Dateien mit einer Größe von max. 2 MB erlaubt. Bilder
    werden in der Originalgröße abgespeichert. Eine automatische
    Skalierung beim Upload ist nicht gefordert, kann aber implementiert
    werden.

    picture url:
    https://upload.wikimedia.org/wikipedia/commons/8/8c/Cole_Thomas_The_Course_of_Empire_The_Arcadian_or_Pastoral_State_1836.jpg
    http://www.publicdomainpictures.net/pictures/160000/velka/under-water-fantasy2.jpg
    http://www.publicdomainpictures.net/pictures/170000/velka/under-water-fantasy5.jpg
-->

<?php 
    require_once("sidebar.php"); 
    date_default_timezone_set("UTC");
?>

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
                
                $count = 0;
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

<!DOCTYPE html>
<html lang="en">

<?php include("head.html"); ?>
<body>
    <!-- Navigation -->
<?php include("nav.html"); ?>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php 
                    $sidebar = new Sidebar();
                    $sidebar->getAdminSidebar(); 
                ?>
            </div>

            <div class="col-md-9">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                    <div class="input-group">
                        <!--<input type="hidden" name="MAX_FILE_SIZE" value="2000000" /> -->
                        <input type="file" name="f" />
                        <input class="btn btn-primary" type="submit" value="Upload" />
                    </div>
                </form>
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
                        <div class="caption">
                            <p>$filename[1]</p>
                            <form action="$tmp" method="post" enctype="multipart/form-data" onsubmit="return checkDelete('$filename[1]')">
                                <input type="hidden" name="img" value="$img" />
                                <input class="btn btn-primary" type="submit" name="_DELETE" value="Delete"/>
                            </form>
                        </div>
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
