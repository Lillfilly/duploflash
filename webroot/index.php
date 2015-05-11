<?php
/**
*This is a Anax pagecontroller
*/
//Include configs
require __DIR__ . '/config_with_app.php';

//Create services and inject into the app
$di->set('flash', function() use ($di){
    $flash = new \Duplo\Flash\FlashInSession();
    $flash->setDI($di);
    return $flash;
});

//Home route
$app->router->add('', function() use ($app) {
    $app->theme->setTitle('Flash example');
    $app->flash->saveMessage('This is a saved message');
    $app->views->addString('<a href="index.php/viewmessage">Send message to other route</a>');
});

//Some other route
$app->router->add('viewmessage', function() use ($app) {
    $app->theme->setTitle('Flash example');
    $app->views->addString('<pre>' . print_r($app->flash->getMessages(), true) . '</pre><a href="../index.php">Tillbaka</a>');
});

// Check for matching routes and dispatch to controller/handler of route
$app->router->handle();

//Render the page
$app->theme->render();