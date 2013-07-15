<?php
define('DEBUG', true);

/**
 * 静态资源服务器
 * @var string
 */
define('RESOURCE_SERVER', '/');
define('RESOURCE_VERSION', '1.1');

/**
 * 数据库地址
 * @var string
 */
define('DB_PATH', '/Users/zhangshenjia/github/opendoor/server-side/code/protected/data/door.db');

/**
 * GPIO输出针脚
 * @var number
 */
define('GPIO_PIN', '7');

/**
 * 开门信号输出时间
 * @var number
 */
define('OPEN_DELAY', 0.01);

/**
 * 连续两次开门之间间隔的时间
 * @var number
 */
define('OPEN_INTERVAL', 5);
