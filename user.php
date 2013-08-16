<?

/* User class
 * TO DO: Add support for multiple users per API key 
 * */
class user{
	private $bookmarks;
	private $id;
	private $userSince;
	private $quota;
	
	public function performUserAction(Action $action){
		$action->PerformAction($this);
	}
	
	public function getBookmarks(){
		return $bookmarks;
	}
	
	public function __get($property) {
    	if (property_exists($this, $property)) {
      		return $this->$property;
    	}
  	}
	
	public function __construct($id,$userSince,$quota){
		$this->id=$id;
		$this->userSince=$userSince;
		$this->quota=$quota;
	}
}

/*
 * User factory class; It returns the imaginary (super) user, whose id is same as the API key
 */
class userFactory{
	
	static function getUser($apikey){
		$query="select *, count(*) as count from users where apikey='$apikey'";
		$mysql= new DatabaseConnection();
		
		$result=$mysql->query($query);
		$row = $result->fetch_array();
		if($row['count']<1) return NULL; //No user registered with this APIKey
		return new user($apikey,$row['usersince'],$row['quota']); //Only one user
	}
	
	static function checkDataRequirement(){
		if(!(isset($_REQUEST['apikey']) )) errorHandle::Terminate(errorHandle::NULL_API_K);
	}
}


?>