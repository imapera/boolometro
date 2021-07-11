<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class userPage extends CI_Controller {

	public function index()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('usersModel', '', TRUE);
		$this->load->model('platformsModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		if ($this->session->username) {
			$pageData['userdata']=$this->usersModel->getUserInfo($this->session->username);
			$pageData['suscribedPlatforms']=$this->platformsModel->getPlatformsSuscribedByUser($this->session->userID);
			$pageData['administratedPlatforms']=$this->platformsModel->getPlatformsAdministratedByUser($this->session->userID);
			$pageData['ownedPlatforms']=$this->platformsModel->getPlatformsByUserID($this->session->userID);
			$this->load->view('userView', $pageData);
		} else {
			$this->load->view('templates/permissionError');
		}
		$this->load->view('templates/footer');
	}
}
