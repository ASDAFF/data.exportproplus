<?
namespace Acrit\Core\Export;

use
	\Acrit\Core\Helper;
?>
<?
$obTabControl->BeginCustomField('VIDEO', Helper::getMessage('ACRIT_EXP_VIDEO_FIELD'));
?>
<tr class="heading"><td><?=$obTabControl->GetCustomLabelHTML()?></td></tr>
<tr>
	<td style="text-align:center;">
        <div>
            <a href="https://www.youtube.com/playlist?list=PLnH5qqS_5Wnzw10GhPty9XgZSluYlFa4y" target="_blank">Видео плейлист по настройке модулей экспорта</a><br>
        </div>
	</td>
</tr>
<?
$obTabControl->EndCustomField('VIDEO');

