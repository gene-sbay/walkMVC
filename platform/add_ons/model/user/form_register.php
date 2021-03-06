<?php

class RegisterFormConfig extends FormConfigBase
{
	public $action = '/user/register'; // REST path from current root
	public $formId = 'register-form';

	public function getFormFieldArray()
	{
		return  array ( $this->headerConfig,
				$this->login,
				$this->email,
				$this->password,
				$this->confirmPassword,
				$this->submitConfig
		);
	}


	public $submitConfig = array
	(
			"type" => "submit",
			"value" => "Go",
	
			"css" => array(
					"clear" => "both",
					"width" => "100px",
					"margin-top" => "50px"
			),
	
	);
	
	// Now define the fields

	// Now define the fields
	public $headerConfig = array
	(
			"type" => "h1",
			"html" => "Register Home"
	);


	public $login = array
	(
			"id" => "login", // html tag id
			"name" => "login", // name for: db column, form field
			"type" => "text", // html form input type
			
			"css" => array(
					"xwidth" => "100px"
			),
			
			"validate" => array 
			(
					"required" => true,
					"minlength" => 4,
					"messages" => array 
					(
							"required" => "Required input",
					)
			),

			"css" => array("clear" => "both"),
			
			"caption" => "Username" // Label
	);

	public $email = array
	(
			"id" => "email", // html tag id
			"name" => "email", // name for: db column, form field
			"type" => "text", // html form input type

			"css" => array(
					"clear" => "both",
			),
				
			"validate" => array
			(
					"required" => true,
					"minlength" => 4,
					"messages" => array
					(
							"required" => "Required input",
					)
			),
			
			"caption" => "Email" // Label
	);

	public $password = array
	(
			"id" => "password", // html tag id
			"name" => "password", // name for: db column, form field
			"type" => "password", // html form input type

			"css" => array(
					"clear" => "both",
			),
			
				
			"validate" => array
			(
					"required" => true,
					"minlength" => 4,
					"messages" => array
					(
							"required" => "Required input",
					)
			),
				
			"caption" => "Password" // Label
	);

	public $confirmPassword = array
	(
			"id" => "confirm_password", // html tag id
			"name" => "confirm_password", // name for: db column, form field
			"type" => "password", // html form input type

			"css" => array(
					"clear" => "both",
			),
							
			"validate" => array
			(
					"required" => true,
					"minlength" => 4,
					"messages" => array
					(
							"required" => "Required input",
					)
			),
				
			"caption" => "Confirm Password" // Label
	);




	public function getRegisterEmailQueryArray()
	{
		return $this->getFormQueryArray('email');
	}

	public function getRegisterUserIdQueryArray()
	{
		return $this->getFormQueryArray('login');
	}

	public function getFormQueryArray($fieldName=null)
	{
		if (
			! isset($_POST[$fieldName])
		)
		{
			return null;
		}

		$value = trim($_POST[$fieldName]);

		$regArr = array(
				$fieldName => $value
		);

		return $regArr;
	}

	/**
	 * This is for doing register
	 * FIXME - figure out if dForm can send hashed pwd
	 * 			> IF NO - can't use the formCfg object
	 *
	 * @param string $userMapper
	 * @return unknown
	 */
	public function getRequestAsEntity($userMapper=null)
	{
		$login 					= trim($_POST['login']);
		$email 					= trim($_POST['email']);
		$password 			= trim($_POST['password']);
		$confirmPassword 	= trim($_POST['confirm_password']);

		// New, empty user entity
		$userEntity = $userMapper->get();

		$userEntity->login = $login;
		$userEntity->email = $email;
		$userEntity->password = md5($password);

			// check for fb_userid 
		$fb_userid = ( array_key_exists('fb_userid', $_POST) ) 
							? trim($_POST['fb_userid']) 
							: null;
		
		if ($fb_userid)
		{
			$userEntity->fb_userid = $fb_userid;
		}
		
		return $userEntity;
	}

	public function setRegisterPostData($new_username=null, $fb_userid=null)
	{
		$_POST['login'] = $new_username;
		$_POST['email'] = $new_username . UPDATE_EMAIL_DOMAIN;
		
		$_POST['password'] 				= FB_PASSWORD;
		$_POST['confirm_password'] 	= FB_PASSWORD;
		
		$_POST['fb_userid'] 	= $fb_userid;
	}

	public function setFieldsFromPostData()
	{
		$this->login['value'] = getPostParam('login');
		$this->email['value'] = getPostParam('email');
		
		// don't set these
		// $this->password['value'] = $_POST['password'];
		// $this->confirm_password['value'] = $_POST['confirm_password'];
	}

}
