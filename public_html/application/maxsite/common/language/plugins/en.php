<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * Language file
 * (c) http://max-3000.com/
 * Author: (c) Wave
 * Author URL: http://wave.fantregata.com/
 * Update URL: http://wave.fantregata.com/page/work-for-maxsite
 */
 
$lang['Доступ запрещен'] = 'Access denied';
$lang['Сохранить изменения'] = 'Save changes';
$lang['Обновлено!'] = 'Update!';
$lang['Заголовок:'] = 'Header:';
$lang['Формат:'] = 'Format:';
$lang['Сортировка:'] = 'Sort:';
$lang['Обновлено!'] = 'Update!';
$lang['Админ-доступ к настройкам'] = 'Admin-allow access to options of';
$lang['Админ-доступ к настройкам '] = 'Admin-allow access to options of ';


# admin_ip
$lang['Обновлено! Обязательно сохраните секретный адрес сейчас!'] = 'Updated! Save secret URL <strong>now</strong>';
$lang['Admin IP'] = 'Admin IP';
$lang['Вы можете указать IP с которых разрешен доступ в админ-панель. Если пользователь попытается войти в панель управления с другого IP, то ему будет отказано в доступе.'] =
'You can specify IP, via which you allow access to admin-panel. If user try to login from other IP — he get access denied.';
$lang['На тот случай, если у администратора сменится IP, следует указать секретный адрес (URL), по которому можно очистить список разрешенных IP. Сохраняйте этот секретный адрес в надежном месте. В случае, если вы его забудете у вас не будет другой возможности, кроме как отключить плагин (удалить его файлы) или вручную исправить базу данных.'] =
'Upon that event if beside admin is changed IP, follows to indicate the secret address (URL), over which possible clear the list allowed(permitted) by IP. Save this secret address to reliable place. If and when you will forget beside it you will not be other possibility, except hang up plugin (delete(remove) its files or manually correct the database.';
$lang['Если секретный адрес не указан, то сбросить список будет невозможно.'] = 'If secret URL not setted, flush list is unpossible';
$lang['Если список IP пуст, то доступ в админ-панель разрешен с любого IP.'] = 'If list of IP is empty, access to admin-panel allowed via any IP';
$lang['Следует указывать только цифры и английские буквы. Другие символы не допустимы!'] = 'Only letters and numbers allowed.';
$lang['Текущий адрес:'] = 'Current URL';
$lang['Укажите разрешенные IP по одному в каждой строчке'] = 'List allowed IP — one over a line';
$lang['Ваш текущий IP:'] = 'Your current IP:';
$lang['Будьте внимательны! Обязательно указывайте свой текущий IP!'] = 'Be careful! Specify your current IP';
$lang['Админ-доступ к редактированию разрешенных IP'] = 'Admin access to editing list of IP';

# antispam
$lang['Админ-доступ к antispam'] = 'Admin access to antispam';
$lang['Антиспам'] = 'Antispam';
$lang['Для вашего IP комментирование запрещено!'] = 'Commenting denied from your IP';
$lang['Вы используете запрещенные слова!'] = 'You use disallowed words!';
$lang['С помощью этого плагина вы можете активно бороться со спамерами. Обратите внимание, что комментарии авторов публикуются без модерации.'] =
'Via this plugin you can struggle versus spammers. Attention: comments from authors are publishing without moderation';
$lang['Настройки'] = 'Settings';
$lang['Включить антиспам'] = 'Turn on antispam';
$lang['Вести лог отловленных спамов'] = 'Write log of spam';
$lang['Отправлять комментарий на модерацию, если в нем встречается, хоть одна ссылка.'] = 'Moderate comment, if it has any links.';
$lang['Файл для логов:'] = 'File for log';
$lang['Посмотреть'] = 'Show';
$lang['Черный список IP'] = 'Black list IP';
$lang['Укажите IP, с которых недопустимы комментарии. Один IP в одной строчке.'] = 'Store here IP adresses, comments from them are denied. One IP over one line.';
$lang['Черный список слов'] = 'Black list words';
$lang['Укажите слова, которые нельзя использовать в комментариях. Одно слово в одной строчке.'] = 'Indicate the word, which it is denied use in comments. One word at one line.';
$lang['Слова для модерации'] = 'Words for moderation';
$lang['Укажите слова, которые принудительно отравляют комментарий на премодерацию. Одно слово в одной строчке. Обратите внимание, что этот список проверяется только если пройдена проверка на Черные списки.'] =
'Indicate the word, which by force send comment to moderation. One word at one line. Attention that this list is inspected only if checking is passed for Blacklists.';
$lang['Номера комюзеров, которые всегда попадают в модерацию'] = 'Numbers of commusers, who always goes to moderation';
$lang['Укажите номера комюзеров, которые принудительно отравляют комментарий на премодерацию. Один номер в одной строчке. Обратите внимание, что этот список проверяется только если пройдена проверка на Черные списки.'] =
'Indicate the number an комюзеров, who by force send comments to moderation. One number at one line. Attention that this list is inspected only if checking is passed for Blacklists.';

# authors
$lang['Авторы'] = 'Authors';

