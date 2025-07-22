<?php

use App\Http\Controllers\Admin\Enquiry\PhoneCallController;
use App\Http\Controllers\Admin\Enquiry\VisitorBookController;
use App\Http\Controllers\Admin\HRM\EmployeeController;
use App\Http\Controllers\Admin\Mikrotik\HotspotController;
use App\Http\Controllers\Admin\Mikrotik\MacController;
use App\Http\Controllers\Admin\MyOffice\BranchController;
use App\Http\Controllers\Admin\MyOffice\DepartmentController;
use App\Http\Controllers\Admin\MyOffice\DesignationController;
use App\Http\Controllers\Admin\MyOffice\HolidayController;
use App\Http\Controllers\Admin\MyOffice\RoleController;
use App\Http\Controllers\Admin\MyOffice\RosterController;
use App\Http\Controllers\Admin\People\AgentController;
use App\Http\Controllers\Admin\People\DelegateController;
use App\Http\Controllers\Admin\People\DelegateOfficeController;
use App\Http\Controllers\Admin\permission\PermissionButtonController;
use App\Http\Controllers\Admin\Process\AirlineOfficeController;
use App\Http\Controllers\Admin\Process\AsignJobToOfficeController;
use App\Http\Controllers\Admin\Process\CandidateController;
use App\Http\Controllers\Admin\Process\CandidateTypeController;
use App\Http\Controllers\Admin\Process\JobCategoryController;
use App\Http\Controllers\Admin\Process\JobListController;
use App\Http\Controllers\Admin\Process\ProcessCategoryController;
use App\Http\Controllers\Admin\Process\ProcessOfficeController;
use App\Http\Controllers\Admin\Process\ProcessStepController;
use App\Http\Controllers\Business\CompaniesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Supper_Admin\Attendance_Leave\AttendanceController;
use App\Http\Controllers\Supper_Admin\Attendance_Leave\LeaveController;
use App\Http\Controllers\Supper_Admin\Attendance_Leave\RoastingController;
use App\Http\Controllers\Supper_Admin\Attendance_Leave\WeekendController;
use App\Http\Controllers\Supper_Admin\Location\ContinentController;
use App\Http\Controllers\Supper_Admin\Location\CountryController;
use App\Http\Controllers\Supper_Admin\Location\CurrencyController;
use App\Http\Controllers\Supper_Admin\Location\DistrictController;
use App\Http\Controllers\Supper_Admin\Location\DivisionController;
use App\Http\Controllers\Supper_Admin\Location\PostOfficeController;
use App\Http\Controllers\Supper_Admin\Location\StateController;
use App\Http\Controllers\Supper_Admin\Location\ThanaController;
use App\Http\Controllers\Supper_Admin\Mikrotik\MikrotikDeviceController;
use App\Http\Controllers\Supper_Admin\MikrotikServiceController;
use App\Http\Controllers\Supper_Admin\Payroll\AdvanceSalaryController;
use App\Http\Controllers\Supper_Admin\Payroll\Expense\ExpenseCategoryController;
use App\Http\Controllers\Supper_Admin\Payroll\Expense\ExpenseController;
use App\Http\Controllers\Supper_Admin\Payroll\Expense\ExpenseItemController;
use App\Http\Controllers\Supper_Admin\Payroll\FestivalBonusController;
use App\Http\Controllers\Supper_Admin\Payroll\IncAndDecController;
use App\Http\Controllers\Supper_Admin\Payroll\MobileAllowanceController;
use App\Http\Controllers\Supper_Admin\Payroll\PerformanceBonusController;
use App\Http\Controllers\Supper_Admin\Payroll\TravellingAndDearnessController;
use App\Http\Controllers\Supper_Admin\service\AirTicketcontroller;
use App\Http\Controllers\Supper_Admin\service\HazzUmrahcontroller;
use App\Http\Controllers\Supper_Admin\service\WorkPermitcontroller;
use App\Http\Controllers\Supper_Admin\Sponsor\MarketingVisaController;
use App\Http\Controllers\Supper_Admin\Sponsor\SponsorController;
use App\Http\Controllers\Supper_Admin\Sponsor\VisaController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Enquiry\InterviewedCandidateController;
use App\Http\Controllers\Admin\People\InvestorController;
use App\Http\Controllers\Admin\Enquiry\PhoneCallFollowupController;
use App\Http\Controllers\Admin\People\InvestorTransactionController;

Route::get('/', function () {
    return view('welcome');
});

// Resource route for companies
Route::resource('companies', CompaniesController::class);
Route::get('/airtickets/active', [AirTicketController::class, 'Activeindex'])->name('api.airticket.active');
Route::get('/airtickets/locations', [AirTicketController::class, 'getDestinations'])->name('api.ticket.getDestinations');
Route::get('/hazz/active', [HazzUmrahcontroller::class, 'Activeindex'])->name('api.hazz.active');
Route::get('/workpermit/active', [WorkPermitcontroller::class, 'Activeindex'])->name('api.workpermit.active');


