<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["avito_mototsikly_i_mototehnika"] = array(
    "CODE" => "avito_mototsikly_i_mototehnika",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "Id",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "DateBegin",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_DATEBEGIN" ),
        ),
        array(
            "CODE" => "DateEnd",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_DATEEND" ),
        ),
        array(
            "CODE" => "ListingFee",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_LISTINGFEE" ),
        ),
        array(
            "CODE" => "AdStatus",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_ADSTATUS" ),
        ),
        array(
            "CODE" => "AvitoId",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_AVITOID" ),
        ),
        array(
            "CODE" => "AllowEmail",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_ALLOWEMAIL" ),
        ),
        array(
            "CODE" => "ManagerName",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_MANAGERNAME" ),
        ),
        array(
            "CODE" => "ContactPhone",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_CONTACTPHONE" ),
        ),
        array(
            "CODE" => "Region",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_REGION" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "City",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_CITY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Subway",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_SUBWAY" ),
        ),
        array(
            "CODE" => "District",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_DISTRICT" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Category",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_CATEGORY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "VehicleType",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_VEHICLETYPE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "MotoType",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_MOTOTYPE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Title",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_TITLE" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Description",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_DESCRIPTION" ),
            "VALUE" => "DETAIL_TEXT",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_PRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "Image",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_IMAGE" ),
        ),
        array(
            "CODE" => "VideoURL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_VIDEOURL" ),
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

    $profileTypes["avito_mototsikly_i_mototehnika"]["FIELDS"][19] = array(
        "CODE" => "Price",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_FIELD_PRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["avito_mototsikly_i_mototehnika"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_PORTAL_REQUIREMENTS" );
$profileTypes["avito_mototsikly_i_mototehnika"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_PORTAL_VALIDATOR" );
$profileTypes["avito_mototsikly_i_mototehnika"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_MOTOTSIKLY_I_MOTOTEHNIKA_EXAMPLE" );

$profileTypes["avito_mototsikly_i_mototehnika"]["CURRENCIES"] = "";

$profileTypes["avito_mototsikly_i_mototehnika"]["SECTIONS"] = "";

$profileTypes["avito_mototsikly_i_mototehnika"]["ITEMS_FORMAT"] = "
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
    <MotoType>#MotoType#</MotoType>
    <Title>#Title#</Title>
    <Description>#Description#</Description>
    <Price>#Price#</Price>
    <Images>
        <Image url=\"#SITE_URL##Image#\"></Image>
    </Images>
    <VideoURL>#VideoURL#</VideoURL>
</Ad>
";