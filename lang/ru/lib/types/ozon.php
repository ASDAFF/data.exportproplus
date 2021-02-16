<?
$MESS["DATA_EXPORTPROPLUS_OZON"] = "Экспорт на торговую площадку Ozon.ru";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ID"] = "Содержит указание (идентификационный номер) на конкретный тип товара.<br/><b class='required'>Обязательный атрибут (не показывается на сайте)</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_NAME"] = "Содержит наименование товара, которое затем показыватся как название<br/> в карточке товара на сайте ozon.ru. Обратите внимание, <br/>что в структуре данных есть два элемента, отвечающих на наименование товара:<br/>SKU.Name и Description.Name. Данные в этих полях обязательно должны быть равны.<br/>Значение SKU.Name используется только при создании товара (без этого элемента<br/> товар не может быть создан), а также в случаях, когда блок Description не передан.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MANUFACTURER_IDENTIFIER"] = "Содержит код товара от производителя (не показывается на сайте).<br/>Например, для книг это ISBN, для электроники это серийный номер.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_GROSS_WEIGHT"] = "Содержит целочисленное значение веса товара в упаковке (брутто)<br/>в граммах (показывается в цепочке оформления заказа).<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_INTERNAL_NAME"] = "Содержит внутреннее наименование товара в информационной<br/>системе мерчанта (не показывается на сайте).";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SELLING_PRICE"] = "Содержит цену товара (в рублях) до скидки с точностью до двух знаков после запятой";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_DISCOUNT"] = "Содержит целочисленное значение скидки на товар в процентах.<br/>Может принимать значение от 0 до 99. Скидка равная 0 означает отсутствие скидки.<br/>Обратите внимание, что если элемент не передан,<br/> то это не приводит к снятию скидки с товара.<br/>Для снятия с товара ранее установленной скидки <br/>необходимо передать значение <Discount>0</Discount>.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_AVAILABLE"] = "Содержит информацию о статусе товара (не показывается на сайте).";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SUPPLY_STATE"] = "Содержит информацию о состоянии поставки.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SUPPLY_PERIOD"] = "Содержит информацию о сроке поставки товара под заказ.<br/>
Поле содержит перечень значений, соответствующих надписям в блоке - Под заказ - на сайте ozon.ru:<br/>
In3Days (В течение 3 дней)<br/>
In10Days (В течение 10 дней)<br/>
In14Days (В течение 14 дней)<br/>
In45Days (В течение 45 дней)<br/>
NotAvailable (Не доступен под заказ)";

$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SUPPLY_QTY"] = "Содержит информацию о количестве товара (свободном остатке) на складе мерчанта (не показывается на сайте).";

$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ALTERNAME"] = "Альтернативное название.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ELUCIDATIVENAME"] = "Пояснительное наименование.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_STICKERINFO"] = "Информация для стикера.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ANNOTATION"] = "Аннотация.";

