<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware'=>'auth'],function(){

	Route::get('/home',[App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home');

	Route::prefix('users')->group(function(){
		Route::get('/view',[App\Http\Controllers\Backend\UserController::class, 'view'])->name('view-user');
		Route::get('/add',[App\Http\Controllers\Backend\UserController::class, 'add'])->name('add-user');
		Route::post('/store',[App\Http\Controllers\Backend\UserController::class, 'store'])->name('store-user');
		Route::get('/edit/{id}',[App\Http\Controllers\Backend\UserController::class, 'edit'])->name('edit-user');
		Route::post('/update/{id}',[App\Http\Controllers\Backend\UserController::class, 'update'])->name('update-user');
		Route::get('/delete/{id}',[App\Http\Controllers\Backend\UserController::class, 'delete'])->name('delete-user');
	});

	Route::prefix('profiles')->group(function(){
		Route::get('/view',[App\Http\Controllers\Backend\ProfileController::class, 'view'])->name('view-profile');
		Route::get('/edit',[App\Http\Controllers\Backend\ProfileController::class, 'edit'])->name('edit-profile');
		Route::post('/store',[App\Http\Controllers\Backend\ProfileController::class, 'update'])->name('update-profile');
		Route::get('/password/view',[App\Http\Controllers\Backend\ProfileController::class, 'password'])->name('view-password');
		Route::post('/password/update',[App\Http\Controllers\Backend\ProfileController::class, 'passwordUpdate'])->name('update-password');
	});

	Route::prefix('products')->group(function(){
		Route::get('/view',[App\Http\Controllers\Backend\ProductController::class, 'view'])->name('view-product');
		Route::get('/add',[App\Http\Controllers\Backend\ProductController::class, 'add'])->name('add-product');
		Route::post('/store',[App\Http\Controllers\Backend\ProductController::class, 'store'])->name('store-product');
		Route::get('/edit/{id}',[App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('edit-product');
		Route::post('/update/{id}',[App\Http\Controllers\Backend\ProductController::class, 'update'])->name('update-product');
		Route::get('/delete/{id}',[App\Http\Controllers\Backend\ProductController::class, 'delete'])->name('delete-product');
	});

	Route::prefix('setups')->group(function(){
		//Student Class
		Route::get('/student/class/view',[App\Http\Controllers\Backend\Setup\StudentClassController::class, 'view'])->name('student-class-view');
		Route::get('/student/class/add',[App\Http\Controllers\Backend\Setup\StudentClassController::class, 'add'])->name('student-class-add');
		Route::post('/student/class/store',[App\Http\Controllers\Backend\Setup\StudentClassController::class, 'store'])->name('student-class-store');
		Route::get('/student/class/edit/{id}',[App\Http\Controllers\Backend\Setup\StudentClassController::class, 'edit'])->name('student-class-edit');
		Route::post('/student/class/update/{id}',[App\Http\Controllers\Backend\Setup\StudentClassController::class, 'update'])->name('student-class-update');
		Route::get('/student/class/delete/{id}',[App\Http\Controllers\Backend\Setup\StudentClassController::class, 'delete'])->name('student-class-delete');
		//Student Year/Session
		Route::get('/student/year/view',[App\Http\Controllers\Backend\Setup\StudentYearController::class, 'view'])->name('student-year-view');
		Route::get('/student/year/add',[App\Http\Controllers\Backend\Setup\StudentYearController::class, 'add'])->name('student-year-add');
		Route::post('/student/year/store',[App\Http\Controllers\Backend\Setup\StudentYearController::class, 'store'])->name('student-year-store');
		Route::get('/student/year/edit/{id}',[App\Http\Controllers\Backend\Setup\StudentYearController::class, 'edit'])->name('student-year-edit');
		Route::post('/student/year/update/{id}',[App\Http\Controllers\Backend\Setup\StudentYearController::class, 'update'])->name('student-year-update');
		//Student Group
		Route::get('/student/group/view',[App\Http\Controllers\Backend\Setup\StudentGroupController::class, 'view'])->name('student-group-view');
		Route::get('/student/group/add',[App\Http\Controllers\Backend\Setup\StudentGroupController::class, 'add'])->name('student-group-add');
		Route::post('/student/group/store',[App\Http\Controllers\Backend\Setup\StudentGroupController::class, 'store'])->name('student-group-store');
		Route::get('/student/group/edit/{id}',[App\Http\Controllers\Backend\Setup\StudentGroupController::class, 'edit'])->name('student-group-edit');
		Route::post('/student/group/update/{id}',[App\Http\Controllers\Backend\Setup\StudentGroupController::class, 'update'])->name('student-group-update');
		//Student Shift
		Route::get('/student/shift/view',[App\Http\Controllers\Backend\Setup\ShiftController::class, 'view'])->name('student-shift-view');
		Route::get('/student/shift/add',[App\Http\Controllers\Backend\Setup\ShiftController::class, 'add'])->name('student-shift-add');
		Route::post('/student/shift/store',[App\Http\Controllers\Backend\Setup\ShiftController::class, 'store'])->name('student-shift-store');
		Route::get('/student/shift/edit/{id}',[App\Http\Controllers\Backend\Setup\ShiftController::class, 'edit'])->name('student-shift-edit');
		Route::post('/student/shift/update/{id}',[App\Http\Controllers\Backend\Setup\ShiftController::class, 'update'])->name('student-shift-update');
		//Student fee category
		Route::get('/student/fee/category/view',[App\Http\Controllers\Backend\Setup\FeeCatController::class, 'view'])->name('fee-category-view');
		Route::get('/student/fee/category/add',[App\Http\Controllers\Backend\Setup\FeeCatController::class, 'add'])->name('fee-category-add');
		Route::post('/student/fee/category/store',[App\Http\Controllers\Backend\Setup\FeeCatController::class, 'store'])->name('fee-category-store');
		Route::get('/student/fee/category/edit/{id}',[App\Http\Controllers\Backend\Setup\FeeCatController::class, 'edit'])->name('fee-category-edit');
		Route::post('/student/fee/category/update/{id}',[App\Http\Controllers\Backend\Setup\FeeCatController::class, 'update'])->name('fee-category-update');
		//Student Fee Category Amount
		Route::get('/student/fee/cat/amount/view',[App\Http\Controllers\Backend\Setup\FeeCatAmountController::class, 'view'])->name('fee-cat-amount-view');
		Route::get('/student/fee/cat/amount/add',[App\Http\Controllers\Backend\Setup\FeeCatAmountController::class, 'add'])->name('fee-cat-amount-add');
		Route::post('/student/fee/cat/amount/store',[App\Http\Controllers\Backend\Setup\FeeCatAmountController::class, 'store'])->name('fee-cat-amount-store');
		Route::get('/student/fee/cat/amount/edit/{fee_category_id}',[App\Http\Controllers\Backend\Setup\FeeCatAmountController::class, 'edit'])->name('edit_fee_amount');
		Route::post('/student/fee/cat/amount/update/{fee_category_id}',[App\Http\Controllers\Backend\Setup\FeeCatAmountController::class, 'update'])->name('fee-cat-amount-update');
		Route::get('/student/fee/cat/amount/details/{fee_category_id}',
		[App\Http\Controllers\Backend\Setup\FeeCatAmountController::class, 'details'])->name('details_fee_amount');
		//Exam Type
		Route::get('/student/exam/type/view',[App\Http\Controllers\Backend\Setup\ExamTypeController::class, 'view'])->name('exam-type-view');
		Route::get('/student/exam/type/add',[App\Http\Controllers\Backend\Setup\ExamTypeController::class, 'add'])->name('exam-type-add');
		Route::post('/student/exam/type/store',[App\Http\Controllers\Backend\Setup\ExamTypeController::class, 'store'])->name('exam-type-store');
		Route::get('/student/exam/type/edit/{id}',[App\Http\Controllers\Backend\Setup\ExamTypeController::class, 'edit'])->name('exam-type-edit');
		Route::post('/student/exam/type/update/{id}',[App\Http\Controllers\Backend\Setup\ExamTypeController::class, 'update'])->name('exam-type-update');
		//Subject 
		Route::get('/student/subject/view',[App\Http\Controllers\Backend\Setup\SubjectController::class, 'view'])->name('view-subject');
		Route::get('/student/subject/add',[App\Http\Controllers\Backend\Setup\SubjectController::class, 'add'])->name('add-subject');
		Route::post('/student/subject/store',[App\Http\Controllers\Backend\Setup\SubjectController::class, 'store'])->name('store-subject');
		Route::get('/student/subject/edit/{id}',[App\Http\Controllers\Backend\Setup\SubjectController::class, 'edit'])->name('edit-subject');
		Route::post('/student/subject/update/{id}',[App\Http\Controllers\Backend\Setup\SubjectController::class, 'update'])->name('update-subject');
		//Assign Subject
		Route::get('/student/assign/subject/view',[App\Http\Controllers\Backend\Setup\AssignSubjectController::class, 'view'])->name('view-assign-subject');
		Route::get('/student/assign/subject/add',[App\Http\Controllers\Backend\Setup\AssignSubjectController::class, 'add'])->name('add-assign-subject');
		Route::post('/student/assign/subject/store',[App\Http\Controllers\Backend\Setup\AssignSubjectController::class, 'store'])->name('store-assign-subject');
		Route::get('/student/assign/subject/edit/{class_id}',[App\Http\Controllers\Backend\Setup\AssignSubjectController::class, 'edit'])->name('edit-assign-subject');
		Route::post('/student/assign/subject/update/{class_id}',[App\Http\Controllers\Backend\Setup\AssignSubjectController::class, 'update'])->name('update-assign-subject');
		Route::get('/student/assign/subject/details/{class_id}',[App\Http\Controllers\Backend\Setup\AssignSubjectController::class, 'details'])->name('details-assign-subject');
		//Designation
		Route::get('/designation/view',[App\Http\Controllers\Backend\Setup\DesignationController::class, 'view'])->name('view-designation');
		Route::get('/designation/add',[App\Http\Controllers\Backend\Setup\DesignationController::class, 'add'])->name('add-designation');
		Route::post('/designation/store',[App\Http\Controllers\Backend\Setup\DesignationController::class, 'store'])->name('store-designation');
		Route::get('/designation/edit/{id}',[App\Http\Controllers\Backend\Setup\DesignationController::class, 'edit'])->name('edit-designation');
		Route::post('/designation/update/{id}',[App\Http\Controllers\Backend\Setup\DesignationController::class, 'update'])->name('update-designation');
	});

	//Student Registration
	Route::prefix('students')->group(function(){
		Route::get('/regi/view',[App\Http\Controllers\Backend\Student\RegiController::class,'view'])->name('view-registration');
		Route::get('/regi/add',[App\Http\Controllers\Backend\Student\RegiController::class,'add'])->name('add-registration');
		Route::post('/regi/store',[App\Http\Controllers\Backend\Student\RegiController::class,'store'])->name('store-registration');
		Route::get('/regi/edit/{student_id}',[App\Http\Controllers\Backend\Student\RegiController::class,'edit'])->name('edit-registration');
		Route::post('/regi/update/{student_id}',[App\Http\Controllers\Backend\Student\RegiController::class,'update'])->name('update-registration');
		Route::get('/regi/delete/{id}',[App\Http\Controllers\Backend\Student\RegiController::class,'delete'])->name('delete-registration');
		Route::get('/year-class-wise',[App\Http\Controllers\Backend\Student\RegiController::class,'studentWiseSearch'])->name('student-year-calss-search');
		Route::get('/class/promotion/{student_id}',[App\Http\Controllers\Backend\Student\RegiController::class,'promotion'])->name('student-regi-promotion');
		Route::post('/class/promotion/{student_id}',[App\Http\Controllers\Backend\Student\RegiController::class,'promotionStore'])->name('student-regi-promotion-store');
		Route::get('/regi/details/{student_id}',[App\Http\Controllers\Backend\Student\RegiController::class,'details'])->name('student-regi-details');

		//Student Roll Generate
		Route::get('roll/view',[App\Http\Controllers\Backend\Student\RollGenerateController::class, 'view'])->name('student-roll-generate-view');
		Route::post('roll/store',[App\Http\Controllers\Backend\Student\RollGenerateController::class, 'store'])->name('student-roll-generate-store');
		Route::get('roll/get-student',[App\Http\Controllers\Backend\Student\RollGenerateController::class, 'getStudent'])->name('student-roll-generate');

		//Student Registration Fee
		Route::get('/registration/fee/view',[App\Http\Controllers\Backend\Student\regiFeeController::class, 'view'])->name('student-regi-fee-view');
		Route::get('registration/get-student',[App\Http\Controllers\Backend\Student\regiFeeController::class, 'getStudent'])->name('regi-fee-get-student');
		Route::get('registration/get/payslip',[App\Http\Controllers\Backend\Student\regiFeeController::class, 'paySlip'])->name('regi-fee-payslip');

		//Student Monthly Fee
		Route::get('/monthly/fee/view',[App\Http\Controllers\Backend\Student\MonthlyFeeController::class, 'view'])->name('monthly-fee-view');
		Route::get('monthly/get-student',[App\Http\Controllers\Backend\Student\MonthlyFeeController::class, 'getStudent'])->name('monthly-fee-get-student');
		Route::get('monthly/get/payslip',[App\Http\Controllers\Backend\Student\MonthlyFeeController::class, 'paySlip'])->name('monthly-fee-payslip');
		
		//Student Exam Fee
		Route::get('/exam/fee/view',[App\Http\Controllers\Backend\Student\ExamFeeController::class, 'view'])->name('exam-fee-view');
		Route::get('exam/get-student',[App\Http\Controllers\Backend\Student\ExamFeeController::class, 'getStudent'])->name('exam-fee-get-student');
		Route::get('exam/get/payslip',[App\Http\Controllers\Backend\Student\ExamFeeController::class, 'paySlip'])->name('exam-fee-payslip');
		
	});

	
	Route::prefix('employees')->group(function(){
		//Registration
		Route::get('/regi/view',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'view'])->name('employee-regi-view');
		Route::get('/regi/create',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'create'])->name('employee-regi-add');
		Route::post('/regi/store',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'store'])->name('employee-regi-store');
		Route::get('/regi/edit/{id}',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'edit'])->name('employee-regi-edit');
		Route::post('/regi/update/{id}',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'update'])->name('employee-regi-update');
		Route::get('/regi/delete/{id}',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'delete'])->name('employee-regi-delete');
		Route::get('/regi/details/{id}',[App\Http\Controllers\Backend\Employees\EmployeeRegiController::class, 'details'])->name('employee-regi-details');

		//Salary
		Route::get('/salary/view',[App\Http\Controllers\Backend\employees\EmployeeSalaryController::class, 'view'])->name('employee-salary-view');
		Route::get('/salary/add',[App\Http\Controllers\Backend\employees\EmployeeSalaryController::class, 'add'])->name('employee-salary-add');
		Route::post('/salary/store/{id}',[App\Http\Controllers\Backend\employees\EmployeeSalaryController::class, 'store'])->name('employee-salary-store');
		Route::get('/salary/increment/{id}',[App\Http\Controllers\Backend\employees\EmployeeSalaryController::class, 'increment'])->name('employee-salary-increment');
		Route::get('/salary/details/{id}',[App\Http\Controllers\Backend\employees\EmployeeSalaryController::class, 'details'])->name('employee-salary-details');

		//Leave
		Route::get('/leave/view',[App\Http\Controllers\Backend\employees\EmployeeLeaveController::class, 'view'])->name('employee-leave-view');
		Route::get('/leave/add',[App\Http\Controllers\Backend\employees\EmployeeLeaveController::class, 'add'])->name('employee-leave-add');
		Route::post('/leave/store',[App\Http\Controllers\Backend\employees\EmployeeLeaveController::class, 'store'])->name('employee-leave-store');
		Route::get('/leave/edit/{id}',[App\Http\Controllers\Backend\employees\EmployeeLeaveController::class, 'edit'])->name('employee-leave-edit');
		Route::post('/leave/update/{id}',[App\Http\Controllers\Backend\employees\EmployeeLeaveController::class, 'update'])->name('employee-leave-update');

		//Attendance
		Route::get('/attend/view',[App\Http\Controllers\Backend\employees\EmployeeAttendanceController::class, 'view'])->name('employee-attend-view');
		Route::get('/attend/add',[App\Http\Controllers\Backend\employees\EmployeeAttendanceController::class, 'add'])->name('employee-attend-add');
		Route::post('/attend/store',[App\Http\Controllers\Backend\employees\EmployeeAttendanceController::class, 'store'])->name('employee-attend-store');
		Route::get('/attend/edit/{id}',[App\Http\Controllers\Backend\employees\EmployeeAttendanceController::class, 'edit'])->name('employee-attend-edit');
		Route::post('/attend/update/{id}',[App\Http\Controllers\Backend\employees\EmployeeAttendanceController::class, 'update'])->name('employee-attend-update');

		//Monthly Salary
		Route::get('/monthly/salary/view',[App\Http\Controllers\Backend\employees\MonthlySalaryConroller::class, 'view'])->name('monthly-salary-view');
		Route::get('/monthly/salary/get',[App\Http\Controllers\Backend\employees\MonthlySalaryConroller::class, 'getSalary'])->name('monthly-salary-get');
		Route::get('/monthly/salary/payslip/{employee_id}',[App\Http\Controllers\Backend\employees\MonthlySalaryConroller::class, 'paySlip'])->name('monthly-salary-payslip');
	});

	Route::prefix('marks')->group(function(){
		Route::get('/add',[App\Http\Controllers\Backend\Marks\MarksController::class, 'add'])->name('marks-add');
		Route::post('/store',[App\Http\Controllers\Backend\Marks\MarksController::class, 'store'])->name('marks-store');
		Route::get('/edit',[App\Http\Controllers\Backend\Marks\MarksController::class, 'edit'])->name('marks-edit');
		Route::get('/get-student-marks',[App\Http\Controllers\Backend\Marks\MarksController::class, 'getStudentMarks'])->name('get-student-marks');
		Route::post('/marks-update',[App\Http\Controllers\Backend\Marks\MarksController::class, 'update'])->name('marks-update');

		//Grade
		Route::get('/grade/view',[App\Http\Controllers\Backend\Marks\GradeController::class, 'view'])->name('marks-grade-view');
		Route::get('/grade/add',[App\Http\Controllers\Backend\Marks\GradeController::class, 'add'])->name('marks-grade-add');
		Route::post('/grade/store',[App\Http\Controllers\Backend\Marks\GradeController::class, 'store'])->name('marks-grade-store');
		Route::get('/grade/edit/{id}',[App\Http\Controllers\Backend\Marks\GradeController::class, 'edit'])->name('marks-grade-edit');
		Route::post('/grade/update/{id}',[App\Http\Controllers\Backend\Marks\GradeController::class, 'update'])->name('marks-grade-update');
	});

	Route::get('/get-student',[App\Http\Controllers\Backend\DefaultController::class, 'getStudent'])->name('get-student');
	Route::get('/get-subject',[App\Http\Controllers\Backend\DefaultController::class, 'getSubject'])->name('get-subject');

	Route::prefix('accounts')->group(function(){
		Route::get('/student/fee/view',[App\Http\Controllers\Backend\Account\StudentFeeController::class, 'view'])->name('student-fee-view');
		Route::get('/student/fee/add',[App\Http\Controllers\Backend\Account\StudentFeeController::class, 'add'])->name('student-fee-add');
		Route::post('/student/fee/store',[App\Http\Controllers\Backend\Account\StudentFeeController::class, 'store'])->name('student-fee-store');
		Route::get('/student/getstudent',[App\Http\Controllers\Backend\Account\StudentFeeController::class, 'getStudent'])->name('accounts-fee-getstudent');

		//Employee Salary
		Route::get('/employee/salary/view',[App\Http\Controllers\Backend\Account\EmploSalaryController::class, 'view'])->name('employee-salary-view');
		Route::get('/employee/salary/add',[App\Http\Controllers\Backend\Account\EmploSalaryController::class, 'add'])->name('employee-salary-add');
		Route::post('/employee/salary/store',[App\Http\Controllers\Backend\Account\EmploSalaryController::class, 'store'])->name('employee-salary-store');
		Route::get('/employee/salary/get',[App\Http\Controllers\Backend\Account\EmploSalaryController::class, 'getEmployee'])->name('employee-salary-get');

		//Others Cost
		Route::get('/cost/view',[App\Http\Controllers\Backend\Account\OthersCostController::class, 'view'])->name('others-cost-view');
		Route::get('/cost/add',[App\Http\Controllers\Backend\Account\OthersCostController::class, 'add'])->name('others-cost-add');
		Route::post('/cost/store',[App\Http\Controllers\Backend\Account\OthersCostController::class, 'store'])->name('others-cost-store');
		Route::get('/cost/edit/{id}',[App\Http\Controllers\Backend\Account\OthersCostController::class, 'edit'])->name('others-cost-edit');
		Route::post('/cost/update/{id}',[App\Http\Controllers\Backend\Account\OthersCostController::class, 'update'])->name('others-cost-update');
	});

	Route::prefix('report')->group(function(){
			//Profit
			Route::get('/profit/view',[App\Http\Controllers\Backend\Report\ProfitController::class, 'view'])->name('monthly-profit-view');
			Route::get('/profit/get',[App\Http\Controllers\Backend\Report\ProfitController::class, 'profit'])->name('monthly-profit-get');
			Route::get('/profit/pdf',[App\Http\Controllers\Backend\Report\ProfitController::class, 'pdf'])->name('report-profit-pdf');

			//Marksheet Ganarator
			Route::get('/student/marksheet/ganarator/view',[App\Http\Controllers\Backend\Report\ProfitController::class, 'studentMarkSheetView'])->name('student-marksheet-generator-view');
			Route::post('/student/marksheet/ganarator/get',[App\Http\Controllers\Backend\Report\ProfitController::class, 'marksheetGet'])->name('student-marksheet-generator-get');
	
			//Attendance Report
			Route::get('/attendance/report/view',[App\Http\Controllers\Backend\Report\ProfitController::class, 'attendanceReport'])->name('attendance-report-view');
			Route::get('/attendance/report/get',[App\Http\Controllers\Backend\Report\ProfitController::class, 'attendanceGet'])->name('attendance-report-get');

			//Student Result
			Route::get('/student/result/view',[App\Http\Controllers\Backend\Report\ProfitController::class, 'resultView'])->name('student-result-view');
			Route::get('/student/result/get',[App\Http\Controllers\Backend\Report\ProfitController::class, 'resultGet'])->name('student-result-get');

			//Student ID Card
			Route::get('/student/idcard/view',[App\Http\Controllers\Backend\Report\ProfitController::class, 'idcardView'])->name('student-idcard-view');
			Route::get('/student/idcard/get',[App\Http\Controllers\Backend\Report\ProfitController::class, 'idcardGet'])->name('student-idcard-get');
		});

});
