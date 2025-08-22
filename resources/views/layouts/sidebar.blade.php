<!--sidebar wrapper -->
<div class="sidebar-wrapper sidebar" data-simplebar="true">
    <div class="sidebar-header" style="background-color: #076633">
        <div class="px-3">
            <img src="{{ asset('root/images/logoYnovWhite.png')}}" style="height: 60px; width:150px;" class="logo-icon img-fluid" alt="logo icon">
        </div>
        <div class="toggle-icon ms-auto text-warning"><i class='bx bx-arrow-back'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <div class="bg-light" style="min-height: 15vh">
            @php
                $codePartenaire = Auth::user()->codepartenaire;
                $partner = \App\Models\Partner::where(['code' => $codePartenaire])->first();
            @endphp

            @if ($partner != null && $partner->logo != null)
                <a href="{{ route('shared.home')}}">
                    <img src="{{ asset('logos/'. $codePartenaire . '.png') }}"
                    style="min-height: 100%; min-width: 100%; background-color: #fff' : 'height: 100%; width: 100%;" 
                    class="logo-icon img-fluid"
                    alt="logo partenaire">
                </a>
            @else
                <a href="{{ route('shared.home')}}">
                    <img src="{{ asset('root/images/logo_yako.jpg') }}"
                    style="min-height: 100%; min-width: 100%; background-color: #fff' : 'height: 100%; width: 100%;" 
                    class="logo-icon img-fluid"
                    alt="logo default">
                </a>
            @endif
        </div>

        <div class="overflow-auto" style="height: calc(90vh - 180px)">
            <strong><li class="menu-label">E-Souscription</li></strong>
            {{-- <li>
                <a href="{{ route('generateBul')}}">
                    <div class="parent-icon">
                        <i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">demo print</div>
                </a>
            </li> --}}
            <li>
                <a href="{{ route('prod.stepProduct')}}">
                    <div class="parent-icon">
                        <i class='bx bx-bookmark-heart'></i>
                    </div>
                    <div class="menu-title">Nouvelle Proposition</div>
                </a>
            </li>
            <li>
                <a href="{{ route('prod.index')}}">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-clipboard"></i>
                    </div>
                    <div class="menu-title">Mes Propositionssss</div>
                </a>
            </li>
            <li class="menu-label ">E-Prêt</li>
            <li>
                <a href="{{ route('epret.simulateur')}}">
                    <div class="parent-icon"><i class="bx bx-dollar-circle fs-5"></i>
                    </div>
                    <div class="menu-title">Simulateur</div>
                </a>
            </li>
            <li>
                <a href="{{ route('epret.index')}}">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-archive-in"></i>
                    </div>
                    <div class="menu-title">Mes demandes</div>
                </a>
            </li>
            <li class="menu-label">E-Renouvellement</li>
            <li>
                <a href="{{ route('renov.index')}}">
                    <div class="parent-icon"><i class="lni lni-alarm-clock"></i></i>
                    </div>
                    <div class="menu-title">Anniversaire</div>
                </a>
            </li>
            <li class="menu-label">Rapport d'activité</li>
            <li>
                <a href="{{ route('report.eSouscription')}}">
                    <div class="parent-icon"><i class="bx bx-line-chart"></i>
                    </div>
                    <div class="menu-title">Souscription</div>
                </a>
            </li>
            <li>
                <a href="{{ route('report.ePret')}}">
                    <div class="parent-icon"><i class="bx bx-map-alt"></i>
                    </div>
                    <div class="menu-title">Pret</div>
                </a>
            </li>
            
            <li class="menu-label">Paramètre</li>

            <li>
                <a href="{{ route('setting.reseau.index')}}">
                    <div class="parent-icon"><i class='bx bx-network-chart'></i>
                    </div>
                    <div class="menu-title">Reseaux</div>
                </a>
            </li>

            <li>
                <a href="{{ route('setting.zone.index')}}">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-grid"></i>
                    </div>
                    <div class="menu-title">Zone</div>
                </a>
            </li>
            <li>
                <a href="{{ route('setting.equipe.index')}}">
                    <div class="parent-icon"><i class='bx bxl-microsoft-teams'></i>
                    </div>
                    <div class="menu-title">Equipe</div>
                </a>
            </li>
           
            <li>
                <a href="{{ route('setting.user.index')}}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Utilisateur</div>
                </a>
            </li>
            <li>
                <a href="{{ route('setting.get.agenceByReseau')}}">
                    <div class="parent-icon"><i class="bx bx-user-circle"></i>
                    </div>
                    <div class="menu-title">Agences</div>
                </a>
            </li>
        </div>
    </ul>
    <!--end navigation-->
