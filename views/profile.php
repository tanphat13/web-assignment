<?php
      use app\core\Application;
?>
<div class="box-confirm" id="box-confirm">
    <div class="message-header">
        <h6>Confirm Remove Address</h6>
        <button type="button" class="close-btn" onclick="closeBox()">
        <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-x my-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        </button>
    </div>
    <div class="message" id="message">Do you want to remove this address ?</div>
    <div class="button">
        <button type="button" class="btn btn-warning text-white" id="confirm_button" onclick=""><span class="realign">Yes</span></button>
        <button type="button" class="btn btn-danger text-white" onclick="closeBox()">No</button>
    </div>
</div>
<div class="box-confirm box-form" id="box-form">
      <div class="message-header form-header">
            <h6>Update Personal Info</h6>
            <button type="button" class="close-btn" onclick="closeUpdateBox()">
            <svg width="1.25em" height="1.25em" viewBox="0 0 16 16" class="bi bi-x my-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
            </button>
      </div>
      <form method="POST" action="http://localhost:8000/update-info" class="form-group">
            <div class="personal-info">
                  <div class="row">
                        <label class="col-2 col-form-label" for="name" >Full Name: </label>
                        <div class="col-10">
                              <input type="text" name="name" class="form-control" placeholder="Your full name" value="<?php if (isset($user->fullname)) echo $user->fullname; ?>" />
                        </div>
                  </div>
                  <div class="row">
                        <label class="col-2 col-form-label" for="email" >Email: </label>
                        <div class="col-10">
                              <input type="text" name='email' class="form-control" placeholder="Your email" value="<?php if (isset($user->email)) echo $user->email; ?>" />
                        </div>
                  </div>
                  <div class="row">
                        <label class="col-2 col-form-label" for="phone" >Phone Number: </label>
                        <div class="col-10">                        
                              <input type="text" name='phone' class="form-control" placeholder="Your phone number" value="<?php if (isset($user->phone)) echo $user->phone; ?>" />
                        </div>
                  </div>
            </div>
            <div class="btn-group">
                  <button type="submit" class='btn btn-outline-success'>Update</button>
                  <button type="button" class='btn btn-outline-danger' onclick="closeUpdateBox()">Cancel</button>
            </div>
      </form>
</div>
<div class="container manage-address">
      <h5>Manage Your Address</h5>
      <button class="btn btn-outline-warning edit-btn" onclick="openUpdateForm()">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-pencil-square" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
            </svg>
      </button>
      <div class="container current-address">
            <div class="container personal-info">
                  <div class="row">
                        <p class="col-sm-4">Full Name:</p>
                        <p class="col-sm-8"><?php echo $user->fullname ?></p>
                  </div>
                  <div class="row">
                        <p class="col-sm-4">Email:</p>
                        <p class="col-sm-8"><?php echo $user->email ?></p>
                  </div>
                  <div class="row">
                        <p class="col-sm-4">Phone Number:</p>
                        <p class="col-sm-8"><?php echo $user->phone ?></p>
                  </div>
            </div>
            <h6>Your Address</h6>
            <?php
                  $list_address = "<div class='container address-container'>";
                  for ($index = 1; $index <= count($address); ++$index) {
                        $list_address .= "<div class='address-info' id='address-$index'>
                              <p>" . $address[$index - 1]['address'] . "</p>
                              <button class='btn btn-outline-danger' onclick='confirmRemoveAddress($index, $user->id)'>
                                    <svg width='1em' height='1em' viewBox='0 0 16 16' class='bi bi-trash' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z'/>
                                    <path fill-rule='evenodd' d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z'/>
                                    </svg>
                              </button>
                        </div>";
                  }
                  $list_address .= "</div>";
                  echo $list_address;
            ?>
      </div>
</div>
<div class="container manage-address">
      <h5>Add new address form</h5>
      <form action="http://localhost:8000/add-address" method='post' class='container add-address'>
            <label for="new-address">New Address:</label>
            <textarea type="textarea" name="new-address" id="new-address" placeholder="Input Your New Address" class="input-address"></textarea>
            <button type='submit'  class="btn btn-outline-success">
                  Add
            </button>
      </form>
</div>

