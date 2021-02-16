<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["avito_job"] = array(
    "CODE" => "avito_job",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
    "REG" => "http://market.yandex.ru/",
    "HELP" => "http://help.yandex.ru/partnermarket/export/feed.xml",
    "FIELDS" => array(
        array(
            "CODE" => "Id",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "DateBegin",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_DATEBEGIN" ),
        ),
        array(
            "CODE" => "DateEnd",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_DATEEND" ),
        ),
        array(
            "CODE" => "ListingFee",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_LISTINGFEE" ),
        ),
        array(
            "CODE" => "AdStatus",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_ADSTATUS" ),
        ),
        array(
            "CODE" => "AvitoId",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_AVITOID" ),
        ),
        array(
            "CODE" => "AllowEmail",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_ALLOWEMAIL" ),
        ),
        array(
            "CODE" => "ManagerName",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_MANAGERNAME" ),
        ),
        array(
            "CODE" => "ContactPhone",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_CONTACTPHONE" ),
        ),
        array(
            "CODE" => "Region",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_REGION" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "City",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_CITY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Subway",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_SUBWAY" ),
        ),
        array(
            "CODE" => "District",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_DISTRICT" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Street",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_STREET" ),
        ),
        array(
            "CODE" => "Category",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_CATEGORY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Industry",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_INDUSTRY" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Title",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_TITLE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "JobType",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_JOBTYPE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Experience",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_EXPERIENCE" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Description",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_DESCRIPTION" ),
            "REQUIRED" => "Y",
        ),
        array(
            "CODE" => "Salary",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_SALARY" ),
        ),
        array(
            "CODE" => "Image",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_AVITO_JOB_FIELD_IMAGE" ),
        ),
    ),
    "FORMAT" => '<?xml version="1.0"?>
<Ads formatVersion="3" target="Avito.ru">
    #ITEMS#
</Ads>',

    "DATEFORMAT" => "Y-m-d",
);

$profileTypes["avito_job"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_JOB_PORTAL_REQUIREMENTS" );
$profileTypes["avito_job"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_JOB_PORTAL_VALIDATOR" );
$profileTypes["avito_job"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_AVITO_JOB_EXAMPLE" );

$profileTypes["avito_job"]["CURRENCIES"] = "";

$profileTypes["avito_job"]["SECTIONS"] = "";

$profileTypes["avito_job"]["ITEMS_FORMAT"] = "
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
    <Street>#Street#</Street>
    <Category>#Category#</Category>
    <Industry>#Industry#</Industry>
    <Title>#Title#</Title>
    <JobType>#JobType#</JobType>
    <Experience>#Experience#</Experience>
    <Description>#Description#</Description>
    <Salary>#Salary#</Salary>
    <Images>
        <Image url=\"#SITE_URL##Image#\"></Image>
    </Images>
</Ad>
";