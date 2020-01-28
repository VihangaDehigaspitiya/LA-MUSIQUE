<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('confirmationEmail')){

	/**
	 * @param $userDetails
	 * Generate confirmation email content
	 * @return string
	 */
	function confirmationEmail($userDetails, $password){

		$message = 	"
						<html>
						<head>
							<title>Account Confirmation</title>
						</head>
						<body>
							<p>Dear ".$userDetails->getFirstName()." ".$userDetails->getLastName()."</p>
							<h2>Thank you for Registering.</h2>
							<p>Account details are given below.</p>
							<p>Email: ".$userDetails->getEmail()."</p>
							<p>Password: ".$password."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='".base_url()."index.php/UserController/accountActivation/".$userDetails->getId()."/".$userDetails->getConfirmationCode()."'>Activate My Account</a></h4>
						</body>
						</html>
						";

		return $message;
	}
}

if(!function_exists('passwordResetEmail')){

	/**
	 * @param $firstName
	 * @param $lastName
	 * @param $token
	 * Generate password reset email content
	 * @return string
	 */
	function passwordResetEmail($firstName, $lastName, $token){
		$message = 	"
						<html>
						<head>
							<title>Password Reset Link</title>
						</head>
						<body>
							<p>Dear $firstName $lastName,</p>
							<p><strong>To reset your password, click this link.</strong></p>
							<h4><a href='".base_url()."index.php/UserController/resetPasswordLink/".$token."'>
								".base_url()."index.php/UserController/resetPasswordLink/".$token."
							</a></h4>
							<p>Please note:</p>
							<p>For security purposes, this link will expire 72 hours from the time it was sent.</p>
						</body>
						</html>
						";

		return $message;
	}
}

if(!function_exists('passwordResetConfirmationEmail')){

	/**
	 * @param $firstName
	 * @param $lastName
	 * Password reset confirmation email content
	 * @return string
	 */
	function passwordResetConfirmationEmail($firstName, $lastName){
		$message = 	"
						<html>
						<head>
							<title>Password Reset Confirmation</title>
						</head>
						<body>
							<p>Dear $firstName $lastName,</p>
							<p><strong>Your password has been reset successfully.</strong></p><br>
						</body>
						</html>
						";

		return $message;
	}

}


