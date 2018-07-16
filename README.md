# practice_To_do

<b>Two tables:</b>

1. to_do_list
    
    CREATE TABLE `tasks` (
      `task_id` int(11) NOT NULL AUTO_INCREMENT,
      `list_id` int(11) DEFAULT NULL,
      `name` varchar(100) NOT NULL,
      `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
      `status` varchar(100) DEFAULT NULL,
      PRIMARY KEY (`task_id`),
      KEY `list_id` (`list_id`),
      CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`list_id`) REFERENCES `to_do_lists` (`list_id`) ON DELETE CASCADE ON UPDATE CASCADE
    );
    
2. tasks

    CREATE TABLE `to_do_lists` (
    `list_id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(100) NOT NULL,
      `updated_on` datetime DEFAULT CURRENT_TIMESTAMP,
      `pending_tasks` int(11) DEFAULT '0',
      PRIMARY KEY (`list_id`)
    );


<b>URL for CRUD:</b>
1. Create list <br/>
http://127.0.0.1:8081/CRUD/create_list.php <br/>
with input json as:<br/>
<br/>
{<br/>
    "name":"Training"<br/>
}<br/>
<br/>

2. Create task in a list<br/>
http://127.0.0.1:8081/CRUD/create_task.php<br/>
<br/>
{	"list_id":"2",<br/>
    "name":"Learn PHP",<br/>
    "status":"In progress"<br/>
}<br/>
<br/>

3. Read list<br/>
http://127.0.0.1:8081/CRUD/list_read_one.php?list_id=2<br/>
<br/>

4. Read task<br/>
http://127.0.0.1:8081/CRUD/task_read_one.php?list_id=2&task_id=4

5. Update task <br/>
http://127.0.0.1:8081/CRUD/update_task.php<br/>
<br/>
{	"list_id":"2",<br/>
	"task_id":"4",<br/>
    "name":"Learn PHP",<br/>
    "status":"finished"<br/>
}<br/>

6. Update list<br/>
http://127.0.0.1:8081/CRUD/update_list.php<br/>
<br/>
{<br/>
	"list_id":"2",<br/>
    "name":"Training tasks"<br/>
}<br/>

7. Delete list<br/>
http://127.0.0.1:8081/CRUD/delete_list.php<br/>
<br/>
{<br/>
	"list_id":"2"<br/>
}<br/>
<br/>

8. Delete task<br/>
http://127.0.0.1:8081/CRUD/delete_task.php<br/>
<br/>
{	"list_id":"2",<br/>
	"task_id":"4"<br/>
}<br/>