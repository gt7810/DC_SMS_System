<?php

class Message extends Eloquent {

	protected $table = 'messages';

	public function recipients()
    {
        return $this->hasMany('Recipient');
    }

    // Return Success percentage
    
    public function sentResult()
    {	
    	$sent = $this->recipients()->where('status','Sent')->count();
    	$total = $this->recipients()->count();
    	$result = round(($sent/$total) * 100,1);
        return $result.'%';
    }

}
