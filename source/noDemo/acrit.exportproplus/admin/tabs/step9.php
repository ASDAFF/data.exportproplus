<?php
require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
IncludeModuleLangFile(__FILE__);

$exportTimeStamp = false;
if( !empty( $arProfile["SETUP"]["URL_DATA_FILE"] )
    || ( $arProfile["TYPE"] != "ozon_api" )
    || ( $arProfile["TYPE"] != "vk_trade" )
    || ( $arProfile["TYPE"] != "fb_trade" )
    || ( $arProfile["TYPE"] != "instagram_trade" )
    || ( $arProfile["TYPE"] != "ok_trade" ) ){
        $exportTimeStamp = MakeTimeStamp( $arProfile["SETUP"]["LAST_START_EXPORT"] );
        $profileTimeStamp = MakeTimeStamp( $arProfile["TIMESTAMP_X"], "YYYY-MM-DD HH:MI:SS" );
}

$arPhpPaths = CAcritExportproplusTools::GetPotentialPhpPaths();

$bHasFeedProfile = false;
switch( $arProfile["TYPE"] ){
    case "ym_audiobook":
    case "ym_book":
    case "ym_clothes":
    case "ym_cosmetics":
    case "ym_dynamic_simple":
    case "ym_dynamic_vendor_model":
    case "ym_event_ticket":
    case "ym_medicine":
    case "ym_realty":
    case "ym_simple":
    case "ym_simple_csv":
    case "ym_tour":
    case "ym_vendor_model":
        $bHasFeedProfile = true;
        $sFeedProfile = "YANDEX";
        break;
    case "google":
    case "google_online":
        $bHasFeedProfile = true;
        $sFeedProfile = "GOOGLE";
        break;
    case "price_ru":
        $bHasFeedProfile = true;
        $sFeedProfile = "PRICERU";
        break;
    case "aport":
        $bHasFeedProfile = true;
        $sFeedProfile = "APORT";
        break;
    case "mailru":
    case "mailru_clothing":
        $bHasFeedProfile = true;
        $sFeedProfile = "MAIL";
        break;
    case "ua_nadavi_net":
        $bHasFeedProfile = true;
        $sFeedProfile = "NADAVI_NET";
        break;
    case "sravni_com":
        $bHasFeedProfile = true;
        $sFeedProfile = "SRAVNI_COM";
        break;
    default:
        break;
}

if( strlen( $profileDefaults["PROFILE_CODE"] ) > 0 ){
    $exportFilePath = "/acrit.exportproplus/".$profileDefaults["PROFILE_CODE"].".xml";
}

$bUseCompress = $arProfile["USE_COMPRESS"] == "Y" ? 'checked="checked"' : "";

$bPhpShortOpenTag = ini_get( "short_open_tag" );
$bPhpShortOpenTagError = ( !$bPhpShortOpenTag && ( stripos( $arProfile["SETUP"]["CRON_OPTIONS"]["PHP"], "short_open_tag" ) === false ) ) ? true : false;

if( $arProfile["USE_COMPRESS"] == "Y" ){
    $originalName = $_SERVER["DOCUMENT_ROOT"].$arProfile["SETUP"]["URL_DATA_FILE"];

    $zipPath = false;
    $fileZipPath = false;
    if( stripos( $arProfile["SETUP"]["URL_DATA_FILE"], "csv" ) !== false ){
        $zipPath = str_replace( "csv", "zip", $originalName );
        $fileZipPath = str_replace( "csv", "zip", $arProfile["SETUP"]["URL_DATA_FILE"] );
    }
    elseif( stripos( $arProfile["SETUP"]["URL_DATA_FILE"], "xml" ) !== false ){
        $zipPath = str_replace( "xml", "zip", $originalName );
        $fileZipPath = str_replace( "xml", "zip", $arProfile["SETUP"]["URL_DATA_FILE"] );
    }

    if( $zipPath ){
        $packarc = CBXArchive::GetArchive( $zipPath );
    }
}

$bSocialExport = ( ( $arProfile["TYPE"] == "ozon_api" ) || ( $arProfile["TYPE"] == "vk_trade" ) || ( $arProfile["TYPE"] == "fb_trade" ) || ( $arProfile["TYPE"] == "instagram_trade" ) || ( $arProfile["TYPE"] == "ok_trade" ) ) ? true : false;
$productsPerStep = ( intval( $arProfile["SETUP"]["EXPORT_STEP"] ) <= 0 ) ? ( ( $bSocialExport ) ? 3 : 50 ) : intval( $arProfile["SETUP"]["EXPORT_STEP"] );

if( !isset( $arProfile["SETUP"]["CRON"] ) ){
    $arProfile["SETUP"]["CRON"] = array();
    if( isset( $arProfile["SETUP"]["IS_PERIOD"] ) && isset( $arProfile["SETUP"]["DAT_START"] ) && isset( $arProfile["SETUP"]["PERIOD"] ) && isset( $arProfile["SETUP"]["THREADS"] ) ){
        $arAgentData = array();
        $arAgentData["IS_PERIOD"] = $arProfile["SETUP"]["IS_PERIOD"];
        $arAgentData["DAT_START"] = $arProfile["SETUP"]["DAT_START"];
        $arAgentData["PERIOD"] = $arProfile["SETUP"]["PERIOD"];
        $arAgentData["THREADS"] = $arProfile["SETUP"]["THREADS"];
        $arProfile["SETUP"]["CRON"][] = $arAgentData;

        unset( $arProfile["SETUP"]["IS_PERIOD"] );
        unset( $arProfile["SETUP"]["DAT_START"] );
        unset( $arProfile["SETUP"]["PERIOD"] );
        unset( $arProfile["SETUP"]["THREADS"] );
    }
}

