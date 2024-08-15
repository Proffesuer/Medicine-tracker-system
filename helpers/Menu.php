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
		
			public static $number_refils = array(
		array(
			"value" => "0", 
			"label" => "Zero", 
		),
		array(
			"value" => "1", 
			"label" => "1", 
		),
		array(
			"value" => "2", 
			"label" => "2", 
		),
		array(
			"value" => "3", 
			"label" => "3", 
		),
		array(
			"value" => "4", 
			"label" => "4", 
		),
		array(
			"value" => "5", 
			"label" => "5", 
		),
		array(
			"value" => "6", 
			"label" => "6", 
		),
		array(
			"value" => "7", 
			"label" => "7", 
		),
		array(
			"value" => "8", 
			"label" => "8", 
		),
		array(
			"value" => "9", 
			"label" => "9", 
		),
		array(
			"value" => "10", 
			"label" => "10", 
		),
		array(
			"value" => "11", 
			"label" => "11", 
		),
		array(
			"value" => "12", 
			"label" => "12", 
		),
		array(
			"value" => "13", 
			"label" => "13", 
		),
		array(
			"value" => "14", 
			"label" => "14", 
		),
		array(
			"value" => "15", 
			"label" => "15", 
		),
		array(
			"value" => "16", 
			"label" => "16", 
		),
		array(
			"value" => "17", 
			"label" => "17", 
		),
		array(
			"value" => "18", 
			"label" => "18", 
		),
		array(
			"value" => "19", 
			"label" => "19", 
		),
		array(
			"value" => "20", 
			"label" => "20", 
		),);
		
			public static $mode = array(
		array(
			"value" => "Daily", 
			"label" => "Daily", 
		),
		array(
			"value" => "Weekly", 
			"label" => "Weekly", 
		),
		array(
			"value" => "Monthly", 
			"label" => "Monthly", 
		),
		array(
			"value" => "Quarterly", 
			"label" => "Quarterly", 
		),
		array(
			"value" => "Half a Year", 
			"label" => "Half A Year", 
		),
		array(
			"value" => "Yearly", 
			"label" => "Yearly", 
		),
		array(
			"value" => "Once", 
			"label" => "Once", 
		),);
		
			public static $status = array(
		array(
			"value" => "Subscribe", 
			"label" => "Subscribe", 
		),
		array(
			"value" => "Unsubscribe", 
			"label" => "Unsubscribe", 
		),);
		
}