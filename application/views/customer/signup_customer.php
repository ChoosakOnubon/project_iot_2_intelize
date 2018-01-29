
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>create account customer</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="screen">
    <link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
  </head>
  <body>



<div class="col-lg-5 col-lg-offset-2">
  <h1>Create Customer Account</h1>

  <?php if(isset($_SESSION['success'])){  ?>
    <div class="alert alert-success"><?php echo $_SESSION['success']; ?></div>
    <?php } ?>
  <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>


  <form action="" method="post">
      <div class="form-group">
        <label for="firstname_customer" >FIRST NAME</label>
        <input type="text" name="firstname_customer" value="" class="form-control">
      </div>


      <div class="form-group">
        <label for="lastname_customer" >LAST NAME</label>
        <input type="text" name="lastname_customer" value="" class="form-control">
      </div>





      <div class="form-group">
                <label for="dtp_customer">DATE</label>
                <div class="input-group date form_date " data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_customer" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="16" type="text"  value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_customer" name="dtp_customer" value="" >
      </div>




      <div class="form-group">
        <label for="select_Course" >COURSE</label>
        <select class="form-control" name="select_Course" id="select_Course">
          <option value="3">3</option>
          <option value="5">5</option>
          <option value="7">7</option>
        </select>
      </div>



      <div class="form-group">
        <label for="Doctor_customer" >DOCTOR NAME</label>
        <input type="text" name="Doctor_customer" value="" class="form-control">
      </div>



      <div class="form-group">
        <label for="username_customer" >USER NAME</label>
        <input type="text" name="username_customer" value="" class="form-control">
      </div>

      <div class="form-group">
        <label for="password_customer" >PASSWORD</label>
        <input type="password" name="password_customer" value="" class="form-control">
      </div>

      <div class="form-group">
        <label for="password_customer2" >CONFIRM PASSWORD</label>
        <input type="password" name="password_customer2" value="" class="form-control">
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
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/locales/bootstrap-datetimepicker.th.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
    		autoclose: 1,
    		todayHighlight: 1,
    		startView: 2,
    		forceParse: 0,
            showMeridian: 1
        });
    	$('.form_date').datetimepicker({
            language:  'th',
            weekStart: 1,
            todayBtn:  1,
    		autoclose: 1,
    		todayHighlight: 1,
    		startView: 2,
    		minView: 2,
    		forceParse: 0
        });
    	$('.form_time').datetimepicker({
            language:  'th',
            weekStart: 1,
            todayBtn:  1,
    		autoclose: 1,
    		todayHighlight: 1,
    		startView: 1,
    		minView: 0,
    		maxView: 1,
    		forceParse: 0
        });
    </script>
  </body>
</html>
