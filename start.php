<?php
	/**
	 * Recaptcha plugin.
	 * 
	 * Replaces the elgg standard captcha with recaptcha.
	 *
	 * @author Marcus Povey <marcus@dushka.co.uk>
	 * @copyright Marcus Povey 2009-2010 
	 * @license GNU Public License version 2
	 */
	
	require_once(dirname(__FILE__) . "/vendor/recaptcha-php-1.10/recaptchalib.php");
	
	function recaptcha_init()
	{
		// Register a function that provides some default override actions
		elgg_register_plugin_hook('actionlist', 'captcha', 'recaptcha_actionlist_hook');
		
		// Register actions to intercept
		$actions = array();
		$actions = elgg_trigger_plugin_hook('actionlist', 'captcha', null, $actions);
		
		if (($actions) && (is_array($actions)))
		{
			foreach ($actions as $action)
				elgg_register_plugin_hook("action", $action, "recaptcha_verify_action_hook");
		}
		
		// Now run this stuff, but only once
		run_function_once("recaptcha_run_once"); 
	}
	
	/**
	 * Runonce, make sure environment is ok.
	 */
	function recaptcha_run_once()
	{
		disable_plugin('captcha');
	}
	
	/**
	 * Listen to the action plugin hook and check the captcha.
	 *
	 * @param unknown_type $hook
	 * @param unknown_type $entity_type
	 * @param unknown_type $returnvalue
	 * @param unknown_type $params
	 */
	function recaptcha_verify_action_hook($hook, $entity_type, $returnvalue, $params)
	{
		global $CONFIG;
		
		if ($hook == 'action')
		{
			$resp = recaptcha_check_answer (elgg_get_plugin_setting('privatekey','recaptcha'),
                                $_SERVER["REMOTE_ADDR"],
                                get_input('recaptcha_challenge_field', '', false),
                                get_input('recaptcha_response_field', '', false)
			);
			
			
			if (!$resp->is_valid) {
				register_error(elgg_echo('recaptcha:failed'));
				
				forward($_SERVER['HTTP_REFERER']);
			
				return false;
			}
		}
			
	}
	
	/**
	 * This function returns an array of actions the captcha will expect a captcha for, other plugins may
	 * add their own to this list thereby extending the use.
	 *
	 * @param unknown_type $hook
	 * @param unknown_type $entity_type
	 * @param unknown_type $returnvalue
	 * @param unknown_type $params
	 */
	function recaptcha_actionlist_hook($hook, $entity_type, $returnvalue, $params)
	{
		if (!is_array($returnvalue))
			$returnvalue = array();
			
		$returnvalue[] = 'register';
		$returnvalue[] = 'user/requestnewpassword';
			
		return $returnvalue;
	}
	
	elgg_register_event_handler('init','system','recaptcha_init', 999);