<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["ebay_1"] = array(
	"CODE" => "ebay_1",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_NAME" ),
	"DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_PODDERJIVAETSA_ANDEK" ),
	"REG" => "",
	"HELP" => "",
	"FIELDS" => array(
		array(
			"CODE" => "SKU",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_SKU" ),
            "VALUE" => "ID",
			"REQUIRED" => "Y",
            "TYPE" => "field",
		),
        array(
			"CODE" => "TITLE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_TITLE" ),
			"VALUE" => "NAME",
            "REQUIRED" => "Y",
            "TYPE" => "field",
		),
        array(
			"CODE" => "SUBTITLE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_SUBTITLE" ),
			"VALUE" => "PREVIEW_TEXT",
            "REQUIRED" => "Y",
            "TYPE" => "field",
		),
        array(
			"CODE" => "TEMPLATE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_TEMPLATE" ),
		),
        array(
			"CODE" => "DESCRIPTION",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_DESCRIPTION" ),
			"VALUE" => "DETAIL_TEXT",
            "REQUIRED" => "Y",
            "TYPE" => "field",
		),
        array(
			"CODE" => "URL",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_URL" ),
			"VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
		),
        array(
			"CODE" => "CONDITION",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_CONDITION" ),
            "REQUIRED" => "Y",
		),
        array(
			"CODE" => "BRAND",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_BRAND" ),
		),
        array(
			"CODE" => "MODEL",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_MODEL" ),
		),
        array(
			"CODE" => "MANUFACTURE_CODE",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_MANUFACTURE_CODE" ),
		),
        array(
			"CODE" => "COUNTRY",
			"NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_COUNTRY" ),
		),
        array(
            "CODE" => "UTM_SOURCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_SOURCE" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_SOURCE_VALUE" )
        ),
        array(
            "CODE" => "UTM_MEDIUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_MEDIUM" ),
            "REQUIRED" => "Y",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_MEDIUM_VALUE" )
        ),
        array(
            "CODE" => "UTM_TERM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_TERM" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CONTENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_CONTENT" ),
            "TYPE" => "field",
            "VALUE" => "ID",
        ),
        array(
            "CODE" => "UTM_CAMPAIGN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1_FIELD_UTM_CAMPAIGN" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
	),
	"FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
<ListingArray>
    <Listing>
        #ITEMS#
    </Listing>
    <ListingDetails>
		<PaymentPolicy>'.GetMessage('ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_FORMAT_POLICE_PAY').'</PaymentPolicy>
		<ReturnPolicy>'.GetMessage('ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_FORMAT_POLICE_RETURN').'</ReturnPolicy>
		<ShippingPolicy>'.GetMessage('ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_FORMAT_POLICE_DELIVERY').'</ShippingPolicy>
	</ListingDetails>
</ListingArray>',
    "ENCODING" => "utf8",
	"DATEFORMAT" => "Y-m-d_h:i",
);

$profileTypes["ebay_1"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_EBAY_1_PORTAL_REQUIREMENTS" );
$profileTypes["ebay_1"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_EBAY_1_EXAMPLE" );

$profileTypes["ebay_1"]["CURRENCIES"] = "";

$profileTypes["ebay_1"]["SECTIONS"] = "";

$profileTypes["ebay_1"]["ITEMS_FORMAT"] = '
<Product>
	<SKU>#SKU#</SKU>
	<ProductInformation>
		<Title>#TITLE#</Title>
		<SubTitle>#SUBTITLE#</SubTitle>
        <Description>
            <Template>#TEMPLATE#</Template>
            <ProductDescription>#DESCRIPTION#</ProductDescription>
        </Description>				
        <PictureUrls>
            <PictureUrl>#SITE_URL##URL#?utm_source=#UTM_SOURCE#&amp;utm_medium=#UTM_MEDIUM#&amp;utm_term=#UTM_TERM#&amp;utm_content=#UTM_CONTENT#&amp;utm_campaign=#UTM_CAMPAIGN#</PictureUrl>
        </PictureUrls>
        <Categories>
            <Category Type="eBayLeafCategory">#MARKET_CATEGORY#</Category>
        </Categories>
        <Attributes>
            <Attribute Name="'.GetMessage( "ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_EXAMPLE_BRAND" ).'">#BRAND#</Attribute>
            <Attribute Name="'.GetMessage( "ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_EXAMPLE_MODEL" ).'">#MODEL#</Attribute>
            <Attribute Name="'.GetMessage( "ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_EXAMPLE_MANUFACTURECODE" ).'">#MANUFACTURE_CODE#</Attribute>
            <Attribute Name="'.GetMessage( "ACCRIT_EXPORTPROPLUS_TYPE_EBAY_1_EXAMPLE_COUNTRY" ).'">#COUNTRY#</Attribute>
        </Attributes>
        <ConditionInfo>
            <Condition>#CONDITION#</Condition>
        </ConditionInfo>
	</ProductInformation>
</Product>
';
    
$profileTypes["ebay_1"]["LOCATION"] = array(
	"ebay_1" => array(
		"name" => GetMessage( "DATA_EXPORTPROPLUS_EBAY_1" ),
		"sub" => array(
		)
	),
);