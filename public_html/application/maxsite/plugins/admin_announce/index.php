<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */


# функция автоподключения плагина
function admin_announce_autoload($args = array())
{
	mso_create_allow('admin_announce_edit', t('Админ-доступ к административному анонсу'));
	mso_hook_add( 'admin_init', 'admin_announce_admin_init'); # хук на админку
	mso_hook_add( 'admin_home', 'admin_announce'); # хук на админ-анонс
	mso_hook_add( 'admin_head', 'admin_announce_head');
}


# функция выполняется при деактивации (выкл) плагина
function admin_announce_uninstall($args = array())
{
	mso_delete_float_option('plugin_admin_announce', 'plugins' ); // удалим созданные опции
	mso_remove_allow('admin_announce_edit'); // удалим созданные разрешения
	return $args;
}


function admin_announce_head($args = array()) 
{
	echo NR . '<link rel="stylesheet" href="' . getinfo('plugins_url') . 'admin_announce/tabs.css" type="text/css" media="screen">' . NR;
	echo mso_load_jquery();
	echo mso_load_jquery('ui/ui.core.packed.js');
	echo mso_load_jquery('ui/ui.tabs.packed.js');

	echo mso_load_jquery('jquery.tablesorter.js');
	echo '
		<script type="text/javascript">
			$(function() {
				$("#tabs-widget > ul").tabs({ fx: { height: "toggle", opacity: "toggle", duration: "fast" } });
				$("table.tablesorter th").animate({opacity: 0.7});
				$("table.tablesorter th").hover(function(){ $(this).animate({opacity: 1}); }, function(){ $(this).animate({opacity: 0.7}); });
				$("#table-0").tablesorter();
				$("#table-1").tablesorter();
				$("#table-2").tablesorter();
				$("#table-3").tablesorter();
			});	
			</script>
	';

	return $args;
}


# функция выполняется при указаном хуке admin_init
function admin_announce_admin_init($args = array()) 
{
	if ( !mso_check_allow('admin_announce_admin_page') ) 
	{
		return $args;
	}

	$this_plugin_url = 'plugin_admin_announce'; // url и hook
	mso_admin_menu_add('plugins', $this_plugin_url, t('Админ-анонс'));
	mso_admin_url_hook ($this_plugin_url, 'admin_announce_admin_page');

	return $args;
}


# функция вызываемая при хуке, указанном в mso_admin_url_hook
function admin_announce_admin_page($args = array()) 
{
	# выносим админские функции отдельно в файл
	if ( !mso_check_allow('admin_announce_admin_page') ) 
	{
		echo t('Доступ запрещен');
		return $args;
	}

	mso_hook_add_dinamic( 'mso_admin_header', ' return $args . "' . t('Админ-анонс') . ' "; ' );
	mso_hook_add_dinamic( 'admin_title', ' return "' . t('Админ-анонс') . ' - " . $args; ' );

	require(getinfo('plugins_dir') . 'admin_announce/admin.php');
}