# admin_announce
$lang['Админ-анонс'] = 'Admin-announce';
$lang['Позволяет на стартовой странице админки размещать… что-то.'] = 'Allow to store texts on main page of admin-panel.';
$lang['Текст на стартовой странице'] = 'Text on main page';
$lang['Введите текст (с html-оформлением), который должен быть на стартовой странице админки.'] = 'Input text (with html), which must be present on main page.';
$lang['Админ-доступ к административному анонсу'] = 'Admin access to «Admin-announce»';
$lang['Показывать на стартовой странице админки статистику'] = 'Show statistic on admin home';
$lang['Показывать статистику всем'] = 'Show statistic to all';
$lang['Если не отмечено, то показывается только для тех, кому разрешено редактировать «Админ-анонс»'] = 'If not checked, show only to people, who allowed to edit this options';
$lang['Учитывать страницы из будущего'] = 'Count statistic for future  pages';
$lang['Если не отмечено, то статистика считается для страниц с датой раньше текущей'] = 'If not checked, statistic showed only for pages, which dated earlier now';
$lang['Использовать редактор системы'] = 'Use system default editor';
$lang['Если отмечено, то используется визуальный редактор системы или подключенный плагин редактора. Иначе просто textarea и вывод не пропускается через балансировку тегов.'] = 'If checked, use system default visual editor or editor by editor-plugin.';
$lang['Дельта подсчёта (приблизительность максимальных и минимальных страниц.'] = 'Delta of count (aproximately maximum(peak) and minimum views of pages).';
$lang['Насколько близко по количеству просмотров к минимуму и максимуму должны быть страницы в отчёте.'] = 'How Aproximately must be statistic.';
$lang['Популярные страницы'] = 'Most viewed pages';
$lang['Средние'] = 'Average of pages views';
$lang['Непопулярные страницы'] = 'Least viewed pages';
$lang['просмотров: '] = 'viewed: ';
$lang['Просмотров'] = 'Viewed';
$lang['Заголовок'] = 'Title';
$lang['редактировать'] = 'edit';
$lang['Статистика'] = 'Statistics';
$lang['Дельта подсчёта: '] = 'Delta of count: ';
$lang['Всего опубликованных страниц: '] = 'Count of published pages: ';
$lang['Всего просмотров: '] = 'Count of views: ';
$lang['Максимум просмотров страницы: '] = 'Minimal viewed page';
$lang['Минимум просмотров страницы: '] = 'Maxsimal viewed page';
$lang['В среднем: '] = 'Average:';

#bbcode
$lang['Настройки плагина bbcode'] = 'Options of bbcode plugin';
$lang['Укажите необходимые опции.'] = 'Set needed options.';
$lang['Где использовать'] = 'Where to use';
$lang['Укажите, где должен работать плагин'] = 'Select, where plugin should to work';
$lang['1||На страницах #2||В комментариях #3||На страницах и в комментариях'] = '1||In pages #2||In comments #3||In pages and comments';
$lang['Конвертирует тэги BBCode в HTML. См.'] = 'Convert BBCode-tags to HTML. See';

# calendar
$lang['Календарь'] = 'Calendar';
$lang['Январь'] = 'January';
$lang['Февраль'] = 'February';
$lang['Март'] = 'March';
$lang['Апрель'] = 'April';
$lang['Май'] = 'May';
$lang['Июнь'] = 'June';
$lang['Июль'] = 'July';
$lang['Август'] = 'August';
$lang['Сентябрь'] = 'September';
$lang['Октябрь'] = 'October';
$lang['Ноябрь'] = 'November';
$lang['Декабрь'] = 'Desember';
$lang['Пн'] = 'monday';
$lang['Вт'] = 'tuesday';
$lang['Ср'] = 'wednesday';
$lang['Чт'] = 'thursday';
$lang['Пт'] = 'friday';
$lang['Сб'] = 'saturday';
$lang['Вс'] = 'sunday';

# captcha
$lang['Введите нижние символы'] = 'Input lower symbols';
$lang['Защита от спама: введите только нижние символы'] = 'Protection from spam';
$lang['(обязательно)'] = '(requried)';

# catclouds
$lang['Облако рубрик'] = 'Cat Clouds';
$lang['Мин. размер'] = 'Min. size';
$lang['Макс. размер'] = 'Max. size';
$lang['Номер рубрики:'] = 'Number of rubric:';
$lang['Начало блока:'] = 'Begin of block';
$lang['Конец блока:'] = 'End of block';
$lang['По количеству записей (обратно)'] = 'In count of pages (decr)';
$lang['По количеству записей'] = 'In count of pages';
$lang['По алфавиту'] = 'In alphabet';
$lang['По алфавиту (обратно)'] = 'In alphabet (decr)';

# category
$lang['Рубрики'] = 'Category';
$lang['Например:'] = 'Example:';
$lang['Формат текущей:'] = 'Format current:';
$lang['Например:'] = 'Example:';
$lang['Включить только:'] = 'Include only';
$lang['Укажите номера рубрик через запятую или пробел'] = 'List numbers of rubrics via over comma or space';
$lang['Исключить:'] = 'Exclude:';
$lang['Если нет записей:'] = 'If no pages:';
$lang['Отображать рубрику (количество записей ведется без учета опубликованности)'] = 'Show rubric (Count of pages disregarding publishing)';
$lang['Скрывать рубрику (количество записей ведется только по опубликованным)'] = 'Hide rubric (Count of pages to conduct only over published)';
$lang['По имени рубрики'] = 'In name of rubric';
$lang['По ID рубрики'] = 'In ID of rubric';
$lang['По выставленному menu order'] = 'In menu order';
$lang['Порядок:'] = 'Order';
$lang['Прямой'] = 'Direct';
$lang['Обратный'] = 'Inverse';
$lang['Включать потомков:'] = 'Include childrens';
$lang['Всегда'] = 'Always';
$lang['Только если явно указана рубрика'] = 'Only if rubric is obviously specified';

# comment_button
$lang['Полужирный'] = 'Bold';
$lang['Курсив'] = 'Italic';
$lang['Подчеркнутый'] = 'Underline';
$lang['Зачеркнутый'] = 'Striked';
$lang['Цитата'] = 'Cite';
$lang['Код'] = 'Code';
$lang['Код или преформатированный текст'] = 'Code or preformatted text';

# autoclose_tags

$lang['Автозакрытие тегов перед «катом»'] = 'Autoclosing tags before «cut»';
$lang['Плагин закрывает незакрытые теги.'] = 'Plugin closing tags, that opened, but not closed.';

