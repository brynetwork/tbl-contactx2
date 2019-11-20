<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IDSNModel extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    public function get_idsn($companyname){
    	$createddate = date('Ymd');
    	//echo $createddate;
    	$idnum = '';

    	$query = $this->db->query("Select COALESCE(MAX(id),0)+1 as id from adch_id_sn");
		
		foreach ($query->result() as $row){
			$idnum =  $row->id;
		}

		if($idnum > 100000) {
			$this->db->truncate('adch_id_sn');

			$query = $this->db->query("Select COALESCE(MAX(id),0)+1 as id from adch_id_sn");
		
			foreach ($query->result() as $row){
				$idnum =  $row->id;
			}
			$data = array(
				'id' => $idnum 
			);

			$query = $this->db->insert('adch_id_sn', $data);
			$formattedidsn = sprintf("%05d", $idnum);

		} else {
			$data = array(
				'id' => $idnum 
			);

			$query = $this->db->insert('adch_id_sn', $data);
			$formattedidsn = sprintf("%05d", $idnum);
		}

 		//encode by sha
		$idsn =  $createddate.$formattedidsn;
		$value = 0;
		$offset = 0x000000FF;

		$out = hash('sha256', $idsn.$companyname);
		$byte_array = unpack("C*",$out);
		for ($x = 0; $x < 4; $x++) {
			$shift = (4-1-$x) * 8;
			$value += ($byte_array[$x] & $offset) << $shift;

		}
		$remainder = sprintf("%02d", abs($value) %100);
		$shaid = $idsn.$remainder;

        return $shaid;
 
    }

    public function insertIDSN(){

    }

    public function get_ticket_id(){
    	$createddate = date('Ymd');
    	//echo $createddate;
    	$idnum = '';

    	$query = $this->db->query("Select COALESCE(MAX(id),0)+1 as id from adch_id_sn");
		
		foreach ($query->result() as $row){
			$idnum =  $row->id;
		}

		if($idnum > 100000) {
			$this->db->truncate('adch_id_sn');

			$query = $this->db->query("Select COALESCE(MAX(id),0)+1 as id from adch_id_sn");
		
			foreach ($query->result() as $row){
				$idnum =  $row->id;
			}
			$data = array(
				'id' => $idnum 
			);

			$query = $this->db->insert('adch_id_sn', $data);
			$formattedidsn = sprintf("%05d", $idnum);

		} else {
			$data = array(
				'id' => $idnum 
			);

			$query = $this->db->insert('adch_id_sn', $data);
			$formattedidsn = sprintf("%05d", $idnum);
		}

		$idsn =  $createddate.$formattedidsn;

		return 'TCKT'.$idsn;
    }


}
