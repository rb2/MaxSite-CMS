<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * (c) MaxSite CMS
 * ver.  1/12/2011
 * ver. 19/11/2011
 * ver.  6/11/2011
 * ver. 17/10/2011
 * ver. 10/09/2011
 * ver. 21/08/2011
*/

# файл functions-template.php
# объявлены функции для работы с шаблоном
# подключать обычным require в functions.php своего шаблона как default/functions-template.php


# функция возвращает массив $path_url-файлов по указанному $path - каталог на сервере
# $full_path - нужно ли возвращать полный адрес (true) или только имя файла (false)
# $exts - массив требуемых расширений. По-умолчанию - картинки
if (!function_exists('get_path_files'))
{
	function get_path_files($path = '', $path_url = '', $full_path = true, $exts = array('jpg', 'jpeg', 'png', 'gif', 'ico'))
	{
		// если не указаны пути, то отдаём пустой массив
		if (!$path or !$path_url) return array();
		if (!is_dir($path)) return array(); // это не каталог

		$CI = & get_instance(); // подключение CodeIgniter
		$CI->load->helper('directory'); // хелпер для работы с каталогами
		$files = directory_map($path, true); // получаем все файлы в каталоге
		if (!$files) return array();// если файлов нет, то выходим

		$all_files = array(); // результирующий массив с нашими файлами
		
		// функция directory_map возвращает не только файлы, но и подкаталоги
		// нам нужно оставить только файлы. Делаем это в цикле
		foreach ($files as $file)
		{
			if (@is_dir($path . $file)) continue; // это каталог
			
			$ext = substr(strrchr($file, '.'), 1);// расширение файла
			
			// расширение подходит?
			if (in_array($ext, $exts))
			{
				if (strpos($file, '_') === 0) continue; // исключаем файлы, начинающиеся с _
				
				// добавим файл в массив сразу с полным адресом
				if ($full_path)
					$all_files[] = $path_url . $file;
				else
					$all_files[] = $file;
			}
		}
		
		natsort($all_files); // отсортируем список для красоты
		
		return $all_files;
	}
}

# возвращает файлы для favicon
if (!function_exists('default_favicon'))
{
	function default_favicon()
	{
		$all = get_path_files(getinfo('template_dir') . 'images/favicons/', getinfo('template_url') . 'images/favicons/', false);
		return implode($all, '#');
	}
}

# возвращает файлы для компонент
if (!function_exists('default_components'))
{
	function default_components()
	{
		static $all = false; // запоминаем результат, чтобы несколько раз не вызывать функцию get_path_files
		
		if ($all === false)
			$all = get_path_files(getinfo('template_dir') . 'components/', getinfo('template_url') . 'components/', false, array('php'));
			
		return '0||' . t('Отсутствует', __FILE__) . '#' . implode($all, '#');
	}
}


# возвращает файлы для css-профиля
if (!function_exists('default_profiles'))
{
	function default_profiles()
	{
		$all = get_path_files(getinfo('template_dir') . 'css/profiles/', getinfo('template_url') . 'css/profiles/', false, array('css'));
		return implode($all, '#');
	}
}

# возвращает файлы для логотипа
if (!function_exists('default_header_logo'))
{
	function default_header_logo()
	{
		$all = get_path_files(getinfo('template_dir') . 'images/logos/', getinfo('template_url') . 'images/logos/', false);
		return implode($all, '#');
	}
}


# возвращает каталоги в uploads, где могут храниться файлы для шапки 
if (!function_exists('default_header_image'))
{
	function default_header_image()
	{
		$CI = & get_instance(); // подключение CodeIgniter
		$CI->load->helper('directory'); // хелпер для работы с каталогами
		$all_dirs = directory_map(getinfo('uploads_dir'), true); // только в uploads
		
		$dirs = array();
		foreach ($all_dirs as $d)
		{
			// нас интересуют только каталоги
			if (is_dir( getinfo('uploads_dir') . $d) and $d != '_mso_float' and $d != 'mini' and $d != '_mso_i' and $d != 'smiles')
			{
				$dirs[] = $d;
			}
		}
		
		natsort($dirs);
		
		return '-template-||' . t('Каталог шаблона', __FILE__) . '#' . implode($dirs, '#');
	}
}


# вывод подключенных css-профилей
if (!function_exists('default_out_profiles'))
{
	function default_out_profiles()
	{
		if ($default_profiles = mso_get_option('default_profiles', 'templates', array())) // есть какие-то профили оформления
		{
			$css_out = '';
			foreach($default_profiles as $css_file)
			{
				$fn = getinfo('template_dir') . 'css/profiles/' . $css_file;
				
				if (file_exists($fn)) 
					$css_out .= file_get_contents($fn) . NR;
			}
			
			if ($css_out) 
			{
				
				ob_start();
				eval( '?>' . stripslashes( $css_out ) . '<?php ');
				$css_out = ob_get_contents();
				ob_end_clean();
				
				$css_out = str_replace('[TEMPLATE_URL]', getinfo('template_url'), $css_out);
				$css_out = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_out);
				$css_out = str_replace(array('; ', ' {', ': ', ', '), array(';', '{', ':', ','), $css_out);
				echo NT . '<style>' . NR . $css_out . NT . '</style>' . NR;
			}
		}
	}
}

