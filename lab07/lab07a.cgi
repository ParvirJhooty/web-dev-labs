#!/usr/bin/perl
use strict;
use warnings;

print "Content-type: text/html\n\n";
print <<HTML;
<!DOCTYPE html>
<html>
<head>
    <title>My First Perl Program</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap">
    <style>
        body {
            text-align: center;
            margin-top: 200px;
            font-family: 'Open Sans', sans-serif; 
            color: #008000; 
            font-size: 5em;
        }
    </style>
</head>
<body>
    <div>This is my first Perl program</div>
</body>
</html>
HTML
