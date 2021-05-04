<?php

class User extends CI_Controller{

    function index(){
        $this->load->model('User_model');
        $this->load->database('crud');
        // $data['data'] = $this->User_model->get_data();
        // print_r('dddddddd');
        // die();
        $data['users']=$this->User_model->view();
        $this->load->view('list',$data);
    }

    function add(){
        $this->load->model('User_model');
        $data['country'] = $this->User_model->getcountry();
        $this->load->view('create',$data);
    }

    function edit(){

        $ab =$this->uri->segment(3);
        if($ab == NULL){
            redirect('user');
        }
        $this->load->model('User_model');
        $data['Edit'] = $this->User_model->edit($ab);
        $data['country'] = $this->User_model->getcountry();
        $this->load->view('edit',$data);
    } 

    function save(){
        if($this->input->post('submit')){
            $this->load->model('User_model');
            $this->User_model->add();
            redirect('user/index');
        }else{
            redirect('user/');
        }
    }

    public function update(){

        if($this->input->post('submit')){
           
            $this->load->model('User_model');
            $sno = $this->input->post('sno');   
            $this->User_model->update($sno);
            redirect('user/edit/');
        }
        else{
            redirect('user/');
        
        }
    }
    
    function delete(){
        $del = $this->uri->segment(3);
        $this->load->model('User_model');
        $this->User_model->delete($del);
        redirect('user');

    }
    
    function getcountrytostate(){
        $postdata = $this->input->post();
        $this->load->model('User_model');
        $data['state']= $this->User_model->getcountrytostate($postdata);
        echo json_encode($data['state']);
       
    }

    function getstatetocity(){
        $postdata = $this->input->post();
        $this->load->model('User_model');
        $data = $this->User_model->getstatetocity($postdata);
        echo json_encode($data);
    }

   
}