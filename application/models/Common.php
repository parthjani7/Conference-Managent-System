<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Model{
	public function __construct() {
		parent::__construct();
	}
	public function assignPapers($data,$papers){
		foreach ($papers as $key => $value) {
			$data['pid']=$value;

			$query = $this->db->query("SELECT assignment_id FROM paper_assignment where uid = '".$data['uid']."' and pid='$value'");
	          if($query->num_rows()==0){
				$this->db->insert('paper_assignment', $data);
				$this->db->query("update paper_master set is_assigned='1' where pid='$value'");
			}
		}
		return array('assigned'=>'1');
  	}
	public function unassignPapers($data,$papers){
		if($data['uid']=='0'){
			foreach ($papers as $key => $value) {
				$this->db->query("delete from paper_assignment where pid='$value'");
				$this->db->query("update paper_master set is_assigned='0' where pid='$value'");
			}
		}else{
			$uid=$data['uid'];
			foreach ($papers as $key => $value) {
				$this->db->query("delete from paper_assignment where pid='$value' and uid='$uid'");
				$query=$this->db->query("SELECT count(assignment_id)as total_assign FROM paper_assignment where pid='$value'");
				if($query->num_rows()==0){
					$this->db->query("update paper_master set is_assigned='0' where pid='$value'");
				}
			}
		}
		return array('unassigned'=>'1');
  	}
}
