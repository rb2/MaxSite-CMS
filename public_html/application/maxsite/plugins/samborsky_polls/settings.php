<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

$CI = &get_instance();

if ($post = mso_check_post(array('f_session_id', 'f_submit')))
{
	$options = $_POST['plugin_samborsky_polls-plugins'];

	foreach($options['_mso_checkboxs'] as $key => $val)
	{
		if(!isset($options[$key]))
			$options[$key] = 0;
	}
	unset($options['_mso_checkboxs']);
	
	// Подготавливаем к записи в бд
	$options['archive_url'] = preg_replace("/[^\w-]/",'',$options['archive_url']);
	$options['admin_number_records'] = (int)$options['admin_number_records'];
	$options['show_archives_link'] = (int)$options['show_archives_link'];
	
	mso_add_option('plugin_samborsky_polls',  $options, 'plugins');
}

$default = array(
		'archive_url' => 'polls-archive',
		'show_archives_link' => 1,
		'show_results_link' => 1,
		'close_after_hour' => 0,
		'admin_number_records' => 10,
		'len_polls' => t('1 неделя','plugins'),
		'secur_polls' => t('Защита по Coookie','plugins')
);

// Экспорт настроек из прошлых версий плагина.
$query = $CI->db->get_where('options',array('options_key'=>'plugin_samborsky_polls','options_type'=>'plugins'),1);
if(!$query->num_rows())
{
	$CI->db->where('options_key', 'sp_archive_url');
	$CI->db->or_where('options_key', 'show_archives_link');
	$CI->db->or_where('options_key', 'show_results_link');
	$CI->db->or_where('options_key', 'polls_admin_len_polls');
	$CI->db->or_where('options_key', 'polls_admin_number_records');
	$CI->db->or_where('options_key', 'polls_admin_secur_polls');
	$CI->db->or_where('options_key', 'polls_close_after_hour');
	$CI->db->select('options_key, options_value, options_type');
	$query = $CI->db->get('options');
	foreach($query->result() as $row)
	{
		if($row->options_type == 'plugins')
		{
			switch ($row->options_key)
			{
				case 'sp_archive_url' : $default['archive_url'] = $row->options_value; break;
				case 'show_archives_link' : $default['show_archives_link'] = $row->options_value; break;
				case 'show_results_link' : $default['show_results_link'] = $row->options_value; break;
				case 'polls_admin_len_polls' : $default['len_polls'] = $row->options_value; break;
				case 'polls_admin_number_records' : $default['admin_number_records'] = $row->options_value; break;
				case 'polls_admin_secur_polls' : $default['secur_polls'] = $row->options_value; break;
				case 'polls_close_after_hour' : $default['close_after_hour'] = $row->options_value; break;
			}
		}
	}
}

// Вывод настроек
mso_admin_plugin_options('plugin_samborsky_polls', 'plugins',
	array(
		'archive_url' => Array
		(
			'name' => t('Ссылка на архив голосований','plugins'),
			'type' => 'text',
			'description' => t('Например «polls-archive»','plugins'),
			'default' => $default['archive_url']
		),

		'show_archives_link' => Array
		(
			'name' => t('Показывать ссылку на архив голосований','plugins'),
			'type' => 'checkbox',
			'description' => t('Поставьте отметку если надо показывать ссылку на архив голосований','plugins'),
			'default' => $default['show_archives_link']
		),

		'show_results_link' => Array
		(
			'name' => t('Показывать ссылку на результаты голосования','plugins'),
			'type' => 'checkbox',
			'description' => t('Поставьте отметку если надо показывать ссылку на результаты голосования','plugins'),
			'default' => $default['show_results_link']
		),

		'close_after_hour' => Array
		(
			'name' => t('Закрыть голосование через ... часов после окончания срока','plugins'),
			'type' => 'text',
			'description' => t('Введите число (можно отрицательное)','plugins'),
			'default' => $default['close_after_hour']
		),

		'admin_number_records' => Array
		(
			'name' => t('Количество голосований на странице управления голосованиями','plugins'),
			'type' => 'text',
			'description' => t('Введите число (0 - все)','plugins'),
			'default' => $default['admin_number_records']
		),

		'len_polls' => Array
		(
			'name' => t('Длительность голосования по-умолчанию','plugins'),
			'type' => 'select',
			'description' => t('Выберете длительность голосования по-умолчанию','plugins'),
			'values' => t('1 день','plugins').' # '.t('1 неделя','plugins').' # '.t('2 недели','plugins').' # '.t('1 месяц','plugins').' # '.t('3 месяца','plugins').' # '.t('6 месяцев','plugins').' # '.t('Год','plugins').' # '.t('Бессрочное','plugins'),
			'default' => $default['len_polls']
		),

		'secur_polls' => Array
		(
			'name' => t('Защита от накрутки по-умолчанию','plugins'),
			'type' => 'select',
			'description' => t('Выберете защиту от накрутки по-умолчанию','plugins'),
			'values' => t('Только для зарегистрированых (users)','plugins').' # '.t('Защита по Coookie','plugins').' # '.t('Без защиты, один пользователь может голосовать много раз','plugins'),
			'default' => $default['secur_polls']
		)
	),

	t('Настройки плагина "Голосования"','plugins'),
	t('Укажите необходимые опции.','plugins'),
	''
);

?>
