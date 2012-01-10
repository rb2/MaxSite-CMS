Здесь могут находиться произвольные скрипты для использования в шаблоне. 
Каждый скрипт в своем подкаталоге.


Подключать вручную, например так:

	if (file_exists(getinfo('template_dir') . 'stock/myscript/myscript.php')) 
			require(getinfo('template_dir') . 'stock/myscript/myscript.php');


Подключение стилей или js возможно в HEAD-секции (custom/head.php):

	# вывод css-кода из указанного файла в <style>
	mso_out_css_file('stock/myscript/myscript.css');

	# подключение внешнего js или css-файла 
	mso_add_file('stock/myscript/myscript.css');
	mso_add_file('stock/myscript/myscript.js');
