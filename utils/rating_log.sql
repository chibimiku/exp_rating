CREATE TABLE `rating_log` (
	`logid` INT(11) NOT NULL AUTO_INCREMENT,
	`ip` CHAR(20) NOT NULL DEFAULT '' COLLATE 'utf8_bin',
	`itemid` INT(11) NOT NULL DEFAULT '0',
	`score` TINYINT(4) NOT NULL DEFAULT '0',
	`timestamp` INT(11) NOT NULL DEFAULT '0',
	`dateline` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`opt` TINYINT(4) NOT NULL DEFAULT '0',
	PRIMARY KEY (`logid`),
	INDEX `ip` (`ip`),
	INDEX `itemid` (`itemid`)
)
COLLATE='utf8_bin'
ENGINE=InnoDB
AUTO_INCREMENT=1
;