# down_count
$lang['Админ-доступ к настройкам счетчика переходов (Download count)'] = 'Admin access to settings «Download count»';
$lang['Счетчик переходов'] = 'Download count';
$lang['Подсчет количества переходов по ссылке. Обрамите нужную ссылку в [dc]...[/dc]'] = 'Download count. Type over link [dc]...[/dc]';
$lang['Данная ссылка доступна только со <a href="%s">страниц сайта</a>'] = ' This link enabled only from <a href="%s">pages of site</a>';
$lang['Запрещен переход по этой ссылке с чужого сайта'] = 'Disallow refferer to this link from other sites';
$lang['Количество переходов'] = 'Count of downloading';
$lang['С помощью этого плагина вы можете подсчитывать количество скачиваний или переходов по ссылке. Для использования плагина обрамите нужную ссылку в код [dc]ваша ссылка[/dc]'] =
'By this plugin you can count the number of downloading or accrossing over reference. To use plugin write over necessary reference code [dc]your reference[/dc]';
$lang['Файл для хранения количества скачиваний:'] = 'File for store downloading count';
$lang['Префикс URL:'] = 'Prefix URL';
$lang['ссылка'] = 'Reference';
$lang['Запретить переходы с чужих сайтов'] = 'Disallow reference from other sites';
$lang['Выводить в title реальный адрес'] = 'Show real adress in title';
$lang['Статистика переходов'] = 'Statistic of reference';
$lang['переходов'] = 'Reference';

# editor_dumb
$lang['Ссылка'] = 'Link';
$lang['Картинка'] = 'Image';
$lang['Отрезать текст'] = 'Cut text';

# events
$lang['События'] = 'Events:';
$lang['Формат даты:'] = 'Date format:';
$lang['Как это <a href="http://ru.php.net/date" target="_blank">принято в PHP</a>'] = 'As <a href="http://php.net/date" target="_blank">in php</a>';
$lang['Указывайте по одному событию в каждом абзаце в формате:'] = 'One event in one line:';
$lang['<strong>дата</strong> в формате yyyy-mm-dd'] = '<strong>Date</strong> in format yyyy-mm-dd';
$lang['<strong>до</strong> - выводить событие до наступления N-дней'] = '<strong>Before</strong> — show notise before events N-days';
$lang['<strong>после</strong> - выводить событие после прошествия N-дней'] = '<strong>After</strong> — show notice after events N-days';
$lang['<strong>В тексте события</strong> можно использовать HTML'] = '<strong>In text<strong> html allowed';
$lang['<strong>ПРИМЕР:</strong> 2008-09-01 | 3 | 1 | Пора в школу!'] = '<strong>Example:</strong> 2008-09-01 | 3 | 1 | Go to school!';
$lang['Понедельник'] = 'Monday';
$lang['Вторник'] = 'Tuesday';
$lang['Среда'] = 'Wednesday';
$lang['Четверг'] = 'Thursday';
$lang['Пятница'] = 'Friday';
$lang['Суббота'] = 'Saturday';
$lang['Воскресенье'] = 'Sunday';
$lang['января'] = 'january';
$lang['февраля'] = 'february';
$lang['марта'] = 'march';
$lang['апреля'] = 'april';
$lang['мая'] = 'may';
$lang['июня'] = 'june';
$lang['июля'] = 'july';
$lang['августа'] = 'august';
$lang['сентября'] = 'september';
$lang['октября'] = 'october';
$lang['ноября'] = 'november';
$lang['декабря'] = 'desember';
$lang['янв'] = 'jan';
$lang['фев'] = 'feb';
$lang['мар'] = 'mar';
$lang['апр'] = 'apr';
$lang['май'] = 'may';
$lang['июн'] = 'jun';
$lang['июл'] = 'jul';
$lang['авг'] = 'aug';
$lang['сен'] = 'sep';
$lang['окт'] = 'okt';
$lang['ноя'] = 'nov';
$lang['дек'] = 'dec';

# faq
$lang['К списку'] = 'To list';

# favorites
$lang['Избранное'] = 'Favorites';
$lang['Ссылки:'] = 'Links';
$lang['Указывайте по одной ссылке в каждом абзаце в формате: <strong>тип/ссылка | название</strong>'] = 'Indicate over one reference at every line in format: <strong>type/reference | title</strong>';
$lang['<strong>тип/ссылка</strong> - указывается от адреса сайта, например'] = '<strong>type/link</strong> — is indicated from address of the site, for instance';
$lang['Для главной страницы укажите: <strong> / | Главная</strong>'] = 'For Home pages use: <strong> / | Main</strong>';

# feedburner
$lang['Админ-доступ к feedburner'] = 'Admin access to feedburner';
$lang['Адрес вашего фида в FeedBurner.com:'] = 'URL of Your feed in FeedBurner.com';
$lang['Плагин FeedBurner'] = 'Plugin FeedBurner';
$lang['Плагин выполняет перенаправление вашего основного rss на сервис feedburner.com.'] = 'Plugin redirect your rss to feedburner.com service.';

# feedburner_count
$lang['Настройка FeedBurner Count от samborsky.com'] = 'Settings of FeedBurner Count by samborsky.com';
$lang['Ошибка!'] = 'Error!';
$lang['Настройка FeedBurner Count от <a href="http://www.samborsky.com/">samborsky.com</a>'] = 'Settings of FeedBurner Count by <a href="http://www.samborsky.com/">samborsky.com</a>';
$lang['Здравствуйте, последний раз счетчик обновлялся'] = 'Hello. Last counter update';
$lang['Последнее показание счетчика:'] = 'Last counter value:';

# feedcount
$lang['Виджет подсчета подписчиков RSS'] = 'Vidget of counting of RSS subscribers';
$lang['Сегодня:'] = 'Today';
$lang['Вчера:'] = 'Yesterday:';
$lang['[COUNT] - подписчиков сегодня, [COUNTOLD] - подписчиков вчера'] = '[COUNT] - subscribers today, [COUNTOLD] - subscribers yesterday';