$intUrlUsed = false;
$SQL = 'SELECT `ID`,`SETUP` FROM `acrit_exportproplus_profile` WHERE `ID`<>'.IntVal($arProfile['ID']).';';
$resDbProfiles = $GLOBALS['DB']->Query($SQL);
while($arDbProfile = $resDbProfiles->GetNext()){
  $arProfileSetup = unserialize(base64_decode($arDbProfile['~SETUP']));
  if(is_array($arProfileSetup) && ToLower($arProfileSetup['URL_DATA_FILE'])==ToLower($arProfile["SETUP"]["URL_DATA_FILE"])){
    $intUrlUsed = $arDbProfile['ID'];
    break;
  }
}

$bHasVkCategories = ( isset( $arProfile["MARKET_CATEGORY"]["VK"]["CATEGORY_LIST"] ) && !empty( $arProfile["MARKET_CATEGORY"]["VK"]["CATEGORY_LIST"] ) ) ? true : false;
if( !$bSocialExport ){?>
    <tr class="heading" align="center">
        <td colspan="2"><?=GetMessage( "ACRIT_EXPORTPROPLUS_PROTECT_FIELDSET_HEADER" )?></td>
    </tr>
    <tr align="center">
        <td colspan="2">
            <?=BeginNote();?>
            <?=GetMessage( "ACRIT_EXPORTPROPLUS_PROTECT_FIELDSET_DESCRIPTION" )?>
            <?=EndNote();?>
        </td>
    </tr>
    <tr align="center">
        <td colspan="2">
            <table cellpadding="2" cellspacing="0" border="0" align="center" width="100%">
                <tr align="center">
                    <td width="50%" align="right">
                        <span id="hint_PROFILE[SETUP][EXPORT_LOGIN]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][EXPORT_LOGIN]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_SETUP_EXPORT_LOGIN_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][EXPORT_LOGIN]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_SETUP_EXPORT_LOGIN_FIELDSET" )?></label>
                    </td>
                    <td width="50%" align="left">
                        <input type="text" name="PROFILE[SETUP][EXPORT_LOGIN]" value="<?=$arProfile["SETUP"]["EXPORT_LOGIN"]?>" size="20" autocomplete="off">
                    </td>
                </tr>
                <tr align="center">
                    <td width="50%" align="right">
                        <span id="hint_PROFILE[SETUP][EXPORT_PASSWORD]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][EXPORT_PASSWORD]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_SETUP_EXPORT_PASSWORD_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][EXPORT_PASSWORD]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_SETUP_EXPORT_PASSWORD_FIELDSET" )?></label>
                    </td>
                    <td width="50%" align="left">
                        <input type="password" name="PROFILE[SETUP][EXPORT_PASSWORD]" value="<?=$arProfile["SETUP"]["EXPORT_PASSWORD"]?>" size="20" autocomplete="off">
                    </td>
                </tr>
                <tr align="center">
                    <td width="50%" align="right">
                        <span id="hint_PROFILE[SETUP][EXPORT_PASSWORD_CONFIRM]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][EXPORT_PASSWORD_CONFIRM]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_SETUP_EXPORT_PASSWORD_CONFIRM_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][EXPORT_PASSWORD_CONFIRM]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_SETUP_EXPORT_PASSWORD_CONFIRM_FIELDSET" )?></label>
                    </td>
                    <td width="50%" align="left">
                        <input type="password" name="PROFILE[SETUP][EXPORT_PASSWORD_CONFIRM]" value="<?=$arProfile["SETUP"]["EXPORT_PASSWORD_CONFIRM"]?>" size="20" autocomplete="off">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr class="heading">
        <td colspan="2" valign="top"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_RUN" )?></td>
    </tr>
<?}?>
<tr>
    <td width="40%">
        <span id="hint_PROFILE[SETUP][EXPORT_STEP]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][EXPORT_STEP]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_EXPORTP_STEP_HELP" );?>' );</script>
        <label for="PROFILE[SETUP][EXPORT_STEP]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_EXPORTP_STEP" )?></label>
    </td>
    <td width="60%" id="export_step_block">
        <?if( intval( $arProfile["ID"] ) > 0 ){?>
            <div style="float: left;">
                <input type="text" name="PROFILE[SETUP][EXPORT_STEP]" id="export_step_value" value="<?=$productsPerStep;?>">
            </div>
            <div style="margin-top: -3px;">
                <a class="adm-btn adm-btn-save" onclick="CalcExportStep( <?=$arProfile["ID"];?> )"><?=GetMessage( "ACRIT_EXPORTPROPLUS_EXPORTP_STEP_CALC" )?></a>
            </div>
            <div style="clear: both"></div>
        <?}
        else{?>
            <input type="text" name="PROFILE[SETUP][EXPORT_STEP]" id="export_step_value" value="<?=$productsPerStep;?>" <?if( $arProfile["SETUP"]["FILE_TYPE"] == "csv" ):?>disabled="disabled"<?endif;?>>
        <?}?>
        <br/>
        <div style="float: left;">
            <b><?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES13" );?> <div id="threads_recomendation"> *** </div></b>
        </div>
        <div style="margin-top: -3px;">
            <a class="adm-btn adm-btn-save" onclick="CalcExportThreads( <?=$arProfile["ID"];?> )"><?=GetMessage( "ACRIT_EXPORTPROPLUS_EXPORTP_STEP_CALC" )?></a>
        </div>
        <div style="clear: both"></div>
    </td>
