<?
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_NAME"] = "Выгрузка на портал Nadavi.net";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_ID"] = "Идентификатор торгового предложения";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_AVAILABLE"] = "Cтатус доступности товара";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_URL"] = "URL страницы товара.<br/>Максимальная длина URL — 512 символов.<br/>Необязательный элемент для магазинов-салонов";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_PRICE"] = "Цена, по которой данный товар можно приобрести.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_CURRENCY"] = "Идентификатор валюты товара (RUR, USD, UAH, KZT).<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_CATEGORY"] = "Идентификатор категории товара.<br/>Товарное предложение может принадлежать только одной категории.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_PICTURE"] = "Ссылка на картинку соответствующего товарного предложения";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_NAME"] = "Наименование торгового предложения.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_DESCRIPTION"] = "Описание товара.<br/>Длина текста не более 175 символов (не включая знаки препинания),<br/> запрещено использовать HTML-теги <br/>(информация внутри тегов публиковаться не будет)";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_TYPEPREFIX"] = "Группа товаров/категория<br/>дополнительный параметр, например: Утюг, Чайник, Ковеварка)";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_VENDOR"] = "Производитель. Не отображается в названии предложения";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_SOURCE"] = "UTM метка: рекламная площадка";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_SOURCE_VALUE"] = "cpc_yandex_market";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_MEDIUM"] = "UTM метка: тип рекламы";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_MEDIUM_VALUE"] = "cpc";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_TERM"] = "UTM метка: ключевая фраза";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_CONTENT"] = "UTM метка: контейнер для дополнительной информации";
$MESS["DATA_EXPORTPROPLUS_UA_NADAVI_NET_FIELD_UTM_CAMPAIGN"] = "UTM метка: название рекламной кампании";

$MESS["DATA_EXPORTPROPLUS_TYPE_UA_NADAVI_NET_PORTAL_REQUIREMENTS"] = "http://nadavi.net/nadavi.php?idPage_=57&idBookmark_=5";
$MESS["DATA_EXPORTPROPLUS_TYPE_UA_NADAVI_NET_EXAMPLE"] = "
<item id=\"12346\">
    <url>http://best.seller.ru/product_page.asp?pid=12348</url>
    <price>600</price>
    <categoryId>6</categoryId>
    <typePrefix>Часы</typePrefix>
    <vendor>Casio</vendor>
    <name>Наручные часы Casio A1234567B</name>
    <image>http://best.seller.ru/img/device12345.jpg</image>
    <description>Изящные наручные часы.</description>
</item>
";
?>