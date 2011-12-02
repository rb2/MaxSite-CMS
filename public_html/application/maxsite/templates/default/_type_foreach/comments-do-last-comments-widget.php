<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

		echo '<h1 class="comments">'. t('Последние комментарии') .'</h1>';
		echo '<p class="info"><a href="' . getinfo('siteurl') . 'comments/feed">'. t('Подписаться по RSS') .'</a>';
		echo '<br><a href="' . getinfo('siteurl') . 'users">'. t('Список комментаторов') .'</a></p>';
		
		echo '<div class="comments">';
		echo last_comments_widget_custom(array(
										'count'=> 40,
										), '999');
		echo '</div>';

?>