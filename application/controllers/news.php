<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class news extends CI_Controller {

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
	
	public function id($id, $message="")
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('commentModel', '', TRUE);
		$this->load->model('newModel', '', TRUE);
		$this->load->model('platformsModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$viewData['message']=$message;
		$viewData['newData']=$this->newModel->getNewById($id);
		$viewData['userCanEdit']=(($this->session->userID == $viewData['newData']['platformUserId']) or ($this->session->isSuperuser) or ($this->platformsModel->isAdministrator($this->session->userID, $viewData['newData']['idPlatform'])));
		$viewData['comments']=$this->commentModel->getCommentsByNewId($id);
		$this->load->view('templates/header', $headerData);
		$this->load->view('newView', $viewData);
		$this->load->view('templates/footer');
	}
	
	public function registerEditNew($platformId,$id=""){
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('newModel', '', TRUE);
		$this->load->model('platformsModel', '', TRUE);
		$this->load->model('informerModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		$platformData=$this->platformsModel->getPlatformsByID($platformId);
		
		if (($this->session->isSuperuser == "1") or (($this->session->userID != null) and ($platformData['idUser'] == $this->session->userID)) or ($this->platformsModel->isAdministrator($this->session->userID, $platformData['id']))){
			$formData['form_content']['newId']=$id;
			$formData['form_content']['platformId']=$platformId;
			$formData['form_content'][0]['name']="Título";
			$formData['form_content'][0]['id']="title";
			$formData['form_content'][0]['error']="";
			$formData['form_content'][1]['name']="Resumen";
			$formData['form_content'][1]['id']="resume";
			$formData['form_content'][1]['error']="";
			$formData['form_content'][2]['name']="Descripción";
			$formData['form_content'][2]['id']="description";
			$formData['form_content'][2]['error']="";
			$formData['form_content'][3]['name']="Fecha de origen (dd/mm/aaaa)";
			$formData['form_content'][3]['id']="originDate";
			$formData['form_content'][3]['error']="";
			$formData['form_content'][4]['name']="Primera fuente";
			$formData['form_content'][4]['id']="link1";
			$formData['form_content'][4]['error']="";
			$formData['form_content'][5]['name']="Segunda fuente";
			$formData['form_content'][5]['id']="link2";
			$formData['form_content'][5]['error']="";
			$formData['form_content'][6]['name']="Tercera fuente";
			$formData['form_content'][6]['id']="link3";
			$formData['form_content'][6]['error']="";
			$formData['form_content'][7]['name']="Informador";
			$formData['form_content'][7]['id']="informer";
			$formData['form_content'][7]['error']="";
			$formData['form_content'][7]['options']=$this->informerModel->getAllInformersMin();
			$formData['form_content'][8]['name']="Fecha de resolución (dd/mm/aaaa)";
			$formData['form_content'][8]['id']="resultDate";
			$formData['form_content'][8]['error']="";
			
			if ($id == "") {
				$formData['form_content'][0]['value']="";
				$formData['form_content'][1]['value']="";
				$formData['form_content'][2]['value']="";
				$formData['form_content'][3]['value']="";
				$formData['form_content'][4]['value']="";
				$formData['form_content'][5]['value']="";
				$formData['form_content'][6]['value']="";
				$formData['form_content'][7]['value']="";
				$formData['form_content'][8]['value']="";
			} else {
				$newData=$this->newModel->getNewById($id);
				$formData['form_content'][0]['value']=$newData['title'];
				$formData['form_content'][1]['value']=$newData['resume'];
				$formData['form_content'][2]['value']=$newData['description'];
				$formData['form_content'][3]['value']=$newData['origin_date'];
				$formData['form_content'][4]['value']=$newData['link1'];
				$formData['form_content'][5]['value']=$newData['link2'];
				$formData['form_content'][6]['value']=$newData['link3'];
				$formData['form_content'][7]['value']=$newData['idInformer'];
				$formData['form_content'][8]['value']=$newData['result_date'];				
			}
			
			if ($this->input->post('create')){
				$title=$this->input->post('title');
				$resume=$this->input->post('resume');
				$description=$this->input->post('description');
				$originDate=$this->input->post('originDate');
				$resultDate=$this->input->post('resultDate');
				$link1=$this->input->post('link1');
				$link2=$this->input->post('link2');
				$link3=$this->input->post('link3');
				$informer=$this->input->post('informer');
				$validate=true;
				
				if ($title == "") {
					$validate=false;
					$formData['form_content'][0]['error']="El título es obligatorio";					
				}
				if ($resume == "") {
					$validate=false;
					$formData['form_content'][1]['error']="El resumen es obligatorio";					
				}
				if ($link1 == "") {
					$validate=false;
					$formData['form_content'][4]['error']="Al menos una fuente es obligatoria";					
				}
				if ($informer == "") {
					$validate=false;
					$formData['form_content'][7]['error']="El informador es obligatorio";					
				}
				if (!preg_match("/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/",$originDate)){
					$validate=false;
					$formData['form_content'][3]['error']="El formato de fecha no correscponde con dd/mm/aaaa";						
				}
				if (!preg_match("/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/",$resultDate)){
					$validate=false;
					$formData['form_content'][8]['error']="El formato de fecha no correscponde con dd/mm/aaaa";						
				}
				if ($validate){	
					if ($id == "") {
						$this->newModel->createNew($title, $resume, $description, $originDate, $resultDate, $link1, $link2, $link3, $informer, $platformId);
						return redirect('platform/id/'.$platformId);
					} else {
						$this->newModel->editNew($id,$title, $resume, $description, $originDate, $resultDate, $link1, $link2, $link3, $informer, $platformId);
						return redirect('news/id/'.$id);
					}
				} else {
					$formData['form_content']['platformId']=$platformId;
					$formData['form_content'][0]['value']=$title;
					$formData['form_content'][1]['value']=$resume;
					$formData['form_content'][2]['value']=$description;
					$formData['form_content'][3]['value']=$originDate;
					$formData['form_content'][4]['value']=$link1;
					$formData['form_content'][5]['value']=$link2;
					$formData['form_content'][6]['value']=$link3;
					$formData['form_content'][7]['value']=$informer;
					$formData['form_content'][8]['value']=$resultDate;
					$this->load->view('registerEditNewForm',$formData);	
				}				
			} else {
				$this->load->view('registerEditNewForm',$formData);	
			}
		} else {
			$this->load->view('templates/permissionError');
		}
		$this->load->view('templates/footer');
	}
	
	public function resolveNew($id){
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('newModel', '', TRUE);
		$this->load->model('platformsModel', '', TRUE);
		$this->load->model('informerModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		$newData=$this->newModel->getNewById($id);
		$platformData=$this->platformsModel->getPlatformsById($newData['idPlatform']);
		
		if (($this->session->isSuperuser == "1") or (($this->session->userID != null) and ($platformData['idUser'] == $this->session->userID)) or ($this->platformsModel->isAdministrator($this->session->userID, $platformData['id']))){
			$formData['form_content']['newId']=$id;
			$formData['form_content']['platformId']=$newData['platformUserId'];
			$formData['form_content'][0]['name']="Resultado";
			$formData['form_content'][0]['id']="result";
			$formData['form_content'][0]['error']="";
			$formData['form_content'][0]['value']="";
			$formData['form_content'][0]['options'][0]['name']="Desconocido";
			$formData['form_content'][0]['options'][0]['value']="0";
			$formData['form_content'][0]['options'][1]['name']="Acierto";
			$formData['form_content'][0]['options'][1]['value']="1";
			$formData['form_content'][0]['options'][2]['name']="Error";
			$formData['form_content'][0]['options'][2]['value']="2";
			$formData['form_content'][0]['options'][3]['name']="No comprobable";
			$formData['form_content'][0]['options'][3]['value']="3";
			$formData['form_content'][1]['name']="Fecha de resolución";
			$formData['form_content'][1]['id']="resultDate";
			$formData['form_content'][1]['error']="";
			$formData['form_content'][2]['name']="Descripción del resultado";
			$formData['form_content'][2]['id']="resultDescription";
			$formData['form_content'][2]['error']="";
			
			if ($id == "") {
				$formData['form_content'][0]['value']="";
				$formData['form_content'][1]['value']="";
				$formData['form_content'][2]['value']="";
			} else {
				$formData['form_content'][0]['value']=$newData['result'];
				$formData['form_content'][1]['value']=$newData['result_date'];
				$formData['form_content'][2]['value']=$newData['resultDescription'];				
			}
			
			if ($this->input->post('create')){
				$result=$this->input->post('result');
				$resultDate=$this->input->post('resultDate');
				$resultDescription=$this->input->post('resultDescription');
				$validate=true;
				
				if ($result == "") {
					$validate=false;
					$formData['form_content'][0]['error']="El resultado es obligatorio";					
				}
				if ($resultDate == "") {
					$validate=false;
					$formData['form_content'][1]['error']="La fecha de resultado es obligatoria";					
				}
				if (($result != "0") and ($resultDescription == "")) {
					$validate=false;
					$formData['form_content'][2]['error']="La descripción del resultado es obligatoria";					
				}
				if (!preg_match("/[0-9][0-9]\/[0-9][0-9]\/[0-9][0-9][0-9][0-9]/",$resultDate)){
					$validate=false;
					$formData['form_content'][1]['error']="El formato de fecha no correscponde con dd/mm/aaaa";						
				}
				if ($validate){	
					$this->newModel->editNewResult($id,$result, $resultDate, $resultDescription);
					return redirect('news/id/'.$id);
				} else {
					$formData['form_content'][0]['value']=$result;
					$formData['form_content'][1]['value']=$resultDate;
					$formData['form_content'][2]['value']=$resultDescription;
					$this->load->view('resolveNewForm',$formData);	
				}				
			} else {
				$this->load->view('resolveNewForm',$formData);	
			}
		} else {
			$this->load->view('templates/permissionError');
		}
		
		$this->load->view('templates/footer');
	}
	
	public function addComment($id){
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('commentModel', '', TRUE);
		$this->load->model('newModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$this->load->view('templates/header', $headerData);
		
		if ($this->session->userID){
			if ($this->input->post('commentContent')){
				$this->commentModel->addComment($this->session->userID, $id, $this->input->post('commentContent'));
			}
			return redirect('news/id/'.$id);
		} else {
			$this->load->view('templates/permissionError');
		}
		$this->load->view('templates/footer');
	}
}
