<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Reviewer extends CI_Controller{
	public function __construct() {
		parent::__construct();
		$this->load->model('reviewer/papers');
	}
	public function index(){
		if($this->session->userdata('uid')){
			redirect('reviewer/dashboard');
		}else{
			redirect('conference/');
		}
 	}
	public function dashboard(){
		$this->load->view("reviewer/dashboard.php");
	}
	public function logout($param='0'){
		$this->conf->logout($param);
	}
	public function paper_list(){
		$data['data']=$this->papers->getPapersList();
		$this->load->view('reviewer/papers_list.php',$data);
	}
	public function submitReview(){
		$reviews['innovative_concept'] =$this->input->post('innovative_concept');
		$reviews['content_origionality'] =$this->input->post('content_origionality');
		$reviews['technicality'] =$this->input->post('technicality');
		$reviews['structure'] =$this->input->post('structure');
		$reviews['reference'] =$this->input->post('reference');
		$reviews['lang_grammer'] =$this->input->post('lang_grammer');
		$reviews['gen_remarks'] =addslashes($this->input->post('gen_remarks'));
		$reviews['author_remarks'] =addslashes($this->input->post('author_remarks'));
		$reviews['status'] =$this->input->post('status');
		$reviews['assignment_id'] =$this->input->post('assignment_id');
		$this->papers->addReview($reviews);
	}
}
