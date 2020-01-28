<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'/models/User.php');
require_once(APPPATH.'/models/Genre.php');
require_once(APPPATH.'/models/Post.php');


if (!function_exists('hashPassword')) {
	/**
	 * @param $password
	 * Hashing normal password for security purposes
	 * @return false|mixed|string
	 */
	function hashPassword($password)
	{
		return password_hash($password, PASSWORD_DEFAULT);
	}
}

if (!function_exists('verifyPassword')) {
	/**
	 * @param $plainPassword
	 * @param $hashPassword
	 * Varify password
	 * @return bool
	 */
	function verifyPassword($plainPassword, $hashPassword)
	{
		return password_verify($plainPassword, $hashPassword) ? true : false;
	}
}

if (!function_exists('generateGUID')) {

	/**
	 * Generate unique GUIDs
	 * @return string
	 */
	function generateGUID()
	{

		if (function_exists('com_create_guid') === true) {
			return trim(com_create_guid(), '{}');
		}
		return sprintf(
			'%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
			mt_rand(0, 65535),
			mt_rand(0, 65535),
			mt_rand(0, 65535),
			mt_rand(16384, 20479),
			mt_rand(32768, 49151),
			mt_rand(0, 65535),
			mt_rand(0, 65535),
			mt_rand(0, 65535)
		);
	}

}

if (!function_exists('generateRandomCode')) {

	/**
	 * Generate random code
	 * @return false|string
	 */
	function generateRandomCode()
	{
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		return substr(str_shuffle($set), 0, 12);
	}
}

if (!function_exists('generatePasswordResetTokenDetails')) {

	/**
	 * @param $userId
	 * Generate password reset token details
	 * @return array
	 */
	function generatePasswordResetTokenDetails($userId)
	{
		$token = substr(sha1(rand()), 0, 30);
		$createdDate = date('Y-m-d H:i:s', strtotime("now"));
		$expiredDate = date("Y-m-d H:i:s", strtotime("+30 minutes"));

		return array(
			"id" => generateGUID(),
			"token" => $token,
			"createdAt" => $createdDate,
			"expiredAt" => $expiredDate,
			"userId" => $userId
		);
	}
}
if (!function_exists('findUrl')) {

	/**
	 * @param $text
	 * Extract urls from text
	 * @return array
	 */
	function findUrl($text)
	{
		preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $text, $match);
		return $match[0];
	}
}

if (!function_exists('createImageGrid')) {

	/**
	 * @param $key
	 * @param $value
	 * @param $count
	 * @param $postId
	 * Create image grid and slideshow
	 * @return string
	 */
	function createImageGrid($key, $value, $count, $postId)
	{
		if ($count == 1) {
			return '<img src=' . $value . ' class="post-img">';
		} elseif ($count == 2 || $count == 4) {
			return '<div class="col-md-6 p-0"><img src=' . $value . ' class="post-image-more"></div>';
		} elseif ($count == 3) {
			return '<div class="' . ($key == $count - 1 ? "col-md-12 p-0" : "col-md-6 p-0") . '"><img src=' . $value . ' class="post-image-more"></div>';
		} else {
			if ($key < 4) {
				return '<div class="col-md-6 p-0 ' . ($key == 3 ? "bg-dark" : "") . '" id="' . $postId . '" onclick="' . ($key == 3 ? "imageSlider(this)" : "") . '" >
						<img src=' . $value . ' class="post-image-more ' . ($key == 3 ? "last-img" : "") . '">
						' . ($key == 3 ? "<div class='carousel-caption last-img-text'>
              				<h1>More Images</h1>
            			</div>" : "") . '
            		</div>';
			} else {
				return '';
			}

		}

	}
}

if (!function_exists('prefixTable')) {

	/**
	 * @param $tableName
	 * @param $prefix
	 * @param $dbInstance
	 * Change table column names
	 * @return string
	 */
	function prefixTable($tableName, $prefix = null, $dbInstance)
	{
		$fields = $dbInstance->list_fields($tableName);

		if ($prefix == null) {
			$prefix = $tableName;
		}

		$prefixArr = array();
		foreach ($fields as $field) {
			$prefixArr[] = "$tableName.$field as " . "$prefix" . "_" . "$field";
		}

		$joinedString = join(",", $prefixArr);
		return $joinedString;
	}
}

if (!function_exists('objectMapper')) {

	/**
	 * @param $className
	 * @param $data
	 * Map db object to backend class
	 * @return string
	 */
	function objectMapper($className, $data)
	{
        $objList = array();
		if($className == "User"){

            foreach ($data as $row) {
                $objList[] = User::initiateUser($row->id, $row->firstName, $row->lastName, $row->email, $row->password,
                                                $row->timestamp, $row->imageUrl, $row->emailConfirmed, $row->confirmationCode);
            }

		}elseif ($className == "user_post"){

            foreach ($data as $row) {
                $objList[] = new Post($row->post_id, $row->post_description,
                                        $row->post_updatedAt, $row->user_id, $row->user_firstName, $row->user_lastName,
                                        $row->user_email, $row->user_password, $row->user_timestamp, $row->user_imageUrl,
                                        $row->user_emailConfirmed, $row->user_confirmationCode);
            }


		}elseif ($className == "Genre"){

            foreach ($data as $row) {
                $objList[] = new Genre($row->genre_id, $row->genre_name, $row->genre_imageUrl);
            }

        }elseif($className == "user_genre"){

            foreach ($data as $row) {
                $objList[] = Genre::genreWithUser($row->genre_id, $row->genre_name, $row->genre_imageUrl,
                    $row->user_id, $row->user_firstName, $row->user_lastName, $row->user_email,
                    $row->user_timestamp, $row->user_imageUrl);
            }

        }elseif ($className == "follow_users"){

            foreach ($data as $row) {
                $objList[] = User::initiateUser($row->user_id, $row->user_firstName, $row->user_lastName, $row->user_email,
                                                $row->user_password, $row->user_timestamp, $row->user_imageUrl, $row->user_emailConfirmed,
                                                $row->user_confirmationCode);
            }
        }
		return $objList;
	}
}

