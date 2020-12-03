<h1>Add new address form</h1>
<div class="add-new-address">
      <div class="form-add-new-address">
            Add new address
      </div>
      <form method='post' class='add-address'>
            <?php
                  echo "User: $user->user_id
                  <div class='row'>
                        <span class='col-sm-6'> Address: $user->address</span>
                  </div>";
            ?>
      </form>
</div>

