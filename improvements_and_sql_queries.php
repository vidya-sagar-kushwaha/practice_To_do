<?php

/*
 * change column name 'created_on'-->'last_updated_on'
 * list_id  and task id...making more meaningful
 * how to identify a task in list.. make list_id+task_id combined as PK in tasks.
 *
 * */

$create_table_task = "CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`task_id`),
  KEY `list_id` (`list_id`),
  CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `to_do_lists` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE
)";


$create_table_task = CREATE TABLE `to_do_lists` (
`list_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `pending_tasks` int(11) DEFAULT '0',
  PRIMARY KEY (`list_id`)
);


