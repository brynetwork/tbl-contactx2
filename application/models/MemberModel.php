<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberModel extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    
    public function insertCompany($companyname,$companyemail,$companypassword){
        $member_id = ""; 
        $company_id = ""; 
        $query = $this->db->query("Select COALESCE(MAX(member_id),0)+1 as member_id,COALESCE(MAX(company_id),0)+1 as company_id from adch_member");

        foreach ($query->result() as $row){
           $member_id =  $row->member_id;
           $company_id =  $row->company_id;
        }
        
        //CALL ID GENERATOR
        $this->load->model('IDSNModel');
        $getcompanyid = $this->IDSNModel->get_idsn($companyname);
        $getmemberid = $this->IDSNModel->get_idsn($companyname);

        $adch_member = array (
                'member_id' =>  $getmemberid, 
                'company_id' =>  $getcompanyid,        
                'email_address' => $companyemail,
                'user_type' => 'ADMIN COMPANY',
                'password' => $companypassword
                );
        $adch_company = array(
                'company_id' => $getcompanyid,
                'company_name' => $companyname  
        );

        $insertAdchMember = $this->db->insert('adch_member', $adch_member);   
        $insertAdchCompany = $this->db->insert('adch_company', $adch_company);   
        if ($insertAdchCompany == 1){
            echo true;
        }
    }
    public function insertMember($firstname,$middlename,$lastname,$address,$birthdate,$phonenum,$emailadd,$skypename,$vibenum,$messengeradd,$username,$password,$user_type,$company_id){

        //CALL ID GENERATOR
        $this->load->model('IDSNModel');
        $getmemberid = $this->IDSNModel->get_idsn($emailadd);
        $date_created = $date = date('Y-m-d H:i:s');
        $last_update = $date = date('Y-m-d H:i:s');

        $data = array (
                'member_id' =>  $getmemberid ,        
                'first_name' => $firstname,
                'middle_name' => $middlename,
                'last_name' => $lastname,
                'address' => $address,
                'birthdate' => $birthdate,
                'phone_number' =>  $phonenum,
                'email_address' => $emailadd,
                'skype_name' => $skypename,
                'viber_number' => $vibenum,
                'messenger_name' => $messengeradd,
                //'username' => $username,
                'password' => $password,
                'user_type' => $user_type,
                'company_id'=> $company_id,
                'date_created'=>$date_created,
                'last_update'=> $last_update
        );
        $this->db->trans_start();
        $query = $this->db->insert('adch_member', $data);
        //echo $query;
        $this->db->trans_complete();
        if($this->db->affected_rows() > 0){
            echo 'OK';
        }else {
            //any transaction error?
            if($this->db->trans_status() === FALSE){
                echo 'error';
            }

            echo 'OK';
        }

    }
    public function singIn($username,$password)
    {
        $user_type;
        $this->db->where('email_address',$username);
        $this->db->where('password',$password);
        $query = $this->db->get('adch_member');

        if($query->num_rows() > 0){
            foreach ($query->result() as $row){
                    $user_type = $row->user_type;
                    $this->session->set_userdata('user_type',$row->user_type);
                    $this->session->set_userdata('email_address',$row->email_address);
                    $this->session->set_userdata('company_id',$row->company_id);

                    $this->session->set_userdata('user_id',$row->company_id);
                    $this->session->set_userdata('user_email',$row->email_address);
                    $this->session->set_userdata('user_name',$row->email_address);
                    $this->session->set_userdata('user_role',$row->user_type);
                    $this->session->set_userdata('first_name',$row->first_name);
                    $this->session->set_userdata('company_id',$row->company_id);
                    $this->session->set_userdata('member_id',$row->member_id);
                }
            echo $user_type;   
        }else{
            echo false;
        }
    }
    public function getAllMember(){
        
          $this->db->select('*')->from('adch_member');
          $this->db->join('adch_company', 'adch_company.company_id=adch_member.company_id', 'left');
          $this->db->where('user_type !=','SUPER ADMIN');
          $this->db->where('user_type !=','MEMBER COMPANY');
          $query = $this->db->get()->result_array();
          return $query;
    }

    public function getMemberByID($memberID){

    }

    public function UpdateMember($member_id, $firstname,$middlename,$lastname,$address,$birthdate,$phonenum,$skypename,$vibernum,$messengeradd,$password,$user_type,$company_id){
        $last_update = $date = date('Y-m-d H:i:s');
        $data = array(      
                'first_name' => $firstname,
                'middle_name' => $middlename,
                'last_name' => $lastname,
                'address' => $address,
                'birthdate' => $birthdate,
                'phone_number' =>  $phonenum,
                'skype_name' => $skypename,
                'viber_number' => $vibernum,
                'messenger_name' => $messengeradd,
                'password' => $password,
                'user_type' => $user_type,
                'company_id'=> $company_id,
                'last_update'=> $last_update
        );
        $this->db->trans_start();
        $this->db->where('member_id', $member_id);
        $query = $this->db->update('adch_member', $data);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            echo "error";
        }else{
            echo "OK";
        }
    }

    public function deleteMember($memberID){

    }

    public function getAllMemberByCompanyID($companyID){
        $this->db->where('company_id', $companyID);
        $this->db->where('user_type !=', 'ADMIN COMPANY');
        //$this->db->order_by('last_update', 'DESC');
        $query =  $this->db->get('adch_member');
        return $query->result_array();
    }

    public function getMemberByMemAndCompID($member_id,$company_id){
        $query = $this->db->query('SELECT * FROM adch_member WHERE `company_id` =' .$company_id .' AND `member_id` =' .$member_id);
        return $query->row();
    }

    public function deleteMemberByMemAndCompID($member_id,$company_id){
        $this->db->trans_start();
        $query = $this->db->query('DELETE FROM adch_member WHERE `company_id` =' .$company_id .' AND `member_id` =' .$member_id);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            echo "error";
        }else{
            echo "OK";
        }
    }
 

}
