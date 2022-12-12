<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\User;

/**
 * Эта команда регистрирует администратора
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AdminController extends Controller
{
    /**
     * 
     * @param 
     * @return 
     */
    public function actionIndex($email, $password)
    {
        $user = new User();
        $user->beforeSave(true);
        $user->email = $email;
        $user->firstname = 'admin';
        $user->surname = 'admin';
        $user->patronymic = 'admin';
        $user->password_hash = $password;
        $user->type = User::getAdmin();
        $user->is_admin = true;
        $user->save();
        echo "Администратор создан!" . PHP_EOL;
        return ExitCode::OK;
    }
}
