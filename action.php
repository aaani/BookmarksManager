<?

abstract class Action{
	abstract function PerformAction(user $user, bookmark $bookmark);
	abstract function CheckDataRequirement();
}


class AddBookmark extends Action{
	function PerformAction(user $user, bookmark $bookmark){
			
		$query="Insert into bookmarks (id,latitude,longitude,address,name,userid) values ('$bookmark->id','$bookmark->lat','$bookmark->lng','$bookmark->address','$bookmark->name','".$user->id."')";
		$mysql= new DatabaseConnection();
		
		if(!$mysql->query($query)){
			echo $mysql->connection->error;
  		}
		echo $mysql->lastInsertId;
	}
	
	function CheckDataRequirement(){
		if(!(isset($_REQUEST['lat']) && isset($_REQUEST['lng']) && isset($_REQUEST['user']))){
			die("Insufficient parameters supplied.");
		}
	}
}

class DeleteBookmark extends Action{
	function PerformAction(user $user, bookmark $bookmark){
		$query="Delete from bookmarks where latitude='$bookmark->lat' AND longitude='$bookmark->lng' AND id='$user->id'";
		echo $query;
		$mysql= new DatabaseConnection();
		
		if(!$mysql->query($query)){
			echo $mysql->connection->error;
  		}
	}
	
	function CheckDataRequirement(){
		if(!(isset($_REQUEST['lat']) && isset($_REQUEST['lng']) && isset($_REQUEST['user']))){
			die("Insufficient parameters supplied for delete action");
		}
	}
}


?>