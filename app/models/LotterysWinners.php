<?php


class LotterysWinners extends Eloquent  {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'lottery_winners';

    protected $fillable = array('lottery_id', 'lottery_round','lottery_winners');
    public $timestamps = false;

}
