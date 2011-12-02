<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => 'samborsky_polls',
	'description' => t('Голосования от Евгения Самборского', __FILE__),
	'version' => '1.9',
	'author' => 'Евгений Самборский',
	'plugin_url' => 'http://www.samborsky.com/samborsky_polls/',
	'author_url' => 'http://www.samborsky.com/',
	'group' => 'template',
	'help' => getinfo('plugins_url') . 'samborsky_polls/install.txt',
	'options_url' => getinfo('site_admin_url') . 'samborsky_polls',
);

# end file