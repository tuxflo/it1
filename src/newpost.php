<?php include("head.php");?>
<?php
$edit = false;
$article = null;
if(isset($_GET['edit']))
{
  if($_GET['edit'] === '1' || $GET['edit'] === '0')
    $edit = (bool) $_GET['edit'];
}
if(isset($_GET['suffix']) && $edit == true)
{
  $suffix = $_GET['suffix'];
  $article = Article::fromJson("./articles/" . $suffix . ".json");
}
?>
<body>
    <!-- Navigation -->
  <?php include("nav.php"); ?>
    <!-- Page Content -->
    <div class="container">
    <?php include("postinput.php"); ?>
    </div> <!-- /.container -->
<?php include("foot_include.html"); ?>
</body>
<script type="text/javascript">
var simplemde = new SimpleMDE({ element: $("#markdown")[0] });
<?php
if($edit)
{
    echo 'var text = ' . json_encode($article->getText()) . ';';
    echo 'simplemde.value(text);';
}
?>
</script>
<script>
jQuery.fn.extend({
    disable: function(state) {
        return this.each(function() {
            var $this = $(this);
            $this.toggleClass('disabled', state);
        });
    }
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    var x_timer;
    $("#submit").disable(true);
    $("#suffix").keyup(function (e){
        clearTimeout(x_timer);
        var suffix = $(this).val();
        x_timer = setTimeout(function(){
            check_file_exists_ajax(suffix);
        }, 1000);
    });

function check_file_exists_ajax(suffix){
    $.post('file-checker.php', {'suffix':suffix}, function(data) {
      $("#suffix-result").html(data);
      if(data != ''){
        $("#suffix-form").addClass('has-feedback has-error');
        $("#submit").disable(true);
      }
      else
      {
        $("#suffix-form").removeClass('has-feedback has-error');
        $("#suffix-form").addClass('has-feedback has-success');
        $("#submit").disable(false);
      }
    });
}
});
</script>

</html>
