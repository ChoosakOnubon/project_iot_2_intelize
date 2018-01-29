<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!--<meta name="description" content="">-->
    <!--<meta name="author" content="">-->
    <!--<link rel="icon" href="../../favicon.ico">-->

    <title>Dashboard Employee</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" media="screen">
    <link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(); ?>assets/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!--<script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/mqttws31.js" type="text/javascript"></script>





<!--show date time now-->
  <script>
    function startTime()
    {
      var today = new Date();

      var thday = new Array ("อาทิตย์","จันทร์",
      "อังคาร","พุธ","พฤหัส","ศุกร์","เสาร์");
      var thmonth = new Array ("มกราคม","กุมภาพันธ์","มีนาคม",
      "เมษายน","พฤษภาคม","มิถุนายน", "กรกฎาคม","สิงหาคม","กันยายน",
      "ตุลาคม","พฤศจิกายน","ธันวาคม");

      var y = today.getFullYear();
      var mo = today.getMonth();
      var da = today.getDay();
      var dt = today.getDate();


      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);





      document.getElementById('clockDisplay').innerHTML =
      "วัน" + thday[da]+ "ที่ "+ dt
      + " " + thmonth[mo]+ " พ.ศ." + (y+543) +" เวลา " +

      h + ":" + m + ":" + s +" น.";



      var t = setTimeout(startTime, 500);
    }

    function checkTime(i)
    {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
    }
  </script>

<!--real time database room now in use-->
<script>



  setInterval(   // 1000 = 1 second
    //showAllEmployee();
    //alert('test');
    function showAllEmployee() {
      $.ajax({
        type:'ajax',
        url:'<?php echo base_url(); ?>index.php/employee/json_dashborad_employee',

        dataType:'json',
        success: function(data){
          console.log(data);
          var html ='';

          for (var i = 0; i < data.length; i++) {
              html += '<tr>'+

                        '<td><p class="text-center">'+data[i].room+'</p></td>'+
                        '<td><p class="text-center">'+data[i].f_name+'&nbsp;'+data[i].l_name+'</p></td>'+

                        '<td><p class="text-center">'+data[i].course+'</p></td>'+
                        '<td><p class="text-center">'+data[i].start_time+'</p></td>'+

                        '<td><p class="text-center">'+data[i].stop_time+'</p></td>'+
                        '<td><p class="text-center">'+data[i].max_temp+'</p></td>'+
                        '<td><p class="text-center">'+data[i].low_temp+'</p></td>'+
                        '<td><p class="text-center">'+data[i].active_time+'</p></td>'+
                        '<td><p class="text-center">'+data[i].break_time+'</p></td>'+

                        '<td><p class="text-center">'+data[i].totle_time+'</p></td>'+
                        '<td><p class="text-center">'+data[i].name_doctor+'</p></td>'+

                      '</tr>';
          }
          $('#showdata').html(html);
        },
        error: function(){
          //alert('Lost Connect From Database');
        }
      });
    }

    ,1500);


    function show_dashborad_schedule(dateschedule='') {

         $.ajax({
           type:'ajax',
           url:'<?php echo base_url(); ?>index.php/employee/json_dashborad_schedule',
           data: {
             dateschedule:dateschedule
            },
           dataType:'json',
           success: function(data){
             //console.log(data);
             var html ='';

             for (var i = 0; i < data.length; i++) {
                 html += '<tr>'+

                           '<td><p class="text-center">'+data[i].date_log+'</p></td>'+
                           '<td><p class="text-center">'+data[i].f_name+'</p></td>'+

                           '<td><p class="text-center">'+data[i].l_name+'</p></td>'+
                           '<td><p class="text-center">'+data[i].course+'</p></td>'+

                           '<td><p class="text-center">'+data[i].name_doctor+'</p></td>'+
                           '<td><p class="text-center">send</p></td>'+


                         '</tr>';
             }
             $('#showdata_schedule').html(html);
           },
           error: function(){
             //alert('Lost Connect From Database');
           }
         });
       }








