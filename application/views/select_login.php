<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Select_Login</title>

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

  <div class="row">

    <div class="col-xs-3 col-sm-3">

    </div>

    <div class="col-xs-4 col-sm-4">
      <img src="<?php echo base_url(); ?>assets/pic/logo.jpg" />
    </div>



  </div>
  <div class="row">

    <div class="col-sm-4 col-md-4"></div>

    <div class="col-sm-2 col-md-2">
      <button type="button" class="btn btn-warning btn-lg ">
        <?php echo anchor("index.php/employee/login_employee"," เจ้าหน้าที่ ") ; ?>
      </button>



    </div>

    <div class="col-sm-2 col-md-2">


      <button type="button" class="btn btn-warning btn-lg ">
        <?php echo anchor("index.php/customer/login_customer","บุคคลทั่วไป") ; ?>
      </button>

    </div>











  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
  </body>
</html>
