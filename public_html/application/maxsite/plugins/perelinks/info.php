<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

$info = array(
	'name' => t('Перелинковка страниц', __FILE__),
	'description' => t('Плагин для внутренней прелинковки страниц путем анализа наиболее часто встречающихся слов.', __FILE__),
	'version' => '1.3',
	'author' => 'Maxim, Wave',
	'plugin_url' => 'http://wave.fantregata.com/page/work-for-maxsite',
	'author_url' => 'http://maxsite.org/',
	'group' => 'template',
	'options_url' => getinfo('site_admin_url') . 'perelinks',
);

# end file