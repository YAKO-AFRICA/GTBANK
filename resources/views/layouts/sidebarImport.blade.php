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

        <div class="overflow-auto " style="height: calc(100vh - 180px)">
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
                    <div class="menu-title">Mes Propositions</div>
                </a>
            </li>
            {{-- <li class="menu-label ">E-Prêt</li>
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
            </li> --}}
            <li class="menu-label">Rapport d'activité</li>
            <li>
                <a href="{{ route('report.eSouscription')}}">
                    <div class="parent-icon"><i class="bx bx-line-chart"></i>
                    </div>
                    <div class="menu-title">Souscription</div>
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('report.ePret')}}">
                    <div class="parent-icon"><i class="bx bx-map-alt"></i>
                    </div>
                    <div class="menu-title">Pret</div>
                </a>
            </li> --}}
            {{-- <li>
                <a href="{{ route('epret.QmedicalPrint')}}" target="_blank">
                    <div class="parent-icon"><i class="fadeIn animated bx bx-archive-in"></i>
                    </div>
                    <div class="menu-title">Questionnaire Medical</div>
                </a>
            </li> --}}
            
            <li class="menu-label">Paramètre</li>

            <!--<li>-->
            <!--    <a href="{{ route('setting.reseau.index')}}">-->
            <!--        <div class="parent-icon"><i class='bx bx-network-chart'></i>-->
            <!--        </div>-->
            <!--        <div class="menu-title">Reseaux</div>-->
            <!--    </a>-->
            <!--</li>-->

            <!--<li>-->
            <!--    <a href="{{ route('setting.zone.index')}}">-->
            <!--        <div class="parent-icon"><i class="fadeIn animated bx bx-grid"></i>-->
            <!--        </div>-->
            <!--        <div class="menu-title">Zone</div>-->
            <!--    </a>-->
            <!--</li>-->
            <!--<li>-->
            <!--    <a href="{{ route('setting.equipe.index')}}">-->
            <!--        <div class="parent-icon"><i class='bx bxl-microsoft-teams'></i>-->
            <!--        </div>-->
            <!--        <div class="menu-title">Equipe</div>-->
            <!--    </a>-->
            <!--</li>-->
           
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


<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand gap-3">
            <div class="mobile-toggle-menu"><i class='bx bx-menu text-light'></i>
            </div>

            <div class="top-menu ms-auto d-non">
                <ul class="navbar-nav align-items-center gap-1">
                  

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative d-none" href="#" data-bs-toggle="dropdown"><span class="alert-count">7</span>
                            <i class='bx bx-bell'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Notifications</p>
                                    <p class="msg-header-badge">8 New</p>
                                </div>
                            </a>
                            <div class="header-notifications-list header-message-list">
                           
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
                           
                        </div>
                    </li>
                </ul>
            </div>

            
            <div class="user-box dropdown px-3">
                <a class="d-flex align-items-center nav-link dropdown-toggle gap-3 dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('root/images/login-images/default.png') }}" 
                         class="user-img rounded-circle" 
                         alt="User Avatar">
                    <div class="user-info ">
                        <p class="user-name mb-0 text-light bolder">{{ Auth::user()->membre->nom ?? '' }} {{ Auth::user()->membre->prenom ?? '' }}</p>
                        <p class="designattion mb-0 text-light bold">{{ Auth::user()->userRole->name ?? 'Role Indéfini'}}</p>
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

@include('prestations.components.modals.getCustomerModal')
<!--end header -->