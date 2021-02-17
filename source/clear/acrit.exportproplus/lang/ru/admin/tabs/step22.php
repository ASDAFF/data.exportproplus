<?
$accessTokenUrl = CAcritExportproplusExternApiTools::GetAccessUrl();

$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_TITLE"] = "Настройки интеграции с торговой площадкой Vk.com";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_ACCESS_TOKEN"] = "Access Token: ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_GROUP_PUBLISH"] = "ID группы Вконтакте: ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_USER_PUBLISH"] = "ID пользователя Вконтакте: ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA"] = "Captcha: ";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA_MESSAGE"] = "Отправить Captcha в Vk.com";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA_WORD"] = "Введите символы с картинки";

$MESS["ACRIT_EXPORTPROPLUS_SEND_VK_CAPTCHA"] = "Разблокировать";

$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_ACCESS_TOKEN_HELP"] = "Введите Access Token";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_GROUP_PUBLISH_HELP"] = "Введите ID группы Вконтакте";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_USER_PUBLISH_HELP"] = "Введите ID пользователя Вконтакте";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_NEED_CAPTCHA_HELP"] = "Необходимо отправить Captcha в Vk.com";

$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_TITLE_ACCESS_DATA"] = "Для обмена данными необходимо указать ID группы Вконтакте и Access Token.<br/><br/>
Для просмотра ID группы можно перейти в раздел \"Статистика сообщества/страницы\", рассположенный справа на странице вашей группы, https://vk.com/stats?gid=<b>ID_группы</b> - в конце ссылки будет ID вашей группы.<br/><br/>
Для просмотра ID пользователя можно перейти в раздел \"Фотографии\", рассположенный слева на странице пользователя, https://vk.com/albums<b>ID_пользователя</b> - в конце ссылки будет ID пользователя.<br/><br/>
Для получения Access Token перейдите по <a href=\"".$accessTokenUrl."\" target=\"_blank\">ссылке</a>, в открывшемся окне авторизуйтесь, подтвердите права, и после того как на экране будет сообщение \"Пожалуйста, не копируйте данные из адресной строки для сторонних сайтов...\", скопируйте адрес из адресной строки в поле \"Access Token\", и кликните по ссылке <a href=\"#gettoken\" onclick=\"ExtractAccessToken()\">\"Преобразовать\"</a>, чтобы получить Access token из адреса.";

$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_SYNC_SETTINGS_RESET"] = "Сбросить сохраненные данные обмена";
$MESS["ACRIT_EXPORTPROPLUS_SYNC_SETTINGS_RESET"] = "Сбросить данные обмена";
$MESS["ACRIT_EXPORTPROPLUS_OP_UA_VK_SYNC_SETTINGS_RESET_HELP"] = "Сбросить данные обмена для чистой выгрузки данных";
$MESS["ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_BUTTON"] = "Удалить выгруженные товары";
$MESS["ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE"] = "Удалить выгруженные в группу Vk.com товары: ";
$MESS["ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_HELP"] = "Удаляет выгруженные товары из указанной группы/паблика Vk.com";
$MESS["ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE_BUTTON"] = "Удалить все товары группы";
$MESS["ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE"] = "Удалить все товары группы Vk.com: ";
$MESS["ACRIT_EXPORTPROPLUS_VK_MARKET_ITEMS_DELETE_FORCE_HELP"] = "Удаляет все товары из указанной группы/паблика Vk.com";

$MESS["ACRIT_EXPORTPROPLUS_PROFILE_RESET_SETTINGS_CONFIRM"] = "Вы действительно хотите сбросить данные обмена?";
$MESS["ACRIT_EXPORTPROPLUS_PROFILE_DELETE_ITEMS_CONFIRM"] = "Вы действительно хотите удалить выгруженные товары?";
$MESS["ACRIT_EXPORTPROPLUS_PROFILE_DELETEALL_ITEMS_CONFIRM"] = "Вы действительно хотите удалить все товары из группы Vk.com?";
?>