<?php
class newModel extends CI_Model
{
		public $title;
		public $resume;
		public $description;
		public $origin_date;
		public $link1;
		public $link2;
		public $link3;
		public $result_date;
		public $result;
		public $result_description;
		public $id_informer;
		public $id_platform;
		public $registered;
		public $updated;
		
		protected $table='PLT_NEWS';
		
        public function createNew($title, $resume, $description, $originDate, $resultDate, $link1, $link2, $link3, $idInformer, $idPlatform)
        {
			$this->title=$title;
			$this->resume=$resume;
			$this->description=$description;
			$this->origin_date=mktime(0, 0, 0, $originDate[3].$originDate[4], $originDate[0].$originDate[1], $originDate[6].$originDate[7].$originDate[8].$originDate[9]);
			$this->result_date=mktime(0, 0, 0, $resultDate[3].$resultDate[4], $resultDate[0].$resultDate[1], $resultDate[6].$resultDate[7].$resultDate[8].$resultDate[9]);
			$this->result=0;
			$this->link1=$link1;
			$this->link2=$link2;
			$this->link3=$link3;
			$this->id_informer=$idInformer;
			$this->id_platform=$idPlatform;
			$this->registered=time();
            $this->updated=time();
            $this->db->insert($this->table, $this);
        }
		
        public function editNew($id, $title, $resume, $description, $originDate, $resultDate, $link1, $link2, $link3, $idInformer, $idPlatform)
        {
			$data = array(
				'title' => $title,
				'resume' => $resume,
				'description' => $description,
				'origin_date' => mktime(0, 0, 0, $originDate[3].$originDate[4], $originDate[0].$originDate[1], $originDate[6].$originDate[7].$originDate[8].$originDate[9]),
				'result_date' => mktime(0, 0, 0, $resultDate[3].$resultDate[4], $resultDate[0].$resultDate[1], $resultDate[6].$resultDate[7].$resultDate[8].$resultDate[9]),
				'link1' => $link1,
				'link2' => $link2,
				'link3' => $link3,
				'id_informer' => $idInformer,
				'id_platform' => $idPlatform,
				'updated' => time()
			);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
        }
		
