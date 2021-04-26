<?php
  class categoryModel extends CI_Model{
		public function getAll(){
			$query =	$this->db->select('name,category.id, COUNT(post.cate_id) as totally')
         ->from('category')
         ->join('post', 'post.cate_id = category.id','left outer')
         ->group_by('post.cate_id,category.id,name')
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
		public function insertDataToMysql($name)
	{
		// xu ly thong tin nhan ve va upload vao mysql
		$dulieu = array(
			'name' => $name
			);

		$this->db->insert('category', $dulieu);
		return $this->db->insert_id();
	}

		public function update($id,$name){
			$updateData = array(
				'id'=>$id,
				'name'=>$name
			);
			$this->db->where('id',$id);
			return $this->db->update('category',$updateData);
	}


		public function delete($id){
			$results = $this->db->delete('category',array('id'=>$id));
      return $results;
		}
	}
?>
