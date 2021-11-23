<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="m-auto brand-link">
        <img src="{{asset('logo.png')}}" alt="chiminya logo" class=" elevation-3"
             style="opacity: .8;width: 108px">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info align-items-center">
                <a href="#" class="d-block">
                    {{strtoupper(\Illuminate\Support\Facades\Auth::user()->name)}}
                </a>

            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item @yield('dashboard-open')">
                    <a href="/admin/dashboard" class="nav-link @yield('dashboard')">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{--CLIENTS--}}
                @can('list', 'client')
                <li class="nav-item has-treeview @yield('clients-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Clients
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('list', 'client')
                            <li class="nav-item">
                                <a href="/admin/client/" class="nav-link @yield('list-clients')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Clients</p>
                                </a>
                            </li>
                        @endcan
                        @can('create', 'client')
                            <li class="nav-item">
                                <a href="/admin/client/create" class="nav-link @yield('create-clients')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add New</p>
                                </a>
                            </li>
                        @endcan

                    </ul>
                </li>
                @endcan

                {{--invoices--}}
                @can('list', 'invoice')
                <li class="nav-item has-treeview @yield('invoice-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fas fa-file-invoice-dollar"></i>
                        <p>
                            Invoices
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('list', 'invoice')
                            <li class="nav-item">
                                <a href="/admin/invoice" class="nav-link @yield('list-invoice')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Invoices</p>
                                </a>
                            </li>
                        @endcan
                            @can('create', 'invoice')
                        <li class="nav-item">
                            <a href="/admin/invoice/create" class="nav-link @yield('create-invoice')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                            @endcan
                    </ul>
                </li>
                @endcan

                {{--Quotations--}}
                @can('list', 'quotation')
                <li class="nav-item has-treeview @yield('quotation-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-receipt"></i>
                        <p>
                            Quotations
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                     @can('list', 'quotation')
                            <li class="nav-item">
                                <a href="/admin/quotation" class="nav-link @yield('list-quotation')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Quotations</p>
                                </a>
                            </li>
                        @endcan
                       @can('create', 'quotation')
                             <li class="nav-item">
                                 <a href="/admin/quotation/create" class="nav-link @yield('create-quotation')">
                                     <i class="far fa-circle nav-icon"></i>
                                     <p>Add New</p>
                                 </a>
                             </li>
                         @endcan

                    </ul>
                </li>
                @endcan

                {{--Expenses--}}
                @can('list', 'expense')
                <li class="nav-item has-treeview @yield('expense-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-hand-holding-usd"></i>
                        <p>
                            Expenses
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       @can('list', 'expense')
                            <li class="nav-item">
                                <a href="/admin/expense" class="nav-link @yield('list-expense')">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Expenses</p>
                                </a>
                            </li>
                        @endcan
                           @can('create', 'expense')
                        <li class="nav-item">
                            <a href="/admin/expense/create" class="nav-link @yield('create-expense')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                           @endcan

                    </ul>
                </li>
                @endcan

                {{--Email templates--}}
                @can('list', 'email_template')
                <li class="nav-item has-treeview @yield('etemplate-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Email Template
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('list', 'email_template')
                        <li class="nav-item">
                            <a href="/admin/etemplate" class="nav-link @yield('list-etemplate')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Templates</p>
                            </a>
                        </li>
                        @endcan
                            @can('create', 'email_template')
                        <li class="nav-item">
                            <a href="/admin/etemplate/create" class="nav-link @yield('create-etemplate')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                            @endcan

                    </ul>
                </li>
                @endcan

                {{--Users--}}
                @can('list', 'user')
                <li class="nav-item has-treeview @yield('users-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('list', 'user')
                        <li class="nav-item">
                            <a href="/admin/user/" class="nav-link @yield('list-user')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        @endcan
                            @can('create', 'user')
                        <li class="nav-item">
                            <a href="/admin/user/create" class="nav-link @yield('create-user')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New</p>
                            </a>
                        </li>
                            @endcan
                            @can('list', 'role')
                        <li class="nav-item">
                            <a href="{{route('admin.role.index')}}" class="nav-link @yield('roles')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                            @endcan
                            @can('list', 'permission')
                        <li class="nav-item">
                            <a href="{{route('admin.permission.index')}}" class="nav-link @yield('permissions')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permissions</p>
                            </a>
                        </li>
                            @endcan

                    </ul>
                </li>
                @endcan

                {{--Settings--}}
                @can('update', 'setting')
                <li class="nav-item has-treeview @yield('settings-show')">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/settings/smtp" class="nav-link @yield('smtp-settings')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SMTP Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/settings/email" class="nav-link @yield('email-settings')">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Settings</p>
                            </a>
                        </li>

                    </ul>
                </li>
                @endcan

                <li class="nav-item">
                    <a href="/admin/profile" class="nav-link @yield('update-profile')">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
