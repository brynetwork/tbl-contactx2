<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

	public function index(){
		/*Contact List*/
		$this->load->model('ContactModel');
		$data['contact_list'] = $this->ContactModel->getAllContact();
		$this->load->view('Contact/contact_list', $data);
	}


	public function add_contact(){
		$this->load->library('form_validation');
		$this->load->view('contact/add_contact');

	}

	public function save_contact(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("firstname", "First Name", "required");
		$this->form_validation->set_rules("lastname", "Last Name", "required");
		$this->form_validation->set_rules("email", "Email Address", "required|valid_email");
		$this->form_validation->set_rules("contactnumber", "Contact Number", "required");

        if ($this->form_validation->run() == FALSE){
    		echo validation_errors();
        }else{
        	//echo 'OK';
        	$firstname = $_POST['firstname'];
        	$lastname = $_POST['lastname'];
        	$email = $_POST['email'];
	        $contactnumber = $_POST['contactnumber'];
	        $this->load->model('ContactModel');
	        $this->ContactModel->insertContact($firstname, $lastname, $email, $contactnumber);
	        $this->send_mail($email);
        }

	}


	public function send_mail($contactMail){
        $from_email = "tblemail@example.com";
        $to_email = $contactMail;
        //Load email library
        $this->load->library('email');
        $this->email->from($from_email, 'Identification');
        $this->email->to($to_email);
        $this->email->subject('TBL add Contact');
        $this->email->message('We added you in our contact list. Thank you.');
        //Send mail
        $this->email->send();
        /*
        if($this->email->send())
            //$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
        else
            //$this->session->set_flashdata("email_sent","You have encountered an error");
        */
    
	}

	public function edit_contact($id){
		$this->load->model('ContactModel');
		$data['contactdetails'] = $this->ContactModel->getContactById($id);
		$this->load->view('contact/edit_contact', $data);
	}

	public function update_contact(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("firstname", "First Name", "required");
		$this->form_validation->set_rules("lastname", "Last Name", "required");
		$this->form_validation->set_rules("email", "Email Address", "required|valid_email");
		$this->form_validation->set_rules("contactnumber", "Contact Number", "required");
        
        if ($this->form_validation->run() == FALSE){
    		echo validation_errors();
        }else{
        	//echo 'OK';
        	$id = $_POST['id'];
        	$firstname = $_POST['firstname'];
        	$lastname = $_POST['lastname'];
        	$email = $_POST['email'];
	        $contactnumber = $_POST['contactnumber'];
	        $this->load->model('ContactModel');
	        $this->ContactModel->updateContact($id, $firstname, $lastname, $email, $contactnumber);
        }
	}

	public function delete_contact(){
		$contact_id = $_POST['contact_id'];
		$this->load->model('ContactModel');
		$this->ContactModel->deleteByID($contact_id);
	}
}
