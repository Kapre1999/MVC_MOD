<?php 
/**
 * PDO Database Class
 * Connect to Database
 * Create Prepare Statements
 * Bind Values
 * Return rows And Values
 * 
 */
class Database
{
	private $host = DB_HOST;
	private $user = DB_USER;
	private $dbname = DB_NAME;
	private $pass = DB_PASS;

	private $dbh;
	private $error;
	private $stmt;

	public function __construct()
	{
		//Set The dsn
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		);

		//Create PDO instance 
		try {
			$this->dbh = new PDO($dsn,$this->user,$this->pass,$options);
		} catch (PDOException $e) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}


	//Prepare the Query Statement
	public function query($sql)
	{
		$this->stmt = $this->dbh->prepare($sql);
	}

	//Binding the values
	public function bind($param,$value,$type=null)
	{
		if (is_null($type)) {
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;
				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;
				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;
				default:
					$type = PDO::PARAM_STR;
					break;
			}
		}
		$this->stmt->bindValue($param,$value,$type);
	}

	//Execute the Prepared Stmt
	public function execute()
	{
		return $this->stmt->execute();
	}

	//Get result set as array of object
	//
	public function resultSet()
	{
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	//Get a Single Row as  result
	public function single()
	{
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	//Get Row Count
	//
	public function rowCount()
	{
		return $this->stmt->rowCount();
	}
}


?>