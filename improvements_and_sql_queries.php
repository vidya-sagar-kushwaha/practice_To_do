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


$create_table_list = CREATE TABLE `to_do_lists` (
`list_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `pending_tasks` int(11) DEFAULT '0',
  PRIMARY KEY (`list_id`)
);

/*
 CREATE DATABASE To_Do_with_users;

CREATE TABLE users (
`user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`))

CREATE TABLE to_do_lists (
`list_id` int(11) NOT NULL AUTO_INCREMENT,
user_id integer,
  `name` varchar(100) NOT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `pending_tasks` int(11) DEFAULT '0',
  PRIMARY KEY (`list_id`,user_id),
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
  )

  CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `list_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`task_id`,list_id, `user_id`),
  FOREIGN KEY (`list_id`) REFERENCES `to_do_lists` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
)

insert into users(name) values("Vidya");
insert into users(name) values("Reshma");
insert into users(name) values("Mohit");
 * */



/*
Further:
1. add Users table
    - user_id
    - name

2. add OWNS table (relation between user->list)
    - user id
    - list id
3. has_task table (list->task relation)

4. error handling:

delete list with invalid pair of user id and list id--> still says list was deleted
: check for #rows affected
*/





