<?php
class usersModel extends CI_Model
{
		public $username;
		public $password;
		public $email;
		public $registrado;
		public $actualizado;
		
		protected $table='PLT_USERS';
		
        public function insert($username, $password, $email)
        {
			$this->username=$username;
			$this->password=password_hash($password, PASSWORD_DEFAULT, ['cost' => 5]);;
			$this->email=$email;
			$this->registrado=time();
			$this->actualizado=time();
			$this->db->insert($this->table, $this);
        }
		
		public function existsUsername($username){
			$query=$this->db->get_where($this->table, array('username' => $username));
			if (sizeof($query->result()) > 0) {
				return true;
			} else {
				return false;
			}
		}
		
		public function existsEmail($email){
			$query=$this->db->get_where($this->table, array('email' => $email));
			if (sizeof($query->result()) > 0) {
				return true;
			} else {
				return false;
			}
		}
		
		public function checkPassword($username, $password){
			$query=$this->db->get_where($this->table, array('username' => $username));
			$user=$query->result();
			if (password_verify($password, $user[0]->PASSWORD)) {
				return true;
			} else {
				return false;
			}
		}
		
		public function getUserInfo($username){
			$query=$this->db->get_where($this->table, array('username' => $username));
			$user=$query->result();
			$userData['username']=$user[0]->USERNAME;
			$userData['email']=$user[0]->EMAIL;
			$userData['registration_date']=date("d/m/Y", $user[0]->REGISTRADO);
			$userData['isSuperuser']=$user[0]->IS_SUPERUSER;
			$userData['id']=$user[0]->ID;
			return $userData;
		}
		
		public function getUsers(){
			$query=$this->db->get_where($this->table, array());
			$i=0;
			$users=array();
			foreach ($query->result() as $user){
				$users[$i]['id']=$user->ID;
				$users[$i]['username']=$user->USERNAME;
				$users[$i]['email']=$user->EMAIL;
				$i++;
			}				
			return $users;			
		}
}