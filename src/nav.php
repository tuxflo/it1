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
        <a class="navbar-brand" href="index.php">
          <img src="" alt="">
        </a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
        <li <?php if(!$admin) echo ' class="active"'; ?>>
          <a href="index.php">Home</a>
          </li>
          <li class="dropdown <?php if($admin) echo ' active'; ?> ">
          <a href="index.php?admin=1" class="dropdown-toggle" data-hover="dropdown" data-deley="1000" data-close-others="true" >Admin<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="newpost.php">New Post</a></li>
            <li><a href="edit.php">Edit Post</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="upload.php">Upload Images</a></li>
          </ul>
          </li>
        </ul>
      </div>
    <!-- /.container -->
    </div>
<!-- /.navbar-collapse -->
</nav>
