<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\StudentCourseEnrollmentController;
use App\Http\Controllers\Admin\TeacherCourseEnrollmentController;
use App\Http\Controllers\Payment\StudentPaymentController;
use App\Http\Controllers\Account\DailyExpenseController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\ExpenseGLCodeController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\IncomeGLCodeController;
use App\Http\Controllers\IncomeController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cancle-button', [DashboardController::class, 'cancle'])->name('cancle.button');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/role', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/role-create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/role-create', [RoleController::class, 'store']);
    Route::post('/role-show-{id}', [RoleController::class, 'show'])->name('Role.view');
    Route::get('/role-edit-{id}', [RoleController::class, 'edit'])->name('Role.edit');
    Route::post('/role-edit-{id}', [RoleController::class, 'update']);
    Route::post('/role-delete-{id}', [RoleController::class, 'delete'])->name('Role.delete');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission.index');
    Route::get('/permission-create', [PermissionController::class, 'create'])->name('permission.create');
    Route::post('/permission-create', [PermissionController::class, 'store']);
    Route::post('/permission-show-{id}', [PermissionController::class, 'show'])->name('permission.view');
    Route::get('/permission-edit-{id}', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::post('/permission-edit-{id}', [PermissionController::class, 'update']);
// jquery edit
    Route::post('/permission-JqueryEdit-{id}', [PermissionController::class, 'jquery_edit']);
    Route::post('/permission-JqueryUpdate-{id}', [PermissionController::class, 'jquery_update']);
// jquery edit end
    Route::post('/permission-delete-{id}', [PermissionController::class, 'delete'])->name('permission.delete');    
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/UserType', [UserTypeController::class, 'index'])->name('UserType.index');
    Route::get('/UserType-create', [UserTypeController::class, 'create'])->name('UserType.create');
    Route::post('/UserType-create', [UserTypeController::class, 'store']);
    Route::post('/UserType-show-{id}', [UserTypeController::class, 'show'])->name('UserType.view');
    Route::post('/UserType-delete-{id}', [UserTypeController::class, 'delete'])->name('UserType.delete');
    Route::get('/UserType-edit-{id}', [UserTypeController::class, 'edit'])->name('UserType.edit');
    Route::post('/UserType-edit-{id}', [UserTypeController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'verified'])->namespace('Admin')->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user-create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user-create', [UserController::class, 'store']);
    Route::get('/user-show-{id}', [UserController::class, 'show'])->name('user.view');
    Route::post('/user-view-tooltip-{id}', [UserController::class, 'view']);
    Route::get('/user-edit-{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/user-edit-{id}', [UserController::class, 'update']);
    Route::post('/user-image-delete-{id}', [UserController::class, 'image_delete']);
    Route::get('/user-delete-{id}', [UserController::class, 'delete'])->name('user.delete');
    Route::post('/user-verify-{id}', [UserController::class, 'User_Verify']);
    Route::post('/user-phone-number-availability-{phone}', [UserController::class, 'phone_number_availability']);
    Route::post('/email-availability-{email}', [UserController::class, 'email_availability']);
    Route::post('/create-at-date-filter', [UserController::class, 'create_at_date_filter']);
    Route::post('/dynamicly-user-class-select-{id}', [UserController::class, 'dynamicly_user_class_select']);
});

