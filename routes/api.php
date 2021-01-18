<?php

use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\GiftAidController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\GocardlessController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);
    Route::get('users', [UsersController::class, 'index']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);

    // Student Routes Starts 
    Route::post('student/store', [StudentController::class, 'store']);
    Route::post('student/update', [StudentController::class, 'update']);
    Route::get('student/getHafizStudents', [StudentController::class, 'getHafizStudents']);
    Route::get('student/getScholarStudents', [StudentController::class, 'getScholarStudents']);
    Route::get('student/getSingleStudent/{id}', [StudentController::class, 'getSingleStudent']);
    
    // Donation Routes Starts 
    Route::post('donation/store', [DonationController::class, 'store']);
    Route::get('donation/getDonations', [DonationController::class, 'getDonations']);
    Route::get('donation/getSingleDonation/{id}', [DonationController::class, 'getSingleDonation']);
    Route::get('getProjects', [DonationController::class, 'getProjects']);

    // Donation Module Routes
    Route::get('getAllUnAllocatedDonations',[SponsorshipController::class,'getAllUnAllocatedDonations']);
    Route::post('fund_students',[SponsorshipController::class,'fund_students']);

    // Gift Aid Section Routes
    Route::get('getAllDonationsWithGiftaid',[GiftAidController::class,'getAllDonationsWithGiftaid']);
    Route::get('submittedGiftAidsList',[GiftAidController::class,'submittedGiftAidsList']);
    Route::get('getAllClaimedDonations',[GiftAidController::class,'getAllClaimedDonations']);
    Route::post('markAllDonationsAsGiftAid',[GiftAidController::class,'markAllDonationsAsGiftAid']);
    Route::post('markAllSelectedasClaimed',[GiftAidController::class,'markAllSelectedasClaimed']);
    Route::post('markAllSelectedasNew',[GiftAidController::class,'markAllSelectedasNew']);
    Route::post('closeAllGeneratedDonations',[GiftAidController::class,'closeAllGeneratedDonations']);
    Route::post('editOrderDetails',[GiftAidController::class,'editOrderDetails']);

    // Reporting Routes
    Route::post('reports',[ReportController::class,'reports']);
    
    Route::prefix('settings')->group(function () {
        
        // Roles Routes
        Route::get('roles', [RolesController::class,'fetch']);
        Route::post('role/store', [RolesController::class,'store']);
        Route::get('role/edit/{id}', [RolesController::class,'edit']);
        Route::post('role/destroy', [RolesController::class,'destroy']);
        Route::get('role/getAllRoles', [RolesController::class,'getAllRoles']);
        
        // Permission Routes
        Route::get('permissions', [PermissionController::class,'fetch']);
        Route::post('permission/store', [PermissionController::class,'store']);
        Route::get('permission/edit/{id}', [PermissionController::class,'edit']);
        Route::post('permission/destroy', [PermissionController::class,'destroy']);
        Route::get('permission/getAllPermissions', [PermissionController::class,'getAllPermissions']);
        Route::post('permission/getAllPermissionsWithGroup', [PermissionController::class,'getAllPermissionsWithGroup']);
        Route::post('permission/assignPermission', [PermissionController::class,'assignPermission']);
        Route::get('permission/getUserPermissions', [PermissionController::class,'getUserPermissions']);

        // Admin Options Routes
        Route::get('options',[OptionsController::class,'fetch']);
        Route::post('option/store',[OptionsController::class,'store']);
        Route::get('option/edit',[OptionsController::class,'edit']);

        // Admin Options Routes
        Route::post('user/store',[UserController::class,'store']);
        Route::post('user/update',[UserController::class,'update']);
        Route::post('user/destroy', [UserController::class,'destroy']);
        Route::post('user/edit', [UserController::class,'edit']);

    });
   
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
    
    Route::post('getneworderdata', [DonationController::class, 'getneworderdata']);
});


Route::post('gocardless_webhook', [GocardlessController::class, 'updateWebhook']);
Route::post('gocardless_create_customer', [GocardlessController::class, 'gocardless_create_customer']);
// Route::post('gocardless_webhook', function (Request $request) {

//     // payment
//     // mandate
//     // payer_authorisation
//     // payout
//     // refund
//     // subscription
//     // instalment_schedule
//     // creditor
//     // dd($request->all());
//     Log::info($request->header('Webhook-Signature'));
//     Log::info($request->all());
//     return 'hello';
// });

// Route::post('gocardless_create_customer', function (Request $request) {
//     // dd($request->all());
//     Log::info($request->header('Webhook-Signature'));
//     Log::info($request->all());
//     return 'hello';
// });