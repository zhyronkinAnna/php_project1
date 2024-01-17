<h1>Registration</h1>

<form action="/registration" method="post">
    <div class="mt-3">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email" class="form-control" placeholder="Email">
    </div>

    <?php 
        if (isset($_SESSION['email_err_message'])): ?>
          <small id="emailHelp" class="form-text text-danger"><?= $_SESSION['email_err_message']?></small>
    <?php endif;  unset($_SESSION['email_err_message'])?>   

    <div class="mt-3">
        <label for="password">Password: </label>
        <input type="password" name="password" id="password" class="form-control" placeholder="Password"></input>
    </div>

    <div class="mt-3">
        <label for="password">Confirm password: </label>
        <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="Confirm password"></input>
    </div>

    <?php 
        if (isset($_SESSION['password_err_message'])): ?>
          <small id="fields_help" class="form-text text-danger"><?= $_SESSION['password_err_message']?></small>
          <br>
    <?php endif;  unset($_SESSION['password_err_message'])?>  

    <?php 
        if (isset($_SESSION['err_message'])): ?>
          <small id="fields_help" class="form-text text-danger"><?= $_SESSION['err_message']?></small>
          <br>
    <?php endif;  unset($_SESSION['err_message'])?>  

    <button class="btn btn-primary mt-3" name="action" value="registration">Register</button>
    <br>

   <?php 
        if (isset($_SESSION['message'])): ?>
          <br>
          <small id="success" class="form-text font-weight-bold text-success"><?= $_SESSION['message']?></small>
    <?php endif;  unset($_SESSION['message'])?>   
   
</form> 
   