# функция возвращает полный путь к файлу компоненты для указанной опции
# $option - опция
# $def_file - файл по умолчанию
# пример использования
# if ($fn = get_component_fn('default_header_component2', 'menu.php')) require($fn);
if (!function_exists('get_component_fn'))
{
	function get_component_fn($option = '', $def_file = '')
	{
		if ($fn = mso_get_option($option, 'templates', $def_file)) // получение опции
		{
			if (file_exists(getinfo('template_dir') . 'components/' . $fn)) // проверяем если файл в наличии
				return (getinfo('template_dir') . 'components/' . $fn); // да
			else
			{
				if (file_exists(getinfo('template_dir') . 'components/' . $def_file))
					return getinfo('template_dir') . 'components/' . $def_file;
			}
		}
		return false; // ничего нет
	}
}

# функция подключает файлы css-style установленных компонентов и выводит их содержимое в едином блоке <style>
# использовать в head 
# $component_options - названия опций, которыми определяются компоненты в шаблоне
# css-файл компонента находится в общем css-каталоге шаблона с именем помпонетна, наример menu.php и menu.css
if (!function_exists('out_component_css'))
{
	function out_component_css($component_options = array('default_header_component1', 'default_header_component2', 'default_header_component3', 'default_header_component4', 'default_header_component5', 'default_footer_component1', 'default_footer_component2', 'default_footer_component3', 'default_footer_component4', 'default_footer_component5'))
	{
		
		// $css_files = array(); // результирующий массив css-файлов
		$css_out = ''; // все стили из файлов
		
		// проходимся по всем заданным опциям
		foreach($component_options as $option)
		{
			// и если они определены
			if ($fn = mso_get_option($option, 'templates', false))
			{
				$fn = str_replace('.php', '.css', $fn); // в имени файла следует заменить расширение php на css
				
				if (file_exists(getinfo('template_dir') . 'components/css/' . $fn)) // проверяем если ли файл в наличии
				{
					// $css_files[] = $fn; // запомнили имя
					
					// получаем содержимое
					if ($r = @file_get_contents(getinfo('template_dir') . 'components/css/' . $fn))
						$css_out .= $r . NR;
				}
			}
		}
		
		if ($css_out) // если есть что выводить
		{
			if ($css_out) 
			{
				$css_out = str_replace('[TEMPLATE_URL]', getinfo('template_url'), $css_out);
				$css_out = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $css_out);
				$css_out = str_replace(array('; ', ' {', ': ', ', '), array(';', '{', ':', ','), $css_out);
				echo NT . '<style>' . NR . $css_out . NT . '</style>' . NR;
			}
		}
	}
}


# типовой вывод секции HEAD
# можно использовать в header.php
if (!function_exists('mso_default_head_section'))
{
	function mso_default_head_section($options = array())
	{
		echo '<!DOCTYPE HTML>
<html><head>
	<meta charset="UTF-8">
	<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=8"><![endif]-->
	<title>' . mso_head_meta('title') . '</title>
	<meta name="generator" content="MaxSite CMS">
	<meta name="description" content="' . mso_head_meta('description') . '">
	<meta name="keywords" content="' . mso_head_meta('keywords') . '">
	<link rel="shortcut icon" href="' . getinfo('template_url') . 'images/favicons/' . mso_get_option('default_favicon', 'templates', 'favicon1.png') . '" type="image/x-icon">
	';
	
		if (mso_get_option('default_canonical', 'templates', 0)) echo mso_link_rel('canonical');
	
		echo NT . '<!-- RSS -->' . NT . mso_rss();

		echo NT . '<!-- CSS -->' . NT . '<link rel="stylesheet" href="'; 
		
			if (file_exists(getinfo('template_dir') . 'css/css.php')) echo 'css.php'; 
			else 
			{
				if (file_exists(getinfo('template_dir') . 'css/my_style.css')) // если есть css/my_style.css
				{
					echo getinfo('template_url') . 'css/my_style.css'; 
				}
				else
				{ 
					if (file_exists(getinfo('template_dir') . 'css/style-all-mini.css')) // если есть style-all-mini.css
					{
						echo getinfo('template_url') . 'css/style-all-mini.css'; 
					}
					elseif (file_exists(getinfo('template_dir') . 'css/style-all.css')) // нет mini, подключаем обычный файл
					{
						echo getinfo('template_url') . 'css/style-all.css'; 
					}
					else echo getinfo('templates_url') . 'default/css/style-all-mini.css'; 
				}
			}
			
		echo '" type="text/css" media="screen">';
		
		
		echo '<link rel="stylesheet" href="' . getinfo('template_url') . 'css/print.css" type="text/css" media="print">';
		
		out_component_css();
			
		echo NT . '<!-- js -->' .  mso_load_jquery();
		
		if (file_exists(getinfo('template_dir') . 'js/my.js')) 
			echo '	<script type="text/javascript" src="' . getinfo('template_url') . 'js/my.js"></script>';

		echo NT . '<!-- plugins -->' . NR;
		mso_hook('head');
		echo NT . '<!-- /plugins -->' . NR;
		
		if (function_exists('default_out_profiles')) default_out_profiles();
		
		if (file_exists(getinfo('template_dir') . 'css/add_style.css')) echo '<link rel="stylesheet" href="' . getinfo('template_url') .'css/add_style.css" type="text/css" media="screen">';
		
		if (file_exists(getinfo('template_dir') . 'custom/head.php')) require(getinfo('template_dir') . 'custom/head.php');
		if ($f = mso_page_foreach('head')) require($f);
		if (function_exists('ushka')) echo ushka('head');
		
		if ($my_style = mso_get_option('my_style', 'templates', '')) echo NR . '<!-- custom css-my_style -->' . NR . '	<style type="text/css">' . NR . $my_style . '	</style>';
	
		echo NR . '</head>';
		if (!$_POST) flush();
	}
}

# end file