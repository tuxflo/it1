<?php
require_once("jsonList.php");
function getSidebar()
{
  $list = new jsonList();
  $list->updateList();
  echo '
    <div class="col-md-3">
      <div class="hidden-sm hidden-xs">
        <div class="well">
          <header>
          <h4>Latest articles:</h4>
          </header>
          <ul class="sidebar list-unstyled">';
            $articleArray = $list->getArray();
            foreach($articleArray as $article)
            {
              echo '<li class="row">
                      <div class="col-md-9"> 
                        <p class="pull-right">
                          <a href="posts?suffix=' . $article['suffix'] . '">' . $article['title'] . '</a>
                        </p>
                          <em class="small">Posted on '. date("Y-m-d", $article['date']) . '</em>
                      </div>
                    </li>';
            }
    echo '</ul>
        </div>
      </div>
      
    </div>';
}
  //echo '
  //<div class="col-md-3">
    //<div class="hidden-sm hidden-xs">
    //<div class="well">
    //<header>
    //<h4>Latest articles:</h4>
    //</header>

    //<ul class="sidebar list-unstyled">';
  //foreach($articleArray as $article)
  //{
    //echo '<li class="row">
      //<div class="col-md-3">
      //<a class="thumbnail" href="#"><img src="//placehold.it/75x75" alt="Popular Post"></a>
      //</div>
      //<div class="col-md-9"> 
      //<p class="pull-right"><a href="posts?suffix=' . $article['suffix'] . '">' . $article['title'] . '</a></p>
      //<em class="small">Posted on '. date("Y-m-d", $article['date']) . '</em>
      //</div>
      //</li>';
  //}
  //echo '
      //</ul>
    //</div>
  //</div>
//</div>';
//}
//?>
