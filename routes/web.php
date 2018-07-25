<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/
Route::get('/phpinfo', 'ApplicationController@info')->name('phpinfo');
// Test routes for additional features
//Route::get('/up', 'UploadController@uploadForm')->name('testup');
//Route::post('/upload', 'UploadController@uploadSubmit');
//Route::post('/product', 'UploadController@postProduct');
/*
Route::get('/import', 'ImportController@public_update')->name('userimport');

Route::get('/fileupload', 'FileController@index')->name('fileupload');
Route::post('/add-category', ['as'=>'catagory_add','uses'=>'FileController@catadd']);

Route::get('dropzone', 'FileController@dropzone');
Route::post('dropzone/store', ['as'=>'dropzone.store','uses'=>'FileController@dropzoneStore']);

Route::get('/mail', 'MailController@index');
Route::get('/send', 'MailController@send');

Route::get('/newsletter', 'ImportController@newsletter');
*/
// Homepage Route
//Route::get('/subscriber', 'MailController@subscriber');


Route::get('/', 'WelcomeController@welcome')->name('welcome');

Route::get('/faq', 'WelcomeController@faq')->name('faq');
Route::get('/privacy', 'WelcomeController@privacy')->name('privacy');
Route::get('/imprint', 'WelcomeController@imprint')->name('imprint');

Route::get('/offline', 'WelcomeController@offline')->name('offline');
// Switch locale Config in confic locale
Route::get('lang/{lang}', ['as'=>'lang.switch', 'uses'=>'LanguageController@switchLang']);


// Authentication Routes
Auth::routes();

// Public Routes
Route::group(['middleware' => 'web'], function () {

    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');

    //  Homepage Route - Redirect based on user role is in controller.
    Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'        => '{username}',
        'uses'      => 'ProfilesController@show',
    ]);


    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController',
        [
            'only'  => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'        => '{username}',
        'uses'      => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'        => '{username}',
        'uses'      => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'        => '{username}',
        'uses'      => 'ProfilesController@deleteUserAccount',
    ]);

    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        'uses'      => 'ProfilesController@userProfileAvatar',
    ]);

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
  });

Route::group(['middleware'=> ['auth', 'activated', 'currentUser', 'application_status']], function () {
    // route for choose file uploads form after application is created
    Route::get('application_success/{id}', [
        'uses'      => 'ApplicationController@applicactionSuccess',
    ])->name('application_success');

    //route for application media upload

    Route::get('application/imageupload/upload/{id}/{type}', [
        'uses'      => 'MediaController@imageUpload',
    ])->name('imageupload');

    Route::put('application/imageupload/{id}/', [
        'uses'      => 'MediaController@imageStore',
    ])->name('imagestore');

    Route::get('application/videoupload/{id}/{type}', [
        'uses'      => 'MediaController@videoUpload',
    ])->name('videoupload');

    Route::put('application/videoupload/{id}/', [
        'uses'      => 'MediaController@videoStore',
    ])->name('videostore');

    Route::get('application/audioupload/{id}/{type}', [
        'uses'      => 'MediaController@audioUpload',
    ])->name('audioupload');

    Route::put('application/audioupload/{id}/', [
        'uses'      => 'MediaController@audioStore',
    ])->name('audiostore');

    Route::get('application/pdfupload/{id}/{type}', [
        'uses'      => 'MediaController@pdfUpload',
    ])->name('pdfupload');

    Route::put('application/pdfupload/{id}/', [
        'uses'      => 'MediaController@pdfStore',
    ])->name('pdfstore');

    Route::get('/media/{id}/edit', 'MediaController@edit')->name('editmedia');
    // Delete Media and Application routes

    Route::delete('deleteimage/{id}', ['as' => 'delete-image', 'uses' =>'DeleteController@deleteImage']);
    Route::delete('deletevideo/{id}', ['as' => 'delete-video', 'uses' =>'DeleteController@deletevideo']);
    Route::delete('deleteaudio/{id}', ['as' => 'delete-video', 'uses' =>'DeleteController@deleteaudio']);
    Route::delete('deletepdf/{id}', ['as' => 'delete-pdf', 'uses' =>'DeleteController@deletepdf']);
    Route::get('applications/create/{activity_id}', [
        'uses'      => 'ApplicationController@create',
    ])->name('applications.create');

    Route::resource('applications', 'ApplicationController', [
    'names' => [
        'index' => 'applications',
        'show' => 'application.show',
        'create' => 'application.create',
        'destroy' => 'application.destroy',
        'store' => 'application.store'
    ],
    'except' => [
        'deleted'
    ]
    ]);


    // route to media
    //Route::post('upload/delete', ['as' => 'upload-remove', 'uses' =>'MediaController@destroy']);


    // Can (maybe) deleted later
    Route::resource('media', 'MediaController', [
    'names' => [
        'index' => 'media',
        'show' => 'media.show',
        'create' => 'media.create',
        'destroy' => 'media.destroy',
        'store' => 'media.store'
    ],
    'except' => [
        'deleted'
    ]
    ]);
});
// Registered, activated, and is admin or jury routes >= level 3.
Route::group(['middleware'=> ['auth', 'activated','level:3']], function () {
    Route::get('jury/index', 'JuryController@index')->name('jury.index');
    Route::get('jury/art', 'JuryController@art')->name('jury.art');
    Route::get('jury/literatur', 'JuryController@literature')->name('jury.literature');
    Route::get('jury/show/{id}', 'JuryController@show')->name('jury.show');
});
// Registered, activated, and is admin routes.
Route::group(['middleware'=> ['auth', 'activated', 'role:admin']], function () {
    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);
    Route::get('/clear-cache', function() {
        $exitCode = Artisan::call('cache:clear');
        // return what you want
    });
    Route::put('jurypropose/{id}/', [
        'uses'      => 'ApplicationController@jurypropose',
    ])->name('jurypropose');

    Route::post('search_user', [
        'uses'      => 'JuryController@searchUser',
    ])->name('search_user');

    Route::get('show_applications', [
        'uses'      => 'JuryController@showApplications',
    ])->name('show_applications');

    Route::delete('jurypropose_reset', [
        'uses'      => 'ApplicationController@jurypropose_reset',
    ])->name('jurypropose_reset');

    Route::resource('applicationconfig', 'ApplicationConfigController', [
    'names' => [
        'index' => 'applicationconfig',
        'show' => 'applicationconfig.show',
        'create' => 'applicationconfig.create',
        'destroy' => 'applicationconfig.destroy',
        'store' => 'applicationconfig.store'
    ],
    'except' => [
        'deleted'
    ]
    ]);

    Route::resource('applicationinfos', 'ApplicationInfosController', [
    'names' => [
        'index' => 'applicationinfo',
        'show' => 'applicationinfo.show',
        'create' => 'applicationinfo.create',
        'destroy' => 'applicationinfo.destroy',
        'store' => 'applicationinfo.store'
    ],
    'except' => [
        'deleted'
    ]
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('php', 'AdminDetailsController@listPHPInfo');
    Route::get('routes', 'AdminDetailsController@listRoutes');
});
