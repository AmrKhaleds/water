<?php

use App\Http\Controllers\PrintingModelController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SudanSalesController;
use App\Http\Controllers\PriceProposalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/text', function () {


        $curl = curl_init();

        curl_setopt_array($curl, [
                CURLOPT_URL => "https://vedicrishi-horoscope-matching-v1.p.rapidapi.com/numero_table/",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\n  \"day\": \"24\",\n  \"month\": \"9\",\n  \"year\": \"1994\",\n  \"hour\": \"00\",\n  \"min\": \"00\",\n  \"name\": \"demo\",\n  \"lat\": \"25.123\",\n  \"lon\": \"82.34\",\n  \"tzone\": \"5.5\"\n}",
                CURLOPT_HTTPHEADER => [
                        "X-RapidAPI-Host: vedicrishi-horoscope-matching-v1.p.rapidapi.com",
                        "X-RapidAPI-Key: ad62a58f0dmshce6c71638d9dacbp13297ejsn6f152ba4534c",
                        "content-type: application/json"
                ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
                echo "cURL Error #:" . $err;
        } else {
                echo $response;
        }
});

Route::get('/', function () {
        return redirect()->route('home');
});

Route::get('/job/{id}', [App\Http\Controllers\SiteController::class, 'job'])->name('job');
Route::post('/apply/job/store', [App\Http\Controllers\SiteController::class, 'jobStore'])->name('job.store');
Route::get('/candidate/{id}/{name}', [App\Http\Controllers\JobController::class, 'showCandidate'])->name('candidate');

