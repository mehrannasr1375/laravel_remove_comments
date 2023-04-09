<?php
/*
 *  Just Run this script on this way:
 *    1. copy this file & put it into laravel app root directory.
 *    2. open a new terminal and run: `php ./run_this.php`
 *
 *  All Done!
 *
 *  put each directory name that you want to remove comments from it, into `$directories` array
 */

$directories = [
  'app',
  'config',
  'database',
  'public',
  'resources',
  'routes',
];

$base_path = './';

foreach ($directories as $directory) {
    $iterator = new RecursiveDirectoryIterator($base_path . $directory);
    
	foreach (new RecursiveIteratorIterator($iterator) as $file) {
        if ($file->getExtension() == 'php') {
            echo "Removing comments from: " . $file->getRealPath() . "\n";
            $contents = file_get_contents($file->getRealPath());
            $new = preg_replace('/^(\{?)\s*?\/\*(.|[\r\n])*?\*\/([\r\n]+$|$)/im', '$1', $contents);
            file_put_contents($file->getRealPath(), $new);
        }
    }
}
