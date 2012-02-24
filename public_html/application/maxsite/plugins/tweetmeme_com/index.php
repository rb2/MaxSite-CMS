<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# функция автоподключения плагина
function tweetmeme_com_autoload()
{
	if (!is_feed() and (is_type('page') or is_type('home'))) 
		mso_hook_add('content_content', 'tweetmeme_com_content'); # хук на вывод контента
}


# функция выполняется при деинсталяции плагина
function tweetmeme_com_uninstall($args = array())
{	
	mso_delete_option('plugin_tweetmeme_com', 'plugins' ); // удалим созданные опции
	return $args;
}

# функция отрабатывающая миниопции плагина (function плагин_mso_options)
# если не нужна, удалите целиком
function tweetmeme_com_mso_options() 
{
	# ключ, тип, ключи массива
	mso_admin_plugin_options('plugin_tweetmeme_com', 'plugins', 
		array(
			'align' => array(
						'type' => 'select', 
						'name' => 'Выравнивание блока', 
						'description' => 'Укажите выравнивание блока. Он добавляется в начало каждой записи.',
						'values' => 'left||Влево # right||Вправо # none||Нет',
						'default' => 'right'
					),
			'show_only_page' => array(
						'type' => 'select', 
						'name' => 'Отображение', 
						'description' => 'Выводить ли блок только на одиночной странице',
						'values' => '1||Отображать только на одиночной странице # 0||Везде',
						'default' => '0'
					),
			'page_type' => array(
						'type' => 'text', 
						'name' => 'Тип страниц', 
						'description' => 'Выводить блок только на указанных типах страниц (типы указывать через запятую).',
						'default' => 'blog, static'
					),
			'temp' => array(
							'type' => 'info',
							'title' => t('Настройки tweetmeme.com'),
							'text' => '<p>Они используются если вы выберите вариант отображения блока с помощью этого сервиса</p>'
						),
						
			'style' => array(
						'type' => 'text', 
						'name' => 'Стиль блока tweetmeme.com', 
						'description' => 'Укажите свой css-стиль блока tweetmeme.com.', 
						'default' => ''
					),
			'tweetmeme_style' => array(
						'type' => 'select', 
						'name' => 'Вид блока tweetmeme.com', 
						'description' => 'Можно использовать обычный и компактный',
						'values' => 'none||Обычный # compact||Компактный',
						'default' => 'none'
					),
					
			'temp2' => array(
							'type' => 'info',
							'title' => t('Настройки twitter.com'),
							'text' => '<p>Они используются если вы выберите вариант отображения блока с оригинального twitter.com</p>'
						),

			'twitter_orig' => array(
						'type' => 'checkbox', 
						'name' => 'Использовать блок twitter.com', 
						'description' => 'В этом случае настройки отображения tweetmeme.com игнорируются.',
						'default' => '0',
					),
			
			'twitter_data-count' => array(
						'type' => 'select', 
						'name' => 'Вид блока', 
						'description' => 'Расположение «Tweet» и статистики',
						'values' => 'vertical||Вертикальное расположение # horizontal||Горизонтальное расположение # none || Не отображать количество твиттов',
						'default' => 'vertical'
					),
					
			'twitter_data-via' => array(
						'type' => 'text',
						'name' => 'Добавлять в RT «via @ваш-логин»', 
						'description' => 'Укажите свой логин в Твиттере, который будет добавляться в текст ретрива.',
						'default' => ''
					),		
					
					
										
			),
		'Настройки плагина tweetmeme.com', // титул
		'Укажите необходимые опции.'   // инфо
	);
}

# функции плагина
function tweetmeme_com_content($text = '')
{
	global $page;
	
	if (!is_type('page') and !is_type('home')) return $text;
	
	// если запись не опубликована, не отображаем блок
	if (is_type('page') and isset($page['page_status']) and $page['page_status'] != 'publish') return $text;
	
	$options = mso_get_option('plugin_tweetmeme_com', 'plugins', array() ); // получаем опции
	
	// отображать только на одиночной странице
	if (!isset($options['show_only_page'])) $options['show_only_page'] = 0; 
	if ($options['show_only_page'] and !is_type('page')) return $text;
	
	if (is_type('page') and isset($options['page_type']) and $options['page_type'])
	{
		$p_type_name = mso_explode($options['page_type'], false);
		
		// нет у указанных типах страниц
		if (!in_array($page['page_type_name'], $p_type_name)) return $text;
	}
	
	// стиль выравнивания
	if (!isset($options['style'])) $options['style'] = '';
	if (!isset($options['align'])) $options['align'] = 'right';
	if ($options['style']) $style = ' style="' . $options['style'] . '"';
		else
		{
			if ($options['align'] == 'left') $style = ' style="float: left; margin-right: 10px;"';
			elseif ($options['align'] == 'right') $style = ' style="float: right; margin-left: 10px; width: "';
			else $style = '';
		}
	
	
	if (!isset($options['twitter_orig'])) $options['twitter_orig'] = false;
	
	// если использовать вывод с tweetmeme.com
	if (!$options['twitter_orig'])
	{
		if (!isset($options['tweetmeme_style'])) $options['tweetmeme_style'] = 'none';
		
		if (is_type('home')) 
			$js1 = 'tweetmeme_url = \'' . getinfo('site_url') . 'page/' . $page['page_slug'] . '\';';
		else 
			$js1 = 'tweetmeme_url = \'' . mso_current_url(true) . '\';';
		
		if ($options['tweetmeme_style'] == 'compact') 
			$js2 = 'tweetmeme_style = \'compact\';';
		else 
			$js2 = '';
			
		if ($js1 or $js2)
			$js = '<script type="text/javascript">' . $js1 . $js2 . '</script>';
		else
			$js = '';
		
		// $text = '<span style="display: none"><![CDATA[<noindex>]]></span><div class="tweetmeme_com"' . $style . '>' . $js . '<script type="text/javascript" src="' . getinfo('plugins_url'). 'tweetmeme_com/button.js"></script></div><span style="display: none"><![CDATA[</noindex>]]></span>' . $text;
		$text = '<div class="tweetmeme_com"' . $style . '>' . $js . '<script type="text/javascript" src="http://tweetmeme.com/i/scripts/button.js"></script></div>' . $text;
	
	}
	else 
	{
		// блок выводится с оригинального twitter.com
		
		if (is_type('home')) 
		{
			$url = getinfo('site_url') . 'page/' . $page['page_slug'];
		}
		else
		{
			$url = mso_current_url(true);
		}
		
		if (!isset($options['twitter_data-count'])) $options['twitter_data-count'] = 'vertical';
		$options['twitter_data-count'] = ' data-count="' . $options['twitter_data-count'] . '" ';
		
		if (!isset($options['twitter_data-via'])) $options['twitter_data-via'] = '';
		if ($options['twitter_data-via']) $options['twitter_data-via'] = ' data-via="' . $options['twitter_data-via'] . '" ';
		
		
		$text = '<div class="tweetmeme_com"' . $style . '>' 
		. '<a href="http://twitter.com/share" class="twitter-share-button" data-url="' . $url . '"' 
		. $options['twitter_data-count'] 
		. ' data-text="' . $page['page_title'] . '" '
		. $options['twitter_data-via']
		. '>Tweet</a>
		<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>' 
		. '</div>' . $text;
		
	}
	
	
	return $text;
}


# end file