# forms
$lang['Неверный email!'] = 'Wrong e-mail';
$lang['Привет роботам! :-)'] = 'Hello, robots! :-)';
$lang['Заполните все необходимые поля!'] = 'Fill all nessesary fields!';
$lang['Вами отправлено сообщение:'] = 'You send mail:';
$lang['Ваше сообщение отправлено!'] = 'Your mail sent!';
$lang['Ваше имя*'] = 'Your name*';
$lang['Ваш email*'] = 'Your e-mail';
$lang['Защита от спама:'] = 'Spam protection';
$lang['Отправить копию письма на ваш e-mail'] = 'Send copy of mail to your e-mail';
$lang['Отправить'] = 'Send';
$lang['Очистить форму'] = 'Reset';

# last_comments
$lang['Последние комментарии'] = 'Last comments';
$lang['Количество:'] = 'Count:';
$lang['Количество слов:'] = 'Count of words:';
$lang['Количество символов в одном слове:'] = 'Counts of symbols in one word:';
$lang['Комментатор'] = 'Commuser';

# last_pages
$lang['Вывод последних записей'] = 'Show last pages';
$lang['Последние записи'] = 'Last pages';
$lang['Формат даты:'] = 'Date format:';
$lang['Формат комментариев:'] = 'Comments format:';
$lang['Тип страниц:'] = 'Page type:';
$lang['Исключить рубрики:'] = 'Exclude rubrics:';
$lang['Включить рубрики:'] = 'Include rubrics:';
$lang['Сортировка:'] = 'Sorting:';
$lang['Порядок сортировки:'] = 'Order of sorting:';
$lang['По дате'] = 'In date';
$lang['По алфавиту'] = 'In alphabet';
$lang['Прямой'] = 'Direct';
$lang['Обратный'] = 'Inverse';
$lang[' - комментариев: '] = ' — comments: ';

# links
$lang['Ссылки'] = 'Links';
$lang['Указывайте по одной ссылке в каждом абзаце в формате:'] = 'One link in one line in format:';
$lang['обрамить ссылку в noindex, если не нужно - указать пробел'] = 'Link in noindex. If no need — input space';
$lang['открыть ссылку в новом окне, если не нужно - указать пробел'] = 'Link in new window. If no need — input space';

# login_form
$lang['Форма логина'] = 'Login form';
$lang['Привет,'] = 'Hello';
$lang['выйти'] = 'Logout';
$lang['управление'] = 'Admin-panel';
$lang['своя страница'] = 'Own page';
$lang['Логин (email):'] = 'Login (e-mail)';
$lang['Пароль:'] = 'Password:';

# multipage

$lang['Multipage'] = 'Multipage';
$lang['Плагин разбивает длинные тексты постов на несколько страниц. Разделитель задаётся в настройках. Для вывода навигации нужен плагин типа Pagination.'] = 'Plugin breaks up long texts of posts on a several pages. A delimiter is set in options. For the output of navigation needed plugin like «Pagination».';
$lang['Разделитель страниц'] = 'Delimiter of pages';
$lang['Разделитель страниц в тексте: [pagebreak], &lt;!-- Page break --&gt; или как вам будет угодно.'] = 'Delimiter of pages in text: [pagebreak], &lt;!-- Page break --&gt; or as you wish.';
$lang['«Next» в ссылках'] = '«Next» in urls';
$lang['«Next» в ссылках http://site.com/page/slug/next/2 — например: next, page, pageid.'] = '«Next» in urls http://site.com/page/slug/next/2 — example: next, page, pageid.';
$lang['Обрабатывать тексты на главной, в категориях и т.п.'] = 'Process texts on home, in categories etc.';
$lang['Если не обрабатывать, тексты выводятся только до первого разделителя. Иначе разделитель нужно ставить после [cut] или в виде html-комментария.<br>Не обрабатывать — экономней по ресурсам.'] = 'If not to process, texts hatch only to the first delimiter. Otherwise a delimiter needs to be put after [cut] or in a kind html-comment.<br>Not to process — economy on resources.';
$lang['0||Не обрабатывать # 1||Удалять разделители # 2||Выводить до первого разделителя'] = '0||Do not process # 1||Delete delimiters # 2||Show before first delimiter';
$lang['Автоматически закрывать теги на страницах'] = 'Automaticaly close tags on pages';
$lang['Плагин сам закрывает те теги, которые разбивает разделитель, и тем самым спасает от глюков с сайдбарами и т.п.. Экономней делать это вручную, а опцию отключить.'] = 'Plugin close tags, breaked by [pagebreak]. This prevert bugs with sidebars, etc.. You can do it manualy and disable this option.';
$lang['Показывать меню настройки плагина в админке'] = 'Show menu of options of this plugin in admin area of site';
$lang['Выводить листалку над текстом'] = 'Show pagination before page';
$lang['Выводить листалку под текстом'] = 'Show pagination after page';
$lang['Текст перед листалкой'] = 'Text before pagination';
$lang['Если вы хотите предварить листалку текстом или обернуть в какие-то теги.'] = 'If you want to anticipate pagination text or to turn in some tags.';
$lang['Текст после листалки'] = 'Text after pagination';
$lang['А здесь теги закрываются.'] = 'Here tags closed.';
$lang['Настройки плагина «Multipage»'] = 'Options of plugin «Multipage»';
$lang['Укажите необходимые опции.'] = 'Store your options.';

# page_comments
$lang['Самое комментируемое'] = 'Most commented';
$lang['Количество записей:'] = 'Count of pages';
$lang['Формат:'] = 'Format:';
$lang['название записи'] = 'Title of page';
$lang['количество комментариев'] = 'Count of comments';
$lang['ссылка'] = 'link';

# page_parent
$lang['Родительские/дочерние страницы'] = 'Parent/child pages';
$lang['Номер страницы:'] = 'Number of page:';

