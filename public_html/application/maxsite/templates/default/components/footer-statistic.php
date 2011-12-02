<?php if (!defined('BASEPATH')) exit('No direct script access allowed');?>

	<div class="footer-statistic"><?php 
		
		$CI = & get_instance();	
		echo sprintf(
		t('Работает на <a href="http://max-3000.com/">MaxSite CMS</a> | Время: {elapsed_time} | SQL: %s | Память: {memory_usage}', 'templates')
		, $CI->db->query_count) . '<!--global_cache_footer-->';
	
		if (is_login())
			echo ' | <a href="' . getinfo('siteurl') . 'admin">' . t('Управление', 'templates') 
					. '</a> | <a href="' . getinfo('siteurl') . 'logout'.'">' . t('Выйти', 'templates') . '</a>';
		else
			echo ' | <a href="' . getinfo('siteurl') . 'login">' . t('Вход', 'templates') . '</a>';

	?></div>
