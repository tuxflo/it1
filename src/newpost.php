<?php
$edit = false;
$article = null;
if(isset($_GET['edit']))
{
  if($_GET['edit'] === '1' || $GET['edit'] === '0')
    $edit = (bool) $_GET['edit'];
}
if(isset($_GET['suffix']))
{
  $suffix = $_GET['suffix'];
  $article = Article::fromJson("/articles/" . $suffix . ".json");
  echo $suffix;
}
echo $edit ? 'true' : 'false';
?>
<!DOCTYPE html>
<html lang="en">
  <?php include("head.html"); ?>
<body>
    <!-- Navigation -->
  <?php include("nav.html"); ?>
    <!-- Page Content -->
    <div class="container">
    <?php include("postinput.html"); ?>
    </div> <!-- /.container -->

    <?php include("foot_include.html"); ?>
<script type="text/javascript">
var simplemde = new SimpleMDE();
<?php
  if($edit)
    echo 'simplemde.value("' . $article->getText() . '");';
?>
</script>

<script type="text/javascript">
$(document).ready(function() {
    var x_timer;
    $("#url").keyup(function (e){
        clearTimeout(x_timer);
        var url = $(this).val();
        x_timer = setTimeout(function(){
            check_file_exists_ajax(url);
        }, 1000);
    });

function check_file_exists_ajax(url){
    $("#url-result").html('Name already taken');
    $.post('file-checker.php', {'url':url}, function(data) {
      $("#url-result").html(data);
    });
}
});
</script>
</body>

</html>
