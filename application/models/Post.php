<?php
require_once(APPPATH.'/models/User.php');

class Post extends User
{
	/**
	 * @var
	 */
	private $postId;

	/**
	 * @var
	 */
	private $description;

	/**
	 * @var
	 */
	private $updatedAt;

    /**
     * Post constructor.
     * @param $id
     * @param $description
     * @param $userId
     * @param $timestamp
     */
    public function __construct($id, $description, $updatedAt,$userId, $firstName,
                                $lastName, $email, $password, $timestamp, $imageUrl,
                                $emailConfirmed, $confirmationCode)
    {

        $this->postId = $id;
        $this->description = $description;
        $this->updatedAt = $updatedAt;
        $this->setId($userId);
        $this->setFirstName($firstName);
        $this->setLastName($lastName);
        $this->setEmail($email);
        $this->setPassword($password);
        $this->setTimestamp($timestamp);
        $this->setImageUrl($imageUrl);
        $this->setEmailConfirmed($emailConfirmed);
        $this->setConfirmationCode($confirmationCode);
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

	/**
	 * @return mixed
	 */
	public function getDescription()
	{
		return $this->description;
	}

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @param mixed $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

}
