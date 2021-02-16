<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["fb_ads"] = array(
    "CODE" => "fb_ads",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_NAME" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_DESCRIPTION" ),
    "REG" => "http://google.com/merchants/",
    "HELP" => "https://support.google.com/merchants/?hl=ru#topic=3404818",
    "FIELDS" => array(
        array(
              "CODE" => "id",
              "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_ID" ),
              "VALUE" => "ID",
              "TYPE" => "field",
              "REQUIRED" => "Y",
              "DELETE_ONEMPTY" => "N",
        ),
        array(
              "CODE" => "title",
              "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_TITLE" ),
              "VALUE" => "NAME",
              "TYPE" => "field",
              "REQUIRED" => "Y",
              "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "description",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_DESCRIPTION" ),
            "VALUE" => "DETAIL_TEXT",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "link",
            "NAME" =>  GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_LINK" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "image_link",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_IMAGELINK" ),
            "VALUE" => "DETAIL_PICTURE",
            "TYPE" => "field",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "additional_image_link",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_ADDITIONAL_IMAGELINK" ),
            "VALUE" => "PREVIEW_PICTURE",
            "TYPE" => "field",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "mobile_link",
            "NAME" =>  GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_MOBILE_LINK" ),
            "VALUE" => "DETAIL_PAGE_URL",
            "TYPE" => "field",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "availability",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_AVAILABILITY" ),
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
            "CONTVALUE_TRUE" => "in stock",
            "CONTVALUE_FALSE" => "out of stock",
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "availability_date",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_AVAILABILITY_DATE" ),
            "TYPE" => "field",
        ),
        array(
            "CODE" => "expiration_date",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_EXPIRATION_DATE" ),
        ),
        array(
            "CODE" => "price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PRICE" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "price_currency",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PRICE_CURRENCY" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "sale_price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SALE_PRICE" ),
            "DELETE_ONEMPTY" => "N",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "sale_price_currency",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SALE_PRICE_CURRENCY" ),
            "DELETE_ONEMPTY" => "N",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "RUB",
        ),
        array(
            "CODE" => "sale_price_effective_date",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SALE_PRICE_EFFECTIVE_DATE" ),
            "TYPE" => "field",
        ),
        array(
            "CODE" => "unit_pricing_measure",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_UNIT_PRICING_MEASURE" ),
            "TYPE" => "field",
        ),
        array(
            "CODE" => "unit_pricing_base_measure",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_UNIT_PRICING_BASE_MEASURE" ),
            "TYPE" => "field",
        ),
        array(
            "CODE" => "google_product_category",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PRODUCTCATEGORY" ),
        ),
        array(
            "CODE" => "product_type",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_TYPE" ),
        ),
        array(
            "CODE" => "brand",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_BRAND" ),
        ),
        array(
            "CODE" => "gtin",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_GTIN" ),
        ),
        array(
            "CODE" => "mpn",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_MPN" ),
        ),
        array(
            "CODE" => "identifier_exists",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_IDENTIFIER_EXISTS" ),
        ),
        array(
            "CODE" => "condition",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_CONDITION" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "new",
        ),
        array(
            "CODE" => "adult",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_ADULT" ),
        ),
        array(
            "CODE" => "multipack",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_MULTIPACK" ),
        ),
        array(
            "CODE" => "is_bundle",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_IS_BUNDLE" ),
        ),
        array(
            "CODE" => "energy_efficiency_class",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_ENERGY_EFFICIENCY_CLASS" ),
        ),
        array(
            "CODE" => "age_group",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_AGE_GROUP" ),
        ),
        array(
            "CODE" => "color",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_COLOR" ),
        ),
        array(
            "CODE" => "gender",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_GENDER" ),
        ),
        array(
            "CODE" => "material",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_MATERIAL" ),
        ),
        array(
            "CODE" => "pattern",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PATTERN" ),
        ),
        array(
            "CODE" => "size",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SIZE" ),
        ),
        array(
            "CODE" => "size_type",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SIZE_TYPE" ),
        ),
        array(
            "CODE" => "size_system",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SIZE_SYSTEM" ),
        ),
        array(
            "CODE" => "item_group_id",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_ITEM_GROUP_ID" ),
            "TYPE" => "field",
            "VALUE" => "IBLOCK_SECTION_ID",
        ),
        array(
            "CODE" => "adwords_redirect",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_ADWORDS_REDIRECT" ),
        ),
        array(
            "CODE" => "excluded_destination",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_EXCLUDED_DESTINATION" ),
        ),
        array(
            "CODE" => "custom_label_0",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_CUSTOM_LABEL_0" ),
        ),
        array(
            "CODE" => "custom_label_1",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_CUSTOM_LABEL_1" ),
        ),
        array(
            "CODE" => "custom_label_2",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_CUSTOM_LABEL_2" ),
        ),
        array(
            "CODE" => "custom_label_3",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_CUSTOM_LABEL_3" ),
        ),
        array(
            "CODE" => "custom_label_4",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_CUSTOM_LABEL_4" ),
        ),
        array(
            "CODE" => "promotion_id",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PROMOTION_ID" ),
        ),
        array(
            "CODE" => "shipping_country",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_COUNTRY" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_COUNTRY_DEFAULT" ),
        ),
        array(
            "CODE" => "shipping_service",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SERVICE" ),
        ),
        array(
            "CODE" => "shipping_price",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SHIPPINGPRICE" ),
        ),
        array(
            "CODE" => "shipping_label",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SHIPPINGLABEL" ),
        ),
        array(
            "CODE" => "shipping_weight",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SHIPPINGWEIGHT" ),
            "TYPE" => "field",
            "VALUE" => "CATALOG-WEIGHT",
        ),
        array(
            "CODE" => "shipping_length",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SHIPPINGLENGTH" ),
        ),
        array(
            "CODE" => "shipping_width",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SHIPPINGWIDTH" ),
        ),
        array(
            "CODE" => "shipping_height",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SHIPPINGHEIGHT" ),
        ),
        array(
            "CODE" => "min_handling_time",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_MIN_HANDLING_TIME" ),
        ),
        array(
            "CODE" => "max_handling_time",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_MAX_HANDLING_TIME" ),
        ),
    ),
    "FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
    <rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">
    <channel>
        <link>#SITE_URL#</link>
        <description>#DESCRIPTION#</description>
        #ITEMS#
    </channel>
