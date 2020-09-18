<?php 

class Games{
	
	public:
		function __construct($name_game){
			$this->title = $name_game;
			
		}
		
		function SetTitle($new_title);{
			$this->title = $new_title;
		}
		
		function GetTitle(){
			return $this->title;
		}	
		
		public write_game_db(){
			
			
		}
	
	private:
	$title;
	$ganres;
	$relise_date;
	$developer;
	$publisher;
	$created_time;
};

?>