</tr>
<tr id="file_setting" style="display: table-row">
    <td colspan="2" align="center">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <?
                $sFeedLink = trim( GetMessage( "ACRIT_EXPORTPROPLUS_".$sFeedProfile."_ADD_LINK" ) );
                if( $bHasFeedProfile
                    && ( strlen( $sFeedLink ) > 0 )
                ){?>
                    <tr>
                        <td width="40%" class="adm-detail-content-cell-l"></td>
                        <td width="60%" class="adm-detail-content-cell-r" align="left">
                            <span id="hint_OPEN_FEED_ADD_LINK"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_OPEN_FEED_ADD_LINK' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OPEN_FEED_ADD_LINK_HELP" )?>' );</script>
                            <a href="<?=$sFeedLink?>" target="_blank"><?=GetMessage( "ACRIT_EXPORTPROPLUS_FEED_ADD_LINK" )?></a>
                        </td>
                    </tr>
                <?}?>
                <tr>
                    <td colspan="2" align="center">
                        <?=BeginNote();?>
                        <?=GetMessage( "ACRIT_EXPORTPROPLUS_RUN_EXPORT_FILE_DESCRIPTION" );?>
                        <?=EndNote();?>
                    </td>
                </tr>
                <tr id="check_compress_block">
                    <?if( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ){?>
                        <td width="40%" class="adm-detail-content-cell-l">
                            <span id="hint_PROFILE[USE_COMPRESS]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[USE_COMPRESS]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_USE_COMPRESS_HELP" );?>' );</script>
                            <label for="PROFILE[USE_COMPRESS]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_USE_COMPRESS" );?></label>
                        </td>
                        <td width="60%" class="adm-detail-content-cell-r"><input type="checkbox" name="PROFILE[USE_COMPRESS]" value="Y" <?=$bUseCompress?>></td>
                    <?}
                    else{?>
                        <td colspan="2"></td>
                    <?}?>
                </tr>
                <?if( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ){?>
                    <tr id="tr_file_export">
                        <td width="40%" class="adm-detail-content-cell-l">
                            <span id="hint_PROFILE[SETUP][URL_DATA_FILE]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][URL_DATA_FILE]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_FILENAME_HELP" )?>' );</script>
                            <?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_FILENAME" )?>
                        </td>
                        <td width="60%" class="adm-detail-content-cell-r" id="export_file_path">
                            <?if( strlen( $types[$arProfile["TYPE"]]["PORTAL_VALIDATOR"] ) > 0 ){?>
                                <div style="float: left;">
                                    <input type="text" name="PROFILE[SETUP][URL_DATA_FILE]" size="30" id="URL_DATA_FILE" value="<?=( strlen( $arProfile["SETUP"]["URL_DATA_FILE"] ) > 0 ) ? $arProfile["SETUP"]["URL_DATA_FILE"] : $exportFilePath;?>">
                                    <input type="button" value="..." onclick="BtnClick()">
                                </div>
                                <div style="padding: 5px 0px 0px 300px;">
                                    <a href="<?=$types[$arProfile["TYPE"]]["PORTAL_VALIDATOR"];?>" target="_blank"><?=$types[$arProfile["TYPE"]]["PORTAL_VALIDATOR"];?></a>
                                </div>
                                <div style="clear: both;"></div>
                            <?}
                            else{?>
                                <input type="text" name="PROFILE[SETUP][URL_DATA_FILE]" size="30" id="URL_DATA_FILE" value="<?=( strlen( $arProfile["SETUP"]["URL_DATA_FILE"] ) > 0 ) ? $arProfile["SETUP"]["URL_DATA_FILE"] : $exportFilePath;?>">
                                <input type="button" value="..." onclick="BtnClick()">
                            <?}?>
                            <div id="URL_DATA_FILE_used" data-profile-id="<?=$arProfile['ID'];?>" style="color:red; <?if($intUrlUsed===false):?>display:none;<?endif?>"><?=GetMessage('ACRIT_EXPORTPROPLUS_RUNTYPE_FILENAME_USED',array('#ID#'=>IntVal($intUrlUsed)));?></div>
                        </td>
                    </tr>
                    <tr id="tr_type_file">
                        <?if( ( $arProfile["TYPE"] != "advantshop" ) ){?>
                            <td width="40%" class="adm-detail-content-cell-l">
                                <span id="hint_PROFILE[SETUP][FILE_TYPE]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][FILE_TYPE]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_FILE_TYPE_HELP" )?>' );</script>
                                <label for="PROFILE[SETUP][FILE_TYPE]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_FILE_TYPE" )?></label>
                            </td>
                            <td width="60%" class="adm-detail-content-cell-r">
                                <?if( empty( $arProfile["SETUP"]["FILE_TYPE"] ) )
                                    $arProfile["SETUP"]["FILE_TYPE"] = "xml";

                                foreach( $obProfileUtils->GetFileExportType() as $type ){
                                    $checked = ( $type == $arProfile["SETUP"]["FILE_TYPE"] ) ? 'checked="checked"' : ""?>
                                    <input type="radio" name="PROFILE[SETUP][FILE_TYPE]" value="<?=$type?>" <?=$checked?> onchange="ChangeFileType( this.value )"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_FILE_".strtoupper( $type ) )?>
                                <?}?>
                            </td>
                        <?}
                        else{?>
                            <td colspan="2">
                                <input type="hidden" name="PROFILE[SETUP][FILE_TYPE]" value="csv" />
                            </td>
                        <?}?>
                    </tr>
                <?}?>
                <tr id="tr_type_run">
                    <td width="40%" class="adm-detail-content-cell-l">
                        <span id="hint_PROFILE[SETUP][TYPE_RUN]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][TYPE_RUN]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_TYPE_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][TYPE_RUN]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_TYPE" )?></label>
                    </td>
                    <td width="60%" class="adm-detail-content-cell-r">
                        <?if( empty( $arProfile["SETUP"]["TYPE_RUN"] ) )
                            $arProfile["SETUP"]["TYPE_RUN"] = "comp";

                        foreach( $obProfileUtils->GetRunType() as $type ){
                            $checked = ($type == $arProfile["SETUP"]["TYPE_RUN"]) ? 'checked="checked"' : "" ?>
                            <input type="radio" name="PROFILE[SETUP][TYPE_RUN]" value="<?=$type?>" <?=$checked?> onchange="ChangeRunType(this.value)"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_".strtoupper( $type ) )?>
                        <?}?>
                    </td>
                </tr>
                <?
                $hideRunNewWindow = "hide";
                if( $arProfile["SETUP"]["TYPE_RUN"] != "cron" ){
                    $hideCronTable = "hide";
                    $hideCronInfo = "hide";
                    $hideCronPhp = "hide";
                    $hideCompThreads = "";
                    $hideRunNewWindow = "";
                }
                else{
                    if( $arProfile["SETUP"]["CRON_OPTIONS"]["MODE"] != "php" ){
                        $hideCronPhp = "hide";
                    }
                    $hideCompThreads = "hide";
                }

                if( file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/acrit.exportproplus/export_{$arProfile["ID"]}_run.lock" ) )
                    $hideRunNewWindow = "hide";
                ?>
                <tr id="tr_comp_threads" class="<?=$hideCompThreads;?>">
                    <td width="40%" class="adm-detail-content-cell-l">
                        <span id="hint_PROFILE[SETUP][THREADS]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][THREADS]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_THREADS_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][THREADS]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_THREADS" )?></label>
                    </td>
                    <td width="60%" class="adm-detail-content-cell-r">
                        <input type="text" name="PROFILE[SETUP][THREADS]" value="<?=intval( $arProfile["SETUP"]["THREADS"] ) > 0 ? $arProfile["SETUP"]["THREADS"] : 1?>" size="20">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <?=BeginNote();?>
                        <?=GetMessage( "ACRIT_TIME_ZONES_DIFF_DATE" );?>
                        <?=EndNote();?>
                    </td>
                </tr>
                <tr>
                    <td width="40%" class="adm-detail-content-cell-l">
                        <span id="hint_PROFILE[SETUP][LAST_START_EXPORT]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][LAST_START_EXPORT]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_LSATSTART_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][LAST_START_EXPORT]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_LSATSTART" )?></label>
                    </td>
                    <td width="60%" class="adm-detail-content-cell-r">
                        <input type="text" name="PROFILE[SETUP][LAST_START_EXPORT]" readonly="readonly" placeholder=".. ::" value="<?=$arProfile["SETUP"]["LAST_START_EXPORT"]?>">
                    </td>
                </tr>
                <tr id="tr_cron_next_run" class="<?=$hideCronTable?>">
                    <td width="40%" class="adm-detail-content-cell-l">
                        <span id="hint_PROFILE[SETUP][NEXT_START_EXPORT]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][NEXT_START_EXPORT]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_NEXTSTART_HELP" )?>' );</script>
                        <label for="PROFILE[SETUP][NEXT_START_EXPORT]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_NEXTSTART" )?></label>
                    </td>
                    <td width="60%" class="adm-detail-content-cell-r">
                        <input type="text" name="PROFILE[SETUP][NEXT_START_EXPORT]" readonly="readonly" placeholder=".. ::" value="<?=CExportproplusAgent::GetNextAgentTime( $arProfile["ID"] );?>">
                    </td>
                </tr>
                <?if( file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/acrit.exportproplus/export_{$arProfile["ID"]}_run.lock" ) ):?>
                    <tr id="unlock-container">
                        <td>
                            <?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_EXPORT_RUN" );?>
                        </td>
                        <td>
                            <a class="adm-btn adm-btn-save" onclick="UnlockExport( <?=$arProfile["ID"]?> )"><?=getMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_UNLOCK" )?></a>
                        </td>
                    </tr>
                <?endif?>
                <?if( file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/acrit.exportproplus/export_{$arProfile["ID"]}_run.unlock" ) ){?>
                    <tr id="unlock-container">
                        <td colspan="2" align="center">
                            <?CAdminMessage::ShowMessage(
                                array(
                                    "MESSAGE" => GetMessage( "ACRIT_EXPORTPROPLUS_EXPORT_UNLOCK" ),
                                    "TYPE"    => "OK",
                                    "HTML"    => "TRUE"
                                )
                            );?>
                            <a class="adm-btn adm-btn-save" onclick="ClearExportData( <?=$arProfile["ID"]?> );"><?=GetMessage( "ACRIT_EXPORTPROPLUS_EXPORT_UNLOCK_PAGE_CLEAR_SESSION" )?></a>
                            <a class="adm-btn adm-btn-save" onclick="window.location='acrit_exportproplus_edit.php?ID=<?=$arProfile["ID"]?>'"><?=GetMessage( "ACRIT_EXPORTPROPLUS_EXPORT_UNLOCK_PAGE_REFRESH" )?></a>
                        </td>
                    </tr>
                <?}?>
                <?if( !file_exists( $_SERVER["DOCUMENT_ROOT"]."/bitrix/tools/acrit.exportproplus/export_{$arProfile["ID"]}_run.unlock" ) ){?>
                    <tr id="tr_run_new_window" class="<?=$hideRunNewWindow?>">
                        <td width="40%" class="adm-detail-content-cell-l"></td>
                        <td width="60%" class="adm-detail-content-cell-r" align="left">
                            <a class="adm-btn <?if( $exportTimeStamp > $profileTimeStamp ):?>adm-btn-save<?else:?>adm-btn-red<?endif;?>" href="<?if( !$bHasVkCategories && ( $arProfile["TYPE"] == "vk_trade" ) ):?>javascript:alert( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUN_FILE_EXPORT_VK_NOT_CATEGORIES" );?>' );<?else:?>/bitrix/tools/acrit.exportproplus/acrit_exportproplus.php?ID=<?=$ID?><?endif;?>"<?if( $bHasVkCategories || ( $arProfile["TYPE"] != "vk_trade" ) ):?> target="_blank"<?endif;?>><?if( !empty( $arProfile["SETUP"]["URL_DATA_FILE"] ) || ( is_array( $arProfile["VK"]["VK_RELATIONS"] ) && !empty( $arProfile["VK"]["VK_RELATIONS"] ) ) ):?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_RERUN_FILE_EXPORT" ) : GetMessage( "ACRIT_EXPORTPROPLUS_RERUN_FILE_EXPORT_VK" ) )?><?else:?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_RUN_FILE_EXPORT" ) : GetMessage( "ACRIT_EXPORTPROPLUS_RUN_FILE_EXPORT_VK" ) )?><?endif;?></a>
                            <?if( !$exportTimeStamp || ( $exportTimeStamp < $profileTimeStamp ) ){?>
                                <br/><br/>
                                <span class="important-info"><?if( !$exportTimeStamp ):?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST" ) : GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST_VK" ) )?><?elseif( $exportTimeStamp < $profileTimeStamp ):?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NEED_RERUN" ) : GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NEED_RERUN" ) )?><?endif;?></span>
                            <?}?>
                        </td>
                    </tr>
                    <tr id="tr_run_new_window_cron" class="<?=$hideCronInfo?>">
                        <td width="40%" class="adm-detail-content-cell-l"></td>
                        <td width="60%" class="adm-detail-content-cell-r" align="left">
                            <a class="adm-btn <?if( $exportTimeStamp > $profileTimeStamp ):?>adm-btn-save<?else:?>adm-btn-red<?endif;?>" onclick="RunExpressAgent( '<?=$arProfile["ID"];?>' ); alert( '<?=GetMessage( "ACRIT_EXPORTPROPLUS_PROFILE_TEMP_CRON_EXPORT" )?>' );"><?if( !empty( $arProfile["SETUP"]["URL_DATA_FILE"] ) || ( is_array( $arProfile["VK"]["VK_RELATIONS"] ) && !empty( $arProfile["VK"]["VK_RELATIONS"] ) ) ):?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_RERUN_FILE_EXPORT" ) : GetMessage( "ACRIT_EXPORTPROPLUS_RERUN_FILE_EXPORT_VK" ) )?><?else:?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_RUN_FILE_EXPORT" ) : GetMessage( "ACRIT_EXPORTPROPLUS_RUN_FILE_EXPORT_VK" ) )?><?endif;?></a>
                            <?if( !$exportTimeStamp || ( $exportTimeStamp < $profileTimeStamp ) ):?>
                                <br/><br/>
                                <span class="important-info"><?if( !$exportTimeStamp ):?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST" ) : GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NOT_EXIST_VK" ) )?><?elseif( $exportTimeStamp < $profileTimeStamp ):?><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NEED_RERUN" ) : GetMessage( "ACRIT_EXPORTPROPLUS_FILE_EXPORT_NEED_RERUN" ) )?><?endif;?></span>
                            <?endif;?>
                        </td>
                    </tr>
                <?}?>
                <?if( !empty( $arProfile["SETUP"]["URL_DATA_FILE"] ) ):?>
                    <?$urlDataFile = ( $packarc ) ? $fileZipPath : $arProfile["SETUP"]["URL_DATA_FILE"];?>
                    <tr id="tr_open_new_window">
                        <td width="40%" class="adm-detail-content-cell-l"></td>
                        <td width="60%" class="adm-detail-content-cell-r" align="left">
                            <span id="hint_OPEN_INNEW_WINDOW"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_OPEN_INNEW_WINDOW' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_OPEN_INNEW_WINDOW_HELP" )?>' );</script>

                            <a href="<?=$urlDataFile?>" target="_blank"><?=GetMessage( "ACRIT_EXPORTPROPLUS_OPEN_INNEW_WINDOW" )?></a>
                        </td>
                    </tr>
                <?endif?>

                <?if( is_array( $arProfile["SETUP"]["CRON"] ) ){?>
                    <tr id="tr_cron_task_options_mode" class="<?=$hideCronTable?>">
                        <td width="40%" class="adm-detail-content-cell-l">
                            <span id="hint_PROFILE[SETUP][CRON_OPTIONS][MODE]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][CRON_OPTIONS][MODE]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_MODE_HELP" )?>' );</script>
                            <label for="PROFILE[SETUP][CRON_OPTIONS][MODE]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_MODE" )?></label>
                        </td>
                        <td width="60%" class="adm-detail-content-cell-r">
                            <?if( empty( $arProfile["SETUP"]["CRON_OPTIONS"]["MODE"] ) )
                                $arProfile["SETUP"]["CRON_OPTIONS"]["MODE"] = "php";

                            foreach( $obProfileUtils->GetCronTaskMode() as $mode ){
                                $checked = ( $mode == $arProfile["SETUP"]["CRON_OPTIONS"]["MODE"] ) ? 'checked="checked"' : ""?>
                                <input type="radio" name="PROFILE[SETUP][CRON_OPTIONS][MODE]" value="<?=$mode?>" <?=$checked?> onchange="ChangeCronMode( this.value )"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_MODE_".strtoupper( $mode ) )?>
                            <?}?>
                        </td>
                    </tr>
                    <?if( $bPhpShortOpenTagError ){?>
                        <tr id="tr_cron_task_options_shorttag_php" class="<?=$hideCronPhp?>">
                            <td colspan="2" align="center">
                                <?=BeginNote();?>
                                <?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_SHORTTAG_PHP" );?>
                                <?=EndNote();?>
                            </td>
                        </tr>
                    <?}?>
                    <?if( is_array( $arPhpPaths ) && !empty( $arPhpPaths ) ){?>
                        <tr id="tr_cron_php_paths" class="<?=$hideCronPhp?>">
                            <td colspan="2" align="center">
                                <?=BeginNote();?>
                                <?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_PHP_PATHS" );?>
                                <?foreach( $arPhpPaths as $phpPathsItem ){
                                    echo $phpPathsItem."<br/>";
                                }?>
                                <?=EndNote();?>
                            </td>
                        </tr>
                    <?}?>
                    <tr id="tr_cron_task_options_php" class="<?=$hideCronPhp?>">
                        <td width="40%" class="adm-detail-content-cell-l">
                            <span id="hint_PROFILE[SETUP][CRON_OPTIONS][PHP]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][CRON_OPTIONS][PHP]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_PHP_HELP" )?>' );</script>
                            <label for="PROFILE[SETUP][CRON_OPTIONS][PHP]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_CRON_PHP" )?></label>
                        </td>
                        <td width="60%" class="adm-detail-content-cell-r">
                            <?if( empty( $arProfile["SETUP"]["CRON_OPTIONS"]["PHP"] ) )
                                $arProfile["SETUP"]["CRON_OPTIONS"]["PHP"] = "php";?>

                            <input type="text" name="PROFILE[SETUP][CRON_OPTIONS][PHP]" value="<?=$arProfile["SETUP"]["CRON_OPTIONS"]["PHP"]?>" >
                        </td>
                    </tr>
                    <tr id="tr_cron_table" class="<?=$hideCronTable?>">
                        <td colspan="2">
                            <table cellpadding="2" cellspacing="0" border="0" class="internal" align="center" width="100%">
                                <thead>
                                    <tr class="heading">
                                        <td align="center">
                                            <span id="hint_PROFILE[SETUP][IS_PERIOD]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][IS_PERIOD]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_IS_PERIOD_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][IS_PERIOD]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_IS_PERIOD" )?></label>
                                        </td>
                                        <td align="center">
                                            <span id="hint_PROFILE[SETUP][DAT_START]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][DAT_START]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_DATESTART_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][DAT_START]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_DATESTART" )?></label><br/>
                                        </td>
                                        <td align="center">
                                            <span id="hint_PROFILE[SETUP][PERIOD]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][PERIOD]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_PERIOD_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][PERIOD]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_PERIOD" )?></label>
                                        </td>
                                        <td align="center">
                                            <span id="hint_PROFILE[SETUP][THREADS]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][THREADS]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_THREADS_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][THREADS]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_THREADS" )?></label>
                                        </td>
                                        <td align="center">
                                            <span id="hint_PROFILE[SETUP][IS_STEP_EXPORT]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][IS_STEP_EXPORT]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_IS_STEP_EXPORT_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][IS_STEP_EXPORT]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_IS_STEP_EXPORT" )?></label>
                                        </td>
                                        <td align="center">
                                            <span id="hint_PROFILE[SETUP][STEP_EXPORT_CNT]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][STEP_EXPORT_CNT]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_STEP_EXPORT_CNT_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][STEP_EXPORT_CNT]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_STEP_EXPORT_CNT" )?></label>
                                        </td>
                                        <td align="center" colspan="2">
                                            <span id="hint_PROFILE[SETUP][MAXIMUM_PRODUCTS]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[SETUP][MAXIMUM_PRODUCTS]' ), '<?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_MAXIMUM_PRODUCTS_HELP" )?>' );</script>
                                            <label for="PROFILE[SETUP][MAXIMUM_PRODUCTS]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_MAXIMUM_PRODUCTS" )?></label>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?foreach( $arProfile["SETUP"]["CRON"] as $cronSetupId => $arCronItem ){?>
                                        <tr data-id="<?=$cronSetupId;?>" profile-id="<?=$arProfile["ID"]?>">
                                            <td align="center">
                                                <input type="checkbox" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][IS_PERIOD]" value="Y" <?=$arProfile["SETUP"]["CRON"][$cronSetupId]["IS_PERIOD"] == "Y" ? 'checked="checked"' : ""?>>
                                            </td>
                                            <td align="center">
                                                <div class="adm-input-wrap adm-input-wrap-calendar">
                                                    <input class="adm-input adm-input-calendar" type="text" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][DAT_START]" size="18" value="<?if( !empty( $arProfile["SETUP"]["CRON"][$cronSetupId]["DAT_START"] ) ):?><?=$arProfile["SETUP"]["CRON"][$cronSetupId]["DAT_START"]?><?else:?><?=date( "d.m.Y H:i:s", time() + 120 );?><?endif;?>">
                                                    <span class="adm-calendar-icon" title="<?=GetMessage( "ACRIT_EXPORTPROPLUS_NAJMITE_DLA_VYBORA_D" )?>" onclick="BX.calendar( { node: this, field: 'PROFILE[SETUP][CRON][<?=$cronSetupId?>][DAT_START]', form: '', bTime: true, bHideTime: false } );"></span>
                                                </div>
                                            </td>
                                            <td align="center">
                                                <input type="text" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][PERIOD]" value="<?if( !empty( $arProfile["SETUP"]["CRON"][$cronSetupId]["PERIOD"] ) ):?><?=$arProfile["SETUP"]["CRON"][$cronSetupId]["PERIOD"]?><?else:?>1440<?endif;?>" size="20">
                                            </td>
                                            <td align="center">
                                                <input type="text" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][THREADS]" value="<?=intval( $arProfile["SETUP"]["CRON"][$cronSetupId]["THREADS"] ) > 0 ? $arProfile["SETUP"]["CRON"][$cronSetupId]["THREADS"] : 1?>" size="20">
                                            </td>
                                            <td align="center">
                                                <input type="checkbox" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][IS_STEP_EXPORT]" value="Y" <?=$arProfile["SETUP"]["CRON"][$cronSetupId]["IS_STEP_EXPORT"] == "Y" ? 'checked="checked"' : ""?> >
                                            </td>
                                            <td align="center">
                                                <input type="text" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][STEP_EXPORT_CNT]" value="<?if( !empty( $arProfile["SETUP"]["CRON"][$cronSetupId]["STEP_EXPORT_CNT"] ) ):?><?=$arProfile["SETUP"]["CRON"][$cronSetupId]["STEP_EXPORT_CNT"]?><?else:?>20<?endif;?>" size="20">
                                            </td>
                                            <td align="center">
                                                <input type="text" name="PROFILE[SETUP][CRON][<?=$cronSetupId;?>][MAXIMUM_PRODUCTS]" value="<?if( !empty( $arProfile["SETUP"]["CRON"][$cronSetupId]["MAXIMUM_PRODUCTS"] ) ):?><?=$arProfile["SETUP"]["CRON"][$cronSetupId]["MAXIMUM_PRODUCTS"]?><?else:?>0<?endif;?>" size="20">
                                            </td>
                                            <td align="center">
                                                <span class="agent-fieldset-item-delete">&times</span>
                                            </td>
                                        </tr>
                                    <?}?>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                <?}?>
                <tr id="tr_cron_button" class="<?=$hideCronTable?>">
                    <td colspan="2" align="center" id="agent-add-button">
                        <br/><br/>
                        <button class="adm-btn" onclick="AgentFieldsetAdd( this ); return false;">
                            <?=GetMessage( "ACRIT_EXPORTPROPLUS_AGENT_ROW_ADD" )?>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr id="tr_cron_info" class="<?=$hideCronInfo?>">
    <td colspan="2">
        <?=BeginNote();?>
				<?if(!function_exists('exec')):?>
					<?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES_NO_EXEC" );?><br/><br/>
				<?endif?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES0" );?><br/><br/>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES1" );?><br/><br/>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES3" );?>
        <b><?=$_SERVER["DOCUMENT_ROOT"];?>/bitrix/crontab/crontab.cfg</b>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES4" );?><br/><br/>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES5" );?><br/>
        <b>crontab <?=$_SERVER["DOCUMENT_ROOT"];?>/bitrix/crontab/crontab.cfg</b><br/>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES6" );?><br/>
        <b>crontab -l</b><br/>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES7" );?><br/>
        <b>crontab -r</b><br/><br/>

        <?$sCron = CExportproplusAgent::GetCronTasks();?>
        <?if( strlen( $sCron ) > strlen( PHP_EOL ) ){?>
            <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES8" );?><br/>
            <textarea name="crontasks" cols="70" rows="5" wrap="off" readonly>
                <?=htmlspecialcharsbx( $sCron );?>
            </textarea><br/>
        <?}?>
        <?=GetMessage( "ACRIT_EXPORTPROPLUS_CES_NOTES10" );?>
        <?=EndNote();?>
    </td>
