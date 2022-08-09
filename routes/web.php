<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\CounsellorController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\QuestionController; 
use App\Http\Controllers\Admin\PasswordController; 
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DoctorManagementController;
use App\Http\Controllers\Doctor\LoginSignupController;
use App\Http\Controllers\Doctor\DashboardController as DoctorDashboardController;
use App\Http\Controllers\Doctor\DoctorProfileController;
use App\Http\Controllers\Doctor\AppointmentController;
use App\Http\Controllers\Doctor\DoctorRemarkController;
use App\Http\Controllers\Doctor\PasswordController as DoctorPasswordController;
use App\Http\Controllers\Agent\AgentLoginController;
use App\Http\Controllers\Agent\AgentDashboardController;
use App\Http\Controllers\Agent\PatientInfoController;
use App\Http\Controllers\Agent\BookAppointmentController;
use App\Http\Controllers\Newsletter\NewsLetterController;
use App\Http\Controllers\Admin\Blog\BlogController;
use App\Http\Controllers\Customer\BlogViewController;
use App\Http\Controllers\Admin\Media_Press\MediaPressController;
use App\Http\Controllers\Admin\Media_Press\MediaPressReleaseController;
use App\Http\Controllers\Customer\PressMediaController;
use App\Http\Controllers\Admin\Faq_live\FaqLiveController;
use App\Http\Controllers\Customer\FaqLiveViewController;

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


