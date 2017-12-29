<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 20:44
 */

#define('KVSTORE_STORAGE','\\Think\\Kvstore\\Driver\\Filesystem()');
#define('KVSTORE_STORAGE','\\Think\\Driver\\Memcache');
define('KVSTORE_STORAGE','\\Think\\Kvstore\\Driver\\Rediskv()');
define('KVSTROE_REDIS','127.0.0.1:6379');
define('FILEPATH',ROOT_DIR.'/Data/Kvstore/FileSystem/');