<?php
  require_once("Article.php");
  require_once("jsonList.php");
  date_default_timezone_set("UTC");
  $list = new jsonList();
  $list->updateList();

  $pagenumber = 1;
  if(isset($_GET['page']))
    $pagenumber = $_GET['page'];

  if($pagenumber > $list->getArticleCount() + 1)
  {
    echo '<div class="container">
      <div class="alert alert-warning">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Warning!</strong> Invalid page value: ' . $pagenumber . ', redirecting to page 1.
      </div>';
    $pagenumber = 1;
  }
  $articles = $list->getArticlePage($pagenumber);

  //$first = Article::fromJson("articles/" . array_shift($articles)['suffix'] . ".json");
  //$second = Article::fromJson("articles/"  . array_shift($articles)['suffix'] . ".json");
?>
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
      <div class="col-md-12"><h1>Latest Posts</h1></div>
    </div>
    
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      
      <div class="hidden-sm hidden-xs">
        <div class="well">
          
          <header>
          <h4>Latest articles:</h4>
          </header>

<ul class="sidebar list-unstyled">
<?php
  $tmp = $list->getArray();
  foreach($tmp as $article)
  {
    echo '<li class="row">
                            <div class="col-md-9"> 
		                    <p class="pull-right"><a href="posts.php?suffix=' . $article['suffix'] . '">' . $article['title'] . '</a></p>
                            <em class="small">Posted on '. date("Y-m-d", $article['date']) . '</em>
                            </div>
		                </li>';
  }
?>
</ul>
        </div>
      </div>
      
    </div>
    <div class="col-md-9">
<?php
  if(! $list->getArticleCount())
    echo "No Articles right now...";
  else
  {
    foreach($articles as $article)
    {
      $a = array_pop($articles);
    $filename = "articles/" . $a['suffix'] . ".json";
    $tmp = Article::fromJson($filename);
      echo $tmp->getPreview();
      echo "<hr>";
    }
  }
?>
      <ul class="pagination pagination-lg pull-right">
<?php
for($i=1; $i<($list->getArticleCount() /2) +1; $i++)
{
  if($pagenumber == $i)
    echo '<li class="active"><a href="?page=' . $i . '">' . $i . '</a></li>';
  else
    echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
}
?>
      </ul>
    </div> <!-- col-md-9 --!>
  </div>
</div>
<?php include("foot_include.html"); ?>
</body>

</html>
