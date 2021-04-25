<?php
  class categoryModel extends CI_Model{
		public function getAll(){
			$query =	$this->db->select('name,category.id, COUNT(post.cate_id) as totally')
         ->from('category')
         ->join('post', 'post.cate_id = category.id','left')
         ->group_by('post.cate_id')
         ->get();
	   	return $query->result_array();

		}

		public function stores(){
			$data = array(
				'name' => $this->input->post('name'),
			);

			return $this->db->insert('category', $data);
      //  return $this->db->insert_id();
		}

		public function update($id){
			$data = [
				'name' => $this->input->post('name'),
			];
			$results = $this->db->where('id',$id)->update('category',$data);
			return $results;
		}

		public function delete($id){
			$results = $this->db->delete('category',array('id'=>$id));
      return $results;
		}
	}
?>