<?
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_NAME"] = "Экспорт в систему авито (Мотоциклы и мототехника)";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_ID"] = "Уникальный идентификатор объявления<br/>(строка не более 100 символов)<br/><b class='required'>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_DATEBEGIN"] = "Дата начала экспозиции объявления";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_DATEEND"] = "Дата конца экспозиции объявления";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_LISTINGFEE"] = "Вариант платного размещения — одно из значений списка:<br/><br/>Package — размещение объявления осуществляется только при наличии подходящего пакета размещения;<br/>PackageSingle — при наличии подходящего пакета оплата размещения объявления произойдет с него; если нет подходящего пакета, но достаточно денег на кошельке Avito, то произойдет разовое размещение;<br/>Single — только разовое размещение, произойдет при наличии достаточной суммы на кошельке Avito; если есть подходящий пакет размещения, он будет проигнорирован.<br/>Если элемент пуст или отсутствует, то значение по умолчанию — Package.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_ADSTATUS"] = "Платная услуга, которую нужно применить к объявлению — одно из значений списка:<br/><br/>Free — обычное объявление;<br/>Premium — премиум-объявление;<br/>VIP — VIP-объявление;<br/>PushUp — поднятие объявления в поиске;<br/>Highlight — выделение объявления;<br/>TurboSale— применение пакета Турбо-продажа;<br/>QuickSale — применение пакета Быстрая продажа.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_AVITOID"] = "Номер объявления на Avito — целое число.<br/>Если вы разместили объявление вручную, а теперь хотите управлять объявлением с помощью Автозагрузки — укажите здесь номер объявления на сайте Авито.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_ALLOWEMAIL"] = "Возможность написать сообщение по объявлению через сайт — одно из значений списка: Да, Нет. Примечание: значение по умолчанию — Да.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_MANAGERNAME"] = "Имя менеджера, контактного лица компании по данному объявлению — строка не более 40 символов.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_CONTACTPHONE"] = "Контактный телефон — строка, содержащая только один российский номер телефона; должен быть обязательно указан код города или мобильного оператора. Корректные примеры:<br/>+7 (495) 777-10-66,<br/>(81374) 4-55-75,<br/>8 905 207 04 90,<br/>+7 905 2070490,<br/>88123855085,<br/>9052070490.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_REGION"] = "Регион,<br/>в котором находится объект объявления<br/>в соответствии со значениями из справочника.<br/><b class='required'>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_CITY"] = "Город или населенный пункт, в котором находится объект объявления — в соответствии со значениями из справочника.<br/>
Элемент обязателен для всех регионов, кроме Москвы и Санкт-Петербурга.<br/>
Справочник является неполным. Если требуемое значение в нем отсутствует, то укажите ближайший к вашему объекту пункт из справочника, а точное название населенного пункта — в элементе Street.";

$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_SUBWAY"] = "Ближайшая станция метро<br/>(в соответствии со значениями из справочника)";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_DISTRICT"] = "Район города — в соответствии со значениями из справочника.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_CATEGORY"] = "Категория товара — строка: Мотоциклы и мототехника";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_CATEGORY_VALUE"] = "Мотоциклы и мототехника";

$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_VEHICLETYPE"] = "<b>Вид техники — одно из значений списка:</b><br/><br/>
Багги<br/>
Вездеходы<br/>
Картинг<br/>
Квадроциклы<br/>
Мопеды и скутеры<br/>
Мотоциклы<br/>
Снегоходы";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_MOTOTYPE"] = "<b>Тип мотоцикла — одно из значений списка:</b><br/><br/>
Дорожные<br/>
Кастом-байки<br/>
Кросс и эндуро<br/>
Спортивные<br/>
Чопперы";

$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_TITLE"] = "Название объявления — строка до 50 символов.<br/>Примечание: не пишите в название цену и контактную информацию — для этого есть отдельные поля — и не используйте слово - продам.";
$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_DESCRIPTION"] = "Текстовое описание объявления в соответствии с правилами Avito — строка не более 3000 символов.";

$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_PRICE"] = "Цена в рублях";

$MESS["DATA_EXPORTPROPLUS_AVITO_MOTO_FIELD_IMAGE"] = "Изображения";
$MESS["DATA_EXPORTPROPLUS_TYPE_AVITO_MOTO_PORTAL_REQUIREMENTS"] = "http://autoload.avito.ru/format/mototsikly_i_mototehnika/";
$MESS["DATA_EXPORTPROPLUS_TYPE_AVITO_MOTO_PORTAL_VALIDATOR"] = "http://autoload.avito.ru/format/xmlcheck/";
$MESS["DATA_EXPORTPROPLUS_TYPE_AVITO_MOTO_EXAMPLE"] = "
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
	<Ads target=\"Avito.ru\" formatVersion=\"3\">
	<Ad>
		<Id>234132234143</Id>
		<Title>Yamaha Z1000</Title>
		<Category>Мотоциклы и мототехника</Category>
		<VehicleType>Мотоциклы</VehicleType>
		<MotoType>Дорожные</MotoType>
		<Description>
			<![CDATA[Мотоцикл куплен у официального дилера. 
				Оригинал ПТС.
				Дополнительное оборудование: 
				- Прямоточная выхлопная система FMF. 
				- Центральный кофр. 
				- Бачки тормозной жидкости.
			]]>
		</Description>
		<Region>Москва</Region>
		<Price>399000</Price>
		<ManagerName>Менеджер по продажам</ManagerName>
		<EMail>manager@test.com</EMail>
		<AllowEmail>Да</AllowEmail>
		<Images>
			<Image url=\"https://popmotor.ru/wp-content/uploads/2013/10/2015-Kawasaki-Z1000-ABS4.jpg\"/>
			<Image url=\"http://onlymotorbikes.com/public/81/kawasaki-z-1000-2011-moto.jpeg\"/>
		</Images>
		<AdStatus>Free</AdStatus>
	</Ad>
	<Ad>
		<Id>45623463456</Id>
		<Title>Buran Leader</Title>
		<Category>Мотоциклы и мототехника</Category>
		<Description>
			Продается снегоход, 2007г., 34л.с. , в хорошем рабочем состоянии, трехрядная цепь,
			датчик температуры, замена подшипников ходовой в прошлом сезоне, подогрев ручек руля,
			электростартер, карбюратор \"Микуни\" наст. Япония
		</Description>
		<VehicleType>Снегоходы</VehicleType>
		<InspectionPlace>Находится в начале Владимирской обл. Киржачский р-н</InspectionPlace>
		<Region>Москва</Region>
		<Price>130000</Price>
		<ManagerName>Менеджер по продажам</ManagerName>
		<EMail>manager@test.com</EMail>
		<AllowEmail>Да</AllowEmail>
		<Images>
			<Image url=\"http://rossnegohod.ru/image/cache/catalog/buran-leader-74x74.jpg\"/>
			<Image url=\"http://rossnegohod.ru/image/cache/catalog/buran-leader_color_4-74x74.jpg\"/>
		</Images>
		<AdStatus>Free</AdStatus>
	</Ad>
</Ads>
";
?>