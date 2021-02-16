<?
$MESS["ACRIT_EXPORTPROPLUS_FAQ_BASE"] = "FAQ: материалы";
$MESS["ACRIT_EXPORTPROPLUS_INSTRUCTION_BASE"] = "Общая инструкция по работе с модулем";
$MESS["SC_FRM_1"] = "Отправить сообщение в службу техподдержки";
$MESS["SC_FRM_2"] = "Описание проблемы";
$MESS["SC_FRM_3"] = "последовательность действий, которая привела к ошибке, описание ошибки,...";
$MESS["SC_FRM_4"] = "Отправить сообщение";
$MESS["SC_TXT_1"] = "В случае возникновения проблем с отправкой обращения, пожалуйста, воспользуйтесь формой на нашем сайте:";
$MESS["SC_RUS_L1"] = "Обращение с сайта";
$MESS["SC_NOT_FILLED"] = "Введите ваше обращение";
$MESS["A_SUPPORT_URL"] = "https://www.acrit-studio.ru/support/?show_wizard=Y";
$MESS["ACRIT_EXPORTPROPLUS_RECOMMENDS"] = "
<p><b>Список тестов, для самостоятельной диагностики устойчивой работы сайта</b>:</p>
<ol type=\"1\">
	<li>Проверяем сайт стандартным тестом проверки сайта: Инструменты – Проверка системы – на вкладке - Тестирование системы, нажать кнопку проверки. В случае если будут показаны ошибки или предупреждения, необходимо задать вопрос разработчику сайта или хостеру для их устранения, далее на вкладке - Проверка доступа - запустить полную проверку прав и в случае, если тест покажет, что на какие то файлы не хватает прав, то проблему стоит устранить совместно с оператором хостинга сайта.</li>
	<li>Выставляем в настройках модуля производительности галочки – «Вести журнал предупреждений PHP», «Вести журнал кеширования», «Вести журнал SQL запросов», «Сохранять стек вызова для SQL запросов», Запускаем монитор производительности на 1 час и после сохранения настроек пробуем открыть настройки модуля и заново создать настройки модуля в режиме выгрузки компонентом (если каталог товаров больше 1000 позиций и вы не уверены в наличии свободных ресурсов у сервера то выгрузку стоит сделать на крон) после этого переходим в публичный раздел сайта и пока идет мониторинг проходим в каталог товаров открывая желательно каждый из выгружаемых разделов и в каждом разделе открываем по одному товару и добавляем его в корзину <i>(в случае если категорий более 10 штук достаточно эту процедуру сделать для разделов от 5 до 10 штук чем больше тем лучше так как соберется больше статистических данных)</i> потом проводим оформление покупки собранных товаров до момента оплаты.</li>
	<li>Желательно также протестировать работу других инфоблоков при включенном мониторе производительности, так как нагрузку может создавать не только сам каталог, а и новости статьи форум и т.п. разделы где может быть много элементов. Кроме того, даже если элементов мало, то могут присутствовать ошибки при формировании запросов, и даже маленький инфоблок, может из публичной части создавать очень долгие запросы, которые и попадут в статистику для дальнейшего анализа. После того, как отработает тест производительности, надо зайти в раздел Производительность – Индексы – Анализ индексов и выполнить анализ собранных SQL запросов. После выполнения анализа, как правило, в списке появляются рекомендации по созданию индексов. Зайдя в детальный анализ индекса, можно сделать недостающий индекс стандартными средствами. После создания индекса, вы увидите, насколько процентов выросла производительность запроса. В случае, если ни одной записи не появилось, следует повторить процедуру тестирования на более продолжительном тестировании и большем количестве операций с сайтом, включая и операции создания, редактирования элементов инфоблоков внутри административного раздела.</li>
	<li>Финалом мониторинга будет реестр ошибок предупреждений и уведомлений в разделе Производительность – Ошибка PHP. Если в этом разделе включить группировку, то можно будет увидеть сгруппированный по типам ошибок отчет. Если в этом отчете будут присутствовать строки Error то их надо обязательно устранить совместно с разработчиком сайта иначе вы вообще рискуете потерять какие либо данные. Если присутствуют строки со статусом Warning то стоит проконсультироваться с разработчиком сайта по возможности их устранения и устранить найденные ошибки.</li>
	<li>Далее идет тест производительности – Производительность – Панель производительности – Конфигурация - и если по его результату появляются рекомендации на вкладках – Битрикс и Разработка, их стоит выполнить, особенно если отключен акселератор или страницы сайта имеют не кешированные компоненты (но имейте в виду что часть компонентов, такие как просматриваемые товары или корзина не должны кешироваться). В отчете на вкладке Битрикс можно увидеть рекомендации к Конфигурации PHP,  которые также стоит проверить нажав по ссылке и убедившись, что все настройки оптимальны.</li>
	<li>Далее идет тест масштабируемости сайта (с помощью которого можно протестировать базовые показатели устойчивости сайта к нагрузкам) и в случае нестабильных показателей, а особенно появлении в нем ошибок, стоит подключить к работе разработчика.</li>
	<li>Далее запускается тест сканера безопасности модуля проактивной защиты. Если модуля у вас нет, то вам стоит обратиться к нам в ТП с вопросом по переходу на редакцию, в которую данный модуль входит, или же за проверкой сайта на уязвимости и наличие вирусов. В случае наличия модуля в отчет падают предупреждения, которые  необходимо устранить совместно с оператором хостинга и разработчиком.</li>
	<li>Далее в разделе – Производительность – Страницы, анализируются страницы сайта по производительности. При наличии страниц, генерирующихся более 0,4 секунды, также стоит обратиться к разработчику сайта с вопросом увеличения скорости их работы. Стоит также обратить внимание при проверке скорости сайта, включен ли композитный режим и поддерживается ли он в публичной части, о чем должна свидетельствовать кнопка композитного режима.</li>
</ol>
<p>Веб-Студия АКРИТ</p>
<fieldset title='Обратная связь'>
	 <legend>Обратная связь</legend>
	 <a href='http://www.acrit-studio.ru/services/' target='_blank' title='Услуги по созданию и продвижению сайтов'>Разработка, продвижение,</a> а также <a href='http://www.acrit-studio.ru/technical-support/' target='_blank'>техническая поддержка:</a> <br/>
	 <a href='http://www.acrit-studio.ru/market/' title='Используя наши тиражные решения вы сможете расширить охват вашей целевой аудитории и получить дополнительных клиентов'>Узнайте как увеличить прибыль с сайта</a>&nbsp; +7 495 008 8452; <a href='mailto:design@acrit-studio.ru' title='Электронная почта Веб студии АКРИТ'>design@acrit-studio.ru</a> <br/>
		 Заказ <a href='http://www.acrit-studio.ru/technical-support/' target='_blank' title='Если у вас возникли какие то сложности или задачи по сайту обращайтесь по данной ссылке'>доработок и&nbsp;техподдержка сайтов через службу Технической поддержки</a>
</fieldset>
";
?>
