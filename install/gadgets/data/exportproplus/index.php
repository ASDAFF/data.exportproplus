<?if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

if( !CModule::IncludeModule( "iblock" ) || !CModule::IncludeModule( "sale" ) ){
    return false;
}

require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client_partner.php" );

if( !class_exists( "CExportproplusInformerGadget" ) ){
    class CExportproplusInformerGadget{
        public static $moduleId = "data.exportproplus";
        public static $modulePrefix = "data";

        private function GetMarketModuleList(){
            $arModules = array();

            $arRequestedModules = CUpdateClientPartner::GetRequestedModules( self::$moduleId );
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
    }
}

$arModuleNameParts = explode( ".", CExportproplusInformerGadget::$moduleId );

global $APPLICATION;
$APPLICATION->SetAdditionalCSS( "/bitrix/gadgets/".$arModuleNameParts[0]."/".$arModuleNameParts[1]."/styles.css" );

$arUpdateData = array();

?>

<div class="data-info-widget">
    <div class="show-gadget-title"><?=GetMessage( "GD_DATA_EXPORTPROPLUS_NAME" );?></div>

    <?if( is_array( $arUpdateData ) && !empty( $arUpdateData ) ){?>
        <div class="show-info-row-version">
            <br/>
            <?foreach( $arUpdateData as $updateDataVersion => $updateDataDescription ){?>
                <b><?=GetMessage( "GD_DATA_EXPORTPROPLUS_EXPORT_HAS_UPDATE" );?><?=$updateDataVersion?></b><br/>
                <?=$updateDataDescription;?>
                <br/><br/>
            <?}?>
        </div>
				<div class="updates-more-info">
					<a href="/bitrix/admin/update_system_partner.php?lang=<?=LANGUAGE_ID;?>&tabControl_active_tab=tab2" target="_blank">
						<?=GetMessage( "GD_DATA_EXPORTPROPLUS_MORE" );?>
					</a>
				</div>
    <?} elseif ( is_array( $arUpdateData ) && empty( $arUpdateData ) ){?>
        <div class="show-info-row-version">
						<br/>
            <?=GetMessage( "GD_DATA_EXPORTPROPLUS_EXPORT_UPDATED" );?>
        </div>
		<?}?>
</div>