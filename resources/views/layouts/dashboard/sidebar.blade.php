<style>
    .badge {
        position: absolute !important;
        right: 45px !important;
    }
</style>
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('assets/images/users/person.jpg') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::guard()->user()->name }}</h4>
                <span class="text-muted"><i class="ri-record-circle-line align-middle font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('admin') }}" class="waves-effect">
                        <i class="ri-home-2-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                @if (auth()->user()->hasPermission('show_roles'))
                    <li>
                        <a href="{{ route('role.index') }}" class=" waves-effect">
                            @if (App\Models\Role::count() != 0)
                                <span
                                    class="badge rounded-pill bg-success float-end">{{ App\Models\Role::count() }}</span>
                            @endif
                            <i class="ri-calendar-2-line"></i>
                            <span>Roles</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('show_staff'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            @if (App\Models\User::count() - 1 != 0)
                                <span
                                    class="badge rounded-pill bg-success float-end">{{ App\Models\User::count() - 1 }}</span>
                            @endif

                            <i class="ri-user-3-line"></i>
                            <span>Staff</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.staff.index') }}">Staff List</a></li>
                            <li><a href="{{ route('admin.staff.create') }}">Add Staff</a></li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasPermission('show_inspector'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            @if (App\Models\Observe::count() != 0)
                                <span
                                    class="badge rounded-pill bg-success float-end">{{ App\Models\Observe::count() }}</span>
                            @endif

                            <i class="ri-user-3-line"></i>
                            <span>Inspector</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.inspector.index') }}">Inspector List</a></li>
                            <li><a href="{{ route('admin.inspector.create') }}">Add inspector</a></li>
                        </ul>
                    </li>
                @endif
                @if (auth()->user()->hasRole('admin'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">

                            <i class="ri-layout-3-line"></i>
                            <span>Exams</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.inspector.exams') }}">Exams List</a></li>
                        </ul>
                    </li>
                @endif

                @if (auth()->user()->hasPermission('show_center'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <span
                                class="badge rounded-pill bg-success float-end">{{ App\Models\User::count() - 1 }}</span>
                            <i class="ri-user-3-line"></i>
                            <span>Centers</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.center.index') }}">Center List</a></li>
                            <li><a href="{{ route('admin.center.create') }}">Add Center</a></li>
                        </ul>
                    </li>
                @endif



                @if (auth()->user()->hasPermission('show_staff'))
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">

                            <i class="ri-layout-3-line"></i>
                            <span>Quiz & Categories</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="true">
                            <li>
                                @if (App\Models\Exam::count() != 0)
                                    <span
                                        class="badge rounded-pill bg-success float-end">{{ App\Models\Exam::count() }}</span>
                                @endif
                                <a href="javascript: void(0);" class="has-arrow">Quiz</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('admin.exam.index') }}">Quiz List</a></li>
                                    <li><a href="{{ route('admin.exam.create') }}">Add Quiz</a></li>
                                </ul>
                            </li>
                            <li>
                                @if (App\Models\Category::count() != 0)
                                    <span
                                        class="badge rounded-pill bg-success float-end">{{ App\Models\Category::count() }}</span>
                                @endif
                                <a href="javascript: void(0);" class="has-arrow">Categories</a>
                                <ul class="sub-menu" aria-expanded="true">
                                    <li><a href="{{ route('admin.category.index') }}">Category List</a></li>
                                    <li><a href="{{ route('admin.category.create') }}">Add Category</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif



                @if ( auth()->user()->hasRole('admin') )
                    <li>
                        <a href="{{ route('admin.exam_times.index') }}" class=" waves-effect">
                            {{-- @if (App\Models\Role::count() != 0)
                                <span
                                    class="badge rounded-pill bg-success float-end">{{ App\Models\Role::count() }}</span>
                            @endif --}}
                            <i class="ri-calendar-2-line"></i>
                            <span>Exam to Apply</span>
                        </a>
                    </li>
                @endif


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
