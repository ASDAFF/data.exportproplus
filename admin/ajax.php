<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

include( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php" );
if( !check_bitrix_sessid() ) die();

IncludeModuleLangFile( __FILE__ );

\Bitrix\Main\Loader::includeModule( "data.exportproplus" );
\Bitrix\Main\Loader::includeModule( "iblock" );
\Bitrix\Main\Loader::includeModule( "catalog" );

$ajax_action();

function run_express_agent(){
    global $APPLICATION, $profileID;
    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileID );

    if( CDataExportproplusTools::ArrayValidate( $arProfile["SETUP"]["CRON"] ) ){
        end( $arProfile["SETUP"]["CRON"] );
        $cronSetupId = key( $arProfile["SETUP"]["CRON"] ) + 1;

        CExportproplusAgent::AddAgent( $arProfile["ID"], $cronSetupId, true );
    }

    $APPLICATION->RestartBuffer();

    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
        )
    );
    die();
}

function SetCronAgentOptions(){
    global $APPLICATION;

    COption::SetOptionString( "main", "agents_use_crontab", "N" );
    COption::SetOptionString( "main", "check_agents", "N" );

    $APPLICATION->RestartBuffer();

    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
        )
    );
    die();
}

function UpdateBitrixCloudMonitoring(){
    global $APPLICATION, $add_email;

    $result = CExportproplusInformer::UpdateBitrixCloudMonitoring( $add_email );

    $APPLICATION->RestartBuffer();

    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
        )
    );
    die();
}

function UpdateMarketCategories(){
    global $APPLICATION;

    $result = CDataExportproplusMarketCategories::Process();

    $APPLICATION->RestartBuffer();

    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
        )
    );
    die();
}

function unlock_export(){
    global $APPLICATION, $profileID;
    if( file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/data.exportproplus/export_{$profileID}_run.lock" ) ){
        require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
        unlink( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/data.exportproplus/export_{$profileID}_run.lock" );
        file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/data.exportproplus/export_{$profileID}_run.unlock", "" );

        ob_start();
        echo '<td colspan="2" align="center">';
        CAdminMessage::ShowMessage(
            array(
                "MESSAGE" => GetMessage( "DATA_EXPORTPROPLUS_EXPORT_UNLOCK" ),
                "TYPE"    => "OK",
                "HTML"    => "TRUE"
            )
        );
        echo "</td>";
        $data = ob_get_clean();

        $APPLICATION->RestartBuffer();

        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "ok",
                "blocks" => array(
                    array(
                        "id"   => "#unlock-container",
                        "html" => $data
                    ),
                )
            ) );
    }
    die();
}

function unlock_export_express(){
    global $APPLICATION, $profileID;

    if( file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/data.exportproplus/export_{$profileID}_run.lock" ) ){
        require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
        unlink( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/data.exportproplus/export_{$profileID}_run.lock" );
        file_put_contents( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/data.exportproplus/export_{$profileID}_run.unlock", "" );

        $APPLICATION->RestartBuffer();

        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "ok",
                "data"   => $data
            )
        );
    }
    die();
}

function clear_export_data(){
    global $APPLICATION, $profileID;

    CDataExportproplusTools::ClearExportSession( $profileID );

    require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
    $APPLICATION->RestartBuffer();

    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function update_log(){
    global $APPLICATION, $profileID;
    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileID );

    ob_start();?>
    <td colspan="2" align="center">
        <table width="30%" border="1">
            <tbody>
            <tr>
                <td colspan="2" align="center"><b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL" )?></b></td>
            </tr>
            <tr>
                <td width="50%"><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL_IB" )?></td>
                <td width="50%"><?=$arProfile["LOG"]["IBLOCK"]?></td>
            </tr>
            <tr>
                <td width="50%"><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL_SECTION" )?></td>
                <td width="50%"><?=$arProfile["LOG"]["SECTIONS"]?></td>
            </tr>
            <tr>
                <td width="50%"><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL_OFFERS" )?></td>
                <td width="50%"><?=$arProfile["LOG"]["PRODUCTS"]?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_EXPORT" )?></b></td>
            </tr>
            <tr>
                <td width="50%"><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_OFFERS_EXPORT" )?></td>
                <td width="50%"><?=$arProfile["LOG"]["PRODUCTS_EXPORT"]?></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ERROR" )?></b></td>
            </tr>
            <tr>
                <td width="50%"><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ERR_OFFERS" )?></td>
                <td width="50%"><?=$arProfile["LOG"]["PRODUCTS_ERROR"]?></td>
            </tr>
            </tbody>
        </table>
    </td>
    <?$data1 = ob_get_clean();

    ob_start();
    if( file_exists( $_SERVER["DOCUMENT_ROOT"].$arProfile["LOG"]["FILE"] ) ){?>
        <td width="50%" class="adm-detail-content-cell-l" style="padding: 15px 0;">
            <b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_FILE" )?></b>
        </td>
        <td width="50%" class="adm-detail-content-cell-r">
            <a href="<?=$arProfile["LOG"]["FILE"]?>" download="export_log"><?=$arProfile["LOG"]["FILE"]?></a>
        </td>
    <?}
    $data2 = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => array(
                array(
                    "id"   => "#log_detail",
                    "html" => $data1
                ),
                array(
                    "id"   => "#log_detail_file",
                    "html" => $data2
                ),
            )
        )
    );
    die();
}

function get_condition_block(){
    global $fId, $fCnt, $PROFILE, $APPLICATION;

    $obProfileUtils = new CExportproplusProfile();
    $obCond = new CDataExportproplusCatalogCond();

    CDataExportproplusProps::$arIBlockFilter = $obProfileUtils->PrepareIBlock( $PROFILE["IBLOCK_ID"], $PROFILE["USE_SKU"] );
    $boolCond = $obCond->Init(
        0,
        0,
        array(
            "FORM_NAME" => "exportproplus_form",
            "CONT_ID"   => "PROFILE_XMLDATA_".$fId."_CONDITION",
            "JS_NAME"   => "JSCatCond_field_".$fCnt,
            "PREFIX"    => "PROFILE[XMLDATA][".$fId."][CONDITION]"
        )
    );

    ob_start();
    $obCond->Show( $field["CONDITION"] );
    $data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => array(
                array(
                    "id"   => "#PROFILE_XMLDATA_".$fId."_CONDITION",
                    "html" => $data
                ),
            )
        )
    );
    die();
}

function fieldset_field_select(){
    global $PROFILE, $APPLICATION, $marketId, $data_id, $action_holder;

    $obProfileUtils = new CExportproplusProfile();

    $options = $obProfileUtils->createFieldset2( $PROFILE["IBLOCK_ID"], true );
    $opt = $obProfileUtils->selectFieldset2( $options, "" );

    $nodeId = ( strlen( $action_holder ) > 0 ) ? 'select[name="PROFILE[XMLDATA]['.$data_id.']['.$action_holder.']"]' : 'select[name="PROFILE[XMLDATA]['.$data_id.'][VALUE]"]';

    ob_start();
    echo implode( "\n", $opt );
    unset( $opt );
    $data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => array(
                array(
                    "id"   => $nodeId,
                    "html" => $data
                ),
            )
        )
    );
    die();
}

function fieldset_field_resolve(){
    global $PROFILE, $APPLICATION, $marketId, $data_id, $data_value, $action_holder;
    \Bitrix\Main\Loader::includeModule( "iblock" );
    preg_match_all( "/.*?PROPERTY-(\d+)/", $data_value, $filterProps );

    if( is_numeric( $filterProps[1][0] ) ){
        $id = intval( $filterProps[1][0] );
        $iblock_id = intval( $PROFILE["IBLOCK_ID"][0] );
        $dbRes = CIBlockProperty::GetByID( $id, $iblock_id );
        $arProps = $dbRes->GetNext();
    }

    $obProfileUtils = new CExportproplusProfile();
    $options = $obProfileUtils->createFieldsetResolve( $arProps );

    if( $options === false ){
        $APPLICATION->RestartBuffer();
        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "null",
            )
        );
        die();
    }
    $opt = $obProfileUtils->selectFieldset2( $options, "" );

    $nodeId = 'select[name="PROFILE[XMLDATA]['.$data_id.'][RESOLVE]"]';

    ob_start();
    echo implode( "\n", $opt );
    unset( $opt );
    $data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => array(
                array(
                    "id"   => $nodeId,
                    "html" => $data
                ),
            )
        )
    );
    die();
}

function change_market_category(){
    global $PROFILE, $APPLICATION, $marketId;
    $obMarketCategory = new CExportproplusMarketDB();
    $marketCategoryList = $obMarketCategory->GetList();
    $marketCategoryListLastItem = end( $marketCategoryList );

    $marketCategoryId = $marketId;
    $marketCategory = $obMarketCategory->GetByID( $marketCategoryId );

    $marketCategory = explode( PHP_EOL, $marketCategory["data"] );

    if( $marketId > $marketCategoryListLastItem["id"] ){
        if( ( $marketId - $marketCategoryListLastItem["id"] ) === 1 ){
            $obMarketCategory = new CExportproplusMarketTiuDB();
            $marketCategory = $obMarketCategory->GetList();
        }

        if( ( $marketId - $marketCategoryListLastItem["id"] ) === 2 ){
            $obMarketCategory = new CExportproplusMarketPromuaDB();
            $marketCategory = $obMarketCategory->GetList();
        }
    }

    CUtil::InitJSCore( array( "ajax", "jquery" ) );

    $obProfileUtils = new CExportproplusProfile();
    $categories = $obProfileUtils->GetSections( $PROFILE["IBLOCK_ID"], true );
    $categoriesNew = array();
    foreach( $categories as $depth ){
        $categoriesNew = array_merge( $categoriesNew, $depth );
    }

    $categories = $categoriesNew;
    unset( $categoriesNew );
    asort( $categories );

    ob_start();?>
    <table width="100%">
        <?foreach( $categories as $cat ){
            if( $PROFILE["CHECK_INCLUDE"] == "Y" ){
                if( !in_array( $cat["ID"], $PROFILE["CATEGORY"] ) )
                    continue;
            }
            else{
                if( !in_array( $cat["PARENT_1"], $PROFILE["CATEGORY"] ) )
                    continue;
            }?>
            <tr>
                <td width="40%">
                    <label form="PROFILE[MARKET_CATEGORY][CATEGORY_LIST][<?=$cat["ID"]?>]"><?=$cat["NAME"]?></label>
                </td>
                <td>
                    <input type="text" value="" name="PROFILE[MARKET_CATEGORY][CATEGORY_LIST][<?=$cat["ID"]?>]"/>
                    <span class="field-edit" onclick="ShowMarketCategoryList( <?=$cat["ID"]?> )" style="cursor: pointer; background: #9ec710 !important;" title="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_SELECT_SECTION" );?>"></span>
                </td>
            </tr>
        <?}?>
    </table>
    <?$data = ob_get_clean();

    ob_start();?>
    <input onkeyup="FilterMarketCategoryList( this, 'market_category_list' )">
    <select onclick="SetMarketCategory( this.value )" size="25">
        <option></option>
        <?foreach( $marketCategory as $marketCat ){?>
            <option data-search="<?=( ( $marketId > $marketCategoryListLastItem["id"] ) ? strtolower( $marketCat["NAME"] ) : strtolower( $marketCat ) );?>"><?=( ( $marketId > $marketCategoryListLastItem["id"] ) ? $marketCat["NAME"] : $marketCat )?></option>
        <?}?>
    </select>
    <?$data1 = ob_get_clean();

    $APPLICATION->RestartBuffer();

    $return = array(
        "result" => "ok",
        "special" => "false",
        "blocks" => array(
            array(
                "id"   => "#market_category_data",
                "html" => $data
            ),
            array(
                "id"   => "#market_category_list",
                "html" => $data1
            ),
        )
    );

    if( $marketId > $marketCategoryListLastItem["id"] ){
        $return["special"] = "true";
    }

    echo Bitrix\Main\Web\Json::encode( $return );
    die();
}

function market_save(){
    global $APPLICATION, $PROFILE, $marketId, $marketData, $marketName, $current, $DB;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $obMarketCategory = new CExportproplusMarketDB();
    $marketCategoryList = $obMarketCategory->GetList();
    $marketCategoryListLastItem = end( $marketCategoryList );

    if( !$marketId || ( $marketId <= $marketCategoryListLastItem["id"] ) ){
        if( strtoupper( SITE_CHARSET ) == "WINDOWS-1251" ){
            $marketData = mb_convert_encoding( $marketData, "cp1251", "utf8" );
            $marketName = mb_convert_encoding( $marketName, "cp1251", "utf8" );
        }

        $arFields = array(
            "name" => $marketName,
            "data" => $marketData
        );

        if( $marketId )
            $boolRes = $obMarketCategory->Update( $marketId, $arFields );
        else
            $boolRes = $obMarketCategory->Add( $arFields );

        if( $boolRes )
            $boolRes = "ok";

        $marketCategory = $obMarketCategory->GetList();

        ob_start();?>
        <select name="PROFILE[MARKET_CATEGORY][CATEGORY]" onchange="ChangeMarketCategory( this.value )">
            <?foreach( $marketCategory as $cat ){?>
                <?$selected = $cat["id"] == $current ? 'selected="selected"' : ""?>
                <option value="<?=$cat["id"]?>" <?=$selected?>><?=$cat["name"]?></option>
            <?}?>
        </select>
        <?$data = ob_get_clean();

        $APPLICATION->RestartBuffer();
        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "ok",
                "blocks" => array(
                    array(
                        "id"   => "#market_category_select",
                        "html" => $data
                    ),
                )
            )
        );
    }
    die();
}

