<?
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_NAME"] = "Билеты на мероприятие (ym_event_ticket)";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_ID"] = "Идентификатор торгового предложения";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_BID"] = "Размер ставки на остальных местах размещения (кроме карточки модели).";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_CBID"] = "Размер ставки для карточки модели";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_FEE"] = "Размер комиссии на товарное предложение, участвующее в программе \"Заказ на Маркете\"";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_AVAILABLE"] = "Cтатус доступности товара";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_URL"] = "URL страницы товара.<br/>Максимальная длина URL — 512 символов.<br/>Необязательный элемент для магазинов-салонов";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_PRICE"] = "Цена, по которой данный товар можно приобрести.<br/><b>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_OLDPRICE"] = "Старая цена на товар, которая обязательно должна быть выше новой цены (<price>). Параметр <oldprice> необходим для автоматического расчета скидки на товар";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_CURRENCY"] = "Идентификатор валюты товара (RUR, USD, UAH, KZT).<br/><b>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_VAT"] = "Значения VAT:<br/><br/>
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
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_CATEGORY"] = "Идентификатор категории товара.<br/>Товарное предложение может принадлежать только одной категории.<br/><b>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_NAME"] = "Название мероприятия.<br/><b>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_DESCRIPTION"] = "Описание тура.<br/>Длина текста не более 175 символов (не включая знаки препинания),<br/> запрещено использовать HTML-теги <br/>(информация внутри тегов публиковаться не будет)";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_PICTURE"] = "Ссылка на картинку соответствующего товарного предложения";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_DELIVERY"] = "Возможность доставки<br/>Возможные значения: true, false";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_LOCALDELIVERYCOST"] = "Стоимость доставки данного товара в своем регионе";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_LOCALDELIVERYDAYS"] = "Сроки доставки данного товара в своем регионе в рабочих днях. Если магазин готов доставить товары в день заказа (сегодня), используйте значение 0.<br/><br/> <b>Внимание!</b><br/>Убедитесь, что на странице партнерского интерфейса Информация о доставке выбран вариант Данные в прайс-листе. Чтобы попасть на страницу, нажмите ссылку изменить напротив параметра Стоимость доставки в своем регионе на странице Настройки -> Параметры размещения.";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_AGE"] = "Возрастная категория товара";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_STORE"] = "Покупка соответствующего товара в розничном магазине<br/>Возможные значения: true, false";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_PICKUP"] = "Возможность зарезервировать выбранный товар и забрать его самостоятельно<br/>Возможные значения: true, false";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_VENDORMODEL_FIELD_SALESNOTES"] = "Элемент используется для отражения информации<br/>о минимальной сумме заказа, минимальной партии<br/>товара или необходимости предоплаты, а так же для<br/>описания акций, скидок и распродаж.<br/>Допустимая длина текста в элементе — 50 символов";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_VENDORMODEL_FIELD_ADULT"] = "Элемент обязателен для обозначения товара,<br/> имеющего отношение к удовлетворению сексуальных потребностей";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_VENDORMODEL_FIELD_BARCODE"] = "Штрихкод товара, указанный производителем";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_PLACE"] = "Место проведения.<br/><b>Обязательный элемент</b>";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_HALL"] = "Зал";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_HALLPART"] = "Ряд и место в зале";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_DATE"] = "Дата и время сеанса";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_ISPREMIERE"] = "Признак премьерности мероприятия";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_ISKIDS"] = "Признак детского мероприятия";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_SOURCE"] = "UTM метка: рекламная площадка";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_SOURCE_VALUE"] = "cpc_yandex_market";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_MEDIUM"] = "UTM метка: тип рекламы";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_MEDIUM_VALUE"] = "cpc";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_TERM"] = "UTM метка: ключевая фраза";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_CONTENT"] = "UTM метка: контейнер для дополнительной информации";
$MESS["ACRIT_EXPORTPROPLUS_MARKET_EVENTTICKET_FIELD_UTM_CAMPAIGN"] = "UTM метка: название рекламной кампании";
$MESS["ACRIT_EXPORTPROPLUS_TYPE_MARKET_EVENTTICKET_PORTAL_REQUIREMENTS"] = "https://yandex.ru/support/partnermarket/export/event-tickets.xml";
$MESS["ACRIT_EXPORTPROPLUS_TYPE_MARKET_EVENTTICKET_PORTAL_VALIDATOR"] = "https://webmaster.yandex.ru/tools/xml-validator/";
$MESS["ACRIT_EXPORTPROPLUS_TYPE_MARKET_EVENTTICKET_EXAMPLE"] = "
<offer id=\"1234\" type=\"event-ticket\"  available=\"true\" bid=\"80\">
  <url>http://best.seller.ru/product_page.asp?pid=57384</url>
  <price>1000</price>
  <oldprice>1100</oldprice>
  <currencyId>RUR</currencyId>
  <categoryId>3</categoryId>
  <picture>http://best.seller.ru/product_page.asp?pid=72945.jpg</picture>
  <store>false</store>
  <pickup>false</pickup>
  <delivery>true</delivery>
  <local_delivery_cost>300</local_delivery_cost>
  <name>Дмитрий Хворостовский и Национальный филармонический оркестр России...</name>
  <place>Московский  международный Дом музыки</place>
  <hall>Большой зал</hall>
  <hall_part>Партер р. 1-5<hall_part>
  <date>2012-02-25 12:03:14</date>
  <is_premiere>0<is_premiere>
  <is_kids>0</is_kids>
  <description>
  Концерт Дмитрия Хворостовского и Национального филармонического оркестра России...
  </description>
  <age>6</age>
</offer>
";
?>