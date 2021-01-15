CREATE TABLE calendar_users ( 
user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(30) NOT NULL, 
password VARCHAR(30) NOT NULL, 
description TEXT, 
group_id INT(11) NOT NULL ) TYPE = MYISAM; 

INSERT INTO calendar_users (user_id, username, password, description, group_id) 
VALUES (null, 'admin', 'wekgLeN042D5U', '', '0'); 

INSERT INTO calendar_users (user_id, username, password, description, group_id) 
VALUES (null, 'test', 'weELZPzyWKtD.', '', '1'); 


CREATE TABLE calendar_cat (
  cat_id int(11) NOT NULL auto_increment,
  cat_name varchar(150) NOT NULL default '',
  PRIMARY KEY  (cat_id),
  UNIQUE KEY cat_id (cat_id)
) TYPE=MyISAM;

INSERT INTO calendar_cat VALUES (1,'General');

CREATE TABLE calendar_events ( 
id int(11) NOT NULL auto_increment, 
timestamp timestamp(14) NOT NULL, 
title varchar(255) NOT NULL default '', 
description text NOT NULL, 
url varchar(100) NOT NULL default '', 
email varchar(120) NOT NULL default '', 
cat tinyint(2) NOT NULL default '0', 
starttime varchar(8) NOT NULL default '', 
endtime varchar(8) NOT NULL default '', 
day tinyint(2) NOT NULL default '0', 
month smallint(2) NOT NULL default '0', 
year smallint(4) NOT NULL default '0', 
approved tinyint(1) NOT NULL default '0', 
priority tinyint(1) NOT NULL default '0', 
user varchar(30) NOT NULL default '', 
timezone varchar(5) NOT NULL default '', 
PRIMARY KEY (id),
UNIQUE KEY id (id)
) TYPE=MyISAM;


CREATE TABLE calendar_param ( 
	name VARCHAR(150) NOT NULL, 
	value VARCHAR(150) 
) TYPE = MYISAM; 

INSERT INTO calendar_param (name, value) VALUES ('session_timeout', '3600');  



