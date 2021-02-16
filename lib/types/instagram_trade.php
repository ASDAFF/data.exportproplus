<?php
IncludeModuleLangFile(__FILE__);

$profileTypes["instagram_trade"] = array(
    "CODE" => "instagram_trade",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_NAME" ),
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "AVAILABLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_AVAILABLE" ),
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
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_URL_LABEL" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_URL_LABEL_VALUE" ),
        ),
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_URL" ),
            "REQUIRED" => "Y",
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "PHOTO",
            "REQUIRED" => "Y",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_PHOTO" ),
            "VALUE" => "DETAIL_PICTURE",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_NAME" ),
            "TYPE" => "field",
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "MESSAGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_MESSAGE" ),
        ),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
    ),
);

$profileTypes["instagram_trade"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_PORTAL_REQUIREMENTS" );

if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];

    $profileTypes["instagram_trade"]["FIELDS"][4] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_INSTAGRAM_TRADE_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}