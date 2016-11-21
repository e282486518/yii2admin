<?php

namespace console\controllers;

use Yii;
use yii\helpers\Console;
use yii\console\Controller;

/**
 * Class InstallController
 * @package console\controllers
 */
class InstallController extends Controller
{
    /**
     * @var string $defaultAction 默认控制器
     */
    public $defaultAction = 'install';

    /**
     * @var array $writablePaths 需要有可写权限的目录
     */
    public $writablePaths = [
        '@backend/runtime',
        '@backend/web/assets',
        '@frontend/runtime',
        '@frontend/web/assets',
        '@console/runtime',
        '@storage/cache',
        '@storage/web'
    ];

    /**
     * @var array $executablePaths 可执行文件路径
     */
    public $executablePaths = [
        '@base/yii',
    ];

    /**
     * @var string $envPath 环境配置文件
     */
    public $envPath = '@base/.env';

    /**
     * @var string $installFile 安装文件，用来标记是否安装过
     */
    public $installFile = '@storage/web/install.txt';

    /**
     * ------------------------------------------
     * 安装方法
     * ------------------------------------------
     */
    public function actionInstall()
    {
        if ($this->checkInstalled()) {
            $this->stdout("\n  ... 已经安装过.\n\n", Console::FG_RED);
            die;
        }
        $start = <<<STR
+==========================================+
| Welcome to setup yii2admin               |
| 欢迎使用 yii2admin 安装程序               |
+------------------------------------------+
| Follow the on-screen instructions please |
| 请按照屏幕上的提示操作以完成安装           |
+==========================================+

STR;
        $this->stdout($start, Console::FG_GREEN);
        copy(Yii::getAlias('@base/.env.example'), Yii::getAlias($this->envPath));
        $this->runAction('set-writable', ['interactive' => $this->interactive]);
        $this->runAction('set-executable', ['interactive' => $this->interactive]);
        $this->runAction('set-keys', ['interactive' => $this->interactive]);
        $this->runAction('set-db', ['interactive' => $this->interactive]);
        $appStatus = $this->select('设置当前应用模式', ['dev' => 'dev', 'prod' => 'prod']);
        $this->setEnv('YII_DEBUG', $appStatus == 'prod' ? 'false' : 'true');
        $this->setEnv('YII_ENV', $appStatus);
        // 迁移
        Yii::$app->runAction('migrate/up', ['interactive' => false]);
        // 清缓存
        Yii::$app->runAction('cache/flush-all', ['interactive' => false]);
        $this->setInstalled();

        $end = <<<STR
+=================================================+
| Installation completed successfully, Thanks you |
| 安装成功，感谢选择和使用 yii2admin               |
+-------------------------------------------------+
| 说明和注意事项：                                 |
| 一些基本的设置可以在.env文件里修改
+=================================================+

STR;
        $this->stdout($end, Console::FG_GREEN);
    }

    /**
     * ------------------------------------------
     * 设置需要有可写权限的目录
     * ------------------------------------------
     */
    public function actionSetWritable()
    {
        $this->setWritable($this->writablePaths);
    }

    /**
     * ------------------------------------------
     * 设置可执行文件路径
     * ------------------------------------------
     */
    public function actionSetExecutable()
    {
        $this->setExecutable($this->executablePaths);
    }

    /**
     * ------------------------------------------
     * 设置配置文件的key
     * ------------------------------------------
     */
    public function actionSetKeys()
    {
        $this->setKeys($this->envPath);
    }

    /**
     * ------------------------------------------
     * 重置安装状态 install/reset
     * ------------------------------------------
     */
    public function actionReset()
    {
        if ($this->confirm('确定要重置安装状态吗？')) {
            $this->resetInstall();
        }
    }

    /**
     * ------------------------------------------
     * 更新数据库 install/update
     * ------------------------------------------
     */
    public function actionUpdate()
    {
        \Yii::$app->runAction('migrate/up', ['interactive' => $this->interactive]);
    }

    /**
     * ------------------------------------------
     * 设置可写文件或目录
     * @param array $paths 路径数组
     * ------------------------------------------
     */
    public function setWritable($paths)
    {
        foreach ($paths as $writable) {
            $writable = Yii::getAlias($writable);
            Console::output("Setting writable: {$writable}");
            @chmod($writable, 0777);
        }
    }