# page_views
$lang['Виджет «Самое читаемое»'] = 'Widget «Most reading»';
$lang['Самое читаемое'] = 'Most reading';
$lang['Тип записей:'] = 'Pages type:';
$lang['просмотров в день'] = 'Viewed in day';
$lang['всего просмотров'] = 'All viewes';
$lang['Просмотров в сутки: '] = 'Views a day: ';

# pagination
$lang['Первая'] = 'First';
$lang['предыдущая'] = 'prev';
$lang['следующая'] = 'next';
$lang['последняя'] = 'Last';

# perelink

$lang['Перелинковка страниц'] = 'Page crosslinking';
$lang['Плагин для внутренней прелинковки страниц путем анализа наиболее часто встречающихся слов.'] = 'Plugin for crosslinking pages by analysis most of often meetings words.';

# perelink - index.php
$lang['Доступ к настройкам «perelinks»'] = 'Access to options «perelinks» plugin';
$lang['Количество внутренних ссылок'] = 'Amount of internal links';
$lang['Количество внутренних ссылок на одной странице (ссылаться не больше чем на х страниц. 0 — без ограничений).'] = 'Amount of internal links on one page (links not more, than on n pages. 0 — without limitations)';
$lang['Ограничение вхождений слов'] = 'Limitation of including of words';
$lang['0 — без ограничений. 1 — только первое одинаковое слово делать ссылкой. Дальнейшее не реализовано.'] = '0 — without limitations. 1 — only the first identical word reference. More is not realized.';
$lang['Ссылаться ли на более поздние записи'] = 'Links only to more early records';
$lang['Если отмечено, ссылаемся на любые записи кроме как из будущего. Иначе только на записи с более ранней датой, чем текущая запись.'] = 'If checked — links to pages with any date not from future. If not checked — links to pages with date more earlier, than current page.';
$lang['Стоп-слова'] = 'Stop-words';
$lang['Список слов через пробел, которые не будут становиться ссылками.'] = 'List of words through a blank, which will not become links.';
$lang['Плагин perelinks'] = 'Perelinks plugin';

# perelink - admin.php
$lang['С помощью этого плагина вы можете сделать настраиваемую внутреннюю перелинковку.'] = 'Plugin for crosslinking pages by analysis most of often meetings words.';

# random_gal
$lang['Галерея'] = 'Gallery';
$lang['Галерея:'] = 'Gallery:';
$lang['Количество:'] = 'Count:';
$lang['CSS-cтиль блока:'] = 'CSS-style of block:';
$lang['CSS-cтиль img:'] = 'CSS-style of img:';
$lang['Свой HTML-блок:'] = 'Your HTML-block:';

# random_pages
$lang['Случайные статьи'] = 'Random pages';
$lang['Тип страниц:'] = 'Type of page';

# randomtext
$lang['Цитаты'] = 'Quotes';
$lang['Цитата'] = 'Quote';

# rater
$lang['Рейтинг страниц'] = 'Rating of pages';
$lang['Голосов:'] = 'Votes:';
$lang['Текущая оценка:'] = 'Current rater:';
$lang['название записи'] = 'title of page';
$lang['всего голосов'] = 'All votes';
$lang['общий бал (деление общего рейтинга на кол-во голосов) - округлен до целого'] = 'general ball (fission of the general rating at amount voice) - is rounded to integer';
$lang['общий бал (дробный)'] = 'General ball (fractional)';
$lang['Общий бал:'] = 'General ball';
$lang['Вы уже голосовали!'] = 'You are already voted!';
$lang['Ваша оценка:'] = 'Your vote:';
$lang['Средняя оценка'] = 'Average rating';
$lang['из'] = 'from';
$lang['проголосовавших'] = 'voters';

#redirect
$lang['Редирект'] = 'Redirect';
$lang['Редиректы'] = 'Redirects';
$lang['С помощью этого плагина вы можете организовать редиректы со своего сайта. Укажите исходный и конечный адрес через «|», например:'] = 'By this plugin you can set redirects from your site. Write start and needed adress over «|», for example:';
$lang['При переходе к странице вашего сайта «http://mysite.com/about» будет осуществлен автоматический редирект на указанный «http://newsite.com/hello».'] = 'On requesting page «http://mysite.com/about» visitor will redirect to page «http://newsite.com/hello».';
$lang['Третьим параметром вы можете указать тип редиректа: 301 или 302.'] = 'Third param is type of redirect: 301 або 302';
$lang['Также можно использовать регулярные выражения.'] = 'Also you can use regexps.';

# search_form
$lang['Форма поиска'] = 'Search form';
$lang['Что искать?'] = 'What to find?';
$lang['Поиск'] = 'Search';
$lang['Текст подсказки:'] = 'Text of hint';
$lang['Текст на кнопке:'] = 'Text on button';
$lang['CSS-стиль текста:'] = 'CSS-style of text';
$lang['CSS-стиль кнопки:'] = 'CSS-style of button';

# sitemap
$lang['Воспользуйтесь картой сайта'] = 'Use sitemap';

