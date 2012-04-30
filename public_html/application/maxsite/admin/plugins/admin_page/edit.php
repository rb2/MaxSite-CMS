<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<h1><?= t('Редактирование страницы') ?></h1>
<p class="ret-to-pages"><a href="<?= $MSO->config['site_admin_url'] . 'page' ?>"><?= t('Cписок записей') ?></a>

<?php
	
	$id = mso_segment(3); // номер страницы по сегменту url
	
	// проверим, чтобы это было число
	if (!is_numeric($id)) $id = false; // не число
		else $id = (int) $id;
	
	if ($id) // есть корректный сегмент
	{
		$CI = & get_instance();
		
		# проверим текущего юзера и его разрешение на правку чужих страниц
		# если admin_page_edit=1, то есть разрешено редактировать в принципе (уже проверили раньше!),
		# то смотрим admin_page_edit_other. Если стоит 1, то все разрешено
		# если false, значит смотрим автора страницы и если он не равен юзеру, рубим доступ
		
		if ( !mso_check_allow('admin_page_edit_other') )
		{
			$current_users_id = getinfo('session');
			$current_users_id = $current_users_id['users_id'];
			
			# получаем данные страницы
			$CI->db->select('page_id');
			$CI->db->from('page');
			$CI->db->where(array('page_id'=>$id, 'page_id_autor'=>$current_users_id));
			$query = $CI->db->get();
			if ($query->num_rows() == 0) // не автор
			{
				echo '<div class="error">' . t('Вам не разрешено редактировать чужие записи!') . '</div>';
				return;
			}
		}
	
		require_once( getinfo('common_dir') . 'category.php' ); // функции рубрик
		require_once( getinfo('common_dir') . 'meta.php' ); // функции meta - для меток
	
		// этот код почти полностью повторяет код из new.php
		// разница только в том, что указан id
		
		if ( $post = mso_check_post(array('f_session_id', 'f_submit', 'f_content')) )
		{
			mso_checkreferer();
			
			//pr($_POST);
			
			$f_content = $post['f_content'];
			
			if ( mso_hook_present('content_replace_chr10_br') ) 
			{
				// если нужно задать свое начально форматирование, задайте хук content_replace_chr10_br
				$f_content = mso_hook('content_replace_chr10_br', $f_content);
			} 
			else
			{
				$f_content = trim($f_content);
				$f_content = str_replace(chr(10), "<br>", $f_content);
				$f_content = str_replace(chr(13), "", $f_content);
			}
			
			// pr($f_content, true);
			
			// глюк FireFox исправлем замену абсолютного пути src на абсолютный
			$f_content = str_replace('src="../../', 'src="' . $MSO->config['site_url'], $f_content);
			$f_content = str_replace('src="../', 'src="' . $MSO->config['site_url'], $f_content);
			
			// замены из-за мусора FireFox
			$f_content = str_replace('-moz-background-clip: -moz-initial;', '', $f_content);
			$f_content = str_replace('-moz-background-origin: -moz-initial;', '', $f_content);
			$f_content = str_replace('-moz-background-inline-policy: -moz-initial;', '', $f_content);
			
			$f_header = mso_text_to_html($post['f_header']);
			
			if ( isset($post['f_tags']) and $post['f_tags'] ) $f_tags = $post['f_tags'] ;
				else $f_tags = '';
			
			if ( isset($post['f_menu_order'])) $page_menu_order = (int) $post['f_menu_order'] ;
				else $page_menu_order = '';			
			
			if ( isset($post['f_slug']) and $post['f_slug'] ) $f_slug = $post['f_slug'] ;
				else $f_slug = mso_slug($f_header);
				
			if ( isset($post['f_password']) and $post['f_password']) $f_password = $post['f_password'] ;
				else $f_password = '';			
				
			if ( isset($post['f_cat']) ) $f_cat = $post['f_cat'] ;
				else $f_cat = array();
			
			// все мета
			$f_options = '';
			if ( isset($post['f_options']) )
			{
				foreach ($post['f_options'] as $key=>$val)
				{
					$f_options .= $key . '##VALUE##' . trim($val) . '##METAFIELD##';
				}
			}
			
			if ( isset($post['f_status']) ) $f_status = $post['f_status'][0];
				else $f_status = 'publish';	
				
			if ( isset($post['f_page_type']) ) $f_page_type = $post['f_page_type'][0];
				else $f_page_type = '1';
				
			if ( isset($post['f_page_parent']) and $post['f_page_parent'] ) $f_page_parent = (int) $post['f_page_parent'];
				else $f_page_parent = '0';
			
			$f_date_change = isset($post['f_date_change']) ? '1' : '0'; // сменить дату?
		
			if ( // проверяем есть ли дата
				$f_date_change and
				isset($post['f_date_y']) and 
				isset($post['f_date_m']) and
				isset($post['f_date_d']) and 
				isset($post['f_time_h']) and
				isset($post['f_time_m']) and
				isset($post['f_time_s']) and
				$post['f_date_y'] > -1 and $post['f_date_y'] < 3000 and
				$post['f_date_m'] > -1 and $post['f_date_m'] < 13 and
				$post['f_date_d'] > -1 and $post['f_date_d'] < 32 and
				$post['f_time_h'] > -1 and $post['f_time_h'] < 25 and
				$post['f_time_m'] > -1 and $post['f_time_m'] < 61 and
				$post['f_time_s'] > -1 and $post['f_time_s'] < 61)
			{
				$page_date_publish_y = (int) $post['f_date_y'];
				$page_date_publish_m = (int) $post['f_date_m'];
				$page_date_publish_d = (int) $post['f_date_d'];
				$page_date_publish_h = (int) $post['f_time_h'];
				$page_date_publish_n = (int) $post['f_time_m'];
				$page_date_publish_s = (int) $post['f_time_s'];
				
				$page_date_publish = date('Y-m-d H:i:s', mktime($page_date_publish_h, $page_date_publish_n, $page_date_publish_s,
										$page_date_publish_m, $page_date_publish_d, $page_date_publish_y) );
				
			}
			else
				$page_date_publish = false;
					
			// если автор указан, то нужно проверять есть разрешение на указание другого
			// если есть разрешение, то все нормуль
			// если нет, то автор остается текущим
			if (isset($post['f_user_id'])) $f_user_id = (int) $post['f_user_id'];
				else $f_user_id = $MSO->data['session']['users_id'];
			
			$f_comment_allow = isset($post['f_comment_allow']) ? '1' : '0';
			$f_ping_allow = isset($post['f_ping_allow']) ? '1' : '0';
			$f_feed_allow = isset($post['f_feed_allow']) ? '1' : '0';
			
		
			// получаем номер опции id из fo_edit_submit[]
			$f_id = mso_array_get_key($post['f_submit']);
			
			// подготавливаем данные
			$data = array(
				'user_login' => $MSO->data['session']['users_login'],
				'password' => $MSO->data['session']['users_password'],
				
				'page_id' => $f_id,
				'page_title' => $f_header,
				'page_content' => $f_content,
				'page_type_id' => $f_page_type,
				'page_id_cat' => implode(',', $f_cat),
				'page_id_parent' => $f_page_parent,
				'page_id_autor' => $f_user_id,
				'page_status' => $f_status,
				'page_slug' => $f_slug,
				'page_password' => $f_password,
				'page_comment_allow' => $f_comment_allow,
				'page_ping_allow' => $f_ping_allow,
				'page_feed_allow' => $f_feed_allow,
				'page_tags' => $f_tags,
				'page_meta_options' => $f_options,
				'page_date_publish' => $page_date_publish,
				'page_menu_order' => $page_menu_order,

				);

				
			require_once( getinfo('common_dir') . 'functions-edit.php' ); // функции редактирования
			$result = mso_edit_page($data);
			
			// pr($result);
			
			if (isset($result['result']) and $result['result']) 
			{
				if (isset($result['result'][0])) 
				{
					$url = '<a href="' 
							. mso_get_permalink_page($result['result'][0])
							. '">' . t('Посмотреть запись') . '</a> (<a target="_blank" href="' 
							. mso_get_permalink_page($result['result'][0]) . '">' . t('в новом окне') . '</a>)';		

				}
				else $url = '';

				echo '<div class="update">' . t('Страница обновлена!') . ' ' . $url . '</div>'; 
				
				# пулучаем данные страниц
				$CI->db->select('*');
				$CI->db->from('page');
				$CI->db->where(array('page_id'=>$id));
				$query = $CI->db->get();
				if ($query->num_rows() > 0)
				{
					foreach ($query->result_array() as $row)
					{
						// pr($row);
						$f_content = $row['page_content'];
						$f_header = $row['page_title'];
						$f_slug = $row['page_slug'];
						$f_status = $row['page_status'];
						$f_page_type = $row['page_type_id'];
						$f_password = $row['page_password'];
						$f_comment_allow = $row['page_comment_allow'];
						$f_ping_allow = $row['page_ping_allow'];
						$f_feed_allow = $row['page_feed_allow'];
						$f_page_parent = $row['page_id_parent'];
						$f_user_id = $row['page_id_autor'];
						$page_date_publish = $row['page_date_publish'];
						$page_menu_order = $row['page_menu_order'];
					}
					$f_cat = mso_get_cat_page($id); // рубрики в виде массива
					$f_tags = implode(', ', mso_get_tags_page($id)); // метки страницы в виде массива			
				}
				
			}
			else
				echo '<div class="error">' . t('Ошибка обновления') . '</div>';
			
		}
		else 
		{
			echo ' | <a href="' . mso_get_permalink_page($id) . '">' . t('Посмотреть запись') . '</a> (<a target="_blank" href="' . mso_get_permalink_page($id) . '">' . t('в новом окне') . '</a>)</p>';
			
			// получаем данные записи
			$CI->db->select('*');
			$CI->db->from('page');
			$CI->db->where(array('page_id'=>$id));
			$query = $CI->db->get();
			if ($query->num_rows() > 0)
			{
				foreach ($query->result_array() as $row)
				{
					// pr($row);
					$f_content = $row['page_content'];
					$f_header = $row['page_title'];
					$f_slug = $row['page_slug'];
					$f_status = $row['page_status'];
					$f_page_type = $row['page_type_id'];
					$f_password = $row['page_password'];
					$f_comment_allow = $row['page_comment_allow'];
					$f_ping_allow = $row['page_ping_allow'];
					$f_feed_allow = $row['page_feed_allow'];
					$f_page_parent = $row['page_id_parent'];
					$f_user_id = $row['page_id_autor'];
					$page_date_publish = $row['page_date_publish'];
					$page_menu_order = $row['page_menu_order'];
				}
				
				$f_cat = mso_get_cat_page($id); // рубрики в виде массива
				$f_tags = implode(', ', mso_get_tags_page($id)); // метки страницы в виде массива			
			}
			else
			{
				echo '<div class="error">' . t('Ошибочная страница (нет такой страницы)') . '</div>';
				return;
			}
		
		}
		
		// получим все опции редактора
		$editor_options = mso_get_option('editor_options', 'admin', array());
		
		$f_header = htmlspecialchars($f_header);
		$f_tags = htmlspecialchars($f_tags);
		$f_all_tags = ''; // все метки

		if (function_exists('tagclouds_widget_custom')) 
		{
			$f_all_tags = '
			<script type="text/javascript">
				function addTag(t)
				{
					var elem = document.getElementById("f_tags");
					e = elem.value;
					if ( e != "" ) { elem.value = e + ", " + t; }
					else { elem.value = t; };
				}
				function shtags(sh)
				{
					var elem1 = document.getElementById("f_all_tags_max_num");
					var elem2 = document.getElementById("f_all_tags_all");
					
					if (sh == 1) 
					{ 
						elem1.style.display = "none"; 
						elem2.style.display = "block"; 
					}
					else
					{
						elem1.style.display = "block"; 
						elem2.style.display = "none"; 				
					}
				}			
			</script>' . NR;
			
			// только первые 20
			$f_all_tags .= tagclouds_widget_custom(array(
				'max_num' => isset($editor_options['tags_count']) ? $editor_options['tags_count'] : 20,
				'max_size' => '180',
				'sort' => isset($editor_options['tags_sort']) ? $editor_options['tags_sort'] : 0, 
				'block_start' => '<p id="f_all_tags_max_num">',
				'block_end' => ' <a title="' . t('Показать все метки') . '" href="#" onClick="shtags(1); return false;">&gt;&gt;&gt;</a></p>',
				'format' => '<span style="font-size: %SIZE%%"><a href="#" onClick="addTag(\'%TAG%\'); return false;">%TAG%</a><sub style="font-size: 7pt;">%COUNT%</sub></span>'
			));
			
			// все метки
			$f_all_tags .= tagclouds_widget_custom(array(
				'max_num' => 9999,
				'max_size' => '180',
				'sort' => isset($editor_options['tags_sort']) ? $editor_options['tags_sort'] : 0, 
				'block_start' => '<p id="f_all_tags_all" style="display: none;">',
				'block_end' => ' <a title="' . t('Показать только самые популярные метки') . '" href="#" onClick="shtags(2); return false;">&lt;&lt;&lt;</a></p>',
				'format' => '<span style="font-size: %SIZE%%"><a href="#" onClick="addTag(\'%TAG%\'); return false;">%TAG%</a><sub style="font-size: 7pt;">%COUNT%</sub></span>'
			));
	
		}
		
		$fses = mso_form_session('f_session_id'); // сессия

		// получаем все типы страниц
		$all_post_types = '';
		$query = $CI->db->get('page_type');
		
		$page_type_js_obj = '{'; // для скрытия метаполей в зависимости от типа записи
		
		foreach ($query->result_array() as $row)
		{
			if ($f_page_type == $row['page_type_id']) $che = 'checked="checked"';
				else $che = '';
			
			$page_type_desc = $row['page_type_desc'] ? ' <em>(' . t($row['page_type_desc']) . ')</em>' : '';
			
			$all_post_types .= '<p><label><input name="f_page_type[]" type="radio" ' . $che 
									. ' value="' . $row['page_type_id'] . '"> ' 
									. $row['page_type_name'] . $page_type_desc . '</label></p>';
			$page_type_js_obj .= $row['page_type_name'] . ':' . $row['page_type_id'] . ',';						
									
		}
		
		$page_type_js_obj .= '}';
		$page_type_js_obj = str_replace(',}', '}', $page_type_js_obj);

	
		
		// получаем все рубрики чекбоксы
		$all_cat = mso_cat_ul('<label><input name="f_cat[]" type="checkbox" %CHECKED% value="%ID%" title="id = %ID%"> %NAME%</label>', true, $f_cat, $f_cat);

		
		if ($f_comment_allow) $f_comment_allow = 'checked="checked"';
			else $f_comment_allow = '';
			
		if ($f_feed_allow) $f_feed_allow = 'checked="checked"';
			else $f_feed_allow = '';
		
		
		// не используется
		if ($f_ping_allow) $f_ping_allow = 'checked="checked"';
			else $f_ping_allow = '';			
			
		
		# получаем список юзеров
		if ( !mso_check_allow('edit_page_author') ) // если не разрешено менять автора
		{
			$CI->db->where('users_id', $f_user_id); // ставим только текущего автора
		}
		$CI->db->select('users_id, users_login, users_nik');
		$query = $CI->db->get('users');
		
		$all_users = array();
		
		// если есть данные, то выводим
		if ($query->num_rows() > 0)
		{
			foreach ($query->result_array() as $row)
				$all_users[$row['users_id']] = $row['users_login'] . ' (' . $row['users_nik'] . ')';
		}
		
		$CI->load->helper('form');
		$all_users = form_dropdown('f_user_id', $all_users, $f_user_id, ' style="width: 99%;" ');
		
		
		$f_status_draft = $f_status_private = $f_status_publish = '';
		if ($f_status == 'draft') $f_status_draft = 'checked';
		elseif ($f_status == 'private') $f_status_private = 'checked';
		else $f_status_publish = 'checked'; // ($f_status == 'publish') 
		
		$name_submit = 'f_submit[' . $id . ']';
		
		
		// дата публикации
		$f_date_change = ''; // сменить дату не нужно - будет время автоматом поставлено текущее
		
		$date_cur = strtotime($page_date_publish);
		
		$date_time = t('Сохранено:') . ' ' . $page_date_publish;
		
		$date_time .= '<br>' . t('На блоге как:') . ' ' . mso_date_convert('Y-m-d H:i:s', $page_date_publish);
		$date_time .= '<br>' . t('Тек. время:') . ' ' . date('Y-m-d H:i:s');
		
		$date_cur_y = date('Y', $date_cur);
		$date_cur_m = date('m', $date_cur);
		$date_cur_d = date('d', $date_cur);	
		$tyme_cur_h = date('H', $date_cur);
		$tyme_cur_m = date('i', $date_cur);
		$tyme_cur_s = date('s', $date_cur);
		
		$date_all_y = array();
		for ($i=2005; $i<2021; $i++) $date_all_y[$i] = $i;
		
		$date_all_m = array();
		for ($i=1; $i<13; $i++) $date_all_m[$i] = $i;
		
		$date_all_d = array();
		for ($i=1; $i<32; $i++) $date_all_d[$i] = $i;
		
		$date_y = form_dropdown('f_date_y', $date_all_y, $date_cur_y, ' style="margin-top: 5px; width: 60px;" ');
		$date_m = form_dropdown('f_date_m', $date_all_m, $date_cur_m, ' style="margin-top: 5px; width: 60px;" ');
		$date_d = form_dropdown('f_date_d', $date_all_d, $date_cur_d, ' style="margin-top: 5px; width: 60px;" ');
		
		$time_all_h = array();
		for ($i=0; $i<24; $i++) $time_all_h[$i] = $i;
		
		$time_all_m = array();
		for ($i=0; $i<60; $i++) $time_all_m[$i] = $i;

		$time_all_s = $time_all_m;
		
		$time_h = form_dropdown('f_time_h', $time_all_h, $tyme_cur_h, ' style="margin-top: 5px; width: 60px;" ');
		$time_m = form_dropdown('f_time_m', $time_all_m, $tyme_cur_m, ' style="margin-top: 5px; width: 60px;" ');
		$time_s = form_dropdown('f_time_s', $time_all_s, $tyme_cur_s, ' style="margin-top: 5px; width: 60px;" ');
		
		
		// получаем все страницы, для того чтобы отобразить их в паренте
		$all_pages = NR . '<select name="f_page_parent"  style="margin-top: 5px; width: 99%;" >' . NR;
		$all_pages .= NR . '<option value="0">' . t('Нет') . '</option>';
		
		// если отмечена опция отрображать блок
		if (!isset($editor_options['page_all_parent']) or (isset($editor_options['page_all_parent']) and $editor_options['page_all_parent']))
		{
			$CI->db->select('page_id, page_title');
			$CI->db->where('page_status', 'publish');
			$CI->db->where('page_id !=', $id);
			$CI->db->order_by('page_date_publish', 'desc');
			$query = $CI->db->get('page');
			if ($query->num_rows() > 0)
			{
				
				foreach ($query->result_array() as $row)
				{
					if ($row['page_id'] == $f_page_parent) $sel = ' selected="selected"';
						else $sel = '';
						$all_pages .= NR . '<option ' . $sel . 'value="' . $row['page_id'] . '">' . $row['page_id'] . ' - ' . htmlspecialchars($row['page_title']) . '</option>';
				}
			}
		}
		
		$all_pages .= NR . '</select>' . NR;
		
		
		# мета большие,вынесена в отдельный файл
		# из неё получается $all_meta = '<p>Нет</p>';
		require($MSO->config['admin_plugins_dir'] . 'admin_page/all_meta.php');
		
		$f_return = '';
	
		# форма вынесена в отдельный файл, поскольку она одна и таже для new и edit
		# из неё получается $do и $posle
		require($MSO->config['admin_plugins_dir'] . 'admin_page/form.php');
	
		$f_content = htmlspecialchars($f_content);
		
		$ad_config = array(
					'action'=> '',
					'content' => $f_content,
					'do' 	=> $do,
					'posle' => $posle,
				
					);

		# отображаем редактор
		# есть ли хук на редактор: если да, то получаем эту функцию
		# если нет, то отображаем стандартный editor_jw
		if (mso_hook_present('editor_custom')) mso_hook('editor_custom', $ad_config);
			else editor_jw($ad_config);;
			
	////////////////////////////////////////////////////////////////////////////////

	
	}
	else
	{
		echo '<div class="error">' . t('Ошибочный запрос') . '</div>'; // id - ошибочный
	}
?>