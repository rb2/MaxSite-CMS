<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://max-3000.com/
 */

# функция автоподключения плагина
function comment_button_autoload($args = array())
{
	mso_hook_add( 'head', 'comment_button_head'); # хук на head шаблона - для JS
	mso_hook_add( 'admin_comment_edit', 'comment_button_head_admin_comment_edit'); # для JS админки
	mso_hook_add( 'comments_content_start', 'comment_button_custom'); # хук на форму
}

# подключаем JS в head
function comment_button_head($arg = array())
{
	if (is_type('page')) 
		echo '<script type="text/javascript" src="'. getinfo('plugins_url') . 'comment_button/comment_button.js"></script>' . NR;
}

# подключаем JS в head
function comment_button_head_admin_comment_edit($arg = array())
{
	echo '<script type="text/javascript" src="'. getinfo('plugins_url') . 'comment_button/comment_button.js"></script>' . NR;
}


# функции плагина
function comment_button_custom($arg = array())
{
	echo '<p class="comment_button">
	<input type="button" value="B" title="' . t('Полужирный') . '" onClick="addText(\'<b>\', \'</b>\') ">
	<input type="button" value="I" title="' . t('Курсив') . '" onClick="addText(\'<i>\', \'</i>\') ">
	<input type="button" value="U" title="' . t('Подчеркнутый') . '" onClick="addText(\'<u>\', \'</u>\') ">
	<input type="button" value="S" title="' . t('Зачеркнутый') . '" onClick="addText(\'<s>\', \'</s>\') ">
	<input type="button" value="' . t('Цитата') . '" title="' . t('Цитата') . '" onClick="addText(\'<blockquote>\', \'</blockquote>\') ">
	<input type="button" value="' . t('Код') . '" title="' . t('Код или преформатированный текст') . '" onclick="addText(\'<pre>\', \'</pre>\') ">
	</p>';
}

?>