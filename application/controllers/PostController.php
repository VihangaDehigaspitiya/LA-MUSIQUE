<?php

class PostController extends CI_Controller
{
	/**
	 * PostController constructor.
	 * Create instances of :
	 * PostManager,
	 * UserManager,
	 * GenreManager
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('PostManager', 'postManager');
		$this->load->model('UserManager', 'userManager');
		$this->load->model('GenreManager', 'genreManager');
	}


	/**
	 * Render logged in user's timeline
	 */
	public function home(){
		$all_posts = $this->postManager->getAllPosts($this->session->userDetails['id']);
		$userDetails = $this->userManager->getUserDetails($this->session->userDetails['id']);
		$no_of_posts = $this->postManager->noOfPosts($this->session->userDetails['id']);
		$no_of_following = $this->userManager->noOfFollowings($this->session->userDetails['id']);
		$this->load->view('shared/header');
		$this->load->view('public_home', array(
			"posts" => $all_posts,
			'noOfPosts' => $no_of_posts,
			'noOfFollowing' => $no_of_following,
			"userDetails" => $userDetails[0]
		));
		$follow_data = $this->userManager->getAllFollowDetails($this->session->userDetails['id']);
		$this->load->view('follow_list', array('followData' => $follow_data));
	}


	/**
	 * Create a new post
	 */
	public function createPost()
	{
		$data = $this->input->post('post_description');
		if (!$data) {
			$this->session->set_flashdata('error', 'Empty post data');
			redirect(site_url() . '/PostController/home');
		} else {
			$this->postManager->addPost($data);
			redirect(site_url() . '/PostController/home');
		}
	}

	/**
	 * Get logged in user's post
	 */
	public function userPostList()
	{
		$userDetails = $this->userManager->getUserDetails($this->session->userDetails['id']);
		$post_data = $this->postManager->getUsersPost($this->session->userDetails['id']);

		foreach ($post_data as $post) {
			$post_details = $this->postManager->genearatePostContent($post->getDescription(), $post->getPostId());
			$post->setDescription($post_details);
			$this->session->set_flashdata($post->getPostId(), $post_details['imageUrls']);
		}
		$this->load->view('shared/header');
		$this->load->view('post_list', array(
			'userDetails' => $userDetails[0],
			'posts' => $post_data,

		));
	}

	/**
	 * Render public home page of the user
	 */
	public function profile()
	{
		$userId = $this->uri->segment(3);
		$follow_type = $this->userManager->getUserState($userId);
		$no_of_following = $this->userManager->noOfFollowings($userId);
		$userDetails = $this->userManager->getUserDetails($userId);
		$post_data = $this->postManager->getUsersPost($userId);
		foreach ($post_data as $post) {
			$post_details = $this->postManager->genearatePostContent($post->getDescription(), $post->getPostId());
			$post->setDescription($post_details);
		}
		$this->load->view('shared/header');
		$this->load->view('private_home', array(
			'userDetails' => $userDetails[0],
			'posts' => $post_data,
			'noOfPosts' => count($post_data),
			'noOfFollowing' => $no_of_following,
			'followType' => $follow_type
		));
	}

	/**
	 * Search users by genre
	 */
	public function search(){
		$data = $this->input->post('keyWord');
		$genre_details = $this->genreManager->getGenreSearchResult($data);
		$search_result = $this->userManager->getSearchResult($genre_details);
		echo json_encode($search_result);
	}

	/**
	 * Get specific post details
	 */
	public function getPostDetails(){
		$postId = $this->input->get('postId');
		$post_data = $this->postManager->getPostDetails($postId);
		echo json_encode($post_data[0]);
	}

	/**
	 * Remove a post from user
	 */
	public function removePost(){
		$postId =  $this->uri->segment(3);
		$this->postManager->removePost($postId);
		redirect(site_url().'/PostController/userPostList');
	}

	/**
	 * Update specific user's post
	 */
	public function updatePost(){
		$updated_data = $this->input->post();
		$isSuccess = $this->postManager->updatePost($updated_data);
		redirect(site_url().'/PostController/userPostList');
	}


	/**
	 * Get following list for update search result
	 */
	public function getFollowingList(){
		$follow_data = $this->userManager->getAllFollowDetails($this->session->userDetails['id']);
		echo json_encode($follow_data);
	}
}
