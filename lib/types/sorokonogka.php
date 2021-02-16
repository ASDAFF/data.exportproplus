<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["sorokonogka"] = array(
    "CODE" => "sorokonogka",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_NAME" ),
    "FIELDS" => array(
        array(
            "CODE" => "SENDER_INN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_SENDER_INN" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
        ),
        array(
            "CODE" => "RECIPIENT_INN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_RECIPIENT_INN" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "666400445987_sorokonogka",
        ),
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "BARCODE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_BARCODE" ),
        ),
        array(
            "CODE" => "SHOPID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_SHOPID" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "SIZE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_SIZE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "COUNT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_COUNT" ),
            "REQUIRED" => "Y",
        ),
    ),
    "FORMAT" => '<?xml version="1.0" encoding="UTF-8" ?>
<gpc>
    <sender>#SENDER_INN#</sender>
    <reciever>#RECIPIENT_INN#</reciever>
    <tovars_info>
        #ITEMS#
    </tovars_info>
</gpc>
',

    "DATEFORMAT" => "Y-m-d_H:i",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["sorokonogka"]["FIELDS"][6] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SOROKONOGKA_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCodeWithDiscount,
    );
}

$profileTypes["sorokonogka"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_SOROKONOGKA_PORTAL_REQUIREMENTS" );
$profileTypes["sorokonogka"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_SOROKONOGKA_PORTAL_VALIDATOR" );
$profileTypes["sorokonogka"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_SOROKONOGKA_EXAMPLE" );

$profileTypes["sorokonogka"]["ITEMS_FORMAT"] = "
<tovar>
    <id>#ID#</id>
    <barcode>#BARCODE#</barcode>
    <shop>
        <id>#SHOPID#</id>
        <sizes>
            <size>
                <id>#SIZE#</id>
                <price>#PRICE#</price>
                <count>#COUNT#</count>
            </size>
        </sizes>
    </shop>
</tovar>
";