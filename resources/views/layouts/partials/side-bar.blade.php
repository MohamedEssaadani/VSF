<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <div class="logo-img">
                <!--LOGO-->
            </div>
            <span class="text">Es-saadani</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded"
                class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Gestion</div>
                <div class="nav-item ">
                    <router-link :to="{ name: 'Dashboard'}" ><i class="ik ik-bar-chart-2"></i><span>Dashboard</span></router-link>
                </div>
                <div class="nav-item">
                    <router-link :to="{ name:'Customers.all' }"><i class="ik ik-user"></i><span>Clients</span> <span
                            class="badge badge-success">33+</span></router-link>
                </div>
                <div class="nav-item">
                    <router-link :to="{ name:'Visits.all' }"><i class="ik ik-layers"></i><span>Visites</span> <span
                            class="badge badge-danger">120+</span></router-link>
                </div>
                <div class="nav-item">
                    <router-link :to="{name:'Users.all'}"><i class="ik ik-user"></i><span>Utilisateurs</span> <span
                            class="badge badge-danger">120+</span></router-link>
                </div>
              
                <div class="nav-lavel">Statistiques</div>
                <div class="nav-item">
                    <a href=""><i class="ik ik-zap"></i><span>Caisse</span></a>
                </div>
            </nav>
        </div>
    </div>
</div>