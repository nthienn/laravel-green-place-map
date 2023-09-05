<?php

class greenPlaceMap
{

	protected $id_place;
	protected $placeName;
	protected $lat;
	protected $lng;
	protected $address;
	protected $image;
	protected $description;
	protected $status;
	protected $star;
	protected $id_place_type;
	protected $id_user;
	protected $conn;
	protected $tableName = "places";

	function setId_place($id_place)
	{
		$this->id_place = $id_place;
	}
	function getId_place()
	{
		return $this->id_place;
	}
	function setPlaceName($placeName)
	{
		$this->placeName = $placeName;
	}
	function getPlaceName()
	{
		return $this->placeName;
	}
	function setLat($lat)
	{
		$this->lat = $lat;
	}
	function getLat()
	{
		return $this->lat;
	}
	function setLng($lng)
	{
		$this->lng = $lng;
	}
	function getLng()
	{
		return $this->lng;
	}
	function setAddress($address)
	{
		$this->address = $address;
	}
	function getAddress()
	{
		return $this->address;
	}
	function setImage($image)
	{
		$this->image = $image;
	}
	function getImage()
	{
		return $this->image;
	}
	function setDescription($description)
	{
		$this->description = $description;
	}
	function getDescription()
	{
		return $this->description;
	}
	function setStatus($status)
	{
		$this->status = $status;
	}
	function getStatus()
	{
		return $this->status;
	}
	function setStar($star)
	{
		$this->star = $star;
	}
	function getStar()
	{
		return $this->star;
	}
	function setId_place_type($id_place_type)
	{
		$this->id_place_type = $id_place_type;
	}
	function getId_place_type()
	{
		return $this->id_place_type;
	}
	function setId_user($id_user)
	{
		$this->id_user = $id_user;
	}
	function getId_user()
	{
		return $this->id_user;
	}


	public function __construct()
	{
		require_once('DbConnect.php');
		$conn = new DbConnect;
		$this->conn = $conn->connect();
	}

	public function getCollegesBlankLatLng()
	{
		$sql = "SELECT * FROM $this->tableName WHERE lat IS NULL AND lng IS NULL";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllColleges()
	{
		$sql = "SELECT * FROM $this->tableName";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function updateCollegesWithLatLng()
	{
		$sql = "UPDATE $this->tableName SET lat = :lat, lng = :lng WHERE id_place = :id_place";
		$stmt = $this->conn->prepare($sql);
		$stmt->bindParam(':lat', $this->lat);
		$stmt->bindParam(':lng', $this->lng);
		$stmt->bindParam(':id_place', $this->id_place);

		if ($stmt->execute()) {
			return true;
		} else {
			return false;
		}
	}
}

class detail extends greenPlaceMap
{
	public function getColleges($id_place)
	{
		$sql = "SELECT * FROM $this->tableName WHERE id_place='$id_place'";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

class coffee extends greenPlaceMap
{
	public function getColleges()
	{
		$sql = "SELECT * FROM $this->tableName WHERE id_place_type=1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

class restaurant extends greenPlaceMap
{
	public function getColleges()
	{
		$sql = "SELECT * FROM $this->tableName WHERE id_place_type=2";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

class travel extends greenPlaceMap
{
	public function getColleges()
	{
		$sql = "SELECT * FROM $this->tableName WHERE id_place_type=3";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

class search extends greenPlaceMap
{
	public function getColleges()
	{
		$key_word = $_GET['key_word'];
		$sql = "SELECT * FROM $this->tableName WHERE (places.placeName LIKE '%$key_word%' OR places.address LIKE '%$key_word%')";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}

class places extends greenPlaceMap
{
	public function getColleges()
    {
        $user = session()->get('id_user');
        $sql = "SELECT * FROM $this->tableName WHERE id_user='$user'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
