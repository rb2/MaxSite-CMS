<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => t('Гостевая книга', __FILE__),
	'description' => t('Гостевая книга на вашем сайте', __FILE__),
	'version' => '1.2',
	'author' => 'Максим',
	'plugin_url' => 'http://max-3000.com/',
	'author_url' => 'http://maxsite.org/',
	'group' => 'template',
	'options_url' => getinfo('site_admin_url') . 'guestbook',
);

# end file