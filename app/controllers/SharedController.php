<?php 

/**
 * SharedController Controller
 * @category  Controller / Model
 */
class SharedController extends BaseController{
	
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
     * prescription_medicine_option_list Model Action
     * @return array
     */
	function prescription_medicine_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT medicine_name AS value,medicine_name AS label FROM medicine ORDER BY id ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * prescription_patient_option_list Model Action
     * @return array
     */
	function prescription_patient_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM user where role='patient'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * prescription_doctor_option_list Model Action
     * @return array
     */
	function prescription_doctor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT name AS value,name AS label FROM user where role='Doctor'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * reminder_prescription_id_option_list Model Action
     * @return array
     */
	function reminder_prescription_id_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,patient AS label FROM prescription ORDER BY date ASC";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * reminder_Doctor_option_list Model Action
     * @return array
     */
	function reminder_Doctor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM user where role='Doctor'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * reminder_phone_option_list Model Action
     * @return array
     */
	function reminder_phone_option_list($lookup_prescription_id){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT phone AS value,phone AS label FROM user WHERE name=prescription_id ORDER BY id ASC"  ;
		$queryparams = array($lookup_prescription_id);
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * reviews_patient_option_list Model Action
     * @return array
     */
	function reviews_patient_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM user where role='patient'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
	}

	/**
     * reviews_dcotor_option_list Model Action
     * @return array
     */
	function reviews_dcotor_option_list(){
		$db = $this->GetModel();
		$sqltext = "SELECT  DISTINCT id AS value,name AS label FROM user where role='Doctor'";
		$queryparams = null;
		$arr = $db->rawQuery($sqltext, $queryparams);
		return $arr;
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
     * getcount_prescription Model Action
     * @return Value
     */
	function getcount_prescription(){
		$db = $this->GetModel();
		$sqltext = "SELECT COUNT(*) AS num FROM prescription";
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

}
