import Vue from 'vue'
import Router from 'vue-router'

// Containers
import Full from '@/containers/Full'

// Views
import Dashboard from '@/views/Dashboard'
import Charts from '@/views/Charts'
import Widgets from '@/views/Widgets'

// Views - Components
import Buttons from '@/views/components/Buttons'
import SocialButtons from '@/views/components/SocialButtons'
import Cards from '@/views/components/Cards'
import Forms from '@/views/components/Forms'
import Modals from '@/views/components/Modals'
import Switches from '@/views/components/Switches'
import Tables from '@/views/components/Tables'
import RoleTable from '@/views/components/RoleTable'
import RoleForm from '@/views/components/RoleForm'
import UserTable from '@/views/components/UserTable'
import UserForm from '@/views/components/UserForm'
import ProviderTable from '@/views/components/ProviderTable'
import ProviderForm from '@/views/components/ProviderForm'
import TableTable from '@/views/components/TableTable'
import TableForm from '@/views/components/TableForm'

import DishTable from '@/views/components/DishTable'
import DishForm from '@/views/components/DishForm'
import CategoryTable from '@/views/components/CategoryTable'
import CategoryForm from '@/views/components/CategoryForm'

import ObjetivoTable from '@/views/components/ObjetivoTable'
import ObjetivoForm from '@/views/components/ObjetivoForm'


import ExpenseTable from '@/views/components/ExpenseTable'
import ExpenseForm from '@/views/components/ExpenseForm'
import BoxeTable from '@/views/components/BoxeTable'
import BoxeForm from '@/views/components/BoxeForm'

import EmployeeTable from '@/views/components/EmployeeTable'
import EmployeeForm from '@/views/components/EmployeeForm'

import PaymentTable from '@/views/components/PaymentTable'
import PaymentForm from '@/views/components/PaymentForm'

import ClosureTable from '@/views/components/ClosureTable'
import ClosureForm from '@/views/components/ClosureForm'

import CurrencyTable  from '@/views/components/CurrencyTable'
import CurrencyForm  from '@/views/components/CurrencyForm'

import RateTable  from '@/views/components/RateTable'
import RateForm  from '@/views/components/RateForm'

import CompanyTable  from '@/views/components/CompanyTable'
import CompanyForm  from '@/views/components/CompanyForm'

import PalancaTable  from '@/views/components/PalancaTable'
import PalancaForm  from '@/views/components/PalancaForm'

import ExperimentoTable  from '@/views/components/ExperimentoTable'
import ExperimentoForm  from '@/views/components/ExperimentoForm'

import CampanaTable  from '@/views/components/CampanaTable'
import CampanaForm  from '@/views/components/CampanaForm'

import ProyectoTable  from '@/views/components/ProyectoTable'
import ProyectoForm  from '@/views/components/ProyectoForm'


// Views - Icons
import FontAwesome from '@/views/icons/FontAwesome'
import SimpleLineIcons from '@/views/icons/SimpleLineIcons'

// Views - Pages
import Page404 from '@/views/pages/Page404'
import Page500 from '@/views/pages/Page500'
import Login from '@/views/pages/Login'
import Register from '@/views/pages/Register'

Vue.use(Router)

