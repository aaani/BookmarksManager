<?

abstract class Action{
	abstract function PerformAction(user $user);
	abstract function CheckDataRequirement();
}


class AddBookmark extends Action{
	function PerformAction(user $user){
		
		$addr="";
		if(isset($_REQUEST['address'])) $addr=$_REQUEST['address'];
		$type="";
		if(isset($_REQUEST['type'])) $type=$_REQUEST['type'];

		$bookmark=new bookmark($_REQUEST['apikey'],$_REQUEST['lat'],$_REQUEST['lng'],$addr, $type);
			
		$query="Insert into bookmarks (id,latitude,longitude,address,type,userid) values ('$bookmark->id','$bookmark->lat','$bookmark->lng','$bookmark->address','$bookmark->name','".$user->id."')";
		$mysql= new DatabaseConnection();
		
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

class DeleteBookmark extends Action{
	function PerformAction(user $user){
		
		$bookmark=new bookmark($_REQUEST['apikey'],$_REQUEST['lat'],$_REQUEST['lng'],"","");
				
		$query="Delete from bookmarks where latitude='$bookmark->lat' AND longitude='$bookmark->lng' AND userid='$user->id'";
		$mysql= new DatabaseConnection();
		
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