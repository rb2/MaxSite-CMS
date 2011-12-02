<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

mso_cur_dir_lang('templates');

require_once( getinfo('common_dir') . 'comments.php' );


$res_post = mso_comuser_lost(); // обработка отправленных данных - возвращает результат


$comuser_info = mso_get_comuser(mso_segment(2)); // получим всю информацию о комюзере

if ($f = mso_page_foreach('users-form-lost-head-meta')) require($f);
else
{
	mso_head_meta('title', t('Восстановление пароля') . '. '.  getinfo('title')); // meta title страницы
}

if (!$comuser_info and mso_get_option('page_404_http_not_found', 'templates', 1) ) header('HTTP/1.0 404 Not Found'); 

// теперь сам вывод
# начальная часть шаблона
require(getinfo('template_dir') . 'main-start.php');

echo NR . '<div class="type type_users_form_lost">' . NR;

echo $res_post;
	
if ($comuser_info)
{
	extract($comuser_info[0]);
	
	if ($f = mso_page_foreach('users-form-lost')) require($f); // подключаем кастомный вывод
	else
	{
		if ($comusers_nik) echo '<h1>' . $comusers_nik . '</h1>';
			else echo '<h1>'. t('Комментатор'). ' ' . $comusers_id . '</h1>';
		
		echo '<p><a href="' . getinfo('siteurl') . 'users/' . $comusers_id . '">'. t('Персональная страница'). '</a></p>';
		
		// если актвация не завершена, то вначале требуем её завершить
		if ($comusers_activate_string != $comusers_activate_key) // нет активации
		{
			echo '<form method="post">' . mso_form_session('f_session_id');
			echo '<p><span style="color: red; font-weight: bold;" class="users-form">'. t('Введите ключ активации'). ':</span> 
				 <input type="text" style="width: 200px;" class="users-form" name="f_comusers_activate_key"> ';
			echo '<input type="submit" name="f_submit[' . $comusers_id . ']" value="'. t('Готово'). '"></p></form>';
			
			echo '<p>' . t('В случае проблем с активацией (не пришел ключ, указали ошибочный email), обращайтесь к администратору по email:') . ' <em>' . mso_get_option('admin_email', 'general', '-') . '</em></p>';
			
		}
		else // активация завершена - можно вывести поля для редактирования
		{
			echo '<form method="post" class="comusers-form">' . mso_form_session('f_session_id');
			echo '<p>'. t('Если у вас сохранился код активации, то вы можете сразу заполнить все поля. Если код активации утерян, то вначале введите только email и нажмите кнопку «Готово». На указанный email вы получите код активации. После этого вы можете вернуться на эту страницу и заполнить все поля.'). '</p>';
			echo '<p><strong>'. t('Ваш email'). ':</strong> <input type="text" name="f_comusers_email" value="">*</p>';
			echo '<p><strong>'. t('Ваш код активации'). ':</strong> <input type="text" name="f_comusers_activate_key" value=""></p>';
			echo '<p><strong>'. t('Новый пароль'). ':</strong> <input type="text" name="f_comusers_password" value=""></p>';
			echo '<input type="submit" name="f_submit[' . $comusers_id . ']" value="'. t('Готово'). '"></p></form>';
		}
		
	} // mso_page_foreach
}
else
{
	if ($f = mso_page_foreach('pages-not-found')) 
	{
		require($f); // подключаем кастомный вывод
	}
	else // стандартный вывод
	{
		echo '<h1>' . t('404. Ничего не найдено...') . '</h1>';
		echo '<p>' . t('Извините, ничего не найдено') . '</p>';
		echo mso_hook('page_404');
	}
}

echo NR . '</div><!-- class="type type_users_form_lost" -->' . NR;

# конечная часть шаблона
require(getinfo('template_dir') . 'main-end.php');
	
?>