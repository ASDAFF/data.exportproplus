<?
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_NAME"] = "Экспорт в систему авито (Хобби и отдых)";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_ID"] = "Уникальный идентификатор объявления<br/>(строка не более 100 символов)<br/><b class='required'>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_DATEBEGIN"] = "Дата начала экспозиции объявления";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_DATEEND"] = "Дата конца экспозиции объявления";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_LISTINGFEE"] = "Вариант платного размещения — одно из значений списка:<br/><br/>Package — размещение объявления осуществляется только при наличии подходящего пакета размещения;<br/>PackageSingle — при наличии подходящего пакета оплата размещения объявления произойдет с него; если нет подходящего пакета, но достаточно денег на кошельке Avito, то произойдет разовое размещение;<br/>Single — только разовое размещение, произойдет при наличии достаточной суммы на кошельке Avito; если есть подходящий пакет размещения, он будет проигнорирован.<br/>Если элемент пуст или отсутствует, то значение по умолчанию — Package.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_ADSTATUS"] = "Платная услуга, которую нужно применить к объявлению — одно из значений списка:<br/><br/>Free — обычное объявление;<br/>Premium — премиум-объявление;<br/>VIP — VIP-объявление;<br/>PushUp — поднятие объявления в поиске;<br/>Highlight — выделение объявления;<br/>TurboSale— применение пакета Турбо-продажа;<br/>QuickSale — применение пакета Быстрая продажа.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_AVITOID"] = "Номер объявления на Avito — целое число.<br/>Если вы разместили объявление вручную, а теперь хотите управлять объявлением с помощью Автозагрузки — укажите здесь номер объявления на сайте Авито.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_ALLOWEMAIL"] = "Возможность написать сообщение по объявлению через сайт — одно из значений списка: Да, Нет. Примечание: значение по умолчанию — Да.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_MANAGERNAME"] = "Имя менеджера, контактного лица компании по данному объявлению — строка не более 40 символов.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_CONTACTPHONE"] = "Контактный телефон — строка, содержащая только один российский номер телефона; должен быть обязательно указан код города или мобильного оператора. Корректные примеры:<br/>+7 (495) 777-10-66,<br/>(81374) 4-55-75,<br/>8 905 207 04 90,<br/>+7 905 2070490,<br/>88123855085,<br/>9052070490.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_REGION"] = "Регион,<br/>в котором находится объект объявления<br/>в соответствии со значениями из справочника.<br/><b class='required'>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_CITY"] = "Город или населенный пункт, в котором находится объект объявления — в соответствии со значениями из справочника.<br/>
Элемент обязателен для всех регионов, кроме Москвы и Санкт-Петербурга.<br/>
Справочник является неполным. Если требуемое значение в нем отсутствует, то укажите ближайший к вашему объекту пункт из справочника, а точное название населенного пункта — в элементе Street.";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_SUBWAY"] = "Ближайшая станция метро<br/>(в соответствии со значениями из справочника)";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_DISTRICT"] = "Район города — в соответствии со значениями из справочника.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_CATEGORY"] = "<b>Категория товара — одно из значений списка:</b><br/>
Билеты и путешествия<br/>
Велосипеды<br/>
Книги и журналы<br/>
Коллекционирование<br/>
Музыкальные инструменты<br/>
Охота и рыбалка<br/>
Спорт и отдых";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_GOODSTYPE"] = "<b>Вид товара — одно из значений списка (отдельно для каждой категории):</b><br/>
<b>Билеты и путешествия:</b><br/>
	Карты, купоны, Концерты, Путешествия, Спорт, Театр, опера, балет, Цирк, кино, Шоу, мюзикл<br/>
<b>Книги и журналы:</b><br/>
	Журналы, газеты, брошюры, Книги, Учебная литература<br/>
<b>Коллекционирование:</b><br/>
	Банкноты, Билеты, Вещи знаменитостей, автографы, Военные вещи, Грампластинки, Документы, Жетоны, медали, значки, Игры, Календари, Картины, Киндер-сюрприз, Конверт и почтовые карточки, Макеты оружия, Марки, Модели, Монеты, Открытки, Пепельницы, зажигалки, Пластиковые карточки, Спортивные карточки, Фотографии, письма, Этикетки, бутылки, пробки, Другое<br/>
<b>Музыкальные инструменты:</b><br/>
	Аккордеоны, гармони, баяны, Гитары и другие струнные, Духовые, Пианино и другие клавишные, Скрипки и другие смычковые, Ударные, Для студии и концертов, Аксессуары<br/>
<b>Спорт и отдых:</b><br/>
	Бильярд и боулинг, Дайвинг и водный спорт, Единоборства, Зимние виды спорта, Игры с мячом, Настольные игры, Пейнтбол и страйкбол, Ролики и скейтбординг, Теннис, бадминтон, пинг-понг, Туризм, Фитнес и тренажёры, Другое<br/>
