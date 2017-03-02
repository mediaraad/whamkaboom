<?php
/**
 * Created by PhpStorm.
 * User: mass-e
 * Date: 22-2-2017
 * Time: 15:58
 */

$hash = password_hash("oo", PASSWORD_DEFAULT);
echo $hash.'<br/>';
$hash1 = password_hash("oo", PASSWORD_DEFAULT);
echo $hash.'<br/>';
$hash2 = password_hash("oo", PASSWORD_DEFAULT);
echo $hash.'<br/>';
$hash3 = password_hash("oo", PASSWORD_DEFAULT);



$uitkomst = password_verify("oo",$hash);

echo $uitkomst.'--<br/>';

$uitkomst = password_verify("oo",$hash1);

echo $uitkomst.'--<br/>';
$uitkomst = password_verify("oo",$hash2);

echo $uitkomst.'--<br/>';
$uitkomst = password_verify("oo",$hash3);

echo $uitkomst.'--<br/>';