# smtp_mail
$lang['SMTP mail'] = 'SMTP mail';
$lang['Плагин позволяет отправлять почту через SMTP сервер.'] = 'Plagin allows to send the mail via SMTP server.';
$lang['E-mail, с которого отправляем почту'] = 'E-mail, from which we send mail';
$lang['Зачастую, со стороннего SMTP сервера можно отправить почту только если адрес принадлежит именно этому серверу.<br>Если пусто — используется тот, что указан в настройках сайта.'] = 'Often possible to send the mail only if the address belong that server.<br>If emptily — is used that that is specified in options of the site.';
$lang['Протокол отправки'] = 'The mail sending protocol';
$lang['Для «smtp» укажите ниже SMTP хост, пользователя и пароль. Для «sendmail» укажите серверный путь к Sendmail.<br>Для «mail» планируются расширенные функции по сравнению со штатной возможностью системы.'] = 'For «smtp» write below SMTP host, user and password. For «sendmail» write the server path to Sendmail..<br>For «mail» extended functions are planned.';
$lang['Серверный путь к Sendmail.'] = 'The server path to Sendmail.';
$lang['Обычно это «/usr/sbin/sendmail»'] = 'May be «/usr/sbin/sendmail»';
$lang['SMTP host'] = 'SMTP host';
$lang['SMTP user'] = 'SMTP user';
$lang['SMTP pass'] = 'SMTP pass';
$lang['<b style="color: red;">Примечание:</b> пароль в базе данных хранится в открытом виде.'] = '<b style="color: red;">Attention:</b> password in database is stored not crypted.';
$lang['Может быть, например, 25, 2525 или 587.'] = 'May be 25, 2525 или 587.';
$lang['Настройки плагина «SMTP mail»'] = 'Option of «SMTP mail» plugin';
$lang['Укажите необходимые опции.'] = 'Indicate the required options.';
$lang['Складывать ли письма в <b>uploads</b>'] = 'Store mails in <b>uploads</b>';
$lang['Письма можно не только отправлять на почту, но и сохранять в каталог <b>uploads</b>, где их можно посмотреть даже если они не дошли на e-mail.'] = 'Letters possible not only to send to mail, but also save in catalogue(directory) <b>uploads</b>, where their possible read even though they not sent per e-mail.';
$lang['Каталог в <b>uploads</b>, куда складывать почту'] = 'Directory in <b>uploads</b>, where mails must be stored';
$lang['Каталог вы можете создать в разделе «Загрузки». Это может быть, например, <b>mail</b>.<br>Оставьте пустым, если хотите складывать письма в <b>uploads</b>.'] = 'The Catalogue(Directory) you may create in «Upoading». It may be, for instance, <b>mail</b>.<br>Leave empty if you want to store letters in <b>uploads</b>.';
$lang['Отправлять письма на e-mail'] = 'Send mails to e-mail';
$lang['Если письма сохраняются в каталог <b>uploads</b> или просто нужно отключить отправку на e-mail, снимите галочку здесь.'] = 'If mails is saved to <b>uploads</b> or you need to disable sending mails to e-mail, uncheck this option.';

#  spoiler - admin
$lang['Настройки плагина Spoiler'] = 'Options for Spoiler plugin';
$lang['<p>С помощью этого плагина вы можете скрывать текст под спойлер.<br>Для использования плагина обрамите нужный текст в код [spoiler]ваш текст[/spoiler]</p><p class="info">Также возможны такие варианты: <br>[spoiler=показать]ваш текст[/spoiler], [spoiler=показать/спрятать]ваш текст[/spoiler], [spoiler=/спрятать]ваш текст[/spoiler]</p>'] = 
'<p>Creates a Spoiler text-button that will show or hide text or images on post or comments.<br>To mark a text as spoiler, enclose the passage with <b>[spoiler]</b> and <b>[/spoiler].</b></p><p class="info">Examples: <br>[spoiler=show]text[/spoiler], [spoiler=show/hide]text[/spoiler], [spoiler=/hide]text[/spoiler]</p>';
$lang['Использовать спойлеры в комментариях'] = 'Use spoiler in comments';
$lang['Можно настроить какой текст появится в раскрытом виде'] = ' ';
$lang['Можно настроить какой текст появится в скрытом виде'] = 'You can write text, which will appear instead of hiden block';
$lang['Показать:'] = 'Show'; 
$lang['Спрятать:'] = 'Hide';
$lang['Скрыть'] = 'Hide';
$lang['Показать...'] = 'Show';
$lang['Стили лежат в следеющей папке: (.../plugins/spoiler/style/)'] = '(.../plugins/spoiler/style/)';
$lang['без стилей'] = 'without style';
$lang['Файл стилей:'] = 'Choose style file:';

# spoiler - info
$lang['Добавляет возможность прятать текст под спойлер.<br>(<b>[spoiler]...[/spoiler]</b>)'] = 
'With this plugin you can hide text. <br>(Using:<b>[spoiler]...[/spoiler]</b>)';

# tabs
$lang['Табы (закладки)'] = 'Tabs';
$lang['Табы:'] = 'Tabs:';
$lang['Указывайте по одному табу в каждом абзаце в формате: <strong>заголовок | виджет номер</strong>'] = 'Store one tab by one line in format: <strong>title | vidget number';
$lang['Например: <strong>Цитаты | randomtext_widget 1</strong>'] = 'Example: <strong>Quotes | randomtext_widget 1</strong>';
$lang['Для ушки: <strong>Цитаты | ушка_цитаты</strong>'] = 'For ushka: <strong>Quotes | ushka_quote</strong>';
$lang['Использовать:'] = 'Use:';
$lang['Виджет (функция и номер через пробел)'] = 'Vidget (func and number over space)';
$lang['Ушка (только название)'] = 'Ushka (title only)';

# tagclouds
$lang['Облако тэгов/меток'] = 'Tags cloud';
$lang['Мин. размер (%):'] = 'Min size (%):';
$lang['Макс. размер (%):'] = 'Max size (%);';
$lang['Макс. меток:'] = 'Max tags:';
$lang['Миним. меток:'] = 'Min tags:';
$lang['Отображать только метки, которых более указанного количества. (0 - без ограничений)'] = '';
$lang['Начало блока:'] = 'Begin of block:';
$lang['Конец блока:'] = 'End of block:';
$lang['Сортировка:'] = 'Sorting:';
$lang['По количеству записей (обратно)'] = 'By count (reverse)';
$lang['По количеству записей'] = 'By count';
$lang['По алфавиту'] = 'By alphabet';
$lang['По алфавиту (обратно)'] = 'By alphabet (reverse)';

# text_block
$lang['Текстовый блок'] = 'Text block';
$lang['Текст:'] = 'Text:';
$lang['Тип:'] = 'Type:';
$lang['HTML или текст'] = 'HTML or text';
$lang['Можно использовать HTML-тэги. Если тип PHP, то код должен выполняться без ошибок!'] = 'Can use html-tags. If php — must be no errors!';

