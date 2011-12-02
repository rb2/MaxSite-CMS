<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MaxSite CMS
 * Language file
 * (c) http://max-3000.com/
 * Author: (c) Александр Шиллинг
 * Author URL: http://dignityinside.org
 * Update URL: http://dignityinside.org
 * Перевод плагинов в комплекте
 */
 
$lang['Доступ запрещен'] = 'Zugriff verweigert';
$lang['Сохранить изменения'] = 'Änderungen speichern';
$lang['Обновлено!'] = 'Aktualisiert!';
$lang['Заголовок:'] = 'Titel:';
$lang['Формат:'] = 'Format:';
$lang['Сортировка:'] = 'Sortieren:';
$lang['Обновлено!'] = 'Aktualisiert!';
$lang['Админ-доступ к настройкам'] = 'Admin Zugriff auf die Einstellungen';
$lang['Админ-доступ к настройкам '] = 'Admin Zugriff auf die Einstellungen';

# admin_ip
$lang['Обновлено! Обязательно сохраните секретный адрес сейчас!'] = 'Aktualisiert! Speichern Sie Ihre Geheime Adresse jetzt ab!';
$lang['Admin IP'] = 'Admin IP';
$lang['Вы можете указать IP с которых разрешен доступ в админ-панель. Если пользователь попытается войти в панель управления с другого IP, то ему будет отказано в доступе.'] =
'Sie können die IP-Adresse eingeben, die Zugriff auf das Admin-Panel erlaubt. Wenn ein anderer Benutzer versucht, in das Control Panel mit einem anderen IP-Protokoll einzuloggen, so wird der Zugriff verweigert.';
$lang['На тот случай, если у администратора сменится IP, следует указать секретный адрес (URL), по которому можно очистить список разрешенных IP. Сохраняйте этот секретный адрес в надежном месте. В случае, если вы его забудете у вас не будет другой возможности, кроме как отключить плагин (удалить его файлы) или вручную исправить базу данных.'] =
'Im Falle, wenn der Administrator IP sich ändert, sollten Sie eine geheime Adresse (URL) eingeben, mit dem Sie die Liste der zulässigen IP leeren können. Bewahren Sie diese Adresse an einem sicheren Ort. Falls Sie es vergessen, haben Sie keine andere Wahl, als das Plugin zu deaktivieren (entfernen Sie die Dateien) oder manuell die Datenbank zu beheben';
$lang['Если секретный адрес не указан, то сбросить список будет невозможно.'] = 'Wenn die geheime Adresse nicht angegeben ist, dann können Sie die Liste nicht zurücksetzen.';
$lang['Если список IP пуст, то доступ в админ-панель разрешен с любого IP.'] = 'Wenn die IP-Liste leer ist, dann wird der Zugriff auf die Admin-Panel von einer beliebigen IP erlaubt.';
$lang['Следует указывать только цифры и английские буквы. Другие символы не допустимы!'] = 'Sie sollten nur Zahlen und Buchstaben in Englisch eingeben. Andere Zeichen sind nicht erlaubt!';
$lang['Текущий адрес:'] = 'Derzeitige Adresse:';
$lang['Укажите разрешенные IP по одному в каждой строчке'] = 'Geben Sie die zugelassene IP eine pro Zeile';
$lang['Ваш текущий IP:'] = 'Ihre aktuelle IP-Adresse:';
$lang['Будьте внимательны! Обязательно указывайте свой текущий IP!'] = 'Seien Sie vorsichtig! Achten Sie darauf, das Sie immer Ihre aktuelle IP eingeben!';
$lang['Админ-доступ к редактированию разрешенных IP'] = 'Admin Zugang zu bearbeiten zulässigen IP';

