<?php
/* front pages */
Route::group(['middleware' => ['front_session']], function () {
    Route::get('/', 'FrontController@index')->name('home');
    Route::get('/registration', 'FrontController@register')->name('register');
    Route::post('/register', 'FrontController@store')->name('registration');
    Route::get('/confirmation', 'FrontController@email_verify')->name('email_verify');
    Route::post('/check_email', 'FrontController@emailCheck')->name('chck-email');
    Route::post('/email_verify/done', 'FrontController@email_verified')->name('email_verified');
    Route::get('/password/reset', 'FrontController@password_reset')->name('password-reset');
    Route::post('/password/reset/mail_send', 'FrontController@password_reset_mail')->name('password-reset-mail');
    Route::get('/password/reset/{code}', 'FrontController@password_reset_code')->name('password-reset-code');
    Route::post('/password/reset/code_send', 'FrontController@password_code_send')->name('password-code-send');
    Route::get('/login', 'FrontController@login')->name('login');
    Route::post('/login/verify', 'FrontController@verify')->name('verify');
    Route::get('/about', 'FrontController@about')->name('about');
    Route::get('/app', 'FrontController@app')->name('app');
    Route::get('/shop', 'FrontController@shop')->name('shop');
    Route::get('/blog', 'FrontController@blog')->name('blog');
    Route::get('/blog/{name}', 'FrontController@link')->name('blog-link');
    Route::get('/contact', 'FrontController@contact')->name('contact');
    Route::post('/contact/send', 'FrontController@send_contact')->name('send-contact');
    Route::get('/error/{id}', 'FrontController@error')->name('error');
    Route::post('/message/send', 'FrontController@message')->name('message-to-admin');
});
/* shop/company part */
Route::group(['middleware' => ['session']], function () {
	Route::get('/logout', 'CompanyController@logout')->name('logout');
	/* header part */
    Route::get('/profile', 'CompanyController@profile')->name('profile');
    Route::post('/profile/edit', 'CompanyController@update')->name('edit-profile');
    Route::get('/support', 'CompanyController@support')->name('support');
    Route::get('/message', 'CompanyController@admin_message')->name('admin-message');
    Route::post('/support/send', 'CompanyController@support_contact')->name('support-contact');
    Route::get('/password_change', 'CompanyController@password')->name('cng_pass');
    Route::post('/passwordchange', 'CompanyController@password_change')->name('update_password');
/* dashboard & company info page*/
Route::get('/dashboard', 'CompanyController@index')->name('dashboard');
Route::get('/dashboard/ajax', 'CompanyController@getData')->name('dashboard-getData');
Route::post('/dashboard/', 'CompanyController@index_search')->name('dashboard-search');
Route::post('/dashboard/search', 'CompanyController@headerSearch')->name('header-search');
Route::get('/company/information', 'CompanyController@info')->name('info');
Route::post('/company/information/update', 'CompanyController@info_update')->name('info_update');
Route::get('/company/payment_information', 'CompanyController@payment_info')->name('payment_info');
Route::post('/company/payment_information/update', 'CompanyController@payment_info_update')->name('p_info_update');
/* company/sales */
Route::get('/sales/add', 'SalesController@index')->name('sales');
Route::post('/sales/add', 'SalesController@store')->name('sales-add');
Route::get('/sales/getData', 'SalesController@getData')->name('getData');
Route::get('/sales/manage', 'SalesController@manage')->name('sales-manage');
Route::get('/sales/manage/ajax', 'SalesController@sale_getData')->name('sale-getData');
Route::post('/sales/invoice', 'SalesController@invoice')->name('sl-invoice');
Route::post('/sales/manage/pay', 'SalesController@pay')->name('sl-pay');
Route::post('/sales/return', 'SalesController@return')->name('sl-return');
Route::get('/sales/returnData/{id}', 'SalesController@returnData')->name('returnData');
Route::post('/sales/return_add', 'SalesController@return_update');
Route::post('/sales/manage/update', 'SalesController@update')->name('sl-update');
Route::post('/sales/manage/destroy', 'SalesController@destroy')->name('sl-destroy');
Route::get('/sales/paid', 'SalesController@paid')->name('sales-paid');
Route::get('/sales/paid/ajax', 'SalesController@paid_getData')->name('paid-getData');
Route::get('/sales/credit', 'SalesController@unpaid')->name('sales-unpaid');
Route::get('/sales/credit/ajax', 'SalesController@unpaid_getData')->name('unpaid-getData');
/* company/product */
Route::get('/product/add', 'ProductController@index')->name('product');
Route::post('/product/add', 'ProductController@store')->name('product-add');
Route::get('/product/manage', 'ProductController@manage')->name('product-manage');
Route::get('/product/manage/ajax', 'ProductController@getData')->name('product-getData');
Route::post('/product/barcode', 'ProductController@barcode')->name('product-barcode');
Route::post('/product/manage/update', 'ProductController@update')->name('p-update');
Route::post('/product/manage/destroy', 'ProductController@destroy')->name('p-destroy');
Route::get('/product/category', 'ProductController@category')->name('product-category');
Route::get('/product/category/ajax', 'ProductController@category_getData')->name('pc-getData');
Route::post('/product/category/add', 'ProductController@category_store')->name('pc-add');
Route::post('/product/category/update', 'ProductController@category_update')->name('pc-update');
Route::post('/product/category/destroy', 'ProductController@category_destroy')->name('pc-destroy');
/* company/stock */  /*add product to stock: name: product-add */ /* store update delete in product controller */
Route::get('/stock/manage', 'StockController@index')->name('stock');
Route::get('/stock/manage/ajax', 'StockController@getData')->name('stock-getData');
Route::get('/stock/alert', 'StockController@stock_alert')->name('stock-alert'); /* only used this from dashboard stock alert */
Route::get('/stock/alert/ajax', 'StockController@alertGetData')->name('alert-getData');
Route::post('/stock/manage/add', 'ProductController@subproduct_store')->name('sp-add');
Route::post('/stock/manage/return', 'ExpenseController@return')->name('stock-return');
Route::get('/stock/subproduct/{barcode}', 'StockController@subProduct')->name('subProduct');
Route::post('/stock/manage/statement', 'StockController@statement')->name('statement');
Route::get('/stock/manage/statement/ajax', 'StockController@statementGetData')->name('statement-getData');
//Route::post('/stock/manage/statement/destroy', 'ExpenseController@statement_destroy')->name('st-destroy');
Route::post('/stock/manage/update', 'ProductController@subproduct_update')->name('sp-update');
/* company/expired    delete (p-destroy) & update (p-update)*/
Route::get('/expire/manage', 'ExpenseController@expire')->name('expire');
Route::get('/expire/manage/ajax', 'ExpenseController@expire_getData')->name('expire-getData');

/* company/staff */
Route::get('/staff/add', 'StaffController@index')->name('staff');
Route::post('/staff/add_staff', 'StaffController@store')->name('add-staff');
Route::post('/staff/check_email', 'StaffController@emailCheck')->name('check-email');
Route::get('/staff/manage', 'StaffController@manage')->name('staff-manage');
Route::get('/staff/manage/ajax', 'StaffController@staff_getData')->name('staff-getData');
Route::post('/staff/manage/update', 'StaffController@update')->name('staff-update');
Route::post('/staff/destroy', 'StaffController@destroy')->name('staff-destroy');

/* company/customer */
Route::get('/customer/add', 'CustomerController@index')->name('customer');
Route::post('/customer/add', 'CustomerController@store')->name('customer-add');
Route::get('/customer/manage', 'CustomerController@manage')->name('customer-manage');
Route::get('/customer/manage/ajax', 'CustomerController@customer_getData')->name('customer-getData');
Route::get('/customer/inv/ajax', 'CustomerController@customer_invoice_getData')->name('customer-invoice-getData');
Route::post('/customer/manage/update', 'CustomerController@update')->name('cm-update');
Route::post('/customer/manage/destroy', 'CustomerController@destroy')->name('cm-destroy');
Route::get('/customer/credit', 'CustomerController@credit')->name('customer-credit');
Route::get('/customer/credit/ajax', 'CustomerController@credit_getData')->name('credit-customer-getData');
Route::get('/customer/paid', 'CustomerController@paid')->name('customer-paid');
Route::get('/customer/paid/ajax', 'CustomerController@paid_getData')->name('paid-customer-getData');

/* Product Company */
Route::get('/product/company/add-new','ProductController@pro_company_create')->name('product-company-add');
Route::get('/product/company','ProductController@pro_company')->name('product-company');
Route::get('/product/company/ajax', 'ProductController@company_getData')->name('pc-companyGetData');
Route::post('/product/company/add', 'ProductController@company_store')->name('proCompany-add');
Route::post('/product/company/update', 'ProductController@company_update')->name('proCompany-update');
Route::post('/product/company/destroy', 'ProductController@company_destroy')->name('proCompany-destroy');

/* Company Purchase*/
    Route::resource('purchase','PurchaseController');
    Route::get('/manage-purchase','PurchaseController@manage_purchase')->name('manage-purchase');
    Route::get('/purchase/manage/ajax', 'PurchaseController@getPurchaseData')->name('purchase-getData');
    Route::get('/paid-purchase','PurchaseController@paid')->name('paid-purchase');
    Route::post('/purchase/invoice', 'PurchaseController@viewInvoice')->name('purchase-invoice');
    Route::get('/purchase/invoice_print/{id}','PurchaseController@printInvoice')->name('purchase-invoice-print');
    //Route::get('/paid-purchase','PurchaseController@paid')->name('unpaid-purchase');

/* company/expense */
Route::get('/expense/add', 'ExpenseController@index')->name('expense');
Route::post('/expense/add', 'ExpenseController@store')->name('expense-add');
Route::get('/expense/manage', 'ExpenseController@manage')->name('expense-manage');
Route::get('/expense/manage/ajax', 'ExpenseController@expense_getData')->name('exp-getData');
Route::post('/expense/manage/update', 'ExpenseController@update')->name('em-update');
Route::post('/expense/manage/destroy', 'ExpenseController@destroy')->name('em-destroy');
Route::get('/expense/add-invoice', 'ExpenseController@add_invoice')->name('a-invoice');
Route::post('/expense/add-invoice/add', 'ExpenseController@invoice_store')->name('a-invoice-add');
Route::get('/expense/manage-invoice', 'ExpenseController@manage_invoice')->name('m-invoice');
Route::get('/expense/manage-invoice/ajax', 'ExpenseController@manage_expense_getData')->name('manage-exp-getData');
Route::get('/expense/manage-invoice/paid', 'ExpenseController@paid_invoice')->name('m-invoice-paid');
Route::get('/expense/manage-invoice/unpaid', 'ExpenseController@unpaid_invoice')->name('m-invoice-unpaid');
Route::post('/expense/manage-invoice/pay', 'ExpenseController@manage_invoice_pay')->name('m-invoice-pay');
Route::post('/expense/manage-invoice/invoice', 'ExpenseController@invoice')->name('emi-invoice');
Route::post('/expense/manage-invoice/destroy', 'ExpenseController@manage_invoice_destroy')->name('m-invoice-destroy');

/* company/loan */
Route::get('/loan/add', 'LoanController@index')->name('loan');
Route::post('/loan/add', 'LoanController@store')->name('loan-add');
Route::post('/loan/update', 'LoanController@update')->name('loan-update');
Route::get('/loan/manage', 'LoanController@manage')->name('loan-manage');
Route::get('/loan/manage/ajax', 'LoanController@loan_getData')->name('loan-getData');
Route::post('/loan/manage/invoice', 'LoanController@invoice')->name('loan-invoice');
Route::get('/loan/loaner', 'LoanController@loaner')->name('loaner');
Route::post('/loan/loaner/add', 'LoanController@loaner_add')->name('loaner-add');
Route::get('/loaner/manage/ajax', 'LoanController@loaner_getData')->name('loaner-getData');
Route::post('/loan/loaner/update', 'LoanController@loaner_update')->name('loaner-update');
Route::post('/loan/loaner/pay', 'LoanController@pay')->name('loan-pay');
Route::post('/loan/loaner/destroy', 'LoanController@destroy')->name('loaner-destroy');
/* company/report */
Route::get('/sales-profit-loss-ledger', 'ReportController@index')->name('ledger');
Route::get('/sales-profit-loss-ledger/ajax', 'ReportController@ledger_getData')->name('ledger-getData');
Route::get('/sales-ledger', 'ReportController@salesLedger')->name('sales-ledger');
Route::get('/sales-ledger/ajax', 'ReportController@sales_getData')->name('sales-getData');
Route::get('/expense-ledger', 'ReportController@expenseLedger')->name('expense-ledger');
Route::get('/expense-ledger/ajax', 'ReportController@expense_getData')->name('expense-getData');
});
/* cms part */
Route::group(['middleware' => ['cms_session']], function () {
    Route::get('/cms/logout', 'CmsController@logout')->name('logout-cms');
    Route::get('/cms', 'CmsController@index')->name('cms');
    Route::get('/cms/edit/{id}', 'CmsController@edit')->name('cms-edit');
    Route::get('/cms/blog', 'CmsController@blog')->name('cms-blog');
    Route::post('/cms/blog/add', 'CmsController@blog_store')->name('add-blog');
    Route::post('/cms/blog/update', 'CmsController@blog_update')->name('blog-update');
    Route::post('/cms/blog/destroy', 'CmsController@blog_destroy')->name('blog-destroy');
    Route::post('/cms/update', 'CmsController@update')->name('cms-update');
    Route::post('/cms/country/add', 'CmsController@store')->name('country-store');
    Route::post('/cms/category/add', 'CmsController@category_store')->name('category-store');
    Route::post('/cms/unit/add', 'CmsController@unit_store')->name('unit-store');
    Route::post('/cms/country/destroy', 'CmsController@destroy')->name('cc-destroy');
    Route::get('/cms/password_change', 'CmsController@cms_password')->name('cms-password');
    Route::post('/cms/password_update', 'CmsController@cms_password_update')->name('cms_update_password');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});


