--Date : 22-Oct-2014

ALTER TABLE `SavedCars` DROP FOREIGN KEY `FK_DealStatus_SavedCars` ;

ALTER TABLE `SavedCars` ADD CONSTRAINT `FK_DealStatus_SavedCars` FOREIGN KEY ( `DealStatus_ID` ) REFERENCES `motocarmanbr8`.`DealStatus` (
`ID`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE `SalesPerson` ADD `Name` VARCHAR( 20 ) NULL DEFAULT NULL AFTER `ID`

