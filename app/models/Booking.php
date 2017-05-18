<?php

class Booking extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id_booking;

    /**
     *
     * @var integer
     */
    protected $id_price_table;

    /**
     *
     * @var integer
     */
    protected $id_user;

    /**
     *
     * @var string
     */
    protected $date;

    /**
     *
     * @var string
     */
    protected $hour;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var integer
     */
    protected $status;

    /**
     *
     * @var integer
     */
    protected $rating;

    /**
     * Method to set the value of field id_booking
     *
     * @param integer $id_booking
     * @return $this
     */
    public function setIdBooking($id_booking)
    {
        $this->id_booking = $id_booking;

        return $this;
    }

    /**
     * Method to set the value of field id_price_table
     *
     * @param integer $id_price_table
     * @return $this
     */
    public function setIdPriceTable($id_price_table)
    {
        $this->id_price_table = $id_price_table;

        return $this;
    }

    /**
     * Method to set the value of field id_user
     *
     * @param integer $id_user
     * @return $this
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;

        return $this;
    }

    /**
     * Method to set the value of field date
     *
     * @param string $date
     * @return $this
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Method to set the value of field hour
     *
     * @param string $hour
     * @return $this
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

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
     * Method to set the value of field status
     *
     * @param integer $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Method to set the value of field rating
     *
     * @param integer $rating
     * @return $this
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Returns the value of field id_booking
     *
     * @return integer
     */
    public function getIdBooking()
    {
        return $this->id_booking;
    }

    /**
     * Returns the value of field id_price_table
     *
     * @return integer
     */
    public function getIdPriceTable()
    {
        return $this->id_price_table;
    }

    /**
     * Returns the value of field id_user
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * Returns the value of field date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Returns the value of field hour
     *
     * @return string
     */
    public function getHour()
    {
        return $this->hour;
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
     * Returns the value of field status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('id_price_table', 'PriceTable', 'id_price_table', array('foreignKey' => true));
    }

}
