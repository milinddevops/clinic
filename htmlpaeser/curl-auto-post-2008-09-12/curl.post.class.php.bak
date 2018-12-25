<?php
class CRL {
	
	/* set var */
	
	var $proxy_ip = "127.0.0.1";
	var $proxy_port = "7070";
	var $getURL = "";
	var $postURL = "";
	var $cUrl;
	var $successWord;
	var $use_proxy = 0;
	var $stVal = "NANA NANA";
	var $setField = array();
	var $user_agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 6.0)";
	var $postf = "";
	var $settedField = array();
	
	function CRL() {
		 $this->cUrl = curl_init(); 
	}
	
	
	function setURL($url) {
		$this->getURL = $url;
	}
	
	function setField($name,$val) {
		array_push($this->setField,array(
		"name" => $name,
		"value" => $val
		));
	}
	
	
	
	
	function _urlControl($url) {
		
		if(strpos($url,"http://") > -1 or strpos($url,"https://") > -1) {
			return $url;
		} else {
			$rel = explode("/",$this->getURL);
			$new_url = "";
			for ($i=0;$i<count($rel)-1;$i++) {
				$new_url .= $rel[$i] . "/";
			}
			
			$new_url .= $url;
			return $new_url;
					
		}
	}
	
	
	function _handleField() {
		$ar = $this->setField;
		
		foreach ($ar as $fields) {
			for($i=0;$i<count($this->settedField);$i++) {
				if($this->settedField[$i]['name'] == $fields['name']) {
					$this->settedField[$i]['value'] =$fields['value'];
				}
			}
		}
		
		
		
	}
	
	function _handleEnd () {
		
		$this->postf = "";
		
		$this->_handleField();
		foreach ($this->settedField as $field) {	
			if($this->postf != "") {
				$this->postf .="&";
			}
			
			$this->postf .= $field['name']."=".$field['value'];
		}
		
		$end_data = $this->_fetch_postURL();
		if(strpos($end_data,$this->successWord) > -1) {
			return true;
		} else {
			return false;
		}
	}
	
	
	
	function _retriveField() {
		$data =  $this->_fetch_getURL();
		//echo $data;
		$data_start = explode("<form",$data);
		$data_end = explode("</form",$data_start[1]);
		$form_data = $data_end[0];
		
		$form_action = explode(" action=",$form_data);
		$form_action = explode(" ",$form_action[1]);
		$form_action = str_replace("'","",$form_action[0]);
		$form_action = str_replace('"',"",$form_action);
		
		$form_action = $this->_urlControl($form_action);
		$this->postURL = $form_action;
		
		
		$form_fields = explode("<input",$form_data);
		for($i=1;$i<count($form_fields);$i++) {
			$field_cal = explode(">",$form_fields[$i]);
			$_name = explode("name=",$field_cal[0]);
			$_name = explode(" ",$_name[1]);
			$_name = str_replace("'","",$_name[0]);
			$_name = str_replace('"',"",$_name);
			
			
			$_type = explode("type=",$field_cal[0]);
			$_type = explode(" ",$_type[1]);
			$_type = str_replace("'","",$_type[0]);
			$_type = str_replace('"',"",$_type);
			
			$_value = explode("value=",$field_cal[0]);
			if(count($_value) > 1) {
				$_value = explode(" ",$_value[1]);
				$_value = str_replace("'","",$_value[0]);
				$_value = str_replace('"',"",$_value);
				$_value = urlencode($_value);
			} else {
				$_value = urlencode($this->stVal);
			}
			
			
			array_push($this->settedField,array(
				"name" => $_name,
				"type" => $_type,
				"value" => $_value
				));
			
		}
		
		$form_fields = explode("<select",$form_data);
		for($i=1;$i<count($form_fields);$i++) {
			$field_cal = explode(">",$form_fields[$i]);
			$_name = explode("name=",$field_cal[0]);
			$_name = explode(" ",$_name[1]);
			$_name = str_replace("'","",$_name[0]);
			$_name = str_replace('"',"",$_name);
			
			array_push($this->settedField,array(
				"name" => $_name,
				"type" => "select",
				"value" => "NANA2 NANA2"
				));			
		}
		
		$form_fields = explode("<textarea",$form_data);
		for($i=1;$i<count($form_fields);$i++) {
			$field_cal = explode(">",$form_fields[$i]);
			$_name = explode("name=",$field_cal[0]);
			$_name = explode(" ",$_name[1]);
			$_name = str_replace("'","",$_name[0]);
			$_name = str_replace('"',"",$_name);
			
			array_push($this->settedField,array(
				"name" => $_name,
				"type" => "select",
				"value" => "NANA2 NANA2"
				));			
		}
		
		
		
		return $this->_handleEnd();
		
	}
	
	
	
	
	function _fetch_getURL() {
		 $cUrl = $this->cUrl;
		 curl_setopt($this->cUrl, CURLOPT_URL, $this->getURL);
    	 curl_setopt($this->cUrl, CURLOPT_RETURNTRANSFER, 1);
   		 curl_setopt($this->cUrl, CURLOPT_TIMEOUT, '30');
   		 curl_setopt ($this->cUrl, CURLOPT_COOKIEJAR, './cookie.txt');
   		 curl_setopt($this->cUrl, CURLOPT_COOKIEFILE, './cookie.txt');
   		 curl_setopt ($this->cUrl, CURLOPT_USERAGENT, $this->user_agent); 
		 if($this->use_proxy) {
			curl_setopt($this->cUrl, CURLOPT_PROXY, $this->proxy_ip.':'.$this->proxy_port);
			curl_setopt($this->cUrl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		 }
   		 $pageContent = trim(curl_exec($cUrl));
   		 return $pageContent;
	}
	
	
	
	function _fetch_postURL() {
		// $cUrl = $this->cUrl;
		 curl_setopt($this->cUrl, CURLOPT_URL, $this->postURL);
		 
   		 curl_setopt($this->cUrl, CURLOPT_POST, 1);
         curl_setopt($this->cUrl, CURLOPT_POSTFIELDS, $this->postf); 
   		 curl_setopt ($this->cUrl, CURLOPT_COOKIEJAR, './cookie.txt');
   		 curl_setopt($this->cUrl, CURLOPT_COOKIEFILE, './cookie.txt');
   		 curl_setopt ($this->cUrl, CURLOPT_USERAGENT, $this->user_agent); 
   		 if($this->use_proxy) {
			curl_setopt($this->cUrl, CURLOPT_PROXY, $this->proxy_ip.':'.$this->proxy_port);
			curl_setopt($this->cUrl, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		 }
   		 $pageContent = trim(curl_exec($this->cUrl));
   		 $this->_end();
   		 return $pageContent;
	}
	
	
	
	
	function _end() {
		curl_close($this->cUrl);
	}
	
	function init() {
		return  $this->_retriveField();
	}
	
	
}
/*
************************************************************
Curl Auto Site Form Post Class

usage :

// Load Class
$form =  new CRL();

// Set to blank field values
$form->->stVal = "";

// Set to form page
$form->setURL("http://website/form.aspx");

// setting custom fields (for example contact form)
$form->setField('name','mustafa');
$form->setField('surname','yontar');
$form->setField('mail','j.misoskian@w3ic.org');

//setting returned success words
$form->successWord = 'thank you';
if($form->init()){
	echo "Success";
}else{
	echo "error";
}


*/
?>