# antispam
$lang['Админ-доступ к antispam'] = 'Admin-Zugriff Antispam';
$lang['Антиспам'] = 'Antispam';
$lang['Для вашего IP комментирование запрещено!'] = 'Für Ihre IP sind Kommentare verboten!';
$lang['Вы используете запрещенные слова!'] = 'Sie verwenden Schimpfwörter!';
$lang['С помощью этого плагина вы можете активно бороться со спамерами. Обратите внимание, что комментарии авторов публикуются без модерации.'] =
'Mit diesem Plugin können Sie aktiv mit Spammern kämpfen. Bitte beachten Sie, dass die Autoren die Kommentare ohne Moderation veröffentlicht können.';
$lang['Настройки'] = 'Einstellung';
$lang['Включить антиспам'] = 'Antispam einschalten';
$lang['Вести лог отловленных спамов'] = 'Ein Spam-log führen';
$lang['Отправлять комментарий на модерацию, если в нем встречается, хоть одна ссылка.'] = 'Kommentar zur Überprüfung senden, sobald ein Link in Kommentar vorkommt.';
$lang['Файл для логов:'] = 'Datei für die Protokolle:';
$lang['Посмотреть'] = 'Anzeigen';
$lang['Черный список IP'] = 'Schwarze Liste der IP';
$lang['Укажите IP, с которых недопустимы комментарии. Один IP в одной строчке.'] = 'Geben Sie die IP, von denen Kommentare gesperrt werden. Eine IP in einer Linie.';
$lang['Черный список слов'] = 'Schwarze Liste von Wörtern';
$lang['Укажите слова, которые нельзя использовать в комментариях. Одно слово в одной строчке.'] = 'Geben Sie die Wörter an, die nicht in den Kommentaren genutzt werden können. Ein Wort in einer Zeile.';
$lang['Слова для модерации'] = 'Wörter für Überprüfung';
$lang['Укажите слова, которые принудительно отравляют комментарий на премодерацию. Одно слово в одной строчке. Обратите внимание, что этот список проверяется только если пройдена проверка на Черные списки.'] =
'Geben Sie die Wörter ein, die erzwingen den Kommentar zur Moderation zu senden. Ein Wort pro Zeile. Bitte beachten Sie, das die Liste nur dann geprüft wird, wenn die Schwarze Liste Prüfung beendet ist.';
$lang['Номера комюзеров, которые всегда попадают в модерацию'] = 'Nummer der Komuser, die immer zur Überprüfung gesendet werden';
$lang['Укажите номера комюзеров, которые принудительно отравляют комментарий на премодерацию. Один номер в одной строчке. Обратите внимание, что этот список проверяется только если пройдена проверка на Черные списки.'] =
'Geben Sie die Nummer des komuser an, deren Kommentare zur Überprüfung gesendet werden. Ein Nummer pro Zeile. Achten Sie darauf, das diese Liste nur Überprüft wird, wenn die Prüfung der Schwarze Liste erfolgreich war.';

# authors
$lang['Авторы'] = 'Autoren';

#bbcode
$lang['Настройки плагина bbcode'] = 'Den Plugin bbcode anpassen';
$lang['Укажите необходимые опции.'] = 'Geben Sie die entsprechenden Optionen an.';
$lang['Где использовать'] = 'Wo verwenden?';
$lang['Укажите, где должен работать плагин'] = 'Geben Sie an, wo das Plugin arbeiten soll';
$lang['1||На страницах #2||В комментариях #3||На страницах и в комментариях'] = '1||Auf den Seiten #2||In Kommentaren #3||Auf den Seiten und dem Kommentar';
$lang['Конвертирует тэги BBCode в HTML. См.'] = 'Konvertiert BBCode-Tags in HTML.';

# calendar
$lang['Календарь'] = 'Kalender';
$lang['Январь'] = 'Januar';

$lang['Февраль'] = 'Februar';
$lang['Март'] = 'März';
$lang['Апрель'] = 'April';
$lang['Май'] = 'Mai';
$lang['Июнь'] = 'Juni';
$lang['Июль'] = 'Juli';
$lang['Август'] = 'August';
$lang['Сентябрь'] = 'September';
$lang['Октябрь'] = 'Oktober';
$lang['Ноябрь'] = 'November';
$lang['Декабрь'] = 'Dezember';
$lang['Пн'] = 'Mo';
$lang['Вт'] = 'Di';
$lang['Ср'] = 'Mi';
$lang['Чт'] = 'Do';
$lang['Пт'] = 'Fr';
$lang['Сб'] = 'Sa';
$lang['Вс'] = 'So';

# captcha
$lang['Введите нижние символы'] = 'Geben Sie unten stehende Symbole ein';
$lang['Защита от спама: введите только нижние символы'] = 'Spam-Schutz: Tragen Sie nur die unteren Symbole ein';
$lang['(обязательно)'] = '(Pflichtfeld)';

