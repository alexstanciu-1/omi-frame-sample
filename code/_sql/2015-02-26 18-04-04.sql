ALTER TABLE `test_omi_ecomm`.`Orders` 
ADD `$Customer$_type` SMALLINT UNSIGNED NULL COMMENT 'type column role for property: MyCompany\\Ecomm\\Model\\Order.Customer(string|integer)',
ADD INDEX `$Customer$_type` (`$Customer$_type`);

