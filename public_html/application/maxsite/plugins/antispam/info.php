<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => 'Антиспам',
	'description' => 'Отлавливает спам. Можно задать черные списки IP и запретных слов. Ведется лог.',
	'version' => '1.2',
	'author' => 'Максим',
	'plugin_url' => 'http://max-3000.com/',
	'author_url' => 'http://maxsite.org/',
	'group' => 'template',
	'options_url' => getinfo('site_admin_url') . 'plugin_antispam',
);

# end file