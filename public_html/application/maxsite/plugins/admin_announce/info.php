<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => t('Админ-анонс'),
	'description' => t('Позволяет на стартовой странице админки размещать… что-то.'),
	'version' => '0.5.1',
	'author' => 'Wave',
	'plugin_url' => 'http://wave.fantregata.com/page/work-for-maxsite',
	'author_url' => 'http://wave.fantregata.com/',
	'group' => 'admin',
	'options_url' => getinfo('site_admin_url') . 'plugin_admin_announce',
);

?>