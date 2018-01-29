<?php

class customer_models extends CI_Model {

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
  }



  public function login_customer($user='',$pass='')
  {
    $this->db->select('*');
    $this->db->from('user');
    $this -> db -> where(array('user_login'=> $user,'password_login'=> $pass));
    $query = $this->db->get();

    return $query->row();
  }



        public function dashborad_customer($id_user)
        {


          $this->db->select('*');
          $this->db->from('log_user');
          $this->db->where('id_user', $id_user);
          $query = $this->db->get();

          if ($query->num_rows() > 0 ) {
            return $query->result();
          }else {
            return false;
          }



        }

        public function update_customer($id_user)
        {

                $this->f_name    = $_POST['firstname_customer'];
                $this->l_name  = $_POST['lastname_customer'];
                $this->can_date    = $_POST['dtp_customer'];
                $this->course  = $_POST['select_Course'];
                $this->name_doctor    = $_POST['Doctor_customer'];
                $this->user_login  = $_POST['username_customer'];
                $this->password_login    = $_POST['password_customer'];
                $this->db->update('user', $this, array('id_user' => $id_user));
        }

/*
pause
stop
up
down
*/
    public function update_log_user_start($id_user='',$room='',$status='')
    {
      // อัพเดท ตาราง log_user active_time ทุก1นาที ,totle_time ทุกนาที่ ,start_time = เวลาปัจุบัน where date_log=วันนี่  และ id_user=id_user

      $datestring = '%Y-%m-%d';
      $time = time();
      $date_now = mdate($datestring, $time);

      $datestring = '%H:%i:%s';
      $time = time();
      $time_now = mdate($datestring, $time);

      $this->start_time    = $time_now;
      $this->room  = $room;
      $this->status = $status;
      $this->db->update('log_user', $this, array('id_user' => $id_user,'date_log' => $date_now));


    }

    public function update_log_user_pause($value='')
    {
      // อัพเดท ตาราง log_user break_time ทุก1นาที ,totle_time ทุกนาที่  where date_log=วันนี่  และ id_user=id_user
    }

    public function update_log_user_stop($id_user='',$status='')
    {
      // อัพเดท ตาราง log_user stop_time = เวลาปัจุบัน where date_log=วันนี่  และ id_user=id_user


      $datestring = '%Y-%m-%d';
      $time = time();
      $date_now = mdate($datestring, $time);

      $datestring = '%H:%i:%s';
      $time = time();
      $time_now = mdate($datestring, $time);

      $this->stop_time    = $time_now;
      $this->status = $status;
      $this->db->update('log_user', $this, array('id_user' => $id_user,'date_log' => $date_now));


    }

    public function update_log_user_up($value='')
    {
      // อัพเดท ตาราง log_user temp_now>max_temp where where date_log=วันนี่  และ id_user=id_user
    }

    public function update_log_user_down($value='')
    {
      // อัพเดท ตาราง log_user temp_now<low_temp where where date_log=วันนี่  และ id_user=id_user
    }


    public function update_log_user($id_user='',$Temperature='',$Temperature_human='',$active_time='',$totle_time='')
    {
      // อัพเดท ตาราง log_user temp_now<low_temp where where date_log=วันนี่  และ id_user=id_user
      $datestring = '%Y-%m-%d';
      $time = time();
      $date_now = mdate($datestring, $time);

      $this->max_temp    = $Temperature; // please read the below note
      $this->low_temp  = $Temperature_human;
      $this->active_time    = $active_time; // please read the below note
      $this->totle_time    = $totle_time; // please read the below note


      $this->db->update('log_user', $this, array('id_user' => $id_user,'date_log' => $date_now));
    }





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

        $query="select * from log_user where date_log='2017-04-18' and id_user=16"
*/
}
 ?>
