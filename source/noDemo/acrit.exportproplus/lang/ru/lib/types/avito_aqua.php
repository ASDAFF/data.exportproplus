<?
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_NAME"] = "Экспорт в систему авито (Водный транспорт)";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_ID"] = "Уникальный идентификатор объявления<br/>(строка не более 100 символов)<br/><b class='required'>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DATEBEGIN"] = "Дата начала экспозиции объявления";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DATEEND"] = "Дата конца экспозиции объявления";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_LISTINGFEE"] = "Вариант платного размещения — одно из значений списка:<br/><br/>Package — размещение объявления осуществляется только при наличии подходящего пакета размещения;<br/>PackageSingle — при наличии подходящего пакета оплата размещения объявления произойдет с него; если нет подходящего пакета, но достаточно денег на кошельке Avito, то произойдет разовое размещение;<br/>Single — только разовое размещение, произойдет при наличии достаточной суммы на кошельке Avito; если есть подходящий пакет размещения, он будет проигнорирован.<br/>Если элемент пуст или отсутствует, то значение по умолчанию — Package.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_ADSTATUS"] = "Платная услуга, которую нужно применить к объявлению — одно из значений списка:<br/><br/>Free — обычное объявление;<br/>Premium — премиум-объявление;<br/>VIP — VIP-объявление;<br/>PushUp — поднятие объявления в поиске;<br/>Highlight — выделение объявления;<br/>TurboSale— применение пакета Турбо-продажа;<br/>QuickSale — применение пакета Быстрая продажа.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_AVITOID"] = "Номер объявления на Avito — целое число.<br/>Если вы разместили объявление вручную, а теперь хотите управлять объявлением с помощью Автозагрузки — укажите здесь номер объявления на сайте Авито.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_ALLOWEMAIL"] = "Возможность написать сообщение по объявлению через сайт — одно из значений списка: Да, Нет. Примечание: значение по умолчанию — Да.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_MANAGERNAME"] = "Имя менеджера, контактного лица компании по данному объявлению — строка не более 40 символов.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CONTACTPHONE"] = "Контактный телефон — строка, содержащая только один российский номер телефона; должен быть обязательно указан код города или мобильного оператора. Корректные примеры:<br/>+7 (495) 777-10-66,<br/>(81374) 4-55-75,<br/>8 905 207 04 90,<br/>+7 905 2070490,<br/>88123855085,<br/>9052070490.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_REGION"] = "Регион,<br/>в котором находится объект объявления<br/>в соответствии со значениями из справочника.<br/><b class='required'>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CITY"] = "Город или населенный пункт, в котором находится объект объявления — в соответствии со значениями из справочника.<br/>
Элемент обязателен для всех регионов, кроме Москвы и Санкт-Петербурга.<br/>
Справочник является неполным. Если требуемое значение в нем отсутствует, то укажите ближайший к вашему объекту пункт из справочника, а точное название населенного пункта — в элементе Street.";

$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_SUBWAY"] = "Ближайшая станция метро<br/>(в соответствии со значениями из справочника)";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DISTRICT"] = "Район города — в соответствии со значениями из справочника.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CATEGORY"] = "Категория товара — строка: Водный транспорт";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CATEGORY_VALUE"] = "Водный транспорт";

$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_VEHICLETYPE"] = "<b>Вид техники — одно из значений списка:</b><br/><br/>
Вёсельный лодки<br/>
Гидроциклы<br/>
Катера и яхты<br/>
Каяки и каноэ<br/>
Моторные лодки<br/>
Надувные лодки<br/>";

$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_TITLE"] = "Название объявления — строка до 50 символов.<br/>Примечание: не пишите в название цену и контактную информацию — для этого есть отдельные поля — и не используйте слово - продам.";
$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DESCRIPTION"] = "Текстовое описание объявления в соответствии с правилами Avito — строка не более 3000 символов.";

$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_PRICE"] = "Цена в рублях";

$MESS["ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_IMAGE"] = "Изображения";
$MESS["ACRIT_EXPORTPROPLUS_TYPE_AVITO_AQUA_PORTAL_REQUIREMENTS"] = "http://autoload.avito.ru/format/vodnyy_transport/";
$MESS["ACRIT_EXPORTPROPLUS_TYPE_AVITO_AQUA_PORTAL_VALIDATOR"] = "http://autoload.avito.ru/format/xmlcheck/";
$MESS["ACRIT_EXPORTPROPLUS_TYPE_AVITO_AQUA_EXAMPLE"] = "
<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<Ads target=\"Avito.ru\" formatVersion=\"3\">
	<Ad>
		<Id>436453624543</Id>
		<Title>Отличный гидроцикл Yamaha VX</Title>
		<Category>Водный транспорт</Category>
		<Description>Новый гидроцикл Yamaha VX700S 2017</Description>
		<VehicleType>Гидроциклы</VehicleType>
		<Region>Москва</Region>
		<Price>500000</Price>
		<ManagerName>Менеджер по продажам</ManagerName>
		<EMail>manager@test.com</EMail>
		<AllowEmail>Да</AllowEmail>
		<Images>
			<Image url=\"http://www.jest-yamaha.ru/cms-images/yamaha_gallery/2675image_normal_2015-Yamaha-VX700S-RU-Green-Static-001.jpg\"/>
		</Images>
		<AdStatus>Free</AdStatus>
	</Ad>
</Ads>
";
?>