# catclouds
$lang['Облако рубрик'] = 'Kategorie Wolke';
$lang['Мин. размер'] = 'Min. Größe';
$lang['Макс. размер'] = 'Max. Größe';
$lang['Номер рубрики:'] = 'Nummer der Kategorie:';
$lang['Начало блока:'] = 'Anfang des Blocks';
$lang['Конец блока:'] = 'Ende des Blocks';
$lang['По количеству записей (обратно)'] = 'Nach der Anzahl der Einträge (rückwärts)';
$lang['По количеству записей'] = 'Nach der Anzahl der Einträge';
$lang['По алфавиту'] = 'Alphabetisch';
$lang['По алфавиту (обратно)'] = 'Alphabetisch (rückwärts)';

# category
$lang['Рубрики'] = 'Kategorie';
$lang['Например:'] = 'Zum Beispiel:';
$lang['Формат текущей:'] = 'Aktuelles Format:';
$lang['Например:'] = 'Zum Beispiel:';
$lang['Включить только:'] = 'Nur Einschalten:';
$lang['Укажите номера рубрик через запятую или пробел'] = 'Wählen Sie die Nummer einer Kategorie, trennen Sie mit Komma oder Leerzeichen';
$lang['Исключить:'] = 'Ausschließen:';
$lang['Если нет записей:'] = 'Wenn keine Datensätze:';
$lang['Отображать рубрику (количество записей ведется без учета опубликованности)'] = 'Zeige die Kategorie (der Zähler zählt die Veröffentliche Einträge nicht mit)';
$lang['Скрывать рубрику (количество записей ведется только по опубликованным)'] = 'Verstecke Kategorien (der Zähler zählt nur die Veröffentliche Einträge)';
$lang['По имени рубрики'] = 'Nach Titel der Kategorie';
$lang['По ID рубрики'] = 'Nach ID der Kategorie';
$lang['По выставленному menu order'] = 'Nach Menu Sortieren';
$lang['Порядок:'] = 'Reihenfolge';
$lang['Прямой'] = 'Direkt';
$lang['Обратный'] = 'Umgekehrt';
$lang['Включать потомков:'] = 'Unterordner verwenden';
$lang['Всегда'] = 'Immer';
$lang['Только если явно указана рубрика'] = 'Sofern die Kategorie angegeben ist';

# comment_button
$lang['Полужирный'] = 'Fett-gedruckt';
$lang['Курсив'] = 'Kursiv';
$lang['Подчеркнутый'] = 'Unterstrichen';
$lang['Зачеркнутый'] = 'Durchgestrichen';
$lang['Цитата'] = 'Zitat';
$lang['Код'] = 'Code';
$lang['Код или преформатированный текст'] = 'Code oder vorformatierten Text';

# down_count
$lang['Админ-доступ к настройкам счетчика переходов (Download count)'] = 'Admin Zugriff auf die Zähler Übergänge Einstellungen (Download count)';
$lang['Счетчик переходов'] = 'Klick Zähler';
$lang['Подсчет количества переходов по ссылке. Обрамите нужную ссылку в [dc]...[/dc]'] = 'Zählen der Anzahl der Klicks auf den Link. Verwenden Sie [dc]link[/dc]';
$lang['Данная ссылка доступна только со <a href="%s">страниц сайта</a>'] = ' Dieser Link ist nur von <a href="%s">seite verfügbar</a>';
$lang['Запрещен переход по этой ссылке с чужого сайта'] = 'Der Übergang von anderen Seiten sind nicht erlaubt';
$lang['Количество переходов'] = 'Anzahl der Klicks';
$lang['С помощью этого плагина вы можете подсчитывать количество скачиваний или переходов по ссылке. Для использования плагина обрамите нужную ссылку в код [dc]ваша ссылка[/dc]'] =
'Mit diesem Plugin können Sie die Anzahl der Klicks oder Anzahl der Downloads über einen Link Zählen, fügen Sie dafür diese Tags ein [dc]Ihr Link[/dc]';
$lang['Файл для хранения количества скачиваний:'] = 'Datei zur Speicherung der Anzahl der Downloads:';
$lang['Префикс URL:'] = 'Prefix URL';
$lang['ссылка'] = 'Link';
$lang['Запретить переходы с чужих сайтов'] = 'Klick von anderen Seiten verbieten';
$lang['Выводить в title реальный адрес'] = 'Zeige in Titel die reale Adresse';
$lang['Статистика переходов'] = 'Anzahl der Klicks';
$lang['переходов'] = 'Klicks';

