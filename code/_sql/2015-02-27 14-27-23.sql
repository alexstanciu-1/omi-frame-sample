ALTER TABLE `test_omi_ecomm`.`Products` 
ADD `$BestOrder` INT UNSIGNED NULL COMMENT 'Reference column for property value: BestOrder',
ADD INDEX `$BestOrder` (`$BestOrder`);

