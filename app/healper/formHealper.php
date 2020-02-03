<?php 
	function CSRF_TOKEN(){
		//$csrf_token = md5(rand(time(),true));
		$csrf_token = uniqid(md5(rand(time(),true)));
		$_SESSION['CSRF_TOKEN'] = $csrf_token;
		$a = "<input type='hidden' name='CSRF_TOKEN' value='$csrf_token'>";
		return $a;
	}

	function csrfValidator($token)
	{
		if (isset($_SESSION['CSRF_TOKEN'])) {
			if ($token == $_SESSION['CSRF_TOKEN']) {
				unset($_SESSION['CSRF_TOKEN']);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

	function checkUserRegisterForm($formData)
	{
		$error = array();
		if (isset($formData['CSRF_TOKEN'])) {
			if (csrfValidator($formData['CSRF_TOKEN'])) {
				//Validate Email
				if (empty($formData['email'])) {
					$error['error'] = "Empty Email Feild";
				}
				else{
					if(!filter_var($formData['email'],FILTER_VALIDATE_EMAIL)) {
						$error['error'] = "Invalid Email";
					}
				}
				//validate Name
				if (empty($formData['name'])) {
					$error['error'] = "Empty Name Feild";
				}
				//Password
				if (empty($formData['password']) && empty($formData['confirm_password'])) {
					$error['error'] = "Empty Password Feild";
				}
				//password lenght
				if (strlen($formData['password']) < 8) {
					$error['error'] = "Password Lenght Must Be More Than 8 Charaters";
				}
				//confirm Password
				if ($formData['password'] != $formData['confirm_password']) {
					$error['error'] = 'Password And Confirm Password Not Matched';
				}
				if (empty($error['error'])) {
					return $formData;
				}
				else{
					return $error;
				}
			}else{
				$error['error'] = 'Invalid Csrf Token';
				return $error;
			}
		}
		else{
			$error['error'] = 'csrf token not found'; 
			return $error;
		}
	}


?>