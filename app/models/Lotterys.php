<?php


class Lotterys extends Eloquent  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lotterys';

    protected $fillable = array('name', 'gift','maxrounds','roundwinners');
    public $timestamps = false;

}
