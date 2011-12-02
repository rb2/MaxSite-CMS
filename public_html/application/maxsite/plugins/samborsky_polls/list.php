<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

global $MSO;
$CI = &get_instance();

$mode = mso_segment(4);
$mode_id = mso_segment(5);
setlocale(LC_ALL,'ru_RU.utf-8');

////////////////////////////////////////////
//		ОБРАБОТКА И ПОДГОТОВКА ДАННЫХ
////////////////////////////////////////////

// обработка POST

// Удаляем
if('delete' == $mode && is_numeric($mode_id)){
	$CI->db->delete('sp_answers',array('a_qid' => $mode_id));
	$CI->db->delete('sp_questions',array('q_id' => $mode_id));
}

// Закрываем
if('close' == $mode && is_numeric($mode_id)){
	$CI->db->update('sp_questions',array('q_active' => 0),array('q_id' => $mode_id));
	$CI->db->insert('sp_logs',array('l_qid'=>$mode_id,'l_host'=>'Закрыто','l_timestamp'=>mktime(),'l_user'=>is_login()?$MSO->data['session']['users_login']:'-'));
}

// Открываем
if('open' == $mode && is_numeric($mode_id)){
	$CI->db->update('sp_questions',array('q_active' => 1),array('q_id' => $mode_id));
	$CI->db->insert('sp_logs',array('l_qid'=>$mode_id,'l_host'=>'Открыто','l_timestamp'=>mktime(),'l_user'=>is_login()?$MSO->data['session']['users_login']:'-'));
}

// Голосование добавленно
if('add_ok' == $mode){
	echo '<div class="update">' . t('Голосование добавлено!') . '</div>';
}

// Голосование изменено
if('edit_ok' == $mode){
	echo '<div class="update">' . t('Голосование изменено!') . '</div>';
}
// Получаем данные
$CI->db->select('*');
$query = $CI->db->order_by('q_id','desc')->get('sp_questions');

echo '<h1>Список голосований</h1>';

if( $query->num_rows() ){

	$errors = array();
	
	// Таблица
	$CI->load->library('table');
	$CI->table->set_template(array(
		'table_open'  => '<table class="page samborsky_polls_table">',
		'table_close'=>'<tfoot class="nav"><tr><td colspan="6"><div class="pagination"></div><div class="paginationTitle">Страница: </div><div class="selectPerPage"></div><div class="status"></div></td></tr></tfoot></table>'));
	
	// Заголовок
	$CI->table->set_heading(
		array('data'=>'ID','class'=>'polls_list_cell_id sort','sort'=>'id'),
		array('data'=>'Вопрос','class'=>'polls_list_cell_qu sort','sort'=>'qu'),
		array('data'=>'...голосов','class'=>'polls_list_cell_votes sort','sort'=>'votes'),
		array('data'=>'Дата начала','class'=>'polls_list_cell_date sort','sort'=>'date'),
		array('data'=>'Осталось...','class'=>'polls_list_cell_status sort','sort'=>'status'),
		array('data'=>'Действия','class'=>'polls_list_cell_act'));

	// Перебор данных
	foreach( $query->result() as $row ){

		$plug_path = getinfo('plugins_url') .'samborsky_polls/';
		$url_path = getinfo('site_url') .'admin/samborsky_polls/';
		$id = $row->q_id;
		$qu = stripslashes($row->q_question);
		if(function_exists('mb_strlen') and mb_strlen($qu) > 50)
			$qu = textTruncate($qu, 50);
		$link_for_page = '[php]if(function_exists(\\\'samborsky_polls\\\')) echo samborsky_polls(\\\''.$id.'\\\');[/php]';
			
		$cell1 = $id;
		$cell2 = $qu;
		$cell3 = '<div align="right">' . number_format($row->q_totalvotes,0,' ',' ') . '</div>';
		$cell4 = strftime("%m-%d-%Y", $row->q_timestamp);

		if(!$row->q_active)
		{
			$cell5 = 'Закрыто';
			$cell6 = "<a href='{$url_path}list/open/{$id}'><img src='{$plug_path}img/open.png' title='Открыть голосование'></a>";
		}
		else
		{
			//$cell5 = $row->q_expiry ? declination(ceil(($row->q_expiry+-mktime())/60/60/24)) : 'Бессрочное';
			$cell5 = $row->q_expiry ? declination(ceil(($row->q_expiry+-mktime())/60/60/24)) : 'Бессрочное';
			$cell6 = "<a href='{$url_path}list/close/{$id}'><img src='{$plug_path}img/close.png' title='Зыкрыть голосование'></a>";
		}
		
		$cell6 .= " <a href='' onclick=\"alert('Для добавления голосования на страницу, вставьте туда следующий код:\\r\\n\\r\\n{$link_for_page}\\r\\n\\r\\n(Должен быть включен плагин run_php)');return false;\">
			<img src='{$plug_path}img/link.png' title='Ссылка на голосование'></a>";
		$cell6 .= " <a href='{$url_path}logs/{$id}'><img src='{$plug_path}img/log.png' title='Логи'></a>";
		$cell6 .= " <a href='{$url_path}manage/{$id}'><img src='{$plug_path}img/edit.png' title='Изменить'></a>";
		$cell6 .= " <a href='{$url_path}list/delete/{$id}' onclick=\"return confirm('Удаляем голосование\\r\\n$qu\\r\\n\\r\\n Вы уверены?');\"><img src='{$plug_path}img/del.png' title='Удалить'></a>";

		$CI->table->add_row($cell1,$cell2,$cell3,$cell4,$cell5,$cell6);
		
		// Если есть ошибки - добавляем в массив
		if($row->q_totalvotes != $row->q_totalvoters)
		{
			$str = "<li>ID: {$row->q_id}, ";
			$str .= "Вопрос: {$qu},";
			$str .= " сумма голосов - <strong>{$row->q_totalvotes}</strong>,";
			$str .= " проголосовавших - <strong>{$row->q_totalvoters}</strong></li>";
			$errors[] = $str;
		}
	}
	
	echo $CI->table->generate();

	// если есть ошибки - выводим
	if(count($errors) > 0)
	{
		echo '<div class="error">' .t('В следующих голосованиях не совпадает сумма голосов с количеством проголосовавших:', 'admin');
		echo '<ul>' .implode($errors) .'</ul>';
		echo '</div>';
	}
}
?>
