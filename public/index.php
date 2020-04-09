<?php
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

try {
    require_once APP_PATH . '/config/loader.php';
    $di = new \Phalcon\Di\FactoryDefault();

    $providers = require APP_PATH.'/config/providers.php';

    if(!empty($providers)){
        foreach ($providers as $provider){
            $di->register(new $provider);
        }
    }

    $app = new \Phalcon\Mvc\Micro();

    $app->setDI($di);

    require_once APP_PATH . '/config/router.php';

    $app->before(function () use($di){
       $isAuth = $di->get('authentication');

       if(!$isAuth){
           throw new \App\Helpers\Exceptions\Http401Exception('Unauthorized', 401);
       }
    });


    $app->after(function () use ($app) {
        $response = $app->getReturnedValue();
        $app->response->setContent(json_encode($response));
        $app->response->send();
    });

    $app->handle($_SERVER["REQUEST_URI"]);

}catch (\App\Helpers\Exceptions\AbstractHttpException $e){
    $response = $app->response;
    $response->setStatusCode($e->getCode(), $e->getMessage());
    $response->setJsonContent($e->_get());
    $response->send();
}catch (\Phalcon\Http\Request\Exception $e){
    $app->response->setStatusCode(400, "Bad request")
        ->setJsonContent([
            \App\Helpers\Exceptions\AbstractHttpException::KEY_CODE => 400,
            \App\Helpers\Exceptions\AbstractHttpException::KEY_MESSAGE => 'Bad request'
        ])
        ->send();
}catch (Exception $e){
    $app->response->setStatusCode(500, "Internal Server Error")
        ->setJsonContent([
            \App\Helpers\Exceptions\AbstractHttpException::KEY_CODE => 500,
            \App\Helpers\Exceptions\AbstractHttpException::KEY_MESSAGE => "Internal Server Error"
        ])
        ->send();
}
