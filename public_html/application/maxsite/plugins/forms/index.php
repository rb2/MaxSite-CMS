<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 * Дополнения: Н. Громов (http://nicothin.ru/)
 */

# функция автоподключения плагина
function forms_autoload($args = array())
{
	mso_hook_add( 'content', 'forms_content'); # хук на вывод контента
}

# 
function forms_content_callback($matches) 
{
	$text = $matches[1];
	
	$text = str_replace("\r", "", $text);
	
	$text = str_replace('&nbsp;', ' ', $text);
	$text = str_replace("\t", ' ', $text);
	$text = str_replace('<br />', "<br>", $text);
	$text = str_replace('<br>', "\n", $text);
	$text = str_replace("\n\n", "\n", $text);
	$text = str_replace('     ', ' ', $text);
	$text = str_replace('    ', ' ', $text);
	$text = str_replace('   ', ' ', $text);
	$text = str_replace('  ', ' ', $text);
	$text = str_replace("\n ", "\n", $text);
	$text = str_replace("\n\n", "\n", $text);
	$text = trim($text);
	
	
	$out = ''; // убиваем исходный текст формы
	
	// занесем в массив все поля
	$r = preg_match_all('!\[email=(.*?)\]|\[redirect=(.*?)\]\[subject=(.*?)\]|\[field\](.*?)\[\/field\]|\[ushka=(.*?)\]!is', $text, $all);
	
	//pr($all);

	$f = array(); // массив для полей
	if ($r)
	{
		$email = trim(implode(' ', $all[1]));
		$redirect = trim(implode(' ', $all[2]));
		$subject = trim(implode(' ', $all[3]));
		
		$ushka = trim(implode(' ', $all[5]));
		
		$fields = $all[4];
		
		
		$i = 0;

		foreach ($fields as $val)
		{
			$val = trim($val);
			
			if (!$val) continue;
			
			$val = str_replace(' = ', '=', $val);
			$val = str_replace('= ', '=', $val);
			$val = str_replace(' =', '=', $val);
			$val = explode("\n", $val); // разделим на строки
			$ar_val = array();
			foreach ($val as $pole)
			{
				$pole = preg_replace('!=!', '_VAL_', $pole, 1);
				
				$ar_val = explode('_VAL_', $pole); // строки разделены = type = select
				if ( isset($ar_val[0]) and isset($ar_val[1]))
					$f[$i][$ar_val[0]] = $ar_val[1];
			}
			
			
			$i++;
		}
		
		if (!$f) return ''; // нет полей - выходим
		
		// теперь по-идее у нас есть вся необходимая информация по полям и по форме
		// смотрим есть ли POST. Если есть, то проверяем введенные поля и если они корректные, 
		// то выполняем отправку почты, выводим сообщение и редиректимся
		
		// если POST нет, то выводим обычную форму
		// pr($f);
		
		if ( $post = mso_check_post(array('forms_session', 'forms_antispam1', 'forms_antispam2', 'forms_antispam',
					'forms_name', 'forms_email',  'forms_submit' )) )
		{
			mso_checkreferer();
			
			$out .= '<div class="forms-post">';
			// вырный email?
			if (!$ok = mso_valid_email($post['forms_email']))
			{
				$out .= '<h2>' . t('Неверный email!') . '</h2>';
			}
			
			// антиспам 
			if ($ok)
			{
				$antispam1s = (int) $post['forms_antispam1'];
				$antispam2s = (int) $post['forms_antispam2'];
				$antispam3s = (int) $post['forms_antispam'];
				
				if ( ($antispam1s/984 + $antispam2s/765) != $antispam3s )
				{ // неверный код
					$ok = false;
					$out .= '<h2>' . t('Привет роботам! :-)') . '</h2>';
				}
			}
			
			if ($ok) // проверим обязательные поля
			{
				foreach ($f as $key=>$val)
				{
					if ( $ok and isset($val['require']) and $val['require'] == 1 ) // поле отмечено как обязательное
					{
						if (!isset($post['forms_fields'][$key]) or !$post['forms_fields'][$key]) 
						{
							$ok = false;
							$out .= '<h2>' . t('Заполните все необходимые поля!') . '</h2>';
						}
					}
					if (!$ok) break;
				}
			}
			
			// всё ок
			if ($ok)
			{
				// pr($post);
				// pr($f);
				// pr($redirect);
				// pr($email);
				// pr($subject);
				
				// формируем письмо и отправляем его
				
				if (!mso_valid_email($email)) mso_get_option('admin_email', 'general', 'admin@site.com'); // куда приходят письма
				
				$message = 'Имя: ' . $post['forms_name'] . "\n";
				$message .= 'Email: ' . $post['forms_email'] . "\n";
				
				foreach ($post['forms_fields'] as $key=>$val)
				{
					$message .= $f[$key]['description'] . ': ' . $val . "\n";
				}
				
				if ($_SERVER['REMOTE_ADDR'] and $_SERVER['HTTP_REFERER'] and $_SERVER['HTTP_USER_AGENT']) 
				{
					$message .= "\n" . 'IP-адрес: ' . $_SERVER['REMOTE_ADDR'] . "\n";
					$message .= 'Отправлено со страницы: ' . $_SERVER['HTTP_REFERER'] . "\n";
					$message .= 'Браузер: ' . $_SERVER['HTTP_USER_AGENT'] . "\n";
				}
				
				// pr($message);
				
				$form_hide = mso_mail($email, $subject, $message, $post['forms_email']);
				
				if ( isset($post['forms_subscribe']) ) 
					mso_mail($post['forms_email'], t('Вами отправлено сообщение:') . ' ' . $subject, $message);
				
				
				$out .= '<h2>' . t('Ваше сообщение отправлено!') . '</h2><p>' 
						. str_replace("\n", '<br>', htmlspecialchars($subject. "\n" . $message)) 
						. '</p>';
				
				if ($redirect) mso_redirect($redirect, true);

			}
			else // какая-то ошибка, опять отображаем форму
			{
				$out .= forms_show_form($f, $ushka);
			}
			
			
			$out .= '</div>';
			
			$out .= mso_load_jquery('jquery.scrollto.js');
			$out .= '<script>$(document).ready(function(){$.scrollTo("div.forms-post", 500);})</script>';

		}
		else // нет post
		{
			$out .= forms_show_form($f, $ushka);
		}
	}

	return $out;
}

function forms_show_form($f = array(), $ushka = '')
{
	$out = '';

	$antispam1 = rand(1, 10);
	$antispam2 = rand(1, 10);
	
	$out .= '<div class="forms"><form method="post">' . mso_form_session('forms_session');
	
	$out .= '<input type="hidden" name="forms_antispam1" value="' . $antispam1 * 984 . '">';
	$out .= '<input type="hidden" name="forms_antispam2" value="' . $antispam2 * 765 . '">';
	
	// обязательные поля
	$out .= '<div><label><span>' . t('Ваше имя*') . '</span><input name="forms_name" type="text" value=""></label></div><div class="break"></div>';
	
	$out .= '<div><label><span>' . t('Ваш email*') . '</span><input name="forms_email" type="text" value=""></label></div><div class="break"></div>';
	
	
	// тут указанные поля в $f
	// pr($f);
	foreach ($f as $key=>$val)
	{
		if (!isset($val['description'])) continue;
		if (!isset($val['type'])) continue;
		
		$val['type'] = trim($val['type']);
		$val['description'] = trim($val['description']);
		
		if (isset($val['require']) and  trim($val['require']) == 1) $require = '*';
			else $require = '';
		
		if (isset($val['attr']) and  trim($val['attr'])) $attr = ' ' . trim($val['attr']);
			else $attr = '';
		
		if (isset($val['value']) and  trim($val['value'])) $pole_value = htmlspecialchars(trim($val['value']));
			else $pole_value = '';
			
		$description = trim($val['description']);
		
		if (isset($val['tip']) and trim($val['tip']) ) $tip = '<div class="tip">'. trim($val['tip']) . '</div>';
			else $tip = '';
			
		if ($val['type'] == 'text') #####
		{
			$out .= '<div><label><span>' . $description . $require . '</span><input name="forms_fields[' . $key . ']" type="text" value="' . $pole_value . '"' . $attr . '></label>' . $tip . '</div><div class="break"></div>';
		}
		elseif ($val['type'] == 'select') #####
		{
			if (!isset($val['default'])) continue;
			if (!isset($val['values'])) continue;
			
			$out .= '<div><label><span>' . $description . $require . '</span><select name="forms_fields[' . $key . ']"' . $attr . '>';
			
			$default = trim($val['default']);
			$values = explode('#', $val['values']);
			foreach ($values as $value)
			{
				$value = trim($value);
				if ($value == $default) $checked = ' selected="selected"';
					else $checked = '';
				
				$out .= '<option' . $checked . '>' . $value . '</option>';
			}
			
			$out .= '</select></label>' . $tip . '</div><div class="break"></div>';
	
		}
		elseif ($val['type'] == 'textarea') #####
		{
			$out .= '<div><label><span>' . $description . $require . '</span><textarea name="forms_fields[' . $key . ']"' . $attr . '>' . $pole_value . '</textarea></label>' . $tip . '</div><div class="break"></div>';
		
		}
	}
	
	// обязательные поля антиспама и отправка и ресет
	$out .= '<div><label><span>' . t('Защита от спама:') . ' ' . $antispam1 . ' + ' . $antispam2 . '=</span>';
	$out .= '<input name="forms_antispam" type="text" value=""></label></div><div class="break"></div>';

	$out .= '<div><span>&nbsp;</span><label><input name="forms_subscribe" value="" type="checkbox"  class="forms_checkbox">&nbsp;' . t('Отправить копию письма на ваш e-mail') . '</label></div><div class="break"></div>';
	
	$out .= '<div><span>&nbsp;</span><input name="forms_submit" type="submit" class="forms_submit" value="' . t('Отправить') . '">';
	$out .= '<input name="forms_clear" type="reset" class="forms_reset" value="' . t('Очистить форму') . '"></div>';
	
	if (function_exists('ushka')) $out .= ushka($ushka);
	
	$out .= '</form></div>';
	
	return $out;
}

# функции плагина
function forms_content($text = '')
{
	if (strpos($text, '[form]') !== false) $text = preg_replace_callback('!\[form\](.*?)\[/form\]!is', 'forms_content_callback', $text );
	return $text;
}

# end file