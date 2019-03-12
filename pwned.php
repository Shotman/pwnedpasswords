<?php
if($argc === 2){
    $passwd = $argv[1];
    $hash = sha1($passwd);
    $first5 = substr($hash,0,5);
    $rest = substr($hash,5);
    $list = file_get_contents('https://api.pwnedpasswords.com/range/'.$first5);
    $matches = [];
    $haveMatch = preg_match('@'.$rest.":(\d)*@im",$list,$matches);
    if($haveMatch){
        $pwned = $matches[1];
        echo("\e[1;31;40m".$passwd.' ['.$hash.'] has been pwned '.$pwned. ($pwned > 1 ? ' times.' : ' time.') . "\e[0m\n" );
        exit(0);
    }
    echo("\e[0;32;40m".'This password is safe'."\e[0m\n");
    exit(0);
}
print("\e[1;33;40m"."Please enter a password and one password only"."\e[0m\n");
exit(1);
?>
