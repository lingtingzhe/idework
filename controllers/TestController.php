<?php

namespace app\controllers;

use Symfony\Component\Console\Helper\Table;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Test;
use xj\rsa\RsaPrivate;
use xj\rsa\RsaPublic;

class TestController extends Controller
{
    public function actionUrl()
    {
        $java_path = '/member/certification/checkThree';

        $url = explode('/', $java_path);

        if ($url[0] == ""){
            $path = $this->_javaError($url[1], $url[2], $url[3]);
        }else{
            $path = $this->_javaError($url[0], $url[1], $url[2], $url[3], $url[4], $url[5], $url[6]);
        }

        var_dump($path);die;
    }
    public function _javaError($modules=null, $controller=null, $method=null) {
        if ($modules ==null){
            return false;
        }
        if ($controller ==null){
            return false;
        }
        if ($method ==null){
            return false;
        }
        return $modules."/".$controller."/".$method;


    }





    public function actionIndex(){
		//init
//		$privateKey = '@common/config/key-private.php';
//		$publicKey = '@common/config/key-public.php';
        $privateKey = '@app/common/config/key-private.php';
        $publicKey = '@app/common/config/key-public.php';
		$str = 'yii2-rsa';

		//private encrypt -> public decrypt
		$privateEncryptString = RsaPrivate::model($privateKey)->encrypt($str);
		$publicDecryptString = RsaPublic::model($publicKey)->decrypt($privateEncryptString);
		var_dump('private', $str, $privateEncryptString, $publicDecryptString);

		//public encrypt -> private decrypt
		$publicEncryptString = RsaPublic::model($publicKey)->encrypt($str);
		$privateDecryptString = RsaPrivate::model($privateKey)->decrypt($publicEncryptString);
		var_dump('public', $str, $publicEncryptString, $privateDecryptString);

	}
}
