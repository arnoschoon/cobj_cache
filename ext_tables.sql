#
# TABLE STRUCTURE FOR TABLE 'tx_cobjcache'
#
CREATE TABLE tx_cobjcache (
	id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	identifier VARCHAR(250) DEFAULT '' NOT NULL,
	crdate INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	content mediumblob,
	lifetime INT(11) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (id),
	KEY cache_id (identifier)
) ENGINE=InnoDB;

#
# TABLE STRUCTURE FOR TABLE 'tx_cobjcache_tags'
#
CREATE TABLE tx_cobjcache_tags (
	id INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
	identifier VARCHAR(250) DEFAULT '' NOT NULL,
	tag VARCHAR(250) DEFAULT '' NOT NULL,
	PRIMARY KEY (id),
	KEY cache_id (identifier),
	KEY cache_tag (tag)
) ENGINE=InnoDB;