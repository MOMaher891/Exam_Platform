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
                    <a href="{{ route('inspector.home') }}" class="waves-effect">
                        <i class="ri-home-2-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>


                
                <li>
                    <a href="{{ route('inspector.exam.index') }}" class="waves-effect">
                        <i class="ri-home-2-line"></i>
                        <span>Exams To Apply</span>
                    </a>
                </li>

                  
                <li>
                    <a href="{{ route('inspector.exam.profile.index') }}" class="waves-effect">
                        <i class="ri-home-2-line"></i>
                        <span>Exams Profile</span>
                    </a>
                </li>


   

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
