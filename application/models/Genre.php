<?php
require_once(APPPATH.'/models/User.php');

class Genre extends User
{
	/**
	 * @var
	 */
	private $genreId;
	/**
	 * @var
	 */
	private $name;
	/**
	 * @var
	 */
	private $imageUrl;

    /**
     * Genre constructor.
     * @param $id
     * @param $name
     * @param $imageUrl
     */
    public function __construct($id, $name, $imageUrl)
    {
        $this->genreId = $id;
        $this->name = $name;
        $this->imageUrl = $imageUrl;
    }


	/**
	 * @param $id
	 * @param $name
	 * @param $imageUrl
	 * @param $userId
	 * @param $firstName
	 * @param $lastName
	 * @param $email
	 * @param $timestamp
	 * @param $userImageUrl
	 * @return Genre
	 */
	public static function genreWithUser($id, $name, $imageUrl, $userId, $firstName,
										 $lastName, $email, $timestamp, $userImageUrl)
    {

	    $instance = new self($id, $name, $imageUrl);
	    $instance->setId($userId);
        $instance->setFirstName($firstName);
        $instance->setLastName($lastName);
        $instance->setEmail($email);
        $instance->setTimestamp($timestamp);
        $instance->setImageUrl($userImageUrl);

	    return $instance;
    }

    /**
     * @return mixed
     */
    public function getGenreId()
    {
        return $this->genreId;
    }

    /**
     * @param mixed $genreId
     */
    public function setGenreId($genreId)
    {
        $this->genreId = $genreId;
    }



	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return mixed
	 */
	public function getImageUrl()
	{
		return $this->imageUrl;
	}


    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $imageUrl
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }





}