function market_edit(){
    global $APPLICATION, $PROFILE, $marketId;
    $obMarketCategory = new CExportproplusMarketDB();
    $marketCategoryList = $obMarketCategory->GetList();
    $marketCategoryListLastItem = end( $marketCategoryList );

    if( $marketId <= $marketCategoryListLastItem["id"] ){
        \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

        $marketCategory = $obMarketCategory->GetByID( $marketId );
        $APPLICATION->RestartBuffer();
        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "ok",
                "id"     => $marketCategory["id"],
                "name"   => $marketCategory["name"],
                "data"   => $marketCategory["data"],
            )
        );
    }
    else{
        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "false",
            )
        );
    }
    die();
}

function market_delete(){
    global $APPLICATION, $PROFILE, $marketId;
    $obMarketCategory = new CExportproplusMarketDB();
    $marketCategoryList = $obMarketCategory->GetList();

    $marketCategoryListLastItem = end( $marketCategoryList );

    if( $marketId <= $marketCategoryListLastItem["id"] ){
        \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

        $marketCategoryChange = $obMarketCategory->GetByID( $marketId - 1 );
        $marketCategoryDelete = $obMarketCategory->Delete( $marketId );
        $APPLICATION->RestartBuffer();
        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "ok",
                "id"     => $marketCategoryChange["id"],
                "name"   => $marketCategoryChange["name"],
                "data"   => $marketCategoryChange["data"],
            )
        );
    }
    else{
        echo Bitrix\Main\Web\Json::encode(
            array(
                "result" => "false",
            )
        );
    }
    die();
}

function calcSteps(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $elementsObj = new CDataExportproplusElement( $arProfile );
    $oneProductTime = $elementsObj->CalcProcessXMLLoadingByOneProduct();
    if( $oneProductTime ){
        $maxExecutionTime = ini_get( "max_execution_time" );

        $productPerStep = $maxExecutionTime / $oneProductTime;

        $productPerStepRecomendation = round( $productPerStep - $productPerStep * 0.3 );
    }
    else{
        $productPerStepRecomendation = 50;
    }
    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $productPerStepRecomendation,
        )
    );
    die();
}

function calcThreads(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );

    $elementsObj = new CDataExportproplusElement( $arProfile );
    $oneProductTime = $elementsObj->CalcProcessXMLLoadingByOneProduct();

    if( $oneProductTime ){
        $maxExecutionTime = ini_get( "max_execution_time" );
        $productPerStep = $maxExecutionTime / $oneProductTime;

        if( intval( $arProfile["SETUP"]["EXPORT_STEP"] ) > 0 ){
            $productPerStepRecomendation = intval( $arProfile["SETUP"]["EXPORT_STEP"] );
        }
        else{
            $productPerStepRecomendation = round( $productPerStep - $productPerStep * 0.3 );
        }

        $productThread = $maxExecutionTime / ( $oneProductTime * ( ( $productPerStepRecomendation ) ? $productPerStepRecomendation : 50 ) );
        $threadsRecomendation = round( $productThread - $productThread * 0.5 );
    }
    else{
        $threadsRecomendation = 1;
    }

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $threadsRecomendation,
        )
    );
    die();
}

function sendVkCaptcha(){
    global $APPLICATION, $profileId, $vkCaptchaWord, $vkCaptchaSessid;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );

    $obVkModel = new CDataExportproplusVkModel( $arProfile );

    $arAccountInfoDataParams = array();
    $arAccountInfoDataParams["captcha_key"] = $vkCaptchaWord;
    $arAccountInfoDataParams["captcha_sid"] = $vkCaptchaSessid;

    $groupAccountData = $obVkModel->GetAccountInfoData( $arAccountInfoDataParams );

    $bNeedCaptcha = true;
    if( !isset( $groupAccountData["error"] ) ){
        $bNeedCaptcha = false;
    }

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => (  $bNeedCaptcha ) ? false : true,
        )
    );
    die();
}

