<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class register extends CI_Controller {

	public function index()
	{
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->library('session');
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$formData['form_content'][0]['name']="Nombre de usuario";
		$formData['form_content'][0]['id']="username";
		$formData['form_content'][0]['error']="";
		$formData['form_content'][0]['value']="";
		$formData['form_content'][1]['name']="Contraseña";
		$formData['form_content'][1]['id']="password";
		$formData['form_content'][1]['error']="";	
		$formData['form_content'][1]['value']="";
		$formData['form_content'][2]['name']="Repite la contraseña";
		$formData['form_content'][2]['id']="repeatPassword";
		$formData['form_content'][2]['error']="";
		$formData['form_content'][2]['value']="";
		$formData['form_content'][3]['name']="Correo electrónico";
		$formData['form_content'][3]['id']="email";
		$formData['form_content'][3]['error']="";
		$formData['form_content'][3]['value']="";
		$formData['form_content'][4]['name']="Acepto términos y condiciones";
		$formData['form_content'][4]['id']="acceptTerms";
		$formData['form_content'][4]['error']="";
		$formData['form_content'][4]['value']="";
		$formData['form_content'][5]['name']="Acepto la política de privacidad";
		$formData['form_content'][5]['id']="acceptPrivacy";
		$formData['form_content'][5]['error']="";
		$formData['form_content'][5]['value']="";
		
		$this->load->view('templates/header', $headerData);
			
		$this->load->view('register_form', $formData);
		$this->load->view('templates/footer');	
	}
	
	public function validateAndRegister(){
		
		$this->load->helper('html');
		$this->load->helper('url');
		$this->load->model('usersModel', '', TRUE);
		$this->load->library('session');
		
		$headerData['header_tags'][0]=link_tag('css/bootstrap.min.css');
		$headerData['header_tags'][1]='<meta name="viewport" content="width=device-width, initial-scale=1"> ';
		$headerData['header_tags'][2]=script_tag('js/jquery-3.5.1.min.js');
		$headerData['header_tags'][3]=script_tag('js/bootstrap.min.js');
		$headerData['header_tags'][4]=script_tag('js/bootstrap.bundle.min.js');
		
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$repeatPassword=$this->input->post('repeatPassword');
		$email=$this->input->post('email');
		$acceptTerms=$this->input->post('acceptTerms');
		$acceptPrivacy=$this->input->post('acceptPrivacy');
		$validated=true;
		$formData['form_content'][0]['error']="";
		$formData['form_content'][1]['error']="";	
		$formData['form_content'][2]['error']="";
		$formData['form_content'][3]['error']="";
		$formData['form_content'][4]['error']="";
		$formData['form_content'][5]['error']="";

		if ($username == ""){
			$validated=false;
			$formData['form_content'][0]['error']="El nombre de usuario es obligatorio.";
		}
		
		if (strlen($username) > 50){
			$validated=false;
			$formData['form_content'][0]['error']="El nombre de usuario es demasiado largo (tamaño máximo: 50).";
		}
		
		if ($this->usersModel->existsUsername($username)) {
			$validated=false;
			$formData['form_content'][0]['error']="El nombre de usuario introducido ya existe.";
		}
		
		if ($password == ""){
			$validated=false;
			$formData['form_content'][1]['error']="La constraseña esta vacía";
		}
		
		if ($password != $repeatPassword){
			$validated=false;
			$formData['form_content'][2]['error']="Las contraseñas no coinciden.";
		}
		
		if ($email == ""){
			$validated=false;
			$formData['form_content'][3]['error']="El correo electrónico está vacío";
		}
		
		if ($this->usersModel->existsEmail($email)) {
			$validated=false;
			$formData['form_content'][3]['error']="Ya se ha registrado una cuenta con ese correo electrónico.";
		}
		
		if ($acceptTerms == null){
			$validated=false;
			$formData['form_content'][4]['error']="Debe aceptar los términos y condiciones.";
		}	
		
		if ($acceptPrivacy == null){
			$validated=false;
			$formData['form_content'][5]['error']="Debe aceptar la política de privacidad.";
		}	

		$this->load->view('templates/header', $headerData);
		if ($validated){
			$bodyData['registerOK']=true;
			
			$this->usersModel->insert($username, $password, $email);
			
			$this->load->view('registerOk', $bodyData);
			$this->load->view('templates/footer');		
			
		} else {
			$formData['form_content'][0]['name']="Nombre de usuario";
			$formData['form_content'][0]['id']="username";
			$formData['form_content'][0]['value']=$username;
			$formData['form_content'][1]['name']="Contraseña";
			$formData['form_content'][1]['id']="password";
			$formData['form_content'][1]['value']="";
			$formData['form_content'][2]['name']="Repite la contraseña";
			$formData['form_content'][2]['id']="repeatPassword";
			$formData['form_content'][2]['value']="";
			$formData['form_content'][3]['name']="Correo electrónico";
			$formData['form_content'][3]['id']="email";
			$formData['form_content'][3]['value']=$email;
			$formData['form_content'][4]['name']="Acepto términos y condiciones";
			$formData['form_content'][4]['id']="acceptTerms";
			$formData['form_content'][4]['value']=$acceptTerms;
			$formData['form_content'][5]['name']="Acepto la política de privacidad";
			$formData['form_content'][5]['id']="acceptPrivacy";
			$formData['form_content'][5]['value']=$acceptPrivacy;
		
			$this->load->view('register_form', $formData);
			$this->load->view('templates/footer');			
		}
	}
}
