<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink"
                role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="avatar avatar-sm mt-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 h-[400px]">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" style="background-color: white !important;" aria-labelledby="navbarDropdownMenuLink">
                <form action="{{ route('logout') }}" method="POST" class="mt-2 pt-2 border-t dropdown-item">
                    @csrf
                    <button type="submit" class="w-100" style="border: none;background: white;">
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </li>
    </ul>
</nav>
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ route('admin.dashboard') }}">
                <div class="avatar avatar-md">
                    <img src="{{ asset('images/admin_logo.png') }}" alt="" srcset="">
                </div>
            </a>
        </div>



        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100" @if (route('admin.dashboard') == url()->current()) active @endif>
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">Dashboard</span>
                </a>
            </li>
            </li>
            <li class="nav-item w-100" @if (route('admin.category.index') == url()->current()) active @endif>
                <a class="nav-link" href="{{ route('admin.category.index') }}">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Categories</span>
                </a>
            </li>
            <li class="nav-item w-100" @if (route('admin.size.index') == url()->current()) active @endif>
                <a class="nav-link" href="{{ route('admin.size.index') }}">
                    <i class="fe fe-layers  fe-16"></i>
                    <span class="ml-3 item-text">Sizes</span>
                </a>
            </li>
            <li class="nav-item w-100" @if (route('admin.color.index') == url()->current()) active @endif>
                <a class="nav-link" href="{{ route('admin.color.index') }}">
                    <i class="fe fe-sun  fe-16"></i>
                    <span class="ml-3 item-text">Color</span>
                </a>
            </li>
            <li class="nav-item w-100" @if (route('admin.product.index') == url()->current()) active @endif>
                <a class="nav-link" href="{{ route('admin.product.index') }}">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">Products</span>
                </a>
            </li>

            <li class="nav-item w-100" @if (route('admin.order.index') == url()->current()) active @endif>
                <a class="nav-link" href="{{ route('admin.order.index') }}">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">Orders</span>
                </a>
            </li>

            {{--            <li class="nav-item w-100" @if (route('organization.index') == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('organization.index')}}"> --}}
            {{--                    <i class="fe fe-briefcase fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Organization</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}
            {{--            <li class="nav-item w-100" @if (route('member.index') == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('member.index')}}"> --}}
            {{--                    <i class="fe fe-users fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Member</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}
            {{--            <li class="nav-item w-100" @if (route('contact.index') == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('contact.index')}}"> --}}
            {{--                    <i class="fe fe-phone fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Contact</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}


            {{--            <li class="nav-item w-100" @if (route('category.index') == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('category.index')}}"> --}}
            {{--                    <i class="fe fe-grid fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Category</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}

            {{--            <li class="nav-item w-100" @if (route('dataset.index') == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('dataset.index')}}"> --}}
            {{--                    <i class="fe fe-file-text fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Dataset</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}

            {{--            <li class="nav-item w-100" @if (route('settings.index') == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('settings.index')}}"> --}}
            {{--                    <i class="fe fe-settings fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Settings</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}


            {{--            <li class="nav-item w-100" @if (route('chart', ['lang' => 'nepali']) == url()->current()) active @endif> --}}
            {{--                <a class="nav-link" href="{{route('chart',['lang'=>'nepali'])}}"> --}}
            {{--                    <i class="fe fe-settings fe-16"></i> --}}
            {{--                    <span class="ml-3 item-text">Chart</span> --}}
            {{--                </a> --}}
            {{--            </li> --}}

        </ul>

    </nav>
</aside>
