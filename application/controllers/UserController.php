<?php


class UserController extends CI_Controller
{

	/**
	 * UserController constructor.
	 * Create instances of :
	 * UserManager,
	 * GenreManager
	 * Load email and upload library
	 * Load email helper
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->config('email');
		$this->load->library('email');
		$this->load->config('upload');
		$this->load->library('upload');
		$this->load->helper('email');
		$this->load->model('UserManager', 'userManager');
		$this->load->model('GenreManager', 'genreManager');
	}

	/**
	 * Render login page
	 */
	public function index(){
		if($this->session->has_userdata('userDetails')){
			redirect(site_url().'/PostController/home');
		}else{
			$this->load->view('login');
		}
	}

	/**
	 * Render forgot password page
	 */
	public function linkForgotPw(){
		$this->load->view('forgot_password');
	}

	/**
	  Render signup page
	 */
	public function linkSignUp(){
		$this->load->view('signup');
	}

	/**
	 * Pass signup page data to select genre page
	 */
	public function register(){
		$data = $this->input->post();
		$is_user = $this->userManager->checkUser($data['validationCustomEmail']);
		if($is_user){
			$this->session->set_flashdata('error', 'Email is already taken');
			redirect(site_url().'/UserController/linkSignUp');
		}else{
			$genres = $this->genreManager->getAllGenres();
			$this->load->view('select_genres', array(
				'userDetails' => $data,
				'genreList' => $genres
			));
		}
	}

	/**
	 * Add genres to user
	 */
	public function addUersGenres(){
		$data = $this->input->post();
		$fileName = $this->uploadProfilePicture(false);
		$user_id = $this->userManager->addUser($data, $fileName);
		$this->userManager->addUserGenres($data['genres'], $user_id);

		$user_data = $this->userManager->getUserDetails($user_id);
		$body = confirmationEmail($user_data[0], $data['validationCustomPassword']);
		if($this->sendEmail($user_data[0]->getEmail(),'Account Confirmation',$body)){
			$this->session->set_flashdata('info', 'Confirmation email has been sent to your account');
			redirect(site_url().'/UserController');
		}else{
			$this->session->set_flashdata('error', 'Error Occurred');
			redirect(site_url().'/UserController');
		}
	}

	/**
	 * @param $isUpdate
	 * Upload profile picture using file uploader
	 * @return mixed
	 */
	public function uploadProfilePicture($isUpdate){
		if ($this->upload->do_upload('imageUpload')) {
			$data = $this->upload->data();
			return $data['file_name'];
		}else{
			if($isUpdate){
				return null;
			}else{
				return 'default-profile.png';
			}

		}
	}

	/**
	 * Check user be
	 */
	public function login(){
		$email = $this->input->post('validationCustomEmail');
		$password = $this->input->post('validationCustomPassword');
		$user_data = $this->userManager->checkUser($email);
		if($user_data){
			if($this->userManager->signIn($password, $user_data[0]->getPassword())){
				if($user_data[0]->getEmailConfirmed()){

					$session_arr = array(
						"id" => $user_data[0]->getId(),
						"firstName" => $user_data[0]->getFirstName(),
						"lastName" => $user_data[0]->getLastName(),
						"email" => $user_data[0]->getEmail(),
						"imageUrl" => $user_data[0]->getImageUrl()
					);
					$this->session->set_userdata('userDetails', $session_arr);
					$this->session->set_userdata('imageUrl', $session_arr['imageUrl']);
					redirect(site_url().'/PostController/home');

				}else{
					$this->session->set_flashdata('errorMsg', 'You have to confirm your account');
					redirect(site_url().'/UserController');

				}
			}else{
				$this->session->set_flashdata('errorMsg', 'Incorrect Password');
				redirect(site_url().'/UserController');

			}
			
		}else{
			$this->session->set_flashdata('errorMsg', 'Invalid Email');
			redirect(site_url().'/UserController');

		}
		
	}

	/**
	 * update forgot password details
	 */
	public function forgotPassword(){
		$email = $this->input->post('validationCustomEmail');
		$user_data = $this->userManager->getUserForResetPassword($email);
		if($user_data){
			$token_data = $this->userManager->addTokenDetails($user_data[0]->getId());
			$body = passwordResetEmail(
				$user_data[0]->getFirstName(),
				$user_data[0]->getLastName(),
				$token_data['token']);

			$this->sendEmail($email,'Password Reset Link',$body);
			$this->session->set_flashdata('success', 'Password reset email successfully sent to your account');
			redirect(site_url().'/UserController');
		}else{
			$this->session->set_flashdata('error', 'Invalid Email');
			redirect(site_url().'/UserController');
		}
	}

