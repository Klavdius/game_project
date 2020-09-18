<?php

class Protect;

public function OriginName($title, $Base_date){
	$result = $Base_date->query("SELECT games.title FROM 'games' WHERE games.title = $title");
	return $result;
}

?>