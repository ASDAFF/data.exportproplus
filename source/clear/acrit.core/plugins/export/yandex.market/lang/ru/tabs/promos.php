<?
$strMessPrefix = 'ACRIT_EXP_YANDEX_MARKET_';

$MESS[$strMessPrefix.'PROMOS_HEADER'] = 'Выгружать промо-акции';

#
$MESS[$strMessPrefix.'EXPORT_PROMOCODES'] = 'Промокод';
	$MESS[$strMessPrefix.'EXPORT_PROMOCODES_NO_SALE'] = 'Выгрузка промокодов возможна только при наличии модуля "Интернет-магазин".';
	$MESS[$strMessPrefix.'EXPORT_PROMOCODES_DESC'] = 'Скидка по промокоду<br/><br/>
	Вы можете указывать в прайс-листе текст промокода и размер скидки.<br/><br/>
	Для выгрузки промокодов неободимо выбрать правило (или несколько) работы с корзиной, причем в правиле должно быть действие "применить скидку", и в этом же блоке нужно по одному указать все нужные товары ("поле Товар" - "равно" - &lt;название товара&gt;). Дополнительная вложенность ("группы условий") в данном случае не поддерживается. Логика "не равно" также не поддерживается.<br/><br/>
	<b>Примечание.</b> Маркет проверяет, что товар продавался до акции по старой цене (или дороже) как минимум 5 дней подряд:
	<ul>
		<li>за последние 60 дней — для категории «Одежда, обувь и аксессуары»;</li>
		<li>за последние 30 дней — для остальных категорий;</li>
		<li>за все время — если товар размещается меньше 30 (60) дней.</li>
	</ul>
	Если это не выполняется, предложение показывается без акции.<br/><br/>
	<a href="https://yandex.ru/support/partnermarket/elements/promo-code.html" target="_blank">Подробнее</a>
';
$MESS[$strMessPrefix.'EXPORT_PROMOCODES_RULES'] = 'Выберите правило для работы с корзиной:<br/>
<a href="/bitrix/admin/sale_discount.php?lang='.LANGUAGE_ID.'" target="_blank">Открыть правила</a>';
	$MESS[$strMessPrefix.'EXPORT_PROMOCODES_RULES_DESC'] = 'Выберите правило для работы с корзиной в которых созданы акционные купоны.<br/><br/>
	В правилах <b>обязательно</b> выбрать разделы или товары на которые действуют скидки.';

#
$MESS[$strMessPrefix.'EXPORT_SPECIAL_PRICE'] = 'Цена по временной акции';
	$MESS[$strMessPrefix.'EXPORT_SPECIAL_PRICE_DESC'] = 'Специальная цена в определенный период<br/><br/>
	Вы можете указывать в прайс-листе цену со скидкой и период действия акции.<br/><br/>
	Товар будет выгружен с данной акцией, если у него заполнена старая и новая цена, и новая цена меньше старой.<br/><br/>
	<b>Общие требования</b>
	<ul>
		<li>Старая цена выше текущей.</li>
		<li>Скидка в процентах не меньше 5% и не больше 95%. Процент округляется до целого числа.</li>
		<li>Скидка в валюте, в которой указана цена предложения, не меньше 1 единицы.</li>
		<li>Товар продавался по старой цене (или дороже) как минимум 5 дней подряд:
			<ul>
				<li>за последние 60 дней — для категории «Одежда, обувь и аксессуары»;</li>
				<li>за последние 30 дней — для остальных категорий;</li>
				<li>за все время — если товар размещается меньше 30 (60) дней.</li>
			</ul>
		</li>
	</ul>
	Если данная опция включена, в числе полей необходимо заполнить дополнительные поля:
	<ul>
		<li><b>Дата и время начала акции</b>,</li>
		<li><b>Дата и время завершения акции</b>,</li>
		<li><b>Краткое описание акции</b>,</li>
		<li><b>Ссылка на описание акции на сайте магазина</b>,</li>
		<li><b>Цена со скидкой на время акции</b>,</li>
		<li><b>Валюта цены со скидкой</b>.</li>
	</ul>
	<a href="https://yandex.ru/support/partnermarket/elements/promo-flash.html" target="_blank">Подробнее</a>
