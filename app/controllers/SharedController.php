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