</script>












<?php


$token = 'kqS82exQY0EGg1bKQT35UEuCLehvbYPPJmEumvQXgbw';
function send_line_notify($message, $token)
{
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
  curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt( $ch, CURLOPT_POST, 1);
  curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message");
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
  $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", );
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
  $result = curl_exec( $ch );
  curl_close( $ch );

  return $result;
}



?>

<?php
$message = 'ทดสอบข้อความจากระบบ by ตู่';
//send_line_notify($message, $token);

?>












  </head>

  <body onload="startTime()">


    <!-- nav-->
    <nav class="navbar navbar-default navbar-fixed-top ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Dashboard Employee</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"></a></li>
            <li><?php //echo anchor("index.php/employee/test","test") ; ?></li>
            <li><?php echo anchor("index.php/employee/edit", $_SESSION['f_name_employee']."&nbsp;". $_SESSION['l_name_employee']) ; ?></li>
            <li><?php echo anchor("index.php/employee/logout_employee","Logout") ; ?></li>
          </ul>
        </div>
      </div>
    </nav>
  <!-- nav-->
    <div class="container">
      <div class="col-sm-12  col-md-12 main">
          <!--<h1 class="page-header">Dashboard</h1>-->
        <h3 class="page-header"><span id="clockDisplay" >N/A</span></h3>
        <div class="row">
          <div class="col-sm-12 col-md-12">
<!--********************************************nav tab strart********************************************-->
<!--********************************************nav tab head strat********************************************-->
                <ul class="nav nav-tabs">

            			<li class="active">
                    <a  href="#1" data-toggle="tab">Main</a>
            			</li>

            			<li><a href="#2" data-toggle="tab">Schedule</a>
            			</li>

            			<li><a href="#3" data-toggle="tab">History</a>
            			</li>
            		</ul>
<!--********************************************nav tab head end********************************************-->

