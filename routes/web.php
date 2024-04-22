<?php

Route::prefix('admin')->namespace('Admin')->middleware('auth')
        ->group(function(){
    
    /**
     * Routes Categories
     */
    Route::any('categories/search', 'CategoryController@search')->name('categories.search');
    Route::resource('categories', 'CategoryController');       
     
    /**
     * Routes Users
     */
    Route::any('users/search', 'UserController@search')->name('users.search');
    Route::resource('users', 'UserController');
            
    /**
     * Routes Plan x Profile
     */
    Route::get('plan/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachPlanProfile')->name('plan.profile.detach');
    Route::post('plan/{id}/profiles', 'ACL\PlanProfileController@attachProfilesProfile')->name('plan.profiles.attach');
    Route::any('plan/{id}/profiles/search', 'ACL\PlanProfileController@filterProfilesAvailable')->name('plan.profiles.available.search');
    Route::get('plan/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plan.profiles.available');
    Route::get('plan/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plan.profiles');
    
    /**
     * Routes Permission x Profile
     */
    Route::get('profile/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionProfile')->name('profile.permission.detach');
    Route::post('profile/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profile.permissions.attach');
    Route::any('profile/{id}/permissions/search', 'ACL\PermissionProfileController@filterPermissionsAvailable')->name('profile.permissions.available.search');
    Route::get('profile/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profile.permissions.available');
    Route::get('profile/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profile.permissions');
    
    /**
     * Routes Permissions
     */
    Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
    Route::resource('permissions', 'ACL\PermissionController');
    
    /**
     * Routes Profiles
     */
    Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
    Route::resource('profiles', 'ACL\ProfileController');
    
    /*
     * Routes Details Plans
     */
    Route::delete('plans/{url}/details/{idDetail}', 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/create', 'DetailPlanController@create')->name('details.plan.create');
    Route::get('plans/{url}/details/{idDetail}', 'DetailPlanController@show')->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}', 'DetailPlanController@update')->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit')->name('details.plan.edit');
    Route::post('plans/{url}/details', 'DetailPlanController@store')->name('details.plan.store');
    Route::get('plans/{url}/details', 'DetailPlanController@index')->name('details.plan.index');
    
    /**
     * Routes Plans
     */
    Route::get('plans/create', 'PlanController@create')->name('plans.create');
    Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
    Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
    Route::any('plans/search', 'PlanController@search')->name('plans.search');
    Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
    Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
    Route::get('plans', 'PlanController@index')->name('plans.index');
    Route::post('plans', 'PlanController@store')->name('plans.store');

    /*
     * Home Dashboard
     */
    Route::get('/', 'PlanController@index')->name('admin.index');
    
});

/**
* Site Routes
*/

Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');

/**
* Auth Routes
*/
Auth::routes();