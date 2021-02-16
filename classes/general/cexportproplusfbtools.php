<?
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\Loader::includeModule( "data.exportproplus" );

use FacebookAds\Api;
use FacebookAds\Object\AdAccount;

use FacebookAds\Object\ProductCatalog;
use FacebookAds\Object\Fields\ProductCatalogFields;

use FacebookAds\Object\ProductFeed;
use FacebookAds\Object\Fields\ProductFeedFields;
use FacebookAds\Object\Fields\ProductFeedScheduleFields;

Loc::loadMessages( __FILE__ );

class CDataExportproplusFbTools{
    private $profile = null;
    private $dbProfile = null;

    public function __construct( $profile ){
        $this->dbProfile = new CExportproplusProfileDB();
        $this->profile = $profile;
    }

    private function Init(){
        Api::init(
            $this->profile["FB"]["FB_ADS_APP_ID"],
            $this->profile["FB"]["FB_ADS_APP_SECRET"],
            $this->profile["FB"]["FB_ADS_ACCESS_TOKEN"]
        );
    }

    private function CreateCatalog( $businessId ){
        $obProductCatalog = new ProductCatalog( null, $businessId );

        $obProductCatalog->setData(
            array(
                ProductCatalogFields::NAME => $this->profile["NAME"],
            )
        );

        return $obProductCatalog->create();
    }

    private function CreateProductFeed( $catalogId, $feedUrl ){
        $obProductFeed = new ProductFeed( null, $catalogId );

        $obProductFeed->setData(
            array(
                ProductFeedFields::NAME => $this->profile["NAME"],
                ProductFeedFields::SCHEDULE => array(
                    ProductFeedScheduleFields::INTERVAL => "DAILY",
                    ProductFeedScheduleFields::URL => $feedUrl,
                    ProductFeedScheduleFields::HOUR => date( "Y" ),
                ),
            )
        );

        $obProductFeed->create();
    }

    public function FbAdsProcess( $feedUrl ){
        $this->Init();

        $obCatalog = $this->CreateCatalog( $this->profile["FB"]["FB_BUSINESS_ID"] );
        
        $arCatalogData = $obCatalog->getData();
        $this->CreateProductFeed( $arCatalogData["id"], $feedUrl );
    }
}