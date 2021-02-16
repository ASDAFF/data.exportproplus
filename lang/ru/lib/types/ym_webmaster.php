<?
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_NAME"] = "Webmaster (ym_webmaster)";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_ID"] = "Идентификатор торгового предложения";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_BID"] = "Размер ставки на остальных местах размещения (кроме карточки модели).";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_CBID"] = "Размер ставки для карточки модели";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_FEE"] = "Размер комиссии на товарное предложение, участвующее в программе \"Заказ на Маркете\"";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_AVAILABLE"] = "Cтатус доступности товара";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_BASEDELIVERYCOST"] = "Стоимость доставки любого товара в своем регионе";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_BASEDELIVERYDAYS"] = "Сроки доставки любого товара в своем регионе в рабочих днях. Если магазин готов доставить товары в день заказа (сегодня), используйте значение 0.<br/><br/> <b>Внимание!</b><br/>Убедитесь, что на странице партнерского интерфейса Информация о доставке выбран вариант Данные в прайс-листе. Чтобы попасть на страницу, нажмите ссылку изменить напротив параметра Стоимость доставки в своем регионе на странице Настройки -> Параметры размещения.";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_BASEORDERBEFORE"] = "В атрибуте указывается локальное время (в часовом поясе магазина). В качестве значения можно использовать только целое число от 0 до 24. Например, время 14:00 описывается следующим образом: order-before=\"14\". Указание атрибута необязательно, по умолчанию используется значение 24 (полночь)";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_URL"] = "URL страницы товара.<br/>Максимальная длина URL — 512 символов.<br/>Необязательный элемент для магазинов-салонов";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_PRICE"] = "Цена, по которой данный товар можно приобрести.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_OLDPRICE"] = "Старая цена на товар, которая обязательно должна быть выше новой цены (<price>). Параметр <oldprice> необходим для автоматического расчета скидки на товар";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_CURRENCY"] = "Идентификатор валюты товара (RUR, USD, UAH, KZT).<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_VAT"] = "Значения VAT:<br/><br/>
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
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_CATEGORY"] = "Идентификатор категории товара.<br/>Товарное предложение может принадлежать только одной категории.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_GROUPID"] = "Элемент используется в описаниях всех предложений, которые являются вариациями одной модели, при этом элемент должен иметь одинаковое значение. Значение должно быть целым числом, максимум 9 разрядов.<br/>
Является атрибутом элемента offer.<br/><br/><b>Внимание!</b><br/>Элемент используется только в формате YML и только в категориях Одежда, обувь и аксессуары, Мебель, Косметика, парфюмерия и уход, Детские товары, Аксессуары для портативной электроники.";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_PICTURE"] = "Ссылка на картинку соответствующего товарного предложения";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_NAME"] = "Наименование товарного предложения.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_DESCRIPTION"] = "Описание товара.<br/>Длина текста не более 175 символов (не включая знаки препинания),<br/> запрещено использовать HTML-теги <br/>(информация внутри тегов публиковаться не будет)";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_DOWNLOADABLE"] = "Элемент предназначен для обозначения товара, который можно скачать";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_AGE"] = "Возрастная категория товара";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_STORE"] = "Покупка соответствующего товара в розничном магазине<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_PICKUP"] = "Возможность зарезервировать выбранный товар и забрать его самостоятельно<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_DELIVERY"] = "Возможность доставки<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_LOCALDELIVERYCOST"] = "Стоимость доставки данного товара в своем регионе";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_LOCALDELIVERYDAYS"] = "Сроки доставки данного товара в своем регионе в рабочих днях. Если магазин готов доставить товары в день заказа (сегодня), используйте значение 0.<br/><br/> <b>Внимание!</b><br/>Убедитесь, что на странице партнерского интерфейса Информация о доставке выбран вариант Данные в прайс-листе. Чтобы попасть на страницу, нажмите ссылку изменить напротив параметра Стоимость доставки в своем регионе на странице Настройки -> Параметры размещения.";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_LOCALORDERBEFORE"] = "В атрибуте указывается локальное время (в часовом поясе магазина). В качестве значения можно использовать только целое число от 0 до 24. Например, время 14:00 описывается следующим образом: order-before=\"14\". Указание атрибута необязательно, по умолчанию используется значение 24 (полночь)";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_VENDOR"] = "Производитель. Не отображается в названии предложения";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_VENDORCODE"] = "Код товара (указывается код производителя)";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_SALESNOTES"] = "Элемент используется для отражения информации<br/>о минимальной сумме заказа, минимальной партии<br/>товара или необходимости предоплаты, а так же для<br/>описания акций, скидок и распродаж.<br/>Допустимая длина текста в элементе — 50 символов";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_MANUFACTURERWARRANTY"] = "Гарантия<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_COUNTRYOFORIGIN"] = "Страны производства товара.<br/> Список стран доступен по адресу:<br/>http://partner.market.yandex.ru/pages/help/Countries.pdf";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_ADULT"] = "Элемент обязателен для обозначения товара,<br/> имеющего отношение к удовлетворению сексуальных потребностей";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_BARCODE"] = "Штрихкод товара, указанный производителем";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_CPA"] = "<b>Участие товарных предложений в программе «Заказ на Маркете»:</b><br/>
0 — все товары из прайс-листа не участвуют в программе «Заказ на Маркете»;<br/>
1 — все товары из прайс-листа участвуют в программе «Заказ на Маркете».";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_PARAM"] = "Характеристики товара";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_TYPEPREFIX"] = "Группа товаров/категория";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_MODEL"] = "Модель";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_REC"] = "Рекомендуемые товары для покупки вместе с текущим";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_EXPIRY"] = "Срок годности";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_WEIGHT"] = "Веса товара.<br/><b>Вес указывается в килограммах с учетом упаковки</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_DIMENSIONS"] = "Габариты товара (длина, ширина, высота) в упаковке.<br/><b>Размеры указываются в сантиметрах</b>";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_SOURCE"] = "UTM метка: рекламная площадка";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_SOURCE_VALUE"] = "cpc_yandex_market";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_MEDIUM"] = "UTM метка: тип рекламы";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_MEDIUM_VALUE"] = "cpc";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_TERM"] = "UTM метка: ключевая фраза";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_CONTENT"] = "UTM метка: контейнер для дополнительной информации";
$MESS["DATA_EXPORTPROPLUS_MARKET_WEBMASTER_FIELD_UTM_CAMPAIGN"] = "UTM метка: название рекламной кампании";
$MESS["DATA_EXPORTPROPLUS_TYPE_MARKET_WEBMASTER_PORTAL_REQUIREMENTS"] = "https://yandex.ru/support/webmaster/goods-prices/technical-requirements.html";
$MESS["DATA_EXPORTPROPLUS_TYPE_MARKET_WEBMASTER_PORTAL_VALIDATOR"] = "https://webmaster.yandex.ru/tools/xml-validator/";
$MESS["DATA_EXPORTPROPLUS_TYPE_MARKET_WEBMASTER_EXAMPLE"] = "<offer id=\"12341\" type=\"vendor.model\" available=\"true\" bid=\"13\">
    <url>http://best.seller.ru/product_page.asp?pid=12344</url>
    <price>16800</price>
    <oldprice>17000</oldprice>
    <currencyId>USD</currencyId>
    <categoryId>6</categoryId>
    <picture>http://best.seller.ru/img/device12345.jpg</picture>
    <store>false</store>
    <pickup>false</pickup>
    <delivery>true</delivery>
    <delivery-options>
        <option cost=\"300\" days=\"0\" order-before=\"14\"/>
    </delivery-options>
    <typePrefix>Принтер</typePrefix>
    <vendor>НP</vendor>
    <vendorCode>CH366C</vendorCode>
    <model>Deskjet D2663</model>
    <description>Серия принтеров для людей, которым нужен надежный, простой в использовании
    цветной принтер для повседневной печати. Формат А4. Технология печати: 4-цветная термальная струйная.
    Разрешение при печати: 4800х1200 т/д.
    </description>
    <sales_notes>Необходима предоплата.</sales_notes>
    <manufacturer_warranty>true</manufacturer_warranty>
    <country_of_origin>Япония</country_of_origin>
    <barcode>1234567890120</barcode>
    <cpa>1</cpa>
    <rec>123123,1214,243</rec>
    <expiry>P5Y</expiry>
    <weight>2.07</weight>
    <dimensions>100/25.45/11.112</dimensions>
    <param name=\"Максимальный формат\">А4</param>
    <param name=\"Технология печати\">термическая струйная</param>
    <param name=\"Тип печати\">Цветная</param>
    <param name=\"Количество страниц в месяц\" unit=\"стр\">1000</param>
    <param name=\"Потребляемая мощность\" unit=\"Вт\">20</param>
    <param name=\"Вес\" unit=\"кг\">2.73</param>
</offer>";
?>