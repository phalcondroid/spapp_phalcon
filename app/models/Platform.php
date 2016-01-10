<?php

class Platform extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id_auth;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $key;

    /**
     *
     * @var string
     */
    protected $start_date;

    /**
     *
     * @var string
     */
    protected $finish_date;

    /**
     * Method to set the value of field id_auth
     *
     * @param integer $id_auth
     * @return $this
     */
    public function setIdAuth($id_auth)
    {
        $this->id_auth = $id_auth;

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
     * Method to set the value of field key
     *
     * @param string $key
     * @return $this
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Method to set the value of field start_date
     *
     * @param string $start_date
     * @return $this
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;

        return $this;
    }

    /**
     * Method to set the value of field finish_date
     *
     * @param string $finish_date
     * @return $this
     */
    public function setFinishDate($finish_date)
    {
        $this->finish_date = $finish_date;

        return $this;
    }

    /**
     * Returns the value of field id_auth
     *
     * @return integer
     */
    public function getIdAuth()
    {
        return $this->id_auth;
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
     * Returns the value of field key
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Returns the value of field start_date
     *
     * @return string
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Returns the value of field finish_date
     *
     * @return string
     */
    public function getFinishDate()
    {
        return $this->finish_date;
    }

}
