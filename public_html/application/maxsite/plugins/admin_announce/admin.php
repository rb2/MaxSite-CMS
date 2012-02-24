<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

	mso_cur_dir_lang(__FILE__);
	$CI = & get_instance();
	$options_key = 'plugin_admin_announce';

	if ( $post = mso_check_post(array('f_session_id', 'f_submit')) )
	{
		mso_checkreferer();

		$options = array();
		$options['admin_announce']  = isset( $post['f_content'])         ? $post['f_content']    : '';
		$options['delta']           = isset( $post['f_delta'])           ? (int)$post['f_delta'] : 10;
		$options['admin_statistic'] = isset( $post['f_admin_statistic']) ? 1 : 0;
		$options['admin_showall']   = isset( $post['f_admin_showall'])   ? 1 : 0;
		$options['show_future']     = isset( $post['f_show_future'])     ? 1 : 0;
		$options['use_visual']      = isset( $post['f_use_visual'])      ? 1 : 0;

		mso_add_float_option($options_key, $options, 'plugins' );

		echo '<div class="update">' . t('Обновлено!') . '</div>';
	}

?>
<h1><?= t('Админ-анонс') ?></h1>
<p class="info"><?= t('Позволяет на стартовой странице админки размещать… что-то.') ?></p>

<?php

		$options = mso_get_float_option($options_key, 'plugins', array());
		if ( !isset($options['admin_announce']) )  $options['admin_announce']  = '';
		if ( !isset($options['admin_statistic']) ) $options['admin_statistic'] = true;
		if ( !isset($options['admin_showall']) )   $options['admin_showall']   = true;
		if ( !isset($options['show_future']) )     $options['show_future']     = true;
		if ( !isset($options['delta']) or ($options['delta'] == 0) ) $options['delta'] = 10;
		if ( !isset($options['use_visual']) )      $options['use_visual']      = false;


		$form  = '<h2>' . t('Настройки') . '</h2>';

		$chk   = $options['admin_statistic'] ? ' checked="checked"  ' : '';
		$form .= '<p><label><input name="f_admin_statistic" type="checkbox" ' . $chk . '> <strong>' . t('Показывать на стартовой странице админки статистику') . '</strong></label></p>';

		$chk   = $options['admin_showall'] ? ' checked="checked"  ' : '';
		$form .= '<p><label><input name="f_admin_showall" type="checkbox" ' . $chk . '> <strong>' . t('Показывать статистику всем') . '</strong></label><br>';
		$form .= t('Если не отмечено, то показывается только для тех, кому разрешено редактировать «Админ-анонс»'). '</p>';

		$chk   = $options['show_future'] ? ' checked="checked"  ' : '';
		$form .= '<p><label><input name="f_show_future" type="checkbox" ' . $chk . '> <strong>' . t('Учитывать страницы из будущего') . '</strong></label><br>';
		$form .= t('Если не отмечено, то статистика считается для страниц с датой раньше текущей'). '</p>';

		$chk   = $options['use_visual'] ? ' checked="checked"  ' : '';
		$form .= '<p><label><input name="f_use_visual" type="checkbox" ' . $chk . '> <strong>' . t('Использовать редактор системы') . '</strong></label><br>';
		$form .= t('Если отмечено, то используется визуальный редактор системы или подключенный плагин редактора. Иначе просто textarea и вывод не пропускается через балансировку тегов.'). '</p>';

		$form .= '<br><p><input name="f_delta" type="text" value="' . $options['delta'] . '"> <strong>' . t('Дельта подсчёта (приблизительность максимальных и минимальных страниц).') . '</strong><br>';
		$form .= t('Насколько близко по количеству просмотров к минимуму и максимуму должны быть страницы в отчёте.') . '</p>';

		$form .= '<br><h2>' . t('Текст на стартовой странице') . '</h2>';
		$form .= '<p>' . t('Введите текст (с html-оформлением), который должен быть на стартовой странице админки.') . '</p>';

		if ($options['use_visual'] == 1)
		{
			$ad_config = array(
						'action'  => '',
						'content' => htmlspecialchars($options['admin_announce']),
						'do'      => mso_form_session('f_session_id'). $form,
						'posle'   => '<br><input type="submit" name="f_submit" value="' . t('Сохранить изменения') . '" style="margin: 25px 0 5px 0;">',
						);
						
			if (mso_hook_present('editor_custom')) mso_hook('editor_custom', $ad_config);
				else editor_jw($ad_config);
		}
		else
		{
			$form .= '<textarea name="f_content" rows="7" style="width: 99%;">';
			$form .= htmlspecialchars($options['admin_announce']);
			$form .= '</textarea>';

			echo '<form action="" method="post">' . mso_form_session('f_session_id');
			echo $form;
			echo '<br><input type="submit" name="f_submit" value="' . t('Сохранить изменения') . '" style="margin: 25px 0 5px 0;">';
			echo '</form>';
		}

?>