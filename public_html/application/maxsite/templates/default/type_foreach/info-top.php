<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

echo '<div class="info info-top">';

	mso_page_title($page_slug, $page_title, '<h1>', mso_page_edit_link($page_id,  '<img src="' . getinfo('template_url') . 'images/edit.png" width="16" height="16" alt="" title="Edit page" class="right">', '', '', false) . '</h1>', !is_type('page'));
	
	echo '<div style="margin: 10px 0; padding: 5px 3px; line-height: 1.8em;">'; // отдельный блок для info
	
		// только для page
		if (is_type('page'))
		{
		
			mso_page_date($page_date_publish, array('format' => 'j F Y г.'), '<span title="' . t('Дата публикации') . '"><img src="' . getinfo('template_url') . 'images/date.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>');
			
			mso_page_author_link($users_nik, $page_id_autor, '<span style="margin-left: 15px;" title="' . t('Автор') . '"><img src="' . getinfo('template_url') . 'images/user.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>');
			
			mso_page_view_count($page_view_count, '<span style="margin-left: 15px;" title="' . t('Просмотры записи') . '"><img src="' . getinfo('template_url') . 'images/post-view.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ' . t('Просмотров') . ':</span> ', '');
			
			if ($page_comment_allow) mso_page_feed($page_slug, t('RSS'), '<span style="margin-left: 15px;" title="' . t('Подписка на RSS') . '"><img src="' . getinfo('template_url') . 'images/rss.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>', true);
			
			mso_page_comments_link( array( 
				'page_comment_allow' => $page_comment_allow,
				'page_slug' => $page_slug,
				'page_count_comments' => $page_count_comments,
				'title' => '<img src="' . getinfo('template_url') . 'images/comments.png" width="16" height="16" alt=""> ',
				'title_no_link' => '<img src="' . getinfo('template_url') . 'images/comments.png" width="16" height="16" alt=""> ',
				'title_no_comments' => '<img src="' . getinfo('template_url') . 'images/comments.png" width="16" height="16" alt="">',
				'do' => '<span style="margin-left: 15px;" title="' . t('Комментарии') . '">',
				
				'posle' => ($page_count_comments ? 
							mso_page_title($page_slug . '#comments', $page_count_comments, ' ', '', true, false)
							: 
							mso_page_title($page_slug . '#comments', 'Обсудить', ' ', '', true, false)
							) . '</span>',
				));

			
			mso_page_cat_link($page_categories, ' » ', '<br><span title="' . t('Рубрики') . '"><img src="' . getinfo('template_url') . 'images/category.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>'); 		
			
			mso_page_tag_link($page_tags, ', ', '<span style="margin-left: 15px;" title="' . t('Метки') . '"><img src="' . getinfo('template_url') . 'images/tag.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>');
			
		}
		else // все остальные страницы
		{
			mso_page_date($page_date_publish, array('format' => 'j F Y г.'), '<span title="' . t('Дата публикации') . '"><img src="' . getinfo('template_url') . 'images/date.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>');
			
			mso_page_author_link($users_nik, $page_id_autor, '<span style="margin-left: 15px;" title="' . t('Автор') . '"><img src="' . getinfo('template_url') . 'images/user.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>');
			
			mso_page_cat_link($page_categories, ' » ', ' <span style="margin-left: 15px;" title="' . t('Рубрики') . '"><img src="' . getinfo('template_url') . 'images/category.png" width="16" height="16" alt="" style="vertical-align: text-top;"> ', '</span>'); 		
			

			mso_page_comments_link( array( 
				'page_comment_allow' => $page_comment_allow,
				'page_slug' => $page_slug,
				'page_count_comments' => $page_count_comments,
				'title' => '<img src="' . getinfo('template_url') . 'images/comments.png" width="16" height="16" alt=""> ',
				'title_no_link' => '<img src="' . getinfo('template_url') . 'images/comments.png" width="16" height="16" alt=""> ',
				'title_no_comments' => '<img src="' . getinfo('template_url') . 'images/comments.png" width="16" height="16" alt="">',
				'do' => '<span style="margin-left: 15px;" title="' . t('Комментарии') . '">',
				
				'posle' => ($page_count_comments ? 
							mso_page_title($page_slug . '#comments', $page_count_comments, ' ', '', true, false)
							: 
							mso_page_title($page_slug . '#comments', 'Обсудить', ' ', '', true, false)
							) . '</span>',
				));

		}

	echo '</div>';

echo '</div>';
	
