<?php
IncludeModuleLangFile( __FILE__ );

$profileTypes["ozon_api"] = array(
    "CODE" => "ozon_api",
    "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API" ),
    "DESCRIPTION" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_DESCR" ),
    "REG" => "/",
    "HELP" => "/",
    "FIELDS" => array(
        array(
            "CODE" => "ID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ID" ),
            "VALUE" => "ID",
            "REQUIRED" => "Y",
            "TYPE" => "field",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "SELLING_STATE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_AVAILABLE" ),
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
            "CONTVALUE_TRUE" => "ForSale",
            "CONTVALUE_FALSE" => "NotForSale",
        ),
        array(
            "CODE" => "SUPPLY_STATE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SUPPLY_STATE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "InStock"
        ),
        array(
            "CODE" => "SUPPLY_PERIOD",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SUPPLY_PERIOD" ),
        ),
        array(
            "CODE" => "QTY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SUPPLY_QTY" ),
        ),
        array(
            "CODE" => "NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_NAME" ),
            "VALUE" => "NAME",
            "TYPE" => "field",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "MANUFACTURER_IDENTIFIER",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MANUFACTURER_IDENTIFIER" ),
        ),
        array(
            "CODE" => "GROSS_WEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_GROSS_WEIGHT" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "INTERNAL_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_INTERNAL_NAME" ),
        ),
        array(
            "CODE" => "SELLING_PRICE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SELLING_PRICE" ),
            "TYPE" => "const",
            "CONTVALUE_TRUE" => "0",
        ),
        array(
            "CODE" => "DISCOUNT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_DISCOUNT" ),
        ),
        array(
            "CODE" => "ALTERNAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ALTERNAME" ),
        ),
        array(
            "CODE" => "ELUCIDATIVENAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ELUCIDATIVENAME" ),
        ),
        array(
            "CODE" => "STICKERINFO",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_STICKERINFO" ),
        ),
        array(
            "CODE" => "ANNOTATION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ANNOTATION" ),
        ),
        array(
            "CODE" => "PICTURE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_PICTURE" ),
            "VALUE" => "DETAIL_PICTURE",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "IMAGES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_IMAGES" ),
        ),
        array(
            "CODE" => "RELEASEYEAR",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_RELEASEYEAR" ),
        ),
        array(
            "CODE" => "COUNTRY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_COUNTRY" ),
        ),
        array(
            "CODE" => "PACKING",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_PACKING" ),
        ),
        array(
            "CODE" => "PRODUCER_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_PRODUCER_NAME" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "PRODUCER_COMPANYINFO",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_PRODUCER_COMPANYINFO" ),
        ),
        array(
            "CODE" => "CAPABILITY_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_NAME" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "CAPABILITY_ANNOTATION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_ANNOTATION" ),
        ),
        array(
            "CODE" => "CAPABILITY_OPTIONAL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_OPTIONAL" ),
        ),
        array(
            "CODE" => "CAPABILITY_AGESPORT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_AGESPORT" ),
        ),
        array(
            "CODE" => "CAPABILITY_HEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_HEIGHT" ),
        ),
        array(
            "CODE" => "CAPABILITY_MUSCLEGROUPS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_MUSCLEGROUPS" ),
        ),
        array(
            "CODE" => "CAPABILITY_MAXUSERWEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_MAXUSERWEIGHT" ),
        ),
        array(
            "CODE" => "CAPABILITY_SYSTEMWEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_SYSTEMWEIGHT" ),
        ),
        array(
            "CODE" => "CAPABILITY_EXERCISES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_EXERCISES" ),
        ),
        array(
            "CODE" => "CAPABILITY_CONTROL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_CONTROL" ),
        ),
        array(
            "CODE" => "CAPABILITY_ENCODERS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_ENCODERS" ),
        ),
        array(
            "CODE" => "CAPABILITY_LEVEL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_LEVEL" ),
        ),
        array(
            "CODE" => "CAPABILITY_FEATURES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_FEATURES" ),
        ),
        array(
            "CODE" => "CAPABILITY_DISTFROMWALL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_DISTFROMWALL" ),
        ),
        array(
            "CODE" => "CAPABILITY_PROGSQTY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_PROGSQTY" ),
        ),
        array(
            "CODE" => "CAPABILITY_MAXANGLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_MAXANGLE" ),
        ),
        array(
            "CODE" => "CAPABILITY_SPORTTYPE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_SPORTTYPE" ),
        ),
        array(
            "CODE" => "CAPABILITY_PURPOSE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_PURPOSE" ),
        ),
        array(
            "CODE" => "CAPABILITY_MATERIAL",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_MATERIAL" ),
        ),
        array(
            "CODE" => "CAPABILITY_AGEMIN",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_AGEMIN" ),
        ),
        array(
            "CODE" => "CAPABILITY_AGEMAX",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_AGEMAX" ),
        ),
        array(
            "CODE" => "CAPABILITY_MAXLOADCOMPLEX",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_MAXLOADCOMPLEX" ),
        ),
        array(
            "CODE" => "CAPABILITY_MAXLOADUNIT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_MAXLOADUNIT" ),
        ),
        array(
            "CODE" => "CAPABILITY_ACCESSORIES",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_ACCESSORIES" ),
        ),
        array(
            "CODE" => "CAPABILITY_PLAYGROUND",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_PLAYGROUND" ),
        ),
        array(
            "CODE" => "CAPABILITY_LENGTH",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_LENGTH" ),
        ),
        array(
            "CODE" => "CAPABILITY_WIDTH",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_WIDTH" ),
        ),
        array(
            "CODE" => "CAPABILITY_EXTERNALID",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_CAPABILITY_CAPABILITY_EXTERNALID" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
            "VALUE" => "ID",
            "TYPE" => "field",
        ),
        array(
            "CODE" => "BRAND_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_BRAND_NAME" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "BRAND_COMPANYINFO",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_BRAND_COMPANYINFO" ),
        ),
        array(
            "CODE" => "SERIA_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SERIA_NAME" ),
        ),
        array(
            "CODE" => "SUBSTANCE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SUBSTANCE" ),
        ),
        array(
            "CODE" => "COLOR_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_COLOR_NAME" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "COLOR_COLOR",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_COLOR_COLOR" ),
            "REQUIRED" => "Y",
            "DELETE_ONEMPTY" => "N",
        ),
        array(
            "CODE" => "DIMENSIONS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_DIMENSIONS" ),
        ),
        array(
            "CODE" => "TDIMENSIONS",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_TDIMENSIONS" ),
        ),
        array(
            "CODE" => "WARRANTY",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_WARRANTY" ),
        ),
        array(
            "CODE" => "SCALE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SCALE" ),
        ),
        array(
            "CODE" => "WEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_WEIGHT" ),
        ),
        array(
            "CODE" => "SEX",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SEX" ),
        ),
        array(
            "CODE" => "ELEMENTCOUNT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ELEMENTCOUNT" ),
        ),
        array(
            "CODE" => "FROMAGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_FROMAGE" ),
        ),
        array(
            "CODE" => "TOAGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_TOAGE" ),
        ),
        array(
            "CODE" => "ARTICLE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ARTICLE" ),
        ),
        array(
            "CODE" => "RESTRICTION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_RESTRICTION" ),
        ),
        array(
            "CODE" => "AGEO",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_AGEO" ),
        ),
        array(
            "CODE" => "COMPOSITION",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_COMPOSITION" ),
        ),
        array(
            "CODE" => "SEARCHNAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SEARCHNAME" ),
        ),
        array(
            "CODE" => "NUM",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_NUM" ),
        ),
        array(
            "CODE" => "SEASON",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SEASON" ),
        ),
        array(
            "CODE" => "ASPECT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_ASPECT" ),
        ),
        array(
            "CODE" => "INTERNALCOMMENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_INTERNALCOMMENT" ),
        ),
        array(
            "CODE" => "PACKAGE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_PACKAGE" ),
        ),
        array(
            "CODE" => "COMMENT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_COMMENT" ),
        ),
        array(
            "CODE" => "MOVIE_NAME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_NAME" ),
        ),
        array(
            "CODE" => "MOVIE_SIZE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_SIZE" ),
        ),
        array(
            "CODE" => "MOVIE_WIDTH",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_WIDTH" ),
        ),
        array(
            "CODE" => "MOVIE_HEIGHT",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_HEIGHT" ),
        ),
        array(
            "CODE" => "MOVIE_DURATIONTIME",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_DURATIONTIME" ),
        ),
        array(
            "CODE" => "MOVIE_STREAMMOVIE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_STREAMMOVIE" ),
        ),
        array(
            "CODE" => "MOVIE_YOUTUBE",
            "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_MOVIE_YOUTUBE" ),
        ),
    ),
    "FORMAT" => '<?xml version="1.0" encoding="#ENCODING#"?>
