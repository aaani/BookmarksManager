<?

class DatabaseConnection {
  public $connection = null ;

  public function __construct($autosetup = false){
    if ($autosetup){
      $this->setConnection() ;
    }
  }

  public function getProducts(){//Move it to another class if you wish
    $this->query($sql_to_get_products);
  }

  public function query($sql) {
    if (!$this->connection || !$this->connection->ping()){
      $this->setConnection() ;
    }
    return $this->connection->query($sql);
  }
	
  public function lastInsertId(){
  	return $this->connection->insert_id;
  }
  
  public function setConnection(){
    $this->connection = new MySQLi("localhost", "root", "root", "Bookmark") ;
  }

  public function connectionAvailable(){
    return ($connection && $connection->ping()) ;
  }
}


?>