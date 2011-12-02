<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => t('Mail Send', __FILE__),
	'description' => t('Отправка email-сообщений по списку рассылки', __FILE__),
	'version' => '1.0',
	'author' => 'Максим',
	'plugin_url' => 'http://max-3000.com/',
	'author_url' => 'http://maxsite.org/',
	'group' => 'template',
	'options_url' => getinfo('site_admin_url') . 'mail_send',
);

# end file