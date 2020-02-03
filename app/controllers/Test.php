<?php 


/**
 * Test
 */
class Test extends Controller
{
	private $userModel;
	
	public function __construct()
	{
		$this->userModel = $this->model('User');
	}

	public function Index()
	{
		$data=[
			'E'=>"Abc",
		];
		return $this->view('home',$data);
	}

	public function formProcess(){
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (isset($_POST['CSRF_TOKEN'])) {
				# code...
				if (csrfValidator($_POST['CSRF_TOKEN'])){
				
					$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

					$data = [
						'permission' => checkFile($_FILES['image']),
					];

					if ($data['permission'] == 'Allowed'){
						$data['image_uploade'] = UploadImage($_FILES);
					}
					else{
						$data['image_uploade_error']  = "File Type Not Allowed";
					}

					if ($data['image_uploade'] == 'DNP404') {
						$data['image_uploade_error'] = "SOME ERROR OCCURED PLEASE TRY AGAIN";
					}

					return $this->view('form',$data);
				}else{
					$data['csrf_error'] = "<div class='alert alert-danger' role='alert'>ERROR: CSRF TOKEN ERROR</div>";
					return $this->view('form',$data); 
				}
			}
			else{
				$data['csrf_error'] = "<div class='alert alert-danger' role='alert'>ERROR: Invalid Action</div>";
				return $this->view('form',$data);
			}
		}
		else{
			return $this->view('form');
		}
	}
	public function userRegister(){
		if ($_SERVER['REQUEST_METHOD']=='POST') {
			$_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
			$formCheck = checkUserRegisterForm($_POST);
			if (empty($formCheck['error'])) {
				//$this->userModel = $this->model('User');
				$data = [
					'name'=>trim($_POST['name']),
					'email'=>trim($_POST['email']),
					'password'=>password_hash(trim($_POST['password']),PASSWORD_DEFAULT),
					'confirm_password'=>trim($_POST['confirm_password']),
				];
				if ($this->userModel->emailCheck($data['email'])) {
					if ($this->userModel->registerUser($data)) {
						$data['success'] = "Registered Success";
						return $this->view('userForm',$data);
					}
				}
				else{
					$data['error'] = array("Email Alredy Exists");
					return $this->view('userForm',$data);
				}
			}
			else{
				$data = [
					'name'=>trim($_POST['name']),
					'email'=>trim($_POST['email']),
					'password'=>trim($_POST['password']),
					'confirm_password'=>trim($_POST['confirm_password']),
					'error'=>$formCheck,
				];
				return $this->view('userForm',$data);
			}
		}
		else{
			// $data = [
			// 	'name'=>trim($_POST['name']),
			// 	'email'=>trim($_POST['email']),
			// 	'password'=>trim($_POST['password']),
			// 	'confirm_password'=>trim($_POST['confirm_password']),
			// ];
			return $this->view('userForm');
		}
	}
}


?>