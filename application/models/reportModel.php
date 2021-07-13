<?php
class reportModel extends CI_Model
{
		public $id_resource;
		public $type_resource;
		public $message;
		public $reason;
		public $registered;
		public $checked;
		
		protected $table='PLT_REPORTS';
		
        public function report($idResource, $typeResourse, $message, $reason)
        {
			$this->id_resource=$idResource;
			$this->type_resource=$typeResourse;
			$this->message=$message;
			$this->reason=$reason;
			$this->registered=time();
			$this->checked=0;
            $this->db->insert($this->table, $this);
        }
		
		public function getPlaftormsReports($platformId, $onlyNotChecked){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('ID_RESOURCE', $platformId);
			$this->db->where('TYPE_RESOURCE', 0);
			if ($onlyNotChecked){
				$this->db->where('CHECKED', 0);				
			}
			$this->db->order_by('REGISTERED', 'DESC');
			$query = $this->db->get();
			$i=0;
			$reports=array();
			foreach ($query->result() as $report){
				$reports[$i]['id']=$report->ID;
				$reports[$i]['idResource']=$report->ID_RESOURCE;
				$reports[$i]['typeResource']=$report->TYPE_RESOURCE;
				$reports[$i]['message']=$report->MESSAGE;
				$reports[$i]['reason']=$report->REASON;	
				switch($report->REASON){
					case 'badInformation':
						$reports[$i]['reasonOnText']="Información incorrecta o errónea";
						break;
					case 'unrespectful':
						$reports[$i]['reasonOnText']="Faltas de respeto";
						break;
					case 'badLanguaje':
						$reports[$i]['reasonOnText']="Lenguaje inapropiado";
						break;
					case 'others':
						$reports[$i]['reasonOnText']="Otros";
						break;
					default:
						$reports[$i]['reasonOnText']="Otros";	
						break;				
				}			
				$reports[$i]['date']=date("d/m/Y", $report->REGISTERED);
				$reports[$i]['checked']=$report->CHECKED;
				$i++;
			}				
			return $reports;
		}
		
		public function getInformersReports($onlyNotChecked){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->where('TYPE_RESOURCE', 1);
			if ($onlyNotChecked){
				$this->db->where('CHECKED', 0);				
			}
			$this->db->order_by('REGISTERED', 'DESC');
			$query = $this->db->get();
			$i=0;
			$reports=array();
			foreach ($query->result() as $report){
				$reports[$i]['id']=$report->ID;
				$reports[$i]['idResource']=$report->ID_RESOURCE;
				$reports[$i]['typeResource']=$report->TYPE_RESOURCE;
				$reports[$i]['message']=$report->MESSAGE;
				$reports[$i]['reason']=$report->REASON;
				switch($report->REASON){
					case 'badInformation':
						$reports[$i]['reasonOnText']="Información incorrecta o errónea";
						break;
					case 'unrespectful':
						$reports[$i]['reasonOnText']="Faltas de respeto";
						break;
					case 'badLanguaje':
						$reports[$i]['reasonOnText']="Lenguaje inapropiado";
						break;
					case 'others':
						$reports[$i]['reasonOnText']="Otros";
						break;
					default:
						$reports[$i]['reasonOnText']="Otros";	
						break;				
				}
				$reports[$i]['date']=date("d/m/Y", $report->REGISTERED);
				$reports[$i]['checked']=$report->CHECKED;
				$i++;
			}				
			return $reports;
		}
		
		public function getNewsReports($platformId, $onlyNotChecked){
			$this->db->select('PLT_NEWS.ID, PLT_REPORTS.*');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_REPORTS', 'PLT_REPORTS.ID_RESOURCE = PLT_NEWS.ID');
			$this->db->where('ID_PLATFORM', $platformId);
			$this->db->where('TYPE_RESOURCE', 2);
			if ($onlyNotChecked){
				$this->db->where('CHECKED', 0);				
			}
			$this->db->order_by('REGISTERED', 'DESC');
			$query = $this->db->get();
			$i=0;
			$reports=array();
			foreach ($query->result() as $report){
				$reports[$i]['id']=$report->ID;
				$reports[$i]['idResource']=$report->ID_RESOURCE;
				$reports[$i]['typeResource']=$report->TYPE_RESOURCE;
				$reports[$i]['message']=$report->MESSAGE;
				$reports[$i]['reason']=$report->REASON;
				switch($report->REASON){
					case 'badInformation':
						$reports[$i]['reasonOnText']="Información incorrecta o errónea";
						break;
					case 'unrespectful':
						$reports[$i]['reasonOnText']="Faltas de respeto";
						break;
					case 'badLanguaje':
						$reports[$i]['reasonOnText']="Lenguaje inapropiado";
						break;
					case 'others':
						$reports[$i]['reasonOnText']="Otros";
						break;
					default:
						$reports[$i]['reasonOnText']="Otros";	
						break;				
				}
				$reports[$i]['date']=date("d/m/Y", $report->REGISTERED);
				$reports[$i]['checked']=$report->CHECKED;
				$i++;
			}				
			return $reports;
		}
		
		public function getCommentsReports($platformId, $onlyNotChecked){
			$this->db->select('PLT_NEWS.ID_PLATFORM as ID_PLATFORM, PLT_NEWS.ID as ID_NEW, PLT_COMMENTS.CONTENT as COMMENT_CONTENT, PLT_REPORTS.*');
			$this->db->from('PLT_REPORTS');
			$this->db->join('PLT_COMMENTS', 'PLT_REPORTS.ID_RESOURCE = PLT_COMMENTS.ID');
			$this->db->join('PLT_NEWS','PLT_NEWS.ID = PLT_COMMENTS.ID_NEW');
			$this->db->where('ID_PLATFORM', $platformId);
			$this->db->where('TYPE_RESOURCE', 3);
			if ($onlyNotChecked){
				$this->db->where('CHECKED', 0);				
			}
			
			$query = $this->db->get();
			$i=0;
			$reports=array();
			foreach ($query->result() as $report){
				$reports[$i]['id']=$report->ID;
				$reports[$i]['idResource']=$report->ID_RESOURCE;
				$reports[$i]['idNew']=$report->ID_NEW;
				$reports[$i]['typeResource']=$report->TYPE_RESOURCE;
				$reports[$i]['message']=$report->MESSAGE;
				$reports[$i]['reason']=$report->REASON;
				switch($report->REASON){
					case 'badInformation':
						$reports[$i]['reasonOnText']="Información incorrecta o errónea";
						break;
					case 'unrespectful':
						$reports[$i]['reasonOnText']="Faltas de respeto";
						break;
					case 'badLanguaje':
						$reports[$i]['reasonOnText']="Lenguaje inapropiado";
						break;
					case 'others':
						$reports[$i]['reasonOnText']="Otros";
						break;
					default:
						$reports[$i]['reasonOnText']="Otros";	
						break;				
				}
				$reports[$i]['commentContent']=$report->COMMENT_CONTENT;
				$reports[$i]['date']=date("d/m/Y", $report->REGISTERED);
				$reports[$i]['checked']=$report->CHECKED;
				$i++;
			}				
			return $reports;
		}
		
		public function checkedReport($id)
        {
			$data = array(
				'checked' => 1,
			);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
        }
}