<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<!--jq/get_data_dashboard_employee-->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.2.1.min.js"></script>


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
          //console.log(data);
          var html ='';

          for (var i = 0; i < data.length; i++) {
              html += '<tr>'+
                        '<td>'+data[i].date_check+'</td>'+
                        '<td>'+data[i].id_user+'</td>'+
                        '<td>'+data[i].next_date+'</td>'+
                        '<td>'+data[i].id_log+'</td>'+
                        '<td>'+data[i].id_em+'</td>'+
                      '</tr>';
          }
          $('#showdata').html(html);
        },
        error: function(){
          //alert('Lost Connect From Database');
        }
      });
    },1000);
</script>


  </head>

  <body>

    <h1>Hello, world!</h1>

    <table class="table table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Header</th>
            <th>Header</th>
            <th>Header</th>
            <th>Header</th>
          </tr>
        </thead>
        <tbody id="_showdata">

        </tbody>
    </table>







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>


  </body>
</html>
