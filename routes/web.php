<?php

use App\Models\IP;

use App\Models\User;
use App\Mail\NewlinkMail;
use App\Models\Appointment;
use App\Http\Controllers\HR;
use App\Mail\SurveyPaymentMail;
use App\Mail\SurveyRequestMail;
use App\Http\Controllers\Client;
use App\Http\Controllers\JobOrders;
use App\Http\Controllers\ServiceOps;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HRController;
use App\Http\Controllers\POPController;
use App\Http\Controllers\HomeController;
use Illuminate\Notifications\Notifiable;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Maintenance;
use App\Http\Controllers\AssignTicketEngr;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AdminSubscription;
use App\Http\Controllers\FieldEngineer\POP;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CapPerPopController;
use App\Http\Controllers\DeploymentController;
use App\Http\Controllers\EditSurveyController;
use App\Http\Controllers\IndustriesController;
use App\Http\Controllers\MarketerClientPerPOP;
use App\Http\Controllers\SalesAgentController;
use App\Http\Controllers\SurveyStatisticsView;
use App\Http\Controllers\POPPerStateController;
use App\Http\Controllers\ClientMonthlyDashboard;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ClientsPerPOPController;
use App\Http\Controllers\FieldEnginnerController;
use App\Http\Controllers\SurveyStatReportingView;
use App\Http\Controllers\AverageCapacityController;
use App\Http\Controllers\AvgCapReportingController;
use App\Http\Controllers\ClientsPerStateController;
use App\Http\Controllers\PrivateBusinessController;
use App\Http\Controllers\TicketDashboardController;
use App\Http\Controllers\POPSupportTicketController;
use App\Http\Controllers\SubReportingViewController;
use App\Http\Controllers\ServiceOpsJobOrderContoller;
use App\Http\Controllers\FieldSupportTicketController;

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


Route::get('/inventory', function () {
    return view('user.inventory');
})->name('inventory');

Route::view('/{any}', 'user.home')->where('any', '.*'); // Catch all routes and direct them to home.blade.php
Route::post('/api/products', [ProductController::class, 'store']);
Route::get('/api/products', [ProductController::class, 'index']);
Route::put('/api/products/{id}', [ProductController::class, 'update']);