function vkDeleteSyncProducts(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obVkTools = new CDataExportproplusVkTools( $arProfile );

    $obVkTools->DeleteSyncProducts();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function vkDeleteAllProducts(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obVkTools = new CDataExportproplusVkTools( $arProfile );

    $obVkTools->DeleteAllProducts();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function vkDeleteSyncProductAlbums(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obVkTools = new CDataExportproplusVkTools( $arProfile );

    $obVkTools->DeleteSyncProductAlbums();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function vkDeleteAllProductAlbums(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obVkTools = new CDataExportproplusVkTools( $arProfile );

    $obVkTools->DeleteAllProductAlbums();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function vkDeleteSyncAlbums(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obVkTools = new CDataExportproplusVkTools( $arProfile );

    $obVkTools->DeleteSyncAlbums();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function vkDeleteAllAlbums(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obVkTools = new CDataExportproplusVkTools( $arProfile );

    $obVkTools->DeleteAllAlbums();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function vkResetSyncSettings(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );

    $arProfile["VK"]["VK_NEW_RELATIONS"] = null;
    $arProfile["VK"]["VK_RELATIONS"] = null;
    $dbProfile->Update( $arProfile["ID"], $arProfile );

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okResetSyncSettings(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );

    $arProfile["OK"]["OK_RELATIONS"] = null;
    $dbProfile->Update( $arProfile["ID"], $arProfile );

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteSyncMediatopics(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteSyncMediatopics();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteAllMediatopics(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteAllMediatopics();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteSyncAlbums(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteSyncAlbums();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteAllAlbums(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteAllAlbums();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteSyncCatalogs(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteSyncCatalogs();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteAllCatalogs(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteAllCatalogs();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteSyncMarketItems(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteSyncMarketItems();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function okDeleteAllMarketItems(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obOkTools = new CDataExportproplusOkTools( $arProfile );

    $obOkTools->DeleteAllMarketItems();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function AutofillSettingsSet(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obProfileUtils = new CExportproplusProfile();
    $arProfile = $obProfileUtils->SetAutofillStructure( $arProfile );

    $dbProfile->Update( $arProfile["ID"], $arProfile );

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function AutofillSettingsReset(){
    global $APPLICATION, $profileId;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $dbProfile = new CExportproplusProfileDB();
    $arProfile = $dbProfile->GetById( $profileId );
    $obProfileUtils = new CExportproplusProfile();
    $arProfile = $obProfileUtils->ClearAutofillStructure( $arProfile );
    if( isset( $arProfile["IBLOCK_AUTOFILL_PROPS"]["TMP"] ) ){
        unset( $arProfile["IBLOCK_AUTOFILL_PROPS"]["TMP"] );
    }

    $dbProfile->Update( $arProfile["ID"], $arProfile );

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => true,
        )
    );
    die();
}

function setFbLoginUrl(){
    global $APPLICATION, $appId, $appSecret;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $appId = trim( $appId );
    $appSecret = trim( $appSecret );

    $fb = new Facebook\Facebook([
        "app_id"  => $appId,
        "app_secret" => $appSecret,
        "default_graph_version" => "v2.8",
    ]);

    $helper = $fb->getRedirectLoginHelper();

    try{
        $accessToken = $helper->getAccessToken();
    }
    catch( Facebook\Exceptions\FacebookResponseException $e ){
        // When Graph returns an error
        echo "Graph returned an error: ".$e->getMessage();
        exit;
    }
    catch( Facebook\Exceptions\FacebookSDKException $e ){
        // When validation fails or other local issues
        echo "Facebook SDK returned an error: ".$e->getMessage();
        exit;
    }           

    if( !isset( $accessToken ) ){
        if( $helper->getError() ){
            header( "HTTP/1.0 401 Unauthorized" );
            echo "Error: ".$helper->getError()."<br/>\n";
            echo "Error Code: ".$helper->getErrorCode()."<br/>\n";
            echo "Error Reason: ".$helper->getErrorReason()."<br/>\n";
            echo "Error Description: ".$helper->getErrorDescription()."<br/>\n";
        }
        else{
            header( "HTTP/1.0 400 Bad Request" );
            echo "Bad request";
        }
        exit;
    }?>
    <script type="text/javascript">
        if( window.opener ){
            if( window.opener.SetFbAccessToken( '<?=$accessToken->getValue()?>' ) ){
                window.close();
            }
        }
    </script>
<?}

function getFbLogin(){
    global $APPLICATION, $appId, $appSecret, $callback, $scope;

    \Bitrix\Main\Loader::includeModule( "data.exportproplus" );

    $appId = trim( $appId );
    $appSecret = trim( $appSecret );

    $scope = trim( $scope );
    $scope = explode( ",", $scope );

    $callback =  ( ( CMain::IsHTTPS() ) ? "https" : "http" )."://".$_SERVER["SERVER_NAME"].$callback."&appId=".$appId."&appSecret=".$appSecret."&".bitrix_sessid_get();

    $fb = new Facebook\Facebook([
        "app_id"  => $appId,
        "app_secret" => $appSecret,
        "default_graph_version" => "v2.8",
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $loginUrl = $helper->getLoginUrl( $callback, $scope );

    LocalRedirect( $loginUrl );
}

function fieldset_add(){
    global $APPLICATION, $PROFILE, $id;
    $id++;
    $useCondition = "";
    $hideCondition = "hide";
    $hideConstBlock = "hide";

    $obProfileUtils = new CExportproplusProfile();
    $options = $obProfileUtils->createFieldset2( $PROFILE["IBLOCK_ID"], true );
    $arLinearFieldsList = $obProfileUtils->createLinearFieldset( $options );

    $arFieldType = array(
        "none"    => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field"   => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const"   => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
        "complex" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPLEX" ),
        "composite" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPOSITE" ),
        "arithmetics" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS" ),
        "stack" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_STACK" ),
    );

    $arFieldTypeComplex = array(
        "none"  => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    ob_start();?>

    <tr class="fieldset-item" data-id="<?=$id?>">
        <td>
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][PROCESS_LOGIC]" checked="checked" value="Y"/>
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]" checked="checked" value="Y">
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY_FORCE]" checked="checked" value="Y">
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY_ROWFORCE]" checked="checked" value="Y">
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]" checked="checked" value="Y">
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]" checked="checked" value="Y">
            <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][SKIP_UNTERM_ELEMENT]" checked="checked" value="Y">

            <label for="PROFILE[XMLDATA][<?=$id?>]"></label>
            <input type="text" name="PROFILE[XMLDATA][<?=$id?>][NAME]" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_NAME_DESCR" )?>"/>
        </td>
        <td colspan="2">
            <input type="text" name="PROFILE[XMLDATA][<?=$id?>][CODE]" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_NAME" )?>"/>
            <select name="PROFILE[XMLDATA][<?=$id?>][TYPE]" onchange="ShowConvalueBlock( this )" data-id="<?=$id?>">
                <?foreach( $arFieldType as $typeId => $typeName ){?>
                    <?$selected = $typeId == $field["TYPE"] ? 'selected="selected"' : "";?>
                    <option value="<?=$typeId?>" <?=$selected?>><?=$typeName?></option>
                <?}?>
            </select>

            <input name="PROFILE[XMLDATA][<?=$id?>][VALUE]" data-id="<?=$id?>" type="hidden" value="<?=$field["VALUE"]?>" />
            <input class="field-block" readonly="readonly" name="PROFILE[XMLDATA][<?=$id?>][VALUE_SHOW]" data-id="<?=$id?>" type="text" title="<?=$arLinearFieldsList[$field["VALUE"]];?>" value="<?=( isset( $arLinearFieldsList[$field["VALUE"]] ) ? $arLinearFieldsList[$field["VALUE"]] : GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ) );?>" />
            <span class="field-edit fieldselecter" onclick="ShowFieldsList( 'field-block-', '<?=$id?>', false, '<?=$field["VALUE"]?>' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-<?=$id?>-list" class="fields-popup-list" style="display: none;">
                <input onkeyup="FilterFieldsList( this, 'field-block-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>" value="<?=( isset( $arLinearFieldsList[$field["VALUE"]] ) ? $arLinearFieldsList[$field["VALUE"]] : "" )?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'VALUE', false, false )" size="25">
                </select>
            </div>

            <div class="const-block hide">
                <?$hideContvalueFalse = !$useCondition ? "hide" : "";?>
                <?$showPlaceholder = !$hideContvalueFalse ? "placeholder" : "data-placeholder";?>
                <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_TRUE]" <?=$showPlaceholder?>=
                "<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>"
                ><?=$field["CONTVALUE_TRUE"]?></textarea>
                <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_FALSE]" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" class="<?=$hideContvalueFalse?>"><?=$field["CONTVALUE_FALSE"]?></textarea>
            </div>
            <div class="complex-block-container hide">
                <div class="complex-block">
                    <?$hideComplexFalse = !$useCondition ? "hide" : "";?>
                    <?$showPlaceholder = !$hideComplexFalse ? "placeholder" : "data-placeholder";?>

                    <div>
                        <select name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_TYPE]" onchange="ShowConvalueBlockComplex( this )" data-id="<?=$id?>">
                            <?foreach( $arFieldTypeComplex as $typeComplexId => $typeNameComplex ){?>
                                <?$selectedComplex = $typeComplexId == $field["COMPLEX_TRUE_TYPE"] ? 'selected="selected"' : "";?>
                                <option value="<?=$typeComplexId?>" <?=$selectedComplex?>><?=$typeNameComplex?></option>
                            <?}?>
                        </select>
                        <select class="field-block-complex hide" name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_VALUE]">
                            <option value="">--<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" )?>--</option>
                            <?if( $field["COMPLEX_TRUE_TYPE"] == "field" ){
                                $opt = $obProfileUtils->selectFieldset2( $options, $field["COMPLEX_TRUE_VALUE"] );
                                echo implode( "\n", $opt );
                                unset( $opt );
                            }?>
                        </select>

                        <div class="const-block-complex hide">
                            <textarea name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_CONTVALUE]" <?=$showPlaceholder?>
                            ="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>"
                            ><?=$field["COMPLEX_TRUE_CONTVALUE"]?></textarea>
                        </div>
                    </div>
                    <div class="hide">
                        <select name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_TYPE]" onchange="ShowConvalueBlockComplexFalse( this )" data-id="<?=$id?>">
                            <?foreach( $arFieldTypeComplex as $typeComplexId => $typeNameComplex ){?>
                                <?$selectedComplex = $typeComplexId == $field["COMPLEX_FALSE_TYPE"] ? 'selected="selected"' : "";?>
                                <option value="<?=$typeComplexId?>" <?=$selectedComplex?>><?=$typeNameComplex?></option>
                            <?}?>
                        </select>
                        <select class="field-block-complex-false hide" name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_VALUE]">
                            <option value="">--<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" )?>--</option>
                            <?if( $field["COMPLEX_FALSE_TYPE"] == "field" ){
                                $opt = $obProfileUtils->selectFieldset2( $options, $field["COMPLEX_FALSE_VALUE"] );
                                echo implode( "\n", $opt );
                                unset( $opt );
                            }?>
                        </select>

                        <div class="const-block-complex-false hide">
                            <textarea name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_CONTVALUE]" <?=$showPlaceholder?>
                            ="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>"
                            ><?=$field["COMPLEX_FALSE_CONTVALUE"]?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <span class="fieldset-item-delete">&times</span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr style="opacity: 0.2;">
        </td>
    </tr>

    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function composite_fieldset_add(){
    global $APPLICATION, $PROFILE, $id, $nodeType, $rowId;
    $id++;

    $obProfileUtils = new CExportproplusProfile();
    $options = $obProfileUtils->createFieldset2( $PROFILE["IBLOCK_ID"], true );
    $arBlockFieldsList = $obProfileUtils->createBlockFieldset( $options );

    $arFieldTypeComposite = array(
        "none" => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    ob_start();?>
    <?if( $nodeType == "truenode" ){?>
        <div class="composite-data-item" data-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
            <select name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_TRUE][<?=$id?>][COMPOSITE_TRUE_TYPE]" onchange="ShowConvalueBlockComposite( this )" data-id="<?=$rowId?>" style="width: 430px;">
                <?foreach( $arFieldTypeComposite as $typeCompositeId => $typeNameComposite ){?>
                    <?$selectedComposite = "";?>
                    <option value="<?=$typeCompositeId?>" <?=$selectedComposite?>><?=$typeNameComposite?></option>
                <?}?>
            </select>
            <span class="composite-data-item-delete">&times</span><br/>

            <input name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_TRUE][<?=$id?>][COMPOSITE_TRUE_VALUE]" data-id="<?=$rowId?>" type="hidden" value="" />
            <input class="field-block-composite hide" readonly="readonly" name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_TRUE][<?=$id?>][COMPOSITE_TRUE_VALUE_SHOW]" data-id="<?=$id?>" type="text" value="<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" );?>" />
            <span class="field-edit-composite fieldselecter hide" onclick="ShowFieldsList( 'field-block-composite-', '<?=$rowId?>', '<?=$id?>', '' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-composite-<?=$rowId?>-<?=$id?>-list" class="fields-popup-list" style="display: none">
                <input onkeyup="FilterFieldsList( this, 'field-block-composite-<?=$rowId?>-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'COMPOSITE_TRUE', '<?=$id?>', 'COMPOSITE_TRUE_VALUE' )" size="25">
                    <option></option>
                    <?foreach( $arBlockFieldsList as $blockFieldsGroupIndex => $blockFieldsGroup ){?>
                        <?if( is_array( current( $blockFieldsGroup ) ) ){
                            foreach( $blockFieldsGroup as $blockFieldsGroupDataIndex => $blockFieldsGroupData ){?>
                                <optgroup label="<?=$blockFieldsGroupData[0];?>">
                                    <?foreach( $blockFieldsGroupData[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                        <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                    <?}?>
                                </optgroup>
                            <?}
                        }
                        else{?>
                            <optgroup label="<?=$blockFieldsGroup[0];?>">
                                <?foreach( $blockFieldsGroup[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                    <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                </select>
            </div>

            <div class="const-block-composite hide">
                <textarea name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_TRUE][<?=$id?>][COMPOSITE_TRUE_CONTVALUE]" data-placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>" style="width: 420px;"></textarea>
            </div>
        </div>
    <?}
    elseif( $nodeType == "falsenode" ){?>
        <div class="composite-data-item" data-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
            <select name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_FALSE][<?=$id?>][COMPOSITE_FALSE_TYPE]" onchange="ShowConvalueBlockComposite( this )" data-id="<?=$rowId?>" style="width: 430px;">
                <?foreach( $arFieldTypeComposite as $typeCompositeId => $typeNameComposite ){?>
                    <?$selectedComposite = "";?>
                    <option value="<?=$typeCompositeId?>" <?=$selectedComposite?>><?=$typeNameComposite?></option>
                <?}?>
            </select>
            <span class="composite-data-item-delete">&times</span><br/>

            <input name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_FALSE][<?=$id?>][COMPOSITE_FALSE_VALUE]" data-id="<?=$rowId?>" type="hidden" value="" />
            <input class="field-block-composite hide" readonly="readonly" name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_FALSE][<?=$id?>][COMPOSITE_FALSE_VALUE_SHOW]" data-id="<?=$id?>" type="text" value="<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" );?>" />
            <span class="field-edit-composite fieldselecter hide" onclick="ShowFieldsList( 'field-block-composite-', '<?=$rowId?>', '<?=$id?>', '' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-composite-<?=$rowId?>-<?=$id?>-list" class="fields-popup-list" style="display: none">
                <input onkeyup="FilterFieldsList( this, 'field-block-composite-<?=$rowId?>-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'COMPOSITE_FALSE', '<?=$id?>', 'COMPOSITE_FALSE_VALUE' )" size="25">
                    <option></option>
                    <?foreach( $arBlockFieldsList as $blockFieldsGroupIndex => $blockFieldsGroup ){?>
                        <?if( is_array( current( $blockFieldsGroup ) ) ){
                            foreach( $blockFieldsGroup as $blockFieldsGroupDataIndex => $blockFieldsGroupData ){?>
                                <optgroup label="<?=$blockFieldsGroupData[0];?>">
                                    <?foreach( $blockFieldsGroupData[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                        <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                    <?}?>
                                </optgroup>
                            <?}
                        }
                        else{?>
                            <optgroup label="<?=$blockFieldsGroup[0];?>">
                                <?foreach( $blockFieldsGroup[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                    <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                </select>
            </div>

            <div class="const-block-composite hide">
                <textarea name="PROFILE[XMLDATA][<?=$rowId?>][COMPOSITE_FALSE][<?=$id?>][COMPOSITE_FALSE_CONTVALUE]" data-placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" style="width: 420px;"></textarea>
            </div>
        </div>
    <?}?>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function arithmetics_fieldset_add(){
    global $APPLICATION, $PROFILE, $id, $nodeType, $rowId;
    $id++;

    $obProfileUtils = new CExportproplusProfile();
    $options = $obProfileUtils->createFieldset2( $PROFILE["IBLOCK_ID"], true );
    $arBlockFieldsList = $obProfileUtils->createBlockFieldset( $options );

    $arFieldTypeArithmetics = array(
        "none" => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    ob_start();?>
    <?if( $nodeType == "truenode" ){?>
        <div class="arithmetics-data-item" data-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
            <label><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS_OP_HELP" )?>x<?=$id?></label><br/>

            <select name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_TRUE][<?=$id?>][ARITHMETICS_TRUE_TYPE]" onchange="ShowConvalueBlockArithmetics( this )" data-id="<?=$rowId?>" style="width: 430px;">
                <?foreach( $arFieldTypeArithmetics as $typeArithmeticsId => $typeNameArithmetics ){?>
                    <?$selectedArithmetics = "";?>
                    <option value="<?=$typeArithmeticsId?>" <?=$selectedArithmetics?>><?=$typeNameArithmetics?></option>
                <?}?>
            </select>
            <span class="arithmetics-data-item-delete">&times</span><br/>

            <input name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_TRUE][<?=$id?>][ARITHMETICS_TRUE_VALUE]" data-id="<?=$rowId?>" type="hidden" value="" />
            <input class="field-block-arithmetics hide" readonly="readonly" name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_TRUE][<?=$id?>][ARITHMETICS_TRUE_VALUE_SHOW]" data-id="<?=$id?>" type="text" value="<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" );?>" />
            <span class="field-edit-arithmetics fieldselecter hide" onclick="ShowFieldsList( 'field-block-arithmetics-', '<?=$rowId?>', '<?=$id?>', '' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-arithmetics-<?=$rowId?>-<?=$id?>-list" class="fields-popup-list" style="display: none">
                <input onkeyup="FilterFieldsList( this, 'field-block-arithmetics-<?=$rowId?>-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'ARITHMETICS_TRUE', '<?=$id?>', 'ARITHMETICS_TRUE_VALUE' )" size="25">
                    <option></option>
                    <?foreach( $arBlockFieldsList as $blockFieldsGroupIndex => $blockFieldsGroup ){?>
                        <?if( is_array( current( $blockFieldsGroup ) ) ){
                            foreach( $blockFieldsGroup as $blockFieldsGroupDataIndex => $blockFieldsGroupData ){?>
                                <optgroup label="<?=$blockFieldsGroupData[0];?>">
                                    <?foreach( $blockFieldsGroupData[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                        <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                    <?}?>
                                </optgroup>
                            <?}
                        }
                        else{?>
                            <optgroup label="<?=$blockFieldsGroup[0];?>">
                                <?foreach( $blockFieldsGroup[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                    <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                </select>
            </div>

            <div class="const-block-arithmetics hide">
                <textarea name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_TRUE][<?=$id?>][ARITHMETICS_TRUE_CONTVALUE]" data-placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>" style="width: 420px;"></textarea>
            </div>
        </div>
    <?}
    elseif( $nodeType == "falsenode" ){?>
        <div class="arithmetics-data-item" data-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
            <label><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS_OP_HELP" )?>x<?=$id?></label><br/>

            <select name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_FALSE][<?=$id?>][ARITHMETICS_FALSE_TYPE]" onchange="ShowConvalueBlockArithmetics( this )" data-id="<?=$rowId?>" style="width: 430px;">
                <?foreach( $arFieldTypeArithmetics as $typeArithmeticsId => $typeNameArithmetics ){?>
                    <?$selectedArithmetics = "";?>
                    <option value="<?=$typeArithmeticsId?>" <?=$selectedArithmetics?>><?=$typeNameArithmetics?></option>
                <?}?>
            </select>
            <span class="arithmetics-data-item-delete">&times</span><br/>

            <input name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_FALSE][<?=$id?>][ARITHMETICS_FALSE_VALUE]" data-id="<?=$rowId?>" type="hidden" value="" />
            <input class="field-block-arithmetics hide" readonly="readonly" name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_FALSE][<?=$id?>][ARITHMETICS_FALSE_VALUE_SHOW]" data-id="<?=$id?>" type="text" value="<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" );?>" />
            <span class="field-edit-arithmetics fieldselecter hide" onclick="ShowFieldsList( 'field-block-arithmetics-', '<?=$rowId?>', '<?=$id?>', '' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-arithmetics-<?=$rowId?>-<?=$id?>-list" class="fields-popup-list" style="display: none">
                <input onkeyup="FilterFieldsList( this, 'field-block-arithmetics-<?=$rowId?>-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'ARITHMETICS_FALSE', '<?=$id?>', 'ARITHMETICS_FALSE_VALUE' )" size="25">
                    <option></option>
                    <?foreach( $arBlockFieldsList as $blockFieldsGroupIndex => $blockFieldsGroup ){?>
                        <?if( is_array( current( $blockFieldsGroup ) ) ){
                            foreach( $blockFieldsGroup as $blockFieldsGroupDataIndex => $blockFieldsGroupData ){?>
                                <optgroup label="<?=$blockFieldsGroupData[0];?>">
                                    <?foreach( $blockFieldsGroupData[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                        <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                    <?}?>
                                </optgroup>
                            <?}
                        }
                        else{?>
                            <optgroup label="<?=$blockFieldsGroup[0];?>">
                                <?foreach( $blockFieldsGroup[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                    <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                </select>
            </div>

            <div class="const-block-arithmetics hide">
                <textarea name="PROFILE[XMLDATA][<?=$rowId?>][ARITHMETICS_FALSE][<?=$id?>][ARITHMETICS_FALSE_CONTVALUE]" data-placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" style="width: 420px;"></textarea>
            </div>
        </div>
    <?}?>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function stack_fieldset_add(){
    global $APPLICATION, $PROFILE, $id, $nodeType, $rowId;
    $id++;

    $obProfileUtils = new CExportproplusProfile();
    $options = $obProfileUtils->createFieldset2( $PROFILE["IBLOCK_ID"], true );
    $arBlockFieldsList = $obProfileUtils->createBlockFieldset( $options );

    $arFieldTypeStack = array(
        "none" => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    ob_start();?>
    <?if( $nodeType == "truenode" ){?>
        <div class="stack-data-item" data-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
            <select name="PROFILE[XMLDATA][<?=$rowId?>][STACK_TRUE][<?=$id?>][STACK_TRUE_TYPE]" onchange="ShowConvalueBlockStack( this )" data-id="<?=$rowId?>" style="width: 430px;">
                <?foreach( $arFieldTypeStack as $typeStackId => $typeNameStack ){?>
                    <?$selectedStack = "";?>
                    <option value="<?=$typeStackId?>" <?=$selectedStack?>><?=$typeNameStack?></option>
                <?}?>
            </select>
            <span class="stack-data-item-delete">&times</span><br/>

            <input name="PROFILE[XMLDATA][<?=$rowId?>][STACK_TRUE][<?=$id?>][STACK_TRUE_VALUE]" data-id="<?=$rowId?>" type="hidden" value="" />
            <input class="field-block-stack hide" readonly="readonly" name="PROFILE[XMLDATA][<?=$rowId?>][STACK_TRUE][<?=$id?>][STACK_TRUE_VALUE_SHOW]" data-id="<?=$id?>" type="text" value="<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" );?>" />
            <span class="field-edit-stack fieldselecter hide" onclick="ShowFieldsList( 'field-block-stack-', '<?=$rowId?>', '<?=$id?>', '' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-stack-<?=$rowId?>-<?=$id?>-list" class="fields-popup-list" style="display: none">
                <input onkeyup="FilterFieldsList( this, 'field-block-stack-<?=$rowId?>-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'STACK_TRUE', '<?=$id?>', 'STACK_TRUE_VALUE' )" size="25">
                    <option></option>
                    <?foreach( $arBlockFieldsList as $blockFieldsGroupIndex => $blockFieldsGroup ){?>
                        <?if( is_array( current( $blockFieldsGroup ) ) ){
                            foreach( $blockFieldsGroup as $blockFieldsGroupDataIndex => $blockFieldsGroupData ){?>
                                <optgroup label="<?=$blockFieldsGroupData[0];?>">
                                    <?foreach( $blockFieldsGroupData[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                        <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                    <?}?>
                                </optgroup>
                            <?}
                        }
                        else{?>
                            <optgroup label="<?=$blockFieldsGroup[0];?>">
                                <?foreach( $blockFieldsGroup[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                    <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                </select>
            </div>

            <div class="const-block-stack hide">
                <textarea name="PROFILE[XMLDATA][<?=$rowId?>][STACK_TRUE][<?=$id?>][STACK_TRUE_CONTVALUE]" data-placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>" style="width: 420px;"></textarea>
            </div>
        </div>
    <?}
    elseif( $nodeType == "falsenode" ){?>
        <div class="stack-data-item" data-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
            <select name="PROFILE[XMLDATA][<?=$rowId?>][STACK_FALSE][<?=$id?>][STACK_FALSE_TYPE]" onchange="ShowConvalueBlockStack( this )" data-id="<?=$rowId?>" style="width: 430px;">
                <?foreach( $arFieldTypeStack as $typeStackId => $typeNameStack ){?>
                    <?$selectedStack = "";?>
                    <option value="<?=$typeStackId?>" <?=$selectedStack?>><?=$typeNameStack?></option>
                <?}?>
            </select>
            <span class="stack-data-item-delete">&times</span><br/>

            <input name="PROFILE[XMLDATA][<?=$rowId?>][STACK_FALSE][<?=$id?>][STACK_FALSE_VALUE]" data-id="<?=$rowId?>" type="hidden" value="" />
            <input class="field-block-stack hide" readonly="readonly" name="PROFILE[XMLDATA][<?=$rowId?>][STACK_FALSE][<?=$id?>][STACK_FALSE_VALUE_SHOW]" data-id="<?=$id?>" type="text" value="<?=GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" );?>" />
            <span class="field-edit-stack fieldselecter hide" onclick="ShowFieldsList( 'field-block-stack-', '<?=$rowId?>', '<?=$id?>', '' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

            <div id="field-block-stack-<?=$rowId?>-<?=$id?>-list" class="fields-popup-list" style="display: none">
                <input onkeyup="FilterFieldsList( this, 'field-block-stack-<?=$rowId?>-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>">
                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'STACK_FALSE', '<?=$id?>', 'STACK_FALSE_VALUE' )" size="25">
                    <option></option>
                    <?foreach( $arBlockFieldsList as $blockFieldsGroupIndex => $blockFieldsGroup ){?>
                        <?if( is_array( current( $blockFieldsGroup ) ) ){
                            foreach( $blockFieldsGroup as $blockFieldsGroupDataIndex => $blockFieldsGroupData ){?>
                                <optgroup label="<?=$blockFieldsGroupData[0];?>">
                                    <?foreach( $blockFieldsGroupData[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                        <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                    <?}?>
                                </optgroup>
                            <?}
                        }
                        else{?>
                            <optgroup label="<?=$blockFieldsGroup[0];?>">
                                <?foreach( $blockFieldsGroup[1] as $blockFieldsItemIndex => $blockFieldsItem ){?>
                                    <option valcode="<?=$blockFieldsItem?>" value="<?=$blockFieldsItemIndex?>" data-search="<?=strtolower( $blockFieldsItem );?>"><?=$blockFieldsItem?></option>
                                <?}?>
                            </optgroup>
                        <?}?>
                    <?}?>
                </select>
            </div>

            <div class="const-block-stack hide">
                <textarea name="PROFILE[XMLDATA][<?=$rowId?>][STACK_FALSE][<?=$id?>][STACK_FALSE_CONTVALUE]" data-placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" style="width: 420px;"></textarea>
            </div>
        </div>
    <?}?>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function convert_fieldset_add(){
    global $APPLICATION, $PROFILE, $id;
    $id++;
    ob_start();?>
    <tr class="fieldset-item" data-id="<?=$id?>">
        <td align="right">
            <input type="text" name="PROFILE[CONVERT_DATA][<?=$id?>][0]" value=""/>
        </td>
        <td align="left" style="position: relative" class="adm-detail-content-cell-r">
            <input type="text" name="PROFILE[CONVERT_DATA][<?=$id?>][1]" value=""/>
            <span class="fieldset-item-delete">&times</span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr style="opacity: 0.2;">
        </td>
    </tr>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function fieldset_convert_fieldset_add(){
    global $APPLICATION, $PROFILE, $rowId, $id;
    $id++;
    ob_start();?>
    <tr class="convert-fieldset-item" data-id="<?=$id?>">
        <td align="right">
            <input type="text" name="PROFILE[XMLDATA][<?=$rowId?>][CONVERT_DATA][<?=$id?>][0]" value=""/>
        </td>
        <td align="left" style="position: relative" class="adm-detail-content-cell-r">
            <input type="text" name="PROFILE[XMLDATA][<?=$rowId?>][CONVERT_DATA][<?=$id?>][1]" value=""/>
            <span class="fieldset-item-delete">&times</span>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr style="opacity: 0.2;">
        </td>
    </tr>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function agent_fieldset_add(){
    global $APPLICATION, $PROFILE, $id;
    $id++;
    ob_start();?>
    <tr data-id="<?=$id?>">
        <td align="center">
            <input type="checkbox" name="PROFILE[SETUP][CRON][<?=$id;?>][IS_PERIOD]" value="Y">
        </td>
        <td align="center">
            <div class="adm-input-wrap adm-input-wrap-calendar">
                <input class="adm-input adm-input-calendar" type="text" name="PROFILE[SETUP][CRON][<?=$id;?>][DAT_START]" size="18" value="<?=date( "d.m.Y H:i:s", time() + 120 );?>">
                <span class="adm-calendar-icon" title="<?=GetMessage( "DATA_EXPORTPROPLUS_NAJMITE_DLA_VYBORA_D" )?>" onclick="BX.calendar( { node: this, field: 'PROFILE[SETUP][CRON][<?=$id;?>][DAT_START]', form: '', bTime: true, bHideTime: false } );"></span>
            </div>
        </td>
        <td align="center">
            <input type="text" name="PROFILE[SETUP][CRON][<?=$id;?>][PERIOD]" value="1440" size="20">
        </td>
        <td align="center">
            <input type="text" name="PROFILE[SETUP][CRON][<?=$id;?>][THREADS]" value="1" size="20">
        </td>
        <td align="center">
            <input type="checkbox" name="PROFILE[SETUP][CRON][<?=$id;?>][IS_STEP_EXPORT]" value="Y">
        </td>
        <td align="center">
            <input type="text" name="PROFILE[SETUP][CRON][<?=$id;?>][STEP_EXPORT_CNT]" value="20" size="20">
        </td>
        <td align="center">
            <input type="text" name="PROFILE[SETUP][CRON][<?=$id;?>][MAXIMUM_PRODUCTS]" value="0" size="20">
        </td>
        <td align="center">
            <span class="agent-fieldset-item-delete">&times</span>
        </td>
    </tr>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function agent_fieldset_delete(){
    global $APPLICATION, $id, $profile_id;

    CExportproplusAgent::DelAgent( $profile_id, $id );

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "data"   => $data
        )
    );
    die();
}

function change_type(){
    global $APPLICATION, $PROFILE;

    $obProfileUtils = new CExportproplusProfile();
    $types = $obProfileUtils->GetTypes();

    $siteEncoding = array(
        "utf-8"        => "utf8",
        "UTF8"         => "utf8",
        "UTF-8"        => "utf8",
        "WINDOWS-1251" => "cp1251",
        "windows-1251" => "cp1251",
        "CP1251"       => "cp1251",
    );

    if( !isset( $_REQUEST["ID"] ) ){
        $obProfile = new CExportproplusProfileDB();
        $dbProcessProfiles = $obProfile->GetProcessList(
            array(
                $by => $order
            ),
            array()
        );

        $arActualProfileNames = array();
        while( $arProcessProfile = $dbProcessProfiles->Fetch() ){
            $arActualProfileNames[] = $arProcessProfile["NAME"];
        }

        if( !in_array( $PROFILE["TYPE"], $arActualProfileNames ) ){
            $profileCode = $PROFILE["TYPE"];
        }
        else{
            $bCorrentProfileName = false;
            $iProfileNameIndex = 1;
            while( !$bCorrentProfileName ){
                if( !in_array( $PROFILE["TYPE"].$iProfileNameIndex, $arActualProfileNames ) ){
                    $profileCode = $PROFILE["TYPE"]."_".$PROFILE["LID"]."_".$iProfileNameIndex;
                    $bCorrentProfileName = true;
                }
                $iProfileNameIndex++;
            }
        }

        ob_start();?>
        <input type="text" size="30" name="PROFILE[NAME]" value="<?=$profileCode;?>"/>
        <?
        $dataProfileName = ob_get_clean();

        ob_start();?>
        <input type="text" size="30" name="PROFILE[CODE]" value="<?=$profileCode;?>"/>
        <?$dataProfileCode = ob_get_clean();

        ob_start();?>
        <?if( strlen( $types[$PROFILE["TYPE"]]["PORTAL_VALIDATOR"] ) > 0 ){?>
            <div style="float: left;">
                <input type="text" size="30" name="PROFILE[SETUP][URL_DATA_FILE]" id="URL_DATA_FILE" value="/data.exportproplus/<?=$profileCode?>.<?if( $PROFILE["TYPE"] == "advantshop" ):?>csv<?else:?>xml<?endif;?>"/>
                <input type="button" value="..." onclick="BtnClick()">
            </div>
            <div style="padding: 5px 0px 0px 300px;">
                <a href="<?=$types[$PROFILE["TYPE"]]["PORTAL_VALIDATOR"];?>" target="_blank"><?=$types[$PROFILE["TYPE"]]["PORTAL_VALIDATOR"];?></a>
            </div>
            <div style="clear: both;"></div>
        <?}
        else{?>
            <input type="text" size="30" name="PROFILE[SETUP][URL_DATA_FILE]" id="URL_DATA_FILE" value="/data.exportproplus/<?=$profileCode?>.<?if( $PROFILE["TYPE"] == "advantshop" ):?>csv<?else:?>xml<?endif;?>"/>
            <input type="button" value="..." onclick="BtnClick()">
        <?}?>
        <?$exportFilePath = ob_get_clean();

        ob_start();?>
        <td colspan="2"></td>
        <?$advantShopCheckCompessArea = ob_get_clean();

        ob_start();?>
        <td colspan="2">
            <input type="hidden" name="PROFILE[SETUP][FILE_TYPE]" value="csv"/>
        </td>
        <?$advantShopFilePathArea = ob_get_clean();

        ob_start();?>
        <input type="text" name="PROFILE[SETUP][EXPORT_STEP]" id="export_step_value" value="50000" disabled="disabled">
        <?$advantShopExportStepBlock = ob_get_clean();
    }

    ob_start();?>
    <textarea name="PROFILE[FORMAT]" rows="5" cols="150"><?=$types[$PROFILE["TYPE"]]["FORMAT"]?></textarea>
    <?$data1 = ob_get_clean();

    ob_start();?>
    <textarea name="PROFILE[OFFER_TEMPLATE]" rows="5" cols="150"><?=htmlspecialcharsbx( $types[$PROFILE["TYPE"]]["ITEMS_FORMAT"] );?></textarea>
    <?$data2 = ob_get_clean();

    ob_start();?>
    <textarea name="PROFILE[CATEGORY_TEMPLATE]" rows="5" cols="150"><?=htmlspecialcharsbx( $types[$PROFILE["TYPE"]]["SECTIONS"] );?></textarea>
    <?$data3 = ob_get_clean();

    ob_start();?>
    <textarea name="PROFILE[CURRENCY_TEMPLATE]" rows="5" cols="150"><?=htmlspecialcharsbx( $types[$PROFILE["TYPE"]]["CURRENCIES"] );?></textarea>
    <?$data4 = ob_get_clean();

    ob_start();
    $iblockList = array();
    $dbIblock = CIBlock::GetList();
    while( $arIBlock = $dbIblock->Fetch() )
        $iblockList[] = $arIBlock["ID"];

    $options = $obProfileUtils->createFieldset2( $PROFILE["IBLOCK_ID"], true );
	$arLinearFieldsList = $obProfileUtils->createLinearFieldset( $options );

    $arFieldType = array(
        "none"    => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field"   => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const"   => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
        "complex" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPLEX" ),
        "composite" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPOSITE" ),
        "arithmetics" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS" ),
        "stack" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_STACK" ),
    );

    $arFieldTypeComplex = array(
        "none"  => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    $arFieldTypeComposite = array(
        "none" => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    $arFieldTypeArithmetics = array(
        "none" => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );

    $arFieldTypeStack = array(
        "none" => GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ),
        "field" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_FIELD" ),
        "const" => GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONST" ),
    );
    ?>

    <tbody>
    <?$idCnt = 0;?>
    <?foreach( $types[$PROFILE["TYPE"]]["FIELDS"] as $id => $field ){
        $useCondition = $field["USE_CONDITION"] == "Y" ? 'checked="checked"' : "";
        $hideCondition = $useCondition ? "" : "hide";
        $hideComplexBlock = $field["TYPE"] == "complex" ? "" : "hide";
        $hideCompositeBlock = $field["TYPE"] == "composite" ? "" : "hide";
        $hideArithmeticsBlock = $field["TYPE"] == "arithmetics" ? "" : "hide";
        $hideStackBlock = $field["TYPE"] == "stack" ? "" : "hide";

        $compositeTrueDivider = $field["COMPOSITE_TRUE_DIVIDER"];
        $compositeFalseDivider = $field["COMPOSITE_FALSE_DIVIDER"];

        $arithmeticsTrueDivider = $field["ARITHMETICS_TRUE_DIVIDER"];
        $arithmeticsFalseDivider = $field["ARITHMETICS_FALSE_DIVIDER"];

        $hideConstBlock = $field["TYPE"] == "const" ? "" : "hide";
        $hideFieldBlock = ( ( $field["TYPE"] != "field" ) && ( !$hideConstBlock || !$hideComplexBlock ) ) || $field["TYPE"] == "none" || !$field["TYPE"] ? "hide" : "";

        $hideComplexConstTrueBlock = $field["COMPLEX_TRUE_TYPE"] == "const" ? "" : "hide";
        $hideComplexFieldTrueBlock = ( ( $field["COMPLEX_TRUE_TYPE"] != "field" ) && !$hideComplexConstTrueBlock ) || $field["COMPLEX_TRUE_TYPE"] == "none" || !$field["COMPLEX_TRUE_TYPE"] ? "hide" : "";

        $hideComplexConstFalseBlock = $field["COMPLEX_FALSE_TYPE"] == "const" ? "" : "hide";
        $hideComplexFieldFalseBlock = ( ( $field["COMPLEX_FALSE_TYPE"] != "field" ) && !$hideComplexConstFalseBlock ) || $field["COMPLEX_FALSE_TYPE"] == "none" || !$field["COMPLEX_FALSE_TYPE"] ? "hide" : "";

        $required = $field["REQUIRED"] == "Y" ? 'checked="checked"' : "";
        $processLogic = $field["PROCESS_LOGIC"] == "N" ? "" : 'checked="checked"';
        $deleteOnEmpty = $field["DELETE_ONEMPTY"] == "N" ? "" : 'checked="checked"';
        $deleteOnEmptyForce = $field["DELETE_ONEMPTY_FORCE"] == "N" ? "" : 'checked="checked"';
        $deleteOnEmptyRowForce = $field["DELETE_ONEMPTY_ROWFORCE"] == "N" ? "" : 'checked="checked"';
        $htmlEncode = $field["HTML_ENCODE"] == "N" ? "" : 'checked="checked"';
        $htmlEncodeCut = $field["HTML_ENCODE_CUT"] == "Y" ? 'checked="checked"' : "";
        $htmlToTxt = $field["HTML_TO_TXT"] == "N" ? "" : 'checked="checked"';
        $skipUntermElement = $field["SKIP_UNTERM_ELEMENT"] == "N" ? "" : 'checked="checked"';
        $exportRowCategoryParentList = $field["EXPORT_ROWCATEGORY_PARENT_LIST"] == "Y" ? 'checked="checked"' : "";
        $multipropToString = $field["MULTIPROP_TO_STRING"] == "Y" ? 'checked="checked"' : "";
        $urlEncode = $field["URL_ENCODE"] == "Y" ? 'checked="checked"' : "";
        $convertCase = $field["CONVERT_CASE"] == "Y" ? 'checked="checked"' : "";
        $textLimit = $field["TEXT_LIMIT"];
        $multiPropLimit = $field["MULTIPROP_LIMIT"];
        $multiPropDivider = $field["MULTIPROP_DIVIDER"];?>
        <tr class="fieldset-item" data-id="<?=$idCnt++?>">
            <td>
                <label for="PROFILE[XMLDATA][<?=$id?>]"><?=$field["NAME"]?></label>
                <input type="hidden" name="PROFILE[XMLDATA][<?=$id?>][NAME]" value="<?=$field["NAME"]?>"/>
            </td>
            <td colspan="2" style="position: relative" class="adm-detail-content-cell-r">
                <input type="text" name="PROFILE[XMLDATA][<?=$id?>][CODE]" value="<?=$field["CODE"]?>"/>
                <select name="PROFILE[XMLDATA][<?=$id?>][TYPE]" onchange="ShowConvalueBlock(this)" data-id="<?=$id?>">
                    <?foreach( $arFieldType as $typeId => $typeName ):?>
                        <?$selected = $typeId == $field["TYPE"] ? 'selected="selected"' : "";?>
                        <option value="<?=$typeId?>" <?=$selected?>><?=$typeName?></option>
                    <?endforeach?>
                </select>


                <input name="PROFILE[XMLDATA][<?=$id?>][VALUE]" data-id="<?=$id?>" type="hidden" value="<?=$field["VALUE"]?>" />
                <input class="field-block <?=$hideFieldBlock?>" readonly="readonly" name="PROFILE[XMLDATA][<?=$id?>][VALUE_SHOW]" data-id="<?=$id?>" type="text" title="<?=$arLinearFieldsList[$field["VALUE"]];?>" value="<?=( isset( $arLinearFieldsList[$field["VALUE"]] ) ? $arLinearFieldsList[$field["VALUE"]] : GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ) );?>" />
                <span class="field-edit fieldselecter <?=$hideFieldBlock?>" onclick="ShowFieldsList( 'field-block-', '<?=$id?>', false, '<?=$field["VALUE"]?>' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

                <div id="field-block-<?=$id?>-list" class="fields-popup-list" style="display: none;">
                    <input onkeyup="FilterFieldsList( this, 'field-block-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>" value="<?=( isset( $arLinearFieldsList[$field["VALUE"]] ) ? $arLinearFieldsList[$field["VALUE"]] : "" )?>">
                    <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'VALUE', false, false )" size="25">
                    </select>
                </div>

                <div class="const-block <?=$hideConstBlock?>">
                    <?$hideContvalueFalse = !$useCondition ? "hide" : "";?>
                    <?$showPlaceholder = !$hideContvalueFalse ? "placeholder" : "data-placeholder";?>
                    <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_TRUE]" <?=$showPlaceholder?>=
                    "<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>"
                    ><?=$field["CONTVALUE_TRUE"]?></textarea>
                    <textarea name="PROFILE[XMLDATA][<?=$id?>][CONTVALUE_FALSE]" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" class="<?=$hideContvalueFalse?>"><?=$field["CONTVALUE_FALSE"]?></textarea>
                </div>
                <div class="complex-block-container <?=$hideComplexBlock?>">
                    <div class="complex-block">
                        <?$hideComplexFalse = !$useCondition ? "hide" : "";?>
                        <?$showPlaceholder = !$hideComplexFalse ? "placeholder" : "data-placeholder";?>

                        <div>
                            <select name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_TYPE]" onchange="ShowConvalueBlockComplex(this)" data-id="<?=$id?>">
                                <?foreach( $arFieldTypeComplex as $typeComplexId => $typeNameComplex ):?>
                                    <?$selectedComplex = $typeComplexId == $field["COMPLEX_TRUE_TYPE"] ? 'selected="selected"' : "";?>
                                    <option value="<?=$typeComplexId?>" <?=$selectedComplex?>><?=$typeNameComplex?></option>
                                <?endforeach?>
                            </select>

                            <input name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_VALUE]" data-id="<?=$id?>" type="hidden" value="<?=$field["COMPLEX_TRUE_VALUE"]?>" />
                            <input class="field-block-complex <?=$hideComplexFieldTrueBlock?>" readonly="readonly" name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_VALUE_SHOW]" data-id="<?=$id?>" type="text" title="<?=$arLinearFieldsList[$field["COMPLEX_TRUE_VALUE"]];?>" value="<?=( isset( $arLinearFieldsList[$field["COMPLEX_TRUE_VALUE"]] ) ? $arLinearFieldsList[$field["COMPLEX_TRUE_VALUE"]] : GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ) );?>" />
                            <span class="field-edit-complex fieldselecter <?=$hideComplexFieldTrueBlock?>" onclick="ShowFieldsList( 'field-block-complex-', '<?=$id?>', false, '<?=$field["COMPLEX_TRUE_VALUE"]?>' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

                            <div id="field-block-complex-<?=$id?>-list" class="fields-popup-list" style="display: none;">
                                <input onkeyup="FilterFieldsList( this, 'field-block-complex-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>" value="<?=( isset( $arLinearFieldsList[$field["COMPLEX_TRUE_VALUE"]] ) ? $arLinearFieldsList[$field["COMPLEX_TRUE_VALUE"]] : "" )?>">
                                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'COMPLEX_TRUE_VALUE', false, false )" size="25">
                                </select>
                            </div>

                            <div class="const-block-complex <?=$hideComplexConstTrueBlock?>">
                                <textarea name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_TRUE_CONTVALUE]" <?=$showPlaceholder?>
                                ="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>"
                                ><?=$field["COMPLEX_TRUE_CONTVALUE"]?></textarea>
                            </div>
                        </div>
                        <div class="<?=$hideComplexFalse?>">
                            <select name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_TYPE]" onchange="ShowConvalueBlockComplexFalse(this)" data-id="<?=$id?>">
                                <?foreach( $arFieldTypeComplex as $typeComplexId => $typeNameComplex ):?>
                                    <?$selectedComplex = $typeComplexId == $field["COMPLEX_FALSE_TYPE"] ? 'selected="selected"' : "";?>
                                    <option value="<?=$typeComplexId?>" <?=$selectedComplex?>><?=$typeNameComplex?></option>
                                <?endforeach?>
                            </select>

                            <input name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_VALUE]" data-id="<?=$id?>" type="hidden" value="<?=$field["COMPLEX_FALSE_VALUE"]?>" />
                            <input class="field-block-complex-false <?=$hideComplexFieldFalseBlock?>" readonly="readonly" name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_VALUE_SHOW]" data-id="<?=$id?>" type="text" title="<?=$arLinearFieldsList[$field["COMPLEX_FALSE_VALUE"]];?>" value="<?=( isset( $arLinearFieldsList[$field["COMPLEX_FALSE_VALUE"]] ) ? $arLinearFieldsList[$field["COMPLEX_FALSE_VALUE"]] : GetMessage( "DATA_EXPORTPROPLUS_NE_VYBRANO" ) );?>" />
                            <span class="field-edit-complex-false fieldselecter <?=$hideComplexFieldFalseBlock?>" onclick="ShowFieldsList( 'field-block-complex-false-', '<?=$id?>', false, '<?=$field["COMPLEX_FALSE_VALUE"]?>' )" title="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELD_LIST_DATA_SELECT" );?>"></span>

                            <div id="field-block-complex-false-<?=$id?>-list" class="fields-popup-list" style="display: none;">
                                <input onkeyup="FilterFieldsList( this, 'field-block-complex-false-<?=$id?>-list' )" placeholder="<?=GetMessage( "DATA_EXPORTPROPLUS_MARKET_CATEGORY_DATA_WINDOW_PLACEHOLDER" );?>" value="<?=( isset( $arLinearFieldsList[$field["COMPLEX_FALSE_VALUE"]] ) ? $arLinearFieldsList[$field["COMPLEX_FALSE_VALUE"]] : "" )?>">
                                <select onchange="SetFieldsListField( this.value, this.options[this.selectedIndex].getAttribute( 'valcode' ), 'COMPLEX_FALSE_VALUE', false, false )" size="25">
                                </select>
                            </div>

                            <div class="const-block-complex-false <?=$hideComplexConstFalseBlock?>">
                                <textarea name="PROFILE[XMLDATA][<?=$id?>][COMPLEX_FALSE_CONTVALUE]" <?=$showPlaceholder?>
                                ="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>"
                                ><?=$field["COMPLEX_FALSE_CONTVALUE"]?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="composite-block-container <?=$hideCompositeBlock?>" style="width: 100%;">
                    <div class="composite-block" style="margin: 10px 0px 0px 0px; width: 100%;">
                        <?$hideCompositeFalse = !$useCondition ? "hide" : "";?>
                        <?$showPlaceholder = !$hideCompositeFalse ? "placeholder" : "data-placeholder";?>

                        <div style="width: 100%;">
                            <div class="composite-divider" style="width: 100%;">
                                <span id="hint_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER_HELP" )?>' );</script>
                                <label for="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_TRUE_DIVIDER]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER" )?></label><br/>
                                <input type="text" name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_TRUE_DIVIDER]" value="<?=$compositeTrueDivider;?>" style="width: 420px;" />
                            </div>
                            <div class="composite-data-area-true" style="margin: 10px 0px 0px 0px; width: 100%;">
                                <?if( is_array( $arProfile["XMLDATA"][$id]["COMPOSITE_TRUE"] ) && !empty( $arProfile["XMLDATA"][$id]["COMPOSITE_TRUE"] ) ){
                                    foreach( $arProfile["XMLDATA"][$id]["COMPOSITE_TRUE"] as $compositeTrueId => $arCompositeTrue ){?>
                                        <div class="composite-data-item" data-id="<?=$compositeTrueId?>" style="margin: 10px 0px 0px 0px;">
                                            <select name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_TRUE][<?=$compositeTrueId?>][COMPOSITE_TRUE_TYPE]" onchange="ShowConvalueBlockComposite( this )" data-id="<?=$id?>" style="width: 430px;">
                                                <?foreach( $arFieldTypeComposite as $typeCompositeId => $typeNameComposite ){?>
                                                    <?$selectedComposite = ( ( $typeCompositeId == $arCompositeTrue["COMPOSITE_TRUE_TYPE"] ) ? 'selected="selected"' : "" );
                                                    $hideCompositeConstTrueBlock = ( ( $typeCompositeId == $arCompositeTrue["COMPOSITE_TRUE_TYPE"] ) && ( $typeCompositeId == "const" ) ) ? "" : "hide";
                                                    $hideCompositeFieldTrueBlock = ( ( $typeCompositeId != "field" ) && !$hideCompositeConstTrueBlock ) || $typeCompositeId == "none" || !$typeCompositeId ? "hide" : "";?>
                                                    <option value="<?=$typeCompositeId?>" <?=$selectedComposite?>><?=$typeNameComposite?></option>
                                                <?}?>
                                            </select>
                                            <span class="composite-data-item-delete">&times</span><br/>
                                            <select class="field-block-composite <?=$hideCompositeFieldTrueBlock?>" name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_TRUE][<?=$compositeTrueId?>][COMPOSITE_TRUE_VALUE]" style="width: 430px;">
                                                <?$opt = $obProfileUtils->selectFieldset2( $options, $arCompositeTrue["COMPOSITE_TRUE_VALUE"] );
                                                echo implode( "\n", $opt );
                                                unset( $opt );?>
                                            </select>
                                            <div class="const-block-composite <?=$hideCompositeConstTrueBlock?>">
                                                <textarea name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_TRUE][<?=$compositeTrueId?>][COMPOSITE_TRUE_CONTVALUE]" <?=$showPlaceholder?>="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>" style="width: 420px;"><?=$arCompositeTrue["COMPOSITE_TRUE_CONTVALUE"]?></textarea>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                            <div class="composite-add-field-button truenode" data-id="<?=$idCnt?>" data-row-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
                                <button class="adm-btn" onclick="CompositeFieldsetAdd( this ); return false;">
                                    <?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ADD_PART_TO_COMPOSITE_FIELD" );?>
                                </button>
                            </div>
                        </div>
                        <div class="composite-data-area-false-container <?=$hideCompositeFalse?>" style="width: 100%; margin: 20px 0px 0px 0px;">
                            <div class="composite-divider" style="width: 100%;">
                                <span id="hint_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER_HELP" )?>' );</script>
                                <label for="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_FALSE_DIVIDER]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_COMPOSITE_DIVIDER" )?></label><br/>
                                <input type="text" name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_FALSE_DIVIDER]" value="<?=$compositeFalseDivider;?>" style="width: 420px;" />
                            </div>
                            <div class="composite-data-area-false" style="margin: 10px 0px 0px 0px; width: 100%;">
                                <?if( is_array( $arProfile["XMLDATA"][$id]["COMPOSITE_FALSE"] ) && !empty( $arProfile["XMLDATA"][$id]["COMPOSITE_FALSE"] ) ){
                                    foreach( $arProfile["XMLDATA"][$id]["COMPOSITE_FALSE"] as $compositeFalseId => $arCompositeFalse ){?>
                                        <div class="composite-data-item" data-id="<?=$compositeFalseId?>" style="margin: 10px 0px 0px 0px;">
                                            <select name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_FALSE][<?=$compositeFalseId?>][COMPOSITE_FALSE_TYPE]" onchange="ShowConvalueBlockComposite( this )" data-id="<?=$id?>" style="width: 430px;">
                                                <?foreach( $arFieldTypeComposite as $typeCompositeId => $typeNameComposite ){?>
                                                    <?$selectedComposite = ( ( $typeCompositeId == $arCompositeFalse["COMPOSITE_FALSE_TYPE"] ) ? 'selected="selected"' : "" );
                                                    $hideCompositeConstFalseBlock = ( ( $typeCompositeId == $arCompositeFalse["COMPOSITE_FALSE_TYPE"] ) && ( $typeCompositeId == "const" ) ) ? "" : "hide";
                                                    $hideCompositeFieldFalseBlock = ( ( $typeCompositeId != "field" ) && !$hideCompositeConstFalseBlock ) || $typeCompositeId == "none" || !$typeCompositeId ? "hide" : "";?>
                                                    <option value="<?=$typeCompositeId?>" <?=$selectedComposite?>><?=$typeNameComposite?></option>
                                                <?}?>
                                            </select>
                                            <span class="composite-data-item-delete">&times</span><br/>
                                            <select class="field-block-composite <?=$hideCompositeFieldFalseBlock?>" name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_FALSE][<?=$compositeFalseId?>][COMPOSITE_FALSE_VALUE]" style="width: 430px;">
                                                <?$opt = $obProfileUtils->selectFieldset2( $options, $arCompositeFalse["COMPOSITE_FALSE_VALUE"] );
                                                echo implode( "\n", $opt );
                                                unset( $opt );?>
                                            </select>
                                            <div class="const-block-composite <?=$hideCompositeConstFalseBlock?>">
                                                <textarea name="PROFILE[XMLDATA][<?=$id?>][COMPOSITE_FALSE][<?=$compositeFalseId?>][COMPOSITE_FALSE_CONTVALUE]" <?=$showPlaceholder?>="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" style="width: 420px;"><?=$arCompositeFalse["COMPOSITE_FALSE_CONTVALUE"]?></textarea>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                            <div class="composite-add-field-button falsenode" data-id="<?=$idCnt?>" data-row-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
                                <button class="adm-btn" onclick="CompositeFieldsetAdd( this ); return false;">
                                    <?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ADD_PART_TO_COMPOSITE_FIELD" );?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="arithmetics-block-container <?=$hideArithmeticsBlock?>" style="width: 100%;">
                    <div class="arithmetics-block" style="margin: 10px 0px 0px 0px; width: 100%;">
                        <?$hideArithmeticsFalse = !$useCondition ? "hide" : "";?>
                        <?$showPlaceholder = !$hideArithmeticsFalse ? "placeholder" : "data-placeholder";?>

                        <div style="width: 100%;">
                            <div class="arithmetics-divider" style="width: 100%;">
                                <span id="hint_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER_HELP" )?>' );</script>
                                <label for="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_TRUE_DIVIDER]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER" )?></label><br/>
                                <input type="text" name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_TRUE_DIVIDER]" value="<?=$arithmeticsTrueDivider;?>" style="width: 420px;" />
                            </div>
                            <div class="arithmetics-data-area-true" style="margin: 10px 0px 0px 0px; width: 100%;">
                                <?if( is_array( $arProfile["XMLDATA"][$id]["ARITHMETICS_TRUE"] ) && !empty( $arProfile["XMLDATA"][$id]["ARITHMETICS_TRUE"] ) ){
                                    foreach( $arProfile["XMLDATA"][$id]["ARITHMETICS_TRUE"] as $arithmeticsTrueId => $arArithmeticsTrue ){?>
                                        <div class="arithmetics-data-item" data-id="<?=$arithmeticsTrueId?>" style="margin: 10px 0px 0px 0px;">
                                            <select name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_TRUE][<?=$arithmeticsTrueId?>][ARITHMETICS_TRUE_TYPE]" onchange="ShowConvalueBlockArithmetics( this )" data-id="<?=$id?>" style="width: 430px;">
                                                <?foreach( $arFieldTypeArithmetics as $typeArithmeticsId => $typeNameArithmetics ){?>
                                                    <?$selectedArithmetics = ( ( $typeArithmeticsId == $arArithmeticsTrue["ARITHMETICS_TRUE_TYPE"] ) ? 'selected="selected"' : "" );
                                                    $hideArithmeticsConstTrueBlock = ( ( $typeArithmeticsId == $arArithmeticsTrue["ARITHMETICS_TRUE_TYPE"] ) && ( $typeArithmeticsId == "const" ) ) ? "" : "hide";
                                                    $hideArithmeticsFieldTrueBlock = ( ( $typeArithmeticsId != "field" ) && !$hideArithmeticsConstTrueBlock ) || $typeArithmeticsId == "none" || !$typeArithmeticsId ? "hide" : "";?>
                                                    <option value="<?=$typeArithmeticsId?>" <?=$selectedArithmetics?>><?=$typeNameArithmetics?></option>
                                                <?}?>
                                            </select>
                                            <span class="arithmetics-data-item-delete">&times</span><br/>
                                            <select class="field-block-arithmetics <?=$hideArithmeticsFieldTrueBlock?>" name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_TRUE][<?=$arithmeticsTrueId?>][ARITHMETICS_TRUE_VALUE]" style="width: 430px;">
                                                <?$opt = $obProfileUtils->selectFieldset2( $options, $arArithmeticsTrue["ARITHMETICS_TRUE_VALUE"] );
                                                echo implode( "\n", $opt );
                                                unset( $opt );?>
                                            </select>
                                            <div class="const-block-arithmetics <?=$hideArithmeticsConstTrueBlock?>">
                                                <textarea name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_TRUE][<?=$arithmeticsTrueId?>][ARITHMETICS_TRUE_CONTVALUE]" <?=$showPlaceholder?>="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>" style="width: 420px;"><?=$arArithmeticsTrue["ARITHMETICS_TRUE_CONTVALUE"]?></textarea>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                            <div class="arithmetics-add-field-button truenode" data-id="<?=$idCnt?>" data-row-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
                                <button class="adm-btn" onclick="ArithmeticsFieldsetAdd( this ); return false;">
                                    <?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ADD_PART_TO_ARITHMETICS_FIELD" );?>
                                </button>
                            </div>
                        </div>
                        <div class="arithmetics-data-area-false-container <?=$hideArithmeticsFalse?>" style="width: 100%; margin: 20px 0px 0px 0px;">
                            <div class="arithmetics-divider" style="width: 100%;">
                                <span id="hint_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER_HELP" )?>' );</script>
                                <label for="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_FALSE_DIVIDER]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ARITHMETICS_DIVIDER" )?></label><br/>
                                <input type="text" name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_FALSE_DIVIDER]" value="<?=$arithmeticsFalseDivider;?>" style="width: 420px;" />
                            </div>
                            <div class="arithmetics-data-area-false" style="margin: 10px 0px 0px 0px; width: 100%;">
                                <?if( is_array( $arProfile["XMLDATA"][$id]["ARITHMETICS_FALSE"] ) && !empty( $arProfile["XMLDATA"][$id]["ARITHMETICS_FALSE"] ) ){
                                    foreach( $arProfile["XMLDATA"][$id]["ARITHMETICS_FALSE"] as $arithmeticsFalseId => $arArithmeticsFalse ){?>
                                        <div class="arithmetics-data-item" data-id="<?=$arithmeticsFalseId?>" style="margin: 10px 0px 0px 0px;">
                                            <select name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_FALSE][<?=$arithmeticsFalseId?>][ARITHMETICS_FALSE_TYPE]" onchange="ShowConvalueBlockArithmetics( this )" data-id="<?=$id?>" style="width: 430px;">
                                                <?foreach( $arFieldTypeArithmetics as $typeArithmeticsId => $typeNameArithmetics ){?>
                                                    <?$selectedArithmetics = ( ( $typeArithmeticsId == $arArithmeticsFalse["ARITHMETICS_FALSE_TYPE"] ) ? 'selected="selected"' : "" );
                                                    $hideArithmeticsConstFalseBlock = ( ( $typeArithmeticsId == $arArithmeticsFalse["ARITHMETICS_FALSE_TYPE"] ) && ( $typeArithmeticsId == "const" ) ) ? "" : "hide";
                                                    $hideArithmeticsFieldFalseBlock = ( ( $typeArithmeticsId != "field" ) && !$hideArithmeticsConstFalseBlock ) || $typeArithmeticsId == "none" || !$typeArithmeticsId ? "hide" : "";?>
                                                    <option value="<?=$typeArithmeticsId?>" <?=$selectedArithmetics?>><?=$typeNameArithmetics?></option>
                                                <?}?>
                                            </select>
                                            <span class="arithmetics-data-item-delete">&times</span><br/>
                                            <select class="field-block-arithmetics <?=$hideArithmeticsFieldFalseBlock?>" name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_FALSE][<?=$arithmeticsFalseId?>][ARITHMETICS_FALSE_VALUE]" style="width: 430px;">
                                                <?$opt = $obProfileUtils->selectFieldset2( $options, $arArithmeticsFalse["ARITHMETICS_FALSE_VALUE"] );
                                                echo implode( "\n", $opt );
                                                unset( $opt );?>
                                            </select>
                                            <div class="const-block-arithmetics <?=$hideArithmeticsConstFalseBlock?>">
                                                <textarea name="PROFILE[XMLDATA][<?=$id?>][ARITHMETICS_FALSE][<?=$arithmeticsFalseId?>][ARITHMETICS_FALSE_CONTVALUE]" <?=$showPlaceholder?>="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" style="width: 420px;"><?=$arArithmeticsFalse["ARITHMETICS_FALSE_CONTVALUE"]?></textarea>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                            <div class="arithmetics-add-field-button falsenode" data-id="<?=$idCnt?>" data-row-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
                                <button class="adm-btn" onclick="ArithmeticsFieldsetAdd( this ); return false;">
                                    <?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ADD_PART_TO_ARITHMETICS_FIELD" );?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="stack-block-container <?=$hideStackBlock?>" style="width: 100%;">
                    <div class="stack-block" style="margin: 10px 0px 0px 0px; width: 100%;">
                        <?$hideStackFalse = !$useCondition ? "hide" : "";?>
                        <?$showPlaceholder = !$hideStackFalse ? "placeholder" : "data-placeholder";?>

                        <div style="width: 100%;">
                            <div class="stack-data-area-true" style="margin: 10px 0px 0px 0px; width: 100%;">
                                <?if( is_array( $arProfile["XMLDATA"][$id]["STACK_TRUE"] ) && !empty( $arProfile["XMLDATA"][$id]["STACK_TRUE"] ) ){
                                    foreach( $arProfile["XMLDATA"][$id]["STACK_TRUE"] as $stackTrueId => $arStackTrue ){?>
                                        <div class="stack-data-item" data-id="<?=$stackTrueId?>" style="margin: 10px 0px 0px 0px;">
                                            <select name="PROFILE[XMLDATA][<?=$id?>][STACK_TRUE][<?=$stackTrueId?>][STACK_TRUE_TYPE]" onchange="ShowConvalueBlockStack( this )" data-id="<?=$id?>" style="width: 430px;">
                                                <?foreach( $arFieldTypeStack as $typeStackId => $typeNameStack ){?>
                                                    <?$selectedStack = ( ( $typeStackId == $arStackTrue["STACK_TRUE_TYPE"] ) ? 'selected="selected"' : "" );
                                                    $hideStackConstTrueBlock = ( ( $typeStackId == $arStackTrue["STACK_TRUE_TYPE"] ) && ( $typeStackId == "const" ) ) ? "" : "hide";
                                                    $hideStackFieldTrueBlock = ( ( $typeStackId != "field" ) && !$hideStackConstTrueBlock ) || $typeStackId == "none" || !$typeStackId ? "hide" : "";?>
                                                    <option value="<?=$typeStackId?>" <?=$selectedStack?>><?=$typeNameStack?></option>
                                                <?}?>
                                            </select>
                                            <span class="stack-data-item-delete">&times</span><br/>
                                            <select class="field-block-stack <?=$hideStackFieldTrueBlock?>" name="PROFILE[XMLDATA][<?=$id?>][STACK_TRUE][<?=$stackTrueId?>][STACK_TRUE_VALUE]" style="width: 430px;">
                                                <?$opt = $obProfileUtils->selectFieldset2( $options, $arStackTrue["STACK_TRUE_VALUE"] );
                                                echo implode( "\n", $opt );
                                                unset( $opt );?>
                                            </select>
                                            <div class="const-block-stack <?=$hideStackConstTrueBlock?>">
                                                <textarea name="PROFILE[XMLDATA][<?=$id?>][STACK_TRUE][<?=$stackTrueId?>][STACK_TRUE_CONTVALUE]" <?=$showPlaceholder?>="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_TRUE" )?>" style="width: 420px;"><?=$arStackTrue["STACK_TRUE_CONTVALUE"]?></textarea>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                            <div class="stack-add-field-button truenode" data-id="<?=$idCnt?>" data-row-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
                                <button class="adm-btn" onclick="StackFieldsetAdd( this ); return false;">
                                    <?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ADD_PART_TO_STACK_FIELD" );?>
                                </button>
                            </div>
                        </div>
                        <div class="stack-data-area-false-container <?=$hideStackFalse?>" style="width: 100%; margin: 20px 0px 0px 0px;">
                            <div class="stack-data-area-false" style="margin: 10px 0px 0px 0px; width: 100%;">
                                <?if( is_array( $arProfile["XMLDATA"][$id]["STACK_FALSE"] ) && !empty( $arProfile["XMLDATA"][$id]["STACK_FALSE"] ) ){
                                    foreach( $arProfile["XMLDATA"][$id]["STACK_FALSE"] as $stackFalseId => $arStackFalse ){?>
                                        <div class="stack-data-item" data-id="<?=$stackFalseId?>" style="margin: 10px 0px 0px 0px;">
                                            <select name="PROFILE[XMLDATA][<?=$id?>][STACK_FALSE][<?=$stackFalseId?>][STACK_FALSE_TYPE]" onchange="ShowConvalueBlockStack( this )" data-id="<?=$id?>" style="width: 430px;">
                                                <?foreach( $arFieldTypeStack as $typeStackId => $typeNameStack ){?>
                                                    <?$selectedStack = ( ( $typeStackId == $arStackFalse["STACK_FALSE_TYPE"] ) ? 'selected="selected"' : "" );
                                                    $hideStackConstFalseBlock = ( ( $typeStackId == $arStackFalse["STACK_FALSE_TYPE"] ) && ( $typeStackId == "const" ) ) ? "" : "hide";
                                                    $hideStackFieldFalseBlock = ( ( $typeStackId != "field" ) && !$hideStackConstFalseBlock ) || $typeStackId == "none" || !$typeStackId ? "hide" : "";?>
                                                    <option value="<?=$typeStackId?>" <?=$selectedStack?>><?=$typeNameStack?></option>
                                                <?}?>
                                            </select>
                                            <span class="stack-data-item-delete">&times</span><br/>
                                            <select class="field-block-stack <?=$hideStackFieldFalseBlock?>" name="PROFILE[XMLDATA][<?=$id?>][STACK_FALSE][<?=$stackFalseId?>][STACK_FALSE_VALUE]" style="width: 430px;">
                                                <?$opt = $obProfileUtils->selectFieldset2( $options, $arStackFalse["STACK_FALSE_VALUE"] );
                                                echo implode( "\n", $opt );
                                                unset( $opt );?>
                                            </select>
                                            <div class="const-block-stack <?=$hideStackConstFalseBlock?>">
                                                <textarea name="PROFILE[XMLDATA][<?=$id?>][STACK_FALSE][<?=$stackFalseId?>][STACK_FALSE_CONTVALUE]" <?=$showPlaceholder?>="<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_FALSE" )?>" style="width: 420px;"><?=$arStackFalse["STACK_FALSE_CONTVALUE"]?></textarea>
                                            </div>
                                        </div>
                                    <?}
                                }?>
                            </div>
                            <div class="stack-add-field-button falsenode" data-id="<?=$idCnt?>" data-row-id="<?=$id?>" style="margin: 10px 0px 0px 0px;">
                                <button class="adm-btn" onclick="StackFieldsetAdd( this ); return false;">
                                    <?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_ADD_PART_TO_STACK_FIELD" );?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="fieldset-item-delete">&times</span>

                <div style="margin: 10px 0px 10px 15px;">
                    <span id="hint_EXPORTPROPLUS_FIELDSET_REQUIRED"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_REQUIRED' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_REQUIRED_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][REQUIRED]" value="Y" <?=$required?> />
                    <label for="PROFILE[XMLDATA][<?=$id?>][REQUIRED]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_REQUIRED" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_CONDITION"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_CONDITION' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][USE_CONDITION]" <?=$useCondition?> value="Y" data-id="<?=$id?>" onclick="ShowConditionBlock( this, <?=$idCnt?> )"/>
                    <label for="PROFILE[XMLDATA][<?=$id?>][USE_CONDITION]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONDITION" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_PROCESS_LOGIC"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_PROCESS_LOGIC' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_PROCESS_LOGIC_HELP" )?>' );</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][PROCESS_LOGIC]" <?=$processLogic?> value="Y"/>
                    <label for="PROFILE[XMLDATA][<?=$id?>][PROCESS_LOGIC]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_PROCESS_LOGIC" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]" <?=$deleteOnEmpty?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_FORCE"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_FORCE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_FORCE_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY_FORCE]" <?=$deleteOnEmptyForce?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY_FORCE]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_FORCE" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_ROWFORCE"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_ROWFORCE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_ROWFORCE_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY_ROWFORCE]" <?=$deleteOnEmptyRowForce?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][DELETE_ONEMPTY_ROWFORCE]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_DELETE_ONEMPTY_ROWFORCE" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_URL_ENCODE"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_URL_ENCODE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_URL_ENCODE_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][URL_ENCODE]" <?=$urlEncode?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][URL_ENCODE]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_URL_ENCODE" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_CONVERT_CASE"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_CONVERT_CASE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONVERT_CASE_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][CONVERT_CASE]" <?=$convertCase?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][CONVERT_CASE]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_CONVERT_CASE" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_HTML_ENCODE"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_HTML_ENCODE' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_HTML_ENCODE_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]" <?=$htmlEncode?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_HTML_ENCODE" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_HTML_ENCODE_CUT"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_HTML_ENCODE_CUT' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_HTML_ENCODE_CUT_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE_CUT]" <?=$htmlEncodeCut?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][HTML_ENCODE_CUT]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_HTML_ENCODE_CUT" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_HTML_TO_TXT"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_HTML_TO_TXT' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_HTML_TO_TXT_HELP" )?>');</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]" <?=$htmlToTxt?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][HTML_TO_TXT]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_HTML_TO_TXT" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_SKIP_UNTERM_ELEMENT"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_SKIP_UNTERM_ELEMENT' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_SKIP_UNTERM_ELEMENT_HELP" )?>' );</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][SKIP_UNTERM_ELEMENT]" <?=$skipUntermElement?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][SKIP_UNTERM_ELEMENT]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_SKIP_UNTERM_ELEMENT" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_EXPORT_ROWCATEGORY_PARENT_LIST"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_EXPORT_ROWCATEGORY_PARENT_LIST' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_EXPORT_ROWCATEGORY_PARENT_LIST_HELP" )?>' );</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][EXPORT_ROWCATEGORY_PARENT_LIST]" <?=$exportRowCategoryParentList?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][EXPORT_ROWCATEGORY_PARENT_LIST]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_EXPORT_ROWCATEGORY_PARENT_LIST" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_MULTIPROP_TO_STRING"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_MULTIPROP_TO_STRING' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_MULTIPROP_TO_STRING_HELP" )?>' );</script>
                    <input type="checkbox" name="PROFILE[XMLDATA][<?=$id?>][MULTIPROP_TO_STRING]" <?=$multipropToString?> value="Y">
                    <label for="PROFILE[XMLDATA][<?=$id?>][MULTIPROP_TO_STRING]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_MULTIPROP_TO_STRING" )?></label>

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_MULTIPROP_DIVIDER"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_MULTIPROP_DIVIDER' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_MULTIPROP_DIVIDER_HELP" )?>' );</script>
                    <label for="PROFILE[XMLDATA][<?=$id?>][MULTIPROP_DIVIDER]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_MULTIPROP_DIVIDER" )?></label><br/>
                    <input type="text" name="PROFILE[XMLDATA][<?=$id?>][MULTIPROP_DIVIDER]" value="<?=$multiPropDivider;?>" />

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_MULTIPROP_LIMIT"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_MULTIPROP_LIMIT' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_MULTIPROP_LIMIT_HELP" )?>' );</script>
                    <label for="PROFILE[XMLDATA][<?=$id?>][MULTIPROP_LIMIT]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_MULTIPROP_LIMIT" )?></label><br/>
                    <input type="text" name="PROFILE[XMLDATA][<?=$id?>][MULTIPROP_LIMIT]" value="<?=$multiPropLimit;?>" />

                    <div style="height: 5px;">&nbsp;</div>

                    <span id="hint_EXPORTPROPLUS_FIELDSET_TEXT_LIMIT"></span>
                    <script type="text/javascript">BX.hint_replace( BX( 'hint_EXPORTPROPLUS_FIELDSET_TEXT_LIMIT' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_TEXT_LIMIT_HELP" )?>' );</script>
                    <label for="PROFILE[XMLDATA][<?=$id?>][TEXT_LIMIT]"><?=GetMessage( "DATA_EXPORTPROPLUS_FIELDSET_TEXT_LIMIT" )?></label><br/>
                    <input type="text" name="PROFILE[XMLDATA][<?=$id?>][TEXT_LIMIT]" value="<?=$textLimit;?>" />
                </div>
                <div id="PROFILE_XMLDATA_<?=$id?>_CONDITION" class="condition-block <?=$hideCondition?>">
                    <?
                    if( $field["USE_CONDITION"] == "Y" && \Bitrix\Main\Loader::includeModule( "catalog" ) ){
                        $obCond = new CDataExportproplusCatalogCond();
                        CDataExportproplusProps::$arIBlockFilter = $obProfileUtils->PrepareIBlock( $arProfile["IBLOCK_ID"], $arProfile["USE_SKU"] );
                        $boolCond = $obCond->Init(
                            0,
                            0,
                            array(
                                "FORM_NAME" => "exportproplus_form",
                                "CONT_ID"   => "PROFILE_XMLDATA_".$id."_CONDITION",
                                "JS_NAME"   => "JSCatCond_field_".$idCnt, "PREFIX" => "PROFILE[XMLDATA][".$id."][CONDITION]"
                            )
                        );
                        if( !$boolCond ){
                            if( $ex = $APPLICATION->GetException() ){
                                echo $ex->GetString()."<br/>";
                            }
                        }
                        $obCond->Show( $field["CONDITION"] );
                    }
                   ?>
                </div>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <hr style="opacity: 0.2;">
            </td>
        </tr>
    <?}?>
    </tbody>
    <?$data5 = ob_get_clean();

    ob_start();?>
    <a href="<?=$types[$PROFILE["TYPE"]]["PORTAL_REQUIREMENTS"];?>" target="_blank"><?=$types[$PROFILE["TYPE"]]["PORTAL_REQUIREMENTS"];?></a>
    <?$dataPortalRequirements = ob_get_clean();

    ob_start();?>
    <td width="40%" class="adm-detail-content-cell-l"></td>
    <td width="60%" class="adm-detail-content-cell-r" align="left">
        <a class="adm-btn adm-btn-red" href="/bitrix/tools/data.exportproplus/data_exportproplus.php" target="_blank"><?=( ( ( $PROFILE["TYPE"] != "ozon_api" ) && ( $PROFILE["TYPE"] != "vk_trade" ) && ( $PROFILE["TYPE"] != "fb_trade" ) && ( $PROFILE["TYPE"] != "instagram_trade" ) && ( $PROFILE["TYPE"] != "ok_trade" ) ) ? GetMessage( "DATA_EXPORTPROPLUS_RUN_FILE_EXPORT" ) : GetMessage( "DATA_EXPORTPROPLUS_RUN_FILE_EXPORT_VK" ) )?></a>
        <br/><br/>
        <span class="important-info"><?=( ( ( $PROFILE["TYPE"] != "ozon_api" ) && ( $PROFILE["TYPE"] != "vk_trade" ) && ( $PROFILE["TYPE"] != "fb_trade" ) && ( $PROFILE["TYPE"] != "instagram_trade" ) && ( $PROFILE["TYPE"] != "ok_trade" ) ) ? GetMessage( "DATA_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST" ) : GetMessage( "DATA_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST_VK" ) )?></span>
    </td>
    <?$dataRunNewWindow = ob_get_clean();

    ob_start();?>
    <td width="40%" class="adm-detail-content-cell-l"></td>
    <td width="60%" class="adm-detail-content-cell-r" align="left">
        <a class="adm-btn adm-btn-red" onclick="$( 'input[name=apply]' ).click();"><?=( ( ( $PROFILE["TYPE"] != "ozon_api" ) && ( $PROFILE["TYPE"] != "vk_trade" ) && ( $PROFILE["TYPE"] != "fb_trade" ) && ( $PROFILE["TYPE"] != "instagram_trade" ) && ( $PROFILE["TYPE"] != "ok_trade" ) ) ? GetMessage( "DATA_EXPORTPROPLUS_RUN_FILE_EXPORT" ) : GetMessage( "DATA_EXPORTPROPLUS_RUN_FILE_EXPORT_VK" ) )?></a>
        <br/><br/>
        <span class="important-info"><?=( ( ( $PROFILE["TYPE"] != "ozon_api" ) && ( $PROFILE["TYPE"] != "vk_trade" ) && ( $PROFILE["TYPE"] != "fb_trade" ) && ( $PROFILE["TYPE"] != "instagram_trade" ) && ( $PROFILE["TYPE"] != "ok_trade" ) ) ? GetMessage( "DATA_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST" ) : GetMessage( "DATA_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST_VK" ) )?></span>
    </td>
    <?$dataRunCron = ob_get_clean();

    ob_start();?>
    <div class="adm-info-message"><?=( ( ( $PROFILE["TYPE"] != "ozon_api" ) && ( $PROFILE["TYPE"] != "vk_trade" ) && ( $PROFILE["TYPE"] != "fb_trade" ) && ( $PROFILE["TYPE"] != "instagram_trade" ) && ( $PROFILE["TYPE"] != "ok_trade" ) ) ? GetMessage( "DATA_EXPORTPROPLUS_RUNTYPE_INFO" ) : GetMessage( "DATA_EXPORTPROPLUS_RUNTYPE_INFO_VK" ) )?></div>
    <?$dataTypeRunInfo = ob_get_clean();

    ob_start();
    $encoding = $siteEncoding[SITE_CHARSET] == "utf8" ? "utf-8" : $siteEncoding[SITE_CHARSET];
    echo "<pre>", htmlspecialchars( $types[$PROFILE["TYPE"]]["EXAMPLE"], ENT_COMPAT | ENT_HTML401, $encoding ), "</pre>";
    $data6 = ob_get_clean();

    ob_start();
    echo $types[$PROFILE["TYPE"]]["SCHEME_DESCRIPTION"];
    $data7 = ob_get_clean();

    ob_start();
    echo $types[$PROFILE["TYPE"]]["SCHEME_OFFER_DESCRIPTION"];
    $data8 = ob_get_clean();

    $APPLICATION->RestartBuffer();

    $upFieldList = array(
        array(
            "id"   => "#scheme_format",
            "html" => $data1
        ),
        array(
            "id"   => "#scheme_offer",
            "html" => $data2
        ),
        array(
            "id"   => "#scheme_category",
            "html" => $data3
        ),
        array(
            "id"   => "#scheme_currency",
            "html" => $data4
        ),
        array(
            "id"   => "#fieldset-container",
            "html" => $data5
        ),
        array(
            "id"   => "#step3 #portal_requirements",
            "html" => $dataPortalRequirements
        ),
        array(
            "id"   => "#step3 #description",
            "html" => $data6
        ),
        array(
            "id"   => "#scheme_main_add_descr",
            "html" => $data7
        ),
        array(
            "id"   => "#scheme_main_add_offer_descr",
            "html" => $data8
        ),
    );

    if( strlen( $profileCode ) > 0 ){
        $upFieldList[] = array(
            "id"   => "#profile_name",
            "html" => $dataProfileName
        );

        $upFieldList[] = array(
            "id"   => "#profile_code",
            "html" => $dataProfileCode
        );

        $upFieldList[] = array(
            "id"   => "#export_file_path",
            "html" => $exportFilePath
        );
    }

    if( $PROFILE["TYPE"] == "advantshop" ){
        $upFieldList[] = array(
            "id"   => "#tr_type_file",
            "html" => $advantShopFilePathArea
        );
    }

    if( ( $PROFILE["TYPE"] == "ozon_api" ) || ( $PROFILE["TYPE"] == "vk_trade" ) || ( $PROFILE["TYPE"] == "fb_trade" ) || ( $PROFILE["TYPE"] == "instagram_trade" ) || ( $PROFILE["TYPE"] == "ok_trade" ) ){
        $upFieldList[] = array(
            "id"   => "#tr_type_file",
            "html" => "<td colspan=\"2\"></td>"
        );
        $upFieldList[] = array(
            "id"   => "#check_compress_block",
            "html" => "<td colspan=\"2\"></td>"
        );
        $upFieldList[] = array(
            "id"   => "#tr_file_export",
            "html" => "<td colspan=\"2\"></td>"
        );
        $upFieldList[] = array(
            "id"   => "#tr_run_new_window",
            "html" => $dataRunNewWindow
        );
        $upFieldList[] = array(
            "id"   => "#tr_run_new_window_cron",
            "html" => $dataRunCron
        );
        $upFieldList[] = array(
            "id"   => "#tr_type_run_info",
            "html" => $dataTypeRunInfo
        );
    }?>
    <?echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => $upFieldList
        )
    );
    die();
}

