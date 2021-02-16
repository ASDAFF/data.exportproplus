<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["aliexpress"] = array(
    "CODE" => "aliexpress",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "AVAILABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_AVAILABLE" ),
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
            "CODE" => "BID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_BID" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "CBID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_CBID" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "FEE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_FEE" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_URL" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
            
        ),
        array(
            "CODE" => "OLDPRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_OLDPRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "CURRENCYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_CURRENCY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "CATEGORYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_CATEGORY" ),
            "VALUE" => "IBLOCK_SECTION_ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PICTURE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_PICTURE" ),
        ),
        array(
            "CODE" => "STORE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_STORE" ),
        ),
        array(
            "CODE" => "PICKUP",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_PICKUP" ),
        ),
        array(
            "CODE" => "DELIVERY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_DELIVERY" ),
        ),
        array(
            "CODE" => "VENDOR",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_VENDOR" ),
        ),
        array(
            "CODE" => "VENDORCODE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_VENDORCODE" ),
        ),
        array(
            "CODE" => "NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_NAME" ),
        ),
        array(
            "CODE" => "DESCRIPTION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_DESCRIPTION" ),
        ),
        array(
            "CODE" => "KEYWORDS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_KEYWORDS" ),
        ),
        array(
            "CODE" => "STOCK",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_STOCK" ),
        ),
        array(
            "CODE" => "SALES_NOTES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_SALESNOTES" ),
        ),
        array(
            "CODE" => "MANUFACTURER_WARRANTY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_MANUFACTURERWARRANTY" ),
        ),
        array(
            "CODE" => "COUNTRY_OF_ORIGIN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_COUNTRYOFORIGIN" ),
        ),
        array(
            "CODE" => "DOWNLOADABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_DOWNLOADABLE" ),
        ),
        array(
            "CODE" => "ADULT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_ADULT" ),
        ),
        array(
            "CODE" => "AGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_AGE" ),
        ),
        array(
            "CODE" => "BARCODE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_BARCODE" ),
        ),
        array(
            "CODE" => "CPA",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_CPA" ),
        ),
        array(
            "CODE" => "REC",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_REC" ),
        ),
        array(
            "CODE" => "EXPIRY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_EXPIRY" ),
        ),
        array(
            "CODE" => "PARAM_SIZE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_SIZE" ),
        ),
        array(
            "CODE" => "PARAM_LENGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_LENGHT" ),
        ),
        array(
            "CODE" => "PARAM_WIDTH",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_WIDTH" ),
        ),
        array(
            "CODE" => "PARAM_HEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_HEIGHT" ),
        ),
        array(
            "CODE" => "PARAM_WEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_WEIGHT" ),
        ),
        array(
            "CODE" => "PARAM_COLOR",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_COLOR" ),
        ),
        array(
            "CODE" => "PARAM_GENDER",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_GENDER" ),
        ),
        array(
            "CODE" => "PARAM_OLD",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_OLD" ),
        ),
        array(
            "CODE" => "PARAM_MATERIAL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_MATERIAL" ),
        ),
        array(
            "CODE" => "PARAM_COMPOSITION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_COMPOSITION" ),
        ),        
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
        array(
            "CODE" => "PARAM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_PARAM" ),
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
    
    $profileTypes["aliexpress"]["FIELDS"][6] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCodeWithDiscount,
    );
    
    $profileTypes["aliexpress"]["FIELDS"][7] = array(
        "CODE" => "OLDPRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_OLDPRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["aliexpress"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MARKET_ALIEXPRESS_PORTAL_REQUIREMENTS" );
$profileTypes["aliexpress"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MARKET_ALIEXPRESS_PORTAL_VALIDATOR" );
$profileTypes["aliexpress"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MARKET_ALIEXPRESS_EXAMPLE" );

$profileTypes["aliexpress"]["CURRENCIES"] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>".PHP_EOL;

$profileTypes["aliexpress"]["SECTIONS"] =
    "<category id='#ID#'>#NAME#</category>".PHP_EOL;

$profileTypes["aliexpress"]["ITEMS_FORMAT"] = "
<offer id=\"#ID#\" type=\"vendor.model\" available=\"#AVAILABLE#\" bid=\"#BID#\" cbid=\"#CBID#\" fee=\"#FEE#\">
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <price>#PRICE#</price>
    <oldprice>#OLDPRICE#</oldprice>
    <currencyId>#CURRENCYID#</currencyId>
    <categoryId>#CATEGORYID#</categoryId>
    <market_category>#MARKET_CATEGORY#</market_category>
    <picture>#SITE_URL##PICTURE#</picture>
    <store>#STORE#</store>
    <pickup>#PICKUP#</pickup>
    <delivery>#DELIVERY#</delivery>
    <vendor>#VENDOR#</vendor>
    <vendorCode>#VENDORCODE#</vendorCode>
    <name>#NAME#</name>
    <description>#DESCRIPTION#</description>
    <keywords>#KEYWORDS#</keywords>
    <stock>#STOCK#</stock> 
    <sales_notes>#SALES_NOTES#</sales_notes>
    <manufacturer_warranty>#MANUFACTURER_WARRANTY#</manufacturer_warranty>
    <country_of_origin>#COUNTRY_OF_ORIGIN#</country_of_origin>
    <downloadable>#DOWNLOADABLE#</downloadable>
    <adult>#ADULT#</adult>
    <age>#AGE#</age>
    <barcode>#BARCODE#</barcode>
    <cpa>#CPA#</cpa>
    <rec>#REC#</rec>
    <expiry>#EXPIRY#</expiry>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_SIZE_LABEL" )."\">#PARAM_SIZE#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_LENGHT_LABEL" )."\">#PARAM_LENGHT#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_WIDTH_LABEL" )."\">#PARAM_WIDTH#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_HEIGHT_LABEL" )."\">#PARAM_HEIGHT#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_WEIGHT_LABEL" )."\">#PARAM_WEIGHT#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_COLOR_LABEL" )."\">#PARAM_COLOR#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_GENDER_LABEL" )."\">#PARAM_GENDER#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_OLD_LABEL" )."\">#PARAM_OLD#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_MATERIAL_LABEL" )."\">#PARAM_MATERIAL#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MARKET_ALIEXPRESS_FIELD_COMPOSITION_LABEL" )."\">#PARAM_COMPOSITION#</param>
</offer>
";