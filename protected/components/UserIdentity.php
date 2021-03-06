<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;

	public function __construct($username,$password)
	{
		parent::__construct($username, $password);
	}
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		

		$record = AdminUser::model()->findByAttributes(array('email' => $this->username));
		
		if ($record === null) {
			$this->errorCode = self::ERROR_USERNAME_INVALID;
		} else {
			if ($record->password !== md5('weblitz!@#' . $this->password))
				$this->errorCode = self::ERROR_PASSWORD_INVALID;
			else {
				$this->_id = $record->id;
				$this->setState('user_id', $record->id);
				$this->setState('role', $record->role);				
				$this->errorCode = self::ERROR_NONE;
			}
		}
		return!$this->errorCode;
	}
}