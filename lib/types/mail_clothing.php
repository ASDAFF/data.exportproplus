<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["mailru_clothing"] = array(
	"CODE" => "mailru_clothing",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_NAME" ),
	"DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
	"REG" => "http://market.yandex.ru/",
	"HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
	"FIELDS" => array(
		array(
			"CODE" => "ID",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_ID" ),
            "VALUE" => "ID",
			"REQUIRED" => "Y",
            "TYPE" => "field",
		),
		array(
			"CODE" => "AVAILABLE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_AVAILABLE" ),
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
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_BID" ),
		),
		array(
			"CODE" => "URL",
			"NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_URL" ),
			"VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
		),
		array(
			"CODE" => "PRICE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRICE" ),
			"REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
		),
		array(
			"CODE" => "OLD_PRICE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_OLD_PRICE" ),
		),
		array(
			"CODE" => "CURRENCYID",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_CURRENCY" ),
			"REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
		),
		array(
			"CODE" => "CATEGORYID",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_CATEGORY" ),
			"VALUE" => "IBLOCK_SECTION_ID",
			"REQUIRED" => "Y",
            "TYPE" => "field",
		),
		array(
			"CODE" => "PICTURE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PICTURE" ),
			"TYPE" => "field",
			"VALUE" => "PREVIEW_PICTURE",
		),
        array(
			"CODE" => "TYPEPREFIX",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_TYPEPREFIX" ),
		),
        array(
			"CODE" => "VENDOR",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_VENDOR" ),
            "REQUIRED" => "Y",
		),
		array(
			"CODE" => "MODEL",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_MODEL" ),
		),
        array(
			"CODE" => "VENDORCODE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_VENDORCODE" ),
		),
		array(
			"CODE" => "NAME",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_NAME" ),
            "REQUIRED" => "Y",
			"TYPE" => "field",
			"VALUE" => "NAME",
		),
        array(
			"CODE" => "DESCRIPTION",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_DESCRIPTION" ),
	        "TYPE" => "field",
	        "VALUE" => "PREVIEW_TEXT",
		),
        array(
			"CODE" => "DELIVERY",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_DELIVERY" ),
	        "TYPE" => "const",
	        "CONTVALUE_TRUE" => "true"
		),
        array(
			"CODE" => "PICKUP",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PICKUP" ),
	        "TYPE" => "const",
	        "CONTVALUE_TRUE" => "false"
		),
        array(
			"CODE" => "LOCAL_DELIVERY_COST",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_LOCALDELIVERYCOST" ),
	        "TYPE" => "const",
	        "CONTVALUE_TRUE" => 0
		),
        array(
			"CODE" => "PRODUCT_TYPE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRODUCT_TYPE" ),
            "REQUIRED" => "Y",
		),
        array(
			"CODE" => "PRODUCT_SEX",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRODUCT_SEX" ),
            "REQUIRED" => "Y",
		),
        array(
			"CODE" => "PRODUCT_AGE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRODUCT_AGE" ),
            "REQUIRED" => "Y",
		),
        array(
			"CODE" => "PRODUCT_SIZE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRODUCT_SIZE" ),
            "REQUIRED" => "Y",
		),
        array(
			"CODE" => "PRODUCT_MATERIAL",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRODUCT_MATERIAL" ),
            "REQUIRED" => "Y",
		),
        array(
			"CODE" => "PRODUCT_COLOR",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRODUCT_COLOR" ),
            "REQUIRED" => "Y",
		),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
	),
	"FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
<!DOCTYPE yml_catalog SYSTEM "shops.dtd">
<torg_price date="#DATE#">
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
</torg_price>',

	"DATEFORMAT" => "Y-m-d_h:i",
    "ENCODING" => "cp1251",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["mailru_clothing"]["FIELDS"][4] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCode . '_WD',
    );
	$profileTypes["mailru_clothing"]["FIELDS"][5] = array(
		"CODE" => "OLD_PRICE",
		"NAME" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING_VENDORMODEL_FIELD_OLD_PRICE" ),
		"REQUIRED" => "Y",
		"TYPE" => "field",
		"VALUE" => $basePriceCode
	);
}

$profileTypes["mailru_clothing"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MAILRU_CLOTHING_VENDORMODEL_PORTAL_REQUIREMENTS" );
$profileTypes["mailru_clothing"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_MAILRU_CLOTHING_VENDORMODEL_EXAMPLE" );

$profileTypes["mailru_clothing"]["CURRENCIES"] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>".PHP_EOL;

$profileTypes["mailru_clothing"]["SECTIONS"] =
    '<category id="#ID#">#NAME#</category>'.PHP_EOL;

$profileTypes["mailru_clothing"]["ITEMS_FORMAT"] = "
<offer id=\"#ID#\" available=\"#AVAILABLE#\" cbid=\"#BID#\">
    <url>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</url>
    <price>#PRICE#</price>
    <oldprice>#OLD_PRICE#</oldprice>
    <currencyId>#CURRENCYID#</currencyId>
    <categoryId>#CATEGORYID#</categoryId>
    <picture>#SITE_URL##PICTURE#</picture>
    <typePrefix>#TYPEPREFIX#</typePrefix>
    <vendor>#VENDOR#</vendor>
    <model>#MODEL#</model>
    <vendorCode>#VENDORCODE#</vendorCode>
    <name>#NAME#</name>
    <description>#DESCRIPTION#</description>
    <delivery>#DELIVERY#</delivery>
    <pickup>#PICKUP#</pickup>
    <local_delivery_cost>#LOCAL_DELIVERY_COST#</local_delivery_cost>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_PRODUCT_TYPE" )."\">#PRODUCT_TYPE#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_PRODUCT_SEX" )."\">#PRODUCT_SEX#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_PRODUCT_AGE" )."\">#PRODUCT_AGE#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_PRODUCT_SIZE" )."\">#PRODUCT_SIZE#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_PRODUCT_COLOR" )."\">#PRODUCT_COLOR#</param>
    <param name=\"".GetMessage( "DATA_EXPORTPROPLUS_MAILRU_PRODUCT_MATERIAL" )."\">#PRODUCT_MATERIAL#</param>
</offer>
";

$profileTypes["mailru_clothing"]["LOCATION"] = array(
	"mailru_clothing" => array(
		"name" => GetMessage( "DATA_EXPORTPROPLUS_MAILRU_CLOTHING" ),
		"sub" => array(
		)
	),
);