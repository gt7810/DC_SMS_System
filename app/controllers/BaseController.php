<?php

class BaseController extends Controller {

	public $user;

	public function __construct() {
		$user = Auth::user();
		$nexmo_balance = Nexmo::getBalance();
		View::share(array('user' => $user,'nexmo_balance' => $nexmo_balance));
 	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