';
#
$MESS[$strMessPrefix.'EXPORT_PROMOCARD'] = 'Цена по программе лояльности';
	$MESS[$strMessPrefix.'EXPORT_PROMOCARD_DESC'] = 'Цена по программе лояльности (напр., бонусной карте).<br/><br/>
	Цену по программе лояльности можно указывать в прайс-листе, если программа удовлетворяет условиям:
	<ul>
		<li>Участникам программы предоставляется определенная скидка (например, 5% или 1000 рублей по дисконтной карте) или особая («клубная») цена на товар.</li>
		<li>Цена по программе должна автоматически применяться в корзине. Покупатель должен заплатить за товар эту цену: разница с обычной ценой не может начисляться ему в виде бонусных баллов, кэшбэка и т. п.</li>
		<li>На момент покупки пользователь должен быть зарегистрирован в программе лояльности или иметь карту долгосрочного действия (дисконтную, клубную и т. п.). Если скидка или особая цена предоставляется пользователю один раз после однократного действия (например, подписки на рассылку), это не считается программой лояльности.</li>
		<li>На сайте магазина есть раздел с описанием и условиями участия в программе.</li>
	</ul>
	<br/>
	Если у товара несколько цен по программе лояльности (например, с разными скидками по картам разного уровня), укажите в прайс-листе ту, которая доступна участникам сразу после регистрации в программе. Например, если у магазина есть дисконтные карты со скидками 5% и 10%, указывайте цены со скидками 5%.<br/><br/>
	<b>Внимание.</b> Конкретное предложение может участвовать только в одной акции или программе лояльности. Если предложение указано в разных акциях и программах, для него случайным образом будет выбрана одна.<br/><br/>
	<a href="https://yandex.ru/support/partnermarket/elements/promo-card.html" target="_blank">Подробнее</a>
';
#
$MESS[$strMessPrefix.'EXPORT_N_PLUS_M'] = 'N + M';
	$MESS[$strMessPrefix.'EXPORT_N_PLUS_M_DESC'] = 'При покупке N товаров M таких же товаров бесплатно.<br/><br/>
	Вы можете указывать в прайс-листе, сколько товаров нужно купить и сколько покупатель получит в подарок.<br/><br/>
	Если данная опция включена, в числе полей необходимо заполнить дополнительные поля:
	<ul>
		<li><b>Дата и время начала акции</b>,</li>
		<li><b>Дата и время завершения акции</b>,</li>
		<li><b>Краткое описание акции</b>,</li>
		<li><b>Ссылка на описание акции на сайте магазина</b>,</li>
		<li><b>Количество товаров нужно приобрести</b>,</li>
		<li><b>Количество товаров в подарок</b>.</li>
	</ul>
	<a href="https://yandex.ru/support/partnermarket/elements/promo-n-plus-m.html">Подробнее</a>
';

#
$MESS[$strMessPrefix.'EXPORT_GIFTS'] = 'Подарок';
	$MESS[$strMessPrefix.'EXPORT_GIFTS_DESC'] = 'Подарок на выбор<br/><br/>
	Вы можете указывать в прайс-листе, какие товары участвуют в акции и какие подарки может получить покупатель.<br/><br/>
	Если данная опция включена, в числе полей необходимо заполнить дополнительные поля:<br/>
	<ul>
		<li><b>Подарки</b> - поле, содержащее подарки, рекомендуется использовать свойство типа «Привязка к элементам» (или «Привязка к элементам в виде списка»), возможно множественное: в результате обработки поля должны быть ID элементов инфоблока, являющихся подарками,</li>
		<li><b>Подарки (описание)</b> - поле для указания описания акции,</li>
		<li><b>Подарки (URL)</b> - поле для указания подробной страницы с описанием акции.</li>
	</ul>
	Для каждого подарка должна быть указана либо детальная картинка, либо картинка для анонса.<br/><br.>
	<b>Внимание!</b> Поле с подарками должно получать ID подарка или массив ID подарков. Поэтому, если используется привязка к элемента, необходимо в <b>настройках значения</b> отмечать опцию «Использовать значение без обработки». Если подарки могут быть множественными, и в настройках множественного значения, и в настройках всего поля нужно указать «Режим множественных значений» как «Оставить множественным».<br/><br/>
	<a href="https://yandex.ru/support/partnermarket/elements/promo-gift.html" target="_blank">Подробнее</a>
';

#
$MESS[$strMessPrefix.'EXPORT_PROMOS_HELP_URL'] = '<a href="https://www.acrit-studio.ru/technical-support/configuring-the-module-export-on-trade-portals/vygruzka-podarkov-v-yandeks-market/" target="_blank">Пример настройки выгрузки промо-акций</a>';
$MESS[$strMessPrefix.'EXPORT_PROMOS_NOTICE'] = '<b>Внимание!</b> После установки галочки в «<b>Специальная цена</b>», «<b>N + M</b>», «<b>Подарок</b>» в списке полей (как для товаров, так и для предложений) появляются новые поля для заполнения (см. группы «ПРОМО: СПЕЦИАЛЬНАЯ ЦЕНА», «ПРОМО: АКЦИЯ N+M», «ПРОМО: ПОДАРКИ»).';

?>