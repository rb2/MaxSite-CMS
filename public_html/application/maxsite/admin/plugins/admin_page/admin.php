<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
	
	mso_cur_dir_lang('admin');
	
	$CI = & get_instance();
	
	require_once( getinfo('common_dir') . 'page.php' ); 			// функции страниц 
	
	if ( $post = mso_check_post(array('f_session_id', 'f_submit', 'f_page_delete')) )
	{
		mso_checkreferer();
		
		// pr($post);
		
		$page_id = (int) $post['f_page_delete'];
		if (!is_numeric($page_id)) $page_id = false; // не число
			else $page_id = (int) $page_id;

		if (!$page_id) // ошибка! 
		{
			echo '<div class="error">' . t('Ошибка удаления', 'admin') . '</div>';
		}
		else 
		{
			$data = array(
				'user_login' => $MSO->data['session']['users_login'],
				'password' => $MSO->data['session']['users_password'],
				'page_id' => $page_id,
			);
			
			require_once( getinfo('common_dir') . 'functions-edit.php' ); // функции редактирования
			
			$result = mso_delete_page($data);
			
			if (isset($result['result']) and $result['result'])
			{
				if ( $result['result'] ) 
				{
					# mso_flush_cache(); // сбросим кэш перенес в mso_delete_page
					echo '<div class="update">' . t('Страница удалена', 'admin') . '</div>';
				}
				else
				{
					echo '<div class="error">' . t('Ошибка при удалении', 'admin') . ' ('. $result['description'] . ')</div>';
				}
			}
			else
			{
				echo '<div class="error">' . t('Ошибка при удалении', 'admin') . ' ('. $result['description'] . ')</div>';
			}
			
			/*
			$CI->db->select('page_id');
			$CI->db->where(array('page_id'=>$page_id));
			$query = $CI->db->get('page');
			if ($query->num_rows() == 0) // нет такого
			{
				echo '<div class="error">Ошибочный номер страницы</div>';
			}
			else 
			{	// теперь можно удалять
				// при удалении страницы нужно сразу удалить её, рубрики и мета
				// потом будут еще и комментарии
				
				$CI->db->where( array('page_id'=>$page_id) );
				$CI->db->delete('cat2obj');
				
				$CI->db->where( array ('meta_id_obj' => $page_id, 'meta_table' => 'page') );
				$CI->db->delete('meta');
				
				$CI->db->where( array('page_id'=>$page_id) ); 
				$CI->db->delete('page');
				
				echo '<div class="update">Страница удалена</div>';
			}
			*/
		}
	}
	

?>
<h1><?= t('Страницы') ?></h1>
<p class="info"><?= t('Список всех страниц') ?></p>

