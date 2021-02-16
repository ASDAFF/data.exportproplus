<?
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_NAME"] = "Косметика, парфюмерия и уход (ym_cosmetics)";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_ID"] = "Идентификатор торгового предложения";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_BID"] = "Основная ставка клика";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_GROUP_ID"] = "Элемент используется в описаниях всех предложений, которые являются вариациями одной модели, при этом элемент должен иметь одинаковое значение. Значение должно быть целым числом, максимум 9 разрядов.";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_AVAILABLE"] = "Cтатус доступности товара";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_BASEDELIVERYCOST"] = "Стоимость доставки любого товара в своем регионе";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_BASEDELIVERYDAYS"] = "Сроки доставки любого товара в своем регионе в рабочих днях. Если магазин готов доставить товары в день заказа (сегодня), используйте значение 0.<br/><br/> <b>Внимание!</b><br/>Убедитесь, что на странице партнерского интерфейса Информация о доставке выбран вариант Данные в прайс-листе. Чтобы попасть на страницу, нажмите ссылку изменить напротив параметра Стоимость доставки в своем регионе на странице Настройки -> Параметры размещения.";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_BASEORDERBEFORE"] = "В атрибуте указывается локальное время (в часовом поясе магазина). В качестве значения можно использовать только целое число от 0 до 24. Например, время 14:00 описывается следующим образом: order-before=\"14\". Указание атрибута необязательно, по умолчанию используется значение 24 (полночь)";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_URL"] = "URL страницы товара.<br/>Максимальная длина URL — 512 символов.<br/>Необязательный элемент для магазинов-салонов";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PRICE"] = "Цена, по которой данный товар можно приобрести.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_OLDPRICE"] = "Старая цена на товар, которая обязательно должна быть выше новой цены (<price>). Параметр <oldprice> необходим для автоматического расчета скидки на товар";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_CURRENCY"] = "Идентификатор валюты товара (RUR, USD, UAH, KZT).<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_VAT"] = "Значения VAT:<br/><br/>
18%. Основная ставка НДС.<br/>
Формат для прайс-листа: <vat>1</vat> или <vat>VAT_18</vat><br/><br/>
10%. Применяется при реализации отдельных категорий товаров и услуг, например, при реализации ряда продовольственных товаров, товаров для детей, некоторых медицинских товаров, печатных изданий и т.п.<br/>
Формат для прайс-листа: <vat>2</vat> или <vat>VAT_10</vat><br/><br/>
18/118. Расчётная ставка НДС, которая применяется при получении предоплаты в счет предстоящих поставок товаров и оказания услуг, реализация которых облагается по ставке НДС 18%.<br/>
Формат для прайс-листа: <vat>3</vat> или <vat>VAT_18_118</vat><br/><br/>
10/110. Расчётная ставка НДС, которая применяется при получении предоплаты в счет предстоящих поставок товаров и оказания услуг, реализация которых облагается по ставке НДС 10%.<br/>
Формат для прайс-листа: <vat>4</vat> или <vat>VAT_10_110</vat><br/><br/>
НДС 0%. Применяется, например, при реализации товаров, вывезенных в таможенной процедуре экспорта; оказании услуг по международной перевозке товаров.<br/>
Формат для прайс-листа: <vat>5</vat> или <vat>VAT_0</vat><br/><br/>
НДС не облагается. Применяется при реализации отдельных категорий товаров и услуг, например, ряда медицинских товаров и услуг, исключительных прав на программы для ЭВМ, базы данных и т.п., а также в случае применения специальных режимов налогообложения.<br/>
Формат для прайс-листа: <vat>6</vat> или <vat>NO_VAT</vat><br/><br/>
Обратите внимание, что передать ставку Маркету можно в любом формате. Если вы укажете 18% или 10% для чека, который будет сформирован при оплате товара на Маркете, мы автоматически преобразуем ставку в 18/118 или в 10/110, чтобы соблюсти требование налоговой службы.
";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_CATEGORY"] = "Идентификатор категории товара.<br/>Товарное предложение может принадлежать только одной категории.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_GROUPID"] = "Элемент используется в описаниях всех предложений, которые являются вариациями одной модели, при этом элемент должен иметь одинаковое значение. Значение должно быть целым числом, максимум 9 разрядов.<br/>
Является атрибутом элемента offer.<br/><br/><b>Внимание!</b><br/>Элемент используется только в формате YML и только в категориях Одежда, обувь и аксессуары, Мебель, Косметика, парфюмерия и уход, Детские товары, Аксессуары для портативной электроники.";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PICTURE"] = "Ссылка на картинку соответствующего товарного предложения";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_MODEL"] = "Наименование товарного предложения.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_DESCRIPTION"] = "Описание товара.<br/>Длина текста не более 175 символов (не включая знаки препинания),<br/> запрещено использовать HTML-теги <br/>(информация внутри тегов публиковаться не будет)";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_STORE"] = "Покупка соответствующего товара в розничном магазине<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PICKUP"] = "Возможность зарезервировать выбранный товар и забрать его самостоятельно<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_DELIVERY"] = "Возможность доставки<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_LOCALDELIVERYCOST"] = "Стоимость доставки данного товара в своем регионе";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_LOCALDELIVERYDAYS"] = "Сроки доставки данного товара в своем регионе в рабочих днях. Если магазин готов доставить товары в день заказа (сегодня), используйте значение 0.<br/><br/> <b>Внимание!</b><br/>Убедитесь, что на странице партнерского интерфейса Информация о доставке выбран вариант Данные в прайс-листе. Чтобы попасть на страницу, нажмите ссылку изменить напротив параметра Стоимость доставки в своем регионе на странице Настройки -> Параметры размещения.";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_LOCALORDERBEFORE"] = "В атрибуте указывается локальное время (в часовом поясе магазина). В качестве значения можно использовать только целое число от 0 до 24. Например, время 14:00 описывается следующим образом: order-before=\"14\". Указание атрибута необязательно, по умолчанию используется значение 24 (полночь)";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_VENDOR"] = "Производитель. Не отображается в названии предложения";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_VENDORCODE"] = "Код товара (указывается код производителя)";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_BARCODE"] = "Штрихкод товара, указанный производителем";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_TYPEPREFIX"] = "Группа товаров/категория";

