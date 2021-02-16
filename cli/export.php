<?php
/**
 * Copyright (c) 16/2/2021 Created By/Edited By ASDAFF asdaff.asad@yandex.ru
 */

$strModuleId = pathinfo(realpath(__DIR__.'/../'), PATHINFO_BASENAME);
require(realpath(__DIR__.'/../../data.core/cli/export/'.pathinfo(__FILE__, PATHINFO_BASENAME)));
?>