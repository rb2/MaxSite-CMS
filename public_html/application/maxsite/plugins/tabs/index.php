<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# функция автоподключения плагина
function tabs_autoload($args = array())
{
	mso_hook_add( 'head', 'tabs_head');
	mso_register_widget('tabs_widget', t('Табы (закладки)', 'plugins')); # регистрируем виджет
}

# функция выполняется при деинсталяции плагина
function tabs_uninstall($args = array())
{	
	mso_delete_option_mask('tabs_widget_', 'plugins'); // удалим созданные опции
	return $args;
}


# функция, которая берет настройки из опций виджетов
function tabs_widget($num = 1) 
{
	$widget = 'tabs_widget_' . $num; // имя для опций = виджет + номер
	$options = mso_get_option($widget, 'plugins', array() ); // получаем опции
	
	// заменим заголовок, чтобы был в  h2 class="box"
	if ( isset($options['header']) and $options['header'] ) 
		$options['header'] = mso_get_val('widget_header_start', '<h2 class="box"><span>') . $options['header'] . mso_get_val('widget_header_end', '</span></h2>');
	else $options['header'] = '';
	
	return tabs_widget_custom($options, $num);
}


# форма настройки виджета 
# имя функции = виджет_form
function tabs_widget_form($num = 1) 
{
	$widget = 'tabs_widget_' . $num; // имя для формы и опций = виджет + номер
	
	// получаем опции 
	$options = mso_get_option($widget, 'plugins', array());
	
	if ( !isset($options['header']) ) $options['header'] = '';
	if ( !isset($options['tabs']) ) $options['tabs'] = '';
	if ( !isset($options['type_func']) ) $options['type_func'] = 'widget';
	
	// вывод самой формы
	$CI = & get_instance();
	$CI->load->helper('form');
	
	$form = '';
	
	// if (!function_exists('ushka')) $form = '<p style="color: red; text-align: center;">' . t('Для работы этого виджета следует включить плагин «Ушки»!', 'plugins') . '</p>'; 
	
	$form .= '<p><div class="t150">' . t('Заголовок:', 'plugins') . '</div> '. form_input( array( 'name'=>$widget . 'header', 'value'=>$options['header'] ) ) ;
	
	$form .= '<p><div class="t150">' . t('Табы:', 'plugins') . '</div> '. form_textarea( array( 'name'=>$widget . 'tabs', 'value'=>$options['tabs'] ) ) ;
	
	$form .= '<br><div class="t150">&nbsp;</div>' . t('Указывайте по одному табу в каждом абзаце в формате: <strong>заголовок | виджет номер</strong>', 'plugins');
	
	$form .= '<br><div class="t150">&nbsp;</div>' . t('Например: <strong>Цитаты | randomtext_widget 1</strong>', 'plugins');
	
	$form .= '<br><div class="t150">&nbsp;</div>' . t('Для ушки: <strong>Цитаты | ушка_цитаты</strong>', 'plugins');
	
	
	$form .= '<p><div class="t150">' . t('Использовать:', 'plugins') . '</div> '. form_dropdown( $widget . 'type_func', array( 'widget'=>t('Виджет (функция и номер через пробел)', 'plugins'), 'ushka'=>t('Ушка (только название)', 'plugins')), $options['type_func']);

	return $form;
}


# сюда приходят POST из формы настройки виджета
# имя функции = виджет_update
function tabs_widget_update($num = 1) 
{
	$widget = 'tabs_widget_' . $num; // имя для опций = виджет + номер
	
	// получаем опции
	$options = $newoptions = mso_get_option($widget, 'plugins', array());
	
	# обрабатываем POST
	$newoptions['header'] = mso_widget_get_post($widget . 'header');
	$newoptions['tabs'] = mso_widget_get_post($widget . 'tabs');
	$newoptions['type_func'] = mso_widget_get_post($widget . 'type_func');
	
	if ( $options != $newoptions ) 
		mso_add_option($widget, $newoptions, 'plugins');
}