</tr>
<tr>
    <td align="center" colspan="2" id="tr_type_run_info">
        <div class="adm-info-message"><?=( ( ( $arProfile["TYPE"] != "ozon_api" ) && ( $arProfile["TYPE"] != "vk_trade" ) && ( $arProfile["TYPE"] != "fb_trade" ) && ( $arProfile["TYPE"] != "instagram_trade" ) && ( $arProfile["TYPE"] != "ok_trade" ) ) ? GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_INFO" ) : GetMessage( "ACRIT_EXPORTPROPLUS_RUNTYPE_INFO_VK" ) )?></div>
    </td>
</tr>
<tr class="heading">
    <td colspan="2"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_STATISTICK" )?></td>
</tr>
<tr id="log_detail">
    <td colspan="2" align="center">
        <table width="30%" border="1">
            <tbody>
                <tr>
                    <td colspan="2" align="center"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ALL" )?></b></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ALL_IB" )?></td>
                    <td width="50%"><?=$arProfile["LOG"]["IBLOCK"]?></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ALL_SECTION" )?></td>
                    <td width="50%"><?=$arProfile["LOG"]["SECTIONS"]?></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ALL_OFFERS" )?></td>
                    <td width="50%"><?=$arProfile["LOG"]["PRODUCTS"]?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_EXPORT" )?></b></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_OFFERS_EXPORT" )?></td>
                    <td width="50%"><?=$arProfile["LOG"]["PRODUCTS_EXPORT"]?></td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ERROR" )?></b></td>
                </tr>
                <tr>
                    <td width="50%"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ERR_OFFERS" )?></td>
                    <td width="50%"><?=$arProfile["LOG"]["PRODUCTS_ERROR"]?></td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>
