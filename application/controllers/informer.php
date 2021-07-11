<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class informer extends CI_Controller {

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
		$this->load->view('templates/error');
		$this->load->view('templates/footer');
	}
	
	public function id($id)
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('informerModel', '', TRUE);
		$this->load->model('newModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$viewData['informerData']=$this->informerModel->getInfomerById($id);
		$newsCount=$this->newModel->getInformerNewsCount($id);
		$viewData['correctNews']=$newsCount['correctNews'];
		$viewData['wrongNews']=$newsCount['wrongNews'];
		$viewData['totalNews']=$newsCount['correctNews']+$newsCount['wrongNews'];
		if (($newsCount['correctNews']+$newsCount['wrongNews']) > 0)	$successRate=round(($newsCount['correctNews'] / ($newsCount['correctNews']+$newsCount['wrongNews']))*1000)/10;
		else $successRate=0;
		$viewData['successRate']=$successRate;
		if ($successRate < 50) $viewData['valoration']=0;
		elseif ($successRate < 70) $viewData['valoration']=1;
		elseif ($successRate < 85) $viewData['valoration']=2;
		elseif ($successRate < 99) $viewData['valoration']=3;
		else $viewData['valoration']=4;
		$viewData['mark']=$successRate*$newsCount['correctNews'];		
		$viewData['news']=$this->newModel->getNewsByInformerId($id);
		
		$this->load->view('templates/header', $headerData);
		$this->load->view('informerView', $viewData);
		$this->load->view('templates/footer');
	}
	
	public function registerInformer($id="")
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->model('informerModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
			
		$this->load->view('templates/header', $headerData);
		
		if ($this->session->username){	
			$formData['form_content']['informerId']=$id;		
			$formData['form_content'][0]['name']="Nombre";
			$formData['form_content'][0]['id']="name";
			$formData['form_content'][0]['error']="";
			$formData['form_content'][0]['value']="";
			$formData['form_content'][1]['name']="Descripción";
			$formData['form_content'][1]['id']="description";
			$formData['form_content'][1]['error']="";	
			$formData['form_content'][1]['value']="";
			$formData['form_content'][2]['name']="Enlace 1";
			$formData['form_content'][2]['id']="socialLink1";
			$formData['form_content'][2]['error']="";
			$formData['form_content'][2]['value']="";
			$formData['form_content'][3]['name']="Enlace 2";
			$formData['form_content'][3]['id']="socialLink2";
			$formData['form_content'][3]['error']="";
			$formData['form_content'][3]['value']="";
			$formData['form_content'][4]['name']="Enlace 3";
			$formData['form_content'][4]['id']="socialLink3";
			$formData['form_content'][4]['error']="";
			$formData['form_content'][4]['value']="";
			
			if ($id == ''){
				$formData['form_content'][0]['value']="";	
				$formData['form_content'][1]['value']="";
				$formData['form_content'][2]['value']="";
				$formData['form_content'][3]['value']="";
				$formData['form_content'][4]['value']="";
			} else {
				$informer=$this->informerModel->getInfomerById($id);
				$formData['form_content'][0]['value']=$informer['name'];	
				$formData['form_content'][1]['value']=$informer['description'];	
				$formData['form_content'][2]['value']=$informer['socialLink1'];	
				$formData['form_content'][3]['value']=$informer['socialLink2'];	
				$formData['form_content'][4]['value']=$informer['socialLink3'];	
			}
			
			if ($this->input->post('create')) {
				$name=$this->input->post('name');
				$description=$this->input->post('description');
				$socialLink1=$this->input->post('socialLink1');
				$socialLink2=$this->input->post('socialLink2');
				$socialLink3=$this->input->post('socialLink3');
				$validate=true;
				
				if ($name == ""){
					$validate=false;
					$formData['form_content'][0]['error']="El nombre es obligatorio";
				}
				
				if (strlen($name) > 100){
					$validate=false;
					$formData['form_content'][0]['error']="El nombre no puede ser de longitud mayor a 100.";
				}			
				
				if ($validate){
					if ($id == ''){
						$this->informerModel->registerInformer($name, $description, $socialLink1, $socialLink2, $socialLink3);
						$this->load->view('registerInformerOK', $formData);
					} else {
						$this->informerModel->editInformer($id,$name, $description, $socialLink1, $socialLink2, $socialLink3);
						return redirect('informer/id/'.$id);						
					}
				} else {
					$formData['form_content'][0]['value']=$name;	
					$formData['form_content'][1]['value']=$description;
					$formData['form_content'][2]['value']=$socialLink1;
					$formData['form_content'][3]['value']=$socialLink2;
					$formData['form_content'][4]['value']=$socialLink3;
					$this->load->view('registerInformerForm', $formData);
				}	
			} else {
				$this->load->view('registerInformerForm', $formData);
			}
		} else {
			$this->load->view('templates/permissionError');	
		}
		
		$this->load->view('templates/footer');
	}
}