# twitter
$lang['Мой Twitter'] = 'My Twitter';
$lang['Адрес:'] = 'Url:';
$lang['Количество записей:'] = 'Pages:';
$lang['Формат вывода:'] = 'Output format:';
$lang['Формат даты:'] = 'Date format:';
$lang['Количество слов:'] = 'Words:';

# top_commentators

$lang['Активные комментаторы'] = 'Top commentators';
$lang['Заголовок:'] = 'Header:';
$lang['Формат:'] = 'Format:';
$lang['Комментатор'] = 'Commentator';
$lang['Возможные подстановки:'] = 'Possible replacements:';
$lang['Количество комментаторов:'] = 'Count of commentators:';
$lang['За сколько дней учитывать комментарии:'] = 'For how many days count comments:';
$lang['Вывод списка самых активных комментаторов'] = 'Listing the most active commentators';

# ushki
$lang['Ушки'] = 'Ushki';
$lang['Админ-доступ к Ушкам'] = 'Administration Ushki';
$lang['С помощью ушек вы можете размещать произвольный html/php код в шаблоне, виджете или прочих плагинах. Ушки удобно использовать для вывода счетчика, рекламы и т.п. Просто создайте ушку, а потом укажите её имя в виджете или с помощью кода:'] =
'By means of ushka you may place free html/php code in(to;at) pattern(mold), vidget or other plugins. The Ear(Eye of needle;Tab) comfortable to use for(on;of;to;with) output of the counter, advertisments etc. Simply(Merely) create(produce) the ear(eye of needle;tab), but afterwards indicate her(its)(her) name(first name) in(to;at) виджете or by means of code:';
$lang['Вы можете вывести произвольную ушку прямо в тексте. Данный код выведет ушку «reklama»:'] = 'You may remove(bred;type-out;deduce) the free ear(eye of needle;tab) in(to;at) text straight(head-on). The Givenned code will remove(bred;type-out;deduce) the ear(eye of needle;tab) «reklam»:';
$lang['Ушка добавлена!'] = 'Ushka added';
$lang['Необходимо указать название ушки!'] = 'Need ushka title!';
$lang['Обновлено!'] = 'Renoved!';
$lang['Новая ушка:'] = 'New ushka:';
$lang['Добавить новую ушку'] = 'Create new ushku';
$lang['Удалить'] = 'Delete';
$lang['Сохранить изменения'] = 'Save';
$lang['Настройки ушек'] = 'Ushka settings';
$lang['Заголовок (блока):'] = 'Title (of block)';
$lang['Ушка (название):'] = 'Ushka (title):';

