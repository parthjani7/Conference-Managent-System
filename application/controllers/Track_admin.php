<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Track_admin extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('track_admin/papers');
		$this->load->model('track_admin/reviewers');
		$this->load->model('track_admin/settings');
		$this->load->model('common');

	}
	public function index(){
		if($this->session->userdata('uid'))
			redirect('track_admin/dashboard');
		else
			redirect('track_admin/login');
	}
	public function dashboard(){
		$this->load->model('track_admin/dashboard');
		$data=$this->dashboard->getData();
		$data['slug']=$this->session->userdata('conf');
		$this->load->view("track_admin/dashboard.php",$data);
	}
	public function reviewers_add(){
		if($this->input->post('register')!=''){
			$profile['full_name']=addslashes($this->input->post('fullname'));
			$profile['gender']=$this->input->post('gender');
			$profile['country']=$this->input->post('contry');
			$profile['address']=addslashes($this->input->post('address'));

			$login['email']=addslashes($this->input->post('emailid'));
			$login['password']=md5($this->input->post('password'));
			$login['user_type']='3';

			$conf_id=$this->session->userdata('conf_id');
			$result=$this->conf->registerUser($profile,$login,$conf_id);
			$result['slug']=$this->session->userdata('conf');
			$this->load->view("track_admin/reviewers_add.php",$result);
		}else{
			$data['slug']=$this->session->userdata('conf');
			$this->load->view('track_admin/reviewers_add.php',$data);
		}
	}
	public function papers_list(){
		$data['data']=$this->papers->getPapersList();
		$data['slug']=$this->session->userdata('conf');
		$this->load->view('track_admin/papers_list.php',$data);
	}
	public function papers_assignment(){
		if($this->input->post('submit')!='' || $this->input->post('unassign')!=''){
			$papers=$this->input->post('papers');
			if(count($papers)>0){
				$assign_info['uid']=$this->input->post('reviewrs');
				if($this->input->post('submit')!='' && $this->input->post('reviewrs')!='0'){
					$assign_info['assigned_by']=$this->session->userdata('uid');
					$result['status']=$this->common->assignPapers($assign_info,$papers);
				}
				else if($this->input->post('unassign')!=''){
					$result['status']=$this->common->unassignPapers($assign_info,$papers);
				}else{
					$result['status']=array('error'=>'Invalid Option Selected, Try Again');
				}
			}else{
				show_404();
			}
		}

		$result['data']=$this->papers->getPapers();
		$result['reviewrs']=$this->reviewers->getReviewers();
		$result['slug']=$this->session->userdata('conf');
		$this->load->view('track_admin/papers_assignment.php',$result);
	}

	public function reviewers_edit($param='0'){

		if($this->input->post('update')!=''){
			$profile['full_name']=addslashes($this->input->post('fullname'));
			$profile['gender']=$this->input->post('gender');
			$profile['country']=$this->input->post('contry');
			$profile['address']=addslashes($this->input->post('address'));

			$login['email']=addslashes($this->input->post('emailid'));
			if(trim($this->input->post('password'))!=''){
				$login['password']=md5($this->input->post('password'));
			}
			$result=$this->conf->updateUser($profile,$login,$param);

			if(isset($result['success_update'])){
				redirect($this->session->userdata('conf')."/track_admin/reviewers#updated",$result);
			}else{
				$result['slug']=$this->session->userdata('conf');
				$this->load->view('track_admin/reviewers_edit.php',$result);
			}
		}else{
			$result=$this->reviewers->getReviewerInfo($param);
			$result['slug']=$this->session->userdata('conf');
			$this->load->view('track_admin/reviewers_edit.php',$result);
		}
	}
	public function reviewers(){
		$data['slug']=$this->session->userdata('conf');
		$data['data']=$this->reviewers->getReviewers();
		$this->load->view('track_admin/reviewers.php',$data);
	}
	public function logout($param='0'){
		$this->conf->logout($param);
	}

	public function track_admins(){
		$data['data']=$this->settings->getTrackAdmins();
		$data['slug']=$this->session->userdata('conf');
		$this->load->view('track_admin/track_admins.php',$data);
	}

}