</rss>
    ',
    "DATEFORMAT" => "Y-m-d_h:i",
    "ENCODING" => "utf8",
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["fb_ads"]["FIELDS"][10] = array(
        "CODE" => "price",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PRICE" ),
        "REQUIRED" => "Y",
        "DELETE_ONEMPTY" => "N",
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );

    $profileTypes["fb_ads"]["FIELDS"][12] = array(
        "CODE" => "sale_price",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_SALE_PRICE" ),
        "DELETE_ONEMPTY" => "N",
        "TYPE" => "field",
        "VALUE" => $basePriceCodeWithDiscount,
    );
}

$profileTypes["fb_ads"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_PORTAL_REQUIREMENTS" );
$profileTypes["fb_ads"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_FB_ADS_EXAMPLE" );

$profileTypes["fb_ads"]["ITEMS_FORMAT"] = "<item>
    <g:id>#id#</g:id>
    <title>#title#</title>
    <description>#description#</description>
    <link>#SITE_URL##link#</link>
    <g:image_link>#SITE_URL##image_link#</g:image_link>
    <g:additional_image_link>#SITE_URL##additional_image_link#</g:additional_image_link>
    <g:mobile_link>#SITE_URL##mobile_link#</g:mobile_link>
    <g:availability>#availability#</g:availability>
    <g:availability_date>#availability_date#</g:availability_date>
    <g:expiration_date>#expiration_date#</g:expiration_date>
    <g:price>#price# #price_currency#</g:price>
    <g:sale_price>#sale_price# #sale_price_currency#</g:sale_price>
    <g:sale_price_effective_date>#sale_price_effective_date#</g:sale_price_effective_date>
    <g:unit_pricing_measure>#unit_pricing_measure#</g:unit_pricing_measure>
    <g:unit_pricing_base_measure>#unit_pricing_base_measure#</g:unit_pricing_base_measure>
    <g:google_product_category>#MARKET_CATEGORY#</g:google_product_category>
    <g:product_type>#product_type#</g:product_type>
    <g:brand>#brand#</g:brand>
    <g:gtin>#gtin#</g:gtin>
    <g:mpn>#mpn#</g:mpn>
    <g:identifier_exists>#identifier_exists#</g:identifier_exists>
    <g:condition>#condition#</g:condition>
    <g:adult>#adult#</g:adult>
    <g:multipack>#multipack#</g:multipack>
    <g:is_bundle>#is_bundle#</g:is_bundle>
    <g:energy_efficiency_class>#energy_efficiency_class#</g:energy_efficiency_class>
    <g:age_group>#age_group#</g:age_group>
    <g:color>#color#</g:color>
    <g:gender>#gender#</g:gender>
    <g:material>#material#</g:material>
    <g:pattern>#pattern#</g:pattern>
    <g:size>#size#</g:size>
    <g:size_type>#size_type#</g:size_type>
    <g:size_system>#size_system#</g:size_system>
    <g:item_group_id>#item_group_id#</g:item_group_id>
    <g:adwords_redirect>#adwords_labels#</g:adwords_redirect>
    <g:excluded_destination>#excluded_destination#</g:excluded_destination>
    <g:custom_label_0>#custom_label_0#</g:custom_label_0>
    <g:custom_label_1>#custom_label_1#</g:custom_label_1>
    <g:custom_label_2>#custom_label_2#</g:custom_label_2>
    <g:custom_label_3>#custom_label_3#</g:custom_label_3>
    <g:custom_label_4>#custom_label_4#</g:custom_label_4>
    <g:promotion_id>#promotion_id#</g:promotion_id>
    <g:shipping>
        <g:country>#shipping_country#</g:country>
        <g:service>#shipping_service#</g:service>
        <g:price>#shipping_price#</g:price>
    </g:shipping>
    <g:shipping_label>#shipping_label#</g:shipping_label>
    <g:shipping_weight>#shipping_weight#</g:shipping_weight>
    <g:shipping_length>#shipping_length#</g:shipping_length>
    <g:shipping_width>#shipping_width#</g:shipping_width>
    <g:shipping_height>#shipping_height#</g:shipping_height>
    <g:min_handling_time>#min_handling_time#</g:min_handling_time>
    <g:max_handling_time>#max_handling_time#</g:max_handling_time>
</item>";