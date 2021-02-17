<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["ym_simple_csv"] = array(
    "CODE" => "ym_simple_csv",
    "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_NAME" ),
    "DESCRIPTION" => GetMessage( "ACRIT_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "AVAILABLE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_AVAILABLE" ),
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
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_BID" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "CBID",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_CBID" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "FEE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_FEE" ),
            "VALUE" => "",
        ),
        array(
            "CODE" => "BASE_DELIVERY_COST",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_BASEDELIVERYCOST" ),
        ),
        array(
            "CODE" => "BASE_DELIVERY_DAYS",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_BASEDELIVERYDAYS" ),
        ),
        array(
            "CODE" => "BASE_ORDER_BEFORE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_BASEORDERBEFORE" ),
        ),
        array(
            "CODE" => "URL",
            "NAME" => "URL ".GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_URL" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "PRICE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "OLDPRICE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_OLDPRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "CURRENCYID",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_CURRENCY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "VAT",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_VAT" ),
        ),
        array(
            "CODE" => "CATEGORYID",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_CATEGORY" ),
            "VALUE" => "IBLOCK_SECTION_ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "GROUPID",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_GROUPID" ),
        ),
        array(
            "CODE" => "PICTURE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_PICTURE" ),
            "TYPE" => "field",
            "VALUE" => "DETAIL_PICTURE",
        ),
        array(
            "CODE" => "STORE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_STORE" ),
        ),
        array(
            "CODE" => "PICKUP",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_PICKUP" ),
        ),
        array(
            "CODE" => "DELIVERY",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_DELIVERY" ),
        ),
        array(
            "CODE" => "LOCAL_DELIVERY_COST",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_LOCALDELIVERYCOST" ),
        ),
        array(
            "CODE" => "LOCAL_DELIVERY_DAYS",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_LOCALDELIVERYDAYS" ),
        ),
        array(
            "CODE" => "LOCAL_ORDER_BEFORE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_LOCALORDERBEFORE" ),
        ),
        array(
            "CODE" => "NAME",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_NAME" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "VENDOR",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_VENDOR" ),
        ),
        array(
            "CODE" => "VENDORCODE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_VENDORCODE" ),
        ),

        array(
            "CODE" => "DESCRIPTION",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_DESCRIPTION" ),
            "TYPE" => "field",
            "VALUE" => "DETAIL_TEXT",
        ),
        array(
            "CODE" => "SALES_NOTES",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_SALESNOTES" ),
        ),
        array(
            "CODE" => "MANUFACTURER_WARRANTY",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_MANUFACTURERWARRANTY" ),
        ),
        array(
            "CODE" => "COUNTRY_OF_ORIGIN",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_COUNTRYOFORIGIN" ),
        ),
        array(
            "CODE" => "ADULT",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_ADULT" ),
        ),
        array(
            "CODE" => "AGE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_AGE" ),
        ),
        array(
            "CODE" => "BARCODE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_BARCODE" ),
        ),
        array(
            "CODE" => "CPA",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_CPA" ),
        ),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
        array(
            "CODE" => "PARAM",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_PARAM" ),
        ),
    ),
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["ym_simple_csv"]["FIELDS"][9] = array(
        "CODE" => "PRICE",
        "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCodeWithDiscount,
    );

    $profileTypes["ym_simple_csv"]["FIELDS"][10] = array(
        "CODE" => "OLDPRICE",
        "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_MARKET_SIMPLE_CSV_FIELD_OLDPRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}