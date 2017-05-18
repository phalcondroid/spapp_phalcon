<?php

class PriceTable extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $id_price_table;

    /**
     *
     * @var integer
     */
    protected $id_service_category;

    /**
     *
     * @var double
     */
    protected $price;

    /**
     *
     * @var integer
     */
    protected $start;

    /**
     *
     * @var integer
     */
    protected $finish;

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
     * Method to set the value of field id_service_category
     *
     * @param integer $id_service_category
     * @return $this
     */
    public function setIdServiceCategory($id_service_category)
    {
        $this->id_service_category = $id_service_category;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field start
     *
     * @param integer $start
     * @return $this
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Method to set the value of field finish
     *
     * @param integer $finish
     * @return $this
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;

        return $this;
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
     * Returns the value of field id_service_category
     *
     * @return integer
     */
    public function getIdServiceCategory()
    {
        return $this->id_service_category;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field start
     *
     * @return integer
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Returns the value of field finish
     *
     * @return integer
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id_price_table', 'Booking', 'id_price_table', NULL);
        $this->belongsTo('id_service_category', 'ServiceCategory', 'id', array('foreignKey' => true));
    }

}
