#!/usr/bin/php
<?php

# change to current directory
chdir(__DIR__);

# create a filename for the emlx file
list($ms, $time) = explode(' ', microtime());
$filename = date('Y-m-d h.i.s,', $time) . substr($ms, 2, 3) . '.eml';

# write the email contents to the file
$email_contents = fopen('php://stdin', 'r');
$fstat = fstat($email_contents);
file_put_contents($filename, $fstat['size'] . "\n");
file_put_contents($filename, $email_contents, FILE_APPEND);

# open up the emlx file (using Apple Mail)
exec('open ' . escapeshellarg($filename));

# prune emails older than 30 days
exec('find . -name "*.eml" -mtime +30 -delete');
