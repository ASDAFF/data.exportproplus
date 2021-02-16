<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["skybuy"] = array(
    "CODE" => "skybuy",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "AVAILABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_AVAILABLE" ),
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
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_BID" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "CBID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_CBID" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "FEE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_FEE" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "BASE_DELIVERY_COST",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_BASEDELIVERYCOST" ),
        ),
        array(
            "CODE" => "BASE_DELIVERY_DAYS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_BASEDELIVERYDAYS" ),
        ),
        array(
            "CODE" => "BASE_ORDER_BEFORE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_BASEORDERBEFORE" ),
        ),
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_URL" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "OLDPRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_OLDPRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "CURRENCYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_CURRENCY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "CATEGORYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_CATEGORY" ),
            "VALUE" => "IBLOCK_SECTION_ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "GROUPID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_GROUPID" ),
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PICTURE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PICTURE" ),
        ),
        array(
            "CODE" => "STORE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_STORE" ),
        ),
        array(
            "CODE" => "PICKUP",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PICKUP" ),
        ),
        array(
            "CODE" => "DELIVERY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_DELIVERY" ),
        ),
        array(
            "CODE" => "LOCAL_DELIVERY_COST",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_LOCALDELIVERYCOST" ),
        ),
        array(
            "CODE" => "LOCAL_DELIVERY_DAYS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_LOCALDELIVERYDAYS" ),
        ),
        array(
            "CODE" => "LOCAL_ORDER_BEFORE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_LOCALORDERBEFORE" ),
        ),
        array(
            "CODE" => "TYPEPREFIX",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_TYPEPREFIX" ),
        ),
        array(
            "CODE" => "VENDOR",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_VENDOR" ),
        ),
        array(
            "CODE" => "VENDORCODE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_VENDORCODE" ),
        ),
        array(
            "CODE" => "MODEL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_MODEL" ),
        ),
        array(
            "CODE" => "DESCRIPTION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_DESCRIPTION" ),
        ),
        array(
            "CODE" => "SALES_NOTES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_SALESNOTES" ),
        ),
        array(
            "CODE" => "MANUFACTURER_WARRANTY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_MANUFACTURERWARRANTY" ),
        ),
        array(
            "CODE" => "COUNTRY_OF_ORIGIN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_COUNTRYOFORIGIN" ),
        ),
        array(
            "CODE" => "DOWNLOADABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_DOWNLOADABLE" ),
        ),
        array(
            "CODE" => "ADULT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_ADULT" ),
        ),
        array(
            "CODE" => "AGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_AGE" ),
        ),
        array(
            "CODE" => "BARCODE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_BARCODE" ),
        ),
        array(
            "CODE" => "CPA",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_CPA" ),
        ),
        array(
            "CODE" => "REC",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_REC" ),
        ),
        array(
            "CODE" => "EXPIRY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_EXPIRY" ),
        ),
        array(
            "CODE" => "WEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_WEIGHT" ),
        ),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
        array(
            "CODE" => "PARAM1",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BRA_CUP" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BRA_CUP_VALUE" )
        ),                   
        array(
            "CODE" => "PARAM2",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BUST" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BUST_VALUE" )
        ),
        array(
            "CODE" => "PARAM3",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_PANTIES_SIZE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_PANTIES_SIZE_VALUE" )
        ),
        array(
            "CODE" => "PARAM4",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_COLOR" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_COLOR_VALUE" )
        ),
        array(
            "CODE" => "PARAM5",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_GENDER" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_GENDER_VALUE" )
        ),
        array(
            "CODE" => "PARAM6",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_OLD" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_OLD_VALUE" )
        ),
        array(
            "CODE" => "PARAM7",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_MATERIAL" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_MATERIAL_VALUE" )
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
        <delivery-options> 
            <option cost="#BASE_DELIVERY_COST#" days="#BASE_DELIVERY_DAYS#" order-before="#BASE_ORDER_BEFORE#"/> 
        </delivery-options>
        <offers>
            #ITEMS#
        </offers>
    </shop>
</yml_catalog>',
    
    "DATEFORMAT" => "Y-m-d_h:i",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;
    
    $profileTypes["skybuy"]["FIELDS"][9] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCodeWithDiscount,
    );
    
    $profileTypes["skybuy"]["FIELDS"][10] = array(
        "CODE" => "OLDPRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_OLDPRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["skybuy"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_SKYBUY_PORTAL_REQUIREMENTS" );
$profileTypes["skybuy"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_SKYBUY_PORTAL_VALIDATOR" );
$profileTypes["skybuy"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_SKYBUY_EXAMPLE" );

$profileTypes["skybuy"]["CURRENCIES"] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>".PHP_EOL;

$profileTypes["skybuy"]["SECTIONS"] =
    "<category id='#ID#'>#NAME#</category>".PHP_EOL;

$profileTypes["skybuy"]["ITEMS_FORMAT"] = "
<offer id=\"#ID#\" type=\"vendor.model\" available=\"#AVAILABLE#\" bid=\"#BID#\" cbid=\"#CBID#\" fee=\"#FEE#\" group_id=\"#GROUPID#\">
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
    <delivery-options> 
        <option cost=\"#LOCAL_DELIVERY_COST#\" days=\"#LOCAL_DELIVERY_DAYS#\" order-before=\"#LOCAL_ORDER_BEFORE#\"/> 
    </delivery-options>
    <typePrefix>#TYPEPREFIX#</typePrefix>
    <vendor>#VENDOR#</vendor>
    <vendorCode>#VENDORCODE#</vendorCode>
    <model>#MODEL#</model>
    <description>#DESCRIPTION#</description>
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
    <weight>#WEIGHT#</weight>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BRA_CUP" )."\" unit=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BRA_CUP_UNIT" )."\">#PARAM1#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BUST" )."\" unit=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_BUST_UNIT" )."\">#PARAM2#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_PANTIES_SIZE" )."\" unit=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_PANTIES_SIZE_UNIT" )."\">#PARAM3#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_COLOR" )."\">#PARAM4#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_GENDER" )."\">#PARAM5#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_OLD" )."\">#PARAM6#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_SKYBUY_FIELD_PARAM_MATERIAL" )."\">#PARAM7#</param>
</offer>
";