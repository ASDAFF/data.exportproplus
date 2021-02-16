<?php
IncludeModuleLangFile(__FILE__);

$profileTypes["fb_trade"] = array(
    "CODE" => "fb_trade",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_NAME" ),
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "AVAILABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_AVAILABLE" ),
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
            "CODE" => "URL_LABEL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_URL_LABEL" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_URL_LABEL_VALUE" ),
        ),
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_URL" ),
            "REQUIRED" => "Y",
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "CURRENCYID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_CURRENCY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "PHOTO",
            "REQUIRED" => "Y",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_PHOTO" ),
            "VALUE" => "DETAIL_PICTURE",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_NAME" ),
            "TYPE" => "field",
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "DESCRIPTION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_DESCRIPTION" ),
            "TYPE" => "field",
            "VALUE" => "DETAIL_TEXT",
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "MESSAGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_MESSAGE" ),
        ),
    ),
);

$profileTypes["fb_trade"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_PORTAL_REQUIREMENTS" );

if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];

    $profileTypes["fb_trade"]["FIELDS"][4] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_TRADE_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}