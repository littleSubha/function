<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentModels extends CI_Model {

	function __construct(){
         parent::__construct();
    }
    function get_teacher_data(){
       $sql="SELECT `tech_id`, `tech_name`, `tech_dob`, `tech_num`, `tech_email`, `tech_pic`, `tech_cancel` FROM `teacher_mst` WHERE tech_cancel=1";
       $query = $this->db->query($sql);
       return $query;
    }
    function get_teacher_data_id($tech_id){
      	$sql="SELECT `tech_id`, `tech_name`, `tech_dob`, `tech_num`, `tech_email`, `tech_pic`, `tech_cancel` FROM `teacher_mst` WHERE tech_cancel=1 AND tech_id=$tech_id";
      	$query = $this->db->query($sql);
      	return $query;
    }

}