<?php 
class User{
	private $db;

	public function __construct()
	{
		# code...
		$this->db = new Database();
	}

	public function registerUser($data)
	{
		$this->db->query('INSERT INTO user(name,email,password) VALUES (:name,:email,:password)');
		$this->db->bind(':name',$data['name']);
		$this->db->bind(':email',$data['email']);
		$this->db->bind(':password',$data['password']);
		if($this->db->execute()){
			return true;
		}
		else{
			return false;
		}
	}
	public function emailCheck($emailId)
	{
		$this->db->query('SELECT * FROM user WHERE email = :email');
		$this->db->bind(':email',$emailId);
		$this->db->single();

		if ($this->db->rowCount() > 0 ) {
			return false;
		}
		else{
			return true;
		}

	}
}
?>