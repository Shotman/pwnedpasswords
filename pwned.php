<?php
array_shift($argv);
foreach($argv as $passwd){
    $hash = sha1($passwd);
    $first5 = substr($hash,0,5);
    $rest = substr($hash,5);
    $list = file_get_contents('https://api.pwnedpasswords.com/range/'.$first5);
    $matches = [];
    $haveMatch = preg_match('@('.$rest."):(\d+)*@im",$list,$matches);
    if($haveMatch){
        $pwned = $matches[2];
        echo("\e[1;31;40m".$passwd.' ['.$hash.'] has been pwned '.$pwned. ($pwned > 1 ? ' times.' : ' time.') . "\e[0m\n" );
    }
	else{
        echo("\e[0;32;40m".'This password is safe'."\e[0m\n");
	}
}
?>