<Products>
    #ITEMS#
</Products>',
);

$bCatalog = false;
if( CModule::IncludeModule( "catalog" ) ){
    $arBasePrice = CCatalogGroup::GetBaseGroup();
    $basePriceCode = "CATALOG-PRICE_".$arBasePrice["ID"];
    $basePriceCodeWithDiscount = "CATALOG-PRICE_".$arBasePrice["ID"]."_WD";
    $bCatalog = true;

    $profileTypes["ozon_api"]["FIELDS"][8] = array(
        "CODE" => "SELLING_PRICE",
        "NAME" => GetMessage( "DATA_EXPORTPROPLUS_OZON_API_FIELD_SELLING_PRICE" ),
        "TYPE" => "field",
        "VALUE" => $basePriceCode,
    );
}

$profileTypes["ozon_api"]["PORTAL_REQUIREMENTS"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_OZON_API_PORTAL_REQUIREMENTS" );
$profileTypes["ozon_api"]["PORTAL_VALIDATOR"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_OZON_API_PORTAL_VALIDATOR" );
$profileTypes["ozon_api"]["EXAMPLE"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_OZON_API_EXAMPLE" );
$profileTypes["ozon_api"]["SCHEME_OFFER_DESCRIPTION"] = GetMessage( "DATA_EXPORTPROPLUS_TYPE_OZON_API_SCHEME_DESCRIPTION" );

$profileTypes["ozon_api"]["CURRENCIES"] =
    "<currency id='#CURRENCY#' rate='#RATE#' plus='#PLUS#'></currency>".PHP_EOL;

$profileTypes["ozon_api"]["SECTIONS"] =
    "<category id='#ID#'>#NAME#</category>".PHP_EOL;

$profileTypes["ozon_api"]["ITEMS_FORMAT"] = '
<Product MerchantSKU="#ID#" ProductTypeID="#MARKET_CATEGORY#">
    <SKU>
        <Name>#NAME#</Name>
        <ManufacturerIdentifier>#MANUFACTURER_IDENTIFIER#</ManufacturerIdentifier>
        <GrossWeight>#GROSS_WEIGHT#</GrossWeight>
        <InternalName>#INTERNAL_NAME#</InternalName>
    </SKU>
    <Price>
        <SellingPrice>#SELLING_PRICE#</SellingPrice>
        <Discount>#DISCOUNT#</Discount>
    </Price>
    <Availability>
        <SellingState>#SELLING_STATE#</SellingState>
        <SupplyState>#SUPPLY_STATE#</SupplyState>
        <SupplyPeriod>#SUPPLY_PERIOD#</SupplyPeriod>
        <Qty>#QTY#</Qty>
    </Availability>
    <Description>
        <Name>#NAME#</Name>
        <AlterName>#ALTERNAME#</AlterName>
        <ElucidativeName>#ELUCIDATIVENAME#</ElucidativeName>
        <StickerInfo>#STICKERINFO#</StickerInfo>
        <Annotation>#ANNOTATION#</Annotation>
        <Picture>#SITE_URL##PICTURE#</Picture>
        <Images>#SITE_URL##IMAGES#</Images>
        <ReleaseYear>#RELEASEYEAR#</ReleaseYear>
        <Country>#COUNTRY#</Country>
        <Packing>#PACKING#</Packing>
        <Producer>
            <Name>#PRODUCER_NAME#</Name>
            <CompanyInfo>#PRODUCER_COMPANYINFO#</CompanyInfo>
        </Producer>
        <Capability>
            <Type>#CAPABILITY_TYPE#</Type>
            <Name>#CAPABILITY_NAME#</Name>
            <Annotation>#CAPABILITY_ANNOTATION#</Annotation>
            <Optional>#CAPABILITY_OPTIONAL#</Optional>
            <Purpose>#CAPABILITY_PURPOSE#</Purpose>
            <Material>#CAPABILITY_MATERIAL#</Material>
            <AgeMin>#CAPABILITY_AGEMIN#</AgeMin>
            <AgeMax>#CAPABILITY_AGEMAX#</AgeMax>
            <AgeSport>#CAPABILITY_AGESPORT#</AgeSport>
            <MaxLoadComplex>#CAPABILITY_MAXLOADCOMPLEX#</MaxLoadComplex>
            <MaxLoadUnit>#CAPABILITY_MAXLOADUNIT#</MaxLoadUnit>
            <Accessories>#CAPABILITY_ACCESSORIES#</Accessories>
            <Playground>#CAPABILITY_PLAYGROUND#</Playground>
            <ExternalID>#CAPABILITY_EXTERNALID#</ExternalID>
            <Length>#CAPABILITY_LENGTH#</Length>
            <Width>#CAPABILITY_WIDTH#</Width>
            <Height>#CAPABILITY_HEIGHT#</Height>
            <MuscleGroups>#CAPABILITY_MUSCLEGROUPS#</MuscleGroups>
            <MaxUserWeight>#CAPABILITY_MAXUSERWEIGHT#</MaxUserWeight>
            <SystemWeight>#CAPABILITY_SYSTEMWEIGHT#</SystemWeight>
            <Exercises>#CAPABILITY_EXERCISES#</Exercises>
            <Control>#CAPABILITY_CONTROL#</Control>
            <Encoders>#CAPABILITY_ENCODERS#</Encoders>
            <Level>#CAPABILITY_LEVEL#</Level>
            <Features>#CAPABILITY_FEATURES#</Features>
            <DistFromWall>#CAPABILITY_DISTFROMWALL#</DistFromWall>
            <ProgsQty>#CAPABILITY_PROGSQTY#</ProgsQty>
            <MaxAngle>#CAPABILITY_MAXANGLE#</MaxAngle>
            <SportType>#CAPABILITY_SPORTTYPE#</SportType>
        </Capability>
        <Brand>
            <Name>#BRAND_NAME#</Name>
            <CompanyInfo>#BRAND_COMPANYINFO#</CompanyInfo>
        </Brand>
        <Seria>
            <Name>#SERIA_NAME#</Name>
        </Seria>
        <Substance>#SUBSTANCE#</Substance>
        <Color>
            <Name>#COLOR_NAME#</Name>
            <Color>#COLOR_COLOR#</Color>
        </Color>
        <Warranty>#WARRANTY#</Warranty>
        <Dimensions>#DIMENSIONS#</Dimensions>
        <TDimensions>#TDIMENSIONS#</TDimensions>
        <Scale>#SCALE#</Scale>
        <Weight>#WEIGHT#</Weight>
        <Sex>#SEX#</Sex>
        <ElementCount>#ELEMENTCOUNT#</ElementCount>
        <FromAge>#FROMAGE#</FromAge>
        <ToAge>#TOAGE#</ToAge>
        <Article>#ARTICLE#</Article>
        <Restriction>#RESTRICTION#</Restriction>
        <AgeO>#AGEO#</AgeO>
        <Composition>#COMPOSITION#</Composition>
        <SearchName>#SEARCHNAME#</SearchName>
        <Num>#NUM#</Num>
        <Season>#SEASON#</Season>
        <Aspect>#ASPECT#</Aspect>
        <InternalComment>#INTERNALCOMMENT#</InternalComment>
        <Package>#PACKAGE#</Package>
        <Comment>#COMMENT#</Comment>
        <Movie>
            <Name>#MOVIE_NAME#</Name>
            <Size>#MOVIE_SIZE#</Size>
            <Width>#MOVIE_WIDTH#</Width>
            <Height>#MOVIE_HEIGHT#</Height>
            <DurationTime>#MOVIE_DURATIONTIME#</DurationTime>
            <StreamMovie>#MOVIE_STREAMMOVIE#</StreamMovie>
            <YouTube>#MOVIE_YOUTUBE#</YouTube>
        </Movie>
    </Description>
</Product>';