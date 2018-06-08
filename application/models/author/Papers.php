
<?php
class Papers extends CI_Model{
     public function __construct(){
          parent::__construct();
     }
     public function getConfTrackList(){
       $conf=$this->conf->isConfExist($this->session->userdata('conf'));
       $query = $this->db->query("SELECT track_name,track_id,track_short_name from paper_tracks where conf_id=$conf");
       if($query->num_rows()>0){
            $res=$query->result_array();
            foreach ($res as $key => $value) {
             $data[]=array('track_name'=>$value['track_name'],'track_short_name'=>$value['track_short_name'],'track_id'=>$value['track_id']);
            }
          return $data;
       }
    }

     public function getpaperid(){
          $query = $this->db->query("SELECT max(paper_id) as paper_id from paper_master ");
          if($query->num_rows()>0){
             $d=$query->result_array();

           return $d[0];
          }
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

     public function getPaperReview(){
       $uid=$this->session->userdata['uid'];
       $query = $this->db->query("SELECT a.*,b.title_name,d.track_name FROM paper_master a join paper_track_title b on a.title_id = b.title_id join profile_master c on a.uid=c.uid join paper_tracks d on b.track_id=d.track_id where a.uid='$uid'");

       if($query->num_rows()>0){
            $res=$query->result_array();
            foreach ($res as $key => $value) {
            $data[]=array('paper_id'=> $value['paper_id'],'paper_title'=> $value['paper_title'],'original_paper'=>$value['original_paper'],'blind_paper'=> $value['blind_paper'],'title_id'=> $value['title_id'],'date'=> $value['date'],'title_name'=> $value['title_name'],'track_name'=> $value['track_name'],
            'is_accepted'=> $value['is_accepted'],'is_assigned'=> $value['is_assigned'],'author_names'=>$value['author_names']);
       }
       }else{
            $data=array('msg'=>"Data Not Found");
       }
       return $data;
     }

     public function getPaperTitle($title_id){
        $uid=$this->session->userdata['uid'];
        $query = $this->db->query("SELECT * from paper_master where uid='$uid' and title_id='$title_id'");
        if($query->num_rows()==0)
              return false;
        else
             return true;
     }
}
?>