</div>
<!--end sidebar wrapper -->
<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu text-light'></i>
            </div>


            <div class="top-menu ms-auto d-non">
                <ul class="navbar-nav align-items-center gap-1">
                    {{-- <li class="nav-item mobile-search-icon d-flex d-lg-none" data-bs-toggle="modal" data-bs-target="#SearchModal">
                        <a class="nav-link" href="avascript:;"><i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-laungauge d-none d-sm-flex">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="avascript:;" data-bs-toggle="dropdown"><img src="assets/images/county/02.png" width="22" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/01.png" width="20" alt=""><span class="ms-2">English</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/02.png" width="20" alt=""><span class="ms-2">Catalan</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/03.png" width="20" alt=""><span class="ms-2">French</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/04.png" width="20" alt=""><span class="ms-2">Belize</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/05.png" width="20" alt=""><span class="ms-2">Colombia</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/06.png" width="20" alt=""><span class="ms-2">Spanish</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/07.png" width="20" alt=""><span class="ms-2">Georgian</span></a>
                            </li>
                            <li><a class="dropdown-item d-flex align-items-center py-2" href="javascript:;"><img src="assets/images/county/08.png" width="20" alt=""><span class="ms-2">Hindi</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dark-mode d-none d-sm-flex">
                        <a class="nav-link dark-mode-icon" href="javascript:;"><i class='bx bx-moon'></i>
                        </a>
                    </li> --}}

                    <li class="nav-item dropdown dropdown-app">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown" href="javascript:;"><i class='bx bx-grid-alt'></i></a>
                        <div class="dropdown-menu dropdown-menu-end p-0">
                            <div class="app-container p-2 my-2">
                                <div class="row gx-0 gy-2 row-cols-3 justify-content-center p-2">
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/slack.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Slack</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/behance.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Behance</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                        <img src="assets/images/app/google-drive.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Dribble</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/outlook.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Outlook</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/github.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">GitHub</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/stack-overflow.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Stack</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/figma.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Stack</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/twitter.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Twitter</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/google-calendar.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Calendar</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/spotify.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Spotify</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/google-photos.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Photos</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/pinterest.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Photos</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/linkedin.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">linkedin</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/dribble.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Dribble</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/youtube.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">YouTube</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/google.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">News</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/envato.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Envato</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
                                    <div class="col">
                                    <a href="javascript:;">
                                    <div class="app-box text-center">
                                        <div class="app-icon">
                                            <img src="assets/images/app/safari.png" width="30" alt="">
                                        </div>
                                        <div class="app-name">
                                            <p class="mb-0 mt-1">Safari</p>
                                        </div>
                                        </div>
                                    </a>
                                    </div>
        
                                </div><!--end row-->
        
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    <p class="msg-header-badge">8 New</p>
                                </div>
                            </a>
                            <div class="header-notifications-list">
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="assets/images/avatars/avatar-1.png" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Daisy Anderson<span class="msg-time float-end">5 sec
                                        ago</span></h6>
                                            <p class="msg-info">The standard chunk of lorem</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-danger text-danger">dc
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">New Orders <span class="msg-time float-end">2 min
                                        ago</span></h6>
                                            <p class="msg-info">You have recived new orders</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="assets/images/avatars/avatar-2.png" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Althea Cabardo <span class="msg-time float-end">14
                                        sec ago</span></h6>
                                            <p class="msg-info">Many desktop publishing packages</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-success text-success">
                                            <img src="assets/images/app/outlook.png" width="25" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Account Created<span class="msg-time float-end">28 min
                                        ago</span></h6>
                                            <p class="msg-info">Successfully created new email</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-info text-info">Ss
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">New Product Approved <span
                                        class="msg-time float-end">2 hrs ago</span></h6>
                                            <p class="msg-info">Your new product has approved</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="assets/images/avatars/avatar-4.png" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Katherine Pechon <span class="msg-time float-end">15
                                        min ago</span></h6>
                                            <p class="msg-info">Making this the first true generator</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-success text-success"><i class='bx bx-check-square'></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Your item is shipped <span class="msg-time float-end">5 hrs
                                        ago</span></h6>
                                            <p class="msg-info">Successfully shipped your item</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-primary">
                                            <img src="assets/images/app/github.png" width="25" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">New 24 authors<span class="msg-time float-end">1 day
                                        ago</span></h6>
                                            <p class="msg-info">24 new authors joined last week</p>
                                        </div>
                                    </div>
                                </a>
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="assets/images/avatars/avatar-8.png" class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Peter Costanzo <span class="msg-time float-end">6 hrs
                                        ago</span></h6>
                                            <p class="msg-info">It was popularised in the 1960s</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <button class="btn btn-primary w-100">View All Notifications</button>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                            <i class='bx bx-shopping-bag'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">My Cart</p>
                                    <p class="msg-header-badge">10 Items</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                               
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h5 class="mb-0">Total</h5>
                                        <h5 class="mb-0 ms-auto">$489.00</h5>
                                    </div>
                                    <button class="btn btn-primary w-100">Checkout</button>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>


            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('root/images/login-images/default.png') }}" 
                         class="user-img rounded-circle" 
                         alt="User Avatar">
                    <div class="user-info">
                        <p class="user-name mb-0">{{ Auth::user()->membre->nom ?? '' }} {{ Auth::user()->membre->prenom ?? '' }}</p>
                        <p class="designattion mb-0">{{ Auth::user()->userRole->name ?? 'Role Indéfini'}}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item d-flex align-items-center" href="{{ route('setting.user.profile')}}"><i class="bx bx-user fs-5"></i><span>Profile</span></a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center text-danger" 
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bx bx-exit fs-5 me-2"></i> 
                            <span>Se Déconnecter</span>
                        </a>
                        <!-- Hidden Logout Form -->
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                    </li>
                </ul>
            </div>
        </nav>

       
    </div>
</header>

{{-- @include('prestations.components.modals.getCustomerModal') --}}
<!--end header -->