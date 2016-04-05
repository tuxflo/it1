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
    <link rel="stylesheet" href="css/simplemde.min.css">
    <script src="js/simplemde.min.js"></script>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
  <form action="save.php" method="POST" class="form-horizontal" role="form">
    <div class="form-group">
      <label class="control-label text-left col-sm-2" for="title">Title:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control text-left" name="title" id="title" placeholder="Enter title">
      </div>
    </div>
    <div class="form-group has-error ">
      <label class="control-label col-sm-2" for="url">URL:</label>
      <div class="col-sm-10">          
        <input type="text" pattern="[a-z]{3}" required title="only lowercase letters are allowes as url" class="form-control" id="url" name="url" placeholder="Enter url">
<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
<span id="url-result"></span>
      </div>
    </div>
<textarea class="col-lg-12" rows="10" name="text" id="demo1"># Intro
Go ahead, play around with the editor! Be sure to check out **bold** and *italic* styling, or even [links](http://google.com). You can type the Markdown syntax, use the toolbar, or use shortcuts like `cmd-b` or `ctrl-b`.

## Lists
Unordered lists can be started using the toolbar or by typing `* `, `- `, or `+ `. Ordered lists can be started by typing `1. `.

#### Unordered
* Lists are a piece of cake
* They even auto continue as you type
* A double enter will end them
* Tabs and shift-tabs work too

#### Ordered
1. Numbered lists...
2. ...work too!

## What about images?
![Yes](http://i.imgur.com/sZlktY7.png)</textarea>
<input type="submit" value="Save" id="submit" name="submit" class="btn btn-primary pull-right">
</form>
            </div>
        </div>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <script>
    var simplemde = new SimpleMDE();
    </script>

<script type="text/javascript">
$(document).ready(function() {
    var x_timer;    
    $("#url").keyup(function (e){
        clearTimeout(x_timer);
        var url = $(this).val();
        x_timer = setTimeout(function(){
            check_username_ajax(url);
        }, 1000);
    });

function check_username_ajax(url){
    $("#url-result").html('Name already taken');
    $.post('file-checker.php', {'url':url}, function(data) {
      $("#url-result").html(data);
    });
}
});
</script>
</body>

</html>