/**
* .*********************************************************************************************************************************************************
* .
* .	
*/
function admin_announce_stats($tabs = array(), $options = array())
{
$CI = & get_instance();

	$cache_key = 'admin_announce_pages';
	//if ( $k = mso_get_cache($cache_key) ) 
	//{
	//	$all_title = $k;
	//}
	//else
	//{
		$CI = & get_instance();
		$CI->db->select('page_id, page_title, page_date_publish, page_slug, page_view_count');

		$time_zone = getinfo('time_zone');
		if ($time_zone < 10 and $time_zone > 0) $time_zone = '0' . $time_zone;
		elseif ($time_zone > -10 and $time_zone < 0) 
		{ 
			$time_zone = '0' . $time_zone; 
			$time_zone = str_replace('0-', '-0', $time_zone); 
		}
		else $time_zone = '00.00';
		$time_zone = str_replace('.', ':', $time_zone);

		if (!$options['show_future']) $CI->db->where('page_date_publish < ', 'DATE_ADD(NOW(), INTERVAL "' . $time_zone . '" HOUR_MINUTE)', false);
		//$CI->db->where('page_date_publish <', date('Y-m-d H:i:s'));
		$CI->db->where('page_status', 'publish');
		$CI->db->from('page');
		$query = $CI->db->get();

		$all_title = $query->result_array();
	//	mso_add_cache($cache_key, $all_title);
	//}

	$summ = $count = $avgcount = 0;
	$maxcount = $mincount = $all_title[0]['page_view_count'];
	foreach ( $all_title as $page ) :
		$count++;
		$summ += $page['page_view_count'];
		if ($maxcount < $page['page_view_count']) $maxcount = $page['page_view_count'];
		if ($mincount > $page['page_view_count']) $mincount = $page['page_view_count'];
	endforeach;
	$avgcount = $summ/$count;

	global $MSO;
	$users_id = $MSO->data['session']['users_id'];
	$CI->db->select('users_id, users_login, users_nik, users_last_visit, users_avatar_url');
	$CI->db->from('users');
	$query = $CI->db->get();
	$all_users = $query->result_array();

	$CI->load->library('table');
	$tmpl = array (
			'table_open'		  => '<table class="page tablesorter" id="table-0">',
			'row_alt_start'		  => '<tr class="alt">',
			'cell_alt_start'	  => '<td class="alt">',
			'heading_row_start' 	=> NR . '<thead><tr>',
			'heading_row_end' 		=> '</tr></thead>' . NR,
			'heading_cell_start'	=> '<th style="cursor: pointer;">',
			'heading_cell_end'		=> '</th>',
				);
	$CI->table->set_template($tmpl);
	$CI->table->set_heading(t('Аватар'), t('ID', 'admin'), t('Логин', 'admin'), t('Ник', 'admin'), t('Время последнего визита'));
	//$out = NR;
	foreach ( $all_users as $user ) :
		$CI->table->add_row(
							(($user['users_avatar_url'])?('<img src="'.$user['users_avatar_url'].'" width="80" height="80">'):('')),
							$user['users_id'],
							$user['users_login'],
							$user['users_nik'],
							$user['users_last_visit']
							);
		if ($user['users_id'] == $users_id) $out = NR . '<div class="info">' . t('Ваш последний визит: ') . $user['users_last_visit'] . '</div>' . NR;
	endforeach;

//***********************************************************************
	$tabs[] = array(
					t('Статистика'),
					'<div class="info"><ul><li>' . t('Всего опубликованных страниц: ') . $count . '</li><li>' . t('Всего просмотров: ') . $summ .
					'</li><li>' . t('Дельта подсчёта: ') . $options['delta'] .
					'</li><li>' . t('Максимум просмотров страницы: ') . $maxcount. '</li><li>' . t('Минимум просмотров страницы: '). $mincount.
					'</li><li>' . t('В среднем: '). round($avgcount) . '</li></ul></div>' . NR . $out .
					$CI->table->generate()
					);
//-----------------------------------------------------------------------

	$CI->table->clear();
	$tmpl['table_open'] = '<table class="page tablesorter" id="table-1">';
	$CI->table->set_template($tmpl);
	$CI->table->set_heading(t('Заголовок'), t('Просмотров'), t('Дата публикации', 'admin'));

	foreach ( $all_title as $page ) :
		if ( $page['page_view_count'] > ($maxcount - $options['delta']) )
		$CI->table->add_row(
							'<a href="' . getinfo('site_url') . 'page/' . $page['page_slug'] . '" target="_blank">' . $page['page_title'] . '</a><br>' . '(<a href="' . getinfo('site_admin_url'). 'page_edit/' . $page['page_id']. '">' . t('редактировать'). '</a>)',
							$page['page_view_count'],
							$page['page_date_publish']
							);
	endforeach;

//***********************************************************************
	$tabs[] = array(
					t('Популярные страницы'),
					$CI->table->generate()
					);
//-----------------------------------------------------------------------

	$CI->table->clear();
	$tmpl['table_open'] = '<table class="page tablesorter" id="table-2">';
	$CI->table->set_template($tmpl);
	$CI->table->set_heading(t('Заголовок'), t('Просмотров'), t('Дата публикации', 'admin'));

	foreach ( $all_title as $page ) :
		if ( ($page['page_view_count'] < ($avgcount + $options['delta'])) and ($page['page_view_count'] > ($avgcount - $options['delta'])) )
		$CI->table->add_row(
							'<a href="' . getinfo('site_url') . 'page/' . $page['page_slug'] . '" target="_blank">' . $page['page_title'] . '</a><br>' . '(<a href="' . getinfo('site_admin_url'). 'page_edit/' . $page['page_id']. '">' . t('редактировать'). '</a>)',
							$page['page_view_count'],
							$page['page_date_publish']
							);
	endforeach;

//***********************************************************************
	$tabs[] = array(
					t('Средние'),
					$CI->table->generate()
					);
//-----------------------------------------------------------------------

	$CI->table->clear();
	$tmpl['table_open'] = '<table class="page tablesorter" id="table-3">';
	$CI->table->set_template($tmpl);
	$CI->table->set_heading(t('Заголовок'), t('Просмотров'), t('Дата публикации', 'admin'));

	foreach ( $all_title as $page ) :
		if ( $page['page_view_count'] < ($mincount + $options['delta']) )
		$CI->table->add_row(
							'<a href="' . getinfo('site_url') . 'page/' . $page['page_slug'] . '" target="_blank">' . $page['page_title'] . '</a><br>' . '(<a href="' . getinfo('site_admin_url'). 'page_edit/' . $page['page_id']. '">' . t('редактировать'). '</a>)',
							$page['page_view_count'],
							$page['page_date_publish']
							);
	endforeach;

//***********************************************************************
	$tabs[] = array(
					t('Непопулярные страницы'),
					$CI->table->generate()
					);
//-----------------------------------------------------------------------

	return $tabs;
}


