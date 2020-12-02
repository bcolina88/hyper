<template>
  <div class="sidebar">
    <nav class="sidebar-nav">
      <div slot="header"></div>
      <ul class="nav">
        <li class="nav-item" v-for="(item, index) in navItems" >
   
            <template v-if="item.title" >

              <SidebarNavTitle :name="item.name" />

            </template>
            <template v-else-if="item.divider">
              <li class="divider"></li>
            </template>
            <template v-else>

              <template v-if="item.children">
                <SidebarNavDropdown :name="item.name" :url="item.url" :icon="item.icon" v-if="permissionGenerator('ver',item.maestro)">
                  <template v-for="(child, index) in item.children" >
                    <template v-if="child.children" >

                            <SidebarNavDropdown :name="child.name" :url="child.url" :icon="child.icon" v-if="permissionGenerator('ver',child.maestro)" >
                              <li class="nav-item" v-for="(child, index) in item.children" >
                                
                                  <SidebarNavLink :name="child.name" :url="child.url" :icon="child.icon" :badge="child.badge" />

                              </li>
                            </SidebarNavDropdown>

                    </template>
                    <template v-else>
                      <li class="nav-item" v-if="permissionGenerator('ver',child.maestro)">

                          <SidebarNavLink :name="child.name" :url="child.url" :icon="child.icon" :badge="child.badge"/>
                          
                      </li>
                    </template>
                  </template>
                </SidebarNavDropdown>
              </template>
              <template v-else>

    
                <SidebarNavLink :name="item.name" :url="item.url" :icon="item.icon" :badge="item.badge" v-if="permissionGenerator('ver',item.maestro)"/>
          
              </template>


            </template>
 
        </li>
        <li class="nav-item">

          <a class="nav-link" href="http://localhost:8000/logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" >

            <i class="icon-logout"></i> Salir
            <span class="badge badge-default"></span>
          </a>

          <form id="logout-form" action="http://localhost:8000/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" value="c91zxFt0PHQZyqHkOIorF2iEgBtwW5qpDc3Nbc12">
           </form>


        </li>
      </ul>
      <slot></slot>
      <div slot="footer"></div>
    </nav>
  </div>
</template>
<script>
import SidebarNavDropdown from './SidebarNavDropdown'
import SidebarNavLink from './SidebarNavLink'
import SidebarNavTitle from './SidebarNavTitle'
export default {
  name: 'sidebar',
    data () {
    return {
      responsee: '',
      permisos : this.$store.getters.permisos,
    }
  },
  props: {
    navItems: {
      type: Array,
      required: true,
      default: () => []
    },
    role: {
      type: Number
    }
  },
  components: {
    SidebarNavDropdown,
    SidebarNavLink,
    SidebarNavTitle
  },
  methods: {
    handleClick (e) {
      e.preventDefault()
      e.target.parentElement.classList.toggle('open')
    },
    read() {
      
      this.$store.dispatch('isUser', null).then(data => {

          this.responsee =  data.permisos;
  
      });


    },
    permissionGenerator(operacion, maestro) {

      if(this.permisos.length > 0){
        if(this.permisos[maestro][operacion] === 1){
          return 1;
        }else{
          return 0;
        }    
      }    
    },
  },
  created() {
    this.$store.dispatch('loginUser');
    this.read();
  },
}
</script>

<style lang="css">
  .nav-link {
    cursor:pointer;
  }
</style>
