<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

		if ($comusers_nik) echo '<h1>' . $comusers_nik . '</h1>';
			else echo '<h1>'. t('Комментатор'). ' ' . $comusers_id . '</h1>';
		
		if ($comusers_activate_string != $comusers_activate_key) // нет активации
			echo '<p><span style="color: red;" class="comusers-no-activate">'. t('Активация не завершена.'). '</span> <a href="' . getinfo('siteurl') . 'users/' . $comusers_id . '/edit">'. t('Завершить'). '</a></p>';
		
		// выводим все данные
		if ($comusers_date_registr) echo '<p><strong>'. t('Дата регистрации'). ':</strong> ' . $comusers_date_registr . '</p>';
		if ($comusers_nik) echo '<p><strong>'. t('Ник'). ':</strong> ' . $comusers_nik . '</p>';
		if ($comusers_count_comments) echo '<p><strong>'. t('Комментариев'). ':</strong> ' . $comusers_count_comments . '</p>';
		if ($comusers_url) echo '<p><strong>'. t('Сайт'). ':</strong> <a rel="nofollow" href="' . $comusers_url . '">' . $comusers_url . '</a></p>';
		if ($comusers_icq) echo '<p><strong>'. t('ICQ'). ':</strong> ' . $comusers_icq . '</p>';
		if ($comusers_msn) echo '<p><strong>'. t('Twitter'). ':</strong> <a rel="nofollow" href="http://twitter.com/' . $comusers_msn . '">@' . $comusers_msn . '</a></p>';
		if ($comusers_jaber) echo '<p><strong>'. t('Jabber'). ':</strong> ' . $comusers_jaber . '</p>';
		if ($comusers_date_birth and $comusers_date_birth!='1970-01-01 00:00:00' and $comusers_date_birth!='0000-00-00 00:00:00'   ) 
				echo '<p><strong>'. t('Дата рождения'). ':</strong> ' . $comusers_date_birth . '</p>';
		
		if ($comusers_description) 
		{
			$comusers_description = strip_tags($comusers_description);
			$comusers_description = str_replace("\n", '<br>', $comusers_description);
			$comusers_description = str_replace('<br><br>', '<br>', $comusers_description);
			
			echo '<p><strong>'. t('О себе'). ':</strong> ' . $comusers_description . '</p>';
		}
		
		if ($comusers_admin_note) echo '<p><strong>'. t('Примечание админа'). ':</strong> ' . $comusers_admin_note . '</p>';
		
		echo '<p><a href="' . getinfo('siteurl') . 'users/' . $comusers_id . '/edit">'. t('Редактировать персональные данные'). '</a></p>';
		
		if ($comments) // есть комментарии
		{
			echo '<br><h2>'. t('Его последние комментарии'). ':</h2><ul>';
			
			foreach ($comments as $comment)
			{
				//if ($comment['comments_approved']) // только отмодерированные
				//{
					echo '<li><span><a href="' . getinfo('siteurl') . 'page/' . mso_slug($comment['page_slug']) . '#comment-' . $comment['comments_id'] . '" name="comment-' . $comment['comments_id'] . '">' . $comment['page_title'] . '</a>';
					// echo ' | ' . $comments_url;
					echo '</span><br>' . $comment['comments_date'];
					echo '</span><br>' . $comment['comments_content'];
					echo '</li>';
				//}
			}
			
			echo '</ul>';
		}
		

	
?>