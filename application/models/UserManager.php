<?php
require_once(APPPATH . '/models/User.php');

class UserManager extends CI_Model
{

	/**
	 * UserManager constructor.
	 * initiate database object
	 * Load app helper
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('app');
	}


	/**
	 * @param $email
	 * Check user from email
	 * @return mixed
	 */
	public function checkUser($email)
	{
		$user = $this->db->get_where('users', array('email' => $email));
		$user_data = objectMapper('User', $user->result());
		return $user_data;
	}


	/**
	 * Get all users from the db
	 * @return mixed
	 */
	public function getAllUsers()
	{
		$this->db->select('id')
			->from('users');
		return $this->db->get()->result();
	}


	/**
	 * @param $userData
	 * @param $imageName
	 * Add new user to the db
	 * @return string
	 */
	public function addUser($userData, $imageName)
	{
		$user_id = generateGUID();
		$user_details = array(
			'id' => $user_id,
			'firstName' => $userData['validationCustomFirstName'],
			'lastName' => $userData['validationCustomLastName'],
			'email' => $userData['validationCustomEmail'],
			'timestamp' => date("Y-m-d H:i:s"),
			'emailConfirmed' => false,
			'password' => hashPassword($userData['validationCustomPassword']),
			'imageUrl' => $imageName,
			'confirmationCode' => generateRandomCode()
		);
		$this->db->insert('users', $user_details);
		return $user_id;
	}


	/**
	 * @param $genres
	 * @param $userId
	 * Add data to the users_genres table
	 */
	public function addUserGenres($genres, $userId)
	{
		foreach ($genres as $item) {
			$user_genre_details = array(
				'id' => generateGUID(),
				'userId' => $userId,
				'genreId' => $item
			);
			$this->db->insert('users_genres', $user_genre_details);
		}
	}


	/**
	 * @param $password
	 * @param $hashPassword
	 * Verify password
	 * @return bool
	 */
	public function signIn($password, $hashPassword)
	{
		return verifyPassword($password, $hashPassword);
	}

	/**
	 * @param $email
	 * Get user details from email
	 * @return mixed
	 */
	public function getUserForResetPassword($email)
	{
		$user = $this->db->get_where('users', array('email' => $email, 'emailConfirmed' => true));
		$user_data = objectMapper('User', $user->result());
		return $user_data;
	}


	/**
	 * @param $userId
	 * Add token details to the db
	 * @return array
	 */
	public function addTokenDetails($userId)
	{
		$tokenData = generatePasswordResetTokenDetails($userId);
		$this->db->insert('tokens', $tokenData);
		return $tokenData;
	}


	/**
	 * @param $userId
	 * Get count of following , followers and friends
	 * @return array
	 */
	public function noOfFollowings($userId)
	{
		$followed = $this->db->get_where('following', array('followingUserId' => $userId));
		$following = $this->db->get_where('following', array('followedUserId' => $userId));
		$friends = $this->getAllFollowDetails($userId);
		return array(
			'following' => $following->num_rows(),
			'followers' => $followed->num_rows(),
			'friends' => count($friends['friends'])
		);
	}


	/**
	 * @param $userId
	 * Get user details from userId
	 * @return mixed
	 */
	public function getUserDetails($userId)
	{
		$user = $this->db->get_where('users', array('id' => $userId));

		$objList = objectMapper("User", $user->result());

		return $objList;
	}


	/**
	 * @param $userId
	 * Update account activation details
	 * @return mixed
	 */
	public function updateAccountActivation($userId)
	{
		$data = array(
			'emailConfirmed' => true
		);
		$result = $this->db->update('users', $data, array('id' => $userId));
		return $result;
	}

	/**
	 * @param $token
	 * Check whether token is valid or not
	 * @return bool
	 */
	public function isTokenValid($token)
	{
		$tokenDetails = $this->db->get_where('tokens', array('token' => $token));
		$today = date("Y-m-d H:i:s");
		$token_data = $tokenDetails->result();
		if ($token_data[0]->expiredAt < $today) {
			return false;
		} else {
			return $token_data;
		}

	}

	/**
	 * @param $email
	 * @param $password
	 * Update password in the db
	 * @return mixed
	 */
	public function resetPassword($email, $password)
	{
		$data = array(
			'password' => hashPassword($password)
		);
		$result = $this->db->update('users', $data, array('email' => $email));
		return $result;
	}