<!--********************************************nav tab content strat********************************************-->
            			<div class="tab-content ">


            			  <div class="tab-pane active" id="1">
                      <h3>Room In Use</h3>



                                          <!--table-->
                                          <div class="row ">

                                            <div class="col-sm-12 col-md-12">
                                              <div class="table-responsive">
                                              <table class="table table-striped" id="myTable">
                                                  <thead>
                                                    <tr>

                                                      <th><p class="text-center">ห้อง</p></th>
                                                      <th><p class="text-center">ซื่อ-สกุล</p></th>

                                                      <th><p class="text-center">course</p></th>
                                                      <th><p class="text-center">เวลาเริ่ม</p></th>
                                                      <th><p class="text-center">เสร็จเวลา</p></th>
                                                      <th><p class="text-center">อุณหภูมิฮีตเตอร์</p></th>
                                                      <th><p class="text-center">อุณหภูมิผู้ใช้</p></th>
                                                      <th><p class="text-center">อยู่ไฟ(นาที)</p></th>
                                                      <th><p class="text-center">พัก(นาที)</p></th>
                                                      <th><p class="text-center">รวม(นาที)</p></th>
                                                      <th><p class="text-center">แพทย์</p></th>

                                                    </tr>
                                                  </thead>
                                                  <tbody id="showdata"></tbody>

                                              </table>
                                            </div>
                                            </div>
                                          </div>





            				</div>




            				<div class="tab-pane" id="2">
                      <h3>Service Schedule</h3>
                      <div class="row ">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group" >
                              <div class="input-group date form_date " id="dtp_employee_schedule2"  name="dtp_employee_schedule2" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_employee_schedule" data-link-format="yyyy-mm-dd">
                                <input class="form-control" size="16" type="text"  value="" readonly>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                              </div>
                                <input type="hidden" id="dtp_employee_schedule"  name="dtp_employee_schedule" value="" >
                            </div>
                        </div>

                        <script>

                        $(document).ready(function(){
                          $('#dtp_employee_schedule2').change(function() {
                            var dateschedule = $('#dtp_employee_schedule').val();

                            //var dateschedule = "2017-05-25";


                            var request = $.ajax({
                                url: '<?php echo base_url(); ?>index.php/employee/json_dashborad_schedule',
                                data: {
                                  dateschedule:dateschedule
                                 },
                                method: "POST"
                            });

                              request.done(function() {
                                  // Do something after its done.
                                  //alert('start');

                                  show_dashborad_schedule(dateschedule);
                                  alert(dateschedule);

                              });

                           });







                        });










                        function tt2() {

                          //var dateschedule = $('#dtp_employee_schedule').val();





                        }


                        </script>
                      </div>

                    <!--table-->
                    <div class="row ">

                      <div class="col-sm-12 col-md-12">
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th><p class="text-center">วันที่</p></th>
                                <th><p class="text-center">ชื่อ</p></th>
                                <th><p class="text-center">สกุล</p></th>
                                <th><p class="text-center">Course</p></th>
                                <th><p class="text-center">แพทย์</p></th>
                                <th><p class="text-center">Notification</p></th>
                              </tr>
                            </thead>
                            <tbody id="showdata_schedule">

                        </table>
                      </div>
                      </div>
                    </div>



            				</div>


                    <div class="tab-pane" id="3">
                      <h3>History</h3>

                      <script>
                        function tt() {

                          alert(document.getElementById('dtp_employee_history').value);
                        }
                      </script>


                      <div class="row ">
                        <div class="col-sm-4 col-md-4">
                            <div class="form-group" >
                                <div class="input-group date form_date " onchange="tt()" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_employee_history" data-link-format="yyyy-mm-dd">
                                  <input class="form-control" size="16" type="text"  value="" readonly>
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                  <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                </div>
                                <input type="hidden" id="dtp_employee_history"  name="dtp_employee_history" value="" >
                            </div>
                        </div>
                        <div class="col-sm-5 col-md-5">

                          <button class="btn btn-primary" name="create_account">Serviced</button>
                          <button class="btn btn-primary" name="create_account">Cancle Plan</button>

                          <label><input type="checkbox" value=""> Included In Search</label>
                        </div>

                      </div>

                    <!--table-->
                    <div class="row ">

                      <div class="col-sm-12 col-md-12">
                        <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>วันที่</th>
                                <th>ห้อง</th>
                                <th>ซื่อ-สกุล</th>
                                <th>เริ่ม</th>
                                <th>สิ้นสุด</th>
                                <th>อุณหภูมิฮีตเตอร์</th>
                                <th>อุณหภูมิผู้ใช้</th>
                                <th>อยู่ไฟ(นาที)</th>
                                <th>พัก(นาที)</th>
                                <th>รวม(นาที)</th>
                                <th>แพทย์</th>




                              </tr>
                            </thead>
                            <tbody>

                              <?php if(is_array($query_dashborad_history)){ ?>
                                <?php foreach ($query_dashborad_history as $key ): ?>
                                  <tr>
                                    <td><p class="text-center"><?php echo $key->date_log; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->room ; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->f_name ; ?><?php echo $key->l_name; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->start_time; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->stop_time; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->max_temp; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->low_temp; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->active_time ; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->break_time; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->totle_time; ?></p></td>
                                    <td><p class="text-center"><?php echo $key->name_doctor; ?></p></td>


                                  </tr>
                                <?php endforeach; ?>
                              <?php } ?>


                            </tbody>
                        </table>
                      </div>
                      </div>
                    </div>

            			</div>









<!--********************************************nav tab content end********************************************-->
<!--********************************************nav tab end********************************************-->
          </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"><\/script>')</script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="<?php echo base_url(); ?>assets/js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/locales/bootstrap-datetimepicker.th.js" charset="UTF-8"></script>


<!--show calenda-->
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
