<?

class bookmark{
	public $id;
	public $lat;
	public $lng;
	public $address;
	public $name;
		
	public function __construct($id, $lat, $lng, $address, $name){
		$this->id=$id;
		$this->lat=$lat;
		$this->lng=$lng;
		$this->address=$address;
		$this->name=$name;
	}
}

?>