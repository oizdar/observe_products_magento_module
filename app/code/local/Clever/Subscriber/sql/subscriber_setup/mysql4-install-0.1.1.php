<?php
$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('subscriber/subscriptions'))
    ->addColumn(
        'email',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        [
            'nullable' => false,
            'length' => 255,
            'primary' => true
        ],
        'e-mail'
    )
    ->addColumn(
        'product_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'nullable' => false,
            'unsigned' => true,
            'primary' => true,
        ],
        'Product ID'
    );
$installer->getConnection()->createTable($table);

$installer->endSetup();