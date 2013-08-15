<?

class errorHandle{
	const ACT_N_SUP="Action not supported.";
	const NULL_API_K="API key not set.";
	const INV_API_K="Invalid API key.";
	const INSUF_PAR_ADBOOK="Insufficient parameters for AddBookmark action.";
	const INSUF_PAR_DLBOOK="Insufficient parameters for DeleteBookmark action.";
	
	static function Terminate($errorCode){
		$result['errormessage']=$errorCode;
		die(json_encode($result));
	}
	
};

?>