Route::post('/procure', [InventoryController::class, 'procure']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


//Admin Personnel Routes

//Admin Personnel Upload Edit Routes
//Other Routes
Route::get('/admin-dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashbaord');
Route::post('/appointment', [HomeController::class, 'appointment']);
Route::get('/weekly_survey_graph', [AdminController::class, 'weekly_survey']);
Route::get('/monthly_survey_graph', [AdminController::class, 'monthly_survey']);
Route::get('/yearly_survey_graph', [AdminController::class, 'yearly_survey']);
Route::get('/shared_service_chart', [AdminController::class, 'showdoctor']);
Route::get('/deletedoctor/{id}', [AdminController::class, 'deletedoctor']);
Route::post('/editdoctor/{id}', [AdminController::class, 'editdoctor']);
Route::get('/emailview/{id}', [AdminController::class, 'emailview']);
Route::get('/sales_personnel', [AdminController::class, 'sales_personnel']);
Route::get('/sales_personnel_reporting', [AdminController::class, 'sales_personnel_reporting']);
Route::get('/call_out_info/{id}', [AdminController::class, 'call_out_info']);
Route::get('/call_out_reporting/{id}', [AdminController::class, 'call_out_reporting']);
Route::get('/admin_dashboard_reporting', [AdminController::class, 'dynamic_dashboard_reporting']);
Route::get('/dynamic_home', [AdminController::class, 'dynamic_home']);
Route::get('/md_dashboard', [AdminController::class, 'md_dashboard']);
//End of Other Routes

//Average capacity route
Route::get('/avg_speed', [AdminController::class, 'avg_speed']);
Route::get('/speed_btw_two_ten', [AverageCapacityController::class, 'speed_btw_two_ten']);
Route::get('/speed_less_than_two', [AverageCapacityController::class, 'speed_less_than_two']);
Route::get('/speed_btw_greater_than_ten', [AverageCapacityController::class, 'speed_btw_greater_than_ten']);
Route::get('/access-bandwidth-view', [AverageCapacityController::class, 'AccessBandwidth']);

//Beginning of Old and New route Average Speed Reorting
Route::get('/avg_speed_reporting', [AvgCapReportingController::class, 'avg_speed_reporting']);
// Route::get('/avg_speed_reporting',[AdminController::class,'avg_speed_reporting']);
//End of Old and New route Average Speed Reorting   
Route::get('/access-bandwidth-query-view/{dateE}/{dateS}', [AvgCapReportingController::class, 'accessBandwidthReporting']);
Route::get('/speed_less_than_two_reporting/{dateE}/{dateS}', [AvgCapReportingController::class, 'speed_less_than_two_reporting']);
Route::get('/speed_btw_two_ten_reporting/{dateE}/{dateS}', [AvgCapReportingController::class, 'speed_btw_two_ten_reporting']);
Route::get('/speed_btw_greater_than_ten_reporting/{dateE}/{dateS}', [AvgCapReportingController::class, 'speed_btw_greater_than_ten_reporting']);
//End of Average capacity route

//Staff Information
Route::get('/all-staff', [StaffController::class, 'allStaff']);
//End of Staff
//End of Admin Personnel Upload Edit Routes

//Admin Manager Survey Routes
Route::get('/Deployment_dashboard', [DeploymentController::class, 'Deployment_dashboard']);
Route::get('/Deployment_reporting', [DeploymentController::class, 'Deployment_reporting']);

Route::get('/current-month-raised-surveys', [SurveyStatisticsView::class, 'RaisedmonthSurvey']);
Route::get('/current-month-done-surveys', [SurveyStatisticsView::class, 'CurrentmonthDoneSurvey']);
Route::get('/current-month-feasible-surveys', [SurveyStatisticsView::class, 'CurrentmonthFeasibleSurvey']);
Route::get('/current-month-Notfeasible-surveys', [SurveyStatisticsView::class, 'CurrentmonthNotFeasibleSurvey']);
Route::get('/current-month-installations', [SurveyStatisticsView::class, 'CurrentmonthInstallation']);
Route::get('/current-month-pending-surveys', [SurveyStatisticsView::class, 'CurrentmonthPendingSurveys']);
Route::get('/all-pending-surveys', [SurveyStatisticsView::class, 'AllPendingSurveys']);
Route::get('/all-pending-installations', [SurveyStatisticsView::class, 'PendingInstallations']);

//Survey Reporting
Route::get('/raised-surveys-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'RaisedmonthSurveyReporting']);
Route::get('/done-surveys-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'DoneSurveyQuery']);
Route::get('/feasible-surveys-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'FeasibleSurveyQuery']);
Route::get('/Notfeasible-surveys-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'NotFeasibleSurveyQuery']);
Route::get('/installations-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'InstallationQuery']);
Route::get('/pending-surveys-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'PendingSurveysQuery']);
Route::get('/pending-installations-query/{dateS}/{dateE}', [SurveyStatReportingView::class, 'PendingInstallationsQuery']);

//End of Admin Manager Survey Routes

//Admin Manager Monthly Clients Report Routes
Route::get('/clients_monthly_dashboard', [ClientMonthlyDashboard::class, 'clients_monthly_dashboard']);

//Monthly Subscribtion Dashboard
Route::get('/clients-monthly-subscription-dashboard', [AdminSubscription\MonthlyDashboard::class, 'monthlyDashboard']);
Route::get('/periodic-monthly-subscription-dashboard/{mthN}/{mth}/{yr}', [AdminSubscription\MonthlyDashboard::class, 'periodicMonthlyDashboard'])
    ->name('dashboard.periodic');

//End of Admin Manager Monthly Clients Report Routes

//End of Admin Personnel Routes

//Human Resource Manager
Route::get('/sales_personnel_HR', [HRController::class, 'sales_personnel']);
Route::get('/call_out_info_HR/{id}', [HRController::class, 'call_out_info']);
Route::get('/sales_personnel_reporting_HR', [HRController::class, 'sales_personnel_reporting']);
Route::get('/call_out_reporting_HR/{id}', [HRController::class, 'call_out_reporting']);
Route::get('/call_out_reporting_HR/{id}/{dateS}/{dateE}', [HRController::class, 'call_out_reporting']);
Route::get('/call_out_filter/{id}', [HRController::class, 'call_out_filter']);
Route::get('/sme_clients_hr', [HRController::class, 'SME_clients']);
Route::get('/home_clients_hr', [HRController::class, 'Home_clients']);
Route::get('/dedicated_clients_hr', [HRController::class, 'Dedicated_clients']);

//Surveys and Customers
Route::get('/marketers_surveys_HR/{id}', [HRController::class, 'marketers_surveys_HR'])->name('marketer.survey.details');
Route::get('/marketers_clients_HR/{id}', [HRController::class, 'marketers_clients_HR']);
Route::get('/marketers_surveys_HR_reporting/{id}/{dateS}/{dateE}', [HRController::class, 'marketers_surveys_HR_reporting'])
    ->name('marketer.survey.details.reporting');
Route::get('/marketers_clients_HR_report/{id}/{dateS}/{dateE}', [HRController::class, 'marketers_clients_HR_reporting'])
    ->name('marketer.client.details.reporting');

//Sales And Quotations
Route::get('/total-quotations-sent', [HR\Sales::class, 'quotations'])->name('quotations.sent');
Route::get('/total-quotations-pending', [HR\Sales::class, 'pendingQuotations'])->name('quotations.pending');
Route::get('/total-sales-made', [HR\Sales::class, 'salesMade'])->name('sales.made');
Route::get('/hr/sales/survey/requests', [HR\Sales::class, 'salesSurveysRequests'])->name('hr.sales.survey.requests');

Route::get('/details/delete/{detailID}', [HR\Sales::class, 'detailDelete'])->name('hr.detail.delete');

//Sales Performance
Route::get('/sales/performance/dashboard',[HR\SalesPerformance::class,'performanceDashboard'])->name('sales.performance.dashboard');
Route::post('/sales/target/submit/{id}',[HR\SalesPerformance::class,'salesTargetSubmit'])->name('sales.target.submit');


//Per Marketer
Route::get('/sales-personnel-quotations/{id}', [HR\Sales::class, 'quotePerMarketer'])->name('quote.per.marketer');
Route::get('/sales-personnel-sold-services/{id}', [HR\Sales::class, 'saleMadePerMarketer'])->name('sales.per.marketer');

Route::get('/hr/sales/survey/requests/query/{dateS}/{dateE}', [HR\SalesReporting::class, 'salesSurveysRequestsQuery'])->name('hr.sales.survey.requests.query');
Route::get('/total-quotations-sent/{dateS}/{dateE}', [HR\SalesReporting::class, 'quotationsReporting'])->name('quotations.sent.reporting');
Route::get('/total-quotations-pending/{dateS}/{dateE}', [HR\SalesReporting::class, 'pendingQuotationsReporting'])->name('quotations.pending.reporting');
Route::get('/total-sales-made/{dateS}/{dateE}', [HR\SalesReporting::class, 'salesMadeReporting'])->name('sales.made.reporting');
//Per Marketer Reporting
Route::get('/sales/personnel/quotations/{id}/{dateS}/{dateE}', [HR\SalesReporting::class, 'quotePerMarketer'])->name('quote.per.marketer.reporting');
Route::get('/sales/personnel/sold/services/{id}/{dateS}/{dateE}', [HR\SalesReporting::class, 'saleMadePerMarketer'])->name('sales.per.marketer.reporting');

//End of HR's Surveys and Customers

//Human Resource Manager Route End

//Delivery Engineer Routes 

Route::post('/survey_report_form', [HomeController::class, 'survey_report_form']);
Route::get('/delivery_table', [HomeController::class, 'delivery']);
Route::get('/assigned_survey', [HomeController::class, 'assigned_survey']);
Route::get('/delivery_survey_report/{id}', [HomeController::class, 'survey_report']);
Route::get('/all_survey_report', [HomeController::class, 'all_survey_report']);
Route::get('/monthly_survey_report', [HomeController::class, 'monthly_survey_report']);
Route::get('/monthly_installation', [HomeController::class, 'monthly_installation']);
Route::get('/installation_reporting', [HomeController::class, 'installation_reporting']);
Route::get('/survey_reporting', [HomeController::class, 'survey_reporting']);
Route::get('/delivery_survey_export/{dateS}/{dateE}', [HomeController::class, 'delivery_survey_export']);
Route::get('/delivery_installation_export/{dateS}/{dateE}', [HomeController::class, 'delivery_installation_export']);
Route::get('/deployment_status', [HomeController::class, 'deployment_status']);
Route::get('/assigned_engr_form/{id}', [HomeController::class, 'assigned_engr_form']);
Route::get('/edit_survey_report_view/{id}', [HomeController::class, 'edit_survey_report_view']);
Route::post('/edit_survey_report_form', [HomeController::class, 'edit_survey_report_form']);
Route::delete('/delete_survey/{id}', [HomeController::class, 'delete_survey']);
Route::get('/commentview/{id}', [HomeController::class, 'commentview']);
Route::get('/assign_engr_form/{id}', [HomeController::class, 'assign_engr_form']);
Route::post('/update_assigned_engr_form/{id}', [HomeController::class, 'update_assigned_engr_form']);
Route::post('/comment/{id}', [HomeController::class, 'comment']);
Route::get('/email', function () {
    return new SurveyRequestMail();
});
Route::get('/delivery_search', [HomeController::class, 'delivery_search']);
Route::get('/assigned_search', [HomeController::class, 'assigned_survey_search']);
Route::get('/all_survey_report_search', [HomeController::class, 'all_survey_report_search']);
Route::get('/all_customers', [HomeController::class, 'all_customers']);
Route::get('/find_customers_search', [HomeController::class, 'find_customers']);
Route::get('/edit_customer/{survey_id}', [HomeController::class, 'edit_customer']);
Route::post('/edit_customer_param/{survey_id}', [HomeController::class, 'edit_customer_param']);
Route::get('/engr_filter', [SurveyController::class, 'engr_filter']);
Route::post('/change-survey-status/{survey_id}', [HomeController::class, 'suspendSurvey']);

//Technical Handover Routes
Route::post('/client-technical-handover-form/{client}/{client_id}/{survey_id}', [Client\Handover::class, 'formSubmit']);
Route::get('/all-client-technical-handover', [Client\Handover::class, 'allTechnicalHandovers']);
Route::post('/delivery/link-acceptability/{installation_id}/{survey_id}', [Client\Handover::class, 'linkStatus'])
    ->name('delivery.link.acceptability');

//End of Technical Handover Routes
//End of Delivery Route


// POP Filtering 
//Admin POP route
Route::get('/POP_filter', [POPController::class, 'Clients_POP']);

//Capacity Per POP route 
Route::get('/cap-per-POP', [CapPerPopController::class, 'CapPerPOP']);
//Beginning of Capacity Per POP route/

//Clients Per POP based on POP Name
Route::get('/clients_per_POP', [ClientsPerPOPController::class, 'Clients_per_POP']);
Route::get('/clients_per_pop_view/{pop}', [ClientsPerPOPController::class, 'clients_per_pop_view']);

Route::get('/Clients_per_POP_reporting', [ClientsPerPOPController::class, 'Clients_per_POP_reporting']);
Route::get('/clients_per_pop_reporting_view/{pop}/{dateE}/{dateS}', [ClientsPerPOPController::class, 'clients_per_pop_reporting_view']);
//End of Clients Per POP based on POP Name

//Clients per state
Route::get('/Clients_per_state', [ClientsPerStateController::class, 'Clients_per_state']);
Route::get('/Clients_per_state_view/{state}', [ClientsPerStateController::class, 'Clients_per_state_view']);
Route::get('/active_clients_per_state_reporting', [ClientsPerStateController::class, 'active_clients_per_state_reporting']);
Route::get('/active_clients_per_state_reporting_view/{state}/{dateE}/{dateS}', [ClientsPerStateController::class, 'active_clients_per_state_reporting_view']);
//End of Clients per state

//POP Per Sate
Route::get('/all-POP-view', [POPPerStateController::class, 'allPOPview']);
Route::get('/POP_per_state', [POPPerStateController::class, 'POP_per_state']);
Route::get('/POP_per_state_view/{state}', [POPPerStateController::class, 'POP_per_state_view']);

//Reporting routes
Route::get('/all-POP-view-reporting/{dateE}/{dateS}', [POPPerStateController::class, 'allPOPviewReporting']);
Route::get('/POP_per_state_reporting', [POPPerStateController::class, 'POP_per_state_reporting']);
Route::get('/POP_per_state_reporting_view/{state}/{dateE}/{dateS}', [POPPerStateController::class, 'POP_per_state_reporting_view']);
//End of POP Per Sate

//Marketer Client Per POP 
Route::get('/marketer_clients_per_POP', [MarketerClientPerPOP::class, 'Clients_per_POP']);
Route::get('/marketer_clients_per_POP_reporting', [MarketerClientPerPOP::class, 'Clients_per_POP_reporting']);
Route::get('/marketer_clients_per_pop_view/{pop}', [MarketerClientPerPOP::class, 'clients_per_pop_view']);
//End of Marketer Client Per POP 

//End of Admin POP route

//Sales Executive routes
//Sales Excutive Team Lead
Route::get('/payment', function () {
    return new SurveyPaymentMail();
});
Route::get('/my_survey', [SurveyController::class, 'my_survey']);
Route::get('/my_clients', [SurveyController::class, 'my_clients']);
Route::get('/payment_confirmation_paid/{id}', [SurveyController::class, 'payment_confirmation_paid']);
Route::get('/payment_confirmation_notpaid/{id}', [SurveyController::class, 'payment_confirmation_notpaid']);
Route::get('/survey_report/{id}', [SurveyController::class, 'survey_report']);
Route::get('/call_out_view', [SurveyController::class, 'call_out_view']);
Route::post('/call_out_form', [SurveyController::class, 'call_out_form']);
Route::get('/call_out_form_edit_view/{id}', [SurveyController::class, 'call_out_form_edit_view']);
Route::post('/call_out_form_edit/{id}', [SurveyController::class, 'call_out_form_edit']);
Route::get('/delete_call_out/{id}', [SurveyController::class, 'delete_call_out']);
Route::get('/my_call_out', [SurveyController::class, 'my_call_out']);
Route::get('/survey_report', [SurveyController::class, 'survey_reporting']);
Route::get('/survey_export/{dateS}/{dateE}', [SurveyController::class, 'survey_export']);
Route::get('/edit_my_survey/{id}', [SurveyController::class, 'edit_my_survey']);
Route::get('/call_out_report', [SurveyController::class, 'call_out_reporting']);
Route::get('/call_out_export/{dateS}/{dateE}', [SurveyController::class, 'call_out_export']);
Route::get('/sales_customers_report', [SurveyController::class, 'customers_reporting']);
Route::get('/sales_customers_export/{dateS}/{dateE}', [SurveyController::class, 'customers_export']);
Route::get('/my_survey_search', [SurveyController::class, 'my_surveys_search']);
Route::get('/my_clients_search', [SurveyController::class, 'my_clients_search']);
Route::post('/edit_survey_form/{id}', [EditSurveyController::class, 'edit_survey_form']);
//End of Sales Executive Team Lead

//Sales Agent's Routes
Route::get('/my_sales_team', [SalesAgentController::class, 'SalesAgentTeamLead']);
Route::get('/my_sales_team_reporting', [SalesAgentController::class, 'SalesAgentTeamLeadReporting']);
Route::get('/call_out_info_SA/{id}', [SalesAgentController::class, 'call_out_info']);
Route::get('/Sales_Agent_surveys/{id}', [SalesAgentController::class, 'Sales_Agent_surveys']);
Route::post('/Sales-SLA-form-Upload/{id}', [SalesAgentController::class, 'uploadSLA'])->name('sales.uploadSLA');


//End ofSales Agent Routes
//Sales Executives Routes Ending

//Pending Businesses For Sales Perdsonnel Routes
Route::get('/pending_business_page', [SurveyController::class, 'pending_business_page']);
Route::post('/pending_business_form', [SurveyController::class, 'pending_business_form']);
Route::get('/my_pending_business_page', [SurveyController::class, 'my_pending_business_page']);
Route::get('/pending_business_report', [SurveyController::class, 'my_pending_business_report']);
Route::delete('/delete_pending_business/{id}', [SurveyController::class, 'delete_pending_business']);
Route::get('/pending_business_edit_view/{id}', [SurveyController::class, 'pending_business_edit_view']);
Route::post('/pending_business_edit/{id}', [SurveyController::class, 'pending_business_edit']);
//End of Pending Businesses For Sales Perdsonnel Routes

//Pending Businesses For Human Resource Perdsonnel Routes
Route::get('/pending_business_view', [HRController::class, 'pending_business']);
Route::get('/pend_bus_details/{id}', [HRController::class, 'pend_bus_details']);
Route::get('/pending_business_reporting/{id}', [HRController::class, 'pending_business_reporting']);
//End of Pending Businesses For Human Resource Perdsonnel Routes 


// Subscription Controller Routes for Financing
//From MD's dashboard reporting
Route::get('/total_customers_reporting/{dateE}/{dateS}', [SubReportingViewController::class, 'total_customers_reporting']);
Route::get('/All_active_clients_reporting/{dateE}/{dateS}', [SubReportingViewController::class, 'All_active_clients_reporting']);
Route::get('/active_corporate_query/{dateE}/{dateS}', [SubReportingViewController::class, 'active_corporate_query']);
Route::get('/All_active_Prepaid_customers_reporting/{dateE}/{dateS}', [SubReportingViewController::class, 'All_active_Prepaid_customers_reporting']);
Route::get('/active_Postpaid_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'active_Postpaid_customers_query']);
Route::get('/active_sme_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'active_sme_customers_query']);
Route::get('/active_Home_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'active_Home_customers_query']);
Route::get('/Active_wired_corporate/{dateE}/{dateS}', [SubReportingViewController::class, 'Active_wired_corporate']);
Route::get('/Active_wireless_corporate/{dateE}/{dateS}', [SubReportingViewController::class, 'Active_wireless_corporate']);

Route::get('/Inactive_clients_query/{dateE}/{dateS}', [SubReportingViewController::class, 'Inactive_clients_query']);
Route::get('/Inactive_corporate_query/{dateE}/{dateS}', [SubReportingViewController::class, 'Inactive_corporate_query']);
Route::get('/Inactive_Prepaid_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'Inactive_Prepaid_customers_query']);
Route::get('/Inactive_Postpaid_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'Inactive_Postpaid_customers_query']);
Route::get('/Inactive_sme_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'Inactive_sme_customers_query']);
Route::get('/Inactive_Home_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'Inactive_Home_customers_query']);
Route::get('/suspended_customers_query/{dateE}/{dateS}', [SubReportingViewController::class, 'suspended_customers_query']);


//End of MD's dashboard reporting

// All Connected Customers
//From Finance reporting
Route::get('/All_connected_customers', [SubscriptionController::class, 'All_connected_customers']);
Route::get('/All_connected_customers_reporting', [SubscriptionController::class, 'All_connected_customers_reporting']);

Route::get('/All_suspended_customers', [SubscriptionController::class, 'All_suspended_customers']);
Route::get('/All_suspended_customers_reporting', [SubscriptionController::class, 'All_suspended_customers_reporting']);
//End of routte for All Connected Customers  


//All Total Active And Inactive Customers  Routes
Route::get('/All_active_customers', [SubscriptionController::class, 'All_active_customers']);
Route::get('/All_active_customers_reporting', [SubscriptionController::class, 'All_active_customers_reporting']);

Route::get('/Inactive_customers', [SubscriptionController::class, 'Inactive_customers']);
Route::get('/Inactive_customers_reporting', [SubscriptionController::class, 'Inactive_customers_reporting']);
Route::get('/md_active_customers_reporting/{dateS}/{dateE}', [SubscriptionController::class, 'md_active_customers_reporting']);

//End of All active And Inactive  Customer Total

//All Active And Inactive   Corporate Customers Routes
Route::get('/All_active_corporate_customers_reporting', [SubscriptionController::class, 'All_active_corporate_customers_reporting']);
Route::get('/All_active_corporate_customers', [SubscriptionController::class, 'All_active_corporate_customers']);
Route::get('/All_active_wireless_corporate_clients', [SubscriptionController::class, 'All_active_wireless_corporate_clients']);
Route::get('/All_active_wired_corporate_clients', [SubscriptionController::class, 'All_active_wired_corporate_clients']);

Route::get('/Inactive_corporate_customers', [SubscriptionController::class, 'Inactive_corporate_customers']);
Route::get('/Inactive_corporate_customers_reporting', [SubscriptionController::class, 'Inactive_corporate_customers_reporting']);
//All Active And Inactive   Corporate Customers Routes

//All Active And Inactive   Prepaid Customers Routes
Route::get('/All_active_Prepaid_customers', [SubscriptionController::class, 'All_active_Prepaid_customers']);
Route::get('/All_active_Prepaid_customers_reporting', [SubscriptionController::class, 'All_active_Prepaid_customers_reporting']);

Route::get('/Inactive_Prepaid_customers', [SubscriptionController::class, 'Inactive_Prepaid_customers']);
Route::get('/Inactive_Prepaid_customers_reporting', [SubscriptionController::class, 'Inactive_Prepaid_customers_reporting']);
//All Active And Inactive   Prepaid Customers Routes

// All Active Customers Plan By plan

// SME Clients' Subscription Routes
Route::get('/Active_sme', [SubscriptionController::class, 'active_SME_clients']);
Route::get('/active_sme_customers_report', [SubscriptionController::class, 'active_sme_customers_report']);

Route::get('/Inactive_sme', [SubscriptionController::class, 'inactive_SME_clients']);
Route::get('/inactive_sme_customers_report', [SubscriptionController::class, 'inactive_sme_customers_report']);
//End SME Clients' Subscription Routes

// Dedicated Clients Subscription 
Route::get('/active_Dedicated_clients', [SubscriptionController::class, 'active_Dedicated_clients']);
Route::get('/active_Dedicated_customers_report', [SubscriptionController::class, 'active_Dedicated_customers_report']);

Route::get('/inactive_Dedicated_clients', [SubscriptionController::class, 'inactive_Dedicated_clients']);
Route::get('/inactive_Dedicated_customers_report', [SubscriptionController::class, 'inactive_Dedicated_customers_report']);
//End Dedicated Clients Subscription Routes

// Home Clients' Subscription 

Route::get('/active_Home_clients', [SubscriptionController::class, 'active_Home_clients']);
Route::get('/active_Home_customers_report', [SubscriptionController::class, 'active_Home_customers_report']);

Route::get('/inactive_Home_clients', [SubscriptionController::class, 'inactive_Home_clients']);
Route::get('/inactive_Home_customers_report', [SubscriptionController::class, 'inactive_Home_customers_report']);
//End Home Clients' Subscription Routes

//End  All Active Customers Routes

//End of Subscription ontroller Routes


//Finance Officer's Routes
Route::get('/pending_client', [FinanceController::class, 'pending_client']);
Route::get('/new_sales', [FinanceController::class, 'new_sales']);
Route::get('/all_clients', [FinanceController::class, 'all_clients']);
Route::get('/sme_clients', [FinanceController::class, 'SME_clients']);
Route::get('/home_clients', [FinanceController::class, 'Home_clients']);
Route::get('/dedicated_clients', [FinanceController::class, 'Dedicated_clients']);
Route::get('/payment/{id}', [FinanceController::class, 'payment']);
Route::post('/amount_paid/{id}', [FinanceController::class, 'amount_paid']);
Route::get('/activation_payment/{id}', [FinanceController::class, 'customer_payment']);
Route::post('/customer_payment/{id}', [FinanceController::class, 'customer_amount_paid']);
Route::post('/customer_deactivation/{id}', [FinanceController::class, 'customer_deactivation']);
Route::get('/suspend_customer/{id}', [FinanceController::class, 'suspend_customer']);
Route::get('/search', [FinanceController::class, 'search']);
Route::get('/pending_client_search', [FinanceController::class, 'pending_client_search']);
Route::get('/customers_report', [FinanceController::class, 'report']);
Route::get('/customers_export/{dateS}/{dateE}', [FinanceController::class, 'export']);
Route::get('/home_clients_reporting', [FinanceController::class, 'home_clients_reporting']);
//End of Finance Officer's Routes


//Service Engineer's Route
Route::get('/ready_links', [ServiceController::class, 'ready_links']);
Route::post('/update_radio_param/{id}', [ServiceController::class, 'update_radio_param']);
Route::get('/update/{id}', [ServiceController::class, 'update']);
// Route::get('/edit_radio_parameters/{id}', [ServiceController::class, 'edit_parameters']);
Route::post('/edit_radio_param/{id}', [ServiceController::class, 'editLinkParameters']);
Route::get('/find', [ServiceController::class, 'find']);
Route::get('/linked_customers', [ServiceController::class, 'linked_customers']);
Route::get('/find_linked', [ServiceController::class, 'find_linked'])->name('linked.customers.search');


//POP Maintenance Support Ticket Routes

//POP Tickets Raise
Route::get('/all-raised-POP-tickets', [ServiceOps\POPTicketController::class, 'allPOPTickets'])->name('all.POP.tickets');
Route::get('/raise-pop-ticket', [ServiceOps\POPTicketController::class, 'POPTickets'])->name('create.POP.tickets');
Route::post('/pops-ticket-form-submit/{POP_ID}', [ServiceOps\POPTicketController::class, 'ticketForm']);
Route::post('/pops/ticket/form-closure/{id}', [ServiceOps\POPTicketController::class, 'POPticketClosure'])->name('pops-ticket-form-closure');

//POP Tickets Raise

Route::get('/create_new_base_station', [ServiceController::class, 'new_base_station']);
Route::get('/all_base_station', [ServiceController::class, 'all_base_station'])->name('all.pops');
Route::post('/base_station_creation', [ServiceController::class, 'base_station_form']);
Route::get('/edit_pop_view/{id}', [ServiceController::class, 'edit_pop_view']);
Route::post('/edit_pop/{id}', [ServiceController::class, 'edit_pop']);

//POP Survey Routes
Route::post('/pop-survey-form', [ServiceOps\POPSurveyController::class, 'submit']);
Route::get('/all-pop-surveys', [ServiceOps\POPController::class, 'surveyView'])->name('POP.surveys.all');

//End of POP Survey Routes    
//End of Service Engineer's Route


//Network Operations routes
Route::get('/ready_integration', [NetworkController::class, 'ready_integration']);
Route::get('/integrated_customers', [NetworkController::class, 'integrated_customers']);
Route::get('/index', [NetworkController::class, 'index']);
Route::get('/integrate/{id}', [NetworkController::class, 'integration']);
Route::post('/integration_param/{id}', [NetworkController::class, 'integration_param']);
Route::get('/edit_integration_parameters/{id}', [NetworkController::class, 'edit_parameters']);
Route::post('/edit_integration_param/{id}', [NetworkController::class, 'edit']);
Route::get('/find_integrated', [NetworkController::class, 'find_integrated']);
//End of Network Operations routes


//Industry Categorzation Routes
Route::get('/industries', [IndustriesController::class, 'industries']);
Route::get('/industries_reporting', [IndustriesController::class, 'industries_reporting']);
Route::get('/multinational', [IndustriesController::class, 'view_industry']);
Route::get('/p_business', [IndustriesController::class, 'view_industry']);
Route::get('/government', [IndustriesController::class, 'view_industry']);
Route::get('/cybercafe', [IndustriesController::class, 'view_industry']);
Route::get('/hm_research', [IndustriesController::class, 'view_industry']);
Route::get('/public_lib', [IndustriesController::class, 'view_industry']);
Route::get('/pub_sec_ser', [IndustriesController::class, 'view_industry']);
Route::get('/ngo', [IndustriesController::class, 'view_industry']);
Route::get('/sch_res', [IndustriesController::class, 'view_industry']);
Route::get('/institution', [IndustriesController::class, 'view_industry']);
Route::get('/res_indi', [IndustriesController::class, 'view_industry']);
Route::get('/military', [IndustriesController::class, 'view_industry']);
Route::get('/others', [IndustriesController::class, 'view_industry']);
Route::get('/industries_dashboard_hr', [IndustriesController::class, 'industries_dashboard_hr']);
Route::get('/industry_change/{id}', [IndustriesController::class, 'industry_change']);
Route::post('/industry_change_form/{id}', [IndustriesController::class, 'industry_change_form']);
Route::get('/industry_cat_filter/{name}', [IndustriesController::class, 'industry_cat_filter']);
Route::post('/new_client_industry_form/{id}', [IndustriesController::class, 'new_client_industry_form']);
Route::get('/industry_new_change/{id}', [IndustriesController::class, 'industry_new_change']);
//End of Industry Categorzation Routes


//Private Business Industry Sub-category Route
Route::get('/pb_industries', [PrivateBusinessController::class, 'pb_industries']);
//Private Business Industry Sub-category Details Route
Route::get('/c_rent', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/elec_ware', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/ENERGY', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/Engineering', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/eq_man', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/fin_acc', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/fintech', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/fd_bev', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/furn', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/hosp', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/health', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/ICT', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/LAW', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/med_adv', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/ngo', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/oil_gas', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/sec_cctv', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/tra_tou', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/log_tra', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
Route::get('/others', [PrivateBusinessController::class, 'private_industry_sub_cat_details']);
//End of Private Business Industry Sub-category Details Route
//End of Private Business Industry Sub-category Details Route

//Support Personnel's Route
//Beginning of Customers Routes
//Addition of new customers
Route::get('/add-new-client', [Client\AddNewClient::class, 'addNewClient']);
Route::post('/submit-form', [Client\AddNewClient::class, 'addNewClientForm']);
Route::post('/client-info-edit-form/{client_id}/{survey_id}', [Client\EditClient::class, 'editClientInfo']);

//End of New customer Addition
//Beginning of Customer's Subscription Status
Route::get('/clients-subscription-status', [Client\subscriptionStatus::class, 'clientSubscriptionStatus']);
Route::get('/client-subscription-status-filter', [Client\subscriptionStatus::class, 'subscriptionFilter']);
Route::get('/history-client-subscription-status', [Client\subscriptionStatus::class, 'clientHistoricalSubscriptionStatus']);
//End of Customer's Subscription Status
//Beginning of Customers Routes

//Client Maintenance Support Ticket Route
//Support Team Members 
Route::get('/erp_cust_ticket', [FieldSupportTicketController::class, 'erp_cust_ticket']);
Route::get('/erp_cust_ticket_search', [FieldSupportTicketController::class, 'erp_cust_ticket_search']);
Route::get('/erp_client_incident_ticket/{id}', [FieldSupportTicketController::class, 'erp_client_incident_ticket']);
Route::get('/create_field_support_form', [FieldSupportTicketController::class, 'create_field_support_form']);
Route::get('/my-field-tickets', [FieldSupportTicketController::class, 'my_support_tickets']);
Route::get('/my-field-ticket-query', [FieldSupportTicketController::class, 'mySupportTicketsQuery'])->name('my.tickets.query');
Route::get('/all/field/tickets/query', [FieldSupportTicketController::class, 'allSupportTicketsQuery'])->name('all.tickets.query');

Route::get('/create_field_support_form', [FieldSupportTicketController::class, 'create_field_support_form']);
Route::post('/submit_field_support_form', [FieldSupportTicketController::class, 'submit_field_support_form']);
Route::get('/all_field_support_tickets', [FieldSupportTicketController::class, 'all_field_support_tickets']);
Route::get('/ticket_report/{ticket_id}', [FieldSupportTicketController::class, 'ticket_report']);
Route::get('/close_ticket/{ticket_id}', [FieldSupportTicketController::class, 'close_ticket']);
Route::post('/closing_mail/{ticket_id}', [FieldSupportTicketController::class, 'closing_mail']);
Route::post('/cancel_ticket/{ticket_id}', [FieldSupportTicketController::class, 'cancel_ticket']);
Route::delete('/delete/ticket/{ticket_id}', [FieldSupportTicketController::class, 'deleteTicket'])->name('delete.ticket');
Route::post('/reassign_engineer/{ticket_id}', [AssignTicketEngr::class, 'reassign_engineer']);

// Search Field Tickets
Route::get('/all-field-ticket-search', [FieldSupportTicketController::class, 'allTicketsSearch'])->name('all.tickets.search');
Route::get('/my-field-ticket-search', [FieldSupportTicketController::class, 'myTicketsSearch'])->name('my.tickets.search');


//Daily Handover Form
Route::get('/daily/client/handovers', [Client\DailyHandover::class, 'showDailyHandover'])->name('support.dailHandover.add');
Route::post('/daily/client/handovers/Form', [Client\DailyHandover::class, 'dailyHandoverForm'])->name('support.dailyHandover.form');
Route::get('/client/autocomplete/Form/{id}', [Client\DailyHandover::class, 'clientAutoComplete'])->name('support.dailyHandover.autocomplete');
Route::post('/daily/client/handovers/Ediit/{id}', [Client\DailyHandover::class, 'dailyHandoverEdit'])->name('support.dailyHandover.edit');
Route::get('/send/daily/handover', [Client\DailyHandover::class, 'sendDailyHandover'])->name('support.dailyHandover.send');
Route::get('/my/daily/handover', [Client\DailyHandover::class, 'myDailyHandover'])->name('my.dailyHandover');
Route::get('/send/my-daily-handover', [Client\DailyHandover::class, 'sendMyDailyHandover'])->name('my-handover.send');
Route::get('/all/daily/handover/query', [Client\DailyHandover::class, 'allDailyHandoverQueery'])->name('all.dailyHandover.query');
Route::get('/my/daily/handover/query', [Client\DailyHandover::class, 'myHandoverQuery'])->name('my.dailyHandover.query');
Route::get('/all/daily/handover/search', [Client\DailyHandover::class, 'allHandoverSearch'])->name('all.daily.handover.search');

Route::delete('/delete/daily-handover/{id}', [Client\DailyHandover::class, 'deleteHandover'])->name('handover.delete');


//End of Team members
//Client Maintenance Support Ticket Route


//Head of Support Assignment Route
Route::get('/all_field_support_tickets', [AssignTicketEngr::class, 'all_field_support_tickets']);
Route::post('/assign_engineer/{ticket_id}', [AssignTicketEngr::class, 'assign_engineer']);
//End of Head of Support Assignment Route

//Dashboard for All
Route::get('/engr-assignment-dashboard', [TicketDashboardController::class, 'engrassignmentDashboard']);
Route::get('/engr-assgt-view/{id}', [TicketDashboardController::class, 'engrassignmentView']);
//End of Dashboard

//End of Support Personnel's Route

//Beginning of Field Engineer's Route 
//Field Support Routes
Route::get('/my_field_support', [FieldEnginnerController::class, 'my_field_support']);
Route::post('/engr_ticket_status/{ticket_id}', [FieldEnginnerController::class, 'engr_ticket_status']);
Route::get('/engr_ticket_report/{ticket_id}', [FieldEnginnerController::class, 'engr_ticket_report']);
Route::get('/view_field_report/{ticket_id}', [FieldEnginnerController::class, 'view_field_report']);
Route::post('/submit_field_report_form/{ticket_id}', [FieldEnginnerController::class, 'submit_field_report_form']);

//Field POP Routes
//POP Survey
Route::get('/engr-pending-pop-surveys', [POP\Survey::class, 'assignedSurvey'])->name('engr.pending.pop.survey');
Route::get('/engr-completed-pop-surveys', [POP\Survey::class, 'completedSurveys'])->name('engr.completed.pop.survey');
Route::post('/submit-pop-survey-form/{id}', [POP\Survey::class, 'POPSurveyReport'])->name('engr.pop.survey.form');

//POP Maintenance
Route::get('/engr-completed-pop-maintenance', [POP\Ticket::class, 'completedMaintenance'])->name('engr.completed.pop.maintenance');
Route::get('/engr-pending-pop-maintenance-tickets', [POP\Ticket::class, 'pendingTickets'])->name('engr.pop.maintenance.ticket');
Route::put('/pop-maintenance-ticket-form/{ticket_id}', [ServiceOps\POPFieldReportController::class, 'maintenanceTicketForm'])->name('pop.maintenance.form');

//Field Support Routes

//Client Survey & Installation Routes
Route::get('/my_assigned_survey', [FieldEnginnerController::class, 'my_assigned_survey']);
Route::post('/survey_report_form/{id}', [FieldEnginnerController::class, 'survey_report_form']);
Route::get('/my_assigned_installations', [FieldEnginnerController::class, 'my_assigned_installations']);
Route::post('/client-job-completion-form/{id}', [FieldEnginnerController::class, 'jobCompletionForm']);
//Client Survey & Installation Routes
//end of Field Engineer's Route


//JobOrder Form And Procedural Processes routes
//Delivery Routes
Route::get('/raise-job-order', [JobOrders\JobOrderController::class, 'raiseJobOrder']);
Route::get('/job-order-form', [JobOrders\JobOrderController::class, 'jobOrderForm']);
Route::post('/job-order-form-submit/{id}', [JobOrders\JobOrderController::class, 'submitForm']);
Route::post('/edit-job-order/{client_id}', [JobOrders\JobOrderController::class, 'EditForm']);
Route::get('/print-job-order-form/{client_id}', [JobOrders\JobOrderController::class, 'PrintForm']);
Route::post('/reviewForm/{id}', [JobOrders\JobOrderController::class, 'reviewForm']);

//Delivery Route

//Service Operations Routes
Route::get('/raised-job-orders', [JobOrders\ServiceOpsJobOrderContoller::class, 'raisedJO']);
Route::get('/job-order-form', [JobOrders\ServiceOpsJobOrderContoller::class, 'jobOrderForm']);
Route::post('/job-order-review-edited/{id}/{raiser}/{editor}/{FSE}', [JobOrders\ServiceOpsJobOrderContoller::class, 'commentFormEdited']);
Route::post('/job-order-review/{id}/{raiser}/{FSE}', [JobOrders\ServiceOpsJobOrderContoller::class, 'commentForm']);
// Route::post('/edit-job-order/{client_id}',[ServiceOpsJobOrderContoller::class,'EditForm']);
//Service Operations Route

//Admin Approval Routes
Route::get('/admin-pending-job-orders', [JobOrders\AdminJO::class, 'raisedJO']);
Route::get('/admin-all-job-orders', [JobOrders\AdminJO::class, 'allJO'])->name('admin.allJO');
Route::post('/job-order-approval/{id}/{raiser}/{FSE}', [JobOrders\AdminJO::class, 'approvalForm']);
//Admin Approval Routes

//Job completion pdf Download and View route.
Route::get('/job-completion-SLA/{pdf}', [JobOrders\AdminJO::class, 'JCpdfDownload']);
Route::get('/job-completion-Attachment-View/{id}', [JobOrders\AdminJO::class, 'JCpdfView']);

//End of Job Order Forms
//End of Job Order Forms

//IT Support Routes
Route::get('/IT-update-client-payment-status', [Client\ITAddPayment::class, 'updateClientPaymentStatus']);
//End of IT Support Routes

//Weekly Expenses Routes Begins
Route::get('/all/weekly/expenses', [Maintenance\WeeklyExpenses::class, 'allWeeklyExpenses'])->name('all.weekly.expenses');
Route::post('/update/weekly/expenses/{id}', [Maintenance\WeeklyExpenses::class, 'updateExpense'])->name('expense.update');
Route::get('/all/weekly/expenses/print', [Maintenance\WeeklyExpenses::class, 'PrintExpenses'])->name('all.weekly.expenses.print');
Route::post('/weekly/expenses/summary', [Maintenance\WeeklyExpenses::class, 'expensesSummary'])->middleware('web')->name('weekly.expenses.summary');

Route::delete('/delete/weekly/expenses/{id}', [Maintenance\WeeklyExpenses::class, 'deleteExpense'])->name('delete.weekly.expenses');

//End Weekly Expenses Routes