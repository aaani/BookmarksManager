<?

abstract class Action{
	/* Imlementation for your action
	 * Interact with database using DatabaseConnection class
	 * */
	abstract function PerformAction(user $user);
	
	/* Implement any kind of check on the request superglobals
	 * Commonly used to throw error if client hasn't sent appropriate data
	 */
	abstract function CheckDataRequirement();
}


/*
 * Sample implementation for adding bookmarks
 */
class AddBookmark extends Action{
	function PerformAction(user $user){
		
		$addr="";
		if(isset($_REQUEST['address'])) $addr=$_REQUEST['address'];
		$type="";
		if(isset($_REQUEST['type'])) $type=$_REQUEST['type'];

		$mysql= new DatabaseConnection();
		$bookmark=new bookmark($mysql->escape($_REQUEST['apikey']),$mysql->escape($_REQUEST['lat']),$mysql->escape($_REQUEST['lng']),$mysql->escape($addr), $mysql->escape($type));
			
		$query="Insert into bookmarks (id,latitude,longitude,address,type,userid) values ('$bookmark->id','$bookmark->lat','$bookmark->lng','$bookmark->address','$bookmark->name','".$user->id."')";
		
		if(!$mysql->query($query)){
			$result['errormessage']=$mysql->connection->error;
			echo json_encode($result);
  		}
	}
	
	function CheckDataRequirement(){
		if(!(isset($_REQUEST['lat']) && isset($_REQUEST['lng']))){ // && isset($_REQUEST['user']))){
			errorHandle::Terminate(errorHandle::INSUF_PAR_ADBOOK);
		}
	}
}

/*
 * Sample implementation for deleting bookmarks
 */
class DeleteBookmark extends Action{
	function PerformAction(user $user){
		
		$mysql= new DatabaseConnection();
		$bookmark=new bookmark($mysql->escape($_REQUEST['apikey']),$mysql->escape($_REQUEST['lat']),$mysql->escape($_REQUEST['lng']),"","");
				
		$query="Delete from bookmarks where latitude='$bookmark->lat' AND longitude='$bookmark->lng' AND userid='$user->id'";
		
		if(!$mysql->query($query)){
			$result['errormessage']=$mysql->connection->error;
			echo json_encode($result);
  		}
	}
	
	function CheckDataRequirement(){
		if(!(isset($_REQUEST['lat']) && isset($_REQUEST['lng']))){ // && isset($_REQUEST['user']))){
			errorHandle::Terminate(errorHandle::INSUF_PAR_DLBOOK);
		}
	}
}

/*
 * Sample implementation for listing all bookmarks
 */
class ListBookmark extends Action{
	function PerformAction(user $user){
						
		$query="Select * from bookmarks where userid='$user->id'";
		$mysql= new DatabaseConnection();
		$results=$mysql->query($query);
		
		$output= array();
		$count=0;
		while($row = mysqli_fetch_array($results))
  		{
  			$output[$count]['latitude']=$row['latitude'];
			$output[$count]['longitude']=$row['longitude'];
			$output[$count]['address']=$row['address'];
			$output[$count]['type']=$row['type'];
			
			$count++;
  		}

		echo json_encode($output);
	}
	
	function CheckDataRequirement(){

	}
}
?>