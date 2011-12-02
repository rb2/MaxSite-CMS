<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

function declination($n)
{
	$m1 = substr($n, -1);
	$m2 = substr($n, -2);
	if($m2 > '10' && $m2 < '15' || $m1 > '4' && $m1 < '10' || $m1 == '0')
		return "$n дней"; // Род. п., мн. ч.
	if($m1 > '1' && $m1 < '5')
		return "$n дня";  // Род. п., ед. ч.
	if($m1 == '1') 
		return "$n день"; // Им. п., ед. ч.
		
	return FALSE;
}

function textTruncate($string, $limit, $break=" ", $pad="...")
{
  if(mb_strlen($string) <= $limit) return $string;
  $string = mb_substr($string, 0, $limit);
  if(false !== ($breakpoint = mb_strrpos($string, $break))) {
    $string = mb_substr($string, 0, $breakpoint);
  }
  return $string . $pad;
}

//////////////////////////////////////////////////////////
// Подготовка данных голосования для редактирования
function polls_manage_get_data_for_edit($id)
{
	$CI = &get_instance();
	
	$data['act'] = 'edit';

	// Получаем вопрос
	$CI->db->select('*');
	$CI->db->where('q_id', mso_segment(4));
	$query = $CI->db->get('sp_questions');

	$data['qu'] = $query->row_array();
	$data['qu']['q_question'] = stripslashes($data['qu']['q_question']);

	// получаем ответы
	$CI->db->select('*');
	$CI->db->where('a_qid', mso_segment(4));
	$CI->db->order_by('a_order', 'asc');
	$query = $CI->db->get('sp_answers');

	$data['ans'] = $query->result_array();
	foreach ($data['ans'] as &$ans)
	{
		$ans['a_answer'] = stripslashes($ans['a_answer']);
		$ans['view'] = 1;
	}

	// добиваем массив до 15 эллементов
	$data['ans'] = array_pad ($data['ans'],15,array(
							'a_id' => '',
							'a_qid' => $data['ans'][0]['a_id']['a_qid'],
							'a_answer' => '',
							'a_votes' => '',
							'a_order' => 0,
							'view' => 0));
	
	$data['no_expiry'] = '';
	if(!$data['qu']['q_expiry'])
	{
		$data['qu']['q_expiry'] = $data['qu']['q_timestamp'];
		$data['no_expiry'] = 'checked="checked"';
	}
	
	return $data;
}


//////////////////////////////////////////////////////////
// Подготовка данных для создания нового голосования
function polls_manage_get_data_for_new()
{
	$data['act'] = 'new';
	$data['no_expiry'] = '';
	
	$date = mktime(0,0,0,date("m"),date("d"),date("Y"));
	if(!$exp = get_option_len_polls($date))
	{
		$exp = $date;
		$data['no_expiry'] = 'checked="checked"';
	}

	$protect = get_option_protect_pools();

	$data['qu'] = array('q_id' => '',
						'q_question' => '',
						'q_timestamp' => $date,
						'q_totalvotes' => 0,
						'q_active' => 1,
						'q_expiry' => $exp,
						'q_multiple' => 0,
						'q_totalvoters' => 0,
						'q_protection' => $protect);

	$data['ans'] = array(
				'0' => array('a_id' => '','a_qid' => '','a_answer' => '','a_votes' => '','a_order' => '','view'=>1),
				'1' => array('a_id' => '','a_qid' => '','a_answer' => '','a_votes' => '','a_order' => '','view'=>1));

	$data['ans'] = array_pad($data['ans'],15,array('a_id' => '','a_qid' => '','a_answer' => '','a_votes' => '','a_order' => '','view'=>0));

	return $data;
}

//////////////////////////////////////////////////////////
// Подготовка данных для редактирования голосования после неудачного редактирования
function polls_manage_get_data_errors($fromForm)
{
	$data['ans'] = array();
	$data['no_expiry'] = $fromForm['qu']['q_expiry'] != 0 ? '' : 'checked="checked"' ;
	
	if($fromForm['id'] == '')
		$data['act'] = 'new';
	else
		$fromForm['act'] = 'edit';

	$data['qu'] = array('q_id' => $fromForm['id'],
						'q_question' => $fromForm['qu']['q_question'],
						'q_timestamp' => $fromForm['qu']['q_timestamp'],
						'q_totalvotes' => $fromForm['qu']['q_totalvotes'],
						'q_active' => 1,
						'q_expiry' => $fromForm['qu']['q_expiry'],
						'q_multiple' => 0,
						'q_totalvoters' => 0,
						'q_protection' => $fromForm['qu']['q_protection']);
	
	foreach($fromForm['ans'] as $ans)
	{
		$data['ans'][] = array(
						'a_id' => $ans['a_id'],
						'a_qid' => '',
						'a_answer' => $ans['a_answer'],
						'a_votes' => $ans['a_votes'],
						'a_order' => '',
						'view'=>1);
	}
	
	if(count($data['ans']) < 2 )
		$data['ans'] = array_pad($data['ans'],2,array('a_id' => '','a_qid' => '','a_answer' => '','a_votes' => '','a_order' => '','view'=>1));

	$data['ans'] = array_pad($data['ans'],15,array('a_id' => '','a_qid' => '','a_answer' => '','a_votes' => '','a_order' => '','view'=>0));

//pr($fromForm);
//pr($data);

	return($data);
}
?>
