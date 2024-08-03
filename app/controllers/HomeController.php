<?php 

/**
 * Home Page Controller
 * @category  Controller
 */
class HomeController extends SecureController{
	/**
     * Index Action
     * @return View
     */
	function index(){
		if(strtolower(USER_ROLE) == 'administrator'){
			$this->render_view("home/administrator.php" , null , "main_layout.php");
		}
		elseif(strtolower(USER_ROLE) == 'patient'){
			$this->render_view("home/patient.php" , null , "main_layout.php");
		}
		elseif(strtolower(USER_ROLE) == 'doctor'){
			$this->render_view("home/doctor.php" , null , "main_layout.php");
		}
		else{
			$this->render_view("home/index.php" , null , "main_layout.php");
		}
	}
}
