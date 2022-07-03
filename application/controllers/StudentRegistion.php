<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class StudentRegistion extends CI_Controller {

	function __construct(){
         parent::__construct();
        $this->load->model('StudentModels','student',true);
    }
	public function index(){
        //$data=$this->student->get_student();
		$this->load->view('student_reg');
	}
    public function studentReg_add(){
        $this->form_validation->set_rules('stu_name', 'Name', 'trim|required');
        $this->form_validation->set_rules('stu_email', 'Email', 'trim|required|is_unique[student_mst.stu_email]');
        $this->form_validation->set_rules('stu_mobailnum', 'Mobail Number', 'trim|required|min_length[10]|max_length[12]|is_unique[student_mst.stu_mobailnum]');
        $this->form_validation->set_rules('stu_psw', 'Password', 'trim|required');

        $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE){
            $this->load->view('student_reg');
        }else{
            $data_insert=[
                'stu_id'  =>$this->input->post('stu_id'),
                'stu_name'=>$this->input->post('stu_name'),
                'stu_email'  =>$this->input->post('stu_email'),
                'stu_mobailnum'  =>$this->input->post('stu_mobailnum'),
                'stu_psw'  =>$this->input->post('stu_psw'),

           ];
           $response =data_insert('student_mst',$data_insert);
           if($response){
                $this->session->set_flashdata('msg', '<div class="text-success"> Student Registration Successfully</div>');
                redirect('student_reg','refresh');
           }
          
        }
    }
    public function teacher_information(){
        $this->load->view('teacher_info');
    }
    public function teacher_informationAdd(){
         $this->form_validation->set_rules('tech_name','Teacher Name','trim|required');
         $this->form_validation->set_rules('tech_dob', 'Teacher Dob', 'required');
         $this->form_validation->set_rules('tech_num', 'Teacher Number', 'required');
         $this->form_validation->set_rules('tech_email', 'Teacher Email', 'required');
         if($_FILES['tech_pic']['name'] =='' && $_FILES['tech_pic']['type']== ""){
            $this->form_validation->set_rules('tech_pic', 'Teacher Photo', 'required');
         }
         $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');
         if($this->form_validation->run() == FALSE){
            $this->load->view('teacher_info');
         }else{
             $insert_data=[
                'tech_name'  =>$this->input->post('tech_name'),
                'tech_dob'  =>$this->input->post('tech_dob'),
                'tech_num'  =>$this->input->post('tech_num'),
                'tech_email'  =>$this->input->post('tech_email'),
                //'tech_pic'  =>$this->input->post('tech_pic'),

             ];
            $uplodePath="uplode/teacher_data/";
            if(!file_exists($uplodePath)){
                    @mkdir($uplodePath,0777,true);
            }
            $file_name=$_FILES['tech_pic']['name'];
            $file_temp=$_FILES['tech_pic']['tmp_name'];
            if($_FILES['tech_pic']['name'] !="" && $_FILES['tech_pic']['error'] == 0){
                move_uploaded_file($file_temp,$uplodePath.$file_name);
                $insert_data['tech_pic']=$file_name;
            }
            $response=data_insert('teacher_mst',$insert_data);
            if($response){
                $this->session->set_flashdata('message','<div class="text-peimery">add successfully</div>');
                redirect('teacher_information','refress');
               // $this->load->view('teacher_info');
            }else{
                $this->session->set_flashdata('error','<div class="text-danger">data add unsucessfully</div>');
                // redirect('teacher_information','refress');
                $this->load->view('teacher_info');
            }
            echo'<pre>';
            print_r($_POST);
            print_r($_FILES);
         }        //  SELECT `tech_id`, `tech_name`, `tech_dob`, `tech_num`, `tech_email`, `tech_pic`, `tech_cancel` FROM `teacher_mst` WHERE 1
    }
    function teacher_informationlist(){  
         
        $data['teacher']=$this->student->get_teacher_data()->result();
        $this->load->view('teacher_information',$data);


    }
    function teacher_information_edit($tech_id){ 
        $data['teacher_info']=$this->student->get_teacher_data_id($tech_id)->row();
        $this->load->view('teacher_information_edit',$data);

      }
    function teacher_information_update($tech_id){  
        $this->form_validation->set_rules('tech_name','Teacher Name','trim|required');
         $this->form_validation->set_rules('tech_dob', 'Teacher Dob', 'required');
         $this->form_validation->set_rules('tech_num', 'Teacher Number', 'required');
         $this->form_validation->set_rules('tech_email', 'Teacher Email', 'required');
         if($_FILES['tech_pic']['name'] !='' && $_POST['old_tech_pic']['error']==0 && (empty('old_tech_pic') || !empty('old_tech_pic'))){
            $this->form_validation->set_rules('tech_pic', 'Teacher Photo', 'required');
         }
         $this->form_validation->set_error_delimiters('<div class="error text-danger">', '</div>');
         if($this->form_validation->run() == FALSE){
            $data['teacher_info']=$this->student->get_teacher_data_id($tech_id)->row();
            $this->load->view('teacher_information_edit',$data);
         }else{
             $update_data=[
                'tech_id'  =>$tech_id,
                'tech_name'  =>$this->input->post('tech_name'),
                'tech_dob'  =>$this->input->post('tech_dob'),
                'tech_num'  =>$this->input->post('tech_num'),
                'tech_email'  =>$this->input->post('tech_email'),
                //'tech_pic'  =>$this->input->post('tech_pic'),

             ];
            $uplodePath="uplode/teacher_data/";
             
            $old_tech_pic=$this->input->post('old_tech_pic');
            $file_name=$_FILES['tech_pic']['name'];
            $file_temp=$_FILES['tech_pic']['tmp_name'];

            if($_FILES['tech_pic']['name'] !=="" && $_FILES['tech_pic']['error'] === 0 && empty($old_tech_pic) ){
                move_uploaded_file($_FILES['tech_pic']['tmp_name'],$uploadPath.$tech_pic_name);
                $update_data['tech_pic']=$tech_pic_name; 
            }elseif($_FILES['tech_pic']['name'] !=="" && !empty($old_tech_pic) ){
                if(file_exists($uploadPath.$old_tech_pic)){
                    unlink($uploadPath.$old_tech_pic);
                }
                 move_uploaded_file($_FILES['tech_pic']['tmp_name'],$uploadPath.$tech_pic_name);
                $update_data['tech_pic']=$tech_pic_name;
            
            }else{
               $update_data['tech_pic']=$old_tech_pic;
            }
            print_r($update_data);
            $response=data_update('teacher_mst','tech_id',$update_data);
            if($response){
                $this->session->set_flashdata('message','<div class="text-peimery">add successfully</div>');
                redirect('teacher_informationlist','refress');
               // $this->load->view('teacher_info');
            }else{
                $this->session->set_flashdata('error','<div class="text-danger">data add unsucessfully</div>');
                redirect('teacher_information_edit/'.$tech_id,'refress');
                
            }
             
         }     

    }
     

}

