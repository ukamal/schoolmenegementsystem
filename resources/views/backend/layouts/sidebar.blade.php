  @php
      $prefix = Request::route()->getPrefix();
      $route = Route::current()->getName();
  @endphp
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('public/backend/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">weDevs Soft</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{(!empty(Auth::user()->image))?url('/public/upload/backend_imgs/'.Auth::user()->image):url('/public/upload/no_image.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
          </li>

          @if(Auth::user()->role=='admin')
          <li class="nav-item {{($prefix=='/users')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage User
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-user')}}" class="nav-link {{($route=='view-user')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
            </ul>
          </li>
          @endif

          <li class="nav-item {{($prefix=='/profiles')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Profile
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">2</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-profile')}}" class="nav-link {{($route=='view-profile')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Profile</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-password')}}" class="nav-link {{($route=='view-password')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            </ul>
          </li>

           <li class="nav-item {{($prefix=='/products')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Product
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-product')}}" class="nav-link {{($route=='view-product')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Product</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/setups')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Setup Management
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">10</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-class-view')}}" class="nav-link {{($route=='student-class-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Class</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-year-view')}}" class="nav-link {{($route=='student-year-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Year/Session</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-group-view')}}" class="nav-link {{($route=='student-group-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Group</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-shift-view')}}" class="nav-link {{($route=='student-shift-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Shift</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('fee-category-view')}}" class="nav-link {{($route=='fee-category-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fee Category</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('fee-cat-amount-view')}}" class="nav-link {{($route=='fee-cat-amount-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Fee Amount Category</p>
              </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('exam-type-view')}}" class="nav-link {{($route=='exam-type-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Type</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-subject')}}" class="nav-link {{($route=='view-subject')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subject View</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-assign-subject')}}" class="nav-link {{($route=='view-assign-subject')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Assign Subject</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-designation')}}" class="nav-link {{($route=='view-designation')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Designation</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/students')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Students
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('view-registration')}}" class="nav-link {{($route=='view-registration')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Registration</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('student-roll-generate-view')}}" class="nav-link {{($route=='student-roll-generate-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Roll Generate</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('student-regi-fee-view')}}" class="nav-link {{($route=='student-regi-fee-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Registration Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('monthly-fee-view')}}" class="nav-link {{($route=='monthly-fee-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Monthly Fee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('exam-fee-view')}}" class="nav-link {{($route=='exam-fee-view')?'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Exam Fee</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/employees')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Manage Employees
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">5</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee-regi-view')}}" class="nav-link {{($route=='employee-regi-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Registration</p>
              </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee-salary-view')}}" class="nav-link {{($route=='employee-salary-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Salary</p>
              </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee-leave-view')}}" class="nav-link {{($route=='employee-leave-view')? 'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Leave</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('employee-attend-view')}}" class="nav-link {{($route=='employee-attend-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Employee Attendance</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('monthly-salary-view')}}" class="nav-link {{($route=='monthly-salary-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Monthly Salary</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/marks')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Marks Management
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('marks-add')}}" class="nav-link {{($route=='marks-add')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Marks Entry</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('marks-edit')}}" class="nav-link {{($route=='marks-edit')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Marks Edit</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('marks-grade-view')}}" class="nav-link {{($route=='marks-grade-view')? 'active':''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marks Grade</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{($prefix=='/accounts')?'menu-open':''}}">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>Accounts Management</p>
            <i class="fas fa-angle-left right"></i>
            <span class="badge badge-info right">1</span>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('student-fee-view')}}" class="nav-link {{($route=='student-fee-view')?'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Students Fee</p>
            </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('employee-salary-view')}}" class="nav-link {{($route=='employee-salary-view')? 'active':''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Employee Salary</p>
            </a>
            </li>
          </ul>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('others-cost-view')}}" class="nav-link {{($route=='others-cost-view')? 'active' : ''}}">
              <i class="far fa-circle nav-icon"></i>
              <p>Other's Cost</p>
              </a>
            </li>
          </ul>
          </li>

          <li class="nav-item {{($prefix=='/report')?'menu-open':''}}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>Reports Management</p>
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">1</span>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('monthly-profit-view')}}" class="nav-link {{($route=='monthly-profit-view')?'active':''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Monthly/Yearly Profit</p>
              </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-marksheet-generator-view')}}" class="nav-link {{($route=='student-marksheet-generator-view')? 'active': ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Marksheet Generator</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('attendance-report-view')}}" class="nav-link {{($route=='attendance-report-view')? 'active': ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Attendance Report</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-result-view')}}" class="nav-link {{($route=='student-result-view')? 'active': ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student Result</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('student-idcard-view')}}" class="nav-link {{($route=='student-idcard-view')? 'active': ''}}">
                <i class="far fa-circle nav-icon"></i>
                <p>Student ID Card</p>
                </a>
              </li>
            </ul>

            </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>