/*
 * MaxSite CMS 
 * Copyright http://max-3000.com/
 * mso-forms.less
 */


1. Форма имет класс .fform

2. Каждая строка формы - это <p>. Строка состоит из ячеек. Ячейка - это текст или 
	input, select, textarea, button.

3. Каждая ячейка строки это <span> или <label>. 
		Label использовать там, где нужно обрамить input или указать надпись
		Span использовать там, где label не нужен.

4. Ячейка label без input оформляется с атрибутом for на input в другой ячейке.

5. Класс span.ffirst или label.ffirst используется для первой ячейки. У него 
	задан фиксированный размер.
	
6. Класс span.ftitle или label.ftitle используется для оформления названия поля.

7. Класс span.fempty - пустая ячейка шириной 10px. Использовать для дополнительного 
	визуального разрыва между ячейками.

8. Класс span.fcenter и label.fcenter используется для выравнивания сожержимого ячейки по центру.

9. Класс span.ftop и label.ftop используются для верхнего выравнивания содержимого ячейки. 
	Используется для высоких ячеек.

10. Класс span.fsubmit и label.fsubmit используется для ячейки кнопки Submit.
	Размер 80px с правым выравниванием.

11. Класс span.nocell и label.nocell отменяет создание ячейки для указанного <span> и <label>.
	Для переносов используется <br> 

12. Класс span.fhint и label.fhint используются для ячейки подсказки.
 

ПРИМЕР ФОРМЫ
----------------------------------------------------------------------------------
 

<form class="fform" style="width: 600px">
<fieldset>
<legend>Пример формы</legend>

<p>
	<span class="ffirst ftitle">Выбери:</span>
	<span>
		<select name="fields">
			<option selected="selected">Первый</option>
			<option>Второй</option>
			<option>Третий</option>
		</select>
	</span>
</p>
<hr>
<p>
	<span class="ffirst ftitle">Отметь:</span>
	<label><input type="checkbox"> Первый</label>
	<label><input type="checkbox"> Второй</label>
	<label><input type="checkbox"> Третий</label>
</p>
<p>
	<span class="ffirst"></span>
	<span class="fhint">Отметь и получи приз!</span>
</p>
<hr>
<p>
	<span class="ffirst ftitle">Выбери:</span>
	<label><input type="radio" name="switch_radio[]"> Первый</label>
	<label><input type="radio" name="switch_radio[]"> Второй</label>
	<label><input type="radio" name="switch_radio[]"> Третий</label>
	<label><input type="radio" name="switch_radio[]"> Четвертый</label>

</p>
<hr>
<p>
	<span class="ffirst ftitle ftop">Выбери:</span>
	
	<label class="ffirst nocell"><input type="radio" name="switch_radio2[]"> Первый</label>
	[br]<label class="ffirst nocell"><input type="radio" name="switch_radio2[]"> Второй</label>
	[br]<label class="ffirst nocell"><input type="radio" name="switch_radio2[]"> Третий</label>
</p>

<hr>

<p>
	<label class="ffirst ftitle" for="f-email">Email:</label>
	<span><input type="email" placeholder="Укажите свой email" id="f-email"></span>
	
	<span class="fempty"></span>
	<span class="fbutton"><button type="button">copy</button></span>

	<label class="ftitle" for="f-password">Пароль:</label>
	<span><input type="password" placeholder="Ваш пароль" id="f-password"></span>
</p>
<p>
	<label class="ftitle ffirst" for="f-site2">Сайт:</label>
	<span><input type="url" placeholder="Адрес сайта" id="f-site2"></span>

	<span class="fempty"></span>

	<label class="ftitle" for="f-name">Имя:</label>
	<span><input type="text" id="f-name" placeholder="Ваше имя"></span>
</p>

<p>
	<label class="ftitle ffirst" for="f-site1">Cайт:</label>
	<span><input type="url" id="f-site1"></span>
</p>

<p>
	<label class="ffirst ftitle ftop" for="f-text1">Ваш текст:</label>
	<span><textarea id="f-text1"></textarea></span>
</p>

<p>
	<span class="ffirst"></span>
	<span><input type="search" placeholder="Введите фразу для поиска"></span>
	<span class="fbutton"><input type="submit" value="Поиск"></span>
</p>

<hr>
 
<p>
	<span><input type="search" placeholder="Введите фразу для поиска"></span>
	<span class="fsubmit"><input type="submit" value="Поиск"></span>
</p>

<hr>

<p><label>Сайт:<input type="text"></label></p>

<p><label>Имя:<input type="text"></label></p>

<p><label>Ваш текст:<textarea></textarea></label></p>

<p><label><input type="checkbox"> Согласен с правилами</label></p> 

<p><span><input type="submit" value="Отправить"> <input type="reset" value="Сброс"></span></p>
 
</fieldset>
</form>