<?php
class Papers extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getPapersList(){
          $track_id=$this->conf->getTrackId($this->session->userdata('uid'));
          $query = $this->db->query("SELECT a.*,b.title_name,c.full_name,d.track_name FROM paper_master a join paper_track_title b on a.title_id = b.title_id join profile_master c on a.uid=c.uid join paper_tracks d on b.track_id=d.track_id where d.track_id='$track_id'");

          if($query->num_rows()>0){
               $res=$query->result_array();
               foreach ($res as $key => $value) {
               $data[]=array('pid'=>$value['pid'],'uid'=> $value['uid'],'paper_title'=> $value['paper_title'],'paper_id'=> $value['paper_id'],'original_paper'=>$value['original_paper'],'blind_paper'=> $value['blind_paper'],'title_id'=> $value['title_id'],'date'=> $value['date'],'title_name'=> $value['title_name'],'track_name'=> $value['track_name'],'full_name'=> $value['full_name']);
          }
          }else{
               $data=array('msg'=>"Data Not Found");
          }
          return $data;
     }
     public function getPapers(){
          $track_id=$this->conf->getTrackId($this->session->userdata('uid'));
          $query = $this->db->query("SELECT a.*,b.title_name,c.full_name,d.track_name,count(e.assignment_id)as total_assign FROM paper_master a join paper_track_title b on a.title_id = b.title_id join profile_master c on a.uid=c.uid join paper_tracks d on b.track_id=d.track_id left join paper_assignment e on a.pid=e.pid where d.track_id='$track_id' group by a.pid");

          if($query->num_rows()>0){
               $res=$query->result_array();
               foreach ($res as $key => $value) {
               $data[]=array('pid'=>$value['pid'],'uid'=> $value['uid'],'paper_id'=> $value['paper_id'],'original_paper'=>$value['original_paper'],'blind_paper'=> $value['blind_paper'],'title_id'=> $value['title_id'],'paper_title'=> $value['paper_title'],'date'=> $value['date'],'title_name'=> $value['title_name'],'track_name'=> $value['track_name'],'author_names'=> $value['author_names'],'total_assign'=>$value['total_assign']);
          }
          }else{
               $data=array('msg'=>"Data Not Found");
          }
          return $data;
     }
}
?>
