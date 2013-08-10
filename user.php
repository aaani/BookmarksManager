<?


class User{
	private $bookmarks;
	private $id;
	private $userSince;
	private $quota;
	
	public function performUserAction(Action $action, bookmark $bookmark){
		$action->PerformAction($this,$bookmark);
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


class userFactory{
	
	static function getUser($apikey){
		$query="select *, count(*) as count from users where apikey='$apikey'";
		$mysql= new DatabaseConnection();
		
		$result=$mysql->query($query);
		$row = $result->fetch_array();
		if($row['count']<1) return NULL; //No user registered with this APIKey
		return new User($row['id'],$row['usersince'],$row['quota']);
	}
	
	static function checkDataRequirement(){
		if(!(isset($_REQUEST['apikey']) )){
			die("Insufficient parameters supplied.");
		}
	}
}


?>