# editor_dumb
$lang['Ссылка'] = 'Link';
$lang['Картинка'] = 'Bild';
$lang['Отрезать текст'] = 'Text Abschneiden';

# events
$lang['События'] = 'Veranstaltungen:';
$lang['Формат даты:'] = 'Datumsformat:';
$lang['Как это <a href="http://ru.php.net/date" target="_blank">принято в PHP</a>'] = 'Wie in <a href="http://php.net/date" target="_blank">PHP</a>';
$lang['Указывайте по одному событию в каждом абзаце в формате:'] = 'Geben Sie eine Veranstaltung pro Zeile ein in den folgendem Format:';
$lang['<strong>дата</strong> в формате yyyy-mm-dd'] = '<strong>Datum</strong> in Format yyyy-mm-dd';
$lang['<strong>до</strong> - выводить событие до наступления N-дней'] = '<strong>Bis</strong> — zeige die Veranstaltungen vor N-Tagen';
$lang['<strong>после</strong> - выводить событие после прошествия N-дней'] = '<strong>Nach</strong> — zeige die Veranstaltungen nach N-Tagen';
$lang['<strong>В тексте события</strong> можно использовать HTML'] = '<strong>In dem Text<strong> HTML erlauben';
$lang['<strong>ПРИМЕР:</strong> 2008-09-01 | 3 | 1 | Пора в школу!'] = '<strong>Beispiel:</strong> 2008-09-01 | 3 | 1 | Zeit für Schule!';
$lang['Понедельник'] = 'Montag';
$lang['Вторник'] = 'Dienstag';
$lang['Среда'] = 'Mittwoch';
$lang['Четверг'] = 'Donnerstag';
$lang['Пятница'] = 'Freitag';
$lang['Суббота'] = 'Samstag';
$lang['Воскресенье'] = 'Sonntag';
$lang['января'] = 'januar';
$lang['февраля'] = 'februar';
$lang['марта'] = 'märz';
$lang['апреля'] = 'april';
$lang['мая'] = 'mai';
$lang['июня'] = 'juni';
$lang['июля'] = 'juli';
$lang['августа'] = 'august';
$lang['сентября'] = 'september';
$lang['октября'] = 'oktober';
$lang['ноября'] = 'november';
$lang['декабря'] = 'dezember';
$lang['янв'] = 'jan';
$lang['фев'] = 'feb';
$lang['мар'] = 'mar';
$lang['апр'] = 'apr';
$lang['май'] = 'mai';
$lang['июн'] = 'jun';
$lang['июл'] = 'jul';
$lang['авг'] = 'aug';
$lang['сен'] = 'sep';
$lang['окт'] = 'okt';
$lang['ноя'] = 'nov';
$lang['дек'] = 'dez';

# faq
$lang['К списку'] = 'Zurück zur Liste';

# favorites
$lang['Избранное'] = 'Favoriten';
$lang['Ссылки:'] = 'Links';
$lang['Указывайте по одной ссылке в каждом абзаце в формате: <strong>тип/ссылка | название</strong>'] = 'Geben Sie jeweils einen Link in einer Zahle an in Format: <strong>Typ/Link | title</strong>';
$lang['<strong>тип/ссылка</strong> - указывается от адреса сайта, например'] = '<strong>Typ/link</strong> — vor Adresse der Seite, zum Beispiel';
$lang['Для главной страницы укажите: <strong> / | Главная</strong>'] = 'Für die Startseite benutzen Sie: <strong> / | Startseite</strong>';

# feedburner
$lang['Админ-доступ к feedburner'] = 'Admin-Zugriff zu feedburner';
$lang['Адрес вашего фида в FeedBurner.com:'] = 'URL Ihres Feeds in FeedBurner.com';
$lang['Плагин FeedBurner'] = 'Plugin FeedBurner';
$lang['Плагин выполняет перенаправление вашего основного rss на сервис feedburner.com.'] = 'Plugin überträgt Ihre RSS zu feedburner.com Service.';

