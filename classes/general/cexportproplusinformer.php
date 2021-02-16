<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

use Bitrix\Main\Localization\Loc;
Loc::loadMessages( __FILE__ );

require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client_partner.php" );

class CExportproplusInformer{
    private static $moduleId = "data.exportproplus";
    private static $modulePrefix = "data";
    private static $timeExpire = 2592000;

    private function GetSiteInfo(){
        $dbSite = CSite::GetList(
            $by = "sort",
            $order = "asc",
            array(
                "ACTIVE" => "Y",
            )
        );

        $arProcessSite = array();
        if( $arSite = $dbSite->Fetch() ){
            $arProcessSite["LID"] = $arSite["LID"];
            $arProcessSite["DOMAIN_NAME"] = $arSite["SERVER_NAME"];
            $arProcessSite["SITE_NAME"] = $arSite["SITE_NAME"];
            $arProcessSite["DESCRIPTION"] = $arSite["NAME"];
            $arProcessSite["SITE_PROTOCOL"] = ( ( CMain::IsHTTPS() ) ? "https" : "http" );
        }

        return $arProcessSite;
    }

    private function GetAdminList(){
        $dbAdminUsers = CUser::GetList(
            ( $by = "ID" ),
            ( $order = "asc" ),
            array(
                "GROUPS_ID" => array( 1 ),
            )
        );

        $arResultAdminUsers = array();
        while( $arAdminUser = $dbAdminUsers->Fetch() ){
            $arResultAdminUser = array();
            $arResultAdminUser["ID"] = $arAdminUser["ID"];
            $arResultAdminUser["FULL_NAME"] = $arAdminUser["NAME"]." ".$arAdminUser["LAST_NAME"];
            $arResultAdminUser["EMAIL"] = $arAdminUser["EMAIL"];
            $arResultAdminUsers[] = $arResultAdminUser;
        }

        return $arResultAdminUsers;
    }

    public function CheckCRMIntergation(){
        $result = false;

        $crmIntegrationData = COption::GetOptionString( "sale", "~crm_integration", "" );
        $arCrmIntegration = unserialize( $crmIntegrationData );

        if( !is_array( $arCrmIntegration ) || empty( $arCrmIntegration ) ){
            $result = true;
        }

        return $result;
    }

    private function GetMarketModuleList(){
        $arModules = array();

        $arRequestedModules = CUpdateClientPartner::GetRequestedModules( "" );
        $arUpdateList = CUpdateClientPartner::GetUpdatesList(
            $errorMessage,
            LANGUAGE_ID,
            "N",
            $arRequestedModules,
            array(
                "fullmoduleinfo" => "Y"
            )
        );

        $arModules = $arUpdateList;

        return $arModules;
    }

    public function GetModuleUpdatesInfo(){
        $bHasUpdates = false;

        $arModuleList = self::GetMarketModuleList();
        if( CDataExportproplusTools::ArrayValidate( $arModuleList["MODULE"] ) ){
            foreach( $arModuleList["MODULE"] as $arModule ){
                if( $arModule["@"]["ID"] != self::$moduleId ){
                    continue;
                }

                if( CDataExportproplusTools::ArrayValidate( $arModule["#"] )
                    && CDataExportproplusTools::ArrayValidate( $arModule["#"]["VERSION"] )
                ){
                    $bHasUpdates = true;
                }
            }
        }

        return $bHasUpdates;
    }

    public function CheckBitrixCloudMonitoring( $addEmail ){
        $bExistBitrixCloudMonitoring = false;

        if( CModule::IncludeModule( "bitrixcloud" ) ){
            $monitoring = CBitrixCloudMonitoring::getInstance();
            try{
                $arMonitoringList = $monitoring->getList();
                foreach( $arMonitoringList as $arMonitoringListItem ){
                    if(
                        ( $arMonitoringListItem["DOMAIN"] == $_SERVER["SERVER_NAME"] )
                        && ( in_array( $addEmail, $arMonitoringListItem["EMAILS"] ) )
                    ){
                        $bExistBitrixCloudMonitoring = true;
                        break;
                    }
                }
            }
            catch( Exception $e ){}
        }

        return $bExistBitrixCloudMonitoring;
    }

    public function UpdateBitrixCloudMonitoring( $addEmail ){
        $bBitrixCloudMonitoringUpdated = false;

        if( CModule::IncludeModule( "bitrixcloud" ) ){
            $monitoring = CBitrixCloudMonitoring::getInstance();
            try{
                $arMonitoringList = $monitoring->getList();

                foreach( $arMonitoringList as $arMonitoringListItem ){
                    if( $arMonitoringListItem["DOMAIN"] == $_SERVER["SERVER_NAME"] ){
                        if( !in_array( $addEmail, $arMonitoringListItem["EMAILS"] ) ){
                            $arMonitoringListItem["EMAILS"][] = $addEmail;

                            $arUpdateMonitoring = $monitoring->startMonitoring(
                                $arMonitoringListItem["DOMAIN"],
                                $arMonitoringListItem["IS_HTTPS"] === "Y",
                                LANGUAGE_ID,
                                $arMonitoringListItem["EMAILS"],
                                $arMonitoringListItem["TESTS"]
                            );

                            $bBitrixCloudMonitoringUpdated = true;
                        }
                        else{
                            foreach( $arMonitoringListItem["EMAILS"] as $emailIndex => $emailValue ){
                                if( $emailValue == $addEmail ){
                                    unset( $arMonitoringListItem["EMAILS"][$emailIndex] );
                                }
                            }

                            if( is_array( $arMonitoringListItem["EMAILS"] ) && !empty( $arMonitoringListItem["EMAILS"] ) ){
                                $arUpdateMonitoring = $monitoring->startMonitoring(
                                    $arMonitoringListItem["DOMAIN"],
                                    $arMonitoringListItem["IS_HTTPS"] === "Y",
                                    LANGUAGE_ID,
                                    $arMonitoringListItem["EMAILS"],
                                    $arMonitoringListItem["TESTS"]
                                );
                            }
                            else{
                                $arUpdateMonitoring = $monitoring->stopMonitoring( $arMonitoringListItem["DOMAIN"] );
                            }

                            $bBitrixCloudMonitoringUpdated = true;
                        }
                    }
                }

                if( !$bBitrixCloudMonitoringUpdated ){
                    $arMonitoringListItem = array();
                    $arMonitoringListItem["TESTS"] = array(
                        "test_http_response_time",
                        "test_domain_registration",
                        "test_lic",
                        "test_ssl_cert_validity"
                    );

                    $arMonitoringListItem["EMAILS"] = array( $addEmail );

                    $arUpdateMonitoring = $monitoring->startMonitoring(
                        $_SERVER["SERVER_NAME"],
                        CMain::IsHTTPS(),
                        LANGUAGE_ID,
                        $arMonitoringListItem["EMAILS"],
                        $arMonitoringListItem["TESTS"]
                    );

                    $bBitrixCloudMonitoringUpdated = true;
                }
            }
            catch( Exception $e ){}
        }

        return $bBitrixCloudMonitoringUpdated;
    }
}