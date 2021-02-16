<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

require_once( $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php" );
IncludeModuleLangFile( __FILE__ );
?>

<tr class="heading">
    <td colspan="2"><?=GetMessage( "DATA_EXPORTPROPLUS_FAQ_BASE" )?></td>
</tr>
<tr>
    <td colspan="2" align="center">
        <a href="http://www.data-studio.ru/technical-support/configuring-the-module-export-on-trade-portals/" target="_blank">http://www.data-studio.ru/technical-support/configuring-the-module-export-on-trade-portals/</a>
        <br/><br/>
    </td>
</tr>
<tr class="heading">
    <td colspan="2"><?=GetMessage( "DATA_EXPORTPROPLUS_INSTRUCTION_BASE" )?></td>
</tr>
<tr>
    <td colspan="2" align="center">
        <iframe width="800" height="500" src="https://www.youtube.com/embed/ene4qDMdn6A?list=PLnH5qqS_5Wnzw10GhPty9XgZSluYlFa4y" frameborder="0" allowfullscreen></iframe>
        <br/><br/>
    </td>
</tr>

<tr>

    <td valign="top" class="adm-detail-content-cell-r">
        <textarea cols="60" rows="6" name="ticket_text_proxy" id="ticket_text_proxy"></textarea>
        <textarea style="display: none" name="ticket_text_log" id="ticket_text_log">
            <b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_STATISTICK" )?></b><br/>
            <b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL" )?></b><br/>
            <?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL_IB" )?> <?=$arProfile["LOG"]["IBLOCK"]?><br/>
            <?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL_SECTION" )?> <?=$arProfile["LOG"]["SECTIONS"]?><br/>
            <?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ALL_OFFERS" )?> <?=$arProfile["LOG"]["PRODUCTS"]?><br/>
            <b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_EXPORT" )?></b><br/>
            <?=GetMessage( "DATA_EXPORTPROPLUS_LOG_OFFERS_EXPORT" )?> <?=$arProfile["LOG"]["PRODUCTS_EXPORT"]?><br/>
            <b><?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ERROR" )?></b><br/>
            <?=GetMessage( "DATA_EXPORTPROPLUS_LOG_ERR_OFFERS" )?> <?=$arProfile["LOG"]["PRODUCTS_ERROR"]?><br/>
            <?if( file_exists( $_SERVER["DOCUMENT_ROOT"].$arProfile["LOG"]["FILE"] ) ){?>
                <?=GetMessage( "DATA_EXPORTPROPLUS_LOG_FILE" )?> <?=$arProfile["LOG"]["FILE"]?><br/>
            <?}?>
        </textarea>
        </td>
</tr>

<tr>
	<td colspan="2">
		<?=GetMessage( "DATA_EXPORTPROPLUS_RECOMMENDS" );?>
	</td>
</tr>