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
                <h4 class="font-size-16 mb-1">
                    @if (Auth::guard()->user()->hasRole('admin'))
                    @php
                        $center = App\Models\Center::select('name')->where('user_id', Auth::guard()->user()->id)->first();
                    @endphp
                    {{ $center->name }}
                    @else
                        {{ Auth::guard()->user()->name }}
                    @endif
                </h4>
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
                            <span>Invigilator</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.inspector.index') }}">Invigilator List</a></li>
                            @if (auth()->user()->hasRole('admin'))
                            <li><a href="{{ route('admin.inspector.inspector_center') }}">Invigilator in center</a></li>
                            @endif
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
                                class="badge rounded-pill bg-success float-end">{{ App\Models\Center::count() }}</span>
                            <i class="ri-user-3-line"></i>
                            <span>Centers</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('admin.center.index') }}">Center List</a></li>
                            @if(auth()->user()->hasPermission('add_center'))
                            <li><a href="{{ route('admin.center.create') }}">Add Center</a></li>
                            @endif
                        </ul>
                    </li>
                @endif



                @if (auth()->user()->hasPermission('show_exam'))
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <span
                            class="badge rounded-pill bg-success float-end">{{ App\Models\Exam::count() }}</span>
                        <i class="ri-layout-3-line"></i>
                        <span>Quizes</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('admin.exam.index') }}">Quiz List</a></li>

                        @if (auth()->user()->hasPermission('add_exam'))
                        <li><a href="{{ route('admin.exam.create') }}">Add quiz</a></li>
                        @endif
                    </ul>
                </li>
                @endif



                @if ( auth()->user()->hasRole('admin'))
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
