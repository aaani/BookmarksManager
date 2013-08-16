<?

require_once 'connectionManager.php';
require_once 'errorHandler.php';
require_once 'bookmark.php';
require_once 'user.php';
require_once 'action.php';
require_once 'extendActions.php';

ini_set('display_errors',1); 
error_reporting(E_ALL);

//Validate action
$UserAction=isset($_REQUEST['action'])?$_REQUEST['action']:"";
if(class_exists($UserAction)) $action= new $UserAction();
else errorHandle::Terminate(errorHandle::ACT_N_SUP);
$action->CheckDataRequirement(); //Make sure minimum parameters are available for the requested action


//Validate user
userFactory::checkDataRequirement();
$superuser = userFactory::getUser($_REQUEST['apikey']);
if(is_null($superuser)) errorHandle::Terminate(errorHandle::INV_API_K);
$superuser->performUserAction($action); //Let superuser perform the action

?>