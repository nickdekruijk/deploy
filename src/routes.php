<?php

Route::group(['middleware' => ['web']], function () {
    Route::post(config('deploy.route'), 'NickDeKruijk\Deploy\DeployController@deploy');
});
