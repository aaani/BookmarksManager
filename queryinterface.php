<?

require_once 'connectionManager.php';
require_once 'bookmark.php';
require_once 'user.php';
require_once 'action.php';

ini_set('display_errors',1); 
error_reporting(E_ALL);


if(!(isset($_REQUEST['action']))){
	die("Insufficient parameters supplied.");
}

$action=$_REQUEST['action'];
$APIkey=$_REQUEST['apikey'];

//Validate user
userFactory::checkDataRequirement();
$user = userFactory::getUser($APIkey);
if(is_null($user)) {
	die("Invalid API key."); 
}

//Validate action
$UserAction=$action."Bookmark";
if(class_exists($UserAction)) {
	 $action= new $UserAction();
}else{
	die("Action not supported.");
}

$action->CheckDataRequirement();
$addr="";
if(isset($_REQUEST['address'])) $addr=$_REQUEST['address'];
$type="";
if(isset($_REQUEST['type'])) $type=$_REQUEST['type'];

$bookmark=new bookmark($_REQUEST['apikey'],$_REQUEST['lat'],$_REQUEST['lng'],$addr, $type);
// echo $bookmark->name;
//var_dump($bookmark);

$user->performUserAction($action, $bookmark);

?>