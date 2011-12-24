Пример формы:


[form]
    [email=mylo@sait.com]
    [redirect=http://site.com/]
    [subject=Моя форма]
    [ushka=ушка, которая выведется после формы]

    [field]
        require = 1   
        type = select
        description = Выберите специалиста
        values = Иванов # Петров # Сидоров
        default = Иванов
        tip = Подсказка к полю
    [/field]

    [field]
        require = 0   
        type = text
        description = Ваш город
        tip = Указывайте вместе со страной
        value = значение по-умолчанию
        attr = class="gorod" (атрибуты поля)
    [/field]

    [field]
        require = 1
        type = textarea
        description = Ваш вопрос
    [/field]
[/form]


Для оформления можно использовать стили в шаблоном css, например:

/* plugin FORMS */
div.forms {margin: 10px 0;}
div.forms div {margin: 5px 0 15px 0; }
div.forms div.break {height: 0; padding: 0; margin: 0; clear: both; }
div.forms span {display: block; float: left; text-align: right; width: 120px; padding: 0 10px 0 0;}
div.forms div.tip {margin-left: 130px; font-style: italic; font-size: 0.8em;}
div.forms input, div.forms select, div.forms textarea {width: 300px;}
div.forms textarea {height: 100px;}
div.forms input.forms_checkbox {width: auto;}
div.forms input.forms_submit {width: auto;}
div.forms input.forms_reset {width: auto;}
div.forms-post h2 {color: red; font-size: 18pt; margin: 20px 0;}


