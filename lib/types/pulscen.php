<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["pulscen"] = array(
	"CODE" => "pulscen",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_NAME" ),
	"DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
	"REG" => "http://market.yandex.ru/",
	"HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
	"FIELDS" => array(
		array(
			"CODE" => "ID",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_ID" ),
            "VALUE" => "ID",
			"REQUIRED" => "Y",
            "TYPE" => "field",
		),
		array(
			"CODE" => "AVAILABLE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_AVAILABLE" ),
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
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_BID" ),
			"VALUE" => "",
		),
		array(
			"CODE" => "URL",
			"NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_URL" ),
			"VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
		),
		array(
			"CODE" => "PRICE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_PRICE" ),
			"REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
		),
		array(
			"CODE" => "CURRENCYID",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_CURRENCY" ),
			"REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
		),
		array(
			"CODE" => "CATEGORYID",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_CATEGORY" ),
			"VALUE" => "IBLOCK_SECTION_ID",
			"REQUIRED" => "Y",
            "TYPE" => "field",
		),
		array(
			"CODE" => "PICTURE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_PICTURE" ),
		),
        array(
			"CODE" => "STORE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_STORE" ),
		),
        array(
			"CODE" => "PICKUP",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_PICKUP" ),
		),
        array(
			"CODE" => "DELIVERY",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_DELIVERY" ),
		),
        array(
			"CODE" => "LOCAL_DELIVERY_COST",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_LOCALDELIVERYCOST" ),
		),
        array(
			"CODE" => "NAME",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_NAME" ),
			"VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
		),
        array(
			"CODE" => "VENDOR",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_VENDOR" ),
		),
		array(
			"CODE" => "VENDORCODE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_VENDORCODE" ),
		),
		
		array(
			"CODE" => "DESCRIPTION",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_DESCRIPTION" ),
		),
		array(
			"CODE" => "SALES_NOTES",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_SALESNOTES" ),
		),
        array(
			"CODE" => "MANUFACTURER_WARRANTY",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_MANUFACTURERWARRANTY" ),
		),
        array(
			"CODE" => "COUNTRY_OF_ORIGIN",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_COUNTRYOFORIGIN" ),
		),
		array(
			"CODE" => "ADULT",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_ADULT" ),
		),
        array(
			"CODE" => "AGE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_AGE" ),
		),
		array(
			"CODE" => "BARCODE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_BARCODE" ),
		),
		array(
			"CODE" => "CPA",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_CPA" ),
		),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
        array(
			"CODE" => "PARAM",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_PARAM" ),
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
    
	"DATEFORMAT" => "Y-m-d_h:i",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;
    
    $profileTypes["pulscen"]["FIELDS"][4] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["pulscen"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_PULSCEN_PORTAL_REQUIREMENTS" );
$profileTypes["pulscen"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_PULSCEN_EXAMPLE" );

$profileTypes["pulscen"]["CURRENCIES"] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>".PHP_EOL;

$profileTypes["pulscen"]["SECTIONS"] =
    "<category id='#ID#'>#NAME#</category>".PHP_EOL;

$profileTypes["pulscen"]["ITEMS_FORMAT"] = "
<offer id=\"#ID#\" available=\"#AVAILABLE#\" bid=\"#BID#\">
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <price>#PRICE#</price>
    <currencyId>#CURRENCYID#</currencyId>
    <categoryId>#CATEGORYID#</categoryId>
    <market_category>#MARKET_CATEGORY#</market_category>
    <picture>#SITE_URL##PICTURE#</picture>
    <store>#STORE#</store>
    <pickup>#PICKUP#</pickup>
    <delivery>#DELIVERY#</delivery>
    <local_delivery_cost>#LOCAL_DELIVERY_COST#</local_delivery_cost>
    <name>#NAME#</name>
    <vendor>#VENDOR#</vendor>
    <vendorCode>#VENDORCODE#</vendorCode>
    <description>#DESCRIPTION#</description>
    <sales_notes>#SALES_NOTES#</sales_notes>
    <manufacturer_warranty>#MANUFACTURER_WARRANTY#</manufacturer_warranty>
    <country_of_origin>#COUNTRY_OF_ORIGIN#</country_of_origin>
    <adult>#ADULT#</adult>
    <age>#AGE#</age>
    <barcode>#BARCODE#</barcode>
    <cpa>#CPA#</cpa>
    <param>#PARAM#</param>
</offer>
";
    
$profileTypes["pulscen"]["LOCATION"] = array(
	"yandex" => array(
		"name" => GetMessage( "DATA_EXPORTPROPLUS_ANDEKS" ),
		"sub" => array(
			"market" => array(
				"name" => GetMessage( "DATA_EXPORTPROPLUS_VEBMASTER" ),
				"sub" => "",
			)
		)
	),
);