// Dashboard route with role-based redirection
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->role === 'supper_admin') {
        return redirect()->route('supper_admin.dashboard');
    } elseif ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    abort(403, 'Unauthorized');
})->middleware(['auth', 'verified'])->name('dashboard');


// Group routes for 'supper_admin' with prefix and middleware
Route::middleware(['auth', 'verified'])->prefix('supper_admin')->name('supper_admin.')->group(function () {
    Route::get('/', function () {
        return view('supper_admin.pages.home.dashboard');
    })->name('dashboard');

    Route::post('air-ticket-csv', [AirTicketcontroller::class, 'importCSV'])->name('air-ticket.import');
    Route::get('air-ticket-csv-download', [AirTicketcontroller::class, 'downloadTemplate'])->name('air-ticket.download-template');
    Route::get('/continents/active', [ContinentController::class, 'Activeindex'])->name('continent.active');
    Route::get('/countries/active', [CountryController::class, 'Activeindex'])->name('country.active');
    Route::get('/divisions/active', [DivisionController::class, 'Activeindex'])->name('division.active');
    Route::get('/district/active', [DistrictController::class, 'Activeindex'])->name('district.active');
    Route::get('/thana/active', [ThanaController::class, 'Activeindex'])->name('thana.active');
    Route::get('/company/active', [CompaniesController::class, 'Activeindex'])->name('company.active');
    Route::get('/currency/active', [CurrencyController::class, 'Activeindex'])->name('currency.active');
    Route::get('/expense-categories/enabled', [ExpenseCategoryController::class, 'enabledIndex'])->name('expense-category.enabled');
    Route::get('/expense-items/enabled', [ExpenseItemController::class, 'enabledIndex'])->name('expense-item.enabled');
    Route::get('/sponsor/enabled', [SponsorController::class, 'enabledIndex'])->name('sponsor.enabled');



    Route::get('/connect-router/{id}', [MikrotikServiceController::class, 'connectToRouter'])->name('mikrotik.connect');
    Route::get('/disconnect-router/{id}', [MikrotikServiceController::class, 'disconnectFromRouter'])->name('mikrotik.disconnect');
    Route::get('/check-router', [MikrotikServiceController::class, 'checkRouterStatus'])->name('mikrotik.check');
    Route::post('mikrotik/hotspot-user', [MikrotikServiceController::class, 'createHotspotUser'])->name('mikrotik.user');



    // Resource routes for services under supper_admin
    Route::resource('air-ticket', AirTicketcontroller::class);
    Route::resource('hazz-umrah', HazzUmrahcontroller::class);
    Route::resource('workpermits', WorkPermitcontroller::class);
    Route::resource('companies', CompaniesController::class)->only(['create', 'edit', 'show', 'update', 'destroy']);
    Route::resource('continents', ContinentController::class);
    Route::resource('countries', CountryController::class);
    Route::resource('divisions', DivisionController::class);
    Route::resource('districts', DistrictController::class);
    Route::resource('thanas', ThanaController::class);
    Route::resource('postoffices', PostOfficeController::class);
    Route::resource('states', StateController::class);
    Route::resource('currencies', CurrencyController::class);
    Route::resource('mikrotik-devices', MikrotikDeviceController::class);

    //Resource routes for payroll under super_admin
    Route::resource('expense-categories', ExpenseCategoryController::class);
    Route::resource('expense-items', ExpenseItemController::class);
    Route::resource('expenses', ExpenseController::class);
    Route::resource('performance-bonuses', PerformanceBonusController::class);
    Route::resource('inc-and-deces', IncAndDecController::class);
    Route::resource('advance-salaries', AdvanceSalaryController::class);
    Route::resource('traveling-and-darenesses', TravellingAndDearnessController::class);
    Route::resource('mobile-allowances', MobileAllowanceController::class);
    Route::resource('festival-bonuses', FestivalBonusController::class);

    //Resource routes for sponsor under super_admin
    Route::resource('sponsors', SponsorController::class);
    Route::resource('visas', VisaController::class);
    Route::resource('marketing-visas', MarketingVisaController::class);

    //Resource routes for attendance and leave under super_admin
    Route::resource('attendances', AttendanceController::class);
    Route::delete('/leave-date/withdraw/{id}', [LeaveController::class, 'withdraw'])->name('leave-date.withdraw');
    Route::resource('leaves', LeaveController::class);
    Route::resource('roastings', RoastingController::class);
    Route::resource('weekends', WeekendController::class);
});

