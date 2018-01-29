
<div class="row placeholders">
  <div class="col-sm-12 col-md-12">
  <h4 class="sub-header text-left">Add Data</h4>
    <div class="table-responsive">
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
      <tbody>
        <tr>
          <td>1,001</td>
          <td>Lorem</td>
          <td>ipsum</td>
          <td>dolor</td>
          <td>sit</td>
        </tr>
        <tr>
          <td>1,002</td>
          <td>amet</td>
          <td>consectetur</td>
          <td>adipiscing</td>
          <td>elit</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>Integer</td>
          <td>nec</td>
          <td>odio</td>
          <td>Praesent</td>
        </tr>
        <tr>
          <td>1,003</td>
          <td>libero</td>
          <td>Sed</td>
          <td>cursus</td>
          <td>ante</td>
        </tr>
        <tr>
          <td>1,004</td>
          <td>dapibus</td>
          <td>diam</td>
          <td>Sed</td>
          <td>nisi</td>
        </tr>
        <tr>
          <td>1,005</td>
          <td>Nulla</td>
          <td>quis</td>
          <td>sem</td>
          <td>at</td>
        </tr>
        <tr>
          <td>1,006</td>
          <td>nibh</td>
          <td>elementum</td>
          <td>imperdiet</td>
          <td>Duis</td>
        </tr>
        <tr>
          <td>1,007</td>
          <td>sagittis</td>
          <td>ipsum</td>
          <td>Praesent</td>
          <td>mauris</td>
        </tr>
        <tr>
          <td>1,008</td>
          <td>Fusce</td>
          <td>nec</td>
          <td>tellus</td>
          <td>sed</td>
        </tr>
        <tr>
          <td>1,009</td>
          <td>augue</td>
          <td>semper</td>
          <td>porta</td>
          <td>Mauris</td>
        </tr>
        <tr>
          <td>1,010</td>
          <td>massa</td>
          <td>Vestibulum</td>
          <td>lacinia</td>
          <td>arcu</td>
        </tr>
        <tr>
          <td>1,011</td>
          <td>eget</td>
          <td>nulla</td>
          <td>Class</td>
          <td>aptent</td>
        </tr>
        <tr>
          <td>1,012</td>
          <td>taciti</td>
          <td>sociosqu</td>
          <td>ad</td>
          <td>litora</td>
        </tr>
        <tr>
          <td>1,013</td>
          <td>torquent</td>
          <td>per</td>
          <td>conubia</td>
          <td>nostra</td>
        </tr>
        <tr>
          <td>1,014</td>
          <td>per</td>
          <td>inceptos</td>
          <td>himenaeos</td>
          <td>Curabitur</td>
        </tr>
        <tr>
          <td>1,015</td>
          <td>sodales</td>
          <td>ligula</td>
          <td>in</td>
          <td>libero</td>
        </tr>
      </tbody>
  </table>
</div>
  </div>
</div>


<script>

function getDataFromDb()
{
  $.ajax({
        type: "POST",
        url: "jq/get_data_dashboard_employee" ,
        data: {'title': title}, // change this to send js object
        dataType: 'json',

      })
      .success(function(result) {
        var obj = jQuery.parseJSON(result);
          if(obj != '')
          {
              //$("#myTable tbody tr:not(:first-child)").remove();
              $("#myBody").empty();
              $.each(obj, function(key, val) {
                  var tr = "<tr>";
                  tr = tr + "<td>" + val["room"] + "</td>";
                  tr = tr + "<td>" + val["id_user"] + "</td>";
                  tr = tr + "<td>" + val["temp_now"] + "</td>";
                  tr = tr + "<td>" + val["time_in"] + "</td>";
                  tr = tr + "<td>" + val["time_out"] + "</td>";
                  tr = tr + "<td>" + val["course"] + "</td>";
                  tr = tr + "<td>" + val["stop_time"] + "</td>";
                  tr = tr + "<td>" + val["next_date"] + "</td>";
                  tr = tr + "<td>" + val["next_time"] + "</td>";
                  tr = tr + "<td>" + val["Buname_doctordget"] + "</td>";



                  tr = tr + "</tr>";
                  $('#myTable > tbody:last').append(tr);
              });
          }

      });

}
/*
//id
room
id_user
temp_now
time_in
time_out
course
stop_time
next_date
next_time
name_doctor
*/
setInterval(getDataFromDb, 10000);   // 1000 = 1 second
</script>
