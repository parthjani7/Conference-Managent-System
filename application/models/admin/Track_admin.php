<?php
class Track_admin extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getTrackAdmins(){
          $query = $this->db->query("SELECT a.*,b.email,d.track_short_name FROM profile_master a join login_master b on a.uid = b.uid join prof_track_relation c on a.uid=c.uid join paper_tracks d on c.track_id=d.track_id where user_type='2' and b.is_active='1'");

          if($query->num_rows()>0){
               $res=$query->result_array();
               foreach ($res as $value) {
                    $data[]=array('id'=>$value['uid'],'fullname'=>$value['full_name'],'gender'=> $value['gender'],'email'=> $value['email'],'track_short_name'=> $value['track_short_name']);
               }
          }else{
               $data=array('msg'=>"Data Not Found");
          }
          return $data;
     }
     public function getTrackAdminInfo($param){
          $query = $this->db->query("SELECT a.*,b.email FROM profile_master a join login_master b on a.uid = b.uid where user_type='0' and a.uid='$param'");

          if($query->num_rows()==1){
               $res=$query->result_array();
               foreach ($res as $value) {
                    $data=array('id'=>$value['uid'],'fullname'=>$value['full_name'],'gender'=> $value['gender'],'country'=> $value['country'],'state'=>$value['state'],'city'=> $value['city'],'address'=> $value['address'],'email'=> $value['email']);
               }
          }else{
               $data=array('msg'=>"Data Not Found");
          }
          return $data;
     }
     public function registerTrackAdmin($param){
          $this->db->insert('prof_track_relation', $param);
          return array('id'=>$this->db->insert_id(),'success'=>'1');
     }
}
