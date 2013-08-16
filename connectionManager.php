<?
/*
 * mySQL Database connection manager
 */
class DatabaseConnection {
  public $connection = null ;

  public function __construct($autosetup = false){
    if ($autosetup){
      $this->setConnection() ;
    }
  }

  public function getProducts(){
    $this->query($sql_to_get_products);
  }

  public function query($sql) {
    if (!$this->connection || !$this->connection->ping()){
      $this->setConnection() ;
    }
    return $this->connection->query($sql);
  }
	
  public function setConnection(){
  	$host="localhost";
	$user="root";
	$password="root";
	$db="Bookmark";
    $this->connection = new MySQLi($host, $user ,$password ,$db ) ; //<< setup your database credentials
  }

  public function connectionAvailable(){
    return ($connection && $connection->ping()) ;
  }
}


?>