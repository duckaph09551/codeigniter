<?php
class categoryController extends CI_Controller
{
	public function __construct() {
	 	parent::__construct();
	 	$this->load->library('form_validation');
		 $this->load->model('categoryModel');

	}
		public function index()
		{
		 	// $data['category'] = $this->categoryModel->getAll();
			 $this->load->view('admin/templates/header.php');
			 $this->load->view('admin/category/index.php');
			 $this->load->view('admin/templates/footer.php');

		}

		public function show_all(){
        $result = $this->categoryModel->getAll();
				header('Content-Type: application/json');
        echo json_encode($result);
		}

		public function delete($id)
  {
    $item = $this->categoryModel->delete($id);
    header('Content-Type: application/json');
    echo json_encode(['status' => "success"]);
  }

	public function store()
  {
    $name = $this->input->post('name');
		$this->load->model('categoryModel');
		$trangthai = $this->categoryModel->insertDataToMysql($name);
		if($trangthai)
		{
		   header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);

		}
		else {
		   header('Content-Type: application/json');
       echo json_encode(['status' => "error"]);
		}


  }

  public function edit($id){
    $this->load->database();
    $q = $this->db->get_where('category', array('id' => $id));
    echo json_encode($q->row());
  }

  public function update($id){
    $name = $this->input->post('name');
    $id = $this->input->post('id');
		$this->load->model('categoryModel');
		$trangthai = $this->categoryModel->update($id,$name);
		if($trangthai)
		{
		   header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);

		}
		else {
		   header('Content-Type: application/json');
       echo json_encode(['status' => "error"]);
		}
  }

}
?>