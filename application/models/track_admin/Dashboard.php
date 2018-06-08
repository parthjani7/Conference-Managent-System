<?php
class Dashboard extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getData(){
          $query = $this->db->query("SELECT count(id)as total_authors from login_master where user_type='0'");
          $res=$query->result_array();
          $data['total_authors']=$res[0]['total_authors'];

          $query = $this->db->query("SELECT count(id)as total_reviewers from login_master where user_type='3' and is_active='1'");
          $res=$query->result_array();
          $data['total_reviewers']=$res[0]['total_reviewers'];

          $query = $this->db->query("SELECT count(pid)as total_papers from paper_master");
          $res=$query->result_array();
          $data['total_papers']=$res[0]['total_papers'];

          $query = $this->db->query("SELECT count(id)as total_track_admins from login_master where user_type='2' and is_active='1'");
          $res=$query->result_array();
          $data['total_track_admins']=$res[0]['total_track_admins'];

          return $data;
     }
}
