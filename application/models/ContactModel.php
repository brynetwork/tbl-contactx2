
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContactModel extends CI_Model {
    public function __construct() {
        $this->load->database();
    }



    public function insertContact($firstname,$lastname,$email,$contactnumber){
        $data = array (      
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'contact_num' => $contactnumber
        );
        $this->db->trans_start();
        $query = $this->db->insert('tbl_contact', $data);
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


    public function getAllContact(){
        $this->db->select('*')->from('tbl_contact');
        $query = $this->db->get()->result_array();
        return $query;
    }


    public function getContactById($id){
        $query = $this->db->query('SELECT * FROM tbl_contact WHERE `id` =' .$id);
        return $query->row();
    }

    public function updateContact($id, $firstname,$lastname,$email,$contactnumber){
        $data = array (      
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'contact_num' => $contactnumber
        );
        $this->db->trans_start();
        $this->db->where('id', $id);
        $query = $this->db->update('tbl_contact', $data);
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            echo "error";
        }else{
            echo "OK";
        }
    }

    function deleteByID($contact_id){
        $this->db->trans_start();
        $query = $this->db->query('DELETE FROM tbl_contact WHERE `id` =' .$contact_id);
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){
            echo "error";
        }else{
            echo "OK";
        }
    }
 

}