Для категории &quot;Охота и рыбалка&quot; не нужно указывать GoodsType.";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_VEHICLETYPE"] = "<b>Вид велосипеда – одно из значений списка:</b><br/>
Горные<br/>
Дорожные<br/>
BMX<br/>
Детские<br/>
Запчасти и аксессуары
";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_ADTYPE"] = "<b>Вид объявления – одно из значений списка:</b><br/>
Товар приобретен на продажу<br/>
Товар от производителя<br/>";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_ADTYPE_VALUE"] = "Продаю свое";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_TITLE"] = "Название объявления — строка до 50 символов.<br/>Примечание: не пишите в название цену и контактную информацию — для этого есть отдельные поля — и не используйте слово - продам.";
$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_DESCRIPTION"] = "Текстовое описание объявления в соответствии с правилами Avito — строка не более 3000 символов.";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_PRICE"] = "Цена в рублях";

$MESS["DATA_EXPORTPROPLUS_AVITO_HOBBY_AND_TRAVEL_FIELD_IMAGE"] = "Изображения";
$MESS["DATA_EXPORTPROPLUS_TYPE_AVITO_MOTO_PORTAL_REQUIREMENTS"] = "http://autoload.avito.ru/format/hobbi_i_otdyh/";
$MESS["DATA_EXPORTPROPLUS_TYPE_AVITO_MOTO_PORTAL_VALIDATOR"] = "http://autoload.avito.ru/format/xmlcheck/";
$MESS["DATA_EXPORTPROPLUS_TYPE_AVITO_MOTO_EXAMPLE"] = "
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<Ads target=\"Avito.ru\" formatVersion=\"3\">
	<Ad>
		<Id>h632145</Id>
		<Category>Музыкальные инструменты</Category>
		<GoodsType>Гитары и другие струнные</GoodsType>
		<AdType>Продаю свое</AdType>
		<Street>Москва, м. Речной вокзал</Street>
		<Description>
			<![CDATA[
				Гитара в очень хорошем состоянии, надёжная, прекрасный звук, есть едва заметные следы использования.
				Не Китай, сделана в Индонезии. Была у нас группа, распалась, поэтому некоторые инструменты оказались
				уже не нужны. Могу предложить вместе с гитарой: шнур 3 метра, фирменный широкий ремень, хороший чехол,
				а также комбоусилитель. Есть два громких усилителя. С одним (10 Вт) цена за всё 10500, с другим
				(15 Вт) - 12500.
			]]>
		</Description>
		<Region>Москва</Region>
		<Price>8000</Price>
		<ManagerName>Менеджер по продажам</ManagerName>
		<EMail>manager@test.com</EMail>
		<AllowEmail>Да</AllowEmail>
		<Images>
			<Image url=\"https://64.img.avito.st/640x480/4044040064.jpg\"></Image>
			<Image url=\"https://94.img.avito.st/640x480/4044040394.jpg\"></Image>
			<Image url=\"https://29.img.avito.st/640x480/4044040429.jpg\"></Image>
			<Image url=\"https://42.img.avito.st/640x480/4044040442.jpg\"></Image>
			<Image url=\"https://43.img.avito.st/640x480/4044040443.jpg\"></Image>
		</Images>
		<AdStatus>Free</AdStatus>
	</Ad>
	<Ad>
		<Id>h4672452</Id>
		<Category>Велосипеды</Category>
		<VehicleType>Дорожные</VehicleType>
		<AdType>Продаю свое</AdType>
		<Street>Москва, м. Тушинская</Street>
		<Description>
			<![CDATA[
				Рама 57 см. Комплектацию см. ниже, оборудование не менялось.
				Куплен в 2010г. Пробег 2270, по асфальту.
				Состояние хорошее. Рабочие потертости (см. фото).
				Продаю, потому что не катаюсь.
				<ul>
					<li>Рама, вилка – Specialized A1 Premium Aluminum</li>
					<li>Руль Specialized low rise</li>
					<li>Рукоятки руля – Body Geometry Comfort</li>
					<li>Тормоза (передний и задний) – дисковые, Avid BB5. Колодки еще походят.</li>
					<li>Система переключения передач – Shimano, 3х8 передач</li>
					<li>Педали – Globe anti-slip composite</li>
					<li>Обода – Specialized/Alex Globe, 700c, 32h</li>
					<li>Шины – Nimbus Sport 700x35c, 60TPI</li>
					<li>Сиденье – Specialized Sonoma 155mm</li>
				</ul>
				Отдаю с крыльями и велокомпьютером.
				Контактный номер - Николай.
				Велосипед в Красногорске, место встречи обсудим. Тушино, Митино, Красногорск и пр.
			]]>
		</Description>
		<Region>Москва</Region>
		<Price>19700</Price>
		<ManagerName>Менеджер по продажам</ManagerName>
		<EMail>manager@test.com</EMail>
		<AllowEmail>Да</AllowEmail>
		<Images>
			<Image url=\"https://85.img.avito.st/640x480/3577384685.jpg\"></Image>
			<Image url=\"https://39.img.avito.st/640x480/3577388839.jpg\"></Image>
			<Image url=\"https://99.img.avito.st/640x480/3577393799.jpg\"></Image>
			<Image url=\"https://13.img.avito.st/640x480/3577394413.jpg\"></Image>
			<Image url=\"https://96.img.avito.st/640x480/3577394896.jpg\"></Image>
		</Images>
		<AdStatus>Free</AdStatus>
	</Ad>
</Ads>
";
?>