/*
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.home');
});

Auth::routes();
Route::get('/zoom-meeting', [LoginController::class, 'zoom_meeting'])->name('zoom_meeting');

Route::get('/home', [App\Http\Controllers\Customer\HomeController::class, 'index'])->name('home');
Route::get('/counsellors', [CounsellorController::class, 'counsellors'])->name('frontend.home');
Route::get('/counselor-detail/{id}', [CounsellorController::class, 'counselor_detail'])->name('counselor.detail');
Route::post('/join-us-news-letter', [NewsLetterController::class, 'news_letter'])->name('frontend.news_letter');

Route::post('/user/logout', [LoginController::class, 'userLogout'])->name('user.logout');
Route::get('/payment/thankyou',[PatientInfoController::class, 'payment_with_link_thankyou'])->name('user.payment_with_link_thankyou');
Route::get('/payment-confirmation/thankyou',[PatientInfoController::class, 'payment_with_link_from_agent_thankyou'])->name('user.payment_with_link_from_agent_thankyou');


Route::get('/blogs', [BlogViewController::class, 'blog_list'])->name('blog.list');
Route::get('/blogs/post/{id}',[BlogViewController::class, 'blog_detail'])->name('blog.detail');
Route::get('/blogs/{slug}/{id}',[BlogViewController::class, 'blog_detail'])->name('blog.detail');
Route::get('/faq', [FaqLiveViewController::class, 'index'])->name('faq.list');


Route::get('/press-media-release', [PressMediaController::class, 'press_media_release'])->name('press_media_release.list');


Route::get('/trial_report.php', [BlogViewController::class, 'trial_report']);




Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin.guest'], function(){
        Route::get('/login',[LoginController::class, 'login'])->name('admin.login');
        Route::post('/adminlogin',[LoginController::class, 'authenticate'])->name('admin.auth');
        Route::get('/reset-password', [PasswordController::class, 'forgot_password']);
        Route::post('/forgot-password-process', [PasswordController::class, 'forgot_password_process'])->name('admin.reset_mail');
        Route::get('/forgot-password-process-change/{id}', [PasswordController::class, 'forgot_password_process_change']);
        Route::post('/forgot-password-uodate', [PasswordController::class, 'forgot_password_update'])->name('admin.password_update');
        


    });

    Route::group(['middleware' => 'admin.auth'], function(){
        Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::resource('/service', ServiceController::class);
        Route::resource('/question', QuestionController::class);
        Route::get('/addemp',[ServiceController::class, 'addemp']);
        Route::get('/treeview',[ServiceController::class, 'treeview']);
        Route::get('/add-zoom-setting',[SettingController::class, 'add_zoom_setting'])->name('admin.add_zoom_setting');
        Route::post('/update-zoom-setting',[SettingController::class, 'update_zoom_setting'])->name('admin.update_zoom_setting');
        Route::resource('/doctor-list', DoctorManagementController::class);
        Route::get('/news-letter',[NewsLetterController::class, 'news_letter_emails']);
        Route::resource('blog', BlogController::class);
        Route::post('/post-active-deactive',[BlogController::class, 'post_active_deactive'])->name('post.status');
        Route::resource('media-press', MediaPressController::class);
        Route::resource('media-press-release', MediaPressReleaseController::class);
        Route::get('/blog/publish/{id}',[BlogController::class, 'blog_publish'])->name('blog.publish');
        Route::post('/press-media-active-deactive',[MediaPressController::class, 'press_media_active_deactive'])->name('press_media.status');
        Route::post('/press-media-release-active-deactive',[MediaPressReleaseController::class, 'press_media_release_active_deactive'])->name('press_media_release.status');
        Route::post('/press-media-list-filterd-by-release-id',[MediaPressReleaseController::class, 'press_media_list_filterd_by_release_id']);
        Route::post('/save-assigned-media-press',[MediaPressReleaseController::class, 'save_assigned_media_press']);
        Route::post('/remove-assigned-media-press-byid',[MediaPressReleaseController::class, 'remove_assigned_media_press']);

        // Route::get('/question',[QuestionController::class, 'question_filter'])->name('admin.question_filter');

    });
});

//Step 7: Created routes for doctor
Route::group(['prefix' => 'doctor'], function() {
    Route::group(['middleware' => 'doctor.guest'], function(){
        Route::get('/login',[LoginSignupController::class, 'login'])->name('doctor.login');
        Route::post('/doctorlogin',[LoginSignupController::class, 'authenticate'])->name('doctor.auth');
        Route::get('/signup',[LoginSignupController::class, 'signupform']);
        Route::post('/signup-process',[LoginSignupController::class, 'signup_process'])->name('doctor.signup_process');
        // Route::post('/getcity', [DoctorProfileController::class, 'getcity'])->name('doctor.getcity');
        Route::get('/forgot-password', [DoctorPasswordController::class, 'forgot_password'])->name('doctor.forgot_password');

        


    });

    Route::group(['middleware' => 'doctor.auth'], function(){
        Route::get('/dashboard',[DoctorDashboardController::class, 'dashboard'])->name('doctor.dashboard');
        Route::get('/myappointment',[AppointmentController::class, 'myappointment'])->name('doctor.myappointment');
        Route::get('/logout', [LoginSignupController::class, 'logout'])->name('doctor.logout');
        Route::resource('/profile', DoctorProfileController::class);
        Route::post('/getstate', [DoctorProfileController::class, 'getstate'])->name('doctor.getstate');
        Route::post('/getcity', [DoctorProfileController::class, 'getcity'])->name('doctor.getcity');
        // Route::get('/dashboard', [DoctorProfileController::class, 'dashboard'])->name('doctor.dashboard');
        
        Route::get('/all-appointment', [AppointmentController::class, 'all_appointment'])->name('doctor.all_appointment');
        Route::get('/all-appointments', [AppointmentController::class, 'all_appointments_ajax'])->name('doctor.all_appointments_ajax');
        Route::get('/appointments/{id}', [AppointmentController::class, 'datewise_appointment'])->name('doctor.datewise_appointment');
        Route::get('/appointments/{id}/{date}/patient-detail', [AppointmentController::class, 'patient_detail'])->name('doctor.patient_detail');
        Route::post('/doctor-save-remark',[DoctorRemarkController::class, 'doctor_save_remark'])->name('doctor.doctor_save_remark);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   k');
        // Route::get('/appointments/{id}/{date}/patient-detail/doctor-save-remark/doctor-save-remark',[AppointmentController::class, 'doctor_save_remark'])->name('doctor.doctor_save_remark);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   k');
        
        Route::get('/zoom-meeting-setting', [DoctorProfileController::class, 'zoom_meeting_setting'])->name('doctor.zoom_meeting_setting');

        Route::get('/change-password', [DoctorPasswordController::class, 'change_doctor_password'])->name('doctor.change_doctor_password');
        Route::post('/change-doctor-password-update', [DoctorPasswordController::class, 'change_doctor_password_update'])->name('doctor.change_doctor_password_update');
        
    });
});

Route::group(['prefix' => 'agent'], function() {
    Route::group(['middleware' => 'agent.guest'], function(){
        Route::get('/login',[AgentLoginController::class, 'login'])->name('agent.login');
        Route::post('/agentlogin',[AgentLoginController::class, 'authenticate'])->name('agent.auth'); 


    });
    Route::group(['middleware' => 'agent.auth'], function(){
        Route::get('/dashboard',[AgentDashboardController::class, 'dashboard'])->name('agent.dashboard');
        Route::post('/logout', [AgentLoginController::class, 'logout'])->name('agent.logout');
        Route::resource('/patient', PatientInfoController::class);
        Route::get('/book-appointment',[BookAppointmentController::class, 'book_appointment'])->name('agent.book_appointment');
        Route::post('/check-available-slot',[BookAppointmentController::class, 'check_available_slot'])->name('agent.check_available_slot');
        Route::post('/confirm-appointment-booking',[BookAppointmentController::class, 'confirm_appointment_booking'])->name('agent.confirm_appointment_booking');

        // Route::get('/question',[QuestionController::class, 'question_filter'])->name('admin.question_filter');

    });
});

Route::group(['prefix' => 'support'], function() {
    Route::group(['middleware' => 'support.guest'], function(){
        Route::get('/login',[App\Http\Controllers\Support\LoginController::class, 'login'])->name('support.login');
        Route::post('/supportlogin',[App\Http\Controllers\Support\LoginController::class, 'authenticate'])->name('support.auth');
    });

    Route::group(['middleware' => 'support.auth'], function(){
        Route::get('/dashboard',[App\Http\Controllers\Support\DashboardController::class, 'dashboard'])->name('support.dashboard');
        Route::post('/logout', [App\Http\Controllers\Support\LoginController::class, 'logout'])->name('support.logout');

    });
});
