<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$moduleId = "data.exportproplus";
require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$moduleId.'/prolog.php');

use Bitrix\Main\SystemException;

IncludeModuleLangFile(__FILE__);

# Redirect OLD -> NEW (if old core is disabled in options)
if(\Bitrix\Main\Config\Option::get($moduleId, 'disable_old_core') == 'Y'){
	LocalRedirect('/bitrix/admin/data_'.end(explode('.', $moduleId)).'_new_list.php?lang='.LANGUAGE_ID);
}

$moduleStatus = CModule::IncludeModuleEx( $moduleId );

    require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/$moduleId/include.php" );

    IncludeModuleLangFile( __FILE__ );

    global $ID, $PROFILE, $save, $apply, $copy;

    $lastException = false;

    $obProfile = new CExportproplusProfileDB();
    $obProfileUtils = new CExportproplusProfile();

    CUtil::InitJSCore( array( "ajax", "jquery" ) );
    $APPLICATION->AddHeadScript( "/bitrix/js/iblock/iblock_edit.js" );
    $APPLICATION->AddHeadScript( "/bitrix/js/data.exportproplus/main.js" );
    $t = CJSCore::getExtInfo( "jquery" );

    if( !is_array( $t ) || !isset( $t["js"] ) || !file_exists( $DOCUMENT_ROOT.$t["js"] ) ){
        try{
            throw new SystemException( GetMessage( "DATA_EXPORTPROPLUS_JQUERY_REQUIRE" ) );
        }
        catch( SystemException $exception ){
            global $lastException;
            $lastException = $exception->getMessage();
        }
    }

    if( !CModule::IncludeModule( "iblock" ) ){
        return false;
    }

    $catalog = ( !CModule::IncludeModule( "catalog" ) ) ? false : true;
    $currency = ( !CModule::IncludeModule( "currency" ) ) ? false : true;

    IncludeModuleLangFile( __FILE__ );

    $POST_RIGHT = $APPLICATION->GetGroupRight( $moduleId );
    if( $POST_RIGHT == "D" ){
        $APPLICATION->AuthForm( GetMessage( "ACCESS_DENIED" ) );
    }

    $ID = intval( $ID );        // Id of the edited record
    $bCopy = ( $action == "copy" );
    $message = null;
    $bVarsFromForm = false;

    if( isset( $ID ) && ( intval( $ID ) > 0 ) ){
        $arProfile = $obProfile->GetByID( $ID );
    }
    else{
        $arProfile = $obProfileUtils->GetDefaults();
    }

    $profileTitle = GetMessage( "DATA_EXPORTPROPLUS_EDITPROFILE" ).": #".$arProfile["ID"]." ".$arProfile["NAME"];
    $APPLICATION->SetTitle( ( $ID > 0 ? $profileTitle : GetMessage( "DATA_EXPORTPROPLUS_ADDPROFILE" ) ) );
    if( $copy && $ID > 0 ){
        unset( $arProfile["ID"] );

        $arProfile["TIMESTAMP_X"] = CDatabase::FormatDate( $arProfile["TIMESTAMP_X"], "YYYY-MM-DD HH:MI:SS", "DD.MM.YYYY HH:MI:SS" );

        $ID = $obProfile->Add( $arProfile );
        if( !$ID ){
            LocalRedirect( $APPLICATION->GetCurPageParam( "", array( "ID", "copy" ) ) );
        }
        else{
            LocalRedirect( $APPLICATION->GetCurPageParam( "ID=$ID", array( "ID", "copy" ) ) );
        }
        die();
    }

    $aContext = array(
        array(
            "TEXT" => GetMessage( "MAIN_ADD" ),
            "LINK" => "data_exportproplus_edit.php?lang=".LANG,
            "TITLE" => GetMessage( "PARSER_ADD_TITLE" ),
            "ICON" => "btn_new",
        ),
    );

    // add attach it to list
    $sTableID = "tbl_dataprofile";
    $oSort = new CAdminSorting( $sTableID, "ID", "desc" );
    $lAdmin = new CAdminList( $sTableID, $oSort );
    $lAdmin->AddAdminContextMenu( $aContext );
    $lAdmin->CheckListMode();

    require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php" );


    $aMenu = array(
        array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_LIST" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_LIST" ),
            "LINK" => "data_exportproplus_list.php?lang=".LANG,
            "ICON" => "btn_list",
        ),
        array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_SAVE" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_SAVE" ),
            "LINK" => "javascript:$('.adm-btn-save').click()",
            "ICON" => "",
        ),
        array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_INSTRUCTION" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_INSTRUCTION" ),
            "LINK" => "http://www.data-studio.ru/technical-support/configuring-the-module-export-on-trade-portals/",
            "LINK_PARAM" => "target='blank'",
            "ICON" => "",
        ),
    );

    if( $ID > 0 ){
        $aMenu[] = array( "SEPARATOR" => "Y" );
        $aMenu[] = array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_ADD" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_ADD" ),
            "LINK" => "data_exportproplus_edit.php?lang=".LANG,
            "ICON" => "btn_new",
        );
        $aMenu[] = array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_COPY" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_COPY" ),
            "LINK" => "data_exportproplus_edit.php?copy=$ID&ID=$ID&lang=".LANG,
            "ICON" => "btn_copy",
        );
        $aMenu[] = array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_DEL" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_DEL" ),
            "LINK" => "javascript:if(confirm('".GetMessage( "DATA_EXPORTPROPLUS_PROFILE_DELETE_CONFIRM" )."'))window.location='data_exportproplus_list.php?ID=".$ID."&action=delete&lang=".LANG."&".bitrix_sessid_get()."';",
            "ICON" => "btn_delete",
        );
        $aMenu[] = array( "SEPARATOR" => "Y" );
        $aMenu[] = array(
            "TEXT" => GetMessage( "DATA_EXPORTPROPLUS_RUN" ),
            "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_RUN" ),
            "LINK" => "/bitrix/tools/data.exportproplus/data_exportproplus.php?ID=".$ID,
						"PUBLIC" => "Y",
            "ICON" => "btn_start_catalog"
        );
    }
    $context = new CAdminContextMenu( $aMenu );
    $context->Show();

    $siteEncoding = array(
        "utf-8" => "utf8",
        "UTF8" => "utf8",
        "UTF-8" => "utf8",
        "WINDOWS-1251" => "cp1251",
        "windows-1251" => "cp1251",
        "CP1251" => "cp1251",
    );

    CModule::IncludeModule( "catalog" );


    function CheckFields(){
        global $PROFILE, $APPLICATION, $ID;
        if( intval( $ID ) > 0 ){
            $export = new CDataExportproplusExport( $ID );
        }
        $requiredFields = array(
            "NAME", "CODE", "SHOPNAME", "COMPANY", "DOMAIN_NAME", "IBLOCK_ID"
        );

        foreach( $requiredFields as $field ){
            if( !$PROFILE[$field] ){
                try{
                    throw new SystemException( GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_INPUT_FIELD_FAIL", array( "#CODE#" => $field, "#NAME#" => GetMessage( "DATA_EXPORTPROPLUS_STEP1_".$field ) ) ) );
                }
                catch( SystemException $exception ){
                    global $lastException;
                    $lastException = $exception->getMessage();
                }
                return false;
            }
        }

        foreach( $PROFILE["XMLDATA"] as $id => $field ){
            if( $field["REQUIRED"] == "Y" ){
                if( ( $field["TYPE"] == "field" && !$field["VALUE"] ) || ( $field["TYPE"] == "const" && !$field["CONTVALUE_TRUE"] ) || $field["TYPE"] == "none" ){
                    try{
                        throw new SystemException( GetMessage( "DATA_EXPORTPROPLUS_REQUIRED_FIELD_FAIL", array( "#CODE#" => $field["CODE"], "#NAME#" => $field["NAME"] ) ) );
                    }
                    catch( SystemException $exception ){
                        global $lastException;
                        $lastException = $exception->getMessage();
                    }
                    return false;
                }
            }
        }

        if( $PROFILE["USE_MARKET_CATEGORY"] == "Y" ){
            if( is_array( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"] )
                && !empty( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"] )
            ){
                foreach( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"] as $categoryItem ){
                    if( strlen( trim( $categoryItem ) ) <= 0 ){
                        try{
                            throw new SystemException( GetMessage( "DATA_EXPORTPROPLUS_EMPTY_MARKET_CATEGORY_FIELDS" ) );
                        }
                        catch( SystemException $exception ){
                            global $lastException;
                            $lastException = $exception->getMessage();
                        }
                        return false;
                    }
                }

            }
            else{
                try{
                    throw new SystemException( GetMessage( "DATA_EXPORTPROPLUS_EMPTY_MARKET_CATEGORY_FIELDS" ) );
                }
                catch( SystemException $exception ){
                    global $lastException;
                    $lastException = $exception->getMessage();
                }
                return false;
            }
        }

        return true;
    }

    function PrepareFields(){
        global $PROFILE, $APPLICATION, $ID;

        foreach( $PROFILE["XMLDATA"] as $id => $field ){
            if( $field["TYPE"] == "none" ){
                $PROFILE["XMLDATA"][$id]["VALUE"] = "";
                $PROFILE["XMLDATA"][$id]["CONTVALUE_TRUE"] = "";
                $PROFILE["XMLDATA"][$id]["CONTVALUE_FALSE"] = "";
            }
        }
        return true;
    }

    $fieldsCheck = true;

    $bUnlockMode = file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/".$moduleId."/export_{$ID}_run.unlock" );

    if( $_SERVER["REQUEST_METHOD"] == "POST" && ( !empty( $save ) || !empty( $apply ) ) && !$bUnlockMode && check_bitrix_sessid() ){
        if( is_array( $PROFILE["SETUP"]["IBLOCK_TREE"] ) && !empty( $PROFILE["SETUP"]["IBLOCK_TREE"] ) ){
            $PROFILE["IBLOCK_TYPE_ID"] = array();
            $PROFILE["IBLOCK_ID"] = array();
            $PROFILE["CATEGORY"] = array();

            foreach( $PROFILE["SETUP"]["IBLOCK_TREE"] as $selectedItem ){
                $arSelectedItemData = explode( ":", $selectedItem );

                switch( $arSelectedItemData[0] ){
                    case "ibtype":
                        $PROFILE["IBLOCK_TYPE_ID"][] = $arSelectedItemData[1];
                        break;
                    case "ib":
                        $PROFILE["IBLOCK_ID"][] = $arSelectedItemData[1];
                        break;
                    case "section":
                        $PROFILE["CATEGORY"][] = $arSelectedItemData[1];
                        break;
                    default:
                        break;
                }
            }

            unset( $PROFILE["SETUP"]["IBLOCK_TREE"] );
        }

        if( $fieldsCheck = CheckFields() ){
            PrepareFields();

            if( CModule::IncludeModule( "catalog" ) ){
                $obCond = new CDataExportproplusCatalogCond();

                $boolCond = $obCond->Init( BT_COND_MODE_PARSE, 0, array() );
                if( !$boolCond ){
                    if( $lastException ){
                        CAdminMessage::ShowMessage(
                            array(
                                "MESSAGE" => $lastException,
                                "HTML" => "TRUE",
                            )
                        );
                    }
                }
            }

            foreach( $PROFILE["XMLDATA"] as $id => $field ){
                if( intval( $id ) > 0 ){
                    $PROFILE["XMLDATA"][$field["CODE"]] = $field;
                    unset( $PROFILE["XMLDATA"][$id] );
                }
            }
            foreach( $PROFILE["XMLDATA"] as $id => $field ){
                if( !empty( $field["CONDITION"] ) && CModule::IncludeModule( "catalog" ) ){
                    $PROFILE["XMLDATA"][$id]["CONDITION"] = $obCond->Parse( $field["CONDITION"] );
                }

                if( !isset( $field["PROCESS_LOGIC"] ) ){
                    $PROFILE["XMLDATA"][$id]["PROCESS_LOGIC"] = "N";
                }

                if( !isset( $field["DELETE_ONEMPTY"] ) ){
                    $PROFILE["XMLDATA"][$id]["DELETE_ONEMPTY"] = "N";
                }

                if( !isset( $field["DELETE_ONEMPTY_FORCE"] ) ){
                    $PROFILE["XMLDATA"][$id]["DELETE_ONEMPTY_FORCE"] = "N";
                }

                if( !isset( $field["DELETE_ONEMPTY_ROWFORCE"] ) ){
                    $PROFILE["XMLDATA"][$id]["DELETE_ONEMPTY_ROWFORCE"] = "N";
                }

                if( !isset( $field["HTML_ENCODE"] ) ){
                    $PROFILE["XMLDATA"][$id]["HTML_ENCODE"] = "N";
                }

                if( !isset( $field["HTML_ENCODE_CUT"] ) ){
                    $PROFILE["XMLDATA"][$id]["HTML_ENCODE_CUT"] = "N";
                }

                if( !isset( $field["HTML_TO_TXT"] ) ){
                    $PROFILE["XMLDATA"][$id]["HTML_TO_TXT"] = "N";
                }

                if( !isset( $field["SKIP_UNTERM_ELEMENT"] ) ){
                    $PROFILE["XMLDATA"][$id]["SKIP_UNTERM_ELEMENT"] = "N";
                }
            }



            if( !empty( $PROFILE["CONDITION"] ) && CModule::IncludeModule( "catalog" ) ){
                $PROFILE["CONDITION"] = $obCond->Parse( $PROFILE["CONDITION"] );
            }

            if( $PROFILE["TYPE"] == "ua_hotline_ua" ){
                $firmIdPos = stripos( $PROFILE["FORMAT"], "<firmId>" );
                if( $firmIdPos !== false ){
                    $firmIdFinalPos = stripos( $PROFILE["FORMAT"], "</firmId>" ) + 11;
                    if( $firmIdFinalPos !== false ){
                        $PROFILE["FORMAT"] = substr_replace( $PROFILE["FORMAT"], "", $firmIdPos, ( $firmIdFinalPos - $firmIdPos ) );
                    }
                }
                $PROFILE["FORMAT"] = str_replace( "</firmName>", "</firmName>".PHP_EOL."<firmId>".$PROFILE["HOTLINE_FIRM_ID"]."</firmId>", $PROFILE["FORMAT"] );
            }

            if( ( $PROFILE["TYPE"] == "google" ) || ( $PROFILE["TYPE"] == "google_online" ) ){
                $titlePos = stripos( $PROFILE["FORMAT"], "<title>" );
                if( $titlePos !== false ){
                    $titleFinalPos = stripos( $PROFILE["FORMAT"], "<link>" );
                    if( $titleFinalPos !== false ){
                        $PROFILE["FORMAT"] = substr_replace( $PROFILE["FORMAT"], "", $titlePos, ( $titleFinalPos - $titlePos ) );
                    }
                }

                $PROFILE["FORMAT"] = str_replace( "<link>", "<title>".$PROFILE["GOOGLE_GOOGLEFEED"]."</title>".PHP_EOL."<link>", $PROFILE["FORMAT"] );
            }

            if( !CDataExportproplusTools::ProcessMarketCategoriesOnEmpty( $PROFILE["VK"]["VK_MARKET_ALBUMS"] ) ){
                $PROFILE["VK"]["VK_MARKET_ALBUMS"] = null;
            }

            if( !CDataExportproplusTools::ProcessMarketCategoriesOnEmpty( $PROFILE["VK"]["VK_ALBUMS"] ) ){
                $PROFILE["VK"]["VK_ALBUMS"] = null;
            }

            if( $PROFILE["TYPE"] != "activizm" ){
                $PROFILE["VARIANT"] = null;
            }

            if( $PROFILE["CURRENCY"]["CONVERT_CURRENCY"] != "Y" ){
                $PROFILE["CURRENCY"] = null;
            }

            if( isset( $ID ) && ( intval( $ID ) > 0 ) ){
                if(
                    ( $arProfile["TYPE_RUN"] == "comp" )
                    && !isset( $PROFILE["TYPE_RUN"] )
                    && isset( $PROFILE["SETUP"]["TYPE_RUN"] )
                    && ( $PROFILE["SETUP"]["TYPE_RUN"] == "cron" )
                ){
                    $arIntersectAgents = CExportproplusAgent::GetIntersectAgents( $PROFILE["SETUP"]["CRON"] );
                    if( is_array( $arIntersectAgents ) && !empty( $arIntersectAgents ) ){
                        echo BeginNote();
                        echo GetMessage( "DATA_EXPORTPROPLUS_PROFILE_HAS_INTERSECT_AGENTS" );
                        foreach( $arIntersectAgents as $arIntersectAgentsItem ){
                            echo $arIntersectAgentsItem["NAME"].": ".$arIntersectAgentsItem["NEXT_EXEC"]."<br/>";
                        }
                        echo GetMessage( "DATA_EXPORTPROPLUS_PROFILE_HAS_INTERSECT_AGENTS_END" );
                        echo EndNote();
                    }
                }
            }

            switch( $PROFILE["TYPE"] ){
                case "ebay_1":
                case "ebay_2":
                case "ebay_mp30":
                    if( !CDataExportproplusTools::ProcessMarketCategoriesOnEmpty( $PROFILE["MARKET_CATEGORY"]["EBAY"]["CATEGORY_LIST"] ) ){
                        $PROFILE["MARKET_CATEGORY"] = null;
                    }
                    break;
                case "ozon":
                case "ozon_api":
                    if( !CDataExportproplusTools::ProcessMarketCategoriesOnEmpty( $PROFILE["MARKET_CATEGORY"]["OZON"]["CATEGORY_LIST"] ) ){
                        $PROFILE["MARKET_CATEGORY"] = null;
                    }
                    break;
                case "vk_trade":
                    if( !CDataExportproplusTools::ProcessMarketCategoriesOnEmpty( $PROFILE["MARKET_CATEGORY"]["VK"]["CATEGORY_LIST"] ) ){
                        $PROFILE["MARKET_CATEGORY"] = null;
                    }
                    $PROFILE["VK"]["VK_RELATIONS"] = $arProfile["VK"]["VK_RELATIONS"];
                    break;
                default:
                    if( !CDataExportproplusTools::ProcessMarketCategoriesOnEmpty( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"] ) ){
                        $PROFILE["MARKET_CATEGORY"] = null;
                    }
                    break;
            }

            if( is_array( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"] ) && !empty( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"] ) ){
                array_walk( $PROFILE["MARKET_CATEGORY"]["CATEGORY_LIST"], "CDataExportproplusStringProcess::DataArrayTrimFunc" );
            }

            if( $PROFILE["TYPE"] == "fb_ads" ){
                $PROFILE["FB"]["FB_PAGE_PUBLISH"] = $PROFILE["FB"]["FB_ADS_PAGE_PUBLISH"];
                $PROFILE["FB"]["FB_APP_ID"] = $PROFILE["FB"]["FB_ADS_APP_ID"];
                $PROFILE["FB"]["FB_APP_SECRET"] = $PROFILE["FB"]["FB_ADS_APP_SECRET"];
                $PROFILE["FB"]["FB_ACCESS_TOKEN"] = $PROFILE["FB"]["FB_ADS_ACCESS_TOKEN"];
            }

            if( is_array( $PROFILE["IBLOCK_AUTOFILL_PROPS"]["DATA"] ) && !empty( $PROFILE["IBLOCK_AUTOFILL_PROPS"]["DATA"] ) ){
                if( count( $PROFILE["IBLOCK_AUTOFILL_PROPS"]["DATA"] ) >= count( $arProfile["IBLOCK_AUTOFILL_PROPS"]["DATA"] ) ){
                    $arAufodillDiff = array_diff( $PROFILE["IBLOCK_AUTOFILL_PROPS"]["DATA"], $arProfile["IBLOCK_AUTOFILL_PROPS"]["DATA"] );
                }
                else{
                    $arAufodillDiff = array_diff( $arProfile["IBLOCK_AUTOFILL_PROPS"]["DATA"], $PROFILE["IBLOCK_AUTOFILL_PROPS"]["DATA"] );
                }

                if( !empty( $arAufodillDiff ) ){
                    $PROFILE["IBLOCK_AUTOFILL_PROPS"]["TMP"] = $arProfile["IBLOCK_AUTOFILL_PROPS"]["DATA"];
                }
                $iblockAutofillProps = $PROFILE["IBLOCK_AUTOFILL_PROPS"];
            }
            else{
                $iblockAutofillProps = $arProfile["IBLOCK_AUTOFILL_PROPS"];
            };

            $arFields = array(
                "ACTIVE" => ( $PROFILE["ACTIVE"] != "Y" ) ? "N" : "Y",
                "NAME" => $PROFILE["NAME"],
                "CODE" => $PROFILE["CODE"],
                "DESCRIPTION" => $PROFILE["DESCRIPTION"],
                "SHOPNAME" => $PROFILE["SHOPNAME"],
                "COMPANY" => $PROFILE["COMPANY"],
                "DOMAIN_NAME" => $PROFILE["DOMAIN_NAME"],
                "LID" => $PROFILE["LID"],
                "ENCODING" => $PROFILE["ENCODING"],
                "IBLOCK_TYPE_ID" => $PROFILE["IBLOCK_TYPE_ID"],
                "IBLOCK_ID" => $PROFILE["IBLOCK_ID"],
                "CATEGORY" => $PROFILE["CATEGORY"],
                "IBLOCK_AUTOFILL_PROPS" => $iblockAutofillProps,
                "USE_SKU" => ( $PROFILE["USE_SKU"] != "Y" ) ? "N" : "Y",
                "CHECK_INCLUDE" => ( $PROFILE["CHECK_INCLUDE"] != "Y" ) ? "N" : "Y",
                "VIEW_CATALOG" => ( $PROFILE["VIEW_CATALOG"] != "Y" ) ? "N" : "Y",
                "OTHER" => ( $PROFILE["OTHER"] != "Y" ) ? "N" : "Y",
                "TYPE" => $PROFILE["TYPE"],
                "NAMESCHEMA" => $PROFILE["NAMESCHEMA"],
                "FORMAT" => $PROFILE["FORMAT"],
                "OFFER_TEMPLATE" => $PROFILE["OFFER_TEMPLATE"],
                "CURRENCY_TEMPLATE" => $PROFILE["CURRENCY_TEMPLATE"],
                "CATEGORY_TEMPLATE" => $PROFILE["CATEGORY_TEMPLATE"],
                "CATEGORY_INNER_TEMPLATE" => $PROFILE["CATEGORY_INNER_TEMPLATE"],
                "DATEFORMAT" => $PROFILE["DATEFORMAT"],
                "SITE_PROTOCOL" => $PROFILE["SITE_PROTOCOL"],
                "XMLDATA" => $PROFILE["XMLDATA"],
                "CONVERT_DATA" => $PROFILE["CONVERT_DATA"],
                "CONDITION" => $PROFILE["CONDITION"],
                "CURRENCY" => $PROFILE["CURRENCY"],
                "MARKET_CATEGORY" => $PROFILE["MARKET_CATEGORY"],
                "EXPORT_PARENT_CATEGORIES" => ( $PROFILE["EXPORT_PARENT_CATEGORIES"] == "Y" ) ? "Y" : "N",
                "EXPORT_PARENT_CATEGORIES_TO_OFFER" => ( $PROFILE["EXPORT_PARENT_CATEGORIES_TO_OFFER"] == "Y" ) ? "Y" : "N",
                "EXPORT_OFFER_CATEGORIES_TO_OFFER" => ( $PROFILE["EXPORT_OFFER_CATEGORIES_TO_OFFER"] == "Y" ) ? "Y" : "N",
                "EXPORT_PARENT_CATEGORIES_WITH_IBLOCK_FIELDS" => ( $PROFILE["EXPORT_PARENT_CATEGORIES_WITH_IBLOCK_FIELDS"] == "Y" ) ? "Y" : "N",
                "EXPORT_DATA_OFFER" => ( $PROFILE["EXPORT_DATA_OFFER"] == "Y" ) ? "Y" : "N",
                "SKIP_WITH_SKU" => ( $PROFILE["SKIP_WITH_SKU"] == "Y" ) ? "Y" : "N",
                "EXPORT_DATA_OFFER_WITH_SKU_DATA" => ( $PROFILE["EXPORT_DATA_OFFER_WITH_SKU_DATA"] == "Y" ) ? "Y" : "N",
                "EXPORT_DATA_SKU" => ( $PROFILE["EXPORT_DATA_SKU"] == "Y" ) ? "Y" : "N",
                "EXPORT_DATA_SKU_BY_OFFER" => ( $PROFILE["EXPORT_DATA_SKU_BY_OFFER"] == "Y" ) ? "Y" : "N",
                "USE_COMPRESS" => ( $PROFILE["USE_COMPRESS"] == "Y" ) ? "Y" : "N",
                "USE_MARKET_CATEGORY" => ( $PROFILE["USE_MARKET_CATEGORY"] == "Y" ) ? "Y" : "N",
                "CHANGE_MARKET_CATEGORY" => ( $PROFILE["CHANGE_MARKET_CATEGORY"] == "Y" ) ? "Y" : "N",
                "SETUP" => $PROFILE["SETUP"],
                "USE_VARIANT" => ( $PROFILE["USE_VARIANT"] == "Y" ) ? "Y" : "N",
                "VARIANT" => $PROFILE["VARIANT"],
                "OZON_APPID" => $PROFILE["OZON_APPID"],
                "OZON_APPKEY" => $PROFILE["OZON_APPKEY"],
                "HOTLINE_FIRM_ID" => $PROFILE["HOTLINE_FIRM_ID"],
                "GOOGLE_GOOGLEFEED" => $PROFILE["GOOGLE_GOOGLEFEED"],
                "GOOGLETAGMANAGER_ID" => $PROFILE["GOOGLETAGMANAGER_ID"],
                "TIMESTAMP_X" => date( "d.m.Y H:i:s" ),
                "SEND_LOG_EMAIL" => ( check_email( $PROFILE["SEND_LOG_EMAIL"] ) ? $PROFILE["SEND_LOG_EMAIL"] : "" ),
                "USE_REMARKETING" => ( $PROFILE["USE_REMARKETING"] != "Y" ) ? "N" : "Y",
                "USE_GOOGLETAGMANAGER" => ( $PROFILE["USE_GOOGLETAGMANAGER"] != "Y" ) ? "N" : "Y",
                "USE_IBLOCK_CATEGORY" => ( $PROFILE["USE_IBLOCK_CATEGORY"] == "Y" ) ? "Y" : "N",
                "USE_IBLOCK_PRODUCT_CATEGORY" => ( $PROFILE["USE_IBLOCK_PRODUCT_CATEGORY"] == "Y" ) ? "Y" : "N",
                "USE_AUTOFILL_PROPS" => ( $PROFILE["USE_AUTOFILL_PROPS"] == "Y" ) ? "Y" : "N",
                "USE_EMPTY_TAG_CUT" => ( $PROFILE["USE_EMPTY_TAG_CUT"] == "Y" ) ? "Y" : "N",
                "USE_AUTOPRICE" => ( $PROFILE["USE_AUTOPRICE"] == "Y" ) ? "Y" : "N",
                "VK" => $PROFILE["VK"],
                "FB" => $PROFILE["FB"],
                "OK" => $PROFILE["OK"],
                "INSTAGRAM" => $PROFILE["INSTAGRAM"],
            );

            if( $ID ){
                $arOldProfile = $obProfile->GetByID( $ID );
                $arExportFilePath = explode( "/", $PROFILE["SETUP"]["URL_DATA_FILE"] );
                if( ( $arExportFilePath[1] == $moduleId ) && ( strlen( $arExportFilePath[2] ) > 0 ) ){
                    $bHasProtect = (
                        ( strlen( $PROFILE["SETUP"]["EXPORT_LOGIN"] ) > 0 )
                        && ( strlen( $PROFILE["SETUP"]["EXPORT_PASSWORD"] ) > 0 )
                        && ( strlen( $PROFILE["SETUP"]["EXPORT_PASSWORD_CONFIRM"] ) > 0 )
                        && ( $PROFILE["SETUP"]["EXPORT_PASSWORD"] == $PROFILE["SETUP"]["EXPORT_PASSWORD_CONFIRM"] )
                    ) ? true : false;

                    CDataExportproplusTools::SetProfileProtect( $arExportFilePath[2], $bHasProtect );

                    CDataExportproplusTools::SetProfilePassword(
                        array(
                            "OLDLOGIN" => $arOldProfile["SETUP"]["EXPORT_LOGIN"],
                            "OLDPASSWORD" => $arOldProfile["SETUP"]["EXPORT_PASSWORD"],
                            "LOGIN" => $PROFILE["SETUP"]["EXPORT_LOGIN"],
                            "PASSWORD" => $PROFILE["SETUP"]["EXPORT_PASSWORD"],
                        ),
                        $bHasProtect
                    );
                }

                $obProfile->Update( $ID, $arFields );
            }
            else{
                $ID = $obProfile->Add( $arFields );
            }

            switch( $PROFILE["SETUP"]["TYPE_RUN"] ){
                case "cron":
                    if( $PROFILE["ACTIVE"] == "Y" ){
                        CExportproplusAgent::AddAgent( $ID );
                    }
                    break;
                case "comp":
                    CExportproplusAgent::DelAgent( $ID );
                    break;
            }

            if( $PROFILE["ACTIVE"] != "Y" ){
                CExportproplusAgent::DelAgent( $ID );
            }

            if( $save ){
                LocalRedirect( "data_exportproplus_list.php" );
                die();
            }
            else{
                $query = parse_url( $_SERVER["REQUEST_URI"], PHP_URL_QUERY );
                parse_str( $query, $arQuery );

                if( !isset( $arQuery["ID"] ) || empty( $arQuery["ID"] ) ){
                    $arQuery["ID"] = $ID;
                    LocalRedirect( "data_exportproplus_edit.php?".http_build_query( $arQuery ) );
                    die();
                }
            }
        }
    }

    if( $fieldsCheck ){
        if( isset( $ID ) && ( intval( $ID ) > 0 ) ){
            $arProfile = $obProfile->GetByID( $ID );
        }
    }
    else{
        $arProfile = $PROFILE;
    }

    if( !isset( $_REQUEST["ajax"] ) && !isset( $_REQUEST["ib"] ) && !isset( $_REQUEST["ajax_start"] ) && !isset( $_REQUEST["ajax_count"] ) && !isset( $_POST["auth"] ) ){
        $arTabs = array(
            array(
                "DIV" => "step3",
                "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB3" ),
                "ICON" => "main_user_edit",
                "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB3" )
            ),
        );

        $arTabs[] = array( "DIV" => "step16", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB16" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB16" ) );
        $arTabs[] = array( "DIV" => "step17", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB17" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB17" ) );
        $arTabs[] = array( "DIV" => "step18", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB18" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB18" ) );
        $arTabs[] = array( "DIV" => "step21", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB21" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB21" ) );
        $arTabs[] = array( "DIV" => "step22", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB22" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB22" ) );
        $arTabs[] = array( "DIV" => "step26", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB26" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB26" ) );
        $arTabs[] = array( "DIV" => "step27", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB27" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB27" ) );
        $arTabs[] = array( "DIV" => "step28", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB28" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB28" ) );
        $arTabs[] = array( "DIV" => "step30", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB30" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB30" ) );

        $arTabs[] = array( "DIV" => "step1", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB1" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB1" ) );
        $arTabs[] = array( "DIV" => "step4", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB4" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB4" ) );
        $arTabs[] = array( "DIV" => "step5", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB5" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB5" ) );

        if( CModule::IncludeModule( "catalog" ) ){
            $arTabs[] = array( "DIV" => "step7", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB7" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB7" ) );
        }

        $arTabs[] = array( "DIV" => "step6", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB6" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB6" ) );

        $arTabs[] = array( "DIV" => "step12", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB12" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB12" ) );
        $arTabs[] = array( "DIV" => "step13", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB13" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB13" ) );
        $arTabs[] = array( "DIV" => "step10", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB10" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB10" ) );

        $arTabs[] = array( "DIV" => "step23", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB23" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB23" ) );
        $arTabs[] = array( "DIV" => "step24", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB24" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB24" ) );
        $arTabs[] = array( "DIV" => "step25", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB25" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB25" ) );
        $arTabs[] = array( "DIV" => "step29", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB29" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB29" ) );
        $arTabs[] = array( "DIV" => "step31", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB31" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB31" ) );

        $arTabs[] = array( "DIV" => "step9", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB9" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB9" ) );
        $arTabs[] = array( "DIV" => "step15", "TAB" => GetMessage( "DATA_EXPORTPROPLUS_TAB15" ), "ICON" => "main_user_edit", "TITLE" => GetMessage( "DATA_EXPORTPROPLUS_TAB15" ) );


        $tabControl = new CAdminTabControl( "tabControl", $arTabs );

        if( $lastException ){
            CAdminMessage::ShowMessage(
                array(
                    "MESSAGE" => $lastException,
                    "HTML" => "TRUE",
                )
            );
        }

        require __DIR__."/auto_tests.php";

        $moduleStatus = CModule::IncludeModuleEx( $moduleId );


        $bHasModuleUpdates = CExportproplusInformer::GetModuleUpdatesInfo();

        if( !$bHasModuleUpdates ){
            echo BeginNote();
            echo GetMessage( "DATA_EXPORTPROPLUS_NO_UPDATES" );
            echo EndNote();
        }
        else{
            echo BeginNote();
            echo GetMessage( "DATA_EXPORTPROPLUS_NEW_UPDATES" );
            echo EndNote();
        }


        ?>
        <?if( $arProfile["TYPE"] == "vk_trade" ){
            $obVkModel = new CDataExportproplusVkModel( $arProfile );
            $groupAccountData = $obVkModel->GetAccountInfoData();
            if( is_array( $groupAccountData["error"] ) && !empty( $groupAccountData["error"] ) ){?>
                <?=BeginNote();?>
                <?=GetMessage( "DATA_EXPORTPROPLUS_OP_UA_VK_ERROR_TITLE" ).$groupAccountData["error"]["error_code"].GetMessage( "DATA_EXPORTPROPLUS_OP_UA_VK_ERROR_MSG" ).$groupAccountData["error"]["error_msg"];?>
                <?=EndNote();?>
            <?}
        }?>

        <div style="clear: both;"></div>

        <form method="POST" action="" ENCTYPE="multipart/form-data" id="exportproplus_form" name="exportproplus_form">
        <?// check session id?>
            <?=bitrix_sessid_post();?>
            <?// show bookmark headers
            $tabControl->Begin();?>
            <div id="waitContainer" style="position: fixed; float: right; width: 100%; right: 0;"></div>
            <?foreach( $arTabs as $tab ){
                $tabControl->BeginNextTab();
                require( __DIR__."/tabs/{$tab["DIV"]}.php" );
            }

            // end of form - show save buttons
            $tabControl->Buttons(
                array(
                    "disabled" => ( ( $POST_RIGHT < "W" ) || file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/".$moduleId."/export_{$arProfile["ID"]}_run.unlock" ) ),
                    "back_url" => "data_exportproplus_list.php?lang=".LANG,
                )
            );

            // end of bookmark interface
            $tabControl->End();
            $tabControl->ShowWarnings( "exportproplus_form", $message );
            ?>
        </form>

        <form target="_blank" name="fticket" action="<?=GetMessage( "A_SUPPORT_URL" );?>" method="POST">
            <input type="hidden" name="send_ticket" value="Y">
            <input type="hidden" name="ticket_title" value="<?=GetMessage( "SC_RUS_L1" )." ".htmlspecialcharsbx( CDataExportproplusTools::GetHttpHost() );?>">
            <input type="hidden" name="ticket_text" value="Y">
            <input type="hidden" name="ticket_log" value="Y">
        </form>
        <script>
            function ShowMarketCategoryList( categoryId, listContainer ){
                MarketCategoryItem = categoryId;
                listContainer = typeof listContainer == 'undefined' ? 'market_category_list' : listContainer;
                if( typeof MarketCategoryObject == 'undefined' ){
                    MarketCategoryObject = new BX.PopupWindow( 'my_answer', null, {
                        content: BX( listContainer ),
                        closeIcon: { right: '20px', top: '20px' },
                        titleBar: { content: BX.create( 'div', { html: '<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_POPUP_TITLE" );?>', 'props': { 'className': 'access-title-bar' } } ) },
                        zIndex: 0,
                        offsetLeft: 0,
                        offsetTop: 0,
                        draggable: { restrict: false },
                        buttons: [
                        ],
                    });
                }
                MarketCategoryObject.show();
            }

            function ShowFieldsList( containerPrefix, fieldId, compositeId, selectedFieldId ){
                FieldsListItem = fieldId;

                listContainer = containerPrefix + fieldId + ( ( compositeId != false ) ? '-' + compositeId : '' ) + '-list';

                if( typeof FieldsListObject != 'undefined' ){
                    BX.remove( FieldsListObject );
                }

                var selectBlockHtml = $( '#select_fields' ).html();
                var selectBlockHtmlEx = $.parseHTML( selectBlockHtml );

                if( selectedFieldId.length > 0 ){
                    $( 'option', selectBlockHtmlEx ).each( function(){
                        if( $( this ).val() == selectedFieldId ){
                            $( this ).addClass( 'tagselected' );
                        }
                    });
                }
                $( '#' + listContainer + ' select' ).html( selectBlockHtmlEx );

                FieldsListObject = new BX.PopupWindow( 'select_field' + containerPrefix + fieldId + ( ( compositeId != false ) ? compositeId : '' ), null, {
                    content: BX( listContainer ),
                    closeIcon: { right: '20px', top: '20px' },
                    titleBar: { content: BX.create( 'div', { html: '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDS_LIST_POPUP_TITLE" );?>', 'props': { 'className': 'access-title-bar' } } ) },
                    zIndex: 0,
                    offsetLeft: 0,
                    offsetTop: 0,
                    draggable: { restrict: false },
                    buttons: [
                    ],
                });

                FieldsListObject.show();
								
								$('#'+listContainer+' input').trigger('keyup');
            }

            function ShowPropertyList( obj ){
                PropertyListItem = $( obj ).attr( 'name' );
                PropertyListItemValue = $( obj ).attr( 'data-value' );
                $( '#property_list select' ).val( $( 'input[name="' + PropertyListItemValue + '"]' ).val() );
                if( typeof PropertyListObject == 'undefined' ){
                    PropertyListObject = new BX.PopupWindow( 'property_list_answer', null, {
                        content: BX( 'property_list' ),
                        closeIcon: { right: '20px', top: '10px' },
                        titleBar: { content: BX.create( 'span', { html: '<?=GetMessage( "DATA_EXPORTPROPLUS_VARIANT_CATEGORY_POPUP_TITLE" );?>', 'props': { 'className': 'access-title-bar' } } ) },
                        zIndex: 0,
                        offsetLeft: 0,
                        offsetTop: 0,
                        draggable: { restrict: false },
                    });
                }
                PropertyListObject.show();
            }
            $( function(){
                <?
                    switch( $arProfile["TYPE"] ){
                        case "activizm":
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "ebay_1":
                        case "ebay_2":
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "ozon":
                        case "ozon_api":
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "ua_hotline_ua":
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "google":
                        case "google_online":
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "tiu_standart":
                        case "tiu_standart_vendormodel":
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "mailru":
                        case "mailru_clothing":
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "vk_trade":
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay' ).remove();";
                            break;
                        case "fb_trade":
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "fb_ads":
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "ok_trade":
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        case "instagram_trade":
                            echo "$( '#tab_cont_step6' ).hide();";
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                        default:
                            echo "$( '#tab_cont_step10' ).hide();";
                            echo "$( '#tab_cont_step12' ).hide();";
                            echo "$( '#tab_cont_step13' ).hide();";
                            echo "$( '#tab_cont_step16' ).hide();";
                            echo "$( '#tab_cont_step17' ).hide();";
                            echo "$( '#tab_cont_step18' ).hide();";
                            echo "$( '#tab_cont_step21' ).hide();";
                            echo "$( '#tab_cont_step22' ).hide();";
                            echo "$( '#tab_cont_step23' ).hide();";
                            echo "$( '#tab_cont_step24' ).hide();";
                            echo "$( '#tab_cont_step25' ).hide();";
                            echo "$( '#tab_cont_step26' ).hide();";
                            echo "$( '#tab_cont_step27' ).hide();";
                            echo "$( '#tab_cont_step28' ).hide();";
                            echo "$( '#tab_cont_step29' ).hide();";
                            echo "$( '#tab_cont_step30' ).hide();";
                            echo "$( '#tab_cont_step31' ).hide();";
                            echo "$( '#market_category_data_ozon, #market_category_data_ebay, #market_category_data_vk, #market_market_albums_vk, market_albums_vk' ).remove();";
                            break;
                    }
                ?>
            });
        </script>
    <?}
?>

<?require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php" );?>