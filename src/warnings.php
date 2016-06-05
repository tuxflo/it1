<?php
class Warnings {
  public function getNoArticles()
  {
    echo <<<HEREDOC
      <div class="alert alert-warning">
        No articles right now, go to Admin->New Post to create one
      </div>
HEREDOC;
  }
  public function getInvalidPagenumber($pagenumber)
  {
    echo <<<HEREDOC
    <div class="container">
          <div class="alert alert-warning">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Invalid page value:  $pagenumber, redirecting to page 1.
          </div>
    </div>
HEREDOC;
  }

  public function getDeleteConfirmation()
  {
    echo <<<HEREDOC
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">Confirm Delete</h4>
                </div>
                <div class="modal-body">
                    <p>You are about to delete the post <b><i class="title"></i></b>, this procedure is irreversible.</p>
                    <p>Do you want to proceed?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger btn-ok">Delete</button>
                </div>
            </div>
        </div>
    </div>
HEREDOC;
  }
}