	/**
	 * update normal password details
	 */
	public function normalPasswordReset(){
		$password_reset_data = $this->input->post();
		$result = $this->userManager->resetPassword($this->session->userDetails['email'], $password_reset_data['validationCustomPassword']);
		if($result){
			$email_content = passwordResetConfirmationEmail($password_reset_data['validationCustomFirstName'], $password_reset_data['validationCustomLastName']);
			$this->sendEmail($this->session->userDetails['email'],"Password Reset Confirmation",$email_content);
			$this->session->set_flashdata('success', 'Password reset successfully');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong when changing password');

		}
		redirect(site_url().'/UserController/editUser');
	}

	/**
	 * Change password using password reset link
	 */
	public function passwordResetFromLink(){
		$new_pw_data = $this->input->post();
		$isSuccess = $this->userManager->resetPassword($new_pw_data['email'], $new_pw_data['validationCustomPassword']);
		if($isSuccess){
			$email_content = passwordResetConfirmationEmail($new_pw_data['f_name'], $new_pw_data['l_name']);
			$this->sendEmail($new_pw_data['email'],"Password Reset Confirmation",$email_content);
			$this->session->set_flashdata('success', 'Password reset successfully');
			redirect(site_url().'/UserController');
		}else{
			$this->session->set_flashdata('error', 'Something went wrong in activating account');
			redirect(site_url().'/UserController');
		}
	}

	/**
	 * Account confirmation configuration
	 */
	public function accountActivation(){
		$userId =  $this->uri->segment(3);
		$code = $this->uri->segment(4);

		$user = $this->userManager->getUserDetails($userId);


		if($user[0]->getConfirmationCode() == $code){

			$res = $this->userManager->updateAccountActivation($userId);

			if($res){
				$this->session->set_flashdata('success', 'User activated successfully');
				redirect(site_url().'/UserController');
			}
			else{
				$this->session->set_flashdata('error', 'Something went wrong in activating account');
				redirect(site_url().'/UserController');
			}
		}
		else{
			$this->session->set_flashdata('error', 'Cannot activate account. Code didnt match');
			redirect(site_url().'/UserController');
		}

	}

	/**
	 * Render change password page
	 */
	public function resetPasswordLink(){

		$token = $this->uri->segment(3);
		$tokenData = $this->userManager->isTokenValid($token);

		if(!$tokenData){
			$this->session->set_flashdata('error', 'Token is invalid or expired');
			redirect(site_url().'/UserController');
		}else{

			$userDetails = $this->userManager->getUserDetails($tokenData[0]->userId);
			if($userDetails){
				$this->load->view('change_password', array(
					"userDetails" => $userDetails[0]
				));
			}else{
				$this->session->set_flashdata('error', 'User Not found');
				redirect(site_url().'/UserController');
			}

		}
	}

	/**
	 * @param $to
	 * @param $subject
	 * @param $body
	 * @return mixed
	 * Send email using smtp
	 */
	public function sendEmail($to, $subject, $body){
		$from = $this->config->item('smtp_user');
		$this->email->set_newline("\r\n");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($body);
		return $this->email->send();
	}

	/**
	 * Add follow details
	 */
	public function follow(){
		$followingId = $this->input->post('followingId');
		if($this->userManager->addFollowingDetails($followingId)){
			echo json_encode('Success');
		}else{
			echo json_encode('Error');
		}
	}

	/**
	 * Remove follow details
	 */
	public function unFollow(){
		$unFollowedId = $this->input->post('unFollowedId');
		if($this->userManager->removeFollowingDetails($unFollowedId)){
			echo json_encode('Success');
		}else{
			echo json_encode('Error');
		}
	}

	/**
	 * Logout from application
	 */
	public function logout(){
		$this->session->sess_destroy();
		redirect(site_url().'/UserController');
	}

	/**
	 * Render edit user page
	 */
	public function editUser(){
		$genres = $this->genreManager->getUserGenres();
		$user_data = $this->userManager->getUserDetails($this->session->userDetails['id']);
		$this->load->view('shared/header');
		$this->load->view('user_details', array(
			"genreList" => $genres,
			"userDetails" => $user_data[0]
		));
	}

	/**
	 * update user details
	 */
	public function updateUser(){
		$updatedData = $this->input->post();
		$fileName = $this->uploadProfilePicture(true);
		if($fileName == null){
			$fileName = $updatedData['imageUrl'];
		}
		$this->session->set_userdata('imageUrl', $fileName);
		$isSuccess = $this->userManager->updateUser($updatedData, $fileName);
		if($isSuccess){
			$this->session->set_flashdata('success', 'Account details was updated successfully');
		}else{
			$this->session->set_flashdata('error', 'Error Occurred');
		}
		redirect(site_url().'/UserController/editUser');
	}


	/**
	 * Get following details for search update
	 */
	public function getFollowingCounts(){
		$userId = $this->input->get('userId');
		$no_of_following = $this->userManager->noOfFollowings($userId);
		echo json_encode($no_of_following);
	}

}
