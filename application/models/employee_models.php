<?php

class employee_models extends CI_Model
{
  //status 0= not in come service
    //status 1= in use
      //status 2= serviced
  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }

  public function login_employee($user='',$pass='')
  {
    $this->db->select('*');
    $this->db->from('employee');
    $this -> db -> where(array('user_login'=> $user,'password_login'=> $pass));
    $query = $this->db->get();

    return $query->row();
  }

  public function update_employee($id_em='')
  {

    $this->f_name    = $_POST['firstname_employee'];
    $this->l_name  = $_POST['lastname_employee'];
    $this->user_login    = $_POST['username_employee'];
    $this->	password_login  = $_POST['password_employee'];

    $this->db->update('employee', $this, array('id_em' => $id_em));

  }

  public function dashborad_employee()
  {
    $sql="SELECT * from dash_borad";
    $query  = $this->db->query($sql);
    //$query = $this->db->get('dash_borad');
    if ($query->num_rows() > 0 )
    {
      return $query->result();
    }
    else
    {
      return false;
    }
  }
//status 0= not in come service
  public function dashborad_schedule($date='')
  {
    if ($date=='') {
      $datestring = '%Y-%m-%d';
      $time = time();
      $date_1 = mdate($datestring, $time);
    }else {
      $date_1 = $date;
    }

    $sql="SELECT * FROM user AS u INNER JOIN log_user AS l ON (u.id_user=l.id_user )WHERE l.status=0 AND l.date_log='$date_1'";

    $query  = $this->db->query($sql);

    if ($query->num_rows() > 0 )
    {

      return $query->result();
    }
    else
    {
      //return false;
      return $sql;
    }


  }
// check
//status 0= not in come service
//status 2= serviced
  public function dashborad_history($date='',$status='')
  {

    if ($date=='') {
      $datestring = '%Y-%m-%d';
      $time = time();
      $date_1 = mdate($datestring, $time);
    }else {
      $date_1 = $date;
    }

    if ($status == '')
    {
      $status_1  = 2;
    }
    else
    {
      $status_1 = $status;
    }

    //history

    $sql="SELECT user.f_name,user.l_name,user.course,user.name_doctor,log_user.date_log,

                log_user.max_temp,log_user.low_temp,
                log_user.start_time,log_user.stop_time,
                log_user.active_time,log_user.break_time,log_user.totle_time,
                log_user.status,log_user.room,

                dash_borad.next_date,dash_borad.date_check
                  FROM dash_borad,user,log_user

                  WHERE dash_borad.id_log = log_user.id_log
                  AND log_user.id_user=user.id_user
                  AND log_user.date_log='$date_1'
                  AND log_user.status=$status_1

                  ";

    $query  = $this->db->query($sql);
    //print_r($sql);

    if ($query->num_rows() > 0 ) {
      return $query->result();
    }else {
      return false;
    }



/*
    $this->db->select('*');
    $this->db->from('table1');
    $this->db->join('table2', 'table1.id = table2.id');
    $this->db->join('table3', 'table1.id = table3.id');
    $query = $this->db->get();

*/

  }
  //status 3= in use
  public function dashborad_InUse()
  {
    $datestring = '%Y-%m-%d';
    $time = time();
    $date = mdate($datestring, $time);

    $sql="SELECT user.f_name,user.l_name,user.course,user.name_doctor,
                log_user.id_log,
                log_user.date_log,
                log_user.max_temp,log_user.low_temp,
                log_user.start_time,log_user.stop_time,
                log_user.active_time,log_user.break_time,log_user.totle_time,
                log_user.status,log_user.room


                  FROM user,log_user

                  WHERE log_user.id_user=user.id_user

                  AND log_user.date_log='$date'
                  AND log_user.status=1



                  ";

    $query  = $this->db->query($sql);
    //print_r($sql);

    if ($query->num_rows() > 0 ) {
      return $query->result();
    }else {
      return false;
    }
  }





}
 ?>






















 <?php

 /*
         public function insert_entry()
         {
                 $this->title    = $_POST['title']; // please read the below note
                 $this->content  = $_POST['content'];
                 $this->date     = time();

                 $this->db->insert('entries', $this);
         }

         public function update_entry()
         {
                 $this->title    = $_POST['title'];
                 $this->content  = $_POST['content'];
                 $this->date     = time();

                 $this->db->update('entries', $this, array('id' => $_POST['id']));
         }
 */






  ?>
