
CREATE TABLE `rating` (
	`itemid` INT(11) NOT NULL,
	`ratenum` INT(11) NOT NULL DEFAULT '0',
	`totalrate` INT(11) NOT NULL DEFAULT '0',
	`updatetime` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`itemid`)
)
COLLATE='utf8_bin'
ENGINE=InnoDB
;
