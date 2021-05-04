<?php
class User_model extends CI_Model{

function add(){

    $name = $this->input->post('name');
    $address = $this->input->post('address');
    $mobno = $this->input->post('mobno');
    $country = $this->input->post('country');
    $state = $this->input->post('state');
    $city = $this->input->post('city');
    $data=array(
        'uName'=>$name,
        'uAddress'=>$address,
        'uMobno'=>$mobno,
        'uCountry'=>$country,
        'uState'=>$state,
        'uCity'=>$city        
    );
    $this->db->insert('users',$data);
}

function view(){

    $user = $this->db->get('users');
    if($user->num_rows()>0){
        foreach($user->result() as $data)
        $ary[] = $data;
    }
    return $ary;
}


function edit($a){
    
    $d = $this->db->get_where('users',array('sno'=>$a))->row();
    return $d;
}

function update($sno){

    $name = $this->input->post('name');
    $address = $this->input->post('address');
    $mobno = $this->input->post('mobno');
    $country = $this->input->post('country');
    $state = $this->input->post('state');
    $city = $this->input->post('city');
    $data = array(
        'uName'=>$name,
        'uAddress'=>$address,
        'uMobno'=>$mobno,
        'uCountry'=>$country,
        'uState'=>$state,
        'uCity'=>$city
    );
    
    $this->db->where('sno',$sno);
    $this->db->update('users',$data);

}

function delete($a){
    $this->db->delete('users',array('sno'=>$a));
    return;

}


function getcountry(){
    $response = array(); 
    $this->db->select('*');
    $q = $this->db->get('uCountry');
    $response = $q->result_array();

    return $response;
}

// get country to state


function getcountrytostate($postdata){
    $response = array();
    $this->db->select('state_id,state_name');
    $this->db->where('uCountry',$postdata['country']);
    $q = $this->db->get('uState');
    $response = $q->result_array();
    return $response;
}

// get state to city

function getstatetocity($postdata){
    $response = array();
    $this->db->select('city_id,city_name');  
    $this->db->where('uState',$postdata['state']);
    $q = $this->db->get('uCity');
    $response = $q->result_array();
    return $response;
    
}


}






