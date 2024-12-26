<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color" style="height: 1000px">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="/"><img src="{{asset('assets/img/logo_edit.png')}}" width="60" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">

            <!-- Users Section -->
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link">
                    <img src="{{asset('users.png')}}" alt="" width="20px" height="30px" style="margin: 0 10px 0 10px">
                    <span>{{trans('dashboard.Users')}}</span>
                </a>
                <ul class="nav sub-group-menu @if(request()->is('users*'))sub-group-active @endif">
                    <li class="nav-item">
                        <a href="{{route('users.create')}}" class="nav-link @if(request()->is('users/create'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.add')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('users.index')}}" class="nav-link @if(request()->is('users'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.All Users')}}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Books Section -->
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link">
                    <img src="{{asset('books.png')}}" alt="" width="20px" height="30px" style="margin: 0 10px 0 10px">
                    <span>{{trans('dashboard.books')}}</span>
                </a>
                <ul class="nav sub-group-menu @if(request()->is('books*'))sub-group-active @endif">
                    <li class="nav-item">
                        <a href="{{route('books.create')}}" class="nav-link @if(request()->is('books/create'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.add')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('books.index')}}" class="nav-link @if(request()->is('books'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.All_Books')}}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Borrows Section -->
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link">
                    <img src="{{asset('borrows.png')}}" alt="" width="20px" height="30px" style="margin: 0 10px 0 10px">
                    <span>{{trans('dashboard.borrows')}}</span>
                </a>
                <ul class="nav sub-group-menu @if(request()->is('borrows*'))sub-group-active @endif">
                    <li class="nav-item">
                        <a href="{{route('borrows.create')}}" class="nav-link @if(request()->is('borrows/create'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.add')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('borrows.index')}}" class="nav-link @if(request()->is('borrows'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.All_Borrows')}}
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Roles Section -->
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link">
                    <img src="{{asset('roles.png')}}" alt="" width="20px" height="30px" style="margin: 0 10px 0 10px">
                    <span>{{trans('dashboard.roles')}}</span>
                </a>
                <ul class="nav sub-group-menu @if(request()->is('roles*'))sub-group-active @endif">
                    <li class="nav-item">
                        <a href="{{route('roles.create')}}" class="nav-link @if(request()->is('roles/create'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.add')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('roles.index')}}" class="nav-link @if(request()->is('roles'))menu-active @endif">
                            <i class="fas fa-angle-right"></i>{{trans('dashboard.All Roles')}}
                        </a>
                    </li>
                </ul>
            </li>




        </ul>
    </div>
</div>
