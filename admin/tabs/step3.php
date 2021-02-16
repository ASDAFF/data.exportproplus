<?php
IncludeModuleLangFile(__FILE__);

$types = $obProfileUtils->GetTypes();

$yandex_market = array(
    "ym_simple",
    "ym_vendormodel",
    "ym_book",
    "ym_audiobook",
    "ym_multimedia",
    "ym_tour",
    "ym_clothes",
    "ym_cosmetics",
    "ym_event_ticket",
    "ym_medicine",
    "ym_webmaster",
);

$yandex_realty = array(
    "ym_realty"
);

$yandex_dynamic = array(
    "ym_dynamic_simple",
    "ym_dynamic_vendormodel"
);

$google = array(
    "google",
    "google_online",
);

$tiu = array(
	"tiu_simple",
	"tiu_vendormodel",
	"tiu_standart",
	"tiu_standart_vendormodel"
);

$mailru = array(
	"mailru",
	"mailru_clothing"
);

$allbiz = array(
	"allbiz",
);

$activizm = array(
	"activizm"
);

$avito = array(
    "avito_realty",
    "avito_avto",
    "avito_zapchasti_i_aksessuary",
    "avito_trucks_and_special_machinery",
    "avito_home_and_dacha",
    "avito_electronics",
    "avito_personal_belongings",
    "avito_job",
    "avito_business",    
    "avito_mototsikly_i_mototehnika",
    "avito_vodnyy_transport",
    "avito_predlozheniya_uslug",
    "avito_hobbi_i_otdyh",
    "avito_zhivotnye",
    "avito_context",
);

$aliexpress = array(
    "aliexpress",
);

$ebay = array(
	"ebay_1",
	"ebay_2",
	"ebay_mp30",
);

$social = array(
    "vk_trade",
    "fb_trade",
    "fb_ads",
    "ok_trade",
    "instagram_trade",
);

$ozon = array(
    "ozon",
	"ozon_api",
);

$pulscen = array(
    "pulscen",
	"pulscen_csv",
);

$lengow = array(
    "lengow",
);


$advantshop = array(
	"advantshop",
);

$price_ru = array(
    "price_ru",
);

$skybuy = array(
    "skybuy",
);

$ua_nadavi_net = array(
    "ua_nadavi_net",
);

$ua_hotline_ua = array(
    "ua_hotline_ua",
);

$ua_technoportal_ua = array(
    "ua_technoportal_ua",
);

$ua_price_ua = array(
    "ua_price_ua",
);

$ua_prom_ua = array(
    "ua_prom_ua",
);

$sorokonogka = array(
    "sorokonogka",
);
?>

<tr class="heading" align="center">
	<td colspan="2">
		<b><?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE" )?></b>
	</td>
</tr>

