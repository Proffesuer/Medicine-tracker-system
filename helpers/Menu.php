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
			'icon' => '<i class="fa fa-home "></i>'
		),
		
		array(
			'path' => 'test', 
			'label' => 'Test', 
			'icon' => '<i class="fa fa-user-md "></i>'
		),
		
		array(
			'path' => 'prescriptions', 
			'label' => 'Prescriptions', 
			'icon' => '<i class="fa fa-heartbeat "></i>'
		),
		
		array(
			'path' => 'recommendations', 
			'label' => 'Recommendations', 
			'icon' => '<i class="fa fa-commenting-o "></i>'
		),
		
		array(
			'path' => 'reviews', 
			'label' => 'Reviews', 
			'icon' => '<i class="fa fa-comments "></i>'
		),
		
		array(
			'path' => 'medicine', 
			'label' => 'Medicine', 
			'icon' => '<i class="fa fa-medkit "></i>'
		),
		
		array(
			'path' => 'user', 
			'label' => 'User', 
			'icon' => '<i class="fa fa-user "></i>'
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
			"value" => "patient", 
			"label" => "patient", 
		),
		array(
			"value" => "Doctor", 
			"label" => "Doctor", 
		),);
		
}