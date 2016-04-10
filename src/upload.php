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
-->
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
      <div class="col-md-12">
    <!-- action refers to the script that will be executed, the entry
    specifies the current file(name) -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
      <div class="input-group">
        <input type="hidden" name="MAX_FILE_SIZE" value="2000000" />
        <input type="file" name="file" />
        <input class="btn btn-primary" type="submit" value="Upload" />
      </div>
    </form>
    <?php
       if (isset($_POST["file"]) && ! $_FILES["file"]["error"]){
         print "file uploading";
         $imginfo = getimagesize($_FILES["file"]["tmp_name"]);
         if ($imginfo){ // file is image
           print "file is image";
           $allowed_mime = array( "image/jpeg" => "jpg", "image/png" => "png", "image/gif" => "gif",);
           if (isset($allowed_mime[$imginfo["mime"]])){
             // delete unallowed characters from filename, add correct mimetype 
             print "file is allowed mime"; $fname = basename($_FILES["file"]["name"]);
             $fname = preg_replace("/\.(jpe?g|gif|png$/i)", "", $fname);
             $fname = preg_replace("/[^a-zA-Z0-9-_]/", "", $fname);
             $path = "img/" . $fname . $imginfo["mime"];
             while (file_exists($path)){
               $fname = $fname . "_1";
               $path = "img/" . $fname . $imginfo["mime"];
             }
             // copy file to img/
             if (move_uploaded_file($_FILES["file"]["tmp_name"], $path)){
               print "fileuploaded successfully";
             }
           }
         }
       } print "error uploading / no file selected";
    ?>
    </div>
    </div>
  </div>
  
  <div class="container">
    
      <?php
        $gallery = glob("img/*.{jpg,gif,png}", GLOB_BRACE);
        foreach ($gallery as $img) {

          $filename = explode('/', $img);
          echo <<<HEREDOC
            <div class="col-md-3">
            <!-- thumbnail element -->
              <div class="thumbnail">
                <img src="$img" width="150px" heigth="120px" alt="$img">
                <div class="caption">
                  <p>$filename[1]</p>
                  <p><a href="#" class="btn btn-primary" role="button">Delete</a></p>
                </div>
              </div>  <!-- thumbnail -->
            </div> <!-- col -->
HEREDOC;
         }
      ?>
    </div> <!-- row -->
  </div>
</div>
<?php include("foot_include.html"); ?>
</body>

</html>