export default new Router({
  mode: 'history', // Demo is living in GitHub.io, so required!   //history   //hash
  linkActiveClass: 'open active',
  scrollBehavior: () => ({ y: 0 }),
  routes: [
    {
      path: '/',
      redirect: '/dashboard',
      name: 'Inicio',
      component: Full,
      children: [
        {
          path: 'dashboard',
          name: 'Dashboard',
          component: Dashboard
        },
        {
          path: 'charts',
          name: 'Charts',
          component: Charts
        },
        {
          path: 'widgets',
          name: 'Widgets',
          component: Widgets
        },
        {
          path: 'components',
          redirect: '/components/buttons',
          name: 'Components',
          component: {
            render (c) { return c('router-view') }
          },
          children: [
            {
              path: 'buttons',
              name: 'Buttonssss',
              component: Buttons
            },
            {
              path: 'social-buttons',
              name: 'Social Buttons',
              component: SocialButtons
            },
            {
              path: 'cards',
              name: 'Cards',
              component: Cards
            },
            {
              path: 'modals',
              name: 'Modals',
              component: Modals
            },
            {
              path: 'switches',
              name: 'Switches',
              component: Switches
            },
            {
              path: 'forms',
              name: 'Forms',
              component: Forms
            },
            {
              path: 'tables',
              name: 'Tables',
              component: Tables
            }
          ]
        }
      ]
    },
    {
      path: '/',
      redirect: '/ventas',
      name: 'Objetivos',
      component: Full,
      children: [
        {
          path: 'objetivos',
          name: 'Objetivos',
          component: ObjetivoTable
        },
        {
          path: 'objetivos/crear',
          name: 'CrearObjetivo',
          component: ObjetivoForm
        },
        {
          path: 'objetivos/editar/:id',
          name: 'EditarObjetivo',
          component: ObjetivoForm
        },
      ]
    },
    {
      path: '/',
      redirect: '/palancas',
      name: 'Palancas',
      component: Full,
      children: [
        {
          path: 'palancas',
          name: 'Palancas',
          component: PalancaTable
        },
        {
          path: 'palancas/crear',
          name: 'CrearPalanca',
          component: PalancaForm
        },
        {
          path: 'palancas/editar/:id',
          name: 'EditarPalanca',
          component: PalancaForm
        },
      ]
    },
    {
      path: '/',
      redirect: '/experimentos',
      name: 'Experimentos',
      component: Full,
      children: [
        {
          path: 'experimentos',
          name: 'Experimentos',
          component: ExperimentoTable
        },
        {
          path: 'experimentos/crear',
          name: 'CrearExperimento',
          component: ExperimentoForm
        },
        {
          path: 'empleados/editar/:id',
          name: 'EditarExperimento',
          component: ExperimentoForm
        }
      ]
    },
    {
      path: '/',
      redirect: '/campanas',
      name: 'Campanas',
      component: Full,
      children: [
        {
          path: 'campanas',
          name: 'Campanas',
          component: CampanaTable
        },
        {
          path: 'campanas/crear',
          name: 'CrearCampana',
          component: CampanaForm
        },
        {
          path: 'campanas/editar/:id',
          name: 'EditarCampana',
          component: CampanaForm
        }
      ]
    },
     {
      path: '/',
      redirect: '/proyectos',
      name: 'Mis Proyectos',
      component: Full,
      children: [
        {
          path: 'proyectos',
          name: 'Proyectos',
          component: ProyectoTable
        },
        {
          path: 'proyectos/crear',
          name: 'CrearProyecto',
          component: ProyectoForm
        },
        {
          path: 'proyectos/editar/:id',
          name: 'EditarProyecto',
          component: ProyectoForm
        }
      ]
    },
    {
      path: '/',
      redirect: '/catalogo',
      name: 'Catálogo',
      component: Full,
      children: [
        {
          path: 'catalogo/platos-bebidas',
          name: 'PlatosBebidas',
          component: DishTable
        },
        {
          path: 'catalogo/platos-bebidas/crear',
          name: 'CrearPlatoBebida',
          component: DishForm
        },
        {
          path: 'catalogo/platos-bebidas/editar/:id',
          name: 'EditarPlatoBebida',
          component: DishForm
        },
        {
          path: 'catalogo/categorias',
          name: 'Categorias',
          component: CategoryTable
        },
        {
          path: 'catalogo/categorias/crear',
          name: 'CrearCategoria',
          component: CategoryForm
        },
        {
          path: 'catalogo/categorias/editar/:id',
          name: 'EditarCategoria',
          component: CategoryForm
        }
      ]
    },
    {
      path: '/',
      redirect: '/mesas',
      name: 'Mesas',
      component: Full,
      children: [
        {
          path: 'mesas',
          name: 'Mesas',
          component: TableTable
        },
        {
          path: 'mesas/crear',
          name: 'CrearMesa',
          component: TableForm
        },
        {
          path: 'mesas/editar/:id',
          name: 'EditarMesa',
          component: TableForm
        },
      ]
    },
    {
      path: '/',
      redirect: '/proveedores',
      name: 'Proveedores',
      component: Full,
      children: [
        {
          path: 'proveedores',
          name: 'Proveedores',
          component: ProviderTable
        },
        {
          path: 'proveedores/crear',
          name: 'CrearProveedor',
          component: ProviderForm
        },
        {
          path: 'proveedores/editar/:id',
          name: 'EditarProveedor',
          component: ProviderForm
        },
      ]
    },
    {
      path: '/',
      redirect: '/configuracion',
      name: 'Configuración',
      component: Full,
      children: [
        {
          path: 'configuracion/font-awesome',
          name: 'Font Awesome',
          component: FontAwesome
        },
        {
          path: 'configuracion/simple-line-icons',
          name: 'Simple Line Icons',
          component: SimpleLineIcons
        },
        {
          path: 'configuracion/rol/crear',
          name: 'CrearRol',
          component: RoleForm
        },
        {
          path: 'configuracion/rol/editar/:id',
          name: 'EditarRol',
          component: RoleForm
        },
        {
          path: 'configuracion/roles',
          name: 'Roles',
          component: RoleTable
        },
        {
          path: 'configuracion/usuario/crear',
          name: 'CrearUsuario',
          component: UserForm
        },
        {
          path: 'configuracion/usuario/editar/:id',
          name: 'EditarUsuario',
          component: UserForm
        },
        {
          path: 'configuracion/usuarios',
          name: 'Usuarios',
          component: UserTable
        },
        {
          path: 'configuracion/moneda/crear',
          name: 'CrearMoneda',
          component: CurrencyForm
        },
        {
          path: 'configuracion/moneda/editar/:id',
          name: 'EditarMoneda',
          component: CurrencyForm
        },
        {
          path: 'configuracion/monedas',
          name: 'Monedas',
          component: CurrencyTable
        },
        {
          path: 'configuracion/tasa/crear',
          name: 'CrearTasa',
          component: RateForm
        },
        {
          path: 'configuracion/tasa/editar/:id',
          name: 'EditarTasa',
          component: RateForm
        },
        {
          path: 'configuracion/tasas',
          name: 'Tasas',
          component: RateTable
        },
        {
          path: 'configuracion/empresa/crear',
          name: 'CrearEmpresa',
          component: CompanyForm
        },
        {
          path: 'configuracion/empresa/editar/:id',
          name: 'EditarEmpresa',
          component: CompanyForm
        },
        {
          path: 'configuracion/empresa',
          name: 'Empresa',
          component: CompanyTable
        }


      ]
    },
    
  ]
})
