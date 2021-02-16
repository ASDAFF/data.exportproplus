<?
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_NAME"] = "Экспорт товаров в систему Mail.ru";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_ID"] = "Идентификатор торгового предложения";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_BID"] = "Основная ставка клика";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_AVAILABLE"] = "Cтатус доступности товара";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_URL"] = "URL страницы товара.<br/>Максимальная длина URL — 512 символов.<br/>Необязательный элемент для магазинов-салонов";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_PRICE"] = "Цена, по которой данный товар можно приобрести.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_OLD_PRICE"] = "Цена товара до применения скидки, которая обязательно должна быть выше новой цены (price)";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_CURRENCY"] = "Идентификатор валюты товара (RUR, USD, UAH, KZT).<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_CATEGORY"] = "Идентификатор категории товара.<br/>Товарное предложение может принадлежать только одной категории.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_PICTURE"] = "Ссылка на картинку соответствующего товарного предложения";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_NAME"] = "Наименование товарного предложения.<br/><b>Обязательный элемент</b>";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_DESCRIPTION"] = "Описание товара.<br/>Длина текста не более 175 символов (не включая знаки препинания),<br/> запрещено использовать HTML-теги <br/>(информация внутри тегов публиковаться не будет)";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_PICKUP"] = "Возможность зарезервировать выбранный товар и забрать его самостоятельно<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_DELIVERY"] = "Возможность доставки<br/>Возможные значения: true, false";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_LOCALDELIVERYCOST"] = "Стоимость доставки данного товара в своем регионе";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_VENDOR"] = "Производитель. Не отображается в названии предложения";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_VENDORCODE"] = "Код товара (указывается код производителя)";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_TYPEPREFIX"] = "Группа товаров/категория";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_MODEL"] = "Модель";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_SOURCE"] = "UTM метка: рекламная площадка";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_SOURCE_VALUE"] = "cpc_yandex_market";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_MEDIUM"] = "UTM метка: тип рекламы";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_MEDIUM_VALUE"] = "cpc";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_TERM"] = "UTM метка: ключевая фраза";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_CONTENT"] = "UTM метка: контейнер для дополнительной информации";
$MESS["DATA_EXPORTPROPLUS_MAILRU_VENDORMODEL_FIELD_UTM_CAMPAIGN"] = "UTM метка: название рекламной кампании";
$MESS["DATA_EXPORTPROPLUS_TYPE_MAILRU_VENDORMODEL_PORTAL_REQUIREMENTS"] = "http://torg.mail.ru/info/122/";
$MESS["DATA_EXPORTPROPLUS_TYPE_MAILRU_VENDORMODEL_EXAMPLE"] = "
<torg_price date=\"2014-06-22 14:42\">
    <shop>
        <shopname>Магазин-пример</shopname>
        <company>ООО \"Магазин-пример\"</company>
        <url>http://magazin-primer.ru/</url>
        <currencies>
            <currency id=\"RUR\" rate=\"1\"/>
            <currency id=\"USD\" rate=\"33.70\"/>
        </currencies>
        <categories>
            <category id=\"1\" parentId=\"0\">Кондиционеры</category>
            <category id=\"2\" parentId=\"1\">Настенные кондиционеры</category>
        </categories>
        <offers>
            <offer id=\"1\" available=\"true\" cbid=\"4.50\">
                <url>http://magazin-primer.ru/cond/wall/model1?from=torg</url>
                <price>10596</price>
                <oldprice>12096</oldprice>
                <currencyId>RUR</currencyId>
                <categoryId>2</categoryId>
                <picture>http://magazin-primer.ru/pictures/model1.jpeg</picture>
                <typePrefix>Кондиционер</typePrefix>
                <vendor>LG</vendor>
                <model>LS-H0561AL</model>
                <description>
                Для помещеня площадью до 16 кв.м. этот сплит - кондиционер является самым доступным в своей категории. Сборка - Ю.Корея. Только охлаждение.
                </description>
                <delivery>true</delivery>
                <pickup>false</pickup>
                <local_delivery_cost>300</local_delivery_cost>
            </offer>
            <offer id=\"2\" available=\"true\" cbid=\"4.70\">
                <url>http://magazin-primer.ru/cond/wall/model2?from=torg</url>
                <price>320</price>
                <oldprice>350</oldprice>
                <currencyId>USD</currencyId>
                <categoryId>2</categoryId>
                <picture>http://magazin-primer.ru/pictures/model2.jpeg</picture>
                <name>Кондиционер LG S07LH</name>
                <description>
                Сплит - кондиционер с плазменным фильтром для помещения площадью до 21 кв.м. Охлаждение/обогрев.
                </description>
                <delivery>true</delivery>
                <pickup>true</pickup>
                <local_delivery_cost>300</local_delivery_cost>
            </offer>
        </offers>
    </shop>
</torg_price>
";
?>