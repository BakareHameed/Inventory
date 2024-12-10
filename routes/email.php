<?php

use Illuminate\Support\Facades\Route;

Route::get( 'emails/employee-approval',             'App\Http\Controllers\Email\TestController@employee_approval'         );
Route::get( 'emails/employee-approved',             'App\Http\Controllers\Email\TestController@employee_approved'         );
Route::get( 'emails/prosp-client',                  'App\Http\Controllers\Email\TestController@prospective_client'        );
Route::get( 'emails/survey-report',                 'App\Http\Controllers\Email\TestController@survey_report'             );
Route::get( 'emails/engineer-survey',               'App\Http\Controllers\Email\TestController@engineer_survey'           );
Route::get( 'emails/marketer-survey-report',        'App\Http\Controllers\Email\TestController@marketer_survey_report'    );
Route::get( 'emails/deploy-to-delivery',            'App\Http\Controllers\Email\TestController@deploy_to_delivery'        );
Route::get( 'emails/deploy-to-service',             'App\Http\Controllers\Email\TestController@deploy_to_service'         );
Route::get( 'emails/setup-confirm',                 'App\Http\Controllers\Email\TestController@setup_confirmation'        );

   