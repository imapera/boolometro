<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class platform extends CI_Controller {

	public function index()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('usersModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		$this->load->view('templates/notResourceError');
		$this->load->view('templates/footer');
	}
	
	public function id($id)
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('platformsModel', '', TRUE);
		$this->load->model('newModel', '', TRUE);
		$this->load->model('usersModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		if ($this->input->post('newsFilter')){
			$viewData['newsFilter']=$this->input->post('newsFilter');
			$viewData['newsData']=$this->newModel->getNewsByPlatformIdAndFilter($id, $this->input->post('newsFilter'));
		} else {
			$viewData['newsFilter']='';
			$viewData['newsData']=$this->newModel->getNewsByPlatformId($id);
		}
		
		$viewData['platformData']=$this->platformsModel->getPlatformsByID($id);
		$viewData['platformData']['isSuscribed']=$this->platformsModel->isUserSuscribed($this->session->userID, $id);
		$viewData['platformData']['isAdministrator']=$this->platformsModel->isAdministrator($this->session->userID, $id);
		$viewData['platformData']['isOwner']=($this->session->userID == $viewData['platformData']['idUser']);
		$viewData['platformData']['administrators']=$this->platformsModel->getAdministrators($id);
		$viewData['users']=$this->usersModel->getUsers();
		
		$this->load->view('platformView', $viewData);
		$this->load->view('templates/footer');
	}
	
	public function suscribe ($id){
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('platformsModel', '', TRUE);
		$this->platformsModel->susbribeUser($this->session->userID, $id);
		return redirect('platform/id/'.$id);
	}
	
	public function unsuscribe ($id){
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('platformsModel', '', TRUE);
		$this->platformsModel->unsusbribeUser($this->session->userID, $id);
		return redirect('platform/id/'.$id);		
	}
	
	public function addAdministrator($idPlatform){
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('platformsModel', '', TRUE);
		$userId=$this->input->post('userId');
		$platform=$this->platformsModel->getPlatformsByID($idPlatform);
		if ((!$this->platformsModel->isAdministrator($userId, $idPlatform)) and ($platform['idUser'] != $userId)){
			$this->platformsModel->setAdministrator($userId, $idPlatform);		
		}
		return redirect('platform/id/'.$idPlatform);
	}
	
	public function deleteAdministrator($idPlatform, $idUser){
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('platformsModel', '', TRUE);
		$this->platformsModel->deleteAdministrator($idUser, $idPlatform);
		return redirect('platform/id/'.$idPlatform);		
	}
}
