<?php

namespace app\controllers;

/**
 * Class UserController
 * @package app\controllers
 * @author eudj1n
 */
class UserController extends \yii\web\Controller
{
    /**
     * Show users list
     * @see /users
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login page
     * @return string
     */
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        return $this->render('login');
    }

    /**
     * Logout page
     * @return string
     */
    public function actionLogout()
    {
        return $this->render('logout');
    }

    /**
     * Profile page
     * @return string
     */
    public function actionProfile()
    {
        return $this->render('profile');
    }

    /**
     * Register page
     * @return string
     */
    public function actionRegister()
    {
        return $this->render('register');
    }

}
