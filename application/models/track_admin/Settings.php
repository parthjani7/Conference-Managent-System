<?php
class Settings extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getTrackAdmins(){
          $track_id=$this->conf->getTrackId($this->session->userdata('uid'));
          $query = $this->db->query("SELECT a.*,b.email,d.track_short_name FROM profile_master a join login_master b on a.uid = b.uid join prof_track_relation c on a.uid=c.uid join paper_tracks d on c.track_id=d.track_id where user_type='2' and b.is_active='1' and d.track_id='$track_id'");

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
}
?>
