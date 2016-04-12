<?php
  require_once("Article.php");
   if($_GET["suffix"]) {
      $filename = './articles/' . $_GET['suffix'] . '.json';
      $test = Article::fromJson($filename);
   }
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
            <table>
            <tr>
              <th>Title</th>
              <th>Date</th>	
            </tr>
            <tr>
              <td>Test_Post 1</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 2</td>
              <td>2016-01-13</td>
            </tr>
            <tr>
              <td>Test_Post 3</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 4</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 5</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 6</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 7</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 8</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 9</td>	
              <td>2016-01-13</td>	
            </tr>
            <tr>
              <td>Test_Post 10</td>	
              <td>2016-01-13</td>	
            </tr>
          </table>
        </div>
      </div>
      
    </div>
    <div class="col-md-9">
      <?php echo $test->getArticle(); ?>
    </div> <!-- col-md-9 --!>
  </div>
</div>
<?php include("foot_include.html"); ?>
</body>
</html>
