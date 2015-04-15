<?php
/**
 * Created by PhpStorm.
 * User: zhek
 * Date: 15.04.15
 * Time: 11:39
 */

use tests\codeception\_pages\UserPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that user page works');
UserPage::openBy($I);
$I->see('user/index', 'h1');
