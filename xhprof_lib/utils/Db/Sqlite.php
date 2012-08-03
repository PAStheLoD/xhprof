<?php

include __DIR__ . '/../../config.php';

$db = new PDO('sqlite:' . $_xhprof['sq_path']);

echo 'Using DB: '. $_xhprof['sq_path'];

foreach($db->query('SELECT * FROM SQLITE_MASTER;') as $r) {
    var_dump($r);
}

$table = <<<EOQ
 CREATE TABLE `details` (                                                        
 `id` char(17) NOT NULL,                                                         
 `url` varchar(255) default NULL,                                                
 `c_url` varchar(255) default NULL,                                              
 `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,                       
 `server name` varchar(64) default NULL,                                         
 `perfdata` MEDIUMBLOB,                                                          
 `type` tinyint(4) default NULL,                                                 
 `cookie` BLOB,                                                                  
 `post` BLOB,                                                                    
 `get` BLOB,                                                                     
 `pmu` int(11) default NULL,                                                     
 `wt` int(11) default NULL,                                                      
 `cpu` int(11) default NULL,                                                     
 `server_id` char(3) NOT NULL default 't11',                                     
 `aggregateCalls_include` varchar(255) DEFAULT NULL,                             
 PRIMARY KEY  (`id`));
EOQ;

$db->beginTransaction();
$db->query($table);

$db->query('CREATE INDEX url ON details (url)');
$db->query('CREATE INDEX c_url ON details (c_url)');
$db->query('CREATE INDEX cpu ON details (cpu)');
$db->query('CREATE INDEX wt ON details (wt)');
$db->query('CREATE INDEX pmu ON details (pmu)');
$db->query('CREATE INDEX timestamp ON details (timestamp)');

$db->commit();


