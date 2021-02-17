<?
/**
 * Class for settings of fields and values
 * This settings is used in core, we cannot control its behaviour here
 */

namespace Acrit\Core\Export\Settings;

use \Bitrix\Main\Localization\Loc,
	\Acrit\Core\Helper;

Loc::loadMessages(__FILE__);

class SettingsRaw extends SettingsBase {
	
	public static function getCode(){
		return 'RAW';
	}
	
	public static function getName(){
		return static::getMessage('NAME');
	}
	
	public static function getHint(){
		return static::getMessage('DESC');
	}
	
	public static function getSort(){
		return 1;
	}
	
	public static function getGroup(){
		return array(
			'CODE' => 'GENERAL',
		);
	}
	
	public static function isForFields(){
		return false;
	}
	
	public static function isForValues(){
		return true;
	}
	
	public static function isShown($obField, $arParams, $arValue=null){
		return $arParams['value_type']=='FIELD';
	}
	
	public static function showSettings($strFieldCode, $obField, $arParams){
		?>
		<input type="checkbox" name="<?=static::getCode();?>" value="Y" id="<?=static::getInputID();?>"
			<?if($arParams[static::getCode()]=='Y'):?> checked="checked"<?endif?> />
		<?=Helper::ShowHint(static::getHint());?>
		<?
	}
	
	public static function process(&$mValue, $arParams, $obField=null){
		// nothing, logic in valuebase.php
	}
	
}
