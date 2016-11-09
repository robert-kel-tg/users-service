<?php

$app->get('/users', 'controller.users:getAll');
$app->get('/users/{id}', 'controller.users:getById');
$app->post('/users', 'controller.users:create');