// Group routes for 'admin' with prefix and middleware
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('backend.pages.home.dashboard');
    })->name('dashboard');
    Route::get('/branches/active', [BranchController::class, 'activeIndex'])->name('branch.active');
    Route::get('/department/active', [DepartmentController::class, 'Activeindex'])->name('department.active');
    Route::get('/designation/active', [DesignationController::class, 'Activeindex'])->name('designation.active');
    Route::get('/roster/active', [RosterController::class, 'activeIndex'])->name('roster.active');
    Route::get('/roles/active', [RoleController::class, 'activeIndex'])->name('roles.active');
    Route::get('/employee/active', [EmployeeController::class, 'activeIndex'])->name('employee.active');
    Route::match(['get', 'post'], '/employee/{id}/finger', [EmployeeController::class, 'finger'])->name('employee.finger');
    Route::match(['get', 'post'], '/employee/{id}/card', [EmployeeController::class, 'accessCard'])->name('employee.card');
    Route::get('/router/active', [MikrotikDeviceController::class, 'Activeindex'])->name('router.active');
    Route::get('/agent/active', [AgentController::class, 'Activeindex'])->name('agent.active');
    Route::get('/delegate/active', [DelegateController::class, 'Activeindex'])->name('delegate.active');
    Route::get('/delegate-office/active', [DelegateOfficeController::class, 'Activeindex'])->name('delegate-office.active');
    Route::get('/processCategory/active', [ProcessCategoryController::class, 'Activeindex'])->name('processCategory.active');
    Route::get('/jobCategory/active', [JobCategoryController::class, 'Activeindex'])->name('jobCategory.active');
    Route::get('/jobLists/active', [JobListController::class, 'Activeindex'])->name('jobLists.active');
    Route::get('/processOffices/active', [ProcessOfficeController::class, 'Activeindex'])->name('processOffices.active');

    Route::get('investors/transactions', [InvestorTransactionController::class, 'index'])->name('investors.transactions');
    Route::post('investors/transactions', [InvestorTransactionController::class, 'store'])->name('investors.transactions');

    Route::resource('branches', BranchController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('designations', DesignationController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionButtonController::class);
    Route::resource('rosters', RosterController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('employees', EmployeeController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('investors', InvestorController::class);
    Route::resource('hotspots', HotspotController::class);
    Route::resource('mac-address', MacController::class);
    Route::resource('delegates', DelegateController::class);
    Route::resource('delegateOffice', DelegateOfficeController::class);
    Route::resource('candidateTypes', CandidateTypeController::class);
    Route::resource('candidates', CandidateController::class);
    Route::post('candidates/update-candidate-photo', [CandidateController::class, 'updateCandidatePhoto'])->name('candidates.updateCandidatePhoto');
    Route::post('candidates/transaction', [CandidateController::class, 'storeCandidateTransaction'])->name('candidates.storeTransaction');
    Route::get('candidates/{candidate_id}/transactions', [CandidateController::class, 'getCandidateTransactions'])->name('candidates.transactions');
    Route::post('candidates/type-transfer', [CandidateController::class, 'typeTransfer'])->name('candidates.typeTransfer');
    Route::get('candidates/comment/{id}', [CandidateController::class, 'getCandidateComment'])->name('candidates.getComment');
    Route::post('candidates/comment', [CandidateController::class, 'saveCandidateComment'])->name('candidates.saveComment');
    Route::resource('enquiry/phone-calls', PhoneCallController::class);
    Route::resource('enquiry/visitor-books', VisitorBookController::class);
    Route::resource('enquiry/phone-call-followups', PhoneCallFollowupController::class);
    Route::resource('processCategory', ProcessCategoryController::class);
    Route::resource('jobCategory', JobCategoryController::class);
    Route::resource('jobLists', JobListController::class);
    Route::resource('processSteps', ProcessStepController::class);
    Route::resource('processOffices', ProcessOfficeController::class);
    Route::resource('asignjobtoOffice', AsignJobToOfficeController::class);
    Route::resource('airlineOffices', AirlineOfficeController::class);
    Route::resource('enquiry/interviewed-candidates', InterviewedCandidateController::class);
});

// Dependent dropdowns for candidate location
Route::get('/admin/location/divisions/{country_id}', [App\Http\Controllers\Supper_Admin\Location\DivisionController::class, 'getDivisionByCountry']);
Route::get('/admin/location/districts/{division_id}', [App\Http\Controllers\Supper_Admin\Location\DistrictController::class, 'getDistrictByDivision']);
Route::get('/admin/location/thanas/{district_id}', [App\Http\Controllers\Supper_Admin\Location\ThanaController::class, 'getThanaByDistrict']);
Route::get('/admin/location/postoffices/{district_id}', [App\Http\Controllers\Supper_Admin\Location\PostOfficeController::class, 'getPostOfficeByDistrict']);
Route::get('/admin/location/states/{country_id}', [App\Http\Controllers\Supper_Admin\Location\StateController::class, 'getStateByCountry']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';
