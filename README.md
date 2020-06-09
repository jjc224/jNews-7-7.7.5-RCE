# jNews (com_jnews) 7.0.0 <= 7.7.5 - Remote Code Execution

<pre>
 ---------------------------------------------------------------------------------------------------------------------------------  
| jNews (com_jnews) 7.0.0 <= 7.7.5 - Remote Code Execution                                                            31/10/2012  | 
|                                                                                                                                 | 
| Author: Phizo (Joshua Coleman)                                                                                                  | 
| Usage:  php exploit.php -u http://target.tld -f shell.php                                                                       |
|                                                                                                                                 |
| The vulnerability affects all variations of jNews at the time of release, including those which are premium                     |
| (this is where the 7.7.5 comes in) rather than just the free version.                                                           |
|                                                                                                                                 |
| The exploit will create a file on the targeted web-app and enable you to execute arbitrary PHP code using the eval() language   | 
| construct, which can easily be replaced with something else if needed; you may encounter magic_quotes_gpc() or something alike  |
| which can be typically circumvented easily. You also may encounter a few WAFs (I did), which miserably fail and can be          |
| by making use of variable functions and alternative shell commands.                                                             |
|                                                                                                                                 |
| The dork "inurl:com_jnews," at the time of release, produced "About 37,100 results."                                            |
 ---------------------------------------------------------------------------------------------------------------------------------
</pre>
