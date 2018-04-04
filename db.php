<?php
	
$host = 'localhost';
$user = 'root';
$password = 'password';

$db_name = "admin_help";


$connection = new mysqli($host,$user,$password, $db_name);


if (!isset($connection)){
	echo "ERROR";
	}
	
	

function formatDate($date){
	return date('F j, Y, g:i a', strtotime($date));
}


	function createSlug($slug){
		//remove anything that isn't letters, numbers, spaces, hyphens
		
		//remove spaces and duplicate hyphens
		
		//trim the let and right, removing any left over hyphens
		
		
		
		$lettersNumbersSpacesHyphens = '/[^\-\s\pN\pL]+/u';
		$spaceDuplicateHyphens = '/[\-\s]+/u';	
		
			
		$slug = preg_replace($spaceDuplicateHyphens,'-',$slug); 
		
		
		$slug = preg_replace($lettersNumbersSpacesHyphens,'',mb_strtolower($slug, 'UTF-8'));
		
		$slug = trim($slug, '-');
		
		
		return $slug;
		
		
	};

?>