    /**
     * ------------------------------------------
     * 设置可执行文件或目录
     * @param array $paths 路径数组
     * ------------------------------------------
     */
    public function setExecutable($paths)
    {
        foreach ($paths as $executable) {
            $executable = Yii::getAlias($executable);
            Console::output("Setting executable: {$executable}");
            @chmod($executable, 0755);
        }
    }

    /**
     * ------------------------------------------
     * 设置配置文件的key
     * @param string $file
     * ------------------------------------------
     */
    public function setKeys($file)
    {
        $file = Yii::getAlias($file);
        Console::output("Generating keys in {$file}");
        $content = file_get_contents($file);
        $content = preg_replace_callback('/<generated_key>/', function () {
            $length = 32;
            $bytes = openssl_random_pseudo_bytes(32, $cryptoStrong);
            return strtr(substr(base64_encode($bytes), 0, $length), '+/', '_-');
        }, $content);
        file_put_contents($file, $content);
    }

    /**
     * ------------------------------------------
     * 设置数据库配置文件
     * ------------------------------------------
     */
    public function actionSetDb()
    {
        do {
            $dbHost     = $this->prompt('dbhost(默认为中括号内的值)' . PHP_EOL, ['default' => '127.0.0.1']);
            $dbPort     = $this->prompt('dbport(默认为中括号内的值)' . PHP_EOL, ['default' => '3306']);
            $dbDbname   = $this->prompt('dbname(不存在则自动创建)' . PHP_EOL, ['default' => 'yii2admin']);
            $dbUsername = $this->prompt('dbusername(默认为中括号内的值)' . PHP_EOL, ['default' => 'root']);
            $dbPassword = $this->prompt('dbpassword' . PHP_EOL);
            $dbDsn = "mysql:host={$dbHost};port={$dbPort}";
        } while(!$this->testConnect($dbDsn, $dbDbname, $dbUsername, $dbPassword));

        $dbDsn = "mysql:host={$dbHost};port={$dbPort};dbname={$dbDbname}";
        $dbTablePrefix = $this->prompt('tableprefix(默认为中括号内的值)' . PHP_EOL, ['default' => 'yii2_']);

        $this->setEnv('DB_USERNAME', $dbUsername);
        $this->setEnv('DB_PASSWORD', $dbPassword);
        $this->setEnv('DB_TABLE_PREFIX', $dbTablePrefix);
        $this->setEnv('DB_DSN', $dbDsn);
        Yii::$app->set('db', Yii::createObject([
                'class' => 'yii\db\Connection',
                'dsn' => $dbDsn,
                'username' => $dbUsername,
                'password' => $dbPassword,
                'tablePrefix' => $dbTablePrefix,
                'charset' => 'utf8'
            ])
        );
    }

    /**
     * ------------------------------------------
     * 测试连接数据库
     * @param string $dsn
     * @param string $dbname
     * @param string $username
     * @param string $password
     * @return bool
     * ------------------------------------------
     */
    public function testConnect($dsn = '', $dbname, $username = '', $password = '')
    {
        try{
            $pdo = new \PDO($dsn, $username, $password);
            $sql = "CREATE DATABASE IF NOT EXISTS {$dbname} DEFAULT CHARSET utf8 COLLATE utf8_general_ci;";
            $pdo->query($sql);
        } catch(\Exception $e) {
            $this->stderr("\n" . $e->getMessage(), Console::FG_RED);
            $this->stderr("\n  ... 连接失败,核对数据库信息.\n\n", Console::FG_RED, Console::BOLD);
            return false;
        }
        return true;
    }

    /**
     * ------------------------------------------
     * 设置配置文件的值
     * @param $name string
     * @param $value string
     * ------------------------------------------
     */
    public function setEnv($name, $value)
    {
        $file = Yii::getAlias($this->envPath);
        $content = preg_replace("/({$name}\s*=)\s*(.*)/", "\\1 $value", file_get_contents($file));
        file_put_contents($file, $content);
    }

    /**
     * ------------------------------------------
     * 判断是否安装过
     * @return bool
     * ------------------------------------------
     */
    public function checkInstalled()
    {
        return file_exists(Yii::getAlias($this->installFile));
    }

    /**
     * ------------------------------------------
     * 设置已安装过
     * ------------------------------------------
     */
    public function setInstalled()
    {
        file_put_contents(Yii::getAlias($this->installFile), time());
    }

    /**
     * ------------------------------------------
     * 设置未安装
     * ------------------------------------------
     */
    public function resetInstall()
    {
        @unlink(Yii::getAlias($this->installFile));
    }

}


