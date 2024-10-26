<?php
namespace PHP\oop;

require_once('./Whale.php');
require_once('./FlyingSquirrel.php');
require_once('./GoldFish.php');

use PHP\oop\Whale;
use PHP\oop\FlyingSquirrel;
use PHP\oop\GoldFish;

$whale = new Whale('아람이', '바다');
$fs = new FlyingSquirrel('다람이', '산');
$goldfh = new GoldFish();
// echo $whale->printInfo();

// echo $fs->action();

// echo $whale->printInfo();
// echo $fs->printInfo();

// echo $whale->swimming();
// echo $fs->printPet();

echo $goldfh->printPet();