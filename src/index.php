<?php
  if(isset($_GET['page']))
    echo $_GET['page'];
  require_once("Article.php");
  require_once("jsonList.php");
  $list = new jsonList();
  $list->updateList();

  if(isset($_GET['page']))
  {
    $articles = $list->getArticlePage($_GET['page']);
  }
  else
    $articles = $list->getArticlePage(1);

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

<ul class="popular-posts list-unstyled">
<?php
  $tmp = $list->getArray();
  foreach($tmp as $article)
  {
    echo '<li class="row">
                            <div class="col-md-3">
		                    <a class="thumbnail" href="#"><img src="//placehold.it/75x75" alt="Popular Post"></a>
                            </div>
                            <div class="col-md-9"> 
		                    <p class="pull-right"><a href="posts?suffix=' . $article['suffix'] . '">' . $article['title'] . '</a></p>
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
    echo "No Articles click New Post to create one";
  else
  {
    foreach($articles as $article)
    {
    $filename = "articles/" . array_pop($articles)['suffix'] . ".json";
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
  if(!isset($_GET['page']) && $i == 1)
    echo '<li class="active"><a href="?page=' . $i . '">' .$i . '</a></li>';
  else if($_GET['page'] == $i)
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