	/**
	 * @param $userId
	 * Identify following details of the users
	 * @return array
	 */
	public function getFollowingDetails($userId)
	{
		$allUsers = $this->getAllUsers();
		$followings_data = $this->db
			->select('followingUserId')
			->from('following')
			->where(array('followedUserId' => $userId))
			->get()->result();
		$followers_data = $this->db
			->select('followedUserId')
			->from('following')
			->where(array('followingUserId' => $userId))
			->get()->result();
		$follow_back = array();
		$follow = array();
		$followings = array();


		foreach ($followings_data as $user) {
			array_push($followings, $user->followingUserId);
		}

		foreach ($followers_data as $item) {
			if (!in_array($item->followedUserId, $followings)) {
				array_push($follow_back, $item->followedUserId);
			}
		}
		foreach ($allUsers as $user) {
			if (!in_array($user->id, $followings) && !in_array($user->id, $follow_back)) {
				array_push($follow, $user->id);
			}

		}

		return array(
			'follow_back' => $follow_back,
			'following' => $followings,
			'follow' => $follow
		);
	}


	/**
	 * @param $userId
	 * Gel all follow details with user details
	 * @return array
	 */
	public function getAllFollowDetails($userId)
	{
		$followingUsers = $this->getFollowingList($userId);
		$followedUsers = $this->getFollowersList($userId);
		$friends = array();

		foreach ($followingUsers as $user) {
			$isFriend = $this->getFriendsList($user->user_id);
			if (count($isFriend) > 0) {
				array_push($friends, $isFriend[0]);
			}
		}

		return array(
			'followings' => $followingUsers,
			'followedUsers' => $followedUsers,
			'friends' => $friends

		);
	}

	/**
	 * @param $users
	 * Get search result from the db
	 * @return mixed
	 */
	public function getSearchResult($users)
	{
		foreach ($users as $user) {
			$user->followType = $this->getUserState($user->user_id);
		}
		return $users;
	}

	/**
	 * @param $followingUserId
	 * Get users state :
	 * (following, follow, followback)
	 * @return string
	 */
	public function getUserState($followingUserId)
	{
		$followDetails = $this->getFollowingDetails($this->session->userDetails['id']);
		if (in_array($followingUserId, $followDetails['follow_back'])) {
			return "FollowBack";
		} elseif (in_array($followingUserId, $followDetails['following'])) {
			return "Following";
		} elseif (in_array($followingUserId, $followDetails['follow'])) {
			return "Follow";
		}
	}

	/**
	 * @param $followingId
	 * Add following details to the db
	 * @return mixed
	 */
	public function addFollowingDetails($followingId)
	{
		$follow_details = array(
			'id' => generateGUID(),
			'followingUserId' => $followingId,
			'followedUserId' => $this->session->userDetails['id']
		);
		$result = $this->db->insert('following', $follow_details);
		return $result;
	}

	/**
	 * @param $unFollowId
	 * Remove following details
	 * @return mixed
	 */
	public function removeFollowingDetails($unFollowId)
	{
		$result = $this->db->delete('following', array(
			'followingUserId' => $unFollowId,
			'followedUserId' => $this->session->userDetails['id']
		));
		return $result;
	}

	/**
	 * @param $userId
	 * Get following list from the db
	 * @return mixed
	 */
	public function getFollowingList($userId)
	{
		$followingSelect = prefixTable("following", "following", $this->db);
		$usersSelect = prefixTable("users", "user", $this->db);
		$this->db->select("$followingSelect, $usersSelect")
			->from('following')
			->where(array("followedUserId" => $userId))
			->join('users', 'users.id = following.followingUserId');

		return $this->db->get()->result();
	}

	/**
	 * @param $userId
	 * Get followers list from the db
	 * @return mixed
	 */
	public function getFollowersList($userId)
	{
		$followingSelect = prefixTable("following", "following", $this->db);
		$usersSelect = prefixTable("users", "user", $this->db);
		$this->db->select("$followingSelect, $usersSelect")
			->from('following')
			->where(array("followingUserId" => $userId))
			->join('users', 'users.id = following.followedUserId');


		return $this->db->get()->result();
	}

	/**
	 * @param $updatedUser
	 * @param $fileName
	 * Update user details
	 * @return mixed
	 */
	public function updateUser($updatedUser, $fileName)
	{
		$data = array(
			"firstName" => $updatedUser['validationCustomFirstName'],
			"lastName" => $updatedUser["validationCustomLastName"],
			"imageUrl" => $fileName
		);

		$result = $this->db->update('users', $data, array('id' => $this->session->userDetails['id']));
		return $result;
	}

	/**
	 * @param $pubUserId
	 * Get logged in users's friends list
	 * @return mixed
	 */
	public function getFriendsList($pubUserId)
	{
		$followingSelect = prefixTable("following", "following", $this->db);
		$usersSelect = prefixTable("users", "user", $this->db);
		$this->db->select("$followingSelect, $usersSelect")
			->from('following')
			->where(array(
				"followingUserId" => $pubUserId,
				"followedUserId" => $this->session->userDetails['id'],
				"followingUserId" => $this->session->userDetails['id'],
				"followedUserId" => $pubUserId,
			))
			->join('users', 'users.id = following.followedUserId');

		return $this->db->get()->result();
	}


}
