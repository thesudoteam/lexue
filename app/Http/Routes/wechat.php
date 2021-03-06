<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 14/07/16
 * Time: 2:18 PM
 */

/*
|--------------------------------------------------------------------------
| Everything here is in "wechat.<domain>"
|--------------------------------------------------------------------------
*/

/*
 * General requests - no names needed
 */
Route::get('weixin', ['as' => 'verify', 'uses' => 'WechatController@verify']);
Route::post('weixin', ['as' => 'user_request', 'uses' => 'WechatController@serve']);

/*
 * MP setup tools - normally they are POST requests sent to Wechat server
 */
Route::get('weixin/menu', ['as' => 'menu', 'uses' => 'WechatController@setMenu']);
Route::get('weixin/industry', ['as' => 'industry', 'uses' => 'WechatController@setIndustry']);

/*
 * OAuth
 */
Route::get('weixin/auth', ['as' => 'auth.redirect', 'uses' => 'Auth\WechatAuthController@redirectToProvider']);
Route::get('weixin/auth/callback', ['as' => 'auth.callback', 'uses' => 'Auth\WechatAuthController@handleProviderCallback']);

/*
 * WX Pay
 */
Route::any('weixin/pay/callback', ['as' => 'pay.callback', 'uses' => 'Student\OrderController@handleLecturePaymentCallback']);