<tr id="log_detail_file">
    <?if( file_exists( $_SERVER["DOCUMENT_ROOT"].$arProfile["LOG"]["FILE"] ) ):?>
        <td width="50%" style="padding: 15px 0;"><b><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_FILE" )?></b></td>
        <td width="50%"><a href="<?=$arProfile["LOG"]["FILE"]?>" target="_blank" download="export_log"><?=$arProfile["LOG"]["FILE"]?></a></td>
    <?endif?>
</tr>
<tr align="center">
    <td colspan="2">
        <a class="adm-btn adm-btn-save" onclick="UpdateLog( this )" profileID="<?=$arProfile["ID"]?>"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_UPDATE" )?></a>
    </td>
</tr>
<tr class="heading">
    <td colspan="2"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_ALL_STAT" )?></td>
</tr>
<tr>
    <td width="40%" class="adm-detail-content-cell-l">
        <label for="PROFILE[SEND_LOG_EMAIL]"><?=GetMessage( "ACRIT_EXPORTPROPLUS_LOG_SEND_EMAIL" )?></label>
    </td>
    <td width="60%" class="adm-detail-content-cell-r">
        <input type="text" name="PROFILE[SEND_LOG_EMAIL]" placeholder="email@email.com" size="30" value="<?=$arProfile["SEND_LOG_EMAIL"];?>">
    </td>
</tr>

<?CAdminFileDialog::ShowScript(
    array(
        "event" => "BtnClick",
        "arResultDest" => array(
            "FORM_NAME" => "exportproplus_form",
            "FORM_ELEMENT_NAME" => "URL_DATA_FILE"
        ),
        "arPath" => array(
            "SITE" => SITE_ID,
            "PATH" => "/upload"
        ),
        "select" => "F", // F - file only, D - folder only
        "operation" => "S", // O - open, S - save
        "showUploadTab" => true,
        "showAddToMenuTab" => false,
        "fileFilter" => "xml,csv",
        "allowAllFiles" => true,
        "SaveConfig" => true,
    )
);?>