<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Conference_Model extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	public function checkLogin($data){
		$email=addslashes($data['email']);
		$pass=md5($data['pass']);
		$query = $this->db->query("SELECT a.uid,a.user_type,c.conf_id,c.conf_slug FROM login_master a join prof_conf_relation b on a.uid=b.uid join conference_master c on b.conf_id=c.conf_id where email = '$email' and password='$pass' and a.is_active='1'");
		if($query->num_rows()==1){
			$res=$query->result_array();
			$this->session->set_userdata('uid', $res[0]['uid']);
			$this->session->set_userdata('utype', $res[0]['user_type']);
			$this->session->set_userdata('conf_id', $res[0]['conf_id']);
			$this->session->set_userdata('conf', $res[0]['conf_slug']);
			$result=array("success"=>1,"utype"=>$res[0]['user_type'],"conf"=>$res[0]['conf_slug']);
		}else{
			$result=array("error"=>"Invalid Email and Password Combination...!");
		}
		return $result;
  	}
}
