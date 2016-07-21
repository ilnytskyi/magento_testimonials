<?php

$installer = $this;
$tableTestimonials = $installer->getTable('sitestimonials/table_testimonials');

$installer->startSetup();

$installer->getConnection()->dropTable($tableTestimonials);
$table = $installer->getConnection()
    ->newTable($tableTestimonials)
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'nullable'  => false,
        'primary'   => true
    ))
    ->addColumn('user_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable'  => false,
    ))
    ->addColumn('created', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false
    ))
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'nullable'  => false,
        'default' => 0
    ))
    ->addForeignKey(
        $installer->getFkName('sitestimonials/table_testimonials', 'user_id', 'customer/entity','entity_id'),
        'user_id',
        $installer->getTable('customer/entity'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    );
$installer->getConnection()->createTable($table);

$installer->endSetup();