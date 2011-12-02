<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 
	
	mso_cur_dir_lang('admin');
	
	$CI = & get_instance();
	
	# новый пользователь
	if ( $post = mso_check_post(array('f_session_id', 'f_submit', 'f_user_login', 
			'f_user_email', 'f_user_password', 'f_user_group')) )
	{
		mso_checkreferer();
		
		// подготавливаем данные
		$data = array(
			'user_login' => $MSO->data['session']['users_login'],
			'password' => $MSO->data['session']['users_password'],
			
			'users_login' => $post['f_user_login'],
			'users_email' => $post['f_user_email'],
			'users_password' => $post['f_user_password'],
			'users_groups_id' => $post['f_user_group']
			);
		
		require_once( getinfo('common_dir') . 'functions-edit.php' ); // функции редактирования
		
		$result = mso_new_user($data);
		
		if (isset($result['result'])) 
		{
			if ($result['result'] == 1)
				echo '<div class="update">' . t('Пользователь создан!', 'admin') . '</div>'; // . $result['description'];
			else 
				echo '<div class="error">' . t('Произошла ошибка', 'admin') . '<p>' . $result['description'] . '</p></div>';
		}
		else
			echo '<div class="error">' . t('Ошибка обновления', 'admin') . '</div>';
	}
	
	# удаление пользователя
	if ( $post = mso_check_post(array('f_session_id', 'f_delete_submit', 'f_user_delete')) )
	{
		mso_checkreferer();

		// подготавливаем данные
		$data = array(
			'user_login' => $MSO->data['session']['users_login'],
			'password' => $MSO->data['session']['users_password'],
			
			'users_id' => $post['f_user_delete'],
			'delete_user_comments' => isset($post['f_delete_user_comments']) ? true : false,
			'delete_user_pages' => isset($post['f_delete_user_pages']) ? true : false
			);
		
		require_once( getinfo('common_dir') . 'functions-edit.php' ); // функции редактирования
		
		$result = mso_delete_user($data);
		
		if (isset($result['result'])) 
		{
			if ($result['result'] == 1)
				echo '<div class="update">' . t('Пользователь удален!', 'admin') . '</div>'; // . $result['description'];
			else 
				echo '<div class="error">' . t('Произошла ошибка', 'admin') . '<p>' . $result['description'] . '</p></div>';
		}
		else
			echo '<div class="error">' . t('Ошибка удаления', 'admin') . '</div>';
	}

?>
<h1><?= t('Пользователи') ?></h1>
<p class="info"><?= t('Список пользователей сайта') ?></p>

<?php
	$CI->load->library('table');
	
	$tmpl = array (
					'table_open'          => '<table class="page tablesorter" border="0" width="99%" id="pagetable">',
					'row_alt_start'          => '<tr class="alt">',
					'cell_alt_start'      => '<td class="alt">',
					'heading_row_start'     => NR . '<thead><tr>',
					'heading_row_end'         => '</tr></thead>' . NR,
					'heading_cell_start'    => '<th style="cursor: pointer;">',
					'heading_cell_end'        => '</th>',
				);
		  
	$CI->table->set_template($tmpl); // шаблон таблицы

	$CI->table->set_heading('ID', t('Логин', 'admin'), t('Ник', 'admin'), t('E-mail', 'admin'), t('Сайт', 'admin'), t('Группа', 'admin'), t('Действие', 'admin'));
	
	
	$CI->db->select('*');
	$CI->db->from('users');
	$CI->db->join('groups', 'users.users_groups_id = groups.groups_id');
	$CI->db->order_by('users_groups_id');
	
	$query = $CI->db->get();
	
	$this_url = $MSO->config['site_admin_url'] . 'users';

	$all_users = array(); // массив для удаления пользователей
	
	foreach ($query->result_array() as $row)
	{
		$id = $row['users_id'];
		$login = $row['users_login'];
		$nik = $row['users_nik'];
		$email = $row['users_email'];
		$url = $row['users_url'];
		
		$groups_name = $row['groups_name'];
		
		$act = '<a href="'.$this_url.'/edit/' . $id . '">' . t('Изменить', 'admin') . '</a>';
		
		# админа (1) удалять нельзя
		if ($id > 1) $all_users[$id] = $id . ' - ' . $nik . ' - ' . $email;
		
		$CI->table->add_row($id, $login, $nik, $email, $url, $groups_name, $act);
	}

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

	// добавляем форму, а также текущую сессию
	echo $CI->table->generate(); // вывод подготовленной таблицы
	
	
	if ( mso_check_allow('edit_add_new_users') ) // если разрешено создавать юзеров
	{
		// новый пользователь создается так:
		// указывается его логин, пароль, емайл, группа
		// создается
		// для того, чтобы отредактировать, нужно войти в его редактирование
		$new_user_login = '';
		$new_user_email = '';
		$new_user_password = '';
		$new_user_group = '';
		
		$form = '';
		$CI->load->helper('form');
		
		$form .= '<p class="input"><strong>' . t('Логин', 'admin') . ' </strong>'. form_input( array( 'name'=>'f_user_login' ) ) .'</p>';
		$form .= '<p class="input"><strong>E-mail </strong>'. form_input( array( 'name'=>'f_user_email' ) ) .'</p>';
		$form .= '<p class="input"><strong>' . t('Пароль', 'admin') . ' </strong>'. form_input( array( 'name'=>'f_user_password' ) ) .'</p>';
		
		$CI->db->select('groups_id, groups_name');
		$q = $CI->db->get('groups');
		$groups = array();
		foreach ($q->result_array() as $rw)
			$groups[$rw['groups_id']] = $rw['groups_name'];

		$form .= '<p class="input"><strong>' . t('Группа', 'admin') . ' </strong>'. form_dropdown('f_user_group', $groups, '');	
		$form .=  '<p class="input_submit"><input type="submit" name="f_submit" value="' . t('Создать пользователя', 'admin') . '"></p>';
		
		echo '<div class="item new_user">';
		echo '<form action="" method="post">' . mso_form_session('f_session_id');
		echo '<h2 class="br">' . t('Создать нового пользователя', 'admin') . '</h2>';
		echo '<p>' . t('Если данные некорректны, то пользователь создан не будет. Для нового пользователя-админа нужно обновить разрешения.', 'admin') . '</p>';
		echo $form;
		echo '</form>';
		echo '</div>';
	}

	if ( mso_check_allow('edit_delete_users') ) // если разрешено удалять юзеров
	{
		$CI->load->helper('form');
		
		echo '<div class="item delete_user">';
		echo '<form action="" method="post">' . mso_form_session('f_session_id');
		echo '<h2 class="br">' . t('Удалить пользователя', 'admin') . '</h2>';
		echo '<p class="input"><strong>' . t('Удалить', 'admin') . ' </strong>';
		echo form_dropdown('f_user_delete', $all_users, '', '');
		echo '</p>';
		echo '<p class="checkbox"><label><input type="checkbox" name="f_delete_user_comments"> ' . t('Удалить все комментарии пользователя. Иначе комментарии отметятся как анонимные.', 'admin') . '</label></p>';
		echo '<p class="checkbox"><label><input type="checkbox" name="f_delete_user_pages"> ' . t('Удалить все страницы пользователя. Иначе у страниц автором станет администратор.', 'admin') . '</label></p>';
		echo '<p class="input_submit"><input type="submit" name="f_delete_submit" value="' . t('Удалить пользователя', 'admin') . '" onClick="if(confirm(\'' . t('Удалить пользователя?', 'admin') . '\')) {return true;} else {return false;}"></p>';
		echo '</form>';
		echo '</div>';
	}


?>