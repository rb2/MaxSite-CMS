<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

mso_cur_dir_lang('templates');

mso_head_meta('title', t('Галерея') ); // meta title страницы


# начальная часть шаблона
require(getinfo('template_dir') . 'main-start.php');

if (isset($options['all']))
{
	$current_gal = mso_segment(2);
	
	// first | Моя галерея | / % test | name_file | 100

	$all = explode("\n", trim($options['all']));
	
	if ($current_gal) // указана конкретная галерея
	{
		foreach($all as $gal)
		{
			$gal = explode('|', $gal);
			
			if (isset($gal[0]) and trim($gal[0]) == $current_gal)
			{
				echo '<h1>' . trim($gal[1]) . '</h1>';

				$arg = array(
					'galother' => str_replace('%', '|', $gal[2]),
					'sort' => trim($gal[3]),
					'count' => (int) $gal[4],
					'class' => 'gallery_page',
					);
				
				if (isset($gal[5])) $arg['filter'] = $gal[5];
				
				echo '<p><a href="' . getinfo('site_url') . $options['slug_gallery'] . '">Все галереи</a>';
				echo random_gal_widget_custom($arg);
				
				break;
			}
		}
	}
	else // выводим список всех
	{
		echo '<h1>' . t('Галереи') . '</h1>';
		echo '<div class="gallery_page"><ul class="gallery_page">';
		
		foreach($all as $gal)
		{
			$gal = explode('|', $gal);
			
			echo '<li><a href="' . getinfo('site_url') . $options['slug_gallery'] . '/' 
				. trim($gal[0]) . '">' . $gal[1] . '</a></li>';
		}
		
		echo '</ul></div><!-- div class=gallery_page -->';
	}
}

# конечная часть шаблона
require(getinfo('template_dir') . 'main-end.php');
	
?>