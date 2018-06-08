<?php
class Settings extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getConferenceInfo($param){
          $uid=$this->session->userdata('uid');
          $query = $this->db->query("SELECT conf_id,conf_name,conf_slug,conf_start_date,conf_end_date from conference_master where uid='$uid'");

          if($query->num_rows()==1){
               $res=$query->result_array();
               foreach ($res as $key => $value) {
                    $data=array('conf_id'=>$value['conf_id'],'conf_name'=>$value['conf_name'],'conf_slug'=> $value['conf_slug'], 'conf_start_date'=> $value['conf_start_date'],'conf_end_date'=>$value['conf_end_date']);
               }
          }else
               $data=array('msg'=>"Data Not Found");
          return $data;
     }
     public function updateConference($conf,$conf_id){

          $this->db->where('conf_id',$conf_id);
          $this->db->update('conference_master',$conf);

          $query = $this->db->query("SELECT conf_id,conf_name,conf_slug,conf_start_date,conf_end_date from conference_master where conf_id='$conf_id'");

          if($query->num_rows()==1){
               $res=$query->result_array();
               $data=array('conf_id'=>$res[0]['conf_id'],'conf_name'=>$res[0]['conf_name'],'conf_slug'=> $res[0]['conf_slug'], 'conf_start_date'=> $res[0]['conf_start_date'],'conf_end_date'=>$res[0]['conf_end_date']);
               $data['success']='1';
          }else{
               $data['error']='1';
          }
          return $data;
     }
     public function getAllTracks(){
          $conf_id=$this->session->userdata('conf_id');
          if($conf_id){
               $query = $this->db->query("SELECT track_id,track_short_name,track_name from paper_tracks where conf_id='$conf_id'");
               if($query->num_rows()>0){
                    $arr=$query->result_array();
                    foreach($arr as $res){
                         $data[]=array('track_name'=>$res['track_name'],'track_short_name'=>$res['track_short_name'],'track_id'=>$res['track_id']);
                    }
               }else{
                    $data=array('msg'=>'Data not Found..!');
               }
          }else{
               $data=array('msg'=>'Data not Found..!');
          }
          return $data;
     }
     public function insertTrack($tracks){
          $this->db->insert('paper_tracks',$tracks);
          return array('success'=>'1');
     }
     public function insertTitle($title){
          $this->db->insert('paper_track_title',$title);
          echo json_encode(array('success'=>'1','title_id'=>$this->db->insert_id()));
     }
     public function removeTrack($track_id){
          //ensure to delete track admin
          $qry=$this->db->query("select pid from paper_master a join paper_track_title b on a.title_id=b.title_id join paper_tracks c on c.track_id=b.track_id where c.track_id='$track_id'");
          if($qry->num_rows()>0){
               $data=array('status'=>'delete_error');
          }else{
               $this->db->query("delete from paper_track_title where track_id='$track_id'");
               $this->db->query("delete from paper_tracks where track_id='$track_id'");
               $data=array('delete_error'=>'deleted');
          }
          return $data;
     }
     public function deleteTitle($title_id){
          $qry=$this->db->query("select pid from paper_master a join paper_track_title b on a.title_id=b.title_id where b.title_id='$title_id'");
          if($qry->num_rows()>0){
               $data='0';
          }else{
               $this->db->query("delete from paper_track_title where title_id='$title_id'");
               $data='1';
          }
          return $data;
     }
     public function showTitleList($track_id){
         $query = $this->db->query("SELECT title_id,title_name from paper_track_title where track_id='$track_id'");
         if($query->num_rows()>0){
             $res=$query->result_array();
             foreach($res as $d){
               $data[]=array('title_id'=>$d['title_id'],'title_name'=>$d['title_name']);
             }
         }else{
           $data=array('fail'=>'0');
         }
         echo json_encode($data);
     }
     public function checkLogin($data){
		$email=addslashes($data['email']);
		$pass=md5($data['pass']);

		$query = $this->db->query("SELECT a.uid,user_type,coalesce(b.conf_id,0) as conf_id from login_master a left join conference_master b on a.uid=b.uid where email = '$email' and password='$pass' and user_type='1'");
		if($query->num_rows()==1){
			$res=$query->result_array();
			$this->session->set_userdata('uid', $res[0]['uid']);
			$this->session->set_userdata('utype', $res[0]['user_type']);
               if($res[0]['conf_id']!='0'){
                    $this->session->set_userdata('conf_id',$res[0]['conf_id']);
               }
			$result=array("success"=>1,"utype"=>$res[0]['user_type'],"conf"=>'0');
		}else{
			$result=array("error"=>"Invalid Email and Password Combination...!");
		}
		return $result;
  	}
     public function createConference($conf_data){
         $this->db->insert('conference_master', $conf_data);
         $data['conf_id']=$this->db->insert_id();
         if($data['conf_id']!=''){
               $this->session->set_userdata('conf_id',$data['conf_id']);
               $data['success']='1';
          }else{
               $data['error']='1';
          }
         return $data;
     }
}
?>