# feedburner_count
$lang['Настройка FeedBurner Count от samborsky.com'] = 'Einstellungen von FeedBurner Count von samborsky.com';
$lang['Ошибка!'] = 'Fehler!';
$lang['Настройка FeedBurner Count от <a href="http://www.samborsky.com/">samborsky.com</a>'] = 'Einstellungen von FeedBurner Count von <a href="http://www.samborsky.com/">samborsky.com</a>';
$lang['Здравствуйте, последний раз счетчик обновлялся'] = 'Hallo. letztes mal wurde der Zähler aktualisiert am';
$lang['Последнее показание счетчика:'] = 'Letzter Zählerstand:';

# feedcount
$lang['Виджет подсчета подписчиков RSS'] = 'Widget - Zähler von RSS Abo';
$lang['Сегодня:'] = 'Heute';
$lang['Вчера:'] = 'Gestern:';
$lang['[COUNT] - подписчиков сегодня, [COUNTOLD] - подписчиков вчера'] = '[COUNT] - Abo heute, [COUNTOLD] - Abo gestern';

# forms
$lang['Неверный email!'] = 'Ungültige E-Mail';
$lang['Привет роботам! :-)'] = 'Hallo, Roboter! :-)';
$lang['Заполните все необходимые поля!'] = 'Füllen Sie alle erforderlichen Felder aus!';
$lang['Вами отправлено сообщение:'] = 'Ihre Nachricht wurde gesendet:';
$lang['Ваше сообщение отправлено!'] = 'Ihre Nachricht wurde gesendet!';
$lang['Ваше имя*'] = 'Ihr Name*';
$lang['Ваш email*'] = 'Ihre E-mail*';
$lang['Защита от спама:'] = 'Spam-Schutz';
$lang['Отправить копию письма на ваш e-mail'] = 'Eine Kopie an Ihre E-Mail senden';
$lang['Отправить'] = 'Senden';
$lang['Очистить форму'] = 'Formular leeren';

# last_comments
$lang['Последние комментарии'] = 'Neueste Kommentare';
$lang['Количество:'] = 'Anzahl:';
$lang['Количество слов:'] = 'Anzahl der Wörter:';
$lang['Количество символов в одном слове:'] = 'Anzahl der Zeichen in einem Wort:';
$lang['Комментатор'] = 'Kommentator';

# last_pages
$lang['Вывод последних записей'] = 'Zeige die neueste Einträge';
$lang['Последние записи'] = 'Neueste Einträge';
$lang['Формат даты:'] = 'Datumsformat:';
$lang['Формат комментариев:'] = 'Kommentare Format:';
$lang['Тип страниц:'] = 'Seiten Typ:';
$lang['Исключить рубрики:'] = 'Kategorie ausschließen:';
$lang['Включить рубрики:'] = 'Kategorie einschalten:';
$lang['Сортировка:'] = 'Sortieren:';
$lang['Порядок сортировки:'] = 'Sortieren nach:';
$lang['По дате'] = 'Nach Datum';
$lang['По алфавиту'] = 'Alphabetisch';
$lang['Прямой'] = 'Direkt';
$lang['Обратный'] = 'Rückwärts';
$lang[' - комментариев: '] = ' — Kommentare: ';

# links
$lang['Ссылки'] = 'Links';
$lang['Указывайте по одной ссылке в каждом абзаце в формате:'] = 'Geben Sie einen Link pro Zeile in folgendem Format:';
$lang['обрамить ссылку в noindex, если не нужно - указать пробел'] = 'Link mit noindex umrahmen. Wenn Sie nicht brauchen — Leerzeichen einfügen';
$lang['открыть ссылку в новом окне, если не нужно - указать пробел'] = 'Link in neuen Fenster. Wenn Sie nicht brauchen — Leerzeichen einfügen';

# login_form
$lang['Форма логина'] = 'Login Form';
$lang['Привет,'] = 'Guten Tag,';
$lang['выйти'] = 'Abmelden';
$lang['управление'] = 'Steuerung';
$lang['своя страница'] = 'Eigene Seite';
$lang['Логин (email):'] = 'Anmelden (E-mail)';
$lang['Пароль:'] = 'Passwort:';

