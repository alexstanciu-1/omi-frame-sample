CREATE TABLE `test_omi_ecomm`.`Orders_Items` (
`$id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY  COMMENT 'Id/RowId column role',
`$Orders` INT UNSIGNED NULL COMMENT 'Reference to `test_omi_ecomm.Orders_Items`.`Items` column role',
`$Items` INT UNSIGNED NULL COMMENT 'Reference column for property value: Items',
INDEX `$Orders` (`$Orders`),
INDEX `$Items` (`$Items`) )
 ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci COMMENT = 'Storage for collection: MyCompany\\Ecomm\\Model\\Order.Items';