function catalog_only(){
    change_site();
}

function include_subsection(){
    global $PROFILE;
    change_iblock( $PROFILE["CHECK_INCLUDE"] == "Y" );
}

function use_offers(){
    change_site();
}

function change_site(){
    global $APPLICATION;
    global $PROFILE;

    $profile = new CExportproplusProfile();
    $ibtypes = $profile->GetIBlockTypes(
        $PROFILE["LID"],
        $PROFILE["VIEW_CATALOG"] == "Y",
        false
    );

    $dbSite = CSite::GetList(
        $by = "sort",
        $order = "asc",
        array(
            "ACTIVE" => "Y",
            "LID"    => $PROFILE["LID"],
        )
    );

    $arProcessSite = array();
    if( $arSite = $dbSite->Fetch() ){
        $arProcessSite = $arSite;
    }

    ob_start();?>
    <select multiple="multiple" name="PROFILE[IBLOCK_TYPE_ID][]">
        <?foreach( $ibtypes as $id => $type ){?>
            <?$selected = in_array( $id, $PROFILE["IBLOCK_TYPE_ID"] ) ? 'selected="selected"' : ""?>
            <option value="<?=$id?>" <?=$selected?>><?=$type["NAME"]?></option>
        <?}?>
    </select>
    <?$data1 = ob_get_clean();

    ob_start();?>
    <select multiple="multiple" name="PROFILE[IBLOCK_ID][]">
        <?foreach( $ibtypes as $type ){
            if( !in_array( $type["ID"], $PROFILE["IBLOCK_TYPE_ID"] ) ) continue;
            foreach( $type["IBLOCK"] as $id => $iblock ){
                $selected = "";
                if( in_array( $id, $PROFILE["IBLOCK_ID"] ) ){
                    $selected = 'selected="selected"';
                    $ibnew[] = $id;
                }?>
                <option value="<?=$id?>" <?=$selected?>><?=$iblock?></option>
            <?
            }
        }?>
    </select>
    <?$data2 = ob_get_clean();

    $sections = $profile->GetSections(
        $ibnew,
        $PROFILE["CHECK_INCLUDE"] == "Y"
    );

    ob_start();
    if( !empty( $sections ) ){
        foreach( $sections as $depth )
            foreach( $depth as $id => $section )
                $sect[$id] = $section;

        asort( $sect );?>
        <select multiple="multiple" name="PROFILE[CATEGORY][]">
            <?foreach( $sect as $id => $section ){?>
                <?$selected = in_array( $id, $PROFILE["CATEGORY"] ) ? 'selected="selected"' : ""?>
                <option value="<?=$id?>" <?=$selected?>><?=$section["NAME"]?></option>
            <?}?>
        </select>
    <?
    }
    $data3 = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "site"   => array(
                "NAME"        => $arProcessSite["NAME"],
                "SITE_NAME"   => $arProcessSite["SITE_NAME"],
                "SERVER_NAME" => $arProcessSite["SERVER_NAME"]
            ),
            "blocks" => array(
                array(
                    "id"   => "#ibtype_select_block",
                    "html" => $data1
                ),
                array(
                    "id"   => "#iblock_select_block",
                    "html" => $data2
                ),
                array(
                    "id"   => "#section_select_block",
                    "html" => $data3
                )
            )
        )
    );
    die();
}

