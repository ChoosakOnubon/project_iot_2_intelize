<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class employee extends CI_Controller {

  function __Construct()
  {
    parent::__Construct ();

    //$this->load->model('employee_models');

  }

	public function index()
	{
		$this->load->view('employee/login_employee');
	}

  public function login_employee()
	{
    $this->form_validation->set_rules('login_username_employee','USER NAME','required');
    $this->form_validation->set_rules('login_password_employee','PASSWORD','required|min_length[4]');

    if(isset($_POST['login']))
    {
      if ($this->form_validation->run() == TRUE)
      {



$user = $this->employee_models->login_employee($_POST['login_username_employee'],$_POST['login_password_employee']);

            if ($user -> id_em)
        {
          $this->session->set_flashdata("success","Your are logged in");
          $_SESSION['user_login_employee']=TRUE;
          $_SESSION['id_employee']=$user->id_em;
          $_SESSION['f_name_employee']=$user->f_name;
          $_SESSION['l_name_employee']=$user->l_name;
          $_SESSION['username_employee']=$user->user_login;
          $_SESSION['password_employee']=$user->password_login;
          redirect("index.php/employee/dashborad_employee","refresh");
        }
        else
        {
          $this->session->set_flashdata("error","No such account exists in database");
          redirect("index.php/employee/login_employee","refresh");
        }
      }
    }
    $this->load->view('employee/login_employee');
	}

  public function logout_employee()
  {
    session_destroy();
    redirect("index.php/employee/login_employee","refresh");
  }

  public function dashborad_employee()
	{
    if (!isset($_SESSION['user_login_employee']))
    {
      $this->session->set_flashdata("error","Please login");
      redirect("index.php/employee/login_employee","refresh");
    }
    else
    {

      //$data['query_dashborad_employee']=$this->employee_models->dashborad_employee();










      $data['query_dashborad_schedule']=$this->employee_models->dashborad_schedule();
      $data['query_dashborad_history']=$this->employee_models->dashborad_history();



      //dashborad_schedule

      //dashborad_history

      $this->load->view('employee/dashborad_employee',$data);





    }
  }



  public function add_dashborad()
	{
		$this->load->view('employee/add_dashborad');
  }

 public function signup_employee()
	{
		$this->load->view('employee/signup_employee');
  }

 public function add()
 {
    if(isset($_POST['create_account']))
    {
      $this->form_validation->set_rules('firstname_employee','FIRST NAME','required');
      $this->form_validation->set_rules('lastname_employee','LAST NAME','required');
      $this->form_validation->set_rules('username_employee','USER NAME','required');
      $this->form_validation->set_rules('password_employee','PASSWORD','required|min_length[4]');
      $this->form_validation->set_rules('password_employee2','CONFIRM PASSWORD','required|min_length[4]|matches[password_employee]');

      if ($this->form_validation->run() == TRUE)
      {
        // add user in data base
        $ar = array(
        //"id_em"=>$this->input->post("employee_id"),
        "f_name"=>$this->input->post("firstname_employee"),
        "l_name"=>$this->input->post("lastname_employee"),
        "user_login"=>$this->input->post("username_employee"),
        "password_login"=>$this->input->post("password_employee")
        );
        $this->db->insert("employee",$ar);
        $this->session->set_flashdata("success","Your account has been registered. You can login now");
        redirect("index.php/employee/add","refresh");
      }
    }
    if(isset($_POST['login']))
    {
      redirect("index.php/employee/login_employee","refresh");
    }
    $this->load->view('employee/signup_employee');
  }




  public function edit()
  {
    if(isset($_POST['save_account']))
    {
      $this->form_validation->set_rules('firstname_employee','FIRST NAME','required');
      $this->form_validation->set_rules('lastname_employee','LAST NAME','required');
      $this->form_validation->set_rules('username_employee','USER NAME','required');
      $this->form_validation->set_rules('password_employee','PASSWORD','required|min_length[4]');
      $this->form_validation->set_rules('password_employee2','CONFIRM PASSWORD','required|min_length[4]|matches[password_employee]');
      if ($this->form_validation->run() == TRUE)
      {
      //*******************************************************************
        $this->employee_models->update_employee($_SESSION['id_employee']);

        $user = $this->employee_models->login_employee($_POST['username_employee'],$_POST['password_employee']);

        if ($user -> id_em)
        {
          $_SESSION['user_login_employee']=TRUE;
          $_SESSION['id_employee']=$user->id_em;
          $_SESSION['f_name_employee']=$user->f_name;
          $_SESSION['l_name_employee']=$user->l_name;
          $_SESSION['username_employee']=$user->user_login;
          $_SESSION['password_employee']=$user->password_login;
        }
        $this->session->set_flashdata("success","Your account has been Update.");
        redirect("index.php/employee/edit","refresh");
        //*******************************************************************
      }
    }
    if(isset($_POST['dashborad_employee']))
    {
      redirect("index.php/employee/dashborad_employee","refresh");
    }
    $this->load->view('employee/edit_employee');
  }

  public function json_dashborad_employee()
  {
    //$re=$this->employee_models->dashborad_employee();
    $re=$this->employee_models->dashborad_InUse();
    echo json_encode( $re, JSON_UNESCAPED_UNICODE );
  }

  public function json_dashborad_schedule()
  {
    //$re=$this->employee_models->dashborad_employee();


    $date_schedule=$this->input->post('dateschedule');
    $re2=$this->employee_models->dashborad_schedule($date_schedule);
    echo json_encode( $re2, JSON_UNESCAPED_UNICODE );






    //$date_schedule=$this->input->post('dateschedule');




    //$date_schedule=$_POST['date_schedule'];
    //$re2=$this->employee_models->dashborad_schedule('2017-05-10');



  //  $re2=$this->employee_models->dashborad_schedule($date_schedule);
  //  echo json_encode( $re2, JSON_UNESCAPED_UNICODE );
  //  echo $date_schedule."00000";

  }


  public function json_dashborad_history()
  {
    //$re=$this->employee_models->dashborad_employee();

    $re=$this->employee_models->dashborad_history();
    echo json_encode( $re, JSON_UNESCAPED_UNICODE );
  }





  /*
    if ($this->input->post("buttonsave")!=null) {


    $ar = array(

      //"id_em"=>$this->input->post("employee_id"),
      "f_name"=>$this->input->post("employee_fname"),
      "l_name"=>$this->input->post("employee_lname"),
      "user_login"=>$this->input->post("employee_user"),
      "password_login"=>$this->input->post("employee_passs")


    );
    $this->db->insert("employee",$ar);
    redirect("index.php/employee/login_employee","refresh");
    //$this->load->view('employee/login_employee');
    exit();


  }
  $this->load->view('employee/signup_employee');

  */


  /*
      $this->load->model('test_model');
      $data['query']=$this->test_model->list_user();
      //print_r($data);

      $this->load->view('show',$data);


  */

}
?>
