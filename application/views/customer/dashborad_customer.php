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

<!--Show clound data-->
    <script>
      var data_Temperature;
      var clientId = "ws" + Math.random();
      // Create a client instance
      var client = new Paho.MQTT.Client("m13.cloudmqtt.com", 34360, clientId);
      // set callback handlers
      client.onConnectionLost = onConnectionLost;
      client.onMessageArrived = onMessageArrived;
      // connect the client
      var options =
      {
        useSSL: true,
        userName: "aiyggeal",
        password: "avTdlGGGbqiM",
        onSuccess:onConnect,
        onFailure:doFail
      };
      // connect the client
      client.connect(options);
      // called when the client connects
      function onConnect()
      {
        // Once a connection has been made, make a subscription and send a message.
        console.log("onConnect");
        //alert("connected");
        client.subscribe("/DHT");
      }

      function doFail(e)
      {
        console.log(e);
      }

      // called when the client loses its connection
      function onConnectionLost(responseObject)
      {
        if (responseObject.errorCode !== 0)
        {
           console.log("onConnectionLost:"+responseObject.errorMessage);
         }
      }

        // called when a message arrives
      function onMessageArrived(message)
      {
         data_Temperature = message.payloadString;
        var Temperature = document.getElementById("Temperature");
        Temperature.innerHTML = data_Temperature;
      }

      function sendMsg(commandbyNimit)
      {
        command = new Paho.MQTT.Message(commandbyNimit);
        command.destinationName = "/CT";
        client.send(command);
      }

    </script>
<!--Show date time-->
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

        document.getElementById('time_now').innerHTML =h + ":" + m + ":" + s;

        var t = setTimeout(startTime, 500);
      }

      function checkTime(i)
      {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
        return i;
      }
    </script>
<!--Stopwatch timer-->
    <script>
      count=(60*30);
        CCOUNT=count;
    </script>
    <script>
      var t;
      var count ;//set from database
      var CCOUNT;//set from database
      var result;
      var minutes2;
      var sec2;
      function cddisplay()
      {
        var minutes = parseInt(count/60);
        var sec = parseInt(count % 60);


        if(minutes<10)
        {
          minutes2='0'+minutes;
        }
        else
        {
          minutes2=minutes;
        }

        if(sec<10)
        {
          sec2='0'+sec;
        }
        else
        {
          sec2=sec;
        }
        result =  minutes2 + ':' + sec2; //formart seconds into 00:00
        if(count < 1)
        {
          document.getElementById('output').innerHTML = "Down";
          //element.innerHTML += '<a href="#">Click here now</a>';
        }
        else
        {
          document.getElementById('output').innerHTML = result;
        }
      }

      function countdown()
      {
        // starts countdown
        cddisplay();
        if (count === 0)
        {
          // time is up
        }
        else
        {
          count--;
          t = setTimeout(countdown, 1000);
          //alert(data_Temperature);

    /*      var Temperature = data_Temperature;
          var Temperature_human = $('#Temperature_human').val();
          var active_time = result;
          var totle_time = result;

*/



          var request = $.ajax({

              url: '<?php echo base_url(); ?>index.php/customer/log_heat_service',
              data: {

                Temperature:data_Temperature,
                Temperature_human:data_Temperature,
                active_time:result,
                totle_time:result


              },
              method: "POST"

          });
          request.done(function() {
              // Do something after its done.
              //alert('start');



          });


        }
      }

      function cdpause()
      {
        // pauses countdown
        clearTimeout(t);
      }

      function cdreset()
      {
        // resets countdown
        cdpause();
        count = CCOUNT;
        cddisplay();
      }
    </script>