# page_comments
$lang['Самое комментируемое'] = 'Das am meisten kommentierte';
$lang['Количество записей:'] = 'Anzahl der Einträge:';
$lang['Формат:'] = 'Format:';
$lang['название записи'] = 'Titel des Eintrages';
$lang['количество комментариев'] = 'Anzahl der Kommentare';
$lang['ссылка'] = 'Link';

# page_parent
$lang['Родительские/дочерние страницы'] = 'Haupt/Unter Seiten';
$lang['Номер страницы:'] = 'Nummer der Seite:';

# page_views
$lang['Виджет «Самое читаемое»'] = 'Widget «Das am meisten gelesen»';
$lang['Самое читаемое'] = 'Am meisten gelesen';
$lang['Тип записей:'] = 'Typ des Eintrages:';
$lang['просмотров в день'] = 'Seitenaufrufe pro Tag';
$lang['всего просмотров'] = 'Alle Anzeige';
$lang['Просмотров в сутки: '] = 'Seitenaufrufe pro 24h: ';

# pagination
$lang['Первая'] = 'Anfang';
$lang['предыдущая'] = 'vorherige';
$lang['следующая'] = 'nächste';
$lang['последняя'] = 'Ende';

# random_gal
$lang['Галерея'] = 'Galerie';
$lang['Галерея:'] = 'Galerie:';
$lang['Количество:'] = 'Anzahl:';
$lang['CSS-cтиль блока:'] = 'CSS-Style-Block:';
$lang['CSS-cтиль img:'] = 'CSS-Style img:';
$lang['Свой HTML-блок:'] = 'Eigene HTML-block:';

# random_pages
$lang['Случайные статьи'] = 'Zufälliger Artikel';
$lang['Тип страниц:'] = 'Typ der Seite';

# randomtext
$lang['Цитаты'] = 'Zitat';
$lang['Цитата'] = 'Zitat';

# rater
$lang['Рейтинг страниц'] = 'Page Rank';
$lang['Голосов:'] = 'Stimmen:';
$lang['Текущая оценка:'] = 'Aktuelle Note:';
$lang['название записи'] = 'Titel des Eintrages';
$lang['всего голосов'] = 'Gesamt Stimmen';
$lang['общий бал (деление общего рейтинга на кол-во голосов) - округлен до целого'] = 'Gesamt Punkte (Teilung des Gesamtes Rating durch die Anzahl der Stimmen) – gerundet auf Ganzes';
$lang['общий бал (дробный)'] = 'Gesamt Punkte (Gebrochene)';
$lang['Общий бал:'] = 'Gesamtpunktzahl';
$lang['Вы уже голосовали!'] = 'Sie haben bereits abgestimmt!';
$lang['Ваша оценка:'] = 'Ihre Bewertung:';
$lang['Средняя оценка'] = 'Durchschnittsnote';
$lang['из'] = 'von';
$lang['проголосовавших'] = 'stimmen';

#redirect
$lang['Редирект'] = 'Weiterleitung';
$lang['Редиректы'] = 'Weiterleitungen';
$lang['С помощью этого плагина вы можете организовать редиректы со своего сайта. Укажите исходный и конечный адрес через «|», например:'] = 'Mit diesem Plugin können Sie eine Weiterleitung von Ihre Webseite erstellen. Geben Sie die Quelle und Adresse an «|», Bsp.:';
$lang['При переходе к странице вашего сайта «http://mysite.com/about» будет осуществлен автоматический редирект на указанный «http://newsite.com/hello».'] = 'Wenn man auf die Seite «http://mysite.com/about» wird der Besucher auf die Seite «http://newsite.com/hello» umgeleitet.';
$lang['Третьим параметром вы можете указать тип редиректа: 301 или 302.'] = 'Mit dem dritten Parameter können Sie den Typ der Umleitung festlegen: 301 oder 302';
$lang['Также можно использовать регулярные выражения.'] = 'Sie können auch reguläre Ausdrücke verwenden.';

# search_form
$lang['Форма поиска'] = 'Suchformular';
$lang['Что искать?'] = 'Was wird gesucht?';
$lang['Поиск'] = 'Suchen';
$lang['Текст подсказки:'] = 'Hilfetext:';
$lang['Текст на кнопке:'] = 'Text auf den Button:';
$lang['CSS-стиль текста:'] = 'CSS Stil des Textes:';
$lang['CSS-стиль кнопки:'] = 'CSS-Style des Button:';

