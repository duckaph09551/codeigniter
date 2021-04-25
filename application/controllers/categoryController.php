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

    // $this->form_validation->set_rules('name', 'Name', 'required');
    // if (!$this->form_validation->run())
    // {
    //   http_response_code(412);
    //   header('Content-Type: application/json');
    //   echo json_encode([
    //     'status' => 'error',
    //     'errors' => validation_errors()
    //   ]);
    // } else {

       $this->categoryModel->stores();
       header('Content-Type: application/json');
       echo json_encode(['status' => "success"]);
    // }


  }
}
?>