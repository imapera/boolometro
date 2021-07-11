<?php
class informerModel extends CI_Model
{
		public $name;
		public $description;
		public $social_Link1;
		public $social_Link2;
		public $social_Link3;
		public $registered;
		public $updated;
		
		protected $table='PLT_INFORMERS';
		
        public function registerInformer($name, $description, $socialLink1, $socialLink2, $socialLink3)
        {
			$this->name=$name;
			$this->description=$description;
			$this->social_Link1=$socialLink1;
			$this->social_Link2=$socialLink2;
			$this->social_Link3=$socialLink3;
			$this->registered=time();
            $this->updated=time();
            return $this->db->insert($this->table, $this);
        }
		
        public function editInformer($id, $name, $description, $socialLink1, $socialLink2, $socialLink3)
        {			
			$data = array(
				'name' => $name,
				'description' => $description,
				'social_link1' => $socialLink1,
				'social_link2' => $socialLink2,
				'social_link2' => $socialLink2,
				'updated' => time()
			);			
			$this->db->where('id', $id);
			$this->db->update($this->table, $data);
        }
		
		public function getInfomerById($id){
			$query=$this->db->get_where($this->table, array('id' => $id));
			$informer=$query->result();
			$informerData['id']=$informer[0]->ID;
			$informerData['name']=$informer[0]->NAME;
			$informerData['description']=$informer[0]->DESCRIPTION;
			$informerData['socialLink1']=$informer[0]->SOCIAL_LINK1;
			$informerData['socialLink2']=$informer[0]->SOCIAL_LINK2;
			$informerData['socialLink3']=$informer[0]->SOCIAL_LINK3;
			$informerData['registered']=date("d/m/Y", $informer[0]->REGISTERED);
			return $informerData;		
		}
		
		public function getAllInformers(){
			$query=$this->db->get_where($this->table, array());
			$i=0;
			$informers=array();
			foreach ($query->result() as $informer){
				$informers[$i]['id']=$informer->ID;
				$informers[$i]['name']=$informer->NAME;
				$informers[$i]['description']=$informer->DESCRIPTION;
				$informers[$i]['socialLink1']=$informer->SOCIAL_LINK1;
				$informers[$i]['socialLink2']=$informer->SOCIAL_LINK2;
				$informers[$i]['socialLink3']=$informer->SOCIAL_LINK3;
				$informers[$i]['registered']=date("d/m/Y", $informer->REGISTERED);
				$i++;
			}
			return $informers;		
		}
		
		public function getInformersByFilter($filter){
			$this->db->select('*');
			$this->db->from($this->table);
			$this->db->like('name', $filter, 'both');
			$this->db->or_like('description', $filter, 'both');
			$query = $this->db->get();
			$i=0;
			$informers=array();
			foreach ($query->result() as $informer){
				$informers[$i]['id']=$informer->ID;
				$informers[$i]['name']=$informer->NAME;
				$informers[$i]['description']=$informer->DESCRIPTION;
				$informers[$i]['socialLink1']=$informer->SOCIAL_LINK1;
				$informers[$i]['socialLink2']=$informer->SOCIAL_LINK2;
				$informers[$i]['socialLink3']=$informer->SOCIAL_LINK3;
				$informers[$i]['registered']=date("d/m/Y", $informer->REGISTERED);
				$i++;
			}
			return $informers;		
		}
		
		public function getAllInformersMin(){
			$query=$this->db->get_where($this->table, array());
			$i=0;
			$informers=array();
			foreach ($query->result() as $informer){
				$informers[$i]['id']=$informer->ID;
				$informers[$i]['name']=$informer->NAME;
				$i++;
			}
			return $informers;		
		}
		
		public function getTopInformers(){
			$this->db->select('*');
			$this->db->from('PLT_TOP_INFORMERS');
			$this->db->order_by('NEWS_COUNT', 'DESC');
			$query=$this->db->get();
			$i=0;
			$informers=array();
			foreach ($query->result() as $informer){
				$informers[$i]['id']=$informer->ID;
				$informers[$i]['name']=$informer->NAME;
				$informers[$i]['description']=$informer->DESCRIPTION;
				$informers[$i]['socialLink1']=$informer->SOCIAL_LINK1;
				$informers[$i]['socialLink2']=$informer->SOCIAL_LINK2;
				$informers[$i]['socialLink3']=$informer->SOCIAL_LINK3;
				$informers[$i]['newsCount']=$informer->NEWS_COUNT;
				$informers[$i]['registered']=date("d/m/Y", $informer->REGISTERED);
				$i++;
			}
			return $informers;		
		}
}