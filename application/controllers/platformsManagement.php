<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class platformsManagement extends CI_Controller {

	public function index()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('platformsModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		if ($this->session->username) {	
			$formData['form_content'][0]['name']="Título";
			$formData['form_content'][0]['id']="title";
			$formData['form_content'][0]['error']="";
			$formData['form_content'][0]['value']="";
			$formData['form_content'][1]['name']="Descripción breve";
			$formData['form_content'][1]['id']="description";
			$formData['form_content'][1]['error']="";	
			$formData['form_content'][1]['value']="";
			$formData['form_content'][2]['name']="Temática";
			$formData['form_content'][2]['id']="theme";
			$formData['form_content'][2]['error']="";
			$formData['form_content'][2]['value']="";
		
			if ($this->input->post('create')){
				$title=$this->input->post('title');
				$description=$this->input->post('description');
				$theme=$this->input->post('theme');
				$validated=true;
				
				if ($title == ""){
					$validated=false;
					$formData['form_content'][0]['error']="El título es obligatorio.";
				}
				
				if ($theme == ""){
					$validated=false;
					$formData['form_content'][2]['error']="La temática es obligatoria.";
				}
				
				if ($validated) {
					$this->platformsModel->createPlatform($title, $description, $theme, $this->session->userID);
					return redirect('userPage');
				}
			}
			
			$this->load->view('newPlatformForm',$formData);
			
		} else {
			$this->load->view('templates/permissionError');
		}
		$this->load->view('templates/footer');
	}
	
}
