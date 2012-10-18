Elgg 1.8 Recaptcha code
=======================

Hooks into the elgg event system to provide an extensible captcha validation
tool based on recaptcha.

I'm sure there are other captcha implementations for elgg, but I couldn't see one 
that worked quite right or was updated fairly often. I had this kicking around for a 
1.6 build so I did a quick update.

Installation
------------

 * Follow the usual Elgg module installation practices, I.e. put the directory in your /mod.
 * Visit reCaptcha.net <http://recaptcha.net> and get public and private keys for your domain
 * Place these keys in the plugin's settings.

Usage
-----
 * Use the view input/captcha in your forms to display the captcha
 * Listen to the 'actionlist', 'captcha' plugin hook in your plugin's init function, and add to an array of actions which require captcha validation.

See
---

 * Me <http://www.marcus-povey.co.uk>
 * reCaptcha.net <http://recaptcha.net>
