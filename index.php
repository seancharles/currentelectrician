<?php
/**
 * Application entry point
 *
 * Example - run a particular store or website:
 * --------------------------------------------
 * require __DIR__ . '/app/bootstrap.php';
 * $params = $_SERVER;
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'website2';
 * $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'website';
 * $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
 * \/** @var \Magento\Framework\App\Http $app *\/
 * $app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
 * $bootstrap->run($app);
 * --------------------------------------------
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

include('select_store/index.php');

try {
    require __DIR__ . '/app/bootstrap.php';
} catch (\Exception $e) {
    echo <<<HTML
<div style="font:12px/1.35em arial, helvetica, sans-serif;">
    <div style="margin:0 0 25px 0; border-bottom:1px solid #ccc;">
        <h3 style="margin:0;font-size:1.7em;font-weight:normal;text-transform:none;text-align:left;color:#2f2f2f;">
        Autoload error</h3>
    </div>
    <p>{$e->getMessage()}</p>
</div>
HTML;
    exit(1);
}

//$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
/** @var \Magento\Framework\App\Http $app */
//$app = $bootstrap->createApplication(\Magento\Framework\App\Http::class);
//$bootstrap->run($app);

/*
$params = $_SERVER;
$domain2store = array(
    'currentelectrician.com'=>'ce_us_store_view', // Replace your Website, Store or Storeview code with this.
    'currentelectrician.ca'=>'ce_ca_store_view',      // Replace your Website, Store or Storeview code with this.
    );
if(isset($domain2store[$_SERVER['HTTP_HOST']]))
    $storecode = $domain2store[$_SERVER['HTTP_HOST']];
$params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = isset($storecode) ? $storecode : '';
$params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store';
$bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params);
$app = $bootstrap->createApplication('Magento\Framework\App\Http');
$bootstrap->run($app);*/



switch ($_SERVER['HTTP_HOST']) {
    case 'currentelectrician.com':
    case 'www.currentelectrician.com':
        $params = $_SERVER; $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'ce_us_store_view'; 
        $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store'; 
        $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params); 
        $app = $bootstrap->createApplication('Magento\Framework\App\Http'); 
        $bootstrap->run($app); 
        break; 
    case 'currentelectrician.ca':
    case 'www.currentelectrician.ca':
        $params = $_SERVER; $params[\Magento\Store\Model\StoreManager::PARAM_RUN_CODE] = 'ce_ca_store_view'; 
        $params[\Magento\Store\Model\StoreManager::PARAM_RUN_TYPE] = 'store'; 
        $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $params); 
        $app = $bootstrap->createApplication('Magento\Framework\App\Http'); 
        $bootstrap->run($app); 
    break; 

    default: 
        Mage::run(); 
    break; 
}

