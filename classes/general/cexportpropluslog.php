<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;

\Bitrix\Main\Loader::includeModule( "data.exportproplus" );

Loc::loadMessages( __FILE__ );

class CDataExportproplusLog{
    public $logFilename = "/upload/data.exportproplus/";
    private $profileId;
    private $session;

    private $profileEncoding = array(
        "utf8" => "utf-8",
        "cp1251" => "windows-1251",
    );

    public function __construct( $profileId = false ){
        $this->profileId = $profileId;
    }

    public static function DataDump( $dumpData, $clear = FALSE, $depth = 0 ){
        $fileName = "data_exportproplus_dump.txt";
        $file = $_SERVER["DOCUMENT_ROOT"]."/upload/".$fileName;

        $depthSign = "----";

        $strResult = "";
        $strDepth  = "";
        $nextDepth = $depth + 1;

        if( isset( $dumpData )
            && filter_var( $depth ) !== FALSE
            && $depth >= 0
            && is_bool( $clear ) ){

            if( $depth == 0
                && $clear ){

                file_put_contents( $file, "" );
            }
            else{
                for( $ico = 0; $ico < (int) $depth; $ico += 1 ){
                    $strDepth .= $depthSign;
                }
                $strDepth .= " ";
            }

            if( is_array( $dumpData ) ){
                foreach( $dumpData as $key => $value ){
                    if( is_array( $value ) ){
                        $strResult .= $strDepth.$key." = Array:\n";
                        file_put_contents( $file, $strResult, FILE_APPEND );
                        $strResult = "";

                        self::DataDump( $value, $clear, $nextDepth );
                    }
                    elseif( is_null( $value ) ){
                        $strResult .= $strDepth.$key." = *NULL*\n";
                    }
                    elseif( $value === FALSE ){
                        $strResult .= $strDepth.$key." = *FALSE*\n";
                    }
                    elseif( is_string( $value )
                        && strlen( $value ) <= 0 ){

                        $strResult .= $strDepth.$key." = *EMPTY STRING*\n";
                    }
                    else{
                        $strResult .= $strDepth.$key." = ".$value."\n";
                    }
                }
            }
            elseif( is_null( $dumpData ) ){
                $strResult = "*NULL*\n";
            }
            elseif( $dumpData === FALSE ){
                $strResult = "*FALSE*\n";
            }
            elseif( is_string( $dumpData )
                && strlen( $dumpData ) <= 0 ){

                $strResult = "*EMPTY STRING*\n";
            }
            else{
                $strResult = $dumpData."\n";
            }
        }

        if( $depth === 0 ){
            $strResult .= "____________________________________________________\n\n";
        }

        if( strlen( $strResult ) > 0 ){
            file_put_contents( $file, $strResult, FILE_APPEND );
        }
    }

    public function Init( $profile ){
        $sessionData = DataExportproplusSession::GetSession( $profile["ID"] );

        $sessionData["EXPORTPROPLUS"]["LOG"][$profile["ID"]] = array(
            "IBLOCK" => 0,
            "SECTIONS" => 0,
            "PRODUCTS" => 0,
            "PRODUCTS_EXPORT" => 0,
            "PRODUCTS_ERROR" => 0,
            "FILE" => "",
            "LAST_START_EXPORT" => date( "d.m.Y H:i:s", time() )
        );
        $profileObj = new CExportproplusProfile();

        if( CModule::IncludeModule( "catalog" ) ){
            $sessionData["EXPORTPROPLUS"]["LOG"][$profile["ID"]]["IBLOCK"] = count( $profileObj->PrepareIBlock( $profile["IBLOCK_ID"], $profile["USE_SKU"] ) );
        }
        else{
            $sessionData["EXPORTPROPLUS"]["LOG"][$profile["ID"]]["IBLOCK"] = count( $profileObj->PrepareIBlock( $profile["IBLOCK_ID"], false ) );
        }

        if( $profile["CHECK_INCLUDE"] != "Y" ){
            $sections = array();
            $dbSection = CIBlockSection::GetList(
                array(),
                array(
                    "ID" => $profile["CATEGORY"]
                ),
                false,
                array(
                    "ID",
                    "LEFT_MARGIN",
                    "RIGHT_MARGIN"
                )
            );

            $arFilter = array( "LOGIC" => "OR" );

            while( $arSection = $dbSection->GetNext() ){
                $arFilter = array(
                    ">LEFT_MARGIN" => $arSection["LEFT_MARGIN"],
                    "<RIGHT_MARGIN" => $arSection["RIGHT_MARGIN"],
                    "IBLOCK_ID" => $profile["IBLOCK_ID"]
                );

                $dbSection2 = CIBlockSection::GetList(
                    array(),
                    $arFilter,
                    false,
                    array( "ID" )
                );

                while( $arSection2 = $dbSection2->GetNext() )
                    $sections[] = $arSection2["ID"];
            }
            $sections = array_unique( $sections );
            $sessionData["EXPORTPROPLUS"]["LOG"][$profile["ID"]]["SECTIONS"] = count( $sections );
        }
        else{
            $sessionData["EXPORTPROPLUS"]["LOG"][$profile["ID"]]["SECTIONS"] = count( $profile["CATEGORY"] );
        }
        $this->profileId = $profile["ID"];
        CheckDirPath( $_SERVER["DOCUMENT_ROOT"].$this->logFilename );
        $this->logFilename = $this->logFilename."log_export_".$this->profileId.".txt";
        $sessionData["EXPORTPROPLUS"]["LOG"][$profile["ID"]]["FILE"] = $this->logFilename;

        $sEmptyFileContent = ( $profile["TYPE"] == "ozon_api" ) ? GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_FIELD_OZON_ERRORS_DESC" ) : "";

        file_put_contents( $_SERVER["DOCUMENT_ROOT"].$this->logFilename, $sEmptyFileContent );

        DataExportproplusSession::SetSession( $profile["ID"], $sessionData );
    }

