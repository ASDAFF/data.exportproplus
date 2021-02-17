<?if( !defined( "B_PROLOG_INCLUDED" ) || B_PROLOG_INCLUDED !== true ) die();

if( !CModule::IncludeModule( "iblock" ) || !CModule::IncludeModule( "sale" ) ){
    return false;
}

require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/update_client_partner.php" );

if( !class_exists( "CExportproplusInformerGadget" ) ){
    class CExportproplusInformerGadget{
        public static $moduleId = "acrit.exportproplus";
        public static $modulePrefix = "acrit";

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

        public static function GetMarketModulesInfo( &$arUpdateData ){
            $result = false;

            $arModuleList = self::GetMarketModuleList();
            if( is_array( $arModuleList["MODULE"] ) && !empty( $arModuleList["MODULE"] ) ){
                foreach( $arModuleList["MODULE"] as $arModule ){
                    if( stripos( $arModule["@"]["ID"], self::$modulePrefix ) !== false ){
                        if( $arModule["@"]["ID"] == self::$moduleId ){
                            if(is_array($arModule["#"]) && is_array($arModule["#"]["VERSION"])) {
                              foreach( $arModule["#"]["VERSION"] as $arModuleVersion ){
                                  if( is_array( $arModuleVersion["@"] ) && !empty( $arModuleVersion["@"] )
                                      && is_array( $arModuleVersion["#"] ) && !empty( $arModuleVersion["#"] )
                                  ){
                                      $arUpdateData[$arModuleVersion["@"]["ID"]] = $arModuleVersion["#"]["DESCRIPTION"][0]["#"];
                                  }
                              }
                            }
                        }
                    }
                }
            }

            return $result;
        }
    }
}

$arModuleNameParts = explode( ".", CExportproplusInformerGadget::$moduleId );

global $APPLICATION;
$APPLICATION->SetAdditionalCSS( "/bitrix/gadgets/".$arModuleNameParts[0]."/".$arModuleNameParts[1]."/styles.css" );

$arUpdateData = array();

?>

<div class="acrit-info-widget">
    <div class="show-gadget-title"><?=GetMessage( "GD_ACRIT_EXPORTPROPLUS_NAME" );?></div>

    <?if( is_array( $arUpdateData ) && !empty( $arUpdateData ) ){?>
        <div class="show-info-row-version">
            <br/>
            <?foreach( $arUpdateData as $updateDataVersion => $updateDataDescription ){?>
                <b><?=GetMessage( "GD_ACRIT_EXPORTPROPLUS_EXPORT_HAS_UPDATE" );?><?=$updateDataVersion?></b><br/>
                <?=$updateDataDescription;?>
                <br/><br/>
            <?}?>
        </div>
				<div class="updates-more-info">
					<a href="/bitrix/admin/update_system_partner.php?lang=<?=LANGUAGE_ID;?>&tabControl_active_tab=tab2" target="_blank">
						<?=GetMessage( "GD_ACRIT_EXPORTPROPLUS_MORE" );?>
					</a>
				</div>
    <?} elseif ( is_array( $arUpdateData ) && empty( $arUpdateData ) ){?>
        <div class="show-info-row-version">
						<br/>
            <?=GetMessage( "GD_ACRIT_EXPORTPROPLUS_EXPORT_UPDATED" );?>
        </div>
		<?}?>
</div>