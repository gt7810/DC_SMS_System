<?php 

use Illuminate\Session\Store as SessionStore;

class LDAP {

	public static function authenticate($username, $password) {
		
		if(empty($username) || empty($password))
		{
			Log::error('Error binding to LDAP: username or password empty');
			return false;
		}

		$ldapRdn = static::getLdapRdn($username);
		$ldapconn = ldap_connect( Config::get('auth.ldap_server') ) or die("Could not connect to LDAP server.");

		//Set LDAP options
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

		$result = false;

		if ($ldapconn) {
			//Bind to LDAP server
			$ldapbind = @ldap_bind($ldapconn, $ldapRdn, $password);
			$info = ldap_search($ldapconn, Config::get('auth.ldap_tree'), "(uid=".$_POST['username'].")") or die ("Error in search
query");

			if ($ldapbind) {	
				$result = ldap_get_entries($ldapconn, $info);
				//$result = true;
			}else {
				Log::error('Error binding to LDAP server.');
			}

			ldap_unbind($ldapconn);

		} else {
			Log::error('Error connecting to LDAP.');
		}

		return $result;

	}

	public static function getLdapRdn($username) {
		return str_replace('[username]', $username, 'uid=[username],' . Config::get('auth.ldap_tree'));
	}

	// Check username against array of allowed users
	// If allowed then setup the session
	public function checkUser($username,$ldapsearch){

		$allowedUsers = array('petestewart','markbeach','peterlasscock','georgetibbetts','michellemouton');

		if(in_array($username, $allowedUsers, true))
		{
			return true;
		}

		return false;
	}
 
}
