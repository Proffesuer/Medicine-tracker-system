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
			'label' => 'Dashboard', 
			'icon' => '<i class="material-icons ">home</i>'
		),
		
		array(
			'path' => 'prescription', 
			'label' => 'Prescription', 
			'icon' => '<i class="material-icons ">add_box</i>'
		),
		
		array(
			'path' => 'reminder', 
			'label' => 'Reminder', 
			'icon' => '<i class="material-icons ">add_alert</i>'
		),
		
		array(
			'path' => 'reviews', 
			'label' => 'Reviews', 
			'icon' => '<i class="material-icons ">mode_comment</i>'
		),
		
		array(
			'path' => 'medicine', 
			'label' => 'Medicine', 
			'icon' => '<i class="material-icons ">local_hospital</i>'
		),
		
		array(
			'path' => 'user', 
			'label' => 'User', 
			'icon' => '<i class="material-icons ">person_add</i>'
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
			"value" => "patient", 
			"label" => "patient", 
		),);
		
			public static $role2 = array(
		array(
			"value" => "Administrator", 
			"label" => "Administrator", 
		),
		array(
			"value" => "patient", 
			"label" => "patient", 
		),
		array(
			"value" => "Doctor", 
			"label" => "Doctor", 
		),);
		
}