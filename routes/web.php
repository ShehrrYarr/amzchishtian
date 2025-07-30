<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LoginRestrictionController;
use App\Http\Controllers\MasterPasswordController;

use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CustomerMessageController;
use App\Http\Controllers\LoginHistoryController;


use Illuminate\Support\Facades\Route;
use App\Models\User;


use App\Models\company;
use App\Models\group;
use App\Models\vendor;
use App\Http\Controllers\AccessoryBatchController;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


Auth::routes();
Route::post('/logout-user/{user}', [UserController::class, 'logoutUser'])->name('logoutUser');


Route::get('/', function () {
   
    return view('home');

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/adminthread', [App\Http\Controllers\AdminThreadController::class, 'index'])->name('adminthread');
Route::get('/fetchthread/{user_id}', [App\Http\Controllers\AdminThreadController::class, 'fetchThread'])->name('fetchthread');

Route::get('/userthread', [App\Http\Controllers\UserThreadController::class, 'index'])->name('userthread');
Route::get('/sendmessage/{message}/{chat_id}', [App\Http\Controllers\UserThreadController::class, 'store'])->name('sendmessage');

Route::post('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');



Route::get('/index', [App\Http\Controllers\UserController::class, 'index'])
    ->name('user.index')
    ->middleware(['auth', 'login.time.restrict']);





//vendor routes
Route::get('/showvendors', [App\Http\Controllers\VendorController::class, 'showVendors'])->name('showvendors');
Route::post('/vendors/store', [VendorController::class, 'storeVendor'])->name('storeVendor');
Route::get('/editvendor/{id}', [App\Http\Controllers\VendorController::class, 'editVendor'])->name('editvendor');
Route::put('/updatevendor', [VendorController::class, 'updateVendor'])->name('updateVendor');
Route::post('/deletevendor', [VendorController::class, 'destroyVendor'])->name('destroyVendor');
Route::get('/showvrHistory/{id}', [VendorController::class, 'showVRHistory'])->name('showVRHistory');
Route::get('/showvsHistory/{id}', [VendorController::class, 'showVSHistory'])->name('showVSHistory');
Route::get('/vendor-balance/{id}', [VendorController::class, 'getBalance'])->name('vendor.balance');
Route::get('/vendor-balance', [VendorController::class, 'getBalance'])->name('getVendorBalance');
Route::get('/receivablevendors', [VendorController::class, 'listReceivables'])->name('receivablevendors');






//company routes
Route::get('/showcompanies', [App\Http\Controllers\CompanyController::class, 'showCompanies'])->name('showcompanies');
Route::post('/company/store', [CompanyController::class, 'storeCompany'])->name('storeCompany');
Route::get('/editcompany/{id}', [App\Http\Controllers\CompanyController::class, 'editCompany'])->name('editcompany');
Route::put('/updatecompany', [CompanyController::class, 'updateCompany'])->name('updateCompany');
Route::post('/deletecompany', [CompanyController::class, 'destroyCompany'])->name('destroyCompany');

//group routes
Route::get('/showgroups', [App\Http\Controllers\GroupController::class, 'showGroups'])->name('showgroups');
Route::post('/group/store', [GroupController::class, 'storeGroup'])->name('storeGroup');
Route::get('/editgroup/{id}', [App\Http\Controllers\GroupController::class, 'editGroup'])->name('editGroup');
Route::put('/updategroup', [GroupController::class, 'updateGroup'])->name('updateGroup');
Route::post('/deletegroup', [GroupController::class, 'destroyGroup'])->name('destroyGroup');

//password routes
Route::get('/showpassword', [App\Http\Controllers\MasterPasswordController::class, 'showPassword'])->name('showpassword');
Route::post('/password/update', [MasterPasswordController::class, 'updatePassword'])->name('updatePassword');



//Accounts Routes
Route::get('/accounts/{id}', [AccountsController::class, 'showAccounts'])->name('showAccounts');
Route::post('/credit', [AccountsController::class, 'creditAmount'])->name('creditAmount');
Route::post('/debit', [AccountsController::class, 'debitAmount'])->name('debitAmount');
Route::get('/getaccount/{id}', [App\Http\Controllers\AccountsController::class, 'getaccount'])->name('getaccount');
Route::post('/deleteaccount', [AccountsController::class, 'destroyAccount'])->name('destroyAccount');







//Custom Login Restriction Routes
Route::get('/showlogin', [LoginRestrictionController::class, 'showLogin'])->name('showlogin');

Route::post('/admin/login-window', [LoginRestrictionController::class, 'updateLoginWindow'])
    ->name('admin.updateLoginWindow');

//Manage user routes
Route::get('/showusers', [UserController::class, 'showUsers'])->name('showusers');
Route::post('/store-user', [UserController::class, 'store'])->name('storeUser');
Route::get('/edituser/{id}', [App\Http\Controllers\UserController::class, 'editUser'])->name('editUser');
Route::put('/update-user', [UserController::class, 'update'])->name('updateUser');




//Accessory Routes
Route::get('/accessories', [AccessoryController::class, 'index'])->name('accessories.index');
Route::post('/accessories', [AccessoryController::class, 'store'])->name('accessories.store');
Route::get('/accessoryedit/{id}', [AccessoryController::class, 'edit'])->name('accessories.edit');
Route::put('/accessories', [AccessoryController::class, 'update'])->name('accessories.update');

//Batch Routes
Route::get('/batches', [AccessoryBatchController::class, 'index'])->name('batches.index');
Route::post('/batches', [AccessoryBatchController::class, 'store'])->name('batches.store');
Route::get('/batches/{id}/barcode', [AccessoryBatchController::class, 'barcodeInfo'])->name('batches.barcode');


//Sales Routes
Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index'])->name('sales.index');
Route::get('/sales/create', [App\Http\Controllers\SaleController::class, 'create'])->name('sales.create');
Route::post('/sales', [App\Http\Controllers\SaleController::class, 'store'])->name('sales.store');
Route::post('/sales/{id}/approve', [SaleController::class, 'approve'])->name('sales.approve');
Route::get('/sales/pending', [SaleController::class, 'pending'])->name('sales.pending');
Route::get('/sales/approved', [SaleController::class, 'approved'])->name('sales.approved');
Route::get('/sales/all', [\App\Http\Controllers\SaleController::class, 'allSales'])->name('sales.all');
Route::get('/sales/{sale}/items', [\App\Http\Controllers\SaleController::class, 'ajaxSaleItems']);



Route::get('/pos', [SaleController::class, 'pos'])->name('sales.pos');
Route::post('/pos/checkout', [SaleController::class, 'checkout'])->name('sales.checkout');
Route::get('/pos/invoice/{sale}', [SaleController::class, 'invoice'])->name('sales.invoice');
Route::get('/accessoryreport', [SaleController::class, 'accessoryReport'])->name('saccessoryreport');
Route::get('/reports/sales', [\App\Http\Controllers\SaleController::class, 'salesReport']);
// routes/web.php
Route::get('/api/vendor-balance/{id}', [VendorController::class, 'getVBalance']);





//Custoemr Mesage Routes

// Show the message form
Route::get('/send-message-to-customers', [CustomerMessageController::class, 'showSendMessageForm'])->name('send-message-to-customers');

// Handle form post (send messages)
Route::post('/send-message-to-customers', [CustomerMessageController::class, 'sendMessageToAllCustomers'])->name('send.message.submit');




Route::get('/loginhistory', [App\Http\Controllers\LoginHistoryController::class, 'getAllLogins'])->name('loginhistory');

// Return Routes
Route::post('/sales/{sale}/return', [SaleController::class, 'processReturn'])->name('sales.return');
Route::get('/sales/refunds', [SaleController::class, 'refundsPage'])->name('sales.refunds');

// Route::post('/sales/{sale}/return', [SaleController::class, 'returnItems'])->name('sales.return');





//Petty cash                   
//POS page m edaily report 
//Return accessory functionality     IMP
//daily salw approve funtionality   IMP
//total accessory count batch
//stock remind me apni mrzi se kuch a 
//TOTAL SALE PE DISCOUNT   IMP


//Name dynamic
//Search Filter
//jis sy mobile lia h
//Company , Group 
//Add multiple Entries
//Report as amzmobiles.shop
// /public/invoices/