# sitemap
$lang['Воспользуйтесь картой сайта'] = 'Verwenden Sie Sitemap';

# tabs
$lang['Табы (закладки)'] = 'Tab (Reiter)';
$lang['Табы:'] = 'Tabs:';
$lang['Указывайте по одному табу в каждом абзаце в формате: <strong>заголовок | виджет номер</strong>'] = 'Ein Tab pro Zahle in Format: <strong>Überschrift | Widget Nummer';
$lang['Например: <strong>Цитаты | randomtext_widget 1</strong>'] = 'Beispiel: <strong>Zitat | randomtext_widget 1</strong>';
$lang['Для ушки: <strong>Цитаты | ушка_цитаты</strong>'] = 'Für Ohr (ushka): <strong>Zitat | ushka_quote</strong>';
$lang['Использовать:'] = 'Verwenden:';
$lang['Виджет (функция и номер через пробел)'] = 'Widget (Funktion und Nummer durch ein Leerzeichen)';
$lang['Ушка (только название)'] = 'Ohr (Ushka - nur Überschrift)';

# tagclouds
$lang['Облако тэгов/меток'] = 'Tags Wolke';
$lang['Мин. размер (%):'] = 'Min. Größe (%):';
$lang['Макс. размер (%):'] = 'Max Größe (%);';
$lang['Макс. меток:'] = 'Max Tags:';
$lang['Миним. меток:'] = 'Min. Tags:';
$lang['Отображать только метки, которых более указанного количества. (0 - без ограничений)'] = 'Zeige die Tags nur dann an, wenn Sie mehr als eingegeben Zahl ist (0 - ohne Einschränkungen)';
$lang['Начало блока:'] = 'Anfang des Block:';
$lang['Конец блока:'] = 'Ende des Block:';
$lang['Сортировка:'] = 'Sortieren:';
$lang['По количеству записей (обратно)'] = 'Nach Anzahl der Einträge (rückwärts)';
$lang['По количеству записей'] = 'Nach Anzahl der Einträge';
$lang['По алфавиту'] = 'Alphabetisch';
$lang['По алфавиту (обратно)'] = 'Alphabetisch (rückwärts)';

# text_block
$lang['Текстовый блок'] = 'Textblock';
$lang['Текст:'] = 'Text:';
$lang['Тип:'] = 'Typ:';
$lang['HTML или текст'] = 'HTML oder Text';
$lang['Можно использовать HTML-тэги. Если тип PHP, то код должен выполняться без ошибок!'] = 'HTML-Tags sind erlaubt. Wenn PHP, soll der Code ohne Fehler laufen!';

# twitter
$lang['Мой Twitter'] = 'Mein Twitter';
$lang['Адрес:'] = 'Adresse:';
$lang['Количество записей:'] = 'Anzahl der Datensätze:';
$lang['Формат вывода:'] = 'Ausgabeformat:';
$lang['Формат даты:'] = 'Datumsformat:';
$lang['Количество слов:'] = 'Anzahl der Wörter:';

# ushki
$lang['Ушки'] = 'Ohren';
$lang['Админ-доступ к Ушкам'] = 'Admin-Zugriff Ohren';
$lang['С помощью ушек вы можете размещать произвольный html/php код в шаблоне, виджете или прочих плагинах. Ушки удобно использовать для вывода счетчика, рекламы и т.п. Просто создайте ушку, а потом укажите её имя в виджете или с помощью кода:'] =
'Mit den Ohren können Sie beliebigen HTML/PHP Code in Ihre Theme einfügen, Widget oder andere Plugins. Ohren kann man leicht benutzen, z.B. zur Ausgabe von Zähler, Werbung, Banner, etc. Erstellen Sie einfach ein Ohr und geben Sie den Namen in dem Widget ein oder mit Hilfe des Codes:';
$lang['Вы можете вывести произвольную ушку прямо в тексте. Данный код выведет ушку «reklama»:'] = 'Sie können Ihr Ohr gleich in Text Ausgeben. Folgender Code gibt den Ohr «reklama» aus:';
$lang['Ушка добавлена!'] = 'Ein neues Ohr wurde Hinzugefügt';
$lang['Необходимо указать название ушки!'] = 'Sie müssen einen Namen für das Ohr eingeben!';
$lang['Обновлено!'] = 'Aktualisiert!';
$lang['Новая ушка:'] = 'Neue Ohr:';
$lang['Добавить новую ушку'] = 'Neue Ohr erstellen';
$lang['Удалить'] = 'Entfernen';
$lang['Сохранить изменения'] = 'Übernehmen';
$lang['Настройки ушек'] = 'Ohr anpassen';
$lang['Заголовок (блока):'] = 'Titel (Block)';
$lang['Ушка (название):'] = 'Ohr (Titel):';

