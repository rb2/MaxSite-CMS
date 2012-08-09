<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * MaxSite CMS
 * (c) http://maxsite.org/
 * Класс для формирования thumb-изображений
 * указывается url входящего изображения
 * на выходе url нового изображения
 
			require_once(getinfo('template_dir') . 'stock/thumb/thumb.php');
			
			// адрес должен быть в uploads!!!
			$img = 'http://сайт/uploads/файл';
			
			// первый параметр - адрес сайта 
			// второй постфикс для нового файла
			$t = new Thumb($img, '-205-145');
			
			if ($t->init === true) // уже есть готовое изображение в кэше
			{
				$new_img = $t->new_img; // сразу получаем новый адрес
			}
			elseif($t->init === false) // входящий адрес ошибочен
			{
				$new_img = false; // ошибка
			}
			else
			{	
				// работаеаем с изображением
				
				# $t->resize(205); // пропорциональное изменение по ширине
				
				# $t->resize(0, 145); // пропорция по высоте
				
				# $t->resize(205, 145); // точный размер
				
				# $t->crop(205, 145); // обрезка ширина - высота - от левого верхнего угла
				
				# $t->crop(205, 145, 30, 50); // смещение по x=30 y=50
				
				# $t->crop_center(205, 145); // кроп по центру
				
				# $t->resize_crop(205, 145); // вначале уменьшение по ширине, после обрезка от верхнего угла
				
				# $t->resize_crop(205, 145, 30, 50); // со смещением
				
				# $t->resize_crop_сenter(205, 145); // уменьшение по ширине, после кроп по центру
				
				$new_img = $t->new_img; // url-адрес готового изображения
			}

			unset($t); // удалим созданный объект
			
			if ($new_img)
			{
				// адрес нового изображения
			}

*/


class Thumb 
{
	protected $file = ''; // исходный файл относительно uploads
	protected $new_file = ''; // конечный файл относительно uploads
	
	var $new_img = ''; // конечный url полный

	protected $image_info = array(); // информация об изображении

	var $init = ''; // возврат при инициализации
		// true - есть готовое новое изобаржение (в кэше)
		// false - ошибка 
		// всё остальное - можно сделать 

	
	function __construct($url, $postfix = '-thumb', $replace_file = false)
	{
		// проверим входящий url
		if (strpos($url, getinfo('uploads_url')) === false) 
		{
			// входящий адрес чужой
			$this->init = false;
			return;
		}
		
		// файл и путь файла относительно uploads
		$this->file = str_replace(getinfo('uploads_url'), '', $url);
		
		// расширение файла
		$ext = substr(strrchr($this->file, '.'), 1);
		
		if (!in_array($ext, array('jpg', 'jpeg', 'png', 'gif')))
		{
			$this->init = false; // если это не картинка, то выходим
			return;
		}
		
		// теперь только имя без расширения
		$name = substr($this->file, 0, strlen($this->file) - strlen($ext) - 1);
		
		// новое имя
		if (!$postfix) $postfix = '-thumb'; // проверим постфикс
		
		$this->new_file = $name . $postfix . '.' . $ext;
		
		// pr($name);
		
		// может новый файл уже есть?
		// нужно ли заменять уже существующий файл
		if (!$replace_file and file_exists(getinfo('uploads_dir') . $this->new_file))
		{
			// есть, отдаем его url
			$this->init = true;
			$this->new_img = getinfo('uploads_url') . $this->new_file;
			return;
		}
		
		// проверим картинка ли исходный файл
		$this->image_info = GetImageSize(getinfo('uploads_dir') . $this->file);

		if (!$this->image_info) 
		{
			$this->init = false; // это не изображение - ошибка
			return;
		}
		
		// сразу сформируем новый адрес
		$this->new_img = getinfo('uploads_url') . $this->new_file;
		
		// pr($this->new_img);
	}
	
	
	// пропорциональное уменьшение
	// если высота = 0, то она вычисляется автоматом. Аналогично и ширина
	function resize($width = 200, $height = 0, $file = false, $new_file = false)
	{
		$CI = & get_instance();
		$CI->load->library('image_lib');
		$CI->image_lib->clear();
		
		
		// функция может принимать произвольне файлы
		if ($file === false) $file = $this->file;
		if ($new_file === false) $new_file = $this->new_file;
		
		// параметры для image_lib - начальные
		$r_conf = array(
				'source_image' => getinfo('uploads_dir') . $file,
				'new_image' => getinfo('uploads_dir') . $new_file,
				'maintain_ratio' => false, // размеры по пропорции вычислим сами
			);
		
		// пропорции
		$image_info = GetImageSize(getinfo('uploads_dir') . $file); // информация о файле исходном
		
		// если задана только ширина, то высоту расчитываем пропорцей от исходного файла
		if ($height === 0)
		{
			//$image_info[0] - ширина  $image_info[1] - высота
			$ratio = $image_info[0] / $image_info[1]; // w/h
			$height = ceil($width / $ratio);
		}
		
		// аналогично расчитываем ширину, если она = 0
		if ($width === 0)
		{
			$ratio = $image_info[1] / $image_info[0]; // h/w
			$width = ceil($height / $ratio);
		}			
		
		$r_conf['width'] = $width;
		$r_conf['height'] = $height;
		
		$CI->image_lib->initialize($r_conf);
		
		if (!$CI->image_lib->resize()) return false; // произошла какая-то ошибка
		
		# $this->preview(); // сделаем превьюшку 100х100 в _mso_i - а нужно ли?
		
		return getinfo('uploads_url') . $new_file;
	
	}
	