function change_ibtype(){
    global $APPLICATION;
    global $PROFILE;

    $profile = new CExportproplusProfile();
    $ibtypes = $profile->GetIBlockTypes(
        $PROFILE["LID"],
        $PROFILE["VIEW_CATALOG"] == "Y",
        false
    );

    ob_start();?>
    <select multiple="multiple" name="PROFILE[IBLOCK_ID][]">
        <?foreach( $ibtypes as $type ){
            if( !in_array( $type["ID"], $PROFILE["IBLOCK_TYPE_ID"] ) ) continue;
            foreach( $type["IBLOCK"] as $id => $iblock ){
                $selected = in_array( $id, $PROFILE["IBLOCK_ID"] ) ? 'selected="selected"' : ""?>
                <option value="<?=$id?>" <?=$selected?>><?=$iblock?></option>
            <?
            }
        }?>
    </select>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => array(
                array(
                    "id"   => "#iblock_select_block",
                    "html" => $data
                )
            )
        )
    );
    die();
}

function change_iblock( $changeType = false ){
    global $APPLICATION;
    global $PROFILE;

    $profile = new CExportproplusProfile();
    $sections = $profile->GetSections(
        $PROFILE["IBLOCK_ID"],
        $PROFILE["CHECK_INCLUDE"] == "Y"
    );

    ob_start();?>
    <select multiple="multiple" name="PROFILE[CATEGORY][]" class="category_select">
        <?if( !empty( $sections ) ){
            foreach( $sections as $depth ){
                foreach( $depth as $id => $section ){
                    $sect[$id] = $section;
                }
            }

            asort( $sect );?>
            <?foreach( $sect as $id => $section ){?>
                <?$selected = ( isset( $PROFILE["CATEGORY"] ) && in_array( $id, $PROFILE["CATEGORY"] ) ) ? 'selected="selected"' : "";?>
                <?$selected = ( isset( $PROFILE["CATEGORY"] ) && in_array( $section["PARENT_1"], $PROFILE["CATEGORY"] ) ) && $changeType ? 'selected="selected"' : $selected;?>
                <option value="<?=$id?>" <?=$selected?>><?=$section["NAME"]?></option>
            <?}
        }?>
    </select>
    <?$data = ob_get_clean();

    $APPLICATION->RestartBuffer();
    echo Bitrix\Main\Web\Json::encode(
        array(
            "result" => "ok",
            "blocks" => array(
                array(
                    "id"   => "#section_select_block",
                    "html" => $data
                )
            )
        )
    );
    die();
}

function is_url_used(){
  global $APPLICATION;
  $arResult = array('result'=>'ok');
  $strUrl = $_REQUEST['url'];
  $intProfileID = IntVal($_REQUEST['id']);
	$SQL = 'SELECT `ID`,`SETUP` FROM `data_exportproplus_profile` WHERE `ID`<>'.$intProfileID.';';
	$resProfiles = $GLOBALS['DB']->Query($SQL);
	while($arProfile = $resProfiles->GetNext()){
		$arProfileSetup = unserialize(base64_decode($arProfile['~SETUP']));
		if(is_array($arProfileSetup) && ToLower($arProfileSetup['URL_DATA_FILE'])==ToLower($strUrl)){
      $arResult['result'] = 'no';
      $arResult['profile_id'] = $arProfile['ID'];
		}
	}
  $APPLICATION->RestartBuffer();
  echo Bitrix\Main\Web\Json::encode($arResult);
  die();
}
