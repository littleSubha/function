<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//GET Primary key with auto increement
function get_pk_id($TB_NAME,$TB_COLUMN_NAME){
    $ci=& get_instance();
    $ci->load->database();
    $sql="SELECT IFNULL(max($TB_COLUMN_NAME),0) from $TB_NAME";
    $sqlqry=$ci->db->query($sql);
    $sqlrows= $sqlqry->row();
    foreach($sqlrows as $r){
        $sqlrow= $r;
    }
    if ($sqlrow <= 0) {
        $GetId_Fn = 1;
    }
    else{
        $GetId_Fn = $sqlrow + 1;
    }
    return $GetId_Fn;
    //echo $ci->db->last_query();
}
// Retrive Column Name
function get_column_value($tbl_name,$tbl_column_name,$params){
    $ci=& get_instance();
    $ci->load->database();
    $sql="SELECT $tbl_column_name FROM $tbl_name WHERE $params";
    $res =$ci->db->query($sql);
    $sqlrow=$res->row();
    $result_nm=$sqlrow->$tbl_column_name;
    return $result_nm;
}
/** Get table data */
function get_table_data($table_name, $select_column_name,$param="") {
    $CI =&  get_instance();
    $CI->load->database();
    if(!empty($param))
        $sql="SELECT $select_column_name FROM $table_name WHERE $param";
    else
        $sql="SELECT $select_column_name FROM $table_name ";
    $query=$CI->db->query($sql);
    return $query;
}

/** Data Insert */
function data_insert($table_name, $data) {
    $CI =&  get_instance();
    $CI->load->database();
    
    $CI->db->insert($table_name, $data);
    return true;
}
function data_insert2($table_name, $data) {
    $CI =&  get_instance();
    $CI->load->database();
    
    $CI->db->insert($table_name, $data);
    return $CI->db->insert_id();
}

/** Data Update */
function data_update($table_name,$column_name, $data) {
    $CI =&  get_instance();
    $CI->load->database();
    $CI->db->where($column_name,$data[$column_name]);

    $CI->db->update($table_name, $data);
    return true;
}

/** Data Delete Permanent */

function data_delete_p($table_name,$column_name, $id) {
    $CI =&  get_instance();
    $CI->load->database();
    $CI->db->where($column_name,$id);

    $CI->db->delete($table_name); 
    return true;
}

function data_delete_p_multiple_condition($table_name,$column_name, $id,$column_name2, $id2) {
    $CI =&  get_instance();
    $CI->load->database();
    $CI->db->where($column_name,$id);
    $CI->db->where($column_name2,$id2);
    $CI->db->delete($table_name); 
    return true;
}
function query_run($sql){
    $CI =&  get_instance();
    $CI->load->database();
    $query=$CI->db->query($sql);
    if($query){
       return true;
    }
}

/** Check Uniq column value */
function check_uniq_value($table_name, $column_name, $value,$param=NULL) {
    $CI =&  get_instance();
    $CI->load->database();
   
    if(!empty($param)){
        $condition="AND $param";
    }else{
        $condition="";
    }
    $sql="SELECT COUNT(*) as TOT FROM $table_name WHERE $column_name='$value' $condition";
    $query=$CI->db->query($sql);
    $result= $query->row();
    return intval($result->TOT);
    //echo $CI->db->last_query(); //SELECT COUNT(*) as TOT FROM service_type WHERE service_name='Product' AND id != 4 AND cancel=1
}
/** Image Upload  with compress*/

function compress_image($imageTemp, $imageUploadPath, $quality){
    error_reporting(0);
    $info = getimagesize($imageTemp);
    $mime = $info['mime'];
    // Create a new image from file
    switch($mime){
        case 'image/jpeg':
            $image = imagecreatefromjpeg($imageTemp);
            break;
        case 'image/png':
            $image = imagecreatefrompng($imageTemp);
            break;
        default:
            $image = imagecreatefromjpeg($imageTemp);
    }
    imagejpeg($image, $imageUploadPath, $quality);
    return true;
}

/** Image Upload */

function image_upload($field_name, $files, $upPath){
    if(! empty($files['name'])){
        $CI =&  get_instance();
        $config['upload_path'] =$upPath;
        $config['allowed_types'] ='jpeg|jpg|png|gif|pdf';
        $config['file_name'] =$files['name'];
        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);

        if(file_exists($config['upload_path'].$config['file_name'])){
            unlink($config['upload_path']. $config['file_name']);
        }

        if($CI->upload->do_upload($field_name)){
            $uploadData = $CI->upload->data();
            $programFile = $uploadData['file_name'];
        }else{
            $programFile ='';
        }

    }else{
        $programFile ='';
    }
    return $programFile;
}

/** Image Upload and remove old Image */

function image_upload2($field_name, $files, $upPath, $old_image){
    if(! empty($files['name']) && (empty($old_image) || !empty($old_image))){
        $CI =&  get_instance();
        $config['upload_path'] =$upPath;
        $config['allowed_types'] ='gif|jpg|png|jpeg|pdf|csv|txt|doc|docx|rar|zip|svg|xml|GIF|JPG|PNG|JPEG|PDF|DOC|XML|DOCX|xls|xlsx|CSV|TXT|SVG';
        //'jpeg|jpg|png|gif|pdf|wmv|mp4|avi|mov|mp3|doc|docx';
        // $config['max_size']              =10000; 
        // $config['max_width']             = 1024; 
        // $config['max_height']            = 1024; 
        $config['file_ext_tolower']      = true;
      
        $config['encrypt_name'] = TRUE;

        $config['file_name'] =$files['name'];

        if(file_exists($config['upload_path'].$old_image)){
            if(!empty($old_image)){
                unlink($config['upload_path'].$old_image);
            }
        }

        $CI->load->library('upload', $config);
        $CI->upload->initialize($config);
        if($CI->upload->do_upload($field_name)){
            $uploadData = $CI->upload->data();
            $programFile = $uploadData['file_name'];
        }else{
            $programFile ='';
        }

    }else{
        $programFile =$old_image;
    }
    return $programFile;
}
/* Get total record */
function total_record($table,$condition=""){
    $CI =&  get_instance();
    $CI->load->database();
    $CI->db->select('*');
    if($condition !=""){
        $CI->db->where($condition);
    }
    $CI->db->from($table);
    $q =$CI->db->get();
   return $r =$q->num_rows();
}



