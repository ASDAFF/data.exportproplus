<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["advantshop"] = array(
    "CODE" => "advantshop",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://www.advantshop.net/",
    "HELP" => "http://www.advantshop.net/help/pages/export-csv-columns?name=csv",
    "FIELDS" => array(
        array(
            "CODE" => "sku",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_ARTICUL" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "name",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_NAME" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "paramsynonym",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_CODE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "category",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_CATEGORY" ),
            "VALUE" => "IBLOCK_SECTION_ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "enabled",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_ENABLED" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "currency",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_CURRENCY" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB"
        ),
        array(
            "CODE" => "price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "purchaseprice",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PURCHASE_PRICE" ),
        ),
        array(
            "CODE" => "amount",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_AMOUNT" ),
        ),
        array(
            "CODE" => "sku_size_color_price_purchaseprice_amount",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_SKU_FORMAT" ),
        ),
        array(
            "CODE" => "unit",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_UNIT" ),
        ),
        array(
            "CODE" => "discount",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_DISCOUNT" ),
        ),
        array(
            "CODE" => "shippingprice",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_SHIPPINGPRICE" ),
        ),
        array(
            "CODE" => "weight",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_WEIGHT" ),
        ),
        array(
            "CODE" => "size",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_SIZE" ),
        ),
        array(
            "CODE" => "color",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_COLOR" ),
        ),
        array(
            "CODE" => "briefdescription",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_BRIEFDESCRIPTION" ),
        ),
        array(
            "CODE" => "description",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_DESCRIPTION" ),
        ),
        array(
            "CODE" => "title",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_TITLE" ),
        ),
        array(
            "CODE" => "metakeywords",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_METAKEYWORDS" ),
        ),
        array(
            "CODE" => "metadescription",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_METADESCRIPTION" ),
        ),
        array(
            "CODE" => "photos",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PHOTOS" ),
        ),
        array(
            "CODE" => "markers",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_MARKERS" ),
        ),
        array(
            "CODE" => "properties",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PROPERTIES" ),
        ),
        array(
            "CODE" => "producer",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PRODUCER" ),
        ),
        array(
            "CODE" => "preorder",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PREORDER" ),
        ),
        array(
            "CODE" => "salesnote",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_SALESNOTE" ),
        ),
        array(
            "CODE" => "related sku",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_RELATED_SKU" ),
        ),
        array(
            "CODE" => "alternative sku",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_ALTERNATIVE_SKU" ),
        ),
        array(
            "CODE" => "customoption",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_CUSTOMOPTION" ),
        ),
        array(
            "CODE" => "gtin",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_GTIN" ),
        ),
        array(
            "CODE" => "googleproductcategory",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_GOOGLEPRODUCTCATEGORY" ),
        ),
        array(
            "CODE" => "adult",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_ADULT" ),
        ),
        array(
            "CODE" => "manufacturer warranty",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_MANUFACTURER_WARRANTY" ),
        ),
        array(
            "CODE" => "tags",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_TAGS" ),
        ),
        array(
            "CODE" => "gifts",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_GIFTS" ),
        ),
        array(
            "CODE" => "productsets",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PRODUCTSETS" ),
        ),
    ),
);

$profileTypes["advantshop"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_ADVANTSHOP_PORTAL_REQUIREMENTS" );

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["advantshop"]["FIELDS"][6] = array(
        "CODE" => "price",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_ADVANTSHOP_FIELD_PRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}