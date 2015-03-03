ALTER TABLE `test_omi_ecomm`.`Orders_Items` 
ADD `$Items$_type` SMALLINT UNSIGNED NULL COMMENT 'type column role for property: MyCompany\\Ecomm\\Model\\Order.Items((MyCompany\\Ecomm\\Model\\OrderItem)[])',
ADD INDEX `$Items$_type` (`$Items$_type`);

ALTER TABLE `test_omi_ecomm`.`OrdersItems` 
ADD `$_type` SMALLINT UNSIGNED NULL COMMENT 'Type column for table entry role',
ADD INDEX `$_type` (`$_type`) ,
 COMMENT = 'Storage for class: MyCompany\\Ecomm\\Model\\OrderItem2';

