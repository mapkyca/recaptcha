<div class="captcha recaptcha">
<?php
	global $CONFIG;
	
	$ssl = false;
	if ($vars['use_ssl']) $ssl = $vars['use_ssl'];
	
	echo recaptcha_get_html(elgg_get_plugin_setting('pubkey','recaptcha'), null, $ssl);
?>
</div>