$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_RANGE"] = "Товарная линейка производителя";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_RANGE_VALUE"] = "Линейка";

$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_COLOR"] = "Цвет. Для того товарного предложения где применима характеристика \"цвет\", например, лак для ногтей, обязательно нужно указывать цвет товара.";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_COLOR_VALUE"] = "Цвет";

$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_VOLUME"] = "Объем. Для того товарного предложения где применимо понятие объема, например, туалетная вода или лосьон для тела, обязательно нужно указывать объем товара.";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_VOLUME_VALUE"] = "Объем";

$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_GENDER"] = "Пол. Для передачи информации о том, для какого пола предназначен товар, указанный в товарном предложении. Возможные значения элемента: \"Женский\" и \"Мужской\".";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM_GENDER_VALUE"] = "Пол";

$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_PARAM"] = "Характеристики товара";

$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_SOURCE"] = "UTM метка: рекламная площадка";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_SOURCE_VALUE"] = "cpc_yandex_market";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_MEDIUM"] = "UTM метка: тип рекламы";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_MEDIUM_VALUE"] = "cpc";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_TERM"] = "UTM метка: ключевая фраза";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_CONTENT"] = "UTM метка: контейнер для дополнительной информации";
$MESS["DATA_EXPORTPROPLUS_MARKET_COSMETICS_FIELD_UTM_CAMPAIGN"] = "UTM метка: название рекламной кампании";
$MESS["DATA_EXPORTPROPLUS_TYPE_MARKET_COSMETICS_PORTAL_REQUIREMENTS"] = "https://yandex.ru/support/partnermarket/guides/beauty.xml";
$MESS["DATA_EXPORTPROPLUS_TYPE_MARKET_COSMETICS_PORTAL_VALIDATOR"] = "https://webmaster.yandex.ru/tools/xml-validator/";
$MESS["DATA_EXPORTPROPLUS_TYPE_MARKET_COSMETICS_EXAMPLE"] = "<offer id=\"1234148\" type=\"vendor.model\" available=\"true\" bid=\"80\" group_id=\"12345\">
    <url>http://best.cosm.ru/product_page.asp?pid=12344</url>
    <price>1000</price>
    <currencyId>RUR</currencyId>
    <categoryId>6</categoryId >
    <market_category>Красота и здоровье/Косметика, парфюмерия и уход/Макияж/Помада и контур для губ</market_category>
    <picture>http://best.cosm.ru/img/picture1.jpg</picture>
    <picture>http://best.cosm.ru/img/picture2.jpg</picture>
    <picture>http://best.cosm.ru/img/picture3.jpg</picture>
    <picture>http://best.cosm.ru/img/picture4.jpg</picture>
    <store>true</store>
    <pickup>false</pickup>
    <delivery>true</delivery>
    <delivery-options>
      <option cost=\"200\" days=\"1\" order-before=\"14\"/>
    </delivery-options>
    <typePrefix>Губная помада</typePrefix>
    <vendor>CHRISTIAN DIOR</vendor>
    <model>Dior Addict</model>
    <description>Новая губная помада Dior Addict – это признание в любви красоте и стилю, цвету и его
    вдохновению, энергии и магнетизму Dior. Палитра, включающая 44 оттенка, позволяет создать настоящий
    подиумный образ. Невесомая текстура и волнующая гамма оттенков Addict отвечает последним модным
    тенденциям. Новая помада отличается более нежной текстурой и интенсивным блеском, в нее влюбляешься
    с первого взгляда.</description>
    <barcode>123948637284</barcode>
    <param name=\"Цвет\">445 Createur</param>
    <param name=\"RGB\">255,255,255</param>
    <param name=\"Пол\">Женский</param>
    <param name=\"Возраст\">Взрослый</param>
</offer>";
?>