<!--realtime database-->
    <script>

      setInterval(   // 1000 = 1 second
        //showAllEmployee();
        //alert('data');
        function showAllEmployee() {
          $.ajax({
            type:'ajax',
            url:'<?php echo base_url(); ?>index.php/customer/get_use_log',

            dataType:'json',
            success: function(data){
              //console.log(data);
              //alert(data_Temperature);
              var html ='';

              for (var i = 0; i < data.length; i++) {
                  html += '<tr>'+
                            '<td>'+data[i].date_log+'</td>'+
                            '<td>'+data[i].start_time+'</td>'+
                            '<td>'+data[i].stop_time+'</td>'+
                            '<td>'+data[i].max_temp+'</td>'+

                            '<td>'+data[i].low_temp+'</td>'+

                            '<td>'+data[i].active_time+'</td>'+
                            '<td>'+data[i].break_time+'</td>'+
                            '<td>'+data[i].totle_time+'</td>'+

                          '</tr>';
              }
              $('#showdata').html(html);
            },
            error: function(){
              //alert('error');
            }
          });
        },1000);
    </script>





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
          <a class="navbar-brand" href="">Dashboard Customer</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li></li>
            <li></li>
            <li ><?php echo anchor("index.php/customer/edit",
                                        "( Your ID is " . $_SESSION['id_customer']
                                        ."&nbsp;)&nbsp;".$_SESSION['f_name_customer']
                                        ."&nbsp;". $_SESSION['l_name_customer']
                                        ) ; ?></li>

            <li><?php echo anchor("index.php/customer/logout_customer","Logout") ; ?></li>
          </ul>
        </div>
      </div>
    </nav>
  <!-- nav-->
    <div class="container">


      <div class="col-sm-12  col-md-12 main">
          <!--<h1 class="page-header">Dashboard</h1>-->
        <h3 class="page-header"><span id="clockDisplay" >N/A</span></h3>


            <input type="hidden" id="time_now" name="time_now" value="" >




          <!-- 33333333333333333333333333333333333333333333333333333333333-->
          <div class="row placeholder">
            <!-- 111111111111111111111111111111111111111111111111111111111-->
              <div class="col-sm-8 col-md-8">

                <div class="col-xs-4 col-sm-4 placeholder">
                  <h1><span id="Temperature" name="Temperature" style="font-size:60px;">00.00</span></h1>
                  <span class="text-muted ">Celsius Heater</span>
                </div>

                <div class="col-xs-4 col-sm-4 placeholder">
                  <h1><span id="Temperature_human" name="Temperature_human" style="font-size:60px;">00.00</span></h1>
                  <span class="text-muted ">Celsius Human</span>
                </div>

                <div class="col-xs-4 col-sm-4 placeholder">
                  <h1><span id="output" style="font-size:60px; ">00:00</span></h1>
                  <script>//countDown(600,"status");</script>
                  <span class="text-muted ">Minute</span>
                </div>
              </div>
              <!-- 111111111111111111111111111111111111111111111111111111111-->
              <!-- 2222222222222222222222222222222222222222222222222222222222-->
              <div class="col-sm-4 col-md-4">
                <!-- 2-->

                <div class="row ">
                    <div class="alert alert-success" role="alert">
                        <a href="#" class="alert-link" id="test1">
                            Show Status All Detect
                        </a>

                      </div>
                </div>

                <div class="row placeholder">

                    <button id="start" name="start" class="btn btn-success" onclick="">START</button>
                    <button id="pause" name="pause" class="btn btn-warning" onclick="">PAUSE</button>
                    <button id="stop"  name="stop"  class="btn btn-danger"  onclick="">STOP</button>
                    <button id="up"    name="up"    class="btn btn-primary" onclick="">UP</button>
                    <button id="down"  name="down"  class="btn btn-info"    onclick="">DOWN</button>


                </div>









<script>
var chech_status_update_temp = 0;

$('#start').click(function() {
  var room = $('#select_room').val();
    var request = $.ajax({
        url: '<?php echo base_url(); ?>index.php/customer/start_heat_service',
        data: {
          room:room,
          status:"1"
         },
        method: "POST"
    });

    request.done(function() {
        // Do something after its done.
        //alert('start');
        countdown();
        sendMsg('START');
/*
        document.getElementById("start").disabled = true;
        document.getElementById("pause").disabled = false;
        document.getElementById("stop").disabled = false;
        document.getElementById("up").disabled = false;
        document.getElementById("down").disabled = false;
*/

    });

 });
