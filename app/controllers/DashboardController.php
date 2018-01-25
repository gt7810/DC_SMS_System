<?php

class DashboardController extends BaseController {

	public function index()
	{		
		$message = Message::orderBy('created_at','DESC')->first();
		
		if(count($message)){
			$sentCount = $message->recipients()->where('status','Sent')->count();
			$errorCount = $message->recipients()->where('status','!=','Sent')->count();
		}else{
			$sentcount = '';
			$errorCount = '';
		}
		
		return View::make('dashboard/index',compact('message','sentCount','errorCount'));
	}

}
