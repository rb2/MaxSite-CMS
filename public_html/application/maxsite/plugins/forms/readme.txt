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



type_text = url
type_text = email
type_text = password
type_text = search
type_text = search
type_text = number

placeholder = Подсказка для поля


