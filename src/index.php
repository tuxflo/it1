<?php
  require_once("Article.php");
  $first = Article::fromJson("articles/2016_04_05_foo.json");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>The next generation Blog engine</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/logo-nav.css" rel="stylesheet">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img src="http://placehold.it/150x50&text=Logo" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Admin<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                      <li><a href="newpost.php">New Post</a></li>
                      <li><a href="#">Edit Post</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">Upload Images</a></li>
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

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
      <hr>
      
      <div class="row">
        <div class="col-sm-4"><a href="#" class=""><img src="http://placehold.it/1280X720" class="img-responsive"></a>
        </div>
        <div class="col-sm-8">
        <h3 class="title"><?php echo $first->getTitle(); ?></h3>
          <p class="text-muted"><span class="glyphicon glyphicon-calendar"></span> July 23, 2014 @ 1:30 PM <span style="float:right"><span class="glyphicon glyphicon-comment"></span> 20</span></p>
          <p>Could artificial intelligence have been used to prevent the high-profile Target breach? The concept is not so far-fetched. Organizations such as Mastercard and RBS WorldPay have long relied on artificial intelligence to detect fraudulent transaction patterns and prevent card.</p>
          
          <p class="text-muted">Presented by <a href="#">Ellen Richey</a></p>
          
        </div>
      </div>
      <hr>
      <?php echo $first->getRow(); ?>
      <hr>

      <ul class="pagination pagination-lg pull-right">
        <li><a href="#">«</a></li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li><a href="#">»</a></li>
      </ul>
      
      
    </div>
  </div>
</div>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
    var x_timer;    
    $("#url").keyup(function (e){
        clearTimeout(x_timer);
        var user_name = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(user_name);
        }, 1000);
    });

function check_username_ajax(username){
    $("#user-result").html('<img src="ajax-loader.gif" />');
    $.post('username-checker.php', {'username':username}, function(data) {
      $("#user-result").html(data);
    });
}
});
</script>
</body>

</html>
