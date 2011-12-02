<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once( getinfo('common_dir') . 'inifile.php' ); // функции для работы с ini-файлом

if ($post = mso_check_post(array('f_session_id', 'f_submit')))
{
	
	$_POST['f_options']['polls_admin_number_records_m_s_o_plugins'] = (int)$_POST['f_options']['polls_admin_number_records_m_s_o_plugins'];
	$_POST['f_options']['sp_archive_url_m_s_o_plugins'] = preg_replace("/[^\w-]/",'',$_POST['f_options']['sp_archive_url_m_s_o_plugins']);
	$_POST['f_options']['polls_close_after_hour_m_s_o_plugins'] = (int)$_POST['f_options']['polls_close_after_hour_m_s_o_plugins'];
	mso_check_post_ini();
	
	echo '<div class="update">' . t('Настройки сохранены!') . '</div>';
}

$all = mso_get_ini_file(getinfo('plugins_dir') .'samborsky_polls/settings.ini');
	echo mso_view_ini($all);

?>
