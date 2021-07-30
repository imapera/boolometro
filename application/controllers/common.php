<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class common extends CI_Controller {

	public function index()
	{
	}
	
	public function logIn()
	{
        $this->load->helper('url');
		$this->load->model('usersModel', '', TRUE);
		$this->load->library('session');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		if ($this->usersModel->checkPassword($username, $password)){
			$user=$this->usersModel->getUserInfo($username);
			$this->session->username=$user["username"];
			$this->session->userID=$user["id"];
			$this->session->isSuperuser=$user["isSuperuser"];
			return redirect('welcome');
		} else {
			return redirect('welcome');			
		}
	}
	
	public function logOut()
	{
        $this->load->helper('url');
		$this->load->library('session');
		
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('userID');
		$this->session->unset_userdata('isSuperuser');
		return redirect('welcome');
	}
}
