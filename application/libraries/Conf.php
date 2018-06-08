<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Conf{

    public function isConfExist($param){
        $CI =& get_instance();
        $query = $CI->db->query("SELECT conf_id FROM conference_master where conf_slug = '$param' and is_active='1'");
        if($query->num_rows()==1){
             $res=$query->result_array();
             return $res[0]['conf_id'];
        }else{
          return false;
        }
    }
    public function registerUser($profile_info,$login_info,$conf_id){
        $email=$login_info['email'];
        $CI =& get_instance();
        $query = $CI->db->query("SELECT id FROM login_master where email = '$email'");

        if($query->num_rows()==0){
             $CI->db->insert('profile_master', $profile_info);

             $login_info['uid']=$CI->db->insert_id();
             $CI->db->insert('login_master', $login_info);

             $conf_data['conf_id']=$conf_id;
             $conf_data['uid']=$login_info['uid'];
             $CI->db->insert('prof_conf_relation',$conf_data);

             $data['uid']=$login_info['uid'];
             $data['success']='1';
        }else{
             $data=array('error'=>"Email Address is already Registered..!");
        }
        return $data;
    }
    public function updateUser($profile_info,$login_info,$uid){
        $email=$login_info['email'];
        $CI =& get_instance();
        $query = $CI->db->query("SELECT id FROM login_master where email = '$email' and uid<>'$uid'");

        if($query->num_rows()==0){

             $CI->db->where('uid',$uid);
             $CI->db->update('profile_master',$profile_info);

             $CI->db->where('uid',$uid);
             $CI->db->update('login_master', $login_info);
             $data['success_update']='1';
        }else{
             $data=array('error'=>"Email Address is already Registered..!");
        }
        return $data;
    }
    public function deleteUser($param){
         $CI =& get_instance();
         $CI->db->query("delete from prof_conf_relation where uid='$param'");
         $CI->db->query("delete from login_master where uid='$param'");
          $query = $CI->db->query("SELECT pid FROM paper_master where uid='$param'");
          if($query->num_rows()>0){
             $res=$query->result_array();
             $pid=$res[0]['pid'];
             $CI->db->query("delete from paper_assignment where pid='$pid'");
          }
          $CI->db->query("delete from paper_master where uid='$param'");
          $CI->db->query("delete from profile_master where uid='$param'");
          return array('delete_success'=>'1');
    }
    public function userRedirect($utype,$slug='0'){
         switch($utype){
              case '1':
                   redirect('/admin/dashboard');
                   break;
              case '2':
                   redirect($slug.'/track_admin/dashboard');
                   break;
              case '3':
                   redirect($slug.'/reviewer/dashboard');
                   break;
              default:
                   redirect($slug.'/author/dashboard');
                   break;
         }
    }
    public function logout($param){
         $CI =& get_instance();
         $CI->session->unset_userdata('uid');
         $CI->session->unset_userdata('utype');
         $CI->session->unset_userdata('conf');
         $CI->session->unset_userdata('conf_id');
         redirect("$param/login");
    }
    public function getConferenceCount(){
         $CI =& get_instance();
         $query = $CI->db->query("SELECT count(conf_id)as total_conf from conference_master where is_active='1'");
         $res=$query->result_array();
         return $res[0]['total_conf'];
    }
    public function getConfId($uid){
         $CI =& get_instance();
         $query = $CI->db->query("SELECT conf_id from conference_master where uid='$uid'");
         $res=$query->result_array();
         echo $res[0]['conf_id'];
    }
    public function getTrackId($uid){
         $CI =& get_instance();
         $query = $CI->db->query("SELECT track_id from prof_track_relation where uid='$uid'");
         $res=$query->result_array();
         return $res[0]['track_id'];
    }
    public function getTrackName($uid){
         $CI =& get_instance();
         $query = $CI->db->query("SELECT b.track_short_name FROM prof_track_relation a left join paper_tracks b on a.track_id=b.track_id where a.uid='$uid'");
         $res=$query->result_array();
         return $res[0]['track_short_name'];
    }
    public function getConfName($id){
         $CI =& get_instance();
         $query = $CI->db->query("SELECT * from conference_master where conf_id='$id'");
         $res=$query->result_array();
         return $res[0]['conf_name'];
    }
    public function getUserProfile($uid){
       $CI =& get_instance();
       $query = $CI->db->query("SELECT a.*,b.email FROM profile_master a join login_master b on a.uid = b.uid where a.uid = '$uid'");
       if($query->num_rows()>0){
          $res=$query->result_array();
          foreach($res as $row){
               $data[]=array('full_name'=>$row['full_name'],'gender'=>$row['gender'],'country'=>$row['country'],'state'=>$row['state'],'city'=>$row['city'],'address'=>$row['address'],'email'=>$row['email']);
          }
       }else{
         $data=array('fail'=>'0');
       }
       return $data;
    }
}
?>
