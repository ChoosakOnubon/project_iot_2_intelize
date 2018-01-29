<div class="">


<table>
<thead>
  <tr>


  <td>id_user</td>
  <td>f_name</td>
  <td>l_name</td>
  <td>can_date</td>
  <td>course</td>
  <td>user_login</td>
  <td>password_login</td>
  <td>name_doctor</td>
</tr>
</thead>
<tbody>
<?php foreach ($query as $key ): ?>
<tr>


  <td><?php echo $key->id_user; ?></td>
  <td><?php echo $key->f_name; ?></td>
  <td>  <?php echo $key->l_name; ?></td>
  <td>  <?php echo $key->can_date; ?></td>
  <td><?php echo $key->course; ?></td>
  <td>  <?php echo $key->user_login; ?></td>
  <td><?php echo $key->password_login; ?></td>
  <td><?php echo $key->name_doctor; ?></td>
</tr>
<?php endforeach; ?>
</tbody>


</table>
</div>
