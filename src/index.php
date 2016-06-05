<!-- includes and head -->
<?php include("head.php"); ?>

<body>
<?php
  $pagenumber = 1;
  if(isset($_GET['page']))
    $pagenumber = $_GET['page'];

  if($pagenumber > $list->getArticleCount() + 1)
  {
    echo <<<HEREDOC
<div class="container">
      <div class="alert alert-warning">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Warning!</strong> Invalid page value:  $pagenumber, redirecting to page 1.
      </div>
</div>
HEREDOC;
    $pagenumber = 1;
  }
?>
    <!-- Navigation -->
<?php include("nav.php"); ?>
    <!-- Page Content -->
<div class="container">
  <div class="row">
  <?php $sidebar->getSidebar($admin); ?>
    <div class="col-md-9">
    <?php
      $articles = $list->getArticlePage($pagenumber);
      if(!$list->getArticleCount())
        $warnings->getNoArticles();
      else
        $list->getPreviewPage($pagenumber, $admin);
      $list->getPagination($pagenumber);
    ?>
    </div> <!-- col-md-9 --!>
  </div>
</div>
<?php include("foot_include.html"); ?>
    <script src="js/deletescript.js"></script>
</body>
</html>
