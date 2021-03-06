<?php
/**
 * FecShop file.
 * @link http://www.fecshop.com/
 * @copyright Copyright (c) 2016 FecShop Software LLC
 * @license http://www.fecshop.com/license/
 */

/**
 * 本文件在app/web/index.php 处引入。
 * 本配置文件为第三方插件库包的配置文件
 */
$third_config = [];
$current_app_name = 'apperp';

if (is_array($fecmall_db_extensions_data) && !empty($fecmall_db_extensions_data)) {
    foreach ($fecmall_db_extensions_data as $one) {
        $configFile = Yii::getAlias($one['config_file_path']);
        if (!file_exists($configFile)) continue;
        $c = require($configFile);
        $curr_config = isset($c['app'][$current_app_name]) ? $c['app'][$current_app_name] : false;
        $app_enable = isset($curr_config['enable']) ? $curr_config['enable'] : false;
        $app_config = isset($curr_config['config']) ? $curr_config['config'] : false;
        if ($app_enable && is_array($app_config) && !empty($app_config)) {
            $third_config = yii\helpers\ArrayHelper::merge($third_config, $app_config);
        }
    }
}
// 引入theme，前面的优先级高，所以进行反转
//if (isset($third_config['services']['page']['childService']['theme']['thirdThemeDir']) && is_array($third_config['services']['page']['childService']['theme']['thirdThemeDir'])) {
//    $third_config['services']['page']['childService']['theme']['thirdThemeDir'] = array_reverse($third_config['services']['page']['childService']['theme']['thirdThemeDir']);
//}
return $third_config;
