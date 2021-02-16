<?
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_NAME"] = "Экспорт на портал 40nog.net (sorokonogka)";

$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_SENDER_INN"] = "ИНН отправителя (магазина)";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_RECIPIENT_INN"] = "ИНН получателя";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_ID"] = "Идентификатор товара.<br/>Например, 79b9942e-a048-11df-84b9-0030486412ab";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_BARCODE"] = "Уникальный штрихкод товара";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_SHOPID"] = "Уникальный идентификатор магазина";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_SIZE"] = "Размер";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_PRICE"] = "Цена";
$MESS["DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_COUNT"] = "Количество пар на остатке";

$MESS["DATA_EXPORTPROPLUS_TYPE_SOROKONOGKA_PORTAL_REQUIREMENTS"] = "http://gpc2b.ru/content/dogovor/gpc_40nogka.pdf";
$MESS["DATA_EXPORTPROPLUS_TYPE_SOROKONOGKA_PORTAL_VALIDATOR"] = "";
$MESS["DATA_EXPORTPROPLUS_TYPE_SOROKONOGKA_EXAMPLE"] = "
<tovar>
    <id>79b9942e-a048-11df-84b9-0030486412ab</id>
    <barcode>4690501003608</barcode>
    <shop>
        <id>79ae1ab9-1e35-11e0-8408-0030486412aa</id>
        <sizes>
            <size>
                <id>24</id>
                <price>500</price>
                <count>6</count>
            </size>
        </sizes>
    </shop>
</tovar>
";
?>