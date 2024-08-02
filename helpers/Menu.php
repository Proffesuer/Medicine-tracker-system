<?php
/**
 * Menu Items
 * All Project Menu
 * @category  Menu List
 */

class Menu{
	
	
			public static $navbarsideleft = array(
		array(
			'path' => 'home', 
			'label' => 'Home', 
			'icon' => '<i class="material-icons ">home</i>'
		),
		
		array(
			'path' => 'user', 
			'label' => 'User', 
			'icon' => '<i class="material-icons ">perm_identity</i>'
		),
		
		array(
			'path' => 'medicine', 
			'label' => 'Medicine', 
			'icon' => '<i class="material-icons ">local_pharmacy</i>'
		),
		
		array(
			'path' => 'test', 
			'label' => 'Test', 
			'icon' => '<i class="material-icons ">add_circle</i>'
		),
		
		array(
			'path' => 'prescriptions', 
			'label' => 'Prescriptions', 
			'icon' => '<i class="material-icons ">local_hospital</i>'
		),
		
		array(
			'path' => 'recommendations', 
			'label' => 'Recommendations', 
			'icon' => '<i class="material-icons ">note</i>'
		),
		
		array(
			'path' => 'reviews', 
			'label' => 'Reviews', 
			'icon' => '<i class="material-icons ">message</i>'
		)
	);
		
	
	
			public static $gender = array(
		array(
			"value" => "Male", 
			"label" => "Male", 
		),
		array(
			"value" => "Female", 
			"label" => "Female", 
		),);
		
			public static $role = array(
		array(
			"value" => "Administrator", 
			"label" => "Administrator", 
		),
		array(
			"value" => "Patient", 
			"label" => "Patient", 
		),
		array(
			"value" => "Doctor", 
			"label" => "Doctor", 
		),);
		
}