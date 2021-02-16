<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["avito_trucks_and_special_machinery"] = array(
    "CODE" => "avito_trucks_and_special_machinery",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "Id",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "DateBegin",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_DATEBEGIN" ),
        ),
        array(
            "CODE" => "DateEnd",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_DATEEND" ),
        ),
        array(
            "CODE" => "ListingFee",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_LISTINGFEE" ),
        ),
        array(
            "CODE" => "AdStatus",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_ADSTATUS" ),
        ),
        array(
            "CODE" => "AvitoId",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_AVITOID" ),
        ),
        array(
            "CODE" => "AllowEmail",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_ALLOWEMAIL" ),
        ),
        array(
            "CODE" => "ManagerName",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_MANAGERNAME" ),
        ),
        array(
            "CODE" => "ContactPhone",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_CONTACTPHONE" ),
        ),
        array(
            "CODE" => "Region",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_REGION" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "City",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_CITY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Subway",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_SUBWAY" ),
        ),
        array(
            "CODE" => "District",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_DISTRICT" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Category",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_CATEGORY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_CATEGORY_VALUE" ),
        ),
        array(
            "CODE" => "GoodsType",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_GOODSTYPE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
        ),
        array(
            "CODE" => "Title",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_TITLE" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Description",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_DESCRIPTION" ),
            "VALUE" => "DETAIL_TEXT",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_PRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "Image",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_IMAGE" ),
        ),
        array(
            "CODE" => "VideoURL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_VIDEOURL" ),
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

    $profileTypes["avito_trucks_and_special_machinery"]["FIELDS"][17] = array(
        "CODE" => "Price",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_FIELD_PRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["avito_trucks_and_special_machinery"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_PORTAL_REQUIREMENTS" );
$profileTypes["avito_trucks_and_special_machinery"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_PORTAL_VALIDATOR" );
$profileTypes["avito_trucks_and_special_machinery"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_TRUCKS_AND_SPECIAL_MACHINERY_EXAMPLE" );

$profileTypes["avito_trucks_and_special_machinery"]["CURRENCIES"] = "";

$profileTypes["avito_trucks_and_special_machinery"]["SECTIONS"] = "";

$profileTypes["avito_trucks_and_special_machinery"]["ITEMS_FORMAT"] = "
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
    <GoodsType>#GoodsType#</GoodsType>
    <Title>#Title#</Title>
    <Description>#Description#</Description>
    <Price>#Price#</Price>
    <Images>
        <Image url=\"#SITE_URL##Image#\"></Image>
    </Images>
    <VideoURL>#VideoURL#</VideoURL>
</Ad>
";