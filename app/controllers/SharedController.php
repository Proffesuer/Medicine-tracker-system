<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
	/**
     * reviews_patient_id_option_list Model Action
     * @return array
     */
	function reviews_patient_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name AS value FROM user where role='patient'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * reviews_doctor_id_option_list Model Action
     * @return array
     */
	function reviews_doctor_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name AS value,id AS label FROM user where role='Doctor'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * user_name_value_exist Model Action
     * @return array
     */
	function user_name_value_exist($val){
		$db = $this->GetModel();
		$db->where("name", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * user_email_value_exist Model Action
     * @return array
     */
	function user_email_value_exist($val){
		$db = $this->GetModel();
		$db->where("email", $val);
		$exist = $db->has("user");
		return $exist;
	}

	/**
     * getcount_medicine Model Action
     * @return Value
     */
	function getcount_medicine(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM medicine";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_prescriptions Model Action
     * @return Value
     */
	function getcount_prescriptions(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM prescriptions";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_reviews Model Action
     * @return Value
     */
	function getcount_reviews(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM reviews";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_user Model Action
     * @return Value
     */
	function getcount_user(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM user";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

	/**
     * getcount_reminder Model Action
     * @return Value
     */
	function getcount_reminder(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM reminder";
		$queryparams = null;
		$val = $db->rawQueryValue($sqltext, $queryparams);
		
		if(is_array($val)){
			return $val[0];
		}
		return $val;
	}

}
