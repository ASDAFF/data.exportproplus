<?
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_TITLE"] = "Настройки интеграции с площадкой Ok.ru";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_IS_GROUP_PUBLISH"] = "Публиковать от имени группы: ";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_GROUP"] = "ID группы: ";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_APP_ID"] = "ID приложения (Application ID): ";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_APP_PUBLIC_KEY"] = "Публичный ключ приложения: ";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_APP_SECRET_KEY"] = "Секретный ключ приложения: ";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_ACCESS_TOKEN"] = "Access Token: ";

$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_IS_GROUP_PUBLISH_HELP"] = "Публиковать товары от имени группы: ";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_GROUP_HELP"] = "Введите ID группы Ok.ru";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_APP_ID_HELP"] = "Введите ID приложения Ok.ru (Application ID)";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_APP_PUBLIC_KEY_HELP"] = "Введите gубличный ключ приложения Ok.ru";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_APP_SECRET_KEY_HELP"] = "Введите cекретный ключ приложения Ok.ru";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_ACCESS_TOKEN_HELP"] = "Введите Access Token";

$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_TITLE_ACCESS_DATA"] = "Для обмена данными необходимо заполнить нижеуказаные поля.<br/><br/>
<a href=\"http://ok.ru/devaccess\" target=\"_blank\">Зарегистрируйтесь</a> как разработчик.<br/><br/>
Создайте приложение по <a href=\"http://ok.ru/dk?st.cmd=appEdit&amp;st._aid=Apps_Info_MyDev_AddApp\" target=\"_blank\">ссылке</a><br/><br/>
<b>Важно!</b> Подробная инструкция по созданию приложения находится по <a href=\"http://apiok.ru/wiki/pages/viewpage.action?pageId=42476486\" target=\"_blank\">ссылке</a><br/><br/>

Заполните теги \"Название\", \"Короткое имя\", \"Описание\".<br/><br/>
Заполните теги \"Ссылки на аватарки и иконки\", \"Ссылка на приложение\", \"Список разрешённых redirect_uri\".<br/><b>Внимание!</b> Содержимое данных полей может быть произвольным, но для тега \"Ссылка на приложение\" ссылка должная начинаться с https. Например, https://ya.ru/<br><br>
Выберите \"Тип приложения\" - \"External\", поле \"Статус\" - \"Публичное\", установите следующие права для приложения в положение \"обязательно\":
<div style=\"width: 500px; margin: 0 auto;\">
<ul style=\"text-align: left;\">
    <li>Установка статуса (SET_STATUS)</li>
    <li>Изменение фотографий и фотоальбомов (PHOTO_CONTENT)</li>
    <li>Доступ к основной информации (VALUABLE_ACCESS)</li>
    <li>Доступ к группам (GROUP_CONTENT)</li>
</ul>
</div><br/>
Если какое то право отсутствует в списке, необходимо его запросить у администрации Одноклассников по почте <a href=\"mailto:api-support@ok.ru\" target=\"_blank\">api-support@ok.ru</a>.<br/>
<div style=\"width: 500px; margin: 0 auto;\">
<ul style=\"text-align: left;\">
    <b>Важно!</b> Правила оформления письма:<br/><br/>
    Тема: Права приложения<br/>
    Сообщение:
    <ul>
        ID приложения: &lt;App id вашего приложения&gt;<br/>
        Права: &lt;права, например VALUABLE_ACCESS, GROUP_CONTENT&gt;<br/>
        Цель: &lt;напишите цель получения прав&gt;
    </ul>
</ul>
</div><br/>
После того как приложение создано, вам на почту придет письмо с данными созданного приложения Application ID, Публичный ключ приложения и Секретный ключ приложения.<br/>
Эти данные необходимо вписать в соответствующие теги выше.<br/><br/>
Для получения Access Token необходимо пройти в настройки вашего приложения, и внизу страницы рядом с полем \"Вечный access_token\" будет кнопка \"Получить access_token\", при нажатии на которую отобразится токен, который нужно скопировать в соответствующее поле, указанное ниже.
<br/><br/>
Для включения <b>Одноклассники.Товары</b> необходимо перейти в Управление группой -> Товары -> Раздел товаров -> Показывать";

$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_SYNC_SETTINGS_RESET"] = "Сбросить сохраненные данные обмена";
$MESS["DATA_EXPORTPROPLUS_SYNC_SETTINGS_RESET"] = "Сбросить данные обмена";
$MESS["DATA_EXPORTPROPLUS_OP_UA_OK_SYNC_SETTINGS_RESET_HELP"] = "Сбросить данные обмена для чистой выгрузки данных";
$MESS["DATA_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_BUTTON"] = "Удалить выгруженные медиатопики";
$MESS["DATA_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE"] = "Удалить выгруженные в группу Ok.ru медиатопики: ";
$MESS["DATA_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_HELP"] = "Удаляет выгруженные медиатопики из указанной группы Ok.ru";
$MESS["DATA_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE_BUTTON"] = "Удалить все медиатопики группы";
$MESS["DATA_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE"] = "Удалить все медиатопики группы Ok.ru: ";
$MESS["DATA_EXPORTPROPLUS_OK_MARKET_ITEMS_DELETE_FORCE_HELP"] = "Удаляет все медиатопики из указанной группы Ok.ru";

$MESS["DATA_EXPORTPROPLUS_PROFILE_RESET_SETTINGS_CONFIRM"] = "Вы действительно хотите сбросить данные обмена?";
$MESS["DATA_EXPORTPROPLUS_PROFILE_DELETE_ITEMS_CONFIRM"] = "Вы действительно хотите удалить выгруженные медиатопики?";
$MESS["DATA_EXPORTPROPLUS_PROFILE_DELETEALL_ITEMS_CONFIRM"] = "Вы действительно хотите удалить все медиатопики из группы Ok.ru?";
?>