    public function IncIblcok(){
        $sessionData = DataExportproplusSession::GetSession( $this->profileId );
        $sessionData["EXPORTPROPLUS"]["LOG"][$this->profileId]["IBLOCK"]++;
        DataExportproplusSession::SetSession( $this->profileId, $sessionData );
    }

    public function IncSection(){
        $sessionData = DataExportproplusSession::GetSession( $this->profileId );
        $sessionData["EXPORTPROPLUS"]["LOG"][$this->profileId]["SECTIONS"]++;
        DataExportproplusSession::SetSession( $this->profileId, $sessionData );
    }

    public function IncProduct( $cnt = 0 ){
        $sessionData = DataExportproplusSession::GetSession( $this->profileId );
        if( !intval( $cnt ) )
            $sessionData["EXPORTPROPLUS"]["LOG"][$this->profileId]["PRODUCTS"]++;
        else
            $sessionData["EXPORTPROPLUS"]["LOG"][$this->profileId]["PRODUCTS"] += $cnt;

        DataExportproplusSession::SetSession( $this->profileId, $sessionData );
    }

    public function IncProductExport(){
        $sessionData = DataExportproplusSession::GetSession( $this->profileId );
        $sessionData["EXPORTPROPLUS"]["LOG"][$this->profileId]["PRODUCTS_EXPORT"]++;
        DataExportproplusSession::SetSession( $this->profileId, $sessionData );
    }

    public function IncProductError(){
        $sessionData = DataExportproplusSession::GetSession( $this->profileId );
        $sessionData["EXPORTPROPLUS"]["LOG"][$this->profileId]["PRODUCTS_ERROR"]++;
        DataExportproplusSession::SetSession( $this->profileId, $sessionData );
    }

    public function AddMessage( $message ){
        $messageProfileId = $this->profileId;

        $arMbStringData = mb_get_info();

        if( is_array( $arMbStringData ) && !empty( $arMbStringData ) ){
            if( mb_stripos( $this->logFilename, $messageProfileId ) === false ){
                $this->logFilename = $this->logFilename."log_export_".$messageProfileId.".txt";
            }
        }
        else{
             if( stripos( $this->logFilename, $messageProfileId ) === false ){
                $this->logFilename = $this->logFilename."log_export_".$messageProfileId.".txt";
            }
        }

        if( is_file( $_SERVER["DOCUMENT_ROOT"].$this->logFilename ) ){
            file_put_contents( $_SERVER["DOCUMENT_ROOT"].$this->logFilename, $message, FILE_APPEND );
        }
    }

