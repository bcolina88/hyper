export default {
  items: [
    {
      title: true,
      name: 'Panel administrativo'
    },
    {
      name: 'Inicio',
      url: '/dashboard',
      maestro:0,
      icon: 'fa fa-home',
    },
    {
      name: 'Mis Proyectos',
      url: '/proyectos',
      maestro:8,
      icon: 'fa fa-address-book',
    },
    {
      name: 'Objetivos',
      url: '/objetivos',
      maestro:1,
      icon: 'fa fa-dot-circle-o',
    },
    {
      name: 'Palancas',
      url: '/palancas',
      maestro:2,
      icon: 'fa fa-wrench',
    },
    {
      name: 'Experimentos',
      url: '/experimentos',
      maestro:3,
      icon: 'fa fa-flask',
    },
    {
      name: 'Campañas',
      url: '/campanas',
      maestro:4,
      icon: 'fa fa-bullhorn',
    },
    {
      name: 'Configuración',
      url: '/configuracion',
      maestro:5,
      icon: 'fa fa-gears',
      children: [
        {
          name: 'Usuarios',
          url: '/configuracion/usuarios',
          maestro:6,
          icon: 'fa fa-group',
        },
        {
          name: 'Roles',
          url: '/configuracion/roles',
          maestro:7,
          icon: 'fa fa-address-card-o',
        }
      ]
    }
  ]
}
