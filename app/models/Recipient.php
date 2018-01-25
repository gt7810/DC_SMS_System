<?php

class Recipient extends Eloquent { 

	protected $table = 'recipients';

	public function message()
    {
        return $this->belongsTo('Message');
    }

}
