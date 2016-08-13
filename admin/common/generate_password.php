<?php
function generate_username($char_count)
{
	$genuname = "";
  	#define possible characters
  	$possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
	
  	#set up a counter
  	$i = 0; 
  	// add random characters to $password until $length is reached
  	while ($i < $char_count) 
	{ 
    	#pick a random character from the possible ones
    	$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    	// we don't want this character if it's already in the password
    	if (!strstr($genuname, $char)) 
		{ 
      		$genuname .= $char;
      		$i++;
    	}
  	} 
	return $genuname;
}

function generate_password($char_count)
{
	$genpassword = "";
  	#define possible characters
  	$possible = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!#@$%^&*()+-_=\/?"; 
	
  	#set up a counter
  	$i = 0; 
  	// add random characters to $password until $length is reached
  	while ($i < $char_count) 
	{ 
    	#pick a random character from the possible ones
    	$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
    	// we don't want this character if it's already in the password
    	if (!strstr($genpassword, $char)) 
		{ 
      		$genpassword .= $char;
      		$i++;
    	}
  	} 
	return $genpassword;
}
?>