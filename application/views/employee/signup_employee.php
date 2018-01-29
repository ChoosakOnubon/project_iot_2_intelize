
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>create account employee</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>



<div class="col-lg-5 col-lg-offset-2">
  <h1>Create Employee Account</h1>

  <?php if(isset($_SESSION['success'])){  ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php } ?>
  <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>


  <form action="" method="post">
      <div class="form-group">
        <label for="firstname_employee" >FIRST NAME</label>
        <input type="text" name="firstname_employee" value="" class="form-control">
      </div>


      <div class="form-group">
        <label for="lastname_employee" >LAST NAME</label>
        <input type="text" name="lastname_employee" value="" class="form-control">
      </div>

      <div class="form-group">
        <label for="username_employee" >USER NAME</label>
        <input type="text" name="username_employee" value="" class="form-control">
      </div>

      <div class="form-group">
        <label for="password_employee" >PASSWORD</label>
        <input type="password" name="password_employee" value="" class="form-control">
      </div>

      <div class="form-group">
        <label for="password_employee" >CONFIRM PASSWORD</label>
        <input type="password" name="password_employee2" value="" class="form-control">
      </div>

      <div >
        <button class="btn btn-primary" name="create_account">Create Account</button>
        <button class="btn btn-default" name="cancel">Cancel</button>
        <button class="btn btn-info" name="login">Login</button>
      </div>
  </form>


</div>










    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
