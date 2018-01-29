<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class customer extends CI_Controller
{
  function __Construct()
  {
    parent::__Construct ();
    //$this->load->model('customer_models');
  }

	public function index()
	{
		$this->load->view('customer/login_customer');
	}

  public function login_customer()
	{
    $this->form_validation->set_rules('login_username_customer','USER NAME','required');
    $this->form_validation->set_rules('login_password_customer','PASSWORD','required|min_length[4]');
    if(isset($_POST['login']))
    {
      if ($this->form_validation->run() == TRUE)
      {
        $user_customer = $this->customer_models->login_customer($_POST['login_username_customer'],$_POST['login_password_customer']);

        if ($user_customer -> id_user)
        {
          $this->session->set_flashdata("success","Your are logged in");
          $_SESSION['user_login_customer']=TRUE;
          $_SESSION['id_customer']=$user_customer->id_user;
          $_SESSION['f_name_customer']=$user_customer->f_name;
          $_SESSION['l_name_customer']=$user_customer->l_name;
          $_SESSION['can_date_customer']=$user_customer->can_date;
          $_SESSION['course_customer']=$user_customer->course;
          $_SESSION['username_customer']=$user_customer->user_login;
          $_SESSION['password_customer']=$user_customer->password_login;
          $_SESSION['name_doctor_customer']=$user_customer->name_doctor;
          redirect("index.php/customer/dashborad_customer","refresh");
        }
        else
        {
          $this->session->set_flashdata("error","No such account exists in database");
          redirect("index.php/customer/login_customer","refresh");
        }
      }
    }
    $this->load->view('customer/login_customer');
  }

  public function get_use_log()
  {
    $re=$this->customer_models->dashborad_customer($_SESSION['id_customer']);
    echo json_encode( $re, JSON_UNESCAPED_UNICODE );
  }

  public function dashborad_customer()
	{
    if (!isset($_SESSION['user_login_customer']))
    {
      $this->session->set_flashdata("error","Please login");
      redirect("index.php/customer/login_customer","refresh");
    }
    else
    {
    //$data['query_login_employee']=$this->employee_models->login_employee($this->input->post("login_username_employee"),$this->input->post("login_password_employee"));
    $data['query_dashborad_customer']=$this->customer_models->dashborad_customer($_SESSION['id_customer']);
    //echo $_SESSION['id_customer'];
    $this->load->view('customer/dashborad_customer',$data);
    //$this->load->view('customer/dashborad_customer');





      // อัพเดท ตาราง log_user active_time ทุก1นาที ,totle_time ทุกนาที่ ,start_time = เวลาปัจุบัน where date_log=วันนี่  และ id_user=id_user





    }




/*

Temperature:document.getElementById('Temperature').value,
Temperature_human:document.getElementById('Temperature_human').value,
active_time:document.getElementById('output').value,
totle_time:document.getElementById('output').value,
room:document.getElementById('select_room').value

*/




  }

  public function signup_customer()
	{
		$this->load->view('customer/signup_customer');
  }

  public function logout_customer()
  {
    session_destroy();
    redirect("index.php/customer/login_customer","refresh");
  }

  public function add()
  {
    if(isset($_POST['create_account']))
    {
      $this->form_validation->set_rules('firstname_customer','FIRST NAME','required');
      $this->form_validation->set_rules('lastname_customer','LAST NAME','required');
      $this->form_validation->set_rules('dtp_customer','DATE','required');
      $this->form_validation->set_rules('select_Course','Course','required');
      $this->form_validation->set_rules('Doctor_customer','DOCTOR NAME','required');
      $this->form_validation->set_rules('username_customer','USER NAME','required');
      $this->form_validation->set_rules('password_customer','PASSWORD','required|min_length[4]');
      $this->form_validation->set_rules('password_customer2','CONFIRM PASSWORD','required|min_length[4]|matches[password_customer]');

      if ($this->form_validation->run() == TRUE)
      {
        // add user in data base
        $ar = array(
        "f_name"=>$this->input->post("firstname_customer"),
        "l_name"=>$this->input->post("lastname_customer"),
        "can_date"=>$this->input->post("dtp_customer"),
        "course"=>$this->input->post("select_Course"),
        "user_login"=>$this->input->post("username_customer"),
        "password_login"=>$this->input->post("password_customer"),
        "name_doctor"=>$this->input->post("Doctor_customer")
        );
        $this->db->insert("user",$ar);



        $this->db->select('*');
        $this->db->from('user');
        $this -> db -> where(array(
                                  'f_name'=> $this->input->post("firstname_customer"),
                                  'l_name'=> $this->input->post("lastname_customer"),
                                  'user_login'=> $this->input->post("username_customer"),
                                  'password_login'=> $this->input->post("password_customer")
                                  ));
        $query = $this->db->get();
        $data_customer=$query->row();




        $dtp_customer_customer=$_POST['dtp_customer'];
        for ($loop_insert_log_customer=0; $loop_insert_log_customer < $data_customer->course ; $loop_insert_log_customer++)
          {
            $sql= "INSERT INTO log_user (
                                        date_log,
                                        max_temp,
                                        start_time,
                                        low_temp,
                                        stop_time,
                                        active_time,
                                        break_time,
                                        totle_time,
                                        status,
                                        room,
                                        id_user

                                        )VALUES(
                                        DATE_ADD('$dtp_customer_customer',INTERVAL ".$loop_insert_log_customer." DAY),
                                        '',
                                         '',
                                         '',
                                         '',
                                         '',
                                         '',
                                         '',
                                         '',
                                         '',
                                         $data_customer->id_user
                                          )";
            $query  = $this->db->query($sql);
          }
          $this->session->set_flashdata("success","Your account has been registered. You can login now");
          redirect("index.php/customer/add","refresh");
        }
      }
      if(isset($_POST['login']))
      {
        redirect("index.php/customer/login_customer","refresh");
      }
      $this->load->view('customer/signup_customer');
  }

  public function edit()
  {
    if(isset($_POST['save_account']))
    {
      $this->form_validation->set_rules('firstname_customer','FIRST NAME','required');
      $this->form_validation->set_rules('lastname_customer','LAST NAME','required');
      $this->form_validation->set_rules('dtp_customer','DATE','required');
      $this->form_validation->set_rules('select_Course','Course','required');
      $this->form_validation->set_rules('Doctor_customer','DOCTOR NAME','required');
      $this->form_validation->set_rules('username_customer','USER NAME','required');
      $this->form_validation->set_rules('password_customer','PASSWORD','required|min_length[4]');
      $this->form_validation->set_rules('password_customer2','CONFIRM PASSWORD','required|min_length[4]|matches[password_customer]');

      if ($this->form_validation->run() == TRUE)
      {
        // update database
        $this->customer_models->update_customer($_SESSION['id_customer']);

        $user_customer = $this->customer_models->login_customer($_POST['username_customer'],$_POST['password_customer']);

        if ($user_customer -> id_user)
        {
          $_SESSION['id_customer']=$user_customer->id_user;
          $_SESSION['f_name_customer']=$user_customer->f_name;
          $_SESSION['l_name_customer']=$user_customer->l_name;
          $_SESSION['can_date_customer']=$user_customer->can_date;
          $_SESSION['course_customer']=$user_customer->course;
          $_SESSION['username_customer']=$user_customer->user_login;
          $_SESSION['password_customer']=$user_customer->password_login;
          $_SESSION['name_doctor_customer']=$user_customer->name_doctor;
        }
        $this->session->set_flashdata("success","Your account has been Update.");
        redirect("index.php/customer/edit","refresh");

      }
    }
    //save_account
    if(isset($_POST['dashborad_customer']))
    {
      redirect("index.php/customer/dashborad_customer","refresh");
    }
    $this->load->view('customer/edit_customer');


  }
















  public function start_heat_service($value='')
  {

    $status=$this->input->post('status');
    $room = $this->input->post('room');

    $this->customer_models->update_log_user_start($_SESSION['id_customer'],$room,$status);

//      redirect("index.php/customer/dashborad_customer");
      $this->load->view('customer/dashborad_customer');
  }
  public function pause_heat_service($value='')
  {

  }
  public function stop_heat_service($value='')
  {
    $status=$this->input->post('status');
    $this->customer_models->update_log_user_stop($_SESSION['id_customer'],$status);
  $this->load->view('customer/dashborad_customer');
  }


  public function up_heat_service($value='')
  {

  }
  public function down_heat_service($value='')
  {

  }
  public function log_heat_service()
  {

//$id_user='',$Temperature='',$Temperature_human='',$active_time='',$totle_time=''



    $Temperature=$this->input->post('Temperature');
    $Temperature_human=$this->input->post('Temperature_human');
    $active_time=$this->input->post('active_time');
    $totle_time=$this->input->post('totle_time');



    $this->customer_models->update_log_user($_SESSION['id_customer'],$Temperature,$Temperature_human,$active_time,$totle_time);

    $this->load->view('customer/dashborad_customer');

  }





}
?>