Route::middleware(['auth:sanctum', 'verified'])->namespace('Admin')->group(function () {
    Route::get('/student', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student-create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student-create', [StudentController::class, 'store']);
    Route::get('/student-show-{id}', [StudentController::class, 'show'])->name('student.view');
    Route::post('/student-view-tooltip-{id}', [StudentController::class, 'view']);
    Route::get('/student-edit-{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::post('/student-edit-{id}', [StudentController::class, 'update']);
    Route::post('/student-image-delete-{id}', [StudentController::class, 'image_delete']);
    Route::post('/student-delete-{id}', [StudentController::class, 'student_delete'])->name('student.delete');
    Route::post('/student-verify-{id}', [StudentController::class, 'student_Verify']);
    Route::post('/student-phone-number-availability-{phone}', [StudentController::class, 'phone_number_availability']);
    Route::post('/student-email-availability-{email}', [StudentController::class, 'email_availability']);
    Route::post('/student-create-at-date-filter', [StudentController::class, 'create_at_date_filter']);
    Route::post('/dynamicly-student-class-select-{id}', [StudentController::class, 'dynamicly_student_class_select']);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/class', [ClassController::class, 'index'])->name('class.index');
    Route::get('/class-create', [ClassController::class, 'create'])->name('class.create');
    Route::post('/class-create', [ClassController::class, 'store']);
    Route::post('/class-show-{id}', [ClassController::class, 'show'])->name('class.view');
    Route::post('/class-delete-{id}', [ClassController::class, 'delete'])->name('class.delete');
    Route::post('/class-edit-{id}', [ClassController::class, 'edit'])->name('class.edit');
    Route::post('/class-update-{id}', [ClassController::class, 'update']);
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/batch', [BatchController::class, 'index'])->name('batch.index');
    Route::get('/batch-create', [BatchController::class, 'create'])->name('batch.create');
    Route::post('/batch-create', [BatchController::class, 'store']);
    Route::post('/batch-show-{id}', [BatchController::class, 'show'])->name('batch.view');
    Route::post('/batch-delete-{id}', [BatchController::class, 'delete'])->name('batch.delete');
    Route::post('/batch-edit-{id}', [BatchController::class, 'edit'])->name('batch.edit');
    Route::post('/batch-update-{id}', [BatchController::class, 'update']);
});


Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/course', [CourseController::class, 'index'])->name('course.index');
    Route::get('/course-create', [CourseController::class, 'create'])->name('course.create');
    Route::post('/course-create', [CourseController::class, 'store']);
    Route::post('/course-status-change-{id}', [CourseController::class, 'status_change']);
    Route::post('/course-show-{id}', [CourseController::class, 'show'])->name('course.view');
    Route::post('/course-delete-{id}', [CourseController::class, 'delete'])->name('course.delete');
    Route::get('/course-edit-{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::post('/course-edit-{id}', [CourseController::class, 'update']);
    Route::post('/dynamic-batch-select-{id}', [CourseController::class, 'dynamic_batch_select']);
    
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/students-enrolled-courses', [StudentCourseEnrollmentController::class, 'index'])->name('StudentCourseEnrollment.index');
    Route::get('/student-course-enroll', [StudentCourseEnrollmentController::class, 'enroll'])->name('StudentCourseEnrollment.enroll');
    Route::post('/student-course-enrollment-student-search-{text}', [StudentCourseEnrollmentController::class, 'student_search'])->name('StudentEnrollment.student_search');
    Route::post('/student-course-enrollment-student-detials-show-{text}', [StudentCourseEnrollmentController::class, 'student_detials_show']);
    Route::post('/student-course-enrollment-store', [StudentCourseEnrollmentController::class, 'enroll_store']);
    Route::post('/student-course-enrollment-check-sit-limit-{id}', [StudentCourseEnrollmentController::class, 'check_sit_limit']);
    Route::post('/student-course-enrollment-check-student-is-enrolled-{id}', [StudentCourseEnrollmentController::class, 'check_student_is_enrolled']);
    Route::post('/student-course-enrollment-check-student-course-is-clash-{id}', [StudentCourseEnrollmentController::class, 'check_student_courde_is_clash']);
    Route::post('/student-course-enrollment-check-selected-courses-is-clash', [StudentCourseEnrollmentController::class, 'check_selected_courses_is_clash']);
    Route::post('/student-enrolled-course-status-change-{id}', [StudentCourseEnrollmentController::class, 'status_change']);
    Route::post('/student-enrolled-course-drop-{course_id}', [StudentCourseEnrollmentController::class, 'drop_course']);
    Route::post('/student-enrolled-course-index-filter-{id}', [StudentCourseEnrollmentController::class, 'course_index_filter']);
    Route::get('/student-enrolled-course-edit-{student_id}', [StudentCourseEnrollmentController::class, 'enrolled_course_edit']);
    Route::post('/student-enrollment-course-update', [StudentCourseEnrollmentController::class, 'enroll_course_update']);
       
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/teachers-enrolled-courses', [TeacherCourseEnrollmentController::class, 'index'])->name('TeacherCourseEnrollment.index');
    Route::get('/teacher-course-enroll', [TeacherCourseEnrollmentController::class, 'enroll'])->name('TeacherCourseEnrollment.enroll');
    Route::post('/teacher-course-enrollment-teacher-search-{text}', [TeacherCourseEnrollmentController::class, 'teacher_search'])->name('TeacherCourseEnrollment.teacher_search');
    Route::post('/teacher-course-enrollment-teacher-detials-show-{text}', [TeacherCourseEnrollmentController::class, 'teacher_detials_show']);
    Route::post('/teacher-course-enrollment-store', [TeacherCourseEnrollmentController::class, 'enroll_store']);
    Route::post('/teacher-course-enrollment-check-teacher-course-is-clash-{id}', [TeacherCourseEnrollmentController::class, 'check_teacher_courde_is_clash']);
    Route::post('/teacher-course-enrollment-check-selected-courses-is-clash', [TeacherCourseEnrollmentController::class, 'check_selected_courses_is_clash']);
    Route::post('/teacher-enrolled-course-status-change-{id}', [TeacherCourseEnrollmentController::class, 'status_change']);
    Route::post('/teacher-enrolled-course-drop-{course_id}', [TeacherCourseEnrollmentController::class, 'drop_course']);
    Route::post('/teacher-enrolled-course-index-filter-{id}', [TeacherCourseEnrollmentController::class, 'course_index_filter']);
    Route::get('/teacher-enrolled-course-edit-{teacher_id}', [TeacherCourseEnrollmentController::class, 'enrolled_course_edit']);
    Route::post('/teacher-enrollment-course-update', [TeacherCourseEnrollmentController::class, 'enroll_course_update']);
       
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/students-payment-list', [StudentPaymentController::class, 'index'])->name('StudentsPayment.index');
    Route::get('/student-payment-pay', [StudentPaymentController::class, 'pay'])->name('StudentPayment.pay');
    Route::post('/student-payment-student-course-detials-show-{text}', [StudentPaymentController::class, 'student_course_detials_show']);
    Route::post('/student-payment-store', [StudentPaymentController::class, 'payment_store']);   
    Route::get('/student-payment-view-{student_id}', [StudentPaymentController::class, 'student_payment_view'])->name('StudentPayment.view');
    Route::get('/student-payment-receipt-{id}', [StudentPaymentController::class, 'receipt']); 
    Route::get('/student-payment-{id}', [StudentPaymentController::class, 'edit'])->name('student_payment.edit');
    Route::post('/student-payment-{id}', [StudentPaymentController::class, 'update']);    
    
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/account-daily-expense', [DailyExpenseController::class, 'index'])->name('daily_expense.index');
    Route::get('/account-daily-expense-create', [DailyExpenseController::class, 'create'])->name('daily_expense.create');
    Route::post('/account-daily-expense-create', [DailyExpenseController::class, 'store']);
    Route::post('/account-daily-expense-show-{id}', [DailyExpenseController::class, 'show'])->name('daily_expense.view');
    Route::get('/account-daily-expense-edit-{id}', [DailyExpenseController::class, 'edit'])->name('daily_expense.edit');
    Route::post('/account-daily-expense-edit-{id}', [DailyExpenseController::class, 'update']);
    Route::post('/account-daily-expense-delete-{id}', [DailyExpenseController::class, 'delete'])->name('daily_expense.delete');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/expense_gl_code', [ExpenseGLCodeController::class, 'index'])->name('expense_gl_code.index');
    Route::get('/expense_gl_code-create', [ExpenseGLCodeController::class, 'create'])->name('expense_gl_code.create');
    Route::post('/expense_gl_code-create', [ExpenseGLCodeController::class, 'store']);
    Route::post('/expense_gl_code-show-{id}', [ExpenseGLCodeController::class, 'show'])->name('expense_gl_code.view');
    Route::get('/expense_gl_code-edit-{id}', [ExpenseGLCodeController::class, 'edit'])->name('expense_gl_code.edit');
    Route::post('/expense_gl_code-edit-{id}', [ExpenseGLCodeController::class, 'update']);
// jquery edit
    Route::post('/expense_gl_code-JqueryEdit-{id}', [ExpenseGLCodeController::class, 'jquery_edit']);
    Route::post('/expense_gl_code-JqueryUpdate-{id}', [ExpenseGLCodeController::class, 'jquery_update']);
// jquery edit end
    Route::post('/expense_gl_code-delete-{id}', [ExpenseGLCodeController::class, 'delete'])->name('expense_gl_code.delete');    
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
    Route::get('/expense-create', [ExpenseController::class, 'create'])->name('expense.create');
    Route::post('/expense-create', [ExpenseController::class, 'store']);
    Route::post('/expense-show-{id}', [ExpenseController::class, 'show'])->name('expense.view');
    Route::get('/expense-edit-{id}', [ExpenseController::class, 'edit'])->name('expense.edit');
    Route::post('/expense-edit-{id}', [ExpenseController::class, 'update']);
    Route::post('/expense-money-receipt-delete-{id}', [ExpenseController::class, 'image_delete']);
    Route::post('/expense-delete-{id}', [ExpenseController::class, 'delete'])->name('expense.delete'); 
    Route::post('/expense-index-filter-{id}', [ExpenseController::class, 'expense_index_filter']);   
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/income_gl_code', [IncomeGLCodeController::class, 'index'])->name('income_gl_code.index');
    Route::get('/income_gl_code-create', [IncomeGLCodeController::class, 'create'])->name('income_gl_code.create');
    Route::post('/income_gl_code-create', [IncomeGLCodeController::class, 'store']);
    Route::post('/income_gl_code-show-{id}', [IncomeGLCodeController::class, 'show'])->name('income_gl_code.view');
    Route::get('/income_gl_code-edit-{id}', [IncomeGLCodeController::class, 'edit'])->name('income_gl_code.edit');
    Route::post('/income_gl_code-edit-{id}', [IncomeGLCodeController::class, 'update']);
// jquery edit
    Route::post('/income_gl_code-JqueryEdit-{id}', [IncomeGLCodeController::class, 'jquery_edit']);
    Route::post('/income_gl_code-JqueryUpdate-{id}', [IncomeGLCodeController::class, 'jquery_update']);
// jquery edit end
    Route::post('/income_gl_code-delete-{id}', [IncomeGLCodeController::class, 'delete'])->name('income_gl_code.delete');    
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
    Route::get('/income-create', [IncomeController::class, 'create'])->name('income.create');
    Route::post('/income-create', [IncomeController::class, 'store']);
    Route::post('/income-show-{id}', [IncomeController::class, 'show'])->name('income.view');
    Route::get('/income-edit-{id}', [IncomeController::class, 'edit'])->name('income.edit');
    Route::post('/income-edit-{id}', [IncomeController::class, 'update']);
    Route::post('/income-money-receipt-delete-{id}', [IncomeController::class, 'image_delete']);
    Route::post('/income-delete-{id}', [IncomeController::class, 'delete'])->name('income.delete'); 
    Route::post('/income-index-filter-{id}', [IncomeController::class, 'income_index_filter']);   
});


// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');