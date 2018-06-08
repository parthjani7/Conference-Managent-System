<?php
class Reviewers extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getReviewers(){
          $query = $this->db->query("SELECT a.*,b.email FROM profile_master a join login_master b on a.uid = b.uid where user_type='3' and b.is_active='1'");

          if($query->num_rows()>0){
               $res=$query->result_array();
               foreach ($res as $value) {
                    $data[]=array('id'=>$value['uid'],'fullname'=>$value['full_name'],'gender'=> $value['gender'],'country'=> $value['country'],'state'=>$value['state'],'city'=> $value['city'],'address'=> $value['address'],'email'=> $value['email']);
               }
          }else{
               $data=array('msg'=>"Data Not Found");
          }
          return $data;
     }
     public function getReviewerInfo($param){
          $query = $this->db->query("SELECT a.*,b.email FROM profile_master a join login_master b on a.uid = b.uid where user_type='3' and a.uid='$param'");

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
}
