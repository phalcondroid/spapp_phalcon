<?php

class ServiceCategory extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $id_service;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $image;

    /**
     *
     * @var string
     */
    protected $video;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field id_service
     *
     * @param integer $id_service
     * @return $this
     */
    public function setIdService($id_service)
    {
        $this->id_service = $id_service;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param string $price
     * @return $this
     */
    public function setPrice($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param string $price
     * @return $this
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field id_service
     *
     * @return integer
     */
    public function getIdService()
    {
        return $this->id_service;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field price
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Returns the value of field price
     *
     * @return string
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'PriceTable', 'id_service_category', NULL);
        $this->belongsTo('id_service', 'Service', 'id', array('foreignKey' => true));
    }

}
