<?php
$messages = new \Phalcon\Mvc\Micro\Collection();
$messages->setHandler('\App\Controllers\MessagesController', true);
$messages->setPrefix('/sms');


$messages->get('/send', 'sendAction');
$messages->get('/status/{messageId:[0-9]+}' ,'statusAction');

$app->mount($messages);

// not found URLs
$app->notFound(
    function () use ($app) {
        $exception =
            new \App\Helpers\Exceptions\Http404Exception(
                _('URI not found or error in request.'),
                404,
                new \Exception('URI not found: ' . $app->request->getMethod() . ' ' . $app->request->getURI())
            );
        throw $exception;

    }
);
