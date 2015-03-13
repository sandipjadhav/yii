--Date : 22-Oct-2014

ALTER TABLE `SavedCars` DROP FOREIGN KEY `FK_DealStatus_SavedCars` ;

ALTER TABLE `SavedCars` ADD CONSTRAINT `FK_DealStatus_SavedCars` FOREIGN KEY ( `DealStatus_ID` ) REFERENCES `motocarmanbr8`.`DealStatus` (
`ID`
) ON DELETE NO ACTION ON UPDATE NO ACTION ;

ALTER TABLE `SalesPerson` ADD `Name` VARCHAR( 20 ) NULL DEFAULT NULL AFTER `ID`


-- Uplaod a photo 
INSERT INTO `tbl_profiles_fields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(5, 'profilePhoto', 'Profile Photo', 'VARCHAR', 255, 0, 0, '', '', '', '{"file":{"allowEmpty":"true","maxFiles":"1","types":"jpg,gif,png,jpeg","safe":"true"}}', '', 'UWfile', '', 0, 3);

ALTER TABLE `tbl_profiles` ADD `profilePhoto` VARCHAR( 255 ) NULL DEFAULT NULL ;
--ALTER TABLE `tbl_profiles` CHANGE `profilePhoto` `profilePhoto` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL--  ;



ALTER TABLE `Dealership` ADD `latitude` VARCHAR( 20 ) NULL AFTER `zip` ,
ADD `longitude` VARCHAR( 20 ) NULL AFTER `latitude` ;