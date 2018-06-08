<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('admin/papers');
		$this->load->model('admin/reviewers');
		$this->load->model('admin/authors');
		$this->load->model('admin/settings');
		$this->load->model('admin/track_admin');
		$this->load->model('common');
	}
	public function index(){
		if($this->session->userdata('uid'))
			redirect('admin/dashboard');
		else
			redirect('admin/login');
	}
	public function dashboard(){
		$this->load->model('admin/dashboard');
		$data=$this->dashboard->getData();
		$this->load->view("admin/dashboard.php",$data);
	}
	public function create_conference(){
		if($this->input->post('insert')!=''){
			$conf['uid']=addslashes($this->session->userdata('uid'));
			$conf['conf_name']=addslashes($this->input->post('conf_name'));
			$conf['conf_slug']=addslashes(strtolower($this->input->post('conf_slug')));
			$conf['conf_start_date']=$this->input->post('conf_start_date');
			$conf['conf_end_date']=$this->input->post('conf_end_date');
			$data=$this->settings->createConference($conf);
			if($data['success']=='1')
				redirect('admin/dashboard');
			else
				$this->load->view('admin/create_conference.php',$data);

		}else{
			$this->load->view("admin/create_conference.php");
		}
	}
	public function login(){
		if($this->session->userdata('utype')){
			$this->conf->userRedirect($this->session->userdata('utype'),$this->session->userdata('conf'));
		}else if($this->input->post('submitData')==""){
			$this->load->view("login.php");
		}else{
			$data['email']=$this->input->post('email');
			$data['pass']=$this->input->post('pass');

			$result=$this->settings->checkLogin($data);
			if(isset($result['success'])){
				$this->conf->userRedirect($result['utype'],$result['conf']);
			}else{
				$this->load->view("login.php",$result);
			}
		}
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

			$this->load->view("admin/reviewers_add.php",$result);
		}else{
			$this->load->view('admin/reviewers_add.php');
		}
	}
	public function papers_list(){
		$data['data']=$this->papers->getPapersList();
		$this->load->view('admin/papers_list.php',$data);
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
		$this->load->view('admin/papers_assignment.php',$result);
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
				redirect("/admin/reviewers#updated",$result);
			}else{
				$this->load->view('admin/reviewers_edit.php',$result);
			}
		}else{
			$result=$this->reviewers->getReviewerInfo($param);
			$this->load->view('admin/reviewers_edit.php',$result);
		}
	}
	public function reviewers_delete($param='0'){
		if($param != '0'){
			$result=$this->conf->deleteUser($param);
			redirect("/admin/reviewers#deleted",$result);
		}else{
			show_404();
		}
	}

	public function reviewers(){
		$data['data']=$this->reviewers->getReviewers();
		$this->load->view('admin/reviewers.php',$data);
	}
	public function authors(){
		$data['data']=$this->authors->getAuthors();
		$this->load->view('admin/authors.php',$data);
	}
	public function authors_delete($param='0'){
		if($param != '0'){
			$result=$this->conf->deleteUser($param);
			redirect("/admin/authors#deleted",$result);
		}else{
			show_404();
		}
	}
	public function conference_settings(){
		if($this->input->post('update')!=''){
			$conf_id=$this->input->post('conf_id');
			$conf['conf_name']=addslashes($this->input->post('conf_name'));
			$conf['conf_slug']=addslashes($this->input->post('conf_slug'));
			$conf['conf_start_date']=$this->input->post('conf_start_date');
			$conf['conf_end_date']=$this->input->post('conf_end_date');
			$data=$this->settings->updateConference($conf,$conf_id);
			if(isset($data['error'])){
				$data=array_merge($data,$conf);
			}
		}else
			$data=$this->settings->getConferenceInfo($this->session->userdata('uid'));
			$this->load->view('admin/conference_settings.php',$data);
	}
	public function track_settings(){
		$data['conf_id']=$this->session->userdata('conf_id');
		$data['data']=$this->settings->getAllTracks();
		$this->load->view('admin/track_settings.php',$data);

	}
	public function add_track(){
		if($this->input->post('submit')!=''){
			$settings['track_short_name']=addslashes($this->input->post('track_short_name'));
			$settings['track_name']=addslashes($this->input->post('track_name'));
			$settings['conf_id']=$this->input->post('conf_id');
			$data=$this->settings->insertTrack($settings);
			if(isset($data['success'])){
				redirect($param.'/admin/track_settings');
			}else{
				show_404();
			}
		}
	}
	public function delete_track($param='0'){
		if($param!='0'){
			$data=$this->settings->removeTrack($param);
			redirect('admin/track_settings#'.$data['status']);
		}else{
			show_404();
		}
	}
	public function edit_track($param1='0',$param2='0'){

	}
	public function logout($param='0'){
		$this->conf->logout($param);
	}
	public function TitleList($param='0'){
		if($param!='0')
			 $this->settings->showTitleList($param);
		else
			show_404();
	}
	public function addTitle($param='0'){
		if($this->input->post('track_id')!='' && $this->input->post('title_name')!=''){
			$data['track_id']=$this->input->post('track_id');
			$data['title_name']=addslashes($this->input->post('title_name'));
			$result=$this->settings->insertTitle($data);
			echo $result;
		}
	}
	public function removeTitle(){
		if($this->input->post('title_id')!=''){
			$title_id=$this->input->post('title_id');
			$result=$this->settings->deleteTitle($title_id);
			echo $result;
		}
	}
	public function review_settings(){
		$this->load->view('admin/review_settings.php');
	}
	public function track_admins(){
		$data['data']=$this->track_admin->getTrackAdmins();
		$this->load->view('admin/track_admins.php',$data);
	}
	public function add_track_admin(){
		if($this->input->post('register')!=''){
			$profile['full_name']=addslashes($this->input->post('fullname'));
			$profile['gender']=$this->input->post('gender');
			$profile['country']=$this->input->post('contry');
			$profile['address']=addslashes($this->input->post('address'));

			$login['email']=addslashes($this->input->post('emailid'));
			$login['password']=md5($this->input->post('password'));
			$login['user_type']='2';

			$conf_id=$this->session->userdata('conf_id');
			$result=$this->conf->registerUser($profile,$login,$conf_id);

			if(isset($result['uid'])){
				$data['uid']=$result['uid'];
				$data['track_id']=$this->input->post('track_id');
				$result['insert_info']=$this->track_admin->registerTrackAdmin($data);
			}
		}
		$result['data']=$this->settings->getAllTracks();
		$this->load->view('admin/add_track_admin.php',$result);

	}
}