<tr>
	<td>
        <span id="hint_PROFILE[TYPE]"></span><script type="text/javascript">BX.hint_replace( BX( 'hint_PROFILE[TYPE]' ), '<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_LABEL_HELP" )?>' );</script>
        <?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_LABEL" )?>
    </td>
	<td>
		<select name="PROFILE[TYPE]">
            <?$selected = $arProfile["TYPE"] == "optional" ? 'selected="selected"' : "";?>
            <option value="optional" <?=$selected?>><?=$types["optional"]["NAME"]?></option>
			<?$selected = $arProfile["TYPE"] == "ym_simple_csv" ? 'selected="selected"' : "";?>
            <option value="ym_simple_csv" <?=$selected?>><?=$types["ym_simple_csv"]["NAME"]?></option>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_YANDEX" )?>">
                <optgroup label="&nbsp;&nbsp;&nbsp;<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_YANDEX_MARKET" )?>">
                    <?foreach( $yandex_market as $typeCode ){?>
                        <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                        <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                    <?}?>
                </optgroup>
                <optgroup label="&nbsp;&nbsp;&nbsp;<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_YANDEX_REALTY" )?>">
                    <?foreach( $yandex_realty as $typeCode ){?>
                        <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                        <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                    <?}?>
                </optgroup>
                <optgroup label="&nbsp;&nbsp;&nbsp;<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_YANDEX_DYNAMIC" )?>">
                    <?foreach( $yandex_dynamic as $typeCode ){?>
                        <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                        <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                    <?}?>
                </optgroup>
            </optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_GOOGLE" )?>">
			    <?foreach( $google as $typeCode ){?>
					 <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
					 <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_TIU" )?>">
			    <?foreach( $tiu as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_MAIL.RU" )?>">
			    <?foreach( $mailru as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
					<option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_ALLBIZ" )?>">
			    <?foreach( $allbiz as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
					<option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_ACTIVIZM" )?>">
			    <?foreach( $activizm as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_AVITO" )?>">
			    <?foreach( $avito as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_EBAY" )?>">
                <?foreach( $ebay as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_ALIEXPRESS" )?>">
			    <?foreach( $aliexpress as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_OZON" )?>">
			    <?foreach( $ozon as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
			    <?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_PULSCEN" )?>">
		        <?foreach( $pulscen as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				<?}?>
			</optgroup>
			<optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_LENGOW" )?>">
			    <?foreach( $lengow as $typeCode ){?>
				    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
				    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
				<?}?>
			</optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_ADVANTSHOP" )?>">
                <?foreach( $advantshop as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_PRICE_RU" )?>">
                <?foreach( $price_ru as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_VK" )?>">
                <?foreach( $social as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_SKYBUY" )?>">
                 <?foreach( $skybuy as $typeCode ){?>
                     <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                     <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                 <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_UA_NADAVI_NET" )?>">
                 <?foreach( $ua_nadavi_net as $typeCode ){?>
                     <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                     <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                 <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_UA_HOTLINE_UA" )?>">
                <?foreach( $ua_hotline_ua as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_UA_TECHNOPORTAL_UA" )?>">
                <?foreach( $ua_technoportal_ua as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_UA_PRICE_UA" )?>">
                <?foreach( $ua_price_ua as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_UA_PROM_UA" )?>">
                <?foreach( $ua_prom_ua as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
            <optgroup label="<?=GetMessage( "DATA_EXPORTPROPLUS_EXPORTTYPE_SOROKONOGKA" )?>">
                <?foreach( $sorokonogka as $typeCode ){?>
                    <?$selected = $arProfile["TYPE"] == $typeCode ? 'selected="selected"' : "";?>
                    <option value="<?=$typeCode?>" <?=$selected?>>&nbsp;&nbsp;&nbsp;<?=$types[$typeCode]["NAME"]?></option>
                <?}?>
            </optgroup>
		</select>
	</td>
</tr>
<tr class="heading"><td colspan="2"><?=GetMessage( "DATA_EXPORTPROPLUS_EXPORT_REQUIREMENTS" );?></td></tr>
<tr>
    <td colspan="2" id="portal_requirements" style="text-align: center;">
        <a href="<?=$types[$arProfile["TYPE"]]["PORTAL_REQUIREMENTS"];?>" target="_blank"><?=$types[$arProfile["TYPE"]]["PORTAL_REQUIREMENTS"];?></a>
    </td>
</tr>
<tr class="heading"><td colspan="2"><?=GetMessage( "DATA_EXPORTPROPLUS_EXPORT_EXAMPLE" )?></td></tr>
<tr>
	<td colspan="2" style="background:#FDF6E3" id="description">
		<?if( $siteEncoding[SITE_CHARSET] != "utf8" )
			echo "<pre>",  htmlspecialchars( $types[$arProfile["TYPE"]]["EXAMPLE"], ENT_COMPAT | ENT_HTML401, $siteEncoding[SITE_CHARSET] ), "</pre>";
		else
			echo "<pre>",  htmlspecialchars( $types[$arProfile["TYPE"]]["EXAMPLE"] ), "</pre>";?>
	</td>
</tr>

