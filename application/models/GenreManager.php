<?php
require_once(APPPATH . '/models/Genre.php');

class GenreManager extends CI_Model
{

	/**
	 * GenreManager constructor.
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
	 * Get all genres
	 * @return array|null
	 */
	public function getAllGenres()
	{
		$genreSelect = prefixTable("genres", "genre", $this->db);
		$this->db->select("$genreSelect")
			->from('genres');

		$objList = objectMapper("Genre", $this->db->get()->result());

		return $objList;
	}


	/**
	 * get genres list which is related to user
	 * @return array|null
	 */
	public function getUserGenres()
	{
		$genreSelect = prefixTable("genres", "genre", $this->db);
		$user_genreSelect = prefixTable("users_genres", "users_genre", $this->db);
		$this->db->select($genreSelect, $user_genreSelect)
			->from('users_genres')
			->where(array("userId" => $this->session->userDetails['id']))
			->join('genres', 'genres.id = users_genres.genreId');

		$objList = objectMapper("Genre", $this->db->get()->result());

		return $objList;

	}

	/**
	 * @param $name
	 * Get genres with user details using genre name
	 * @return array|null
	 */
	public function getGenreSearchResult($name)
	{
		$genreSelect = prefixTable("genres", "genre", $this->db);
		$user_genreSelect = prefixTable("users_genres", "users_genre", $this->db);
		$userSelect = prefixTable("users", "user", $this->db);
		$this->db->select("$genreSelect, $user_genreSelect, $userSelect")
			->from('genres')
			->where(array("name" => $name))
			->join('users_genres', 'users_genres.genreId = genres.id')
			->join('users', 'users_genres.userId = users.id');


		return $this->db->get()->result();

	}


}