var cc=0;
 $('#pause').click(function() {
     var request = $.ajax({
         url: '',//'<?php echo base_url(); ?>index.php/customer/stop_heat_service',
         data: { label: "value" },
         method: "POST"
     });

     request.done(function() {
         // Do something after its done.
         //alert('start');

         sendMsg('PAUSE');
         //$('#form_control_service').attr('action','<?php echo base_url() ?>index.php/customer/stop_heat_service');


         if (cc==0) {
           document.getElementById('pause').innerHTML = "Resum";
           cc=1;
           cdpause();
           /*
           document.getElementById("start").disabled = true;
           document.getElementById("pause").disabled = false;
           document.getElementById("stop").disabled = true;
           document.getElementById("up").disabled = true;
           document.getElementById("down").disabled = true;
           */
         }else {
           document.getElementById('pause').innerHTML = "PAUSE";
           cc=0;
           countdown();

           /*
           document.getElementById("start").disabled = true;
           document.getElementById("pause").disabled = false;
           document.getElementById("stop").disabled = false;
           document.getElementById("up").disabled = false;
           document.getElementById("down").disabled = false;
           */
         }








     });
  });

 $('#stop').click(function() {
     var request = $.ajax({
         url: '<?php echo base_url(); ?>index.php/customer/stop_heat_service',
         data: { status:"2" },
         method: "POST"
     });

     request.done(function() {
         // Do something after its done.
         //alert('start');
         sendMsg('STOP');
         //$('#form_control_service').attr('action','<?php echo base_url() ?>index.php/customer/stop_heat_service');
         cdreset()
         /*
         document.getElementById("start").disabled = false;
         document.getElementById("pause").disabled = true;
         document.getElementById("stop").disabled = true;
         document.getElementById("up").disabled = true;
         document.getElementById("down").disabled = true;
         */
     });
  });


  $('#up').click(function() {
      var request = $.ajax({
          url: '',//'<?php echo base_url(); ?>index.php/customer/stop_heat_service',
          data: { label: "value" },
          method: "POST"
      });

      request.done(function() {
          // Do something after its done.
          //alert(data_Temperature);



          //$('#output').val()
          sendMsg('UP');
          //$('#form_control_service').attr('action','<?php echo base_url() ?>index.php/customer/stop_heat_service');
/*
          document.getElementById("start").disabled = true;
          document.getElementById("pause").disabled = false;
          document.getElementById("stop").disabled = false;
          document.getElementById("up").disabled = false;
          document.getElementById("down").disabled = false;

          */



      });
   });

   $('#down').click(function() {
       var request = $.ajax({
           url: '',//'<?php echo base_url(); ?>index.php/customer/stop_heat_service',
           data: { label: "value" },
           method: "POST"
       });

       request.done(function() {



           // Do something after its done.

           sendMsg('DOWN');
           //$('#form_control_service').attr('action','<?php echo base_url() ?>index.php/customer/stop_heat_service');

/*
           document.getElementById("start").disabled = true;
           document.getElementById("pause").disabled = false;
           document.getElementById("stop").disabled = false;
           document.getElementById("up").disabled = false;
           document.getElementById("down").disabled = false;

  */




       });
    });








</script>
                <div class="row">
                  <div class="col-sm-5 col-md-5">
                    <label for="select_room" >
                      <h4>Select Room</h4>


                    </label>




                  </div>
                  <div class="col-sm-4 col-md-4">
                    <select class="form-control text-center" name="select_room" id="select_room">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select>
                  </div>
                  <div class="col-sm-3 col-md-3">
                    <button type="button"  id="confirm" class="btn btn-success" onClick="js_popup('test2.php',783,600); return false;" >Confirm</button>
                  </div>
                </div>
              </div>
            <!-- 2222222222222222222222222222222222222222222222222222222222-->
          </div>
          <!-- 33333333333333333333333333333333333333333333333333333333333-->
          <!--table-->
          <div class="row placeholders">
            <div class="col-sm-12 col-md-12">
                <h4 class="sub-header text-left">Resent Data Customer</h4>
                  <!--<span id="clockDisplay" >N/A</span>-->
                  <!--<h3><span id="clockDisplay" >N/A</span></h3>-->
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                          <th><p class="text-center">ปี-เดือน-วัน</p></th>
                          <th><p class="text-center">เริ่ม</p></th>
                          <th><p class="text-center">สิ้นสุด</p></th>
                          <th><p class="text-center">อุณหภูมิฮีตเตอร์</p></th>
                          <th><p class="text-center">อุณหภูมิผู้ใช้</p></th>
                          <th><p class="text-center">อยู่ไฟ(นาที)</p></th>
                          <th><p class="text-center">พัก(นาที)</p></th>
                          <th><p class="text-center">รวม(นาที)</p></th>
                        </tr>
                    </thead>
                    <tbody id="showdata">

                    <?php //foreach ($query_dashborad_customer as $key ): ?>
                      <!--<tr>
                        <td><p class="text-center"><?php //echo $key->date_log; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->start_time; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->stop_time; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->max_temp; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->low_temp; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->active_time; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->break_time; ?></p></td>
                        <td><p class="text-center"><?php //echo $key->totle_time; ?></p></td>
                      </tr>-->
                    <?php //endforeach; ?>

                    </tbody>
                  </table>
                </div>
            </div>
          </div>
          <!--table-->
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
  </body>
</html>
