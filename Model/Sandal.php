<?php
require_once "Shoe.php";

class Sandal extends Shoe {

	function getType(){
  		return "Sandal Shoe";
  	}
	
	function getImagePath(){
  		return $this->image;
  	}

  	function getDisplayPrice(){
		return $this->price." VND";
	}

	function getDisplayOldPrice(){
		if($this->color == "white"){
          return $this->price." VND";
    }
    return "";
  }
}

?>