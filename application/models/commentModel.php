<?php
class commentModel extends CI_Model
{
		public $id_user;
		public $id_new;
		public $content;
		public $registered;
		
		protected $table='PLT_COMMENTS';
		
        public function addComment($id_user, $id_new, $content)
        {
			$this->id_user=$id_user;
			$this->id_new=$id_new;
			$this->content=$content;
			$this->registered=time();
            $this->db->insert($this->table, $this);
        }
		
		public function getCommentsByNewId($idNew){
			$this->db->select('PLT_COMMENTS.*, PLT_USERS.USERNAME as USER_USERNAME');
			$this->db->from('PLT_COMMENTS');
			$this->db->join('PLT_USERS', 'PLT_COMMENTS.ID_USER = PLT_USERS.ID');
			$this->db->where('PLT_COMMENTS.ID_NEW', $idNew);
			$this->db->order_by('REGISTERED', 'DESC');
			$query = $this->db->get();
			$i=0;
			$comments=array();
			foreach ($query->result() as $comment){
				$comments[$i]['id']=$comment->ID;
				$comments[$i]['idUser']=$comment->ID_USER;
				$comments[$i]['idNew']=$comment->ID_NEW;
				$comments[$i]['content']=$comment->CONTENT;
				$comments[$i]['date']=date("d/m/Y", $comment->REGISTERED);
				$comments[$i]['username']=$comment->USER_USERNAME;
				$i++;
			}				
			return $comments;
		}
		
		public function getCommentsByUserId($idUser){
			$this->db->select('PLT_COMMENTS.*, PLT_USERS.USERNAME as USER_USERNAME, PLT_NEWS.TITLE as NEW_TITLE');
			$this->db->from('PLT_COMMENTS');
			$this->db->join('PLT_USERS', 'PLT_COMMENTS.ID_USER = PLT_USERS.ID');
			$this->db->join('PLT_NEWS', 'PLT_NEWS.ID = PLT_COMMENTS.ID_NEW');
			$this->db->where('PLT_COMMENTS.ID_USER', $idUser);
			$this->db->order_by('REGISTERED', 'DESC');
			$query = $this->db->get();
			$i=0;
			$comments=array();
			foreach ($query->result() as $comment){
				$comments[$i]['id']=$comment->ID;
				$comments[$i]['idUser']=$comment->ID_USER;
				$comments[$i]['idNew']=$comment->ID_NEW;
				$comments[$i]['content']=$comment->CONTENT;
				$comments[$i]['date']=date("d/m/Y", $comment->REGISTERED);
				$comments[$i]['username']=$comment->USER_USERNAME;
				$comments[$i]['newTitle']=$comment->NEW_TITLE;
				$i++;
			}				
			return $comments;
		}
		
		public function getCommentById($id){
			$query=$this->db->get_where($this->table, array('id' => $id));
			$comment=$query->result();
			$commentData['id']=$comment[0]->ID;
			$commentData['idUser']=$comment[0]->ID_USER;
			$commentData['idNew']=$comment[0]->ID_NEW;
			$commentData['CONTENT']=$comment[0]->CONTENT;
			$commentData['registration_date']=date("d/m/Y", $comment[0]->REGISTERED);
			return $commentData;
		}
		
		public function deleteComment($id){
			$this->db->delete('PLT_COMMENTS', array('id' => $id));			
		}		
}