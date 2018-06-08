<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Conference extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model("Conference_Model");
	}
	public function index(){
		if($this->session->userdata('utype')){
			$this->conf->userRedirect($this->session->userdata('utype'),$this->session->userdata('conf'));
		}else if($this->input->post('submitData')==""){
			redirect("conference/login");
		}else{
			$data['email']=$this->input->post('email');
			$data['pass']=$this->input->post('pass');
			$result=$this->Conference_Model->checkLogin($data);
			if(isset($result['success'])){
				$this->conf->userRedirect($result['utype'],$result['conf']);
			}else
				$this->load->view("login.php",$result);
		}
  	}

	public function login($param='0'){
		if($this->session->userdata('utype')){
			$this->conf->userRedirect($this->session->userdata('utype'),$this->session->userdata('conf'));
		}else if($this->input->post('submitData')==""){
			$data['conf_id']=$this->conf->isConfExist($param);
			$data['param']=$param;
			if($data['conf_id'])
				$this->load->view("login.php",$data);
			else
				show_404();
		}else{
			$data['email']=$this->input->post('email');
			$data['pass']=$this->input->post('pass');

			$result=$this->Conference_Model->checkLogin($data);
			if(isset($result['success'])){
				$this->conf->userRedirect($result['utype'],$result['conf']);
			}else{
				$result['param']=$param;
				$this->load->view("login.php",$result);
			}
		}
	}

	public function registration($param='0'){
		if($this->input->post('register')==''){
			$data['conf_id']=$this->conf->isConfExist($param);
			$data['param']=$param;
			if($data['conf_id'])
				$this->load->view("registration.php",$data);
			else
				show_404();
		}else{
			$profile['full_name']=$this->input->post('fullname');
			$profile['gender']=$this->input->post('gender');
			$profile['country']=$this->input->post('contry');
			$profile['state']=$this->input->post('state');
			$profile['city']=$this->input->post('city');
			$profile['address']=addslashes($this->input->post('address'));

			$login['email']=addslashes($this->input->post('emailid'));
			$login['password']=md5($this->input->post('password'));

			$conf_id=$this->input->post('conf_id');

			$result=$this->conf->registerUser($profile,$login,$conf_id);
			if(isset($result['uid'])){
				redirect("/$param/login");
			}else if(isset($result['error'])){
				$result['param']=$param;
				$this->load->view("registration.php",$result);
			}else{
				redirect("/$param/login");
			}
		}
	}

}