<?php

	$CI->load->library('table');
	$CI->load->helper('form');
	
	$tmpl = array (
				'table_open'		  => '<table class="page tablesorter" border="0" id="pagetable">',
				'row_alt_start'		  => '<tr class="alt">',
				'cell_alt_start'	  => '<td class="alt">',
				'heading_row_start' 	=> NR . '<thead><tr>',
				'heading_row_end' 		=> '</tr></thead>' . NR,
				'heading_cell_start'	=> '<th style="cursor: pointer;">',
				'heading_cell_end'		=> '</th>',
		  );
		  
	$CI->table->set_template($tmpl); // шаблон таблицы

	$CI->table->set_heading('ID', t('Заголовок', 'admin'), t('Дата', 'admin'), t('Тип', 'admin'), t('Статус', 'admin'), t('Автор', 'admin'));
	
	
	if ( !mso_check_allow('admin_page_edit_other') )
	{
		# echo 'запрещено редактировать чужие страницы';
		$current_users_id = getinfo('session');
		$current_users_id = $current_users_id['users_id'];
	}
	else $current_users_id = false;
	
	
	$par = array( 
			'limit' => 50, // колво записей на страницу
			'type' => false, // любой тип страниц
			'custom_type' => 'home', // запрос как в home
			'order' => 'page_date_publish', // запрос как в home
			'order_asc' => 'desc', // в обратном порядке
			'page_status' => false, // статус любой
			'date_now' => false, // любая дата
			'content'=> false, // без содержания
			'page_id_autor'=> $current_users_id, // только указанного автора
			);
	
	$CI->db->select('category_id, category_name');
	$CI->db->order_by('category_name');
	$CI->db->where('category_type', 'page');
	
	$query = $CI->db->get('category');

	if ($query and $query->num_rows() > 0) 
	{
		//echo '<h1>Страницы по рубрикам</h1>';
		$cat_segment_id = 0;
		
		if (mso_segment(3) == 'category') $cat_segment_id = (int) mso_segment(4);
		
		echo '<p><strong>'
				. t('Фильтр по рубрикам', 'admin') 
				. ':</strong> <a href="' . getinfo('site_admin_url') . 'page">'
				. t('Без фильтра', 'admin') . '</a> ';
		
		require_once( getinfo('common_dir') . 'category.php' ); // функции рубрик
		$all_cats = mso_cat_array_single('page', 'category_id', 'ASC', ''); // все рубрики для вывода кол-ва записей
		# pr($all_cats);

		foreach ($query->result_array() as $nav) 
		{
			if ($cat_segment_id != $nav['category_id']) 
			{
				echo '| <a href="' . getinfo('site_admin_url'). 'page/category/' . $nav['category_id'] .'">'
					. $nav['category_name'] 
					. ' ('.  count($all_cats[$nav['category_id']]['pages']) . ')</a> ';
			} 
			else 
			{
				echo '| <a href="' . getinfo('site_admin_url') . 'page/category/' . $nav['category_id'] . '"><strong>' . $nav['category_name'] . ' ('.  count($all_cats[$nav['category_id']]['pages']) . ')</strong></a> ';
			}
		}
		echo '</p>';
	}

	$CI->db->select('page_type_id, page_type_name');
	$CI->db->order_by('page_type_name');
	
	$query = $CI->db->get('page_type');
	
	if ($query->num_rows() > 0) 
	{
		//echo '<h1>Страницы по типам</h1>';
		$type_segment_id = 0;
		if (mso_segment(3) == 'type') 
		{
			$type_segment_id = (int) mso_segment(4); 
			$type_segment_name = '';
		}
		echo '<p><strong>'
				. t('Фильтр по типам', 'admin')
				. ':</strong> <a href="' . getinfo('site_admin_url') . 'page">'
				. t('Без фильтра', 'admin') . '</a> ';
		
		foreach ($query->result_array() as $nav) 
		{
			if ($type_segment_id != $nav['page_type_id']) 
			{
				echo '| <a href="' . getinfo('site_admin_url') . 'page/type/' . $nav['page_type_id'] . '">' . $nav['page_type_name']. '</a> ';
			}
			else 
			{
				$type_segment_name = $nav['page_type_name'];
				echo '| <a href="' . getinfo('site_admin_url') . 'page/type/' . $nav['page_type_id'] . '"><strong>' . $nav['page_type_name'] . '</strong></a> ';
		 }
		}
		echo '</p>';
	}
	
	echo '<p><strong>'
				. t('Фильтр по статусу', 'admin')
				. ':</strong> <a href="' . getinfo('site_admin_url') . 'page">'
				. t('Без фильтра', 'admin') . '</a> ';
	
	$all_status = array('publish', 'draft', 'private');
	foreach($all_status as $status)
	{
		if (mso_segment(4) == $status)
			echo '| <a href="' . getinfo('site_admin_url') . 'page/status/' . $status . '"><strong>' . $status . '</strong></a> ';
		else
			echo '| <a href="' . getinfo('site_admin_url') . 'page/status/' . $status . '">' . $status . '</a> ';
	}
	echo '</p>';	
				

	if (mso_segment(3) == 'category') 
	{
		if (mso_segment(4) != '') 
		{
			$par['cat_id'] = abs(intval(mso_segment(4)));
		}
	}
	elseif (mso_segment(3) == 'type') 
	{
		if (mso_segment(4) != '') 
		{
			$par['type'] = $type_segment_name;
		}
	}
	elseif (mso_segment(3) == 'status') 
	{
		if (in_array(mso_segment(4), $all_status)) 
		{
			$par['page_status'] = mso_segment(4);
		}
	}
	
	
	$pages = mso_get_pages($par, $pagination); // получим все - второй параметр нужен для сформированной пагинации
	
	$all_pages = array(); // сразу список всех страниц для формы удаления
	
	$this_url = getinfo('site_admin_url') . 'page_edit/';
	$view_url = getinfo('siteurl') . 'page/';
	$view_url_cat = getinfo('siteurl') . 'category/';
	$view_url_tag = getinfo('siteurl') . 'tag/';
		
	if ($pages) // есть страницы
	{ 	
		foreach ($pages as $page) // выводим в цикле
		{
			// pr($page);
			// $act = '<a href="' . $this_url . $page['page_id'] . '">Изменить</a>';
			
			$page['page_title'] = htmlspecialchars($page['page_title']);
			
			if (!$page['page_title']) $page['page_title'] = 'no-title';
			
			$all_pages[$page['page_id']] = $page['page_id'] . ' - ' . $page['page_title']
				. ' - ' . $page['page_date_publish'] . ' - ' . $page['page_status'];
			
			$cats = '';
			$tags = '';
			
			foreach ($page['page_categories_detail'] as $key => $val)
			{
				$cats .= '<a href="' . $view_url_cat . $page['page_categories_detail'][$key]['category_slug'] . '">'
					. $page['page_categories_detail'][$key]['category_name'] . '</a>  ';
			}
			
			$cats = str_replace('  ', ', ', trim($cats));
			
			foreach ($page['page_tags'] as $val)
			{
				$tags .= '<a href="' . $view_url_tag . $val . '">' . $val . '</a>  ';
			}			
			$tags = str_replace('  ', ', ', trim($tags));
			
			$title = '<a class="title" href="' . $this_url . $page['page_id'] . '">' . $page['page_title'] . '</a>'
					. ' [<a href="' . $view_url . $page['page_slug'] . '" target="_blank">' . t('Просмотр', 'admin') . '</a>]';
			
			
			
			if ($cats) $title .= '<br>' . t('Рубрика:', 'admin') . ' ' . $cats;
			if ($tags) $title .= '<br>' . t('Метки:', 'admin') . ' ' . $tags;
			
			// $date_p = '<span title="Дата и время сохранения записи">' . $page['page_date_publish'] . '</span>'; // это время публикации как установлено на сервере
			
			$date_p = '<span title="' . t('Дата отображения на блоге с учетом временной поправки', 'admin') . '">' . mso_date_convert('Y-m-d H:i:s', $page['page_date_publish']) . '</span>';
			
			$CI->table->add_row($page['page_id'], $title, $date_p, 
					$page['page_type_name'], $page['page_status'], $page['users_nik']);
		}
	}
	

	$pagination['type'] = '';
	$pagination['range'] = 10;
	mso_hook('pagination', $pagination);
	//echo  '<br>';
	
	
	echo mso_load_jquery('jquery.tablesorter.js');
	echo '
	<script type="text/javascript">
	$(function() {
		$("table.tablesorter th").animate({opacity: 0.7});
		$("table.tablesorter th").hover(function(){ $(this).animate({opacity: 1}); }, function(){ $(this).animate({opacity: 0.7}); });
		$("#pagetable").tablesorter();
	});	
	</script>
	';
	

	echo $CI->table->generate(); // вывод подготовленной таблицы

	// добавляем форму для удаления записи
	$all_pages = form_dropdown('f_page_delete', $all_pages, -1, '');
	

	$pagination['type'] = '';
	$pagination['range'] = 10;
	//echo '<br>';
	mso_hook('pagination', $pagination);

	
	echo '<form action="" method="post">' . mso_form_session('f_session_id');
	echo '<h2 class="br">' . t('Удалить страницу', 'admin') . '</h2><p>';
	echo $all_pages;
	echo ' <input type="submit" name="f_submit" value="' . t('Удалить', 'admin') . '" onClick="if(confirm(\'' . t('Удалить страницу?', 'admin') . '\')) {return true;} else {return false;}" ></p>';
	echo '</form>';
	
	
?>