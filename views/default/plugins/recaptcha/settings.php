<?php
	$pubkey = $vars['entity']->pubkey;
	$privatekey = $vars['entity']->privatekey;
?>
<p><?php echo elgg_echo('recaptcha:publickey'); ?>:
	<?php echo elgg_view('input/text', array('name' => 'params[pubkey]', 'value' => $pubkey)); ?>
</p>
<p><?php echo elgg_echo('recaptcha:privatekey'); ?>:
	<?php echo elgg_view('input/text', array('name' => 'params[privatekey]', 'value' => $privatekey)); ?>
</p>