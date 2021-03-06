<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["avito_aqua"] = array(
    "CODE" => "avito_aqua",
    "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_NAME" ),
    "DESCRIPTION" => "",
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "Id",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "DateBegin",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DATEBEGIN" ),
        ),
        array(
            "CODE" => "DateEnd",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DATEEND" ),
        ),
        array(
            "CODE" => "ListingFee",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_LISTINGFEE" ),
        ),
        array(
            "CODE" => "AdStatus",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_ADSTATUS" ),
        ),
        array(
            "CODE" => "AvitoId",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_AVITOID" ),
        ),
        array(
            "CODE" => "AllowEmail",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_ALLOWEMAIL" ),
        ),
        array(
            "CODE" => "ManagerName",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_MANAGERNAME" ),
        ),
        array(
            "CODE" => "ContactPhone",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CONTACTPHONE" ),
        ),
        array(
            "CODE" => "Region",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_REGION" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "City",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CITY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Subway",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_SUBWAY" ),
        ),
        array(
            "CODE" => "District",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DISTRICT" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Category",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CATEGORY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_CATEGORY_VALUE" ),
        ),
        array(
            "CODE" => "VehicleType",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_VEHICLETYPE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
        ),
        array(
            "CODE" => "Title",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_TITLE" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Description",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_DESCRIPTION" ),
            "VALUE" => "DETAIL_TEXT",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Price",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_PRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "Image",
            "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_IMAGE" ),
        ),
    ),
    "FORMAT" => '<?xml version="1.0"?>
<Ads formatVersion="3" target="Avito.ru">
    #ITEMS#
</Ads>',

    "DATEFORMAT" => "Y-m-d",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["avito_aqua"]["FIELDS"][17] = array(
        "CODE" => "Price",
        "NAME" => GetMessage( "ACRIT_EXPORTPROPLUS_AVITO_AQUA_FIELD_PRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["avito_aqua"]["PORTAL_REQUIREMENTS"] = GetMessage( "ACRIT_EXPORTPROPLUS_TYPE_AVITO_AQUA_PORTAL_REQUIREMENTS" );
$profileTypes["avito_aqua"]["PORTAL_VALIDATOR"] = GetMessage( "ACRIT_EXPORTPROPLUS_TYPE_AVITO_AQUA_PORTAL_VALIDATOR" );
$profileTypes["avito_aqua"]["EXAMPLE"] = GetMessage( "ACRIT_EXPORTPROPLUS_TYPE_AVITO_AQUA_EXAMPLE" );

$profileTypes["avito_aqua"]["CURRENCIES"] = "";

$profileTypes["avito_aqua"]["SECTIONS"] = "";

$profileTypes["avito_aqua"]["ITEMS_FORMAT"] = "
<Ad>
    <Id>#Id#</Id>
    <DateBegin>#DateBegin#</DateBegin>
    <DateEnd>#DateEnd#</DateEnd>
    <ListingFee>#ListingFee#</ListingFee>
    <AdStatus>#AdStatus#</AdStatus>
    <AvitoId>#AvitoId#</AvitoId>
    <AllowEmail>#AllowEmail#</AllowEmail>
    <ManagerName>#ManagerName#</ManagerName>
    <ContactPhone>#ContactPhone#</ContactPhone>
    <Region>#Region#</Region>
    <City>#City#</City>
    <Subway>#Subway#</Subway>
    <District>#District#</District>
    <Category>#Category#</Category>
    <VehicleType>#VehicleType#</VehicleType>
    <Title>#Title#</Title>
    <Description>#Description#</Description>
    <Price>#Price#</Price>
    <Images>
        <Image url=\"#SITE_URL##Image#\"></Image>
    </Images>
</Ad>
";