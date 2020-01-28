<?php
require_once(APPPATH . '/models/Post.php');

class PostManager extends CI_Model
{

	/**
	 * PostManager constructor.
	 * initiate database object
	 * create UserManage instance
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('app');
		$this->load->model('UserManager', 'userManager');
	}

	/**
	 * Add post data to the db
	 * @param $postDescription
	 */
	public function addPost($postDescription)
	{
		$userId = $this->session->userDetails['id'];
		$postData = array(
			'id' => generateGUID(),
			'description' => $postDescription,
			'userId' => $userId,
			'updatedAt' => date("Y-m-d H:i:s")
		);
		$this->db->insert('posts', $postData);
	}


	/**
	 * @param $userId
	 * Get post count related to specific user
	 * @return mixed
	 */
	public function noOfPosts($userId)
	{
		$rows = $this->db->get_where('posts', array('userId' => $userId));
		return $rows->num_rows();
	}

	/**
	 * @param $text
	 * @param $post_id
	 * Format post content with html attributes
	 * @return array
	 */
	public function genearatePostContent($text, $post_id)
	{
		$html_text_content = '<p class="text-left m-0 post-text-area">' . $text . '</p>';

		$urls = findUrl($text);
		$html_image_content = null;
		$img_url = array();

		foreach ($urls as $url) {
			if (@GetImageSize($url)) {
				$img_url[] = $url;
				$html_text_content = str_replace($url, "", $html_text_content);

			} else {
				$html_text_content = str_replace(
					$url,
					'<a href="' . $url . '" rel="nofollow" target="_blank">' . $url . '</a>',
					$html_text_content);
			}
		}

		if (count($img_url) > 0) {
			foreach ($img_url as $k => $v) {

				$html_image_content .= createImageGrid($k, $v, count($img_url), $post_id);

			}

		}

		return array(
			"text" => $html_text_content,
			"images" => $html_image_content,
			"imageUrls" => $img_url
		);
	}

	/**
	 * @param $postId
	 * Get post details by id
	 * @return mixed
	 */
	public function getPostDetails($postId)
	{
		$result = $this->db->get_where('posts', array('id' => $postId));
		return $result->result();

	}

	/**
	 * @param $postId
	 * Remove post from the db
	 */
	public function removePost($postId)
	{
		$this->db->delete('posts', array(
			'id' => $postId
		));
	}

	/**
	 * @param $postData
	 * Update post data
	 * @return mixed
	 */
	public function updatePost($postData)
	{
		$data = array(
			"description" => $postData['content'],
			"updatedAt" => date("Y-m-d H:i:s")
		);
		$result = $this->db->update('posts', $data, array('id' => $postData['postId']));
		return $result;
	}


	/**
	 * Get following user's posts
	 * @return array
	 */
	public function getFollowingsPost()
	{
		$followingSelect = prefixTable("following", "following", $this->db);
		$userSelect = prefixTable("users", "user", $this->db);
		$postSelect = prefixTable("posts", "post", $this->db);
		$this->db->select("$followingSelect, $userSelect, $postSelect")
			->from('following')
			->where(array("followedUserId" => $this->session->userDetails['id']))
			->join('users', 'users.id = following.followingUserId')
			->join('posts', 'following.followingUserId = posts.userId');

		$objList = objectMapper("user_post", $this->db->get()->result());

		return $objList;
	}

	/**
	 * @param $a
	 * @param $b
	 * Sort date by ascending orders
	 * @return false|int
	 */
	public function compare_date($a, $b)
	{
		$t1 = strtotime($a->getUpdatedAt());
		$t2 = strtotime($b->getUpdatedAt());
		return $t2 - $t1;
	}

	/**
	 * @param $userId
	 * Get specific user's posts
	 * @return array
	 */
	public function getUsersPost($userId)
	{
		$userSelect = prefixTable("users", "user", $this->db);
		$postSelect = prefixTable("posts", "post", $this->db);
		$this->db->select("$userSelect, $postSelect")
			->from('posts')
			->where(array("userId" => $userId))
			->join('users', 'users.id = posts.userId');

		$objList = objectMapper("user_post", $this->db->get()->result());

		usort($objList, array($this, 'compare_date'));

		return $objList;
	}


	/**
	 * @param $userId
	 * Get all posts (logged in user and following users)
	 * @return array
	 */
	public function getAllPosts($userId)
	{
		$followingPosts = $this->getFollowingsPost();
		$currentUserPosts = $this->getUsersPost($userId);

		$allPosts = array_merge($followingPosts, $currentUserPosts);

		foreach ($allPosts as $post) {
			$content = $this->genearatePostContent($post->getDescription(), $post->getPostId());
			$post->setDescription($content);
			$this->session->set_flashdata($post->getPostId(), $content['imageUrls']);
		}

		usort($allPosts, array($this, 'compare_date'));

		return $allPosts;

	}


}
