<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => 'WordPress convert',
	'description' => t('Конвертирование записей, страниц, рубрик и комментариев из WordPress в MaxSite CMS', 'plugins'),
	'version' => '1.2',
	'author' => 'Максим',
	'plugin_url' => 'http://max-3000.com/',
	'author_url' => 'http://maxsite.org/',
	'group' => 'template',
	'options_url' => getinfo('site_admin_url') . 'plugin_wpconvert',
	
);

# end file