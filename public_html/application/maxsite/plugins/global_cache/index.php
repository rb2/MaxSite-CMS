<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# функция автоподключения плагина
function global_cache_autoload($args = array())
{
	if (!is_login() and mso_segment(1) != 'admin')
	{
		if ( mso_get_option('global_cache', 'templates', false) ) // если разрешено в опциях шаблона
		{
			mso_hook_add('global_cache_start', 'global_cache_start');
			mso_hook_add('global_cache_end', 'global_cache_end');
			
			# дополнительные хуки, которые позволяют сбросить кэш - использовать в плагинах и т.п.
			mso_hook_add('global_cache_key_flush', 'global_cache_key_flush'); // сброс кэша текущей страницы
			mso_hook_add('global_cache_all_flush', 'global_cache_all_flush'); // сброс всего html-кэша
			
			# сброс кэша для страниц, которые отправлены как POST
			# if ( isset($_POST) and $_POST ) global_cache_key_flush();
			
			# сброс кэша если была отправка POST
			if ( isset($_POST) and $_POST ) global_cache_all_flush();		
		}
	}
}

# функция выполняется при деактивации (выкл) плагина
function global_cache_deactivate($args = array())
{	
	// очистить html-кэш
	global_cache_all_flush();
	return $args;
}

# функция выполняется при деинстяляции плагина
function global_cache_uninstall($args = array())
{	
	// очистить html-кэш
	global_cache_all_flush();
	return $args;
}

# текущий ключ
# если $dir = true, то добавляем каталог html
function global_cache_key($dir = true)
{
	$cache_key = $_SERVER['REQUEST_URI'];
	$cache_key = str_replace('/', '-', $cache_key);
	$cache_key = mso_slug(' ' . $cache_key);
	
	if ($dir) $cache_key = 'html/' . $cache_key . '.html';
		else $cache_key = $cache_key . '.html';
	
	return $cache_key;
}

# старт кэширования
function global_cache_start($arg = array())
{
	if ( $k = mso_get_cache(global_cache_key(), true) ) 
	{
		// да есть в кэше
		$CI = & get_instance();	
		$mq = $CI->db->query_count; // колво sql-запросов
		$k = str_replace('<!--global_cache_footer-->', ' | Cache (' . $mq . ')', $k);
		echo $k; 
		return true;
	}
	
	ob_start();
	return false;
}

# стоп кэширования - отдача результата
function global_cache_end($arg = array())
{
	# сброс кэша для страниц, которые отправлены как POST
	if ( isset($_POST) and $_POST ) global_cache_key_flush();
		else mso_add_cache(global_cache_key(), ob_get_flush(), 86400, true);
}

# сброс кэша текущей страницы
function global_cache_key_flush($arg = array())
{
	mso_flush_cache(false, 'html', global_cache_key(false));
	return $arg;
}

# сброс всего кэша html
function global_cache_all_flush($arg = array())
{
	mso_flush_cache(false, 'html');
	return $arg;
}



?>