/**
* .*********************************************************************************************************************************************************
* .
* .	
*/
function admin_announce($args = array())
{
	$options_key = 'plugin_admin_announce';
	$options = mso_get_float_option($options_key, 'plugins', array());
	if ( !isset($options['admin_announce']) )  $options['admin_announce']  = '';
	if ( !isset($options['admin_statistic']) ) $options['admin_statistic'] = true; // По умолчанию показываем статистику.
	if ( !isset($options['admin_showall']) )   $options['admin_showall']   = true; // По умолчанию показываем статистику всем.
	if ( !isset($options['delta'])
			or ($options['delta'] == 0) )      $options['delta']           = 10;
	if ( !isset($options['use_visual']) )      $options['use_visual']      = false;
	if ( !isset($options['show_future']) )     $options['show_future']     = true;


//***********************************************************************
	$tabs = array();
	if (trim($options['admin_announce']) <> '')
	{
		if ($options['use_visual'] == 1) $tabs[] = array( t('Админ-анонс'), NR. '<div class="info">'. mso_hook('content', $options['admin_announce']). '</div>'. NR );
			else $tabs[] = array( t('Админ-анонс'),  NR. '<div class="info">'. $options['admin_announce']. '</div>'. NR );
	}
//-----------------------------------------------------------------------
	if ( $options['admin_statistic'] and ($options['admin_showall'] or mso_check_allow('admin_announce_admin_page')) )
		$tabs = admin_announce_stats($tabs, $options);

	$tabs = mso_hook('admin_announce', $tabs);

	if ($tabs) // есть закладки, можно выводить
	{
		$out = NR . '<div id="tabs-widget" class="tabs-widget-all"><ul class="tabs-menu" id="tabs-menu">' . NR;
		foreach($tabs as $key => $tab)
			$out .= '<li><a href="#tabs-widget-fragment-' . $key . '"><span>' . $tab[0] . '</span></a></li>' . NR;
		$out .= '</ul>' . NR;
		foreach($tabs as $key => $tab)
			$out .= NR . '<div id="tabs-widget-fragment-' . $key . '" class="tabs-widget-fragment">' . $tab[1] . '</div>' . NR;
		$out .= '</div>' . NR;
	}

	echo $out;
	return $args;
}


?>