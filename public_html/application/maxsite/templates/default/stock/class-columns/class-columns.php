<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://maxsite.org/
 * Класс для формирования колонок
 
	1 4 7
	2 5 8
	3 6

	# 1-й рабочий пример
	# автоматическое формирование колонок
	
	// в $pages - массив записей
	$pages = array(1,2,3,4,5,6,7,8); // например так
	
	// подключение библиотеки 
	require_once(getinfo('template_dir') . 'stock/class-columns/class-columns.php');
			
	// инициализация на 3 колонки
	$my_columns = new Columns(3, count($pages));

	foreach ($pages as $page)
	{
		// вывод внутри цикла 
		// можно указать дополнительный css-класс колонки
		// второй параметр css-style 
		$my_columns->out('left', 'width: 50%');
		
		pr($page);
		
		// следующая итерация
		$my_columns->next();
	}
	
	// завершение вывода
	$my_columns->close();
	unset($my_columns); // удалим переменную
	
	
	
	# 2-й пример
	# ручное формирование двух колонок
	
	$my_columns = new Columns;
	
	$my_columns->new_col('left w50'); // старт колонки
	
		$pages = array(...); // массив записей
		... вывод записей клонки ... 
	
	$my_columns->end_col(); // конец колонки
	
	
	$my_columns->new_col('left w50'); // старт колонки
	
		$pages = array(...); // массив записей
		... вывод записей клонки ... 
	
	$my_columns->end_col(); // конец колонки
	
	$my_columns->close(); // закрыть колонки 
	
	unset($my_columns); // удалим переменную
	
	
	# html и css-классы колонок на примере 3 колонок

	div.columns
		
		div.column (+ указанные классы в out) column-1 column-1-of-3 column-first
			div.column-content
				содержимое блока
			/div
		/div
		
		div.column (+ указанные классы в out) column-2 column-2-of-3
			div.column-content
				содержимое блока
			/div
		/div		
		
		div.column (+ указанные классы в out) column-3 column-3-of-3 column-last
			div.column-content
				содержимое блока
			/div
		/div
		
	/div
	
	<div class="clearfix"></div>

	
# css/less-стили для колонок

@col_padding: 15px; // растояние между колонками

div.columns {
	margin-right: -@col_padding;
}

div.column-content {
	margin-right: @col_padding;
	
	.border(silver); // можно добавить рамку
	padding: 0 5px; // и отступ
}


*/


class Columns 
{
	protected $cols_count = 3; // количество колонок
	protected $pages_count = 1; // всего количество записей
	protected $cut = 1; // кол-во записей в одной колонке
	protected $_echo = true; // выводить данные по echo - иначе return
	protected $cut_i = 1; // номер записи в колонке
	protected $cut_num_col = 1; // номер колонки
	protected $cut_close_div = false; // признак закрытого DIV
	
	function __construct($cols_count = 3, $pages_count = 1, $_echo = true)
	{
		// запомним
		$this->cols_count = $cols_count;
		$this->pages_count = $pages_count;
		
		// режим вывода
		$this->_echo = $_echo;
		
		// вычислим
		$this->cut = ceil($pages_count/$cols_count); // кол-во записей в одной колонке
		
		// основной контейнер
		if ($this->_echo) echo '<div class="columns">';
				else return '<div class="columns">';

	}
	
	// вывод внутри цикла
	function out($class = 'left', $style = '')
	{
		if ($this->cut_i == 1)
		{
			$this->cut_close_div = false;
			
			if ($style) $style = ' style="' . $style . '"';
			
			$out = NR . '<div class="' . $class 
					. ' column column-' . $this->cut_num_col
					. ' column-' . $this->cut_num_col . '-of-' . $this->cols_count
					. ( ($this->cut_num_col == 1) ? ' column-first':'' ) 
					. ( ($this->cut_num_col == $this->cols_count) ? ' column-last':'' ) 
					. '"' 
					. $style . '>'
					. '<div class="column-content">';
					
			if ($this->_echo) echo $out;
				else return $out;
		}
	}
	
	// следующая итерация
	function next()
	{
		$this->cut_i++;

		if ($this->cut_i > $this->cut)
		{
			$this->cut_i = 1;
			$this->cut_close_div = true;
			$this->cut_num_col++;

			if ($this->_echo) echo '</div></div>' . NR;
				else return '</div></div>' . NR;
		}
	}
	
	// завершение вывода колонок
	function close()
	{
		if (!$this->cut_close_div) 
		{
			// незакрытый div left
			if ($this->_echo) echo '</div></div>' . NR;
				else return '</div></div>' . NR;
		}
		
		// основной контейнер
		if ($this->_echo) echo '</div>' . NR;
				else return '</div>' . NR;
				
		$this->clearfix(); // подчистка float
	}
	
	// можно задать старт новой колонки явно
	function new_col($class = 'left', $style = '')
	{
		$this->cut_close_div = true; // флаг, чтобы не ставить лишний div в close()
		
		if ($style) $style = ' style="' . $style . '"';
			
		$out = NR . '<div class="' . $class 
				. ' column"' 
				. $style . '>'
				. '<div class="column-content">';
				
		if ($this->_echo) echo $out;
			else return $out;
	}
	
	
	// можно задать конец колонки явно
	function end_col()
	{
		if ($this->_echo) echo '</div></div>' . NR;
				else return '</div></div>' . NR;
	}	
	
	
	// подчистка float
	function clearfix()
	{
		if ($this->_echo) echo '<div class="clearfix"></div>' . NR;
				else return '<div class="clearfix"></div>' . NR;
	}	
	
} // end  class Columns 

# end file