# подключаем в заголовок стили и js
function tabs_head($args = array()) 
{
	/*
		Идея и основа кода (c) Dimox, http://dimox.name/universal-jquery-tabs-script/
		Переделка, адаптация (с) MAX, http://maxsite.org/
	*/
	
	echo mso_load_jquery(). mso_load_jquery('jquery.cookie.js') . '

	<script>
	$(document).ready(function()
	{
		var cookieIndex = $.cookie("curTabs");
		if (cookieIndex != null) // есть кука 
		{
			$("ul.tabs-nav li.elem").eq(cookieIndex).addClass("tabs-current").siblings().removeClass("tabs-current")
				.parents("div.tabs").find("div.tabs-box").hide().eq(cookieIndex).show();
		}
		$("ul.tabs-nav").delegate("li.elem:not(li.tabs-current)", "click", function() 
		{
			$(this).addClass("tabs-current").siblings().removeClass("tabs-current")
					.parents("div.tabs").find("div.tabs-box").hide().eq($(this).index()).fadeIn(300);
			
			$.cookie("curTabs", $(this).index(), {expires: 1, path: "/"});
		})

	})(jQuery);
	</script>
	';

	return $args;
}

# функции плагина
function tabs_widget_custom($options = array(), $num = 1)
{
	$out = '';
	if ( !isset($options['header']) ) $options['header'] = '';
	if ( !isset($options['tabs']) ) $options['tabs'] = '';
	if ( !isset($options['type_func']) ) $options['type_func'] = 'widget';
	
	$ar = explode("\n", trim($options['tabs'])); // все табы в массив
	
	$tabs = array(); // наши закладки
	if ($ar)
	{
		foreach($ar as $key=>$val)
		{
			$t = explode('|', $val);
			if (isset($t[0]) and isset($t[1])) // есть и название и ушка
			{
				$tabs[$key]['title'] = trim($t[0]);
				$tabs[$key]['ushka'] = trim($t[1]);
			}
		}
	}
	
	if ($tabs) // есть закладки, можно выводить
	{
		$out .= NR . '<div class="tabs"><ul class="tabs-nav">' . NR;
		
		$current = ' tabs-current';
		
		foreach($tabs as $key => $tab)
		{
			$out .= '<li class="elem' . $current . '"><span>' . $tab['title'] . '</span></li>' . NR;
			$current = '';
		}
		$out .= '</ul><div class="clearfix"></div>' . NR;
		
		$visible = ' tabs-visible';
		foreach($tabs as $key => $tab)
		{
			if ($options['type_func'] == 'widget') // выводим с помощью функции виджета ($tab['ushka'])
			{
				$func = $tab['ushka']; // category_widget 20
				$nm = 0;
				
				// разделим и определим номер виджета
				$arr_w = explode(' ', $func); // в массив
				
				if ( sizeof($arr_w) > 1 ) // два или больше элементов
				{
					$func = trim( $arr_w[0] ); // первый - функция
					$nm = trim( $arr_w[1] ); // второй - номер виджета
				}
				
				// замены номера виджета из mso_show_sidebar()
				$nm = mso_slug($nm);
				$nm = str_replace('--', '-', $nm);
					
				if ( function_exists($func) ) 
				{
					$func = $func($nm);
				}
				else $func = 'no-func';
			}
			else 
			{
				if (function_exists('ushka')) $func = ushka($tab['ushka']);
				else $func = '';
			}

			$out .= NR . '<div class="tabs-box' . $visible  . '">' . $func . '</div>' . NR;
			$visible = '';
		}
			
		$out .= '</div><!-- div class="tabs -->' . NR;
	}
	
	if ($out and $options['header']) 
		$out = $options['header'] . '<div class="widget-content">' . $out . '</div><!-- div class=widget-content -->';
	else
		$out = '<div class="widget-content">' . $out . '</div><!-- div class=widget-content -->';
	
	return $out;
}

# end file