$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_PICTURE"] = "Главное изображение, является обязательным и может быть только одно.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_IMAGES"] = "Дополнительных изображений может быть несколько (максимум 20).";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_RELEASEYEAR"] = "Год выпуска товара. Данное значение затем выводится<br/>в блоке с описанием в карточке товара.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_COUNTRY"] = "Страна-изготовитель.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_PACKING"] = "Упаковка.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_PRODUCER_NAME"] = "Название производителя товара, данное значение затем выводится<br/> в блоке с описанием в карточке товара.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_PRODUCER_COMPANYINFO"] = "Род деятельности.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_NAME"] = "Название характеристики. Здесь необходимо передать название<br/>набора характеристик присущих товару. Рекомендуемый<br/> формат передачи названия характеристик товара:<br/>Бренд + Модель, например: Salomon OutBan Mid.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_OPTIONAL"] = "Дополнительно";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_AGESPORT"] = "Возраст";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_HEIGHT"] = "Высота, см";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_MUSCLEGROUPS"] = "Тренируемые группы мышц";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_MAXUSERWEIGHT"] = "Максимальный вес пользователя, кг";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_SYSTEMWEIGHT"] = "Система нагрузки";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_EXERCISES"] = "Упражнения";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_CONTROL"] = "Регулировки";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_ENCODERS"] = "Измерительные датчики";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_LEVEL"] = "Класс тренажера";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_FEATURES"] = "Особенности";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_DISTFROMWALL"] = "Расстояние от стены, см";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_PROGSQTY"] = "Кол-во программ";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_MAXANGLE"] = "Макс. угол наклона полотна, %";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_SPORTTYPE"] = "Вид спорта";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_PURPOSE"] = "Назначение.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_MATERIAL"] = "Материал.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_AGEMIN"] = "Мин. возраст ребенка, лет.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_AGEMAX"] = "Макс. возраст ребенка, лет.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_MAXLOADCOMPLEX"] = "Макс. нагрузка на комплекс, кг.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_MAXLOADUNIT"] = "Макс. нагрузка на один снаряд, кг.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_ACCESSORIES"] = "Комплектация.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_PLAYGROUND"] = "Вид площадки.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_LENGTH"] = "Длина, м.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_WIDTH"] = "Ширина, м.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_TYPE"] = "Тип характеристики. Выбирается из справочника, значения<br/>которого можно получить из таблицы TypeTable в XSD схеме.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_ANNOTATION"] = "Маркетинговое описание товара или просто аннотация.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_CAPABILITY_CAPABILITY_EXTERNALID"] = "Обязательный атрибут и внешний идентификатор товара,<br/>значение которого может совпадать со сзначением MerchantSKU.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_BRAND_NAME"] = "Название бренда. Данное значение затем<br/>используется для поиска товара в каталоге.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_BRAND_COMPANYINFO"] = "Род деятельности.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SERIA_NAME"] = "Название серии.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SUBSTANCE"] = "Материал.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_COLOR_NAME"] = "Название цвета, в отличие от привязанного к справочнику<br/>атрибута Color, заполняется произвольно, это сделано для тех случаев, <br/>когда к значению цвета, указанного при помощи справочника, требуется уточнение.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_COLOR_COLOR"] = "Значение цвета, выбирается из справочника,<br/>значения которого можно получить из таблицы Color_ColorTable в XSD схеме.<br/><b class='required'>Поле является обязательным.</b>";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_DIMENSIONS"] = "Размеры, мм.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_WARRANTY"] = "Гарантия.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SCALE"] = "Масштаб.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_WEIGHT"] = "Вес.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SEX"] = "Пол.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ELEMENTCOUNT"] = "Количество элементов.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_FROMAGE"] = "Возраст мин.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_TOAGE"] = "Возраст макс.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ARTICLE"] = "Артикул.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_RESTRICTION"] = "Ограничения.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_AGEO"] = "Целевая аудитория.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_COMPOSITION"] = "Состав.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SEARCHNAME"] = "Поисковое название.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_NUM"] = "Количество в упаковке.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_SEASON"] = "Сезон.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_ASPECT"] = "Аспект.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_INTERNALCOMMENT"] = "Внутренний комментарий.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_PACKAGE"] = "Комплектация.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_COMMENT"] = "Комментарий.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_NAME"] = "Название видеоролика.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_SIZE"] = "Размер, Мб видеоролика.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_WIDTH"] = "Ширина видеоролика.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_HEIGHT"] = "Высота видеоролика.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_DURATIONTIME"] = "Длительность, чч:мм:сс видеоролика.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_STREAMMOVIE"] = "Видеопоток видеоролика.";
$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_MOVIE_YOUTUBE"] = "YouTube видеоролика.";

$MESS["DATA_EXPORTPROPLUS_OZON_FIELD_TDIMENSIONS"] = "Габариты упаковки, см. Поле должно быть заполнено в<br/>формате Д x Ш x В (с пробелами), например: например: 15.5 x 16 x 3.7.";
$MESS["DATA_EXPORTPROPLUS_TYPE_OZON_SCHEME_DESCRIPTION"] = "<br/><b style='color:red'>Блок Description содержит информацию об описании товара.<br/>
Данные этого блока не являются обязательными для создания товара, однако без описания товар не может быть выставлен в продажу на вебвитрине.<br/>
Структура данных в блоке Description полностью зависит от типа товара, поэтому задается отдельной схемой. Для получения информации<br/>
о структуре данных конкретного типа товара обратитесь в поддержку модуля или сервиса ozon.ru</b>";
$MESS["DATA_EXPORTPROPLUS_TYPE_OZON_PORTAL_REQUIREMENTS"] = "http://merchant-platform.ozon.ru/структура-ozon-xml";
$MESS["DATA_EXPORTPROPLUS_TYPE_OZON_PORTAL_VALIDATOR"] = "https://merchants.ozon.ru/Products/Import/Manual";
$MESS["DATA_EXPORTPROPLUS_TYPE_OZON_EXAMPLE"] = '
<Product MerchantSKU="Код_товара_в_ИС_мерчанта" ProductTypeID="286495572000">
    <SKU>
        <Name>Название товара</Name>
        <ManufacturerIdentifier>123456789</ManufacturerIdentifier>
        <GrossWeight>861</GrossWeight>
        <InternalName>Внутреннее название товара в ИС мерчанта. Не отображается на вебвитрине.</InternalName>
    </SKU>
    <Price>
        <SellingPrice>123</SellingPrice>
        <Discount>20</Discount>
    </Price>
    <Availability>
        <SellingState>ForSale</SellingState>
        <SupplyPeriod></SupplyPeriod>
        <Qty></Qty>
    </Availability>
    <Description>
        <!-- Структура данных блока Description зависит от типа товара (ProductTypeID)
        и будет рассмотрена в отдельной статье. -->
    </Description>
</Product>
';
?>