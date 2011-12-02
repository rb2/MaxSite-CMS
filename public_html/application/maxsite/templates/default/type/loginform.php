<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

	mso_cur_dir_lang('templates');

	mso_remove_hook( 'body_start', 'demo_body_start');
	mso_remove_hook( 'body_end', 'demo_body_end');

	require(getinfo('template_dir') . 'main-start.php');
	
	echo NR . '<div class="type type_loginform">' . NR;
	
	echo '<div class="loginform">';
	
	if (!is_login())
	{
		
		$redirect_url = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : getinfo('siteurl');

		if (mso_segment(2) == 'error')
			echo '<p><strong style="color: red;" class="loginform">'. t('Неверный логин/пароль'). '</strong></p>';
		
		echo '<p class="header">'. t('Введите свой логин и пароль'). '</p>';
		
		mso_login_form(array( 
			'login'=>t('Логин'), 
			'password'=>t('Пароль'), 
			'submit'=>'', 
			'submit_value'=>t('Войти'), 
			'form_end'=>'<div class="form-end"><a href="' . getinfo('siteurl') . '">'. t('Вернуться к сайту'). '</a></div>'
			), 
			$redirect_url);
	}
	else
	{
		echo '<p>'. t('Привет'). ', ' . getinfo('users_nik') . '! [<a href="' . getinfo('siteurl') . 'logout'.'">'. t('выйти'). '</a>]</p>';
		// mso_redirect();
	}

	echo '</div>';
	
	echo NR . '</div><!-- class="type type_loginform" -->' . NR;

	require(getinfo('template_dir') . 'main-end.php');

?>