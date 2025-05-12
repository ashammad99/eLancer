<?php

use App\Http\Controllers\Client\ProjectsController;
use Illuminate\Support\Facades\Route;




//project.index
//project.create

/**
 * names function used to give name for routes,change default names of resource routes because there several routes
 * for projects, such as projects that created from user, projects that taken by freelancer, and projects that all
 * seen by visitors
 */
/*
Route::resource('projects', ProjectsController::class)->names([
    'index' => 'client.projects.index',
    'create' => 'client.projects.create',
]);
*/
//or we can use group route with prefix client, without change name of routes
Route::group([
    'prefix' => 'client',
    'as' => 'client.',
    'middleware' => ['auth'],
//    'namespace' => 'Client',
], function() {

    Route::resource('projects',App\Http\Controllers\Client\ProjectsController::class );

});
