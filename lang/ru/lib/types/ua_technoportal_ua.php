<?
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_NAME"] = "Выгрузка на портал Technoportal.ua";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_ID"] = "Идентификатор торгового предложения";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_AVAILABLE"] = "Cтатус доступности товара";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_URL"] = "URL страницы товара.<br/>Максимальная длина URL — 512 символов.<br/>Необязательный элемент для магазинов-салонов";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_PRICE"] = "Цена, по которой данный товар можно приобрести.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_CURRENCY"] = "Идентификатор валюты товара (RUR, USD, UAH, KZT).<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_CATEGORY"] = "Идентификатор категории товара.<br/>Товарное предложение может принадлежать только одной категории.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_PICTURE"] = "Ссылка на картинку соответствующего товарного предложения";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_DELIVERY"] = "Возможность доставки<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_VENDOR"] = "Производитель. Не отображается в названии предложения";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_NAME"] = "Наименование товарного предложения.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_DESCRIPTION"] = "Описание товара.<br/>Длина текста не более 175 символов (не включая знаки препинания),<br/> запрещено использовать HTML-теги <br/>(информация внутри тегов публиковаться не будет)";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_WARRANTY"] = "Число месяцев, на которые дается гарантия на товар. Необязательный элемент.";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_SOURCE"] = "UTM метка: рекламная площадка";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_SOURCE_VALUE"] = "cpc_yandex_market";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_MEDIUM"] = "UTM метка: тип рекламы";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_MEDIUM_VALUE"] = "cpc";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_TERM"] = "UTM метка: ключевая фраза";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_CONTENT"] = "UTM метка: контейнер для дополнительной информации";
$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_UTM_CAMPAIGN"] = "UTM метка: название рекламной кампании";

$MESS["DATA_EXPORTPROPLUS_UA_TECHNOPORTAL_UA_FIELD_PARAM"] = "Характеристики товара";
$MESS["DATA_EXPORTPROPLUS_TYPE_UA_TECHNOPORTAL_UA_PORTAL_REQUIREMENTS"] = "http://technoportal.ua/shops/requirements_info.html";
$MESS["DATA_EXPORTPROPLUS_TYPE_UA_TECHNOPORTAL_UA_EXAMPLE"] = "
<offer id=\"4707\" available=\"true\">
    <url>http://www.shop.com.ua/Samsung-RV518-NP-RV518-A02UA?from=technoportal</url>
    <price>464</price>
    <currencyId>USD</currencyId>
    <categoryId>73</categoryId>
    <picture>http://www.shop.com.ua/data/small/samsung_rv518_(np-rv518-a02ua)_4.jpg</picture>
    <delivery>true</delivery>
    <vendor>Samsung</vendor>
    <name>Ноутбук Samsung RV518 (NP-RV518-A02UA)</name>
    <description>Экран 15.6 / (1366х768) HD / Intel Pentium DC B940(2.0Ghz)</description>
    <warranty>24</warranty>
</offer>
";
?>