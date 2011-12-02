<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	
		echo '<h1>' . t('404 - несуществующая страница') . '</h1>';
		echo '<p>' . t('Извините по вашему запросу ничего не найдено!') . '</p>';
		echo mso_hook('page_404');

?>