# wpconvert
# пока здесь, потом перенесу в каталог плагина
$lang['Админ-доступ к wpconvert'] = 'Admin-Zugriff wpconvert';
$lang['Угу, зщас... У тебя сайт накроется, кто отвечать будет?! В ЛЕС!!!'] = 'Nein! Es kann Schiff gehen';
$lang['Файл:'] = 'Datei:';
$lang['Сайт:'] = 'Seite:';
$lang['Ссылка:'] = 'Link:';
$lang['Все рубрики:'] = 'Alle Kategorien:';
$lang['Всего записей:'] = 'Alle Einträge:';
$lang['Статус:'] = 'Status:';
$lang['Тип страницы:'] = 'Seitentyp:';
$lang['Рубрики:'] = 'Kategorien:';
$lang['Метки:'] = 'Tags:';
$lang['Дата:'] = 'Datum:';
$lang['Комментарии:'] = 'Kommentare:';
$lang['Новый slug:'] = 'Neue slug:';
$lang['Текст:'] = 'Text:';
$lang['Комментарии:'] = 'Kommentare:';
$lang['Готово! Проверка выполнена!<br>Предположительно запросов к БД будет:'] = 'Fertig! Überprüfung erfolgreich! Ungefähre Anzahl der Zugriffe auf die Datenbank';
$lang['Измененных slug (url):'] = 'Geänderte slug (URL)';
$lang['Всего записей:'] = 'Alle Einträge';
$lang['Всего комментариев:'] = 'Alle Kommentare';
$lang['Что за ерунду ты мне подсовываешь? Файл-то пустой!'] = 'Hmmm... Datei ist leider leer!';
$lang['Файл'] = 'Datei';
$lang['не найден! Загрузите его в каталог /uploads/ Можно через Загрузку.'] = 'Nicht gefunden! Lade hoch in die /uploads/ Ordner';
$lang['Добавленные рубрики'] = 'Kategorie Hinzufügen';
$lang['Добавленные страницы'] = 'Seite Hinzufügen';
$lang['Готово! Конвертирование выполнено!'] = 'Fertig! Umwandlung wurde ausgeführt!';
$lang['Готово! Конвертирование выполнено!'] = 'Fertig! Umwandlung wurde ausgeführt!';
$lang['Экспорт я рекомендую сделать частями так, чтобы размер одного файла не превышал 300-400Кб. При конвертировании это позволит уменьшить нагрузку на сервер, а также позволит обойти ограничения хостинга на время выполнения скриптов и максимальный размер файла. В итоге у вас получится несколько xml-файлов.'] =
'Den Export, empfehle ich in Teilen zu machen, das die Größe einer Datei nicht Größer als 300-400Kb ist. Im Prozess wird das CPU Auslastung reduzieren, und ermöglicht die Einschränkung des Hosting umgehen. Am ende haben Sie mehrere xml-Datein';
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
'<u>WICHTIG!</u> Wir empfehlen Ihnen einen <u>Backup der Datenbank(basis)</u> zu machen! Bei Fehler, können Sie Ihre Seite leicht wiederherstellen. Das ist eine wichtige Empfehlung!';
$lang['Я понял и согласен взять на себя всю ответственность за использование данного конвертера! Дамп также сделал и умею с ним работать'] =
'Ich bin einverstanden und Hafte selbst für die Benutzung des Konverters! Backup ist gemacht und ich weiß wie man im Falle eines Fehler von Backup alles wiederherstellt';
$lang['Выберите файл:'] = 'Wählen Sie die Datei';
$lang['Проверить файл'] = 'Überprüfen Sie die Datei';
$lang['Запустить конвертацию'] = 'Konvertierung Starten';

# end file