<?php 
/**
 * Prescriptions Page Controller
 * @category  Controller
 */
class PrescriptionsController extends SecureController{
	function __construct(){
		parent::__construct();
		$this->tablename = "prescriptions";
	}
// No Edit Function Generated Because No Field is Defined as the Primary Key
}
