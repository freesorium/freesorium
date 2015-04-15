<?php
/**
 * Created by PhpStorm.
 * User: zhek
 * Date: 15.04.15
 * Time: 11:37
 */

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents about page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class UserPage extends BasePage
{
    public $route = 'user/index';
}
