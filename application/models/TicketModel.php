<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TicketModel extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function insertTicket($ticketID, $subject, $message, $company_id, $mem_member_id, $mem_email, $sent_by_user_type, $status){
        $id = ""; 
        $query = $this->db->query("Select COALESCE(MAX(id),0)+1 as id from adch_ticket"); 
        
        foreach ($query->result() as $row){
           $id =  $row->id;
        }

        if($ticketID == ''){
            //CALL ID GENERATOR
            $this->load->model('IDSNModel');
            $ticketID = $this->IDSNModel->get_ticket_id();
            
        }
        
        $date_created = $date = date('Y-m-d H:i:s');
    	$data = array(
            'id' => $id,
    		'ticket_id' => $ticketID,
    		'subject' => $subject,
    		'message' => $message,
    		'company_id' => $company_id,
            'mem_member_id' => $mem_member_id,
            'mem_email' => $mem_email,
            'sent_by_user_type' => $sent_by_user_type,
            'status' => $status,
    		'date_created' => $date_created
    	);

    	$this->db->trans_start();
    	$query = $this->db->insert('adch_ticket', $data);
    	$this->db->trans_complete();
    	if($this->db->affected_rows() > 0){
    		echo 'OK';
    	}else{
            //any transaction error?
            if($this->db->trans_status() === FALSE){
                echo 'error';
            }

            echo 'OK';
    	}
    }


    public function getTicketByCompanyID($companyID){
        $query = $this->db->get('adch_ticket');

        return $query->result_array();
    }

    //Super Admin Ticket list
    public function getUniqueTicketByCompanyID($companyID){
        //$query = $this->db->get('adch_ticket');

        //return $query->result_array();

        //DISTINCT
        $this->db->distinct();
        //$this->db->select('adch_ticket');
        $this->db->group_by('ticket_id');
        $this->db->where('company_id', $companyID);
        $query = $this->db->get('adch_ticket');

        return $query->result_array();
    }


    public function getUniqueTicketByMemberIDAndTType($memberID, $sentByUserType){
        $this->db->distinct();
        $this->db->group_by('ticket_id');
        $this->db->where('mem_member_id', $memberID);
        $this->db->where('sent_by_user_type', $sentByUserType);
        $query = $this->db->get('adch_ticket');

        return $query->result_array();
    }

    public function getTicketByTicketID($ticketID){
        $this->db->where('ticket_id', $ticketID);
        $this->db->order_by("date_created", "desc");
        $query = $this->db->get('adch_ticket');

        return $query->result_array();
    }


}	