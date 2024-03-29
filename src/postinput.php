<div class="row">
            <div class="col-lg-12">
  <form action="save.php" method="POST" class="form-horizontal" role="form">
    <div class="form-group">
      <label class="control-label text-left col-sm-2" for="title">Title:</label>
      <div class="col-sm-10">
      <input type="text" class="form-control text-left" name="title" id="title"
<?php
if($edit)
  echo ' value="' . $article->getTitle() . '" >';
else
  echo 'placeholder="Enter title">';
?>
      </div>
    </div>
    <div class="form-group has-error ">
      <label class="control-label col-sm-2" for="suffix">Suffix:</label>
      <div class="col-sm-10">
      <input type="text" pattern="[a-z].{3}*" required title="only lowercase letters are allowed as Suffix" class="form-control" id="suffix" name="suffix" placeholder="Enter suffix" <?php if($edit) echo 'value="' . $article->getSuffix() . '" readonly'?>>
<span class="glyphicon glyphicon-remove form-control-feedback" aria-hidden="true"></span>
<span id="suffix-result"></span>
      </div>
    </div>
<textarea class="col-lg-12" rows="10" name="text" id="markdown">
<?php if(! $edit)
echo '
# Intro
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
![Yes](http://i.imgur.com/sZlktY7.png)';
?>
</textarea>
<input type="submit" value="Save" id="submit" name="submit" class="btn btn-primary pull-right">
</form>
            </div>
        </div>
