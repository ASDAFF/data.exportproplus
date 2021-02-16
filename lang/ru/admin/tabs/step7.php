<?
$MESS["DATA_EXPORTPROPLUS_CONDITIONS"] = "Условия экспорта (фильтр)";

$MESS["DATA_EXPORTPROPLUS_CURRENCU"] = "Настройки валют";
$MESS["DATA_EXPORTPROPLUS_CURRENCU_RUB"] = "Российский рубль";
$MESS["DATA_EXPORTPROPLUS_CURRENCU_HEAD_CURRENCY"] = "Валюта";
$MESS["DATA_EXPORTPROPLUS_CURRENCU_HEAD_RATE"] = "Курс";
$MESS["DATA_EXPORTPROPLUS_CURRENCU_HEAD_CORRECT"] = "Коррекция курса";
$MESS["DATA_EXPORTPROPLUS_CURRENCY_CONVERT_CURRENCY"] = "Конвертировать курс валют";
$MESS["DATA_EXPORTPROPLUS_CURRENCU_HEAD_CONVERTTO"] = "Конвертировать в";
$MESS["DATA_EXPORTPROPLUS_MARKET_CURRENCY_DESCRIPTION"] = "
    Если галочка <b>\"Конвертировать курс валют\" не установлена</b>, то будет произведена коррекция выбранных<br/>
    валют, на выбранное значение в процентах.
    Корректировать можно в обе стороны. Если в большую сторону, то указывается число(дробное или целое),<br/>
    если коррекция в обратную сторону, то перед значением ставится минус.<br/>
    Если галочка <b>\"Конвертировать курс валют\" установлена</b>, то выбранные валюты, с заданными символьными<br/>
    значениями(должны совпадать со значениями в настройках валют), будут сконвертированы в выбранные валюты(<b>\"Конвертировать в\"</b>)<br/>
    в соответствии с выбранным курсом.
";

$MESS["DATA_EXPORTPROPLUS_CURRENCY_CONVERT_CURRENCY_HELP"] = "Используется для пересчета курсов валют к одной";


$MESS["DATA_EXPORTPROPLUS_SETUP_CONVERT_DATA_REGEXP"] = "Использовать Regexp";
$MESS["DATA_EXPORTPROPLUS_SETUP_CONVERT_DATA_REGEXP_HELP"] = "Использовать Regexp для поиска в исходной строке";

$MESS["DATA_EXPORTPROPLUS_CONVERT_FIELDSET_CONDITION_ADD"] = "Добавить";
$MESS["DATA_EXPORTPROPLUS_CONVERT_FIELDSET_HEADER"] = "Конвертация данных";
$MESS["DATA_EXPORTPROPLUS_CONVERT_FIELDSET_DESCRIPTION"] = "
    <b>\"КОНВЕРТАЦИЯ ЗНАЧЕНИЙ\"</b> позволяет заменить набор значений в формируемом файле выгрузки.<br/><br/>
    В левой колонке формируется набор данных для замены. В правой - набор, на который будет произведена замена.<br/><br/>
    Например, в случае указания в левой колонке значения \"футбол\", а в правой значения \"хоккей\" при генерации файла выгрузки во всех данных, полученных из полей экспорта, будет произведена прямая замена слова \"футбол\" на слово \"хоккей\"
";

$MESS["DATA_EXPORTPROPLUS_SETUP_VALIDATE_CONDITIONS"] = "Применять только для существующих свойств инфоблока";
$MESS["DATA_EXPORTPROPLUS_SETUP_VALIDATE_CONDITIONS_HELP"] = "В случае указания данной опции выборка будет применяться только к существующим свойствам инфоблока";

$MESS["DATA_EXPORTPROPLUS_FIELDSET_ADDITIONAL_SETTINGS_HEADER"] = "Дополнительные настройки";
$MESS["DATA_EXPORTPROPLUS_FIELDSET_ADDITIONAL_SETTINGS_SKU_USE_CANONICAL"] = "Использовать канонический URL в торговых предложениях";
$MESS["DATA_EXPORTPROPLUS_FIELDSET_ADDITIONAL_SETTINGS_OFFER_WITH_SKU_USE_QUANTITY"] = "Учитывать остаток ТП при работе опции «Товары с элементами торговых предложений»";
$MESS["DATA_EXPORTPROPLUS_FIELDSET_ADDITIONAL_SETTINGS_OFFER_WITH_SKU_USE_QUANTITY_HINT"] = "При использовании опции выгрузки «Товары с элементами торговых предложений» для выгрузки товара выбирается первое ТП для этого товара (с сортировкой по цене и по ID) для использование его данных в товаре.<br/><br/>Данная опция позволяет при поиске учитывать остаток ТП - т.е. в поиске будут учитываться только ТП в наличии.";
?>