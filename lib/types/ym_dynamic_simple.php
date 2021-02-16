<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["ym_dynamic_simple"] = array(
    "CODE" => "ym_dynamic_simple",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "AVAILABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_AVAILABLE" ),
            "VALUE" => "",
            "TYPE" => "const",
            "CONDITION" => array(
                "CLASS_ID" => "CondGroup",
                "DATA" => array(
                    "All" => "AND",
                    "True" => "True"
                ),
                "CHILDREN" => array(
                    array(
                        "CLASS_ID" => "CondCatQuantity",
                        "DATA" => array(
                                "logic" => "EqGr",
                                "value" => "1"
                        )
                    )
                )
            ),
            "USE_CONDITION" => "Y",
            "CONTVALUE_TRUE" => "true",
            "CONTVALUE_FALSE" => "false",
        ),
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_URL" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",

        ),
        array(
            "CODE" => "OLDPRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_OLDPRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "CURRENCYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_CURRENCY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "VAT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_VAT" ),
        ),
        array(
            "CODE" => "CATEGORYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_CATEGORY" ),
            "VALUE" => "IBLOCK_SECTION_ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "GROUPID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_GROUPID" ),
        ),
        array(
            "CODE" => "PICTURE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_PICTURE" ),
            "TYPE" => "field",
            "VALUE" => "DETAIL_PICTURE",
        ),
        array(
            "CODE" => "STORE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_STORE" ),
        ),
        array(
            "CODE" => "PICKUP",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_PICKUP" ),
        ),
        array(
            "CODE" => "DELIVERY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_DELIVERY" ),
        ),
        array(
            "CODE" => "NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_NAME" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "VENDOR",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_VENDOR" ),
        ),
        array(
            "CODE" => "VENDORCODE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_VENDORCODE" ),
        ),
        array(
            "CODE" => "DESCRIPTION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_DESCRIPTION" ),
            "TYPE" => "field",
            "VALUE" => "DETAIL_TEXT",
        ),
        array(
            "CODE" => "SALES_NOTES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_SALESNOTES" ),
        ),
        array(
            "CODE" => "MANUFACTURER_WARRANTY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_MANUFACTURERWARRANTY" ),
        ),
        array(
            "CODE" => "COUNTRY_OF_ORIGIN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_COUNTRYOFORIGIN" ),
        ),
        array(
            "CODE" => "AGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_AGE" ),
        ),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
    ),
    "FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<yml_catalog date="#DATE#">
    <shop>
        <name>#SHOP_NAME#</name>
        <company>#COMPANY_NAME#</company>
        <url>#SITE_URL#</url>
        <currencies>#CURRENCY#</currencies>
        <categories>#CATEGORY#</categories>
        <offers>
            #ITEMS#
        </offers>
    </shop>
</yml_catalog>',

    "DATEFORMAT" => "Y-m-d_H:i",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["ym_dynamic_simple"]["FIELDS"][3] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCodeWithDiscount,
    );

    $profileTypes["ym_dynamic_simple"]["FIELDS"][4] = array(
        "CODE" => "OLDPRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_DYNAMIC_SIMPLE_FIELD_OLDPRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["ym_dynamic_simple"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MARKET_DYNAMIC_SIMPLE_PORTAL_REQUIREMENTS" );
$profileTypes["ym_dynamic_simple"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MARKET_DYNAMIC_SIMPLE_PORTAL_VALIDATOR" );
$profileTypes["ym_dynamic_simple"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MARKET_DYNAMIC_SIMPLE_EXAMPLE" );

$profileTypes["ym_dynamic_simple"]["CURRENCIES"] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>".PHP_EOL;

$profileTypes["ym_dynamic_simple"]["SECTIONS"] =
    "<category id='#ID#'>#NAME#</category>".PHP_EOL;

$profileTypes["ym_dynamic_simple"]["ITEMS_FORMAT"] = "
<offer id=\"#ID#\" available=\"#AVAILABLE#\" group_id=\"#GROUPID#\">
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <price>#PRICE#</price>
    <oldprice>#OLDPRICE#</oldprice>
    <currencyId>#CURRENCYID#</currencyId>
    <categoryId>#CATEGORYID#</categoryId>
    <picture>#SITE_URL##PICTURE#</picture>
    <store>#STORE#</store>
    <pickup>#PICKUP#</pickup>
    <delivery>#DELIVERY#</delivery>
    <name>#NAME#</name>
    <vendor>#VENDOR#</vendor>
    <vendorCode>#VENDORCODE#</vendorCode>
    <description>#DESCRIPTION#</description>
    <sales_notes>#SALES_NOTES#</sales_notes>
    <manufacturer_warranty>#MANUFACTURER_WARRANTY#</manufacturer_warranty>
    <country_of_origin>#COUNTRY_OF_ORIGIN#</country_of_origin>
    <age unit=\"year\">#AGE#</age>
</offer>
";