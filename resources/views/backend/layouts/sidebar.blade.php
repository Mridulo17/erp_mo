<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar position-relative">
	  	<div class="multinav">
		  <div class="multinav-scroll" style="height: 100%;">
			  <!-- sidebar menu-->
			  <ul class="sidebar-menu" data-widget="tree">
				<li>
				  <a href="{{route('dashboard')}}">
					<i class="fas fa-house-user"><span class="path1"></span><span class="path2"></span></i>
					<span>Dashboard</span>
					<span class="pull-right-container"></span>
				  </a>
				</li>

					<li class="treeview {{ request()->routeIs('admin.candidates.*') ? 'active menu-open' : '' }}">
						<a href="#">
							<i class="fas fa-user-cog"><span class="path1"></span><span class="path2"></span></i>
							<span>Peoples</span>
							<span class="pull-right-container">
								<i class="fa fa-angle-right pull-right"></i>
							</span>
						</a>
						<ul class="treeview-menu" style="{{ request()->routeIs('admin.candidates.*') ? 'display: block;' : '' }}">
							<li class="treeview {{ request()->routeIs('admin.candidates.*') ? 'active menu-open' : '' }}">
								<a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									Candidates
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu" style="{{ request()->routeIs('admin.candidates.*') ? 'display: block;' : '' }}">
									<li class="{{ request()->routeIs('admin.candidates.create') ? 'active' : '' }}">
										<a href="{{ route('admin.candidates.create') }}">
											<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
											New Candidates
										</a>
									</li>
									<li class="{{ request()->routeIs('admin.candidates.index') ? 'active' : '' }}">
										<a href="{{ route('admin.candidates.index') }}">
											<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
											Candidate List
										</a>
									</li>
								</ul>
							</li>

							<li><a href="{{route('admin.agents.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agents</a></li>
							<li class="{{ request()->routeIs('admin.investors.index') ? 'active menu-open' : '' }}">
								<a href="{{ route('admin.investors.index') }}">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
									Investors
								</a>
							</li>
							<li class="treeview">
								<a href="#">
									<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates
									<span class="pull-right-container">
										<i class="fa fa-angle-right pull-right"></i>
									</span>
								</a>
								<ul class="treeview-menu">
									<li><a href="{{route('admin.delegates.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Manage Delegates</a></li>
									<li><a href="{{route('admin.delegateOffice.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Office</a></li>
								</ul>
							</li>
						</ul>
					</li>

				<li class="treeview">
					<a href="#">
					  <i class="fas fa-store"><span class="path1"></span><span class="path2"></span></i>
					  <span>Enquiry</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						{{-- <li class="treeview {{ request()->routeIs('admin.phone-calls.*') ? 'active menu-open' : '' }}">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
								Phone Calls
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu" style="{{ request()->routeIs('admin.candidates.*') ? 'display: block;' : '' }}">

							</ul>
						</li> --}}
						<li class="{{ request()->routeIs('admin.phone-calls.index') ? 'active menu-open' : '' }}">
							<a href="{{ route('admin.phone-calls.index') }}">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
								Phone Calls
							</a>
						</li>
						<li class="{{ request()->routeIs('admin.visitor-books.index') ? 'active menu-open' : '' }}">
							<a href="{{ route('admin.visitor-books.index') }}">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
								Visitor Book
							</a>
						</li>
						<li class="{{ request()->routeIs('admin.interviewed-candidates.index') ? 'active menu-open' : '' }}">
							<a href="{{ route('admin.interviewed-candidates.index') }}">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
								Inv: Candidates
							</a>
						</li>
					</ul>
				</li>

                  @php
                      $payRollRoutes = [
                          'supper_admin.expense-categories.*',
                          'supper_admin.expense-items.*',
                          'supper_admin.expenses.*',
                          'supper_admin.salary-generate.*',
                          'supper_admin.performance-bonuses.*',
                          'supper_admin.inc-and-deces.*',
                          'supper_admin.advance-salaries.*',
                          'supper_admin.traveling-and-darenesses.*',
                          'supper_admin.hold-or-allowances.*',
                          'supper_admin.mobile-allowances.*',
                          'supper_admin.festival-bonuses.*',
                      ];
                  @endphp
                  <li class="treeview {{ Request::routeIs(...$payRollRoutes) ? 'active' : '' }}">
                      <a href="#">
                          <i class="fa-solid fa fa-balance-scale"><span class="path1"></span><span class="path2"></span></i>
                          <span>Payroll</span>
                          <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
                      </a>
                      <ul class="treeview-menu" @if (Request::routeIs(...$payRollRoutes)) style="display: block;" @endif>

                          @php
                              $expenseRoutes = [
                                  'supper_admin.expense-categories.*',
                                  'supper_admin.expense-items.*',
                                  'supper_admin.expenses.*'
                              ];
                          @endphp

                          <li class="treeview {{ Request::routeIs(...$expenseRoutes) ? 'active' : '' }}">
                              <a href="">
                                  <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>
                                  <span>Expense</span>
                                  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
                                  <ul class="treeview-menu" @if (Request::routeIs(...$expenseRoutes)) style="display: block;" @endif>
                                      <li class="{{ Request::routeIs('supper_admin.expense-categories.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.expense-categories.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Expense Category</a></li>
                                      <li class="{{ Request::routeIs('supper_admin.expense-items.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.expense-items.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Expense Item</a></li>
                                      <li class="{{ Request::routeIs('supper_admin.expenses.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.expenses.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Expense</a></li>
                                  </ul>
                              </a></li>
                          <li class="{{ Request::routeIs('supper_admin.salary-generate.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.salary-generate.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Salary Generate</a></li>
                          <li class="{{ Request::routeIs('supper_admin.performance-bonuses.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.performance-bonuses.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Performance Bonus</a></li>
                          <li class="{{ Request::routeIs('supper_admin.inc-and-deces.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.inc-and-deces.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Inc & Dec</a></li>
                          <li class="{{ Request::routeIs('supper_admin.advance-salaries.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.advance-salaries.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advance Salary</a></li>
                          <li class="{{ Request::routeIs('supper_admin.traveling-and-darenesses.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.traveling-and-darenesses.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>TA - DA</a></li>
                          <li class="{{ Request::routeIs('supper_admin.hold-or-allowances.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.hold-or-allowances.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Hold / Allowance</a></li>
                          <li class="{{ Request::routeIs('supper_admin.mobile-allowances.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.mobile-allowances.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mobile Allowance</a></li>
                          <li class="{{ Request::routeIs('supper_admin.festival-bonuses.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.festival-bonuses.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Festival Bonus</a></li>
                      </ul>
                  </li>

                  @php
                      $attendanceAndLeaveRoutes = [
                          'supper_admin.attendances.*',
                          'supper_admin.leaves.*',
                          'supper_admin.roastings.*',
                          'supper_admin.weekends.*',
                      ];
                  @endphp
                  <li class="treeview {{ Request::routeIs(...$attendanceAndLeaveRoutes) ? 'active' : '' }}">
                      <a href="#">
                          <i class="fa fa-history"><span class="path1"></span><span class="path2"></span></i>
                          <span>Atte: & Leave</span>
                          <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
                      </a>
                      <ul class="treeview-menu" @if (Request::routeIs(...$attendanceAndLeaveRoutes)) style="display: block;" @endif>

                          <li class="{{ Request::routeIs('supper_admin.attendances.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.attendances.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Attendance</a></li>
                          <li class="{{ Request::routeIs('supper_admin.leaves.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.leaves.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Leave</a></li>
                          <li class="{{ Request::routeIs('supper_admin.roastings.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.roastings.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assign Roasting</a></li>
                          <li class="{{ Request::routeIs('supper_admin.weekends.*') ? 'active' : '' }}"><a href="{{ route('supper_admin.weekends.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Setup Weekend</a></li>
                      </ul>
                  </li>

				<li class="treeview">
					<a href="#">
					  <i class="fa-solid fa-users"><span class="path1"></span><span class="path2"></span></i>
					  <span>Reports</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li><a href=""><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Customer</a></li>
						<li><a href=""><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Customer List</a></li>
					</ul>
				</li>
                  @php
                      $ticketRoutes = [
                          'admin.tickets.*',
                          'admin.assign-tickets.*',
                      ];
                  @endphp
                  <li class="treeview {{ Request::routeIs(...$ticketRoutes) ? 'active' : '' }}">
                      <a href="#">
                          <i class="fa fa-ticket"><span class="path1"></span><span class="path2"></span></i>
                          <span>Ticket</span>
                          <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
                      </a>
                      <ul class="treeview-menu" @if (Request::routeIs(...$ticketRoutes)) style="display: block;" @endif>
                          <li class="{{ Request::routeIs('admin.tickets.*') ? 'active' : '' }}"><a href="{{ route('admin.tickets.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Buy Ticket</a></li>
                          <li class="{{ Request::routeIs('admin.assign-tickets.*') ? 'active' : '' }}"><a href="{{ route('admin.assign-tickets.index') }}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assign Ticket</a></li>
                      </ul>
                  </li>

				{{-- <li class="treeview">
					<a href="#">
					  <i class="fas fa-pills"><span class="path1"></span><span class="path2"></span></i>
					  <span>Investor</span>
					</a>
				</li> --}}
				<li class="treeview">
					<a href="#">
					  <i class="fas fa-pills"><span class="path1"></span><span class="path2"></span></i>
					  <span>Processing Setup</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li><a href="{{route('admin.candidateTypes.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Type</a></li>
						<li><a href="{{route('admin.candidate-dynamic-forms.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Dynamic Form</a></li>
						<li><a href="{{route('admin.processCategory.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Process Category</a></li>
						<li><a href="{{route('admin.jobCategory.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Job Category</a></li>
						<li><a href="{{route('admin.jobLists.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Job List</a></li>
						<li><a href="{{route('admin.processSteps.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Process Step</a></li>
						<li><a href="{{route('admin.airlineOffices.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Airlines Office</a></li>


						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agency & Processing office
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="{{route('admin.processOffices.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Office</a></li>
								<li><a href="{{route('admin.asignjobtoOffice.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Asign Job To Office</a></li>
							</ul>
						</li>
						{{-- <li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Air Lines Office
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href=""><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Office</a></li>
								<li><a href=""><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Asign Job To Office</a></li>
							</ul>
						</li> --}}

					</ul>
				</li>

				<li>
					<a href="{{url('/')}}">
					  <i class="fas fa-shopping-cart"><span class="path1"></span><span class="path2"></span></i>
					  <span>Purchases</span>
					</a>
				</li>
				<li class="treeview">
					<a href="#">
					  <i class="fas fa-file-invoice"><span class="path1"></span><span class="path2"></span></i>
					  <span>HRM</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li>
							<a href="{{route('admin.employees.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Employees</a>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Payroll
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Add Expense</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Salary Generate</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Performance Bonous</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Inc & Dec</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advance Salary</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>TA - DA</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Hold/Allowance</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Att: & Leave
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Print
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>HRM Report
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Communication
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Social Media
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Badges</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
					  <i class="fas fa-file-invoice"><span class="path1"></span><span class="path2"></span></i>
					  <span>Accounts</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Manage Account
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>New Account</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Chart Of Accounts</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Total Amount</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Manage Balance
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>New Transection</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>New Transfer</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>New Adjustment</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Account Report
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li class="treeview">
							<a href="#">
								<i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Advance Report
								<span class="pull-right-container">
									<i class="fa fa-angle-right pull-right"></i>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="box_cards.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Agent Book</a></li>
								<li><a href="box_advanced.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Delegates Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Sponsor Book</a></li>
								<li><a href="box_basic.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Candidate Book</a></li>
							</ul>
						</li>
						<li><a href="ui_badges.html"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Badges</a></li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#">
					  <i class="fas fa-chart-line"><span class="path1"></span><span class="path2"></span></i>
					  <span>My Office</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li><a href="{{route('admin.branches.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Branch</a></li>
						<li><a href="{{route('admin.departments.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Department</a></li>
						<li><a href="{{route('admin.designations.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Designation</a></li>
						<li><a href="{{route('admin.roles.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Role</a></li>
						<li><a href="{{route('admin.rosters.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Roster</a></li>
						<li><a href="{{route('admin.holidays.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Holiday</a></li>
						<li><a href=""><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Expence Category</a></li>
						<li><a href=""><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Expence Item</a></li>
					</ul>
				</li>

				<li class="treeview">
					<a href="#">
					  <i class="fas fa-chart-line"><span class="path1"></span><span class="path2"></span></i>
					  <span>Access Permission</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li><a href="{{route('admin.permissions.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Permision Button</a></li>
						<li><a href="{{route('admin.permissions.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Assign Permision</a></li>
					</ul>
				</li>
				<li class="treeview">
					<a href="#">
					  <i class="fas fa-chart-line"><span class="path1"></span><span class="path2"></span></i>
					  <span>Advance Features</span>
					  <span class="pull-right-container">
						<i class="fa fa-angle-right pull-right"></i>
					  </span>
					</a>
					<ul class="treeview-menu">
						<li><a href="{{route('admin.hotspots.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Hotspot User</a></li>
						<li><a href="{{route('admin.mac-address.index')}}"><i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Mac Address</a></li>
					</ul>
				</li>

				<li>
					<a href="#">
					  <i class="far fa-bell"><span class="path1"></span><span class="path2"></span></i>
					  <span>Notifications</span>
					</a>
				</li>

				<li>
					<a href="#">
					  <i class="fas fa-sign-out-alt"><span class="path1"></span><span class="path2"></span></i>
					  <span>Logout</span>
					</a>
				</li>
			  </ul>
		  </div>
		</div>
    </section>
  </aside>
