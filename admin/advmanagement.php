<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$moduleId = "data.exportproplus";
require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
IncludeModuleLangFile(__FILE__);

    require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/$moduleId/include.php" );

    CModule::IncludeModule( $moduleId );

    CUtil::InitJSCore( array( "ajax", "jquery" ) );
    $APPLICATION->AddHeadScript( "/bitrix/js/iblock/iblock_edit.js" );
    $APPLICATION->AddHeadScript( "/bitrix/js/$moduleId/main.js" );
    $t = CJSCore::getExtInfo( "jquery" );

    $APPLICATION->SetTitle( GetMessage( "DATA_EXPORTPROPLUS_ADVMANAGEMENT_TITLE" ) );

    require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_after.php" );

    echo BeginNote();
    echo GetMessage( "DATA_EXPORTPROPLUS_ADVMANAGEMENT_TEXT" );
    echo EndNote();
?>

<?require( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_admin.php" );?>