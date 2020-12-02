<template>
  <header class="app-header navbar ">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none" type="button" @click="mobileSidebarToggle">&#9776;</button>
    <b-link class="navbar-brand" to="#"></b-link>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" @click="sidebarMinimize">&#9776;</button>
 
    <b-nav is-nav-bar class="ml-auto">

      <!-- <b-nav-item-dropdown right>
        <template slot="button-content">
          <i class="icon-bell"></i><span class="badge badge-pill badge-danger">5</span>
        </template>

        <b-dropdown-header tag="div" class="text-center"><strong>Notificaciones</strong></b-dropdown-header>
        <b-dropdown-item><i class="fa fa-bell-o"></i> Updates<span class="badge badge-info">42</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-envelope-o"></i> Messages<span class="badge badge-success">42</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-tasks"></i> Tasks<span class="badge badge-danger">42</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-comments"></i> Comments<span class="badge badge-warning">42</span></b-dropdown-item>
        <b-dropdown-header tag="div" class="text-center"><strong>Settings</strong></b-dropdown-header>
        <b-dropdown-item><i class="fa fa-user"></i> Profile</b-dropdown-item>
        <b-dropdown-item><i class="fa fa-wrench"></i> Settings</b-dropdown-item>
        <b-dropdown-item><i class="fa fa-usd"></i> Payments<span class="badge badge-default">42</span></b-dropdown-item>
        <b-dropdown-item><i class="fa fa-file"></i> Projects<span class="badge badge-primary">42</span></b-dropdown-item>
        <b-dropdown-divider></b-dropdown-divider>
        <b-dropdown-item><i class="fa fa-shield"></i> Lock Account</b-dropdown-item>
        <b-dropdown-item><i class="fa fa-lock"></i> Logout</b-dropdown-item>
      </b-nav-item-dropdown> -->
      

      <b-nav-item-dropdown right>
        <template slot="button-content">
          <img src="static/img/avatars/user.png" class="img-avatar" >
          <span class="d-md-down-none"> {{me.name}} {{me.lastName}}</span>
        </template>
     
        <a href="http://localhost:8000/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" ><b-dropdown-item><i class="icon-logout"></i> Salir </b-dropdown-item></a>
      
        <form id="logout-form" action="http://localhost:8000/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="c91zxFt0PHQZyqHkOIorF2iEgBtwW5qpDc3Nbc12">
        </form>

      </b-nav-item-dropdown>
    </b-nav>
    <!-- <button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" @click="asideToggle">&#9776;</button> -->
  </header>
</template>
<script>

export default {
  name: 'header',
  computed: { 
    me() {
      return this.$store.getters.me
    }
  },
  created() {
    this.$store.dispatch('loginUser');
  },
  methods: {
    sidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-hidden')
    },
    sidebarMinimize (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-minimized')
    },
    mobileSidebarToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('sidebar-mobile-show')
    },
    asideToggle (e) {
      e.preventDefault()
      document.body.classList.toggle('aside-menu-hidden')
    }
  }
}
</script>


<style scoped>

.badge {
    display: inline-block;
    padding: .3em .6em;
    font-size: 75%;
    font-weight: 700;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
}

</style>

