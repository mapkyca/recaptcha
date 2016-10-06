<?php
$lang = get_language();
?>
<div class="captcha recaptcha">
    <div class="g-recaptcha" data-sitekey="<?php echo elgg_get_plugin_setting('pubkey','recaptcha'); ?>"></div>
    <script type="text/javascript"
	    src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>">
    </script>
</div>
