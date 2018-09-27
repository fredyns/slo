<?php
/**
 * Initiation file
 * used to insert some code before execute ```web/index.php```
 */

// enable debug in localhost
if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'localhost') {
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}

