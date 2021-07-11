<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class superuserManagement extends CI_Controller {

	public function index()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('usersModel', '', TRUE);
		$this->load->model('platformsModel', '', TRUE);
		$this->load->model('newModel', '', TRUE);
		$this->load->model('informerModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		if ($this->session->isSuperuser == "1"){
			if ($this->input->post('platformFilter')){
				$viewData['platformsFilter']=$this->input->post('platformFilter');
				$viewData['platforms']=$this->platformsModel->getPlatformsByFilter($this->input->post('platformFilter'));	
			} else {
				$viewData['platformsFilter']='';
				$viewData['platforms']=$this->platformsModel->getPlatforms();			
			}
			
			if ($this->input->post('informersFilter')){
				$viewData['informersFilter']=$this->input->post('informersFilter');
				$viewData['informers']=$this->informerModel->getInformersByFilter($this->input->post('informersFilter'));	
			} else {
				$viewData['informersFilter']='';
				$viewData['informers']=$this->informerModel->getAllInformers();			
			}
			
			if ($this->input->post('newsFilter')){
				$viewData['newsFilter']=$this->input->post('newsFilter');
				$viewData['news']=$this->newModel->getNewsByFilter($this->input->post('newsFilter'));	
			} else {
				$viewData['newsFilter']='';
				$viewData['news']=$this->newModel->getNews();			
			}
			
			$this->load->view('superuserManagementView', $viewData);
		} else {
			$this->load->view('templates/permissionError');			
		}
		
		$this->load->view('templates/footer');
	}
}
