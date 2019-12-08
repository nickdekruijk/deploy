<?php

Route::group(['middleware' => ['web']], function () {
    Route::post(config('config.route'), 'NickDeKruijk\Deploy\DeployController@deploy');
});
