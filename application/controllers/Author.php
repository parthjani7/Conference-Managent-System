<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Author extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('author/papers');
	}
	public function index(){
		if($this->session->userdata('uid')){
			redirect('author/dashboard');
		}else{
			redirect('conference/');
		}
	}
	public function dashboard(){
		$this->load->view("author/dashboard.php");
	}
	public function author_edit(){
		$uid=$this->session->userdata('uid');
		$data['data']=$this->conf->getUserProfile($uid);

		if ($this->input->post('update')!=''){
			$profile['full_name']=addslashes($this->input->post('fullname'));
			$profile['gender']=$this->input->post('gender');
			$profile['country']=$this->input->post('contry');
			$profile['address']=addslashes($this->input->post('address'));

			$login['email']=addslashes($this->input->post('emailid'));
			if(trim($this->input->post('password'))!=''){
				$login['password']=md5($this->input->post('password'));
			}
			$result=$this->conf->updateUser($profile,$login,$uid);
			if(isset($result['success_update'])){
				redirect($this->session->userdata('conf')."/author/author_edit#updated",$data);
			}else{
				redirect($this->session->userdata('conf')."/author/author_edit#email_error",$data);
			}

		}else{
				$this->load->view("author/author_edit.php",$data);
		}
	}
	public function upload_paper(){
		if($this->input->post('uploadpaper')!=''){

			$profile['title_id']=$this->input->post('title');
			$title_name=$this->papers->getPaperTitle($profile['title_id']);
			if(!$title_name){

				$paper_id=$this->papers->getpaperid();
				if($paper_id=='0'){
					$paper_id='1001';
				}else{
					$paper_id=($paper_id['paper_id']+1);
				}

				$original_path='Papers/Original/';
				$orgFname=$_FILES["opaper"]["name"];
				$orgExt=pathinfo($orgFname, PATHINFO_EXTENSION);
				$org_config['upload_path']=$original_path;
				$org_config['file_name']='p'.$paper_id.'_original';
				$org_config['allowed_types']='doc|docx';
				$org_config['max_size']= 10240;
				if (!file_exists($original_path)){ exec("mkdir -p $original_path"); }
				$this->load->library('upload', $org_config);

				if(!$this->upload->do_upload('opaper')){
					$data['error'] = array('op_error' => $this->upload->display_errors());
				}else{
					$blind_path='Papers/Blind/';
					$blindFname=$_FILES["bpaper"]["name"];
					$blindExt=pathinfo($blindFname, PATHINFO_EXTENSION);
					$blind_config['upload_path']=$blind_path;
					$blind_config['file_name']='p'.$paper_id.'_blind';
					$blind_config['allowed_types']='doc|docx';
					$blind_config['max_size']= 10240;

					if (!file_exists($blind_path)){ exec("mkdir -p $blind_path"); }
					$this->upload->initialize($blind_config);
					if(!$this->upload->do_upload('bpaper')){
						$data['error'] = array('bl_error' => $this->upload->display_errors());
					}else{
						$profile['uid']=$this->session->userdata['uid'];
						$profile['paper_id']=$paper_id;
						$profile['paper_title']=$this->input->post('papertitle');
						$profile['author_names']=$this->input->post('author');
						$profile['original_paper']=$original_path.$org_config['file_name'].'.'.$orgExt;
						$profile['blind_paper']=$blind_path.$blind_config['file_name'].'.'.$blindExt;

						$result=$this->db->insert('paper_master', $profile);
						$param=$this->session->userdata('conf');
						redirect($param.'/author/paper_review#uploaded');
					}
				}
			}else{
				$data['error']=array('exists'=>'You have already uploaded paper under this Title.');
			}
		}
		$data['data']=$this->papers->getConfTrackList();
		$data['param']=$this->session->userdata('conf');
		$this->load->view('author/upload_paper.php',$data);
	}
	public function TitleList($param='0'){
		if($param!='0')
			 $this->papers->showTitleList($param);
		else
			show_404();
	}
	public function paper_review(){

		$data['data']=$this->papers->getPaperReview();
		$this->load->view('author/paper_review.php',$data);
	}
	public function logout($param='0'){
		$this->conf->logout($param);
	}
}
