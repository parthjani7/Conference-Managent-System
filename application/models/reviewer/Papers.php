<?php
class Papers extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getPapersList(){
          $uid=$this->session->userdata('uid');
          $query = $this->db->query("SELECT a.assignment_id,b.paper_id,b.blind_paper,d.track_short_name,c.title_name,b.pid,b.paper_title FROM paper_assignment a join paper_master b on a.pid=b.pid join paper_track_title c on b.title_id=c.title_id join paper_tracks d on c.track_id=d.track_id where a.uid='$uid' and a.is_reviewed='0'");

          if($query->num_rows()>0){
               $res=$query->result_array();
               foreach ($res as $key => $value) {
                    $data[]=array('assignment_id'=>$value['assignment_id'],'pid'=>$value['pid'],'blind_paper'=>$value['blind_paper'],'track_short_name'=> $value['track_short_name'],'paper_title'=> $value['paper_title'],'title_name'=> $value['title_name'],'paper_id'=> $value['paper_id']);
               }
          }else{
               $data=array('msg'=>"Data Not Found");
          }
          return $data;
     }
     public function addReview($reviews){
          if($this->session->userdata('uid')==''){
               return false;
          }
          $uid=$this->session->userdata('uid');
          $aid=$reviews['assignment_id'];
          $query = $this->db->query("SELECT a.assignment_id FROM review_master a join paper_assignment b on a.assignment_id=b.assignment_id where b.uid='$uid' and a.assignment_id='$aid' and b.is_reviewed='1'");
          if($query->num_rows()==0){
               $this->db->insert('review_master',$reviews);
               $this->db->where('assignment_id',$aid);
               $this->db->update('paper_assignment',array('is_reviewed'=>'1'));
               echo json_encode(array('status'=>'1'));
          }else{
               echo json_encode(array('status'=>'0'));
          }
     }
}
?>