		public function editNewResult($id,$result, $resultDate, $resultDescription)
		{
			$data = array(
				'result' => $result,
				'result_date' => mktime(0, 0, 0, $resultDate[3].$resultDate[4], $resultDate[0].$resultDate[1], $resultDate[6].$resultDate[7].$resultDate[8].$resultDate[9]),
				'result_description' => $resultDescription,
				'updated' => time()
			);
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);			
		}
		
		public function getNewById($id){
			$this->db->select('PLT_NEWS.*, PLT_INFORMERS.NAME as INFORMER_NAME, PLT_PLATFORMS.ID_USER as ID_USER, PLT_PLATFORMS.TITLE as PLATFORM_TILTE');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_INFORMERS', 'PLT_NEWS.ID_INFORMER = PLT_INFORMERS.ID');
			$this->db->join('PLT_PLATFORMS', 'PLT_NEWS.ID_PLATFORM = PLT_PLATFORMS.ID');
			$this->db->where('PLT_NEWS.id', $id);
			$query = $this->db->get();
			$new=$query->result();
			$newData['id']=$new[0]->ID;
			$newData['title']=$new[0]->TITLE;
			$newData['resume']=$new[0]->RESUME;
			$newData['description']=$new[0]->DESCRIPTION;
			$newData['origin_date']=date("d/m/Y", $new[0]->ORIGIN_DATE);
			$newData['link1']=$new[0]->LINK1;
			$newData['link2']=$new[0]->LINK2;
			$newData['link3']=$new[0]->LINK3;
			$newData['result_date']=date("d/m/Y", $new[0]->RESULT_DATE);
			$newData['result']=$new[0]->RESULT;
			$newData['resultDescription']=$new[0]->RESULT_DESCRIPTION;
			$newData['idInformer']=$new[0]->ID_INFORMER;
			$newData['idPlatform']=$new[0]->ID_PLATFORM;
			$newData['registered']=date("d/m/Y", $new[0]->REGISTERED);
			$newData['informerName']=$new[0]->INFORMER_NAME;
			$newData['platformUserId']=$new[0]->ID_USER;
			$newData['platformTitle']=$new[0]->PLATFORM_TILTE;
			return $newData;		
		}
		
		public function getNewsByPlatformId($platformId){
			$this->db->select('PLT_NEWS.*, PLT_INFORMERS.NAME as INFORMER_NAME');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_INFORMERS', 'PLT_NEWS.ID_INFORMER = PLT_INFORMERS.ID');
			$this->db->where('PLT_NEWS.ID_PLATFORM', $platformId);
			$this->db->order_by('ORIGIN_DATE', 'DESC');
			$query = $this->db->get();
			$i=0;
			$news=array();
			foreach ($query->result() as $new){
				$news[$i]['id']=$new->ID;
				$news[$i]['title']=$new->TITLE;
				$news[$i]['resume']=$new->RESUME;
				$news[$i]['description']=$new->DESCRIPTION;
				$news[$i]['originDate']=date("d/m/Y", $new->ORIGIN_DATE);
				$news[$i]['link1']=$new->LINK1;
				$news[$i]['link2']=$new->LINK2;
				$news[$i]['link3']=$new->LINK3;
				$news[$i]['resultDate']=date("d/m/Y", $new->RESULT_DATE);
				$news[$i]['result']=$new->RESULT;
				$news[$i]['resultDescription']=$new->RESULT_DESCRIPTION;
				$news[$i]['informerId']=$new->ID_INFORMER;
				$news[$i]['platformId']=$new->ID_PLATFORM;
				$news[$i]['registered']=date("d/m/Y", $new->REGISTERED);
				$news[$i]['updated']=date("d/m/Y", $new->UPDATED);
				$news[$i]['informerName']=$new->INFORMER_NAME;
				$i++;
			}				
			return $news;
		}
		
		public function getNewsByInformerId($informerId){
			$this->db->select('PLT_NEWS.*, PLT_INFORMERS.NAME as INFORMER_NAME, PLT_PLATFORMS.TITLE as PLATFORM_TILTE');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_INFORMERS', 'PLT_NEWS.ID_INFORMER = PLT_INFORMERS.ID');
			$this->db->join('PLT_PLATFORMS', 'PLT_NEWS.ID_PLATFORM = PLT_PLATFORMS.ID');
			$this->db->where('PLT_NEWS.ID_INFORMER', $informerId);
			$this->db->order_by('PLT_NEWS.ORIGIN_DATE DESC');
			$query = $this->db->get();
			$i=0;
			$news=array();
			foreach ($query->result() as $new){
				$news[$i]['id']=$new->ID;
				$news[$i]['title']=$new->TITLE;
				$news[$i]['resume']=$new->RESUME;
				$news[$i]['description']=$new->DESCRIPTION;
				$news[$i]['originDate']=date("d/m/Y", $new->ORIGIN_DATE);
				$news[$i]['link1']=$new->LINK1;
				$news[$i]['link2']=$new->LINK2;
				$news[$i]['link3']=$new->LINK3;
				$news[$i]['resultDate']=date("d/m/Y", $new->RESULT_DATE);
				$news[$i]['result']=$new->RESULT;
				$news[$i]['resultDescription']=$new->RESULT_DESCRIPTION;
				$news[$i]['informerId']=$new->ID_INFORMER;
				$news[$i]['platformId']=$new->ID_PLATFORM;
				$news[$i]['registered']=date("d/m/Y", $new->REGISTERED);
				$news[$i]['updated']=date("d/m/Y", $new->UPDATED);
				$news[$i]['informerName']=$new->INFORMER_NAME;
				$news[$i]['platformTitle']=$new->PLATFORM_TILTE;
				$i++;
			}				
			return $news;
		}
		
		public function getNewsByFilter($filter){
			$this->db->select('PLT_NEWS.*, PLT_INFORMERS.NAME as INFORMER_NAME');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_INFORMERS', 'PLT_NEWS.ID_INFORMER = PLT_INFORMERS.ID');
			$this->db->like('TITLE', $filter, 'both');
			$this->db->or_like('RESUME', $filter, 'both');
			$this->db->or_like('PLT_NEWS.DESCRIPTION', $filter, 'both');
			$this->db->or_like('RESULT', $filter, 'both');
			$this->db->or_like('PLT_INFORMERS.NAME', $filter, 'both');
			
			$query = $this->db->get();
			$i=0;
			$news=array();
			foreach ($query->result() as $new){
				$news[$i]['id']=$new->ID;
				$news[$i]['title']=$new->TITLE;
				$news[$i]['resume']=$new->RESUME;
				$news[$i]['description']=$new->DESCRIPTION;
				$news[$i]['originDate']=date("d/m/Y", $new->ORIGIN_DATE);
				$news[$i]['link1']=$new->LINK1;
				$news[$i]['link2']=$new->LINK2;
				$news[$i]['link3']=$new->LINK3;
				$news[$i]['resultDate']=date("d/m/Y", $new->RESULT_DATE);
				$news[$i]['result']=$new->RESULT;
				$news[$i]['resultDescription']=$new->RESULT_DESCRIPTION;
				$news[$i]['informerId']=$new->ID_INFORMER;
				$news[$i]['platformId']=$new->ID_PLATFORM;
				$news[$i]['registered']=date("d/m/Y", $new->REGISTERED);
				$news[$i]['updated']=date("d/m/Y", $new->UPDATED);
				$news[$i]['informerName']=$new->INFORMER_NAME;
				$i++;
			}				
			return $news;
		}
		
		public function getNewsByPlatformIdAndFilter($id, $filter){
			$this->db->select('PLT_NEWS.*, PLT_INFORMERS.NAME as INFORMER_NAME');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_INFORMERS', 'PLT_NEWS.ID_INFORMER = PLT_INFORMERS.ID');
			$this->db->like('TITLE', $filter, 'both');
			$this->db->or_like('RESUME', $filter, 'both');
			$this->db->or_like('PLT_NEWS.DESCRIPTION', $filter, 'both');
			$this->db->or_like('RESULT', $filter, 'both');
			$this->db->or_like('PLT_INFORMERS.NAME', $filter, 'both');
			$this->db->where('ID_PLATFORM', $id);
			
			$query = $this->db->get();
			$i=0;
			$news=array();
			foreach ($query->result() as $new){
				$news[$i]['id']=$new->ID;
				$news[$i]['title']=$new->TITLE;
				$news[$i]['resume']=$new->RESUME;
				$news[$i]['description']=$new->DESCRIPTION;
				$news[$i]['originDate']=date("d/m/Y", $new->ORIGIN_DATE);
				$news[$i]['link1']=$new->LINK1;
				$news[$i]['link2']=$new->LINK2;
				$news[$i]['link3']=$new->LINK3;
				$news[$i]['resultDate']=date("d/m/Y", $new->RESULT_DATE);
				$news[$i]['result']=$new->RESULT;
				$news[$i]['resultDescription']=$new->RESULT_DESCRIPTION;
				$news[$i]['informerId']=$new->ID_INFORMER;
				$news[$i]['platformId']=$new->ID_PLATFORM;
				$news[$i]['registered']=date("d/m/Y", $new->REGISTERED);
				$news[$i]['updated']=date("d/m/Y", $new->UPDATED);
				$news[$i]['informerName']=$new->INFORMER_NAME;
				$i++;
			}				
			return $news;
		}
		
		public function getNews(){
			$this->db->select('PLT_NEWS.*, PLT_INFORMERS.NAME as INFORMER_NAME');
			$this->db->from('PLT_NEWS');
			$this->db->join('PLT_INFORMERS', 'PLT_NEWS.ID_INFORMER = PLT_INFORMERS.ID');	
			$query = $this->db->get();
			$i=0;
			$news=array();
			foreach ($query->result() as $new){
				$news[$i]['id']=$new->ID;
				$news[$i]['title']=$new->TITLE;
				$news[$i]['resume']=$new->RESUME;
				$news[$i]['description']=$new->DESCRIPTION;
				$news[$i]['originDate']=date("d/m/Y", $new->ORIGIN_DATE);
				$news[$i]['link1']=$new->LINK1;
				$news[$i]['link2']=$new->LINK2;
				$news[$i]['link3']=$new->LINK3;
				$news[$i]['resultDate']=date("d/m/Y", $new->RESULT_DATE);
				$news[$i]['result']=$new->RESULT;
				$news[$i]['resultDescription']=$new->RESULT_DESCRIPTION;
				$news[$i]['informerId']=$new->ID_INFORMER;
				$news[$i]['platformId']=$new->ID_PLATFORM;
				$news[$i]['registered']=date("d/m/Y", $new->REGISTERED);
				$news[$i]['updated']=date("d/m/Y", $new->UPDATED);
				$news[$i]['informerName']=$new->INFORMER_NAME;
				$i++;
			}				
			return $news;
		}
		
		public function getInformerNewsCount($id){
			$this->db->select('*');
			$this->db->from('PLT_INFORMER_NEWS_COUNT');
			$this->db->where('ID', $id);
			$query = $this->db->get();
			$new=$query->result();
			$newData['id']=$new[0]->ID;
			$newData['correctNews']=$new[0]->CORRECT_NEWS;
			$newData['wrongNews']=$new[0]->WRONG_NEWS;
			return $newData;
		}
}