    public function GetLog( $profileID, $bSendEmailReport = true, $arSupportData = false ){
        $dbProfile = new CExportproplusProfileDB();
        $arProfile = $dbProfile->GetByID( $profileID );

        $arSessionData = DataExportproplusSession::GetAllSession( $profileID );
        $sessionData = array();

        if( !empty( $arSessionData ) ){
            $sessionData = $arSessionData[0];
            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] = intval( $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] );
            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] = intval( $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] );
            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] = intval( $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] );

            unset( $arSessionData[0] );

            foreach( $arSessionData as $sData ){
                $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] += intval( $sData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] );
                $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] += intval( $sData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] );
                $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] += intval( $sData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] );
            }

            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] = $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] - $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"];
        }

        if( $bSendEmailReport ){
            $dbProfile = new CExportproplusProfileDB();
            $arProfile = $dbProfile->GetByID( $profileID );

            if( check_email( $arProfile["SEND_LOG_EMAIL"] ) ){
                $exportTimeStamp = MakeTimeStamp( $arProfile["SETUP"]["LAST_START_EXPORT"] );
                $profileTimeStamp = MakeTimeStamp( $arProfile["TIMESTAMP_X"] );

                $statVal = "";
                if( !$exportTimeStamp ){
                    $statVal = GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_GENERATE" );
                }
                elseif( $exportTimeStamp < $profileTimeStamp ){
                    $statVal = GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_REGENERATE" );
                }
                else{
                    if( $arProfile["SETUP"]["TYPE_RUN"] == "comp" ){
                        $statVal = GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_FINISHED" );
                    }
                    else{
                        $maxCronProducts = 0;
                        foreach( $arProfile["SETUP"]["CRON"] as $cronIndex => $arCronRow ){
                            if( $arCronRow["MAXIMUM_PRODUCTS"] > $maxCronProducts ){
                                $maxCronProducts = $arCronRow["MAXIMUM_PRODUCTS"];
                            }
                        }

                        if( !$maxCronProducts ){
                            $statVal = GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_FINISHED" );
                        }
                        else{
                            $unloandedPercent = floor( $arProfile["UNLOADED_OFFERS_CORRECT"] / $maxCronProducts * 100 );
                            if( $unloandedPercent >= 100 ){
                                $statVal = GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_FINISHED" );
                            }
                            else{
                                $statVal = GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_IN_PROCESS_BEGIN" )." ".$arProfile["UNLOADED_OFFERS_CORRECT"]." ".GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_IN_PROCESS_END" ).$unloandedPercent;
                            }
                        }
                    }
                }

                $messageTitle = GetMessage( "DATA_LOG_SEND_TITLE" ).$arProfile["DOMAIN_NAME"];
                $messageBlock = GetMessage( "DATA_LOG_SEND_OFFERS" ).$sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"]."\n".
                GetMessage( "DATA_LOG_SEND_OFFERS_TERM" ).$sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"]."\n".
                GetMessage( "DATA_LOG_SEND_OFFERS_ERROR" ).$sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"]."\n".
                GetMessage( "DATA_LOG_SEND_DATE" ).$sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["LAST_START_EXPORT"]."\n\n";

                if( is_array( $arSupportData ) && !empty( $arSupportData ) ){
                    $messageBlock .= GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT_SUPPORT_DATA" )."\n";
                    foreach( $arSupportData as $arSupportDataBlock ){
                        $messageBlock .= $arSupportDataBlock."\n";
                    }
                    $messageBlock .= "\n";
                }

                if( strlen( $statVal ) > 0 ){
                    $messageBlock .= GetMessage( "DATA_EXPORTPROPLUS_LOG_STAT" ).$statVal."\n\n";
                }

                $messageBlock .= GetMessage( "DATA_LOG_PROFILE" ).$arProfile["SITE_PROTOCOL"]."://".$arProfile["DOMAIN_NAME"]."/bitrix/admin/data_exportproplus_edit.php?ID=".$profileID."\n".
                GetMessage( "DATA_LOG_SEND_FILE" ).$arProfile["SITE_PROTOCOL"]."://".$arProfile["DOMAIN_NAME"].$sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["FILE"];

                $headers = "Content-type: text/plain; charset=".LANG_CHARSET;
                bxmail( $arProfile["SEND_LOG_EMAIL"], $messageTitle, $messageBlock, $headers );
            }
        }

        return $sessionData["EXPORTPROPLUS"]["LOG"][$profileID];
    }

    public function GetLogArray( $profileID ){
        $arLogArray = array();

        $dbProfile = new CExportproplusProfileDB();
        $arProfile = $dbProfile->GetByID( $profileID );

        $arSessionData = DataExportproplusSession::GetAllSession( $profileID );
        $sessionData = array();
        if( !empty( $arSessionData ) ){
            $sessionData = $arSessionData[0];
            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] = intval( $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] );
            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] = intval( $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] );
            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] = intval( $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] );

            unset( $arSessionData[0] );

            foreach( $arSessionData as $sData ){
                $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] += intval( $sData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] );
                $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] += intval( $sData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"] );
                $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] += intval( $sData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] );
            }

            $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"] = $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"] - $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"];
        }

        $arLogArray["PRODUCTS"] = $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS"];
        $arLogArray["PRODUCTS_EXPORT"] = $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_EXPORT"];
        $arLogArray["PRODUCTS_ERROR"] = $sessionData["EXPORTPROPLUS"]["LOG"][$profileID]["PRODUCTS_ERROR"];

        return $arLogArray;
    }
}