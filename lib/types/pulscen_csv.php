<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["pulscen_csv"] = array(
    "CODE" => "pulscen_csv",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_NAME_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_NAME" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE_FROM_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE_FROM" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE_TO_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE_TO" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_CURRENCY_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_CURRENCY" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MEASURE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MEASURE" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_SIZE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_SIZE" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_MEASURE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_MEASURE" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_PREVIEW_TEXT_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_PREVIEW_TEXT" ),
            "VALUE" => "NAME",
            "TYPE" => "PREVIEW_TEXT",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_DETAIL_TEXT_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_MIN_ORDER_DETAIL_TEXT" ),
            "VALUE" => "NAME",
            "TYPE" => "DETAIL_TEXT",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PICTURE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PICTURE" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_SECTION_LINK_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_SECTION_LINK" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PAY_CONDITIONS_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PAY_CONDITIONS" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_DELIVERY_CONDITIONS_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_DELIVERY_CONDITIONS" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_AVAILABLE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_AVAILABLE" ),
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
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_VENDOR_CODE_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_VENDOR_CODE" ),
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_ID_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PUBLIC_STATUS_CODE" ),
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PUBLIC_STATUS" ),
        ),
    ),
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $bCatalog = true;
    
    $profileTypes["pulscen_csv"]["FIELDS"][1] = array(
        "CODE" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE_CODE" ),
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_PULSCEN_CSV_FIELD_PRICE" ),
        "REQUIRED" => "Y",
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}