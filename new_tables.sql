insert into user_permissions values ( 53, 3, 'ADD_REPORT', 1, '2017-11-11' );

CREATE TABLE IF NOT EXISTS `report_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(200),
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table will store all templates';

CREATE TABLE IF NOT EXISTS `patient_report_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11),
  `template_id` int(11),
  `data` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This table will store all templates association with patients';