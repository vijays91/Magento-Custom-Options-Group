<?php
$installer = $this;
$installer->startSetup();
$table = "catalog_product_option";
$tableName = Mage::getSingleton("core/resource")->getTableName($table); //** get table name and prefix name

$installer->run("
    ALTER TABLE $tableName  ADD `group_options` varchar(255) NOT NULL AFTER `is_require`;
");
$installer->endSetup();