Route::group(
        [
                'prefix' => 'acp',
        ],
        function () {


                Auth::routes(['register' => false]);

                Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


                //        HR

                //                  Categories
                Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories.index');
                Route::get('/category/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('categories.create');
                Route::post('/category/store', [App\Http\Controllers\CategoryController::class, 'store'])->name('categories.store');
                Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('categories.edit');
                Route::post('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('categories.update');
                Route::get('/category/destroy/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('categories.destroy');


                //                  Employees
                Route::get('/employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employees.index');
                Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employees.create');
                Route::post('/employee/store', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employees.store');
                Route::get('/employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employees.edit');
                Route::post('/employee/update/{id}', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employees.update');
                Route::get('/employee/destroy/{id}', [App\Http\Controllers\EmployeeController::class, 'destroy'])->name('employees.destroy');


                //                  Job
                Route::get('/jobs', [App\Http\Controllers\JobController::class, 'index'])->name('jobs.index');
                Route::get('/job/create', [App\Http\Controllers\JobController::class, 'create'])->name('jobs.create');
                Route::post('/job/store', [App\Http\Controllers\JobController::class, 'store'])->name('jobs.store');
                Route::get('/job/edit/{id}', [App\Http\Controllers\JobController::class, 'edit'])->name('jobs.edit');
                Route::get('/job/show/{id}', [App\Http\Controllers\JobController::class, 'show'])->name('jobs.show');
                Route::get('/job/candidate/{type}', [App\Http\Controllers\JobController::class, 'candidate'])->name('jobs.candidate');
                Route::get('/job/candidate/rate/{id}', [App\Http\Controllers\JobController::class, 'rate'])->name('jobs.candidate.rate');
                Route::post('/job/candidate/send_to/{id}', [App\Http\Controllers\JobController::class, 'SendTo'])->name('jobs.candidate.sendto');
                Route::post('/job/update/{id}', [App\Http\Controllers\JobController::class, 'update'])->name('jobs.update');
                Route::get('/job/status/{id}/{status}', [App\Http\Controllers\JobController::class, 'status'])->name('jobs.status');
                Route::get('/job/destroy/{id}', [App\Http\Controllers\JobController::class, 'destroy'])->name('jobs.destroy');

                Route::get('/jobs/status/{id}/{status}', [App\Http\Controllers\JobController::class, 'Status'])->name('jobs.status');
                
                /////// End JOB ///////
                // Sudan Sales
                Route::get('/sudan_sales', [SudanSalesController::class, 'index'])->name('sudan_sales.index');
                Route::get('/sudan_sales/invoice/{id}', [SudanSalesController::class, 'invoice'])->name('sudan_sales.invoice');
                // Route::post('/sudan_sales/invoice', [SudanSalesController::class, 'send'])->name('sudan_sales.invoice-send');
                Route::get('/sudan_sales/create', [SudanSalesController::class, 'create'])->name('sudan_sales.create');
                Route::post('/sudan_sales/store', [SudanSalesController::class, 'store'])->name('sudan_sales.store');
                Route::get('/sudan_sales/show/{id}', [SudanSalesController::class, 'show'])->name('sudan_sales.show');
                Route::get('/sudan_sales/edit/{id}', [SudanSalesController::class, 'edit'])->name('sudan_sales.edit');
                Route::put('/sudan_sales/update/{id}', [SudanSalesController::class, 'update'])->name('sudan_sales.update');
                Route::delete('/sudan_sales/destroy/{id}', [SudanSalesController::class, 'destroy'])->name('sudan_sales.destroy');
                Route::get('/sudan_sales/factory_quantity', [SudanSalesController::class, 'factory_quantity'])->name('sudan_sales.factory_quantity');
                Route::post('/sudan_sales/factory_quantity', [SudanSalesController::class, 'factory_quantity_store'])->name('sudan_sales.factory_quantity.store');

                // Printing Models
                Route::resource('/printing_models', PrintingModelController::class);
                
                // Price Proposal
                Route::get('/price-proposal', [PriceProposalController::class, 'index'])->name('price_proposal.index');
                Route::get('/price-proposal/create', [PriceProposalController::class, 'create'])->name('price_proposal.create');
                Route::get('/price-proposal/show/{id}', [PriceProposalController::class, 'show'])->name('price_proposal.show');
                Route::get('/price-proposal/print/{id}', [PriceProposalController::class, 'print'])->name('price_proposal.print');
                Route::post('/price-proposal/store', [PriceProposalController::class, 'store'])->name('price_proposal.store');
                Route::post('/price-proposal/whatsapp', [PriceProposalController::class, 'whatsapp'])->name('price_proposal.whatsapp');
                Route::get('/price-proposal/edit/{id}', [PriceProposalController::class, 'edit'])->name('price_proposal.edit');
                Route::put('/price-proposal/update/{id}', [PriceProposalController::class, 'update'])->name('price_proposal.update');
                Route::delete('/price-proposal/destroy/{id}', [PriceProposalController::class, 'destroy'])->name('price_proposal.destroy');

                //        CARS
                //        Vehicles
                Route::get('/vehicles', [App\Http\Controllers\VehicleController::class, 'index'])->name('vehicles.index');
                Route::get('/vehicle/create', [App\Http\Controllers\VehicleController::class, 'create'])->name('vehicles.create');
                Route::post('/vehicle/store', [App\Http\Controllers\VehicleController::class, 'store'])->name('vehicles.store');
                Route::get('/vehicle/edit/{id}', [App\Http\Controllers\VehicleController::class, 'edit'])->name('vehicles.edit');
                Route::post('/vehicle/update/{id}', [App\Http\Controllers\VehicleController::class, 'update'])->name('vehicles.update');
                Route::get('/vehicle/status/{id}/{status}', [App\Http\Controllers\VehicleController::class, 'status'])->name('vehicles.status');
                Route::get('/vehicle/destroy/{id}', [App\Http\Controllers\VehicleController::class, 'destroy'])->name('vehicles.destroy');

                //                  Assign Vehicles
                Route::get('/assign_cars/{id}', [App\Http\Controllers\AssignCarController::class, 'index'])->name('assign_cars.index');
                Route::post('/assign_car/store/{id}', [App\Http\Controllers\AssignCarController::class, 'store'])->name('assign_cars.store');
                Route::post('/assign_car/storeAssign', [App\Http\Controllers\AssignCarController::class, 'storeAssign'])->name('assign_cars.storeAssign');
                Route::get('/assign_car/leave/{id}', [App\Http\Controllers\AssignCarController::class, 'leave'])->name('assign_cars.leave');
                Route::get('/assign_car/edit/{id}', [App\Http\Controllers\AssignCarController::class, 'edit'])->name('assign_cars.edit');
                Route::post('/assign_car/update/{id}', [App\Http\Controllers\AssignCarController::class, 'update'])->name('assign_cars.update');
                Route::get('/assign_car/destroy/{id}', [App\Http\Controllers\AssignCarController::class, 'destroy'])->name('assign_cars.destroy');

                //                  Maintenance
                Route::get('/maintenances', [App\Http\Controllers\MaintenanceController::class, 'index'])->name('maintenances.index');
                Route::get('/maintenance/create', [App\Http\Controllers\MaintenanceController::class, 'create'])->name('maintenances.create');
                Route::post('/maintenance/store', [App\Http\Controllers\MaintenanceController::class, 'store'])->name('maintenances.store');
                Route::get('/maintenance/edit/{id}', [App\Http\Controllers\MaintenanceController::class, 'edit'])->name('maintenances.edit');
                Route::post('/maintenance/update/{id}', [App\Http\Controllers\MaintenanceController::class, 'update'])->name('maintenances.update');
                Route::get('/maintenance/destroy/{id}', [App\Http\Controllers\MaintenanceController::class, 'destroy'])->name('maintenances.destroy');

                //        Booking

                //                  Booking
                Route::get('/bookings', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
                Route::get('/booking/create', [App\Http\Controllers\BookingController::class, 'create'])->name('bookings.create');
                Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
                Route::get('/show/show/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
                Route::get('/booking/edit/{id}', [App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
                Route::post('/booking/update/{id}', [App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
                Route::get('/booking/destroy/{id}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');
                Route::post('/booking/rate', [App\Http\Controllers\BookingController::class, 'rate'])->name('bookings.rate');

                //                  Booking Freezer
                Route::get('/booking_freezers', [App\Http\Controllers\BookingFreezeController::class, 'index'])->name('booking.freezers.index');
                Route::get('/booking_freezer/create', [App\Http\Controllers\BookingFreezeController::class, 'create'])->name('booking.freezers.create');
                Route::post('/booking_freezer/store', [App\Http\Controllers\BookingFreezeController::class, 'store'])->name('booking.freezers.store');
                Route::get('/booking_freezer/edit/{id}', [App\Http\Controllers\BookingFreezeController::class, 'edit'])->name('booking.freezers.edit');
                Route::get('/booking_freezer/show/{id}', [App\Http\Controllers\BookingFreezeController::class, 'show'])->name('booking.freezers.show');
                Route::post('/booking_freezer/update/{id}', [App\Http\Controllers\BookingFreezeController::class, 'update'])->name('booking.freezers.update');
                Route::get('/booking_freezer/destroy/{id}', [App\Http\Controllers\BookingFreezeController::class, 'destroy'])->name('booking.freezers.destroy');
                Route::post('/booking_freezer_traking/destroy/{id}', [App\Http\Controllers\BookingFreezeController::class, 'trakingsDestroy'])->name('booking.trakings.destroy');
                Route::get('/booking_freezer/undestroy/{id}', [App\Http\Controllers\BookingFreezeController::class, 'undestroy'])->name('booking.trakings.undestroy');
                Route::get('/booking_freezer/assign/{id}/{assign_to}', [App\Http\Controllers\BookingFreezeController::class, 'assign'])->name('booking.trakings.assign');
                Route::get('/booking_freezer/status/{id}/{status}', [App\Http\Controllers\BookingFreezeController::class, 'Status'])->name('booking.trakings.status');

                //                  Attendant
                Route::get('/attendants/type/{type}', [App\Http\Controllers\AttendantController::class, 'index'])->name('attendants.index');
                Route::get('/attendant/status/{id}', [App\Http\Controllers\AttendantController::class, 'Status'])->name('attendants.status');
                Route::get('/attendant/destroy/{id}', [App\Http\Controllers\AttendantController::class, 'destroy'])->name('attendants.destroy');

                //                  Traking
                Route::get('/trakings/{type}', [App\Http\Controllers\TrakingController::class, 'index'])->name('trakings.index');
                Route::get('/traking/assign/{id}/{assign_to}', [App\Http\Controllers\TrakingController::class, 'assign'])->name('trakings.assign');
                Route::post('/traking/destroy/{id}', [App\Http\Controllers\TrakingController::class, 'destroy'])->name('trakings.destroy');
                Route::get('/traking/undestroy/{id}', [App\Http\Controllers\TrakingController::class, 'undestroy'])->name('trakings.undestroy');
                Route::get('/traking/status/{id}/{status}', [App\Http\Controllers\TrakingController::class, 'Status'])->name('trakings.status');

                //        PRODUCTS

                //                  Units
                Route::get('/units', [App\Http\Controllers\UnitController::class, 'index'])->name('units.index');
                Route::get('/unit/create', [App\Http\Controllers\UnitController::class, 'create'])->name('units.create');
                Route::post('/unit/store', [App\Http\Controllers\UnitController::class, 'store'])->name('units.store');
                Route::get('/unit/edit/{id}', [App\Http\Controllers\UnitController::class, 'edit'])->name('units.edit');
                Route::post('/unit/update/{id}', [App\Http\Controllers\UnitController::class, 'update'])->name('units.update');
                Route::get('/unit/destroy/{id}', [App\Http\Controllers\UnitController::class, 'destroy'])->name('units.destroy');

                //                  BRAND
                Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands.index');
                Route::get('/brand/create', [App\Http\Controllers\BrandController::class, 'create'])->name('brands.create');
                Route::post('/brand/store', [App\Http\Controllers\BrandController::class, 'store'])->name('brands.store');
                Route::get('/brand/edit/{id}', [App\Http\Controllers\BrandController::class, 'edit'])->name('brands.edit');
                Route::post('/brand/update/{id}', [App\Http\Controllers\BrandController::class, 'update'])->name('brands.update');
                Route::get('/brand/destroy/{id}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('brands.destroy');

                //                  STORE
                Route::get('/stores', [App\Http\Controllers\StoreController::class, 'index'])->name('stores.index');
                Route::get('/store/create', [App\Http\Controllers\StoreController::class, 'create'])->name('stores.create');
                Route::post('/store/store', [App\Http\Controllers\StoreController::class, 'store'])->name('stores.store');
                Route::get('/store/edit/{id}', [App\Http\Controllers\StoreController::class, 'edit'])->name('stores.edit');
                Route::post('/store/update/{id}', [App\Http\Controllers\StoreController::class, 'update'])->name('stores.update');
                Route::get('/store/destroy/{id}', [App\Http\Controllers\StoreController::class, 'destroy'])->name('stores.destroy');

                //                  Product
                Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
                Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('products.create');
                Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
                Route::get('/product/ajax/{product_id}/{store_id}', [App\Http\Controllers\ProductController::class, 'getAjax'])->name('products.ajax');
                Route::get('/product_details/{product_name}', [App\Http\Controllers\ProductController::class, 'Details']);
                Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('products.edit');
                Route::post('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('products.update');
                Route::get('/product/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('products.destroy');

                //                  Providers
                Route::get('/providers', [App\Http\Controllers\ProviderController::class, 'index'])->name('providers.index');
                Route::get('/provider/create', [App\Http\Controllers\ProviderController::class, 'create'])->name('providers.create');
                Route::post('/provider/store', [App\Http\Controllers\ProviderController::class, 'store'])->name('providers.store');
                Route::get('/provider/edit/{id}', [App\Http\Controllers\ProviderController::class, 'edit'])->name('providers.edit');
                Route::post('/provider/update/{id}', [App\Http\Controllers\ProviderController::class, 'update'])->name('providers.update');
                Route::get('/provider/destroy/{id}', [App\Http\Controllers\ProviderController::class, 'destroy'])->name('providers.destroy');

                //                  Clients
                Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
                Route::get('/client/create', [App\Http\Controllers\ClientController::class, 'create'])->name('clients.create');
                Route::post('/client/store', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
                Route::get('/client/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('clients.edit');
                Route::post('/client/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
                Route::get('/client/destroy/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy');

                //                  STOCK TRANSFER
                Route::get('/transfers', [App\Http\Controllers\TransferController::class, 'index'])->name('transfers.index');
                Route::get('/transfer/create', [App\Http\Controllers\TransferController::class, 'create'])->name('transfers.create');
                Route::post('/transfer/store', [App\Http\Controllers\TransferController::class, 'store'])->name('transfers.store');
                Route::get('/transfer/edit/{id}', [App\Http\Controllers\TransferController::class, 'edit'])->name('transfers.edit');
                Route::get('/transfer/show/{id}', [App\Http\Controllers\TransferController::class, 'show'])->name('transfers.show');
                Route::post('/transfer/update/{id}', [App\Http\Controllers\TransferController::class, 'update'])->name('transfers.update');
                Route::get('/transfer/destroy/{id}', [App\Http\Controllers\TransferController::class, 'destroy'])->name('transfers.destroy');

                //                  PURCHASES
                Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases.index');
                Route::get('/purchase/create', [App\Http\Controllers\PurchaseController::class, 'create'])->name('purchases.create');
                Route::post('/purchase/store', [App\Http\Controllers\PurchaseController::class, 'store'])->name('purchases.store');
                Route::get('/purchase/edit/{id}', [App\Http\Controllers\PurchaseController::class, 'edit'])->name('purchases.edit');
                Route::get('/purchase/show/{id}', [App\Http\Controllers\PurchaseController::class, 'show'])->name('purchases.show');
                Route::post('/purchase/update/{id}', [App\Http\Controllers\PurchaseController::class, 'update'])->name('purchases.update');
                Route::get('/purchase/destroy/{id}', [App\Http\Controllers\PurchaseController::class, 'destroy'])->name('purchases.destroy');

                //                  SALE
                Route::get('/sales', [App\Http\Controllers\SaleController::class, 'index'])->name('sales.index');
                Route::get('/sales/external_debt', [App\Http\Controllers\SaleController::class, 'ExternalDebt'])->name('sales.external_debt');
                Route::get('/sales/external_debt/bill', [App\Http\Controllers\SaleController::class, 'ExternalDebtBills'])->name('sales.external_debt.bills');
                Route::get('/sale/create', [App\Http\Controllers\SaleController::class, 'create'])->name('sales.create');
                Route::get('/sale/createTest', [App\Http\Controllers\SaleController::class, 'createTest'])->name('sales.createTst');
                Route::get('/sale/get_product_store/{id}', [App\Http\Controllers\SaleController::class, 'GetProductStore'])->name('get.product.store');
                Route::post('/sale/store', [App\Http\Controllers\SaleController::class, 'store'])->name('sales.store');
                Route::get('/sale/edit/{id}', [App\Http\Controllers\SaleController::class, 'edit'])->name('sales.edit');
                Route::get('/sale/show/{id}', [App\Http\Controllers\SaleController::class, 'show'])->name('sales.show');
                Route::get('/sale/status/{id}/{status}', [App\Http\Controllers\SaleController::class, 'Status'])->name('sales.status');
                Route::get('/sale/undestroy/{id}', [App\Http\Controllers\SaleController::class, 'undestroy'])->name('sales.undestroy');
                Route::post('/sale/update/{id}', [App\Http\Controllers\SaleController::class, 'update'])->name('sales.update');
                Route::post('/sale_traking/destroy/{id}', [App\Http\Controllers\SaleController::class, 'trakingsDestroy'])->name('sales.trakings.destroy');
                Route::get('/sale/destroy/{id}', [App\Http\Controllers\SaleController::class, 'destroy'])->name('sales.destroy');
                Route::get('/sale/print/{id}', [App\Http\Controllers\SaleController::class, 'PrintPos'])->name('sales.print');
                Route::get('/sale/assign/{id}/{assign_to}', [App\Http\Controllers\SaleController::class, 'assign'])->name('sales.assign');

                //                  PAYMENT
                Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments.index');
                Route::post('/payment/store/{id}', [App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
                Route::get('/payment/show/{id}', [App\Http\Controllers\PaymentController::class, 'show'])->name('payments.show');
                Route::post('/payment/update/{id}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payments.update');
                Route::get('/payment/destroy/{id}', [App\Http\Controllers\PaymentController::class, 'destroy'])->name('payments.destroy');


                // Accounting

                Route::get('/customers_balances', [App\Http\Controllers\CustomersBalanceController::class, 'CustomersBalance'])->name('customers_balances');
                Route::get('/customers_balance/{id}', [App\Http\Controllers\CustomersBalanceController::class, 'Show'])->name('customers_balance');

                Route::resource('/catch_receipts', App\Http\Controllers\CatchReceiptController::class);
                Route::get('/catch_receipt_details', [App\Http\Controllers\CatchReceiptController::class, 'CatchReceiptDetails'])->name('catch_receipts.details');
                Route::resource('/receipts', App\Http\Controllers\ReceiptController::class);

                Route::resource('/payments', App\Http\Controllers\PaymentsMethodController::class);

                // Tree
                Route::get('/tree', [App\Http\Controllers\AccountController::class, 'Tree'])->name('tree');
                Route::get('/get_account_ajax', [App\Http\Controllers\AccountController::class, 'AccountAjax'])->name('account.ajax');
                Route::get('/get_account_details', [App\Http\Controllers\AccountController::class, 'AccountDetails'])->name('account.details');
                Route::resource('/accounts', App\Http\Controllers\AccountController::class);

                Route::resource('/dailymoves', App\Http\Controllers\DailyMoveController::class);

                //        Setting
                Route::get('/setting/{type}', [App\Http\Controllers\SettingController::class, 'createAccounting'])->name('accounting.setting');
                Route::post('/setting/store', [App\Http\Controllers\SettingController::class, 'store'])->name('accounting.setting.store');

                //                  Setting
                Route::get('/setting_km/create', [App\Http\Controllers\SettingController::class, 'create'])->name('setting_km.create');
                Route::get('/setting_km/check', [App\Http\Controllers\SettingController::class, 'check'])->name('setting_km.check');
                Route::get('/setting_duration/check', [App\Http\Controllers\SettingController::class, 'checkDuration'])->name('setting_duration.check');
                Route::post('/setting_km/store', [App\Http\Controllers\SettingController::class, 'store'])->name('setting_km.store');
                Route::get('/setting_km/new', [App\Http\Controllers\SettingController::class, 'New'])->name('setting_km.new');
                Route::get('/setting/create', [App\Http\Controllers\SettingController::class, 'createGeneral'])->name('setting.create');
                Route::post('/setting/store', [App\Http\Controllers\SettingController::class, 'storeGeneral'])->name('setting.store');


                //                  Report
                Route::get('/report/store', [App\Http\Controllers\ReportController::class, 'ReportStore'])->name('report.store');
        }
);
