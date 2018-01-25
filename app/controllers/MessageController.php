<?php

class MessageController extends BaseController {

	public function index()
	{
		return View::make('messages/index');
	}

	/**
	 * Show sent messages
	 *
	 * @return Response
	 */
	public function sentMessages()
	{	
		$messages = Message::orderBy('created_at', 'DESC')->get();
		return View::make('messages/sent',compact('messages'));
	}

	/**
	 * Show report for sent messages
	 *
	 * @return Response
	 */
	public function show($id)
	{	
		$message = Message::find($id);

		// 404 if message id doesn't exist in database
		if(!count($message)){ return App::abort(404); };

		// Get recipients associated with this message
		$recipients = $message->recipients()->get();
		$sentCount = $message->recipients()->where('status','Sent')->count();
		$errorCount = $message->recipients()->where('status','!=','Sent')->count();
		
		return View::make('messages/show',compact('message','recipients','sentCount','errorCount'));
	}

	/**
	 * Select group for sending
	 *
	 * @param  string  $group_name
	 * @return Response
	 */
	public function groupMessage($group_name)
	{	
		$yeargroup = Input::get('year') ?: null;
		$group = Group::selectGroup($group_name, $yeargroup);
		return View::make('messages/group',compact('group', 'group_name','yeargroup'));
	}

	/**
	 * Send Message to selected group - uses AJAX
	 *
	 * @param  string  $group_name
	 * @return Response
	 */
	public function sendGroupMessage($group_name)
	{	
		$yeargroup = Input::get('year') ?: null;

		$rules = array(
			'message'  => 'required | max:160'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Response::json(array(
		        'success' => false,
		        'errors' => $validator->getMessageBag()->toArray()
		    ), 400);
		} else {
			$group = Group::selectGroup($group_name, $yeargroup);
			$result = '';
			$txt = urlencode(Input::get('message'));

			// Save message to database
			$message = new Message;
			$message->text = Input::get('message');
			if($yeargroup){
				$message->group_name = $yeargroup;
			}else{
				$message->group_name = $group_name;
			};
			$message->sent_by = Auth::user()->username;
			$message->save();

			// Loop through each person and send the text message
			foreach($group as $person){
		        // Setup new Recepient object
				$recipient = new Recipient;
				$recipient->name = $person->name;
				$recipient->mobile = $person->mobile;
				$recipient->school_id = $person->id;

				// Create a Nexmo Object
				$nexmo = new Nexmo;
				$response = $nexmo->sendTxt($person->mobile, $txt);  

				// Record initial response
		        if($response['messages'][0]['status'] != 0){
		        	$recipient->status = 'Error';
		        	$recipient->status_message = $response['messages'][0]['error-text'];
				}else{
					$recipient->status = 'Sent';
					$recipient->sms_id = $response['messages'][0]['message-id'];
				}

				//Save result to database
				$recipient->message()->associate($message);
				$recipient->save();
			}		
			// Send user to the message report page
			return action('MessageController@show', array($message->id));
		}
	}

	/*
		Nexmo Callback Method 
		- Receive a response from Nexmo and update DC Message database with SMS status
	*/
	public function nexmoReceipt()
	{	
		$recipient = Recipient::where('sms_id','=',$_GET['messageId'])->first();

		if($_GET['err-code'] != 0){
        	$recipient->status = 'Error';
        	$recipient->status_message = $_GET['status'];
		}else{
			$recipient->status = 'Sent';
			$recipient->status_message = $_GET['status'];
		}
		$recipient->scts = $_GET['scts'];
		$recipient->network_code = $_GET['network-code'];
		$recipient->save();

		return Response::json(array('success' => true), 200);
	}

	/**
	 * Send a test message - Uses AJAX
	 *
	 * @return string $result
	 */
	public function sendTestMessage()
	{	
		$txt = urlencode(Input::get('message'));
		$mobile = urlencode( str_replace(' ', '', Input::get('mobile')) );

		// Create a Nexmo Object
		$nexmo = new Nexmo;
		$response = $nexmo->sendTxt($mobile, $txt);     
		
		if(isset($response['messages'][0]['error-text'])){
		    $result = '<div class="message-response alert alert-danger"><span class="fa fa-thumbs-down"></span> There was an error: '.$response['messages'][0]['error-text'].'</div>';
		}else{
		    $result = '<div class="message-response alert alert-success"><span class="fa fa-thumbs-up"></span> Message sent successfully.</div>';
		}

		return $result;
	}

}
