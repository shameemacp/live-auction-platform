<header id="page-topbar">
            <div class="navbar-header">
                <!-- LOGO -->
                <div class="navbar-brand-box d-flex align-items-left">
                    <a href="/dashboard" class="logo">
                        <i class="mdi mdi-album"></i>
                        <span>
                            Auction-Platform
                        </span>
                    </a>

                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect waves-light" id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>
                </div>

                <div class="d-flex align-items-center">
                <div class=" d-inline-block ml-2">
                            <img class="rounded-circle header-profile-user" src="{{asset('backend/assets/images/user.png')}}"
                                alt="Header Avatar">
                               <span class="d-none d-sm-inline-block ml-1">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn text-white p-0 m-0 align-baseline;">Logout</button>
                                </form></span>
                       
                    </div>
                    
                </div>
            </div>
        </header>