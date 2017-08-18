# Url-Shorter
Make Your Own Url Shorner Apps Using PHP

in .htaccess file 
you have to define your base path as I define below

RewriteEngine On
RewriteRule ^([^/]+)/? index.php?code=$1 [L,QSA]