	// кроп 
	// x и y - точка координат от верхнего левого угла
	function crop($width = 0, $height = 0, $x = 0, $y = 0, $file = false, $new_file = false)
	{
		$CI = & get_instance();
		$CI->load->library('image_lib');
		$CI->image_lib->clear();
		
		if ($file === false) $file = $this->file;
		if ($new_file === false) $new_file = $this->new_file;
		
		// параметры для image_lib - начальные
		$r_conf = array(
				'source_image' => getinfo('uploads_dir') . $file,
				'new_image' => getinfo('uploads_dir') . $new_file,
				'maintain_ratio' => false, // размеры по пропорции вычислим сами
			);
		
		$r_conf['x_axis'] = $x;
		$r_conf['y_axis'] = $y;
		
		if ($width > 0) $r_conf['width'] = $width;
		if ($height > 0) $r_conf['height'] = $height;
		
		$CI->image_lib->initialize($r_conf);
		
		if (!$CI->image_lib->crop()) return false; // произошла какая-то ошибка
		
		return getinfo('uploads_url') . $new_file;
	}

	
	// кроп по центру изображения 
	function crop_center($width = 0, $height = 0)
	{
		$x = round($this->image_info[0] / 2 - $width / 2);
		$y = round($this->image_info[1]/ 2 - $height / 2);
		
		return $this->crop($width, $height, $x, $y);
	}
	
	
	// вначале пропорциональная ширина
	// после обрезка кроп до указанных размеров
	function resize_crop($width = 0, $height = 0, $x = 0, $y = 0)
	{
		$this->resize($width, 0);
		return $this->crop($width, $height, $x, $y, $this->new_file, $this->new_file);
	}
	
	// вначале пропорциональная ширина
	// после обрезка кроп до указанных размеров по центру
	function resize_crop_сenter($width = 0, $height = 0)
	{
		$this->resize($width, 0);
		
		$image_info = GetImageSize(getinfo('uploads_dir') . $this->new_file);
		$x = round($image_info[0] / 2 - $width / 2);
		$y = round($image_info[1]/ 2 - $height / 2);
		
		return $this->crop($width, $height, $x, $y, $this->new_file, $this->new_file);
	}	
	
	# функция готовит превьюшку в _mso_i 
	function preview()
	{
		// возможно файл в подкаталоге
		$e = strrpos($this->new_file, '/');
		
		if ($e !== false)
			$n = substr($this->new_file, $e+1); // вычлиним только имя
		else
			$n = $this->new_file;
		
		$prev_file = str_replace($n, '_mso_i/' . $n, $this->new_file);
		
		$CI = & get_instance();
		$CI->load->library('image_lib');
		$CI->image_lib->clear();
		
		// параметры для image_lib - начальные
		$r_conf = array(
				'source_image' => getinfo('uploads_dir') . $this->file,
				'new_image' => getinfo('uploads_dir') . $prev_file,
				'maintain_ratio' => false, // размеры по пропорции вычислим сами
				'width' => 100,
				'height' => 100
			);
			
		$CI->image_lib->initialize($r_conf);
		$CI->image_lib->resize();
	}
	
	
} // end  class Thumb 


// вспомогательные функции для использования в шаблоне
function thumb_generate($img, $width, $height, $def_img = false, $replace_file = false)
{
	// указана картинка, нужно сделать thumb заданного размера
	if ($img) 
	{
		$t = new Thumb($img, '-' . $width . '-' . $height, $replace_file);
		
		if ($t->init === true) // уже есть готовое изображение в кэше
		{
			$img = $t->new_img; // сразу получаем новый адрес
		}
		elseif($t->init === false) // входящий адрес ошибочен
		{
			$img = false; // ошибка
		}
		else
		{	
			// получаем изображение
			// уменьшение по ширине, после кроп по центру
			$t->resize_crop_сenter($width, $height);
			
			$img = $t->new_img; // url-адрес готового изображения
		}
	}
	else // у записи не укажано метаполе, ставим дефолт 
	{
		$img = $def_img;
	}
	
	return $img;
}

# end file