# wpconvert
# пока здесь, потом перенесу в каталог плагина
$lang['Админ-доступ к wpconvert'] = 'Admin access to wpconvert';
$lang['Угу, зщас... У тебя сайт накроется, кто отвечать будет?! В ЛЕС!!!'] = 'No!';
$lang['Файл:'] = 'File:';
$lang['Сайт:'] = 'Site:';
$lang['Ссылка:'] = 'Url:';
$lang['Все рубрики:'] = 'All rubrics:';
$lang['Всего записей:'] = 'Pages:';
$lang['Статус:'] = 'Status:';
$lang['Тип страницы:'] = 'Page type:';
$lang['Рубрики:'] = 'Rubrics:';
$lang['Метки:'] = 'Tags:';
$lang['Дата:'] = 'Date:';
$lang['Комментарии:'] = 'Comments:';
$lang['Новый slug:'] = 'New slug:';
$lang['Текст:'] = 'Text:';
$lang['Комментарии:'] = 'Comments:';
$lang['Готово! Проверка выполнена!<br>Предположительно запросов к БД будет:'] = '';
$lang['Измененных slug (url):'] = 'Changed slug (url)';
$lang['Всего записей:'] = 'Pages';
$lang['Всего комментариев:'] = 'Comments';
$lang['Что за ерунду ты мне подсовываешь? Файл-то пустой!'] = 'File empty';
$lang['Файл'] = 'File';
$lang['не найден! Загрузите его в каталог /uploads/ Можно через Загрузку.'] = 'Not found! Upload to /uploads/ folder';
$lang['Добавленные рубрики'] = 'Adding rubric';
$lang['Добавленные страницы'] = 'Adding page';
$lang['Готово! Конвертирование выполнено!'] = ' done!';
$lang['Готово! Конвертирование выполнено!'] = 'Convert done!';
$lang['Экспорт я рекомендую сделать частями так, чтобы размер одного файла не превышал 300-400Кб. При конвертировании это позволит уменьшить нагрузку на сервер, а также позволит обойти ограничения хостинга на время выполнения скриптов и максимальный размер файла. В итоге у вас получится несколько xml-файлов.'] =
'The Export I recommend to do(make) the parts so that size(amount) of one file did not exceed 300-400Кб. Under(Upon) конвертировании this(it) will allow to reduce the load on(upon;in;to;for;at;per;for) server, as well as will allow to avoid(get round) the restrictions(limits) хостинга for running time скриптов and maximum(peak) size(amount) of the file. In total beside(at;by) you are got(received) several xml-files.';
$lang['Перед конвертацией вам следует открыть каждый xml-файл в FireFox. Если браузер ругается на какие-то ошибки, то вам следует их исправить прямо в файле. К сожалению WordPress может неверно формировать xml-файл, но я постарался исправить ошибки в своем export-max.php.'] =
'Before конвертацией you should open each(every) xml-file in(to;at) FireFox. If браузер swears on(upon;in;to;for;at;per;for) some(any) errors, that you should their correct straight(head-on) in(to;at) file. Regrettably WordPress can(may;be able) untrue form(shape) xml-file, but I tried to correct the errors in(to;at) its export-max.php.';
$lang['Лишь только после того, как FireFox отобразит дерево элементов без ошибок, вы можете загрузить файл в каталог /uploads/. Можно через Загрузки.'] =
'Only not until FireFox will display(map;feature) the tree(wood) an element without error, you may load(boot;store) the file in(to;at) directory /uploads/. Possible through(across;via;over;in) Boot(Store).';
$lang['Перед началом конвертации нужно выполнить проверку. Для этого нажмите кнопку «Проверить файл». В результате вы увидите отчет о проверке. И лишь в случае отсутствия ошибок, можно запустить конвертацию.'] =
'Before beginning конвертации it is necessary to execute(accomplish;run;perform;fulfill;carry out) check(audit;test;inspection;examine;checking). For(On;Of;To;With) this press(hit) the button(knob;drawing pin)  to Check(Test;Audit;Inspect;Examine) the file . As a result you see the report about(of;on;to;for) check(audit;test;inspection;examine;checking). And only in the event of absence error, possible start(launch) converting.';
$lang['<b>Правила конвертирования.</b> Копируются все тексты, включая обычные записи и постоянные страницы. В записях сохраняется slug (короткая ссылка) при условии, что в системе еще нет такой. Если есть, то добавляется префикс 1, 2 и т.д. В комментариях копируется только текст и имя. Остальные данные не используются. Рубрики создаются по их названию. Если такое название уже есть, то используется существующая рубрика. Иерархия конвертируемых рубрик полностью теряется. Записи конвертируются только со статусом publish, static и draft.'] =
'<b>Rules of converting.</b> are Copied all texts, including usual(ordinary) record(entry;writing) and constant pages. In(To;At) record(entry;writing) is saved slug (the short reference) provided that in(to;at) system else no such. If there is, that is added prefix 1, 2 and etc. In(To;At) комментариях is copied only text and name(first name). Rest given are not used. The Rubrics upon their name(title). If such name(title) already there is, that is used existing rubric. The Hierarchy of the converted rubrics completely gets lost. Record(Entry;Writing) are converted with(since) status publish only, static and draft.';
$lang['Обратите внимание, что процесс конвертирования очень ресурсоемкий. Прежде всего он потребует много php-памяти, а также множество SQL-запросов к БД. При конвертировании система попробует установить большее время выполнения php-скриптов, чтобы сервер принудительно не сбросил соединение. Однако не на всех хостингах такая возможность может сработать. Если сервар слабый, то он может не успеть обработать все SQL-запросы. В этом случае вам придется уменьшить размер xml-файла и попытаться выполнить конвертирование заново по частям.'] =
'Call attention that process converting much(highly;very much) hevy. First of all he will require much(many;plenty of) php-memories, as well as ensemble(manifold;great number) SQL-request to(towards) BD. Under(Upon) конвертировании system will try to install(fix) greater running time php-скриптов that server by force has not thrown join(joining). However not on(upon;in;to;for;at;per;for) all хостингах such possibility(capacity) can(may;be able) operate. If сервар weak, that he can(may;be able) not have(make progress) time to to process(handle) all SQL-requests. In this case you to come to reduce the size(amount) xml-file and try to execute(accomplish;run;perform;fulfill;carry out) конвертирование on(over;along;down;under) a parts anew.';
$lang['При конвертировании система автоматически проверяет уже существующие рубрики и записи. Если таковые уже есть, то они не добавляются. Это позволяет избежать дублирования. Ну и кроме того, вы можете не опасаться, что при повторной конвертации данные снова добавятся.'] =
'Under(Upon) converting system automatically checks(tests;audits;inspects;examines) already existing rubrics and record(entry;writing). If such already there is, that they are not added. This(It) allows to avoid(elude) duplication. Well and besides(furthermore), you may not fear that under(upon) the repeated(recurrent) конвертации given are once again added.';
$lang['После конвертирования можно деактивировать этот плагин, а также удалить xml-файлы. Также рекомендую очистить кэш: удалить файлы в <u>system/cache/rss/</u>'] =
'After converting possible deactivate this plugin, as well as delete(remove) xml-files. Also(Too;Either;As well) recommend to clean(clear;decontaminate) cache: delete(remove) files in(to;at) <u>system/cache/rss/</u>';
$lang['После конвертирования старые адреса вида <u>http://site/slug</u> сохранятся. Но следует иметь ввиду, что на MaxSite CMS принята немного другая структура ссылок: <u>http://site/page/slug</u> (т.н. синонимы ссылок). Поэтому переживать, что ссылки на других ресурсах потеряются, не следует. При условии, конечно, то новый slug совпадает со старым (во время проверки файла это видно).'] =
'After converting old address of the type(air;view;complexion) <u>http://site/slug</u> is saved. But follows to have in view of that on(upon;in;to;for;at;per;for) MaxSite CMS is accepted little other structures of the references: <u>http://site/page/slug</u> (t.n. synonyms of the references). So outlive that references to the other resource get lost, does not follow. At condition(term), certainly(of course), that new slug complies with old (during checking the file this(it) is seen).';
$lang['<u>ВАЖНО!</u> Настоятельно рекомедую перед началом конвертирования <u>сделать дамп текущей базы данных</u>! В случае ошибок, вы быстро сможете восстановить прежнее состояние своего сайта. Не игнорируйте это замечание!'] =
'<u>IMPORTANT!</u> Urgently recommend before beginning convert <u>make dump of the current base(basis) dannyh</u>! In the event of mistake(error), you will quickly be able to restore the former condition(state) of its site. Do Not ignore this(it) remark(observation)!';
$lang['Я понял и согласен взять на себя всю ответственность за использование данного конвертера! Дамп также сделал и умею с ним работать'] =
'I have understood and agree to undertake whole responsibility for use given converter! Dump has also(too;either;as well) done(maked) and wit with(since) him to work(operate)';
$lang['Выберите файл:'] = 'Choose file';
$lang['Проверить файл'] = 'Check file';
$lang['Запустить конвертацию'] = 'Run convert';


# end file
