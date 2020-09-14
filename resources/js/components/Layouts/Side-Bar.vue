<template>
  <div class="app-sidebar colored">
    <div class="sidebar-header">
      <a class="header-brand">
        <div class="logo-img">
          <!--LOGO-->
        </div>
        <span class="text">Es-saadani</span>
      </a>
      <button type="button" class="nav-toggle">
        <i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i>
      </button>
      <button id="sidebarClose" class="nav-close">
        <i class="ik ik-x"></i>
      </button>
    </div>

    <div class="sidebar-content">
      <div class="nav-container">
        <nav id="main-menu-navigation" class="navigation-main">
          <div class="nav-lavel" v-show="isLogged">Gestion</div>
          <!-- <div class="nav-item" v-show="isLogged">
                        <router-link :to="{ name: 'Dashboard' }">
                            <i class="ik ik-bar-chart-2"></i>
                            <span>Dashboard</span>
                        </router-link>
          </div>-->
          <div class="nav-item" v-show="isLogged">
            <router-link :to="{ name: 'Customers.all' }">
              <i class="ik ik-user"></i>
              <span>Clients</span>
            </router-link>
          </div>

          <div class="nav-item has-sub" v-show="isLogged">
            <a href="#">
              <i class="ik ik-layers"></i>
              <span>Visites</span>
            </a>
            <div class="submenu-content">
              <router-link :to="{ name: 'Visits.all' }" class="menu-item">
                <i class="ik ik-layers"></i>
                <span>Types des Visites</span>
              </router-link>
              <router-link :to="{ name: 'Customers.visits' }" class="menu-item">
                <i class="ik ik-layers"></i>
                <span>Visites des clients</span>
              </router-link>
            </div>
          </div>

          <div class="nav-item" v-show="isLogged">
            <router-link :to="{ name: 'Stamps.all' }">
              <i class="ik ik-layers"></i>
              <span>Timbres</span>
            </router-link>
          </div>

          <div class="nav-item" v-show="isLogged">
            <router-link :to="{ name: 'Users.all' }">
              <i class="ik ik-user"></i>
              <span>Utilisateurs</span>
            </router-link>
          </div>

          <div
            class="nav-lavel"
            v-show="
                            isLogged && auth.user.userType === 'administrateur'
                        "
          >Statistiques</div>

          <!-- <div
            class="nav-item"
            v-show="
                            isLogged && auth.user.userType === 'administrateur'
                        "
          >
            <router-link :to="{ name: 'Revenues' }">
              <i class="ik ik-zap"></i>
              <span>Statistiques</span>
            </router-link>
          </div>-->
          <div
            class="nav-item has-sub"
            v-show="
                            isLogged && auth.user.userType === 'administrateur'
                        "
          >
            <a href="#">
              <i class="ik ik-zap"></i>
              <span>Statistiques</span>
            </a>
            <div class="submenu-content">
              <router-link :to="{ name: '' }" class="menu-item">
                <i class="ik ik-layers"></i>
                <span>Tous</span>
              </router-link>
              <router-link :to="{ name: '' }" class="menu-item">
                <i class="ik ik-user"></i>
                <span>Par client</span>
              </router-link>
              <router-link :to="{ name: '' }" class="menu-item">
                <i class="ik ik-layers"></i>
                <span>Par Type</span>
              </router-link>
              <router-link :to="{ name: '' }" class="menu-item">
                <i class="ik ik-clock"></i>
                <span>Par Date</span>
              </router-link>
            </div>
          </div>

          <div class="nav-item" v-show="isLogged">
            <a style="cursor:pointer;" @click="logout()">
              <i class="ik ik-power"></i>
              <span>Déconnecter</span>
            </a>
          </div>

          <div class="nav-lavel" v-show="!isLogged">Authentification</div>
          <div class="nav-item" v-show="!isLogged">
            <router-link :to="{ name: 'Login' }">
              <i class="ik ik-power"></i>
              <span>Connecter</span>
            </router-link>
          </div>
        </nav>
      </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  computed: {
    ...mapGetters(["isLogged", "auth"]),
  },
  mounted() {
    console.log(this.auth);
  },
  methods: {
    logout() {
      this.$store.dispatch("logout");
    },
  },
};
</script>
