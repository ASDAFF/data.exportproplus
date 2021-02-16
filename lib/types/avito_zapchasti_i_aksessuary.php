<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["avito_zapchasti_i_aksessuary"] = array(
    "CODE" => "avito_zapchasti_i_aksessuary",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "Id",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "DateBegin",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_DATEBEGIN" ),
        ),
        array(
            "CODE" => "DateEnd",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_DATEEND" ),
        ),
        array(
            "CODE" => "ListingFee",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_LISTINGFEE" ),
        ),
        array(
            "CODE" => "AdStatus",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_ADSTATUS" ),
        ),
        array(
            "CODE" => "AvitoId",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_AVITOID" ),
        ),
        array(
            "CODE" => "EMail",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_EMAIL" ),
        ),
        array(
            "CODE" => "AllowEmail",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_ALLOWEMAIL" ),
        ),
        array(
            "CODE" => "CompanyName",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_COMPANYNAME" ),
        ),
        array(
            "CODE" => "ManagerName",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_MANAGERNAME" ),
        ),
        array(
            "CODE" => "ContactPhone",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_CONTACTPHONE" ),
        ),
        array(
            "CODE" => "Region",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_REGION" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "City",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_CITY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Subway",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_SUBWAY" ),
        ),
        array(
            "CODE" => "District",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_DISTRICT" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Category",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_CATEGORY" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_CATEGORY_VALUE" ),
        ),
        array(
            "CODE" => "TypeId",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_TYPEID" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Title",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_TITLE" ),
            "VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Description",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_DESCRIPTION" ),
            "VALUE" => "DETAIL_TEXT",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "Price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_PRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "RimDiameter",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_RIMDIAMETER" ),
        ),
        array(
            "CODE" => "TireType",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_TIRETYPE" ),
        ),
        array(
            "CODE" => "WheelAxle",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_WHEELAXLE" ),
        ),
        array(
            "CODE" => "RimType",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_RIMTYPE" ),
        ),
        array(
            "CODE" => "TireSectionWidth",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_TIRESECTIONWIDTH" ),
        ),
        array(
            "CODE" => "TireAspectRatio",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_TIREASPECTRATIO" ),
        ),
        array(
            "CODE" => "RimWidth",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_RIMWIDTH" ),
        ),
        array(
            "CODE" => "RimBolts",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_RIMBOLTS" ),
        ),
        array(
            "CODE" => "RimBoltsDiameter",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_RIMBOLTSDIAMETER" ),
        ),
        array(
            "CODE" => "RimOffset",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_RIMOFFSET" ),
        ),
        array(
            "CODE" => "Image",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_IMAGE" ),
        ),
        array(
            "CODE" => "VideoURL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_VIDEOURL" ),
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

    $profileTypes["avito_zapchasti_i_aksessuary"]["FIELDS"][19] = array(
        "CODE" => "Price",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_ZAPCHASTI_I_AKSESSUARY_FIELD_PRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["avito_zapchasti_i_aksessuary"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_ZAPCHASTI_I_AKSESSUARY_PORTAL_REQUIREMENTS" );
$profileTypes["avito_zapchasti_i_aksessuary"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_ZAPCHASTI_I_AKSESSUARY_PORTAL_VALIDATOR" );
$profileTypes["avito_zapchasti_i_aksessuary"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_ZAPCHASTI_I_AKSESSUARY_EXAMPLE" );

$profileTypes["avito_zapchasti_i_aksessuary"]["CURRENCIES"] = "";

$profileTypes["avito_zapchasti_i_aksessuary"]["SECTIONS"] = "";

$profileTypes["avito_zapchasti_i_aksessuary"]["ITEMS_FORMAT"] = "
<Ad>
    <Id>#Id#</Id>
    <DateBegin>#DateBegin#</DateBegin>
    <DateEnd>#DateEnd#</DateEnd>
    <Title>#Title#</Title>
    <Description>#Description#</Description>
    <ListingFee>#ListingFee#</ListingFee>
    <AdStatus>#AdStatus#</AdStatus>
    <AvitoId>#AvitoId#</AvitoId>
    <EMail>#EMail#</EMail>
    <AllowEmail>#AllowEmail#</AllowEmail>
    <CompanyName>#CompanyName#</CompanyName>
    <ManagerName>#ManagerName#</ManagerName>
    <ContactPhone>#ContactPhone#</ContactPhone>
    <Region>#Region#</Region>
    <City>#City#</City>
    <District>#District#</District>
    <Subway>#Subway#</Subway>
    <Category>#Category#</Category>
    <TypeId>#TypeId#</TypeId>
    <Price>#Price#</Price>
    <RimDiameter>#RimDiameter#</RimDiameter>
    <TireType>#TireType#</TireType>
    <WheelAxle>#WheelAxle#</WheelAxle>
    <RimType>#RimType#</RimType>
    <TireSectionWidth>#TireSectionWidth#</TireSectionWidth>
    <TireAspectRatio>#TireAspectRatio#</TireAspectRatio>
    <RimWidth>#RimWidth#</RimWidth>
    <RimBolts>#RimBolts#</RimBolts>
    <RimBoltsDiameter>#RimBoltsDiameter#</RimBoltsDiameter>
    <RimOffset>#RimOffset#</RimOffset>
    <Images>
        <Image url=\"#SITE_URL##Image#\"></Image>
    </Images>
    <VideoURL>#VideoURL#</VideoURL>
</Ad>
";