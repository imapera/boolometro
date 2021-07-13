<?php
class platformsModel extends CI_Model
{
		public $title;
		public $description;
		public $theme;
		public $registered;
		public $updated;
		public $id_user;
		
		protected $table='PLT_PLATFORMS';
		
        public function createPlatform($title, $description, $theme, $userID)
        {
			$this->title=$title;
			$this->description=$description;
			$this->theme=$theme;
			$this->registered=time();
            $this->updated=time();
			$this->id_user=$userID;
            $this->db->insert($this->table, $this);
        }
		
		public function getPlatformsByUserID($userID){
			$query=$this->db->get_where($this->table, array('id_user' => $userID));
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID;
				$platforms[$i]['title']=$platform->TITLE;
				$platforms[$i]['description']=$platform->DESCRIPTION;
				$platforms[$i]['theme']=$platform->THEME;
				$i++;
			}				
			return $platforms;
		}
		
		public function getPlatforms(){
			$query=$this->db->get_where($this->table, array());
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID;
				$platforms[$i]['idUser']=$platform->ID_USER;
				$platforms[$i]['title']=$platform->TITLE;
				$platforms[$i]['description']=$platform->DESCRIPTION;
				$platforms[$i]['theme']=$platform->THEME;
				$i++;
			}				
			return $platforms;
		}
		
		public function getPlatformsByID($id){
			$query=$this->db->get_where($this->table, array('id' => $id));
			$platform=$query->result();
			$platformData['id']=$platform[0]->ID;
			$platformData['idUser']=$platform[0]->ID_USER;
			$platformData['title']=$platform[0]->TITLE;
			$platformData['description']=$platform[0]->DESCRIPTION;
			$platformData['theme']=$platform[0]->THEME;
			$platformData['registration_date']=date("d/m/Y", $platform[0]->REGISTERED);
			return $platformData;
		}
		
		public function getPlatformsByFilter($filter){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->like('title', $filter, 'both');
			$this->db->or_like('description', $filter, 'both');
			$this->db->or_like('theme', $filter, 'both');
			$query = $this->db->get();
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID;
				$platforms[$i]['idUser']=$platform->ID_USER;
				$platforms[$i]['title']=$platform->TITLE;
				$platforms[$i]['description']=$platform->DESCRIPTION;
				$platforms[$i]['theme']=$platform->THEME;
				$i++;
			}				
			return $platforms;
		}
		
		public function getMostPopularPlatforms(){
			$this->db->select('count(*) as NEWS_COUNT, PLT_NEWS.ID_PLATFORM as ID_PLATFORM, PLT_PLATFORMS.TITLE as TITLE, PLT_PLATFORMS.THEME as THEME');
			$this->db->from("PLT_NEWS");
			$this->db->join('PLT_PLATFORMS', 'PLT_NEWS.ID_PLATFORM = PLT_PLATFORMS.ID');
			$this->db->group_by('ID_PLATFORM');

			$query = $this->db->get();
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID_PLATFORM;
				$platforms[$i]['title']=$platform->TITLE;
				$platforms[$i]['theme']=$platform->THEME;
				$platforms[$i]['newsCount']=$platform->NEWS_COUNT;
				$i++;
			}				
			return $platforms;
		}
		
		public function susbribeUser($idUser, $idPlatform){
			$data = array(
					'id_user' => $idUser,
					'id_platform' => $idPlatform,
					'date' => time()
			);
			$this->db->insert('PLT_SUSCRIPTIONS', $data);	
		}
		
		public function unsusbribeUser($idUser, $idPlatform){
			$this->db->delete('PLT_SUSCRIPTIONS', array('id_user' => $idUser, 'id_platform' => $idPlatform));
		}
		
		public function isUserSuscribed($idUser, $idPlatform){			
			$query=$this->db->get_where('PLT_SUSCRIPTIONS', array('id_user' => $idUser, 'id_platform' => $idPlatform));
			$result=$query->result();
			if (sizeof($result) > 0) return true;
			else return false;
		}
		
		public function getPlatformsSuscribedByUser($idUser){
			$this->db->select('PLT_PLATFORMS.*');
			$this->db->from($this->table);
			$this->db->join('PLT_SUSCRIPTIONS', 'PLT_SUSCRIPTIONS.ID_PLATFORM = PLT_PLATFORMS.ID');
			$this->db->where('PLT_SUSCRIPTIONS.ID_USER', $idUser);

			$query = $this->db->get();
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID;
				$platforms[$i]['title']=$platform->TITLE;
				$platforms[$i]['theme']=$platform->THEME;
				$i++;
			}				
			return $platforms;
		}
		
		public function setAdministrator($idUser, $idPlatform){
			$data = array(
					'id_user' => $idUser,
					'id_platform' => $idPlatform,
					'date' => time()
			);
			$this->db->insert('PLT_ADMINISTRATORS', $data);	
		}
		
		public function deleteAdministrator($idUser, $idPlatform){
			$this->db->delete('PLT_ADMINISTRATORS', array('id_user' => $idUser, 'id_platform' => $idPlatform));
		}
		
		public function isAdministrator($idUser, $idPlatform){			
			$query=$this->db->get_where('PLT_ADMINISTRATORS', array('id_user' => $idUser, 'id_platform' => $idPlatform));
			$result=$query->result();
			if (sizeof($result) > 0) return true;
			else return false;
		}
		
		public function getPlatformsAdministratedByUser($idUser){
			$this->db->select('PLT_PLATFORMS.*');
			$this->db->from($this->table);
			$this->db->join('PLT_ADMINISTRATORS', 'PLT_ADMINISTRATORS.ID_PLATFORM = PLT_PLATFORMS.ID');
			$this->db->where('PLT_ADMINISTRATORS.ID_USER', $idUser);
			$this->db->where('PLT_ADMINISTRATORS.ID_USER', $idUser);

			$query = $this->db->get();
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID;
				$platforms[$i]['title']=$platform->TITLE;
				$platforms[$i]['theme']=$platform->THEME;
				$i++;
			}				
			return $platforms;
		}
		
		public function getAdministrators($idPlatform){
			$this->db->select('PLT_USERS.ID as ID_USER, PLT_USERS.USERNAME as USERNAME');
			$this->db->from("PLT_ADMINISTRATORS");
			$this->db->join('PLT_USERS', 'PLT_USERS.ID = PLT_ADMINISTRATORS.ID_USER');
			$this->db->where('PLT_ADMINISTRATORS.ID_PLATFORM', $idPlatform);
			$query = $this->db->get();
			$i=0;
			$platforms=array();
			foreach ($query->result() as $platform){
				$platforms[$i]['id']=$platform->ID_USER;
				$platforms[$i]['username']=$platform->USERNAME;
				$i++;
			}				
			return $platforms;
		}
}