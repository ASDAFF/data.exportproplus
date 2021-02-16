<?
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_TITLE"] = "Настройки интеграции с площадкой Facebook.com";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_PAGE_PUBLISH"] = "ID страницы: ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_ID"] = "ID приложения (App ID): ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_SECRET"] = "Секрет приложения (App Secret): ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_ACCESS_TOKEN"] = "Access Token: ";

$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_PAGE_PUBLISH_HELP"] = "Введите ID группы или ID страницы Facebook.<br/><br/><b>Внимание!</b> При необходимости выгрузки на страницу текущего пользователя в поле необходимо вписать символьный код: <b>me</b>";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_ID_HELP"] = "Введите ID приложения Facebook (App ID) ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_APP_SECRET_HELP"] = "Введите Facebook Секрет приложения (App Secret)";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_ACCESS_TOKEN_HELP"] = "Введите Access Token";

$MESS["ACRIT_EXPORTPROPLUS_OP_UA_FB_TITLE_ACCESS_DATA"] = "<b>Внимание!</b><br/>Во избежание получения блокировки от Facebook внимательно ознакомьтесь со следующей информацией:<br/>
<a href=\"https://www.facebook.com/help/www/116393198446749\" target=\"_blank\">https://www.facebook.com/help/www/116393198446749</a><br/><br/>
Cоздайте приложение (если у вас его еще нет) на <a href=\"https://developers.facebook.com/apps/\" target=\"_blank\">этой странице</a>.<br/>
Далее, после создания, перейдите в настройки (Settings), добавьте платформу \"WebSite\" и введите в появившееся поле адресс вашего сайта (вместе с http/https).<br/>
Заполните поле \"Контактный Email\" (Contact Email) и сохраните изменения.<br/>
Перейдите в \"Проверку приложения\" (App Review) и активируйте первый пункт \"Make имя_приложения public?\".<br/><br/>
Перейдите в настройки, и скопируйте оттуда теги App ID и App Secret в соответствующие теги на этой странице.<br/>
В поле \"ID страницы\" впишите идентификатор своей страницы или группы.<br/>
Перейдите по ссылке <a href=\"#getToken\" onclick=\"GetFbAccessToken();\">\"Получить Access Token\"</a> и в открывшемся окне подтвердите все права для приложения.<br/>
Сохраните настройки.";
?>