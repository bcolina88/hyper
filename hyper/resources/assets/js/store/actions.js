import { http, str } from '../utils'
// axios instance
import axios from 'axios'


// Get categorys
export const getEmpresa = ({ commit }) => {

    let query = `{
        companys{
            id,
            name,
            web,
            boss,
            email,
            nif,
            adrees,
            phone,
            phone2,
            phone3,
            image,
            currency{
                id,
                description
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


// Update Role Permission
export const updateRolePermission = ({ commit }, data) => {


    let formatteAttachments = '';

    data.permissions.map(permission => {
        formatteAttachments += ` { agregar: ${permission.agregar}, editar: ${permission.editar}, ver: ${permission.ver}, inhabilitar: ${permission.inhabilitar}, borrar: ${permission.borrar}, maestro: ${permission.maestro.id} } `;
    });

    let mutation = `mutation {
        updateRolePermission(id:${data.id}, name:"${data.name}", permissions: [${formatteAttachments}])
        {
            id,
            name,
            created_at,
            active
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}




export const createRolePermission = ({ commit }, data) => {


    let formatteAttachments = '';

    data.permissions.map(permission => {
        formatteAttachments += ` { agregar: ${permission.agregar}, editar: ${permission.editar}, ver: ${permission.ver}, inhabilitar: ${permission.inhabilitar}, borrar: ${permission.borrar}, maestro: ${permission.maestro.id} } `;
    });


    http.get("api/IsUser",null).then(function (res) {

        commit('GET_PERMISOS', res.data.permisos);
        return res.data;

    });


    /*let mutation = `mutation {
        createRolePermission(name:"${data.name}", permissions: [${formatteAttachments}])
        {
            id,
            name,
            created_at,
            active
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });*/
}






// Get permissions
export const permissions = ({ commit }) => {

    let query = `{
        permissions{
            id,
            agregar,
            editar,
            ver,
            inhabilitar,
            borrar,
            rol{
               id,
               name
            },
            maestro{
               id,
               titulo,
               padre{
                 id,
                 titulo
               }
            }
        }
    }`;



    /*return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })*/


    axios.get("api/Permissions",null).then(function (res) {

        commit('GET_PERMISOS', res.data);
        return res.data;

    });





}



// Get RoleInfo
export const getRoleInfo = ({ commit }, data) => {

    let query = `{
        getRoleInfo(id:${data.id}){
            role{
                id,
                name
            },
            permisos{
                id,
                agregar,
                editar,
                ver,
                inhabilitar,
                borrar,
                maestro{
                   id,
                   titulo,
                   
                }
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}






// Get authenticated user
export const isUser = ({ commit }) => {


    http.get("/me",null).then(function (res) {

        commit('GET_PERMISOS', res.data.permisos);
        return res.data;

    });

}



export const loginUser = ({ commit }) => {

    return http.get( '/me').then(res => {
        commit('ADD_ME', res.data );
        return res.data;
    })
}

// Get categorys
export const getCategorys = ({ commit }) => {

    let query = `{
        categorys{
            id,
            name,
            active
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_CATEGORYS', res.data.data.categorys);
        return res.data;
    })
}

// Get roles
export const getRoles = ({ commit }) => {

    axios.get("api/Roles",null).then(function (res) {
        return res.data;
    });

    
}


// Delete Rol
export const deleteObjetivo = ({ commit }, data) => {

    http.delete("api/DeleteObjetivo/"+data.id).then(function (res) {

        return res.data;

    });

}


// Delete Rol
export const deleteRole = ({ commit }, data) => {

    http.delete("api/DeleteRole/"+data.id).then(function (res) {

        return res.data;

    });

}

// Delete Rol
export const deleteCampana = ({ commit }, data) => {

    http.delete("api/DeleteCampana/"+data.id).then(function (res) {

        return res.data;

    });

}



// Get roleById
export const roleById = ({ commit }, data) => {

     axios.get("api/RoleById/"+data.id).then(function (res) {
        return res.data;
    });
}



// status Rol
export const blockedRole = ({ commit }, data) => {

     http.put("api/BlockedRole/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}



// status Rol
export const blockedObjetivo = ({ commit }, data) => {

     http.put("api/BlockedObjetivo/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}

// status Rol
export const blockedCampana = ({ commit }, data) => {

     axios.put("api/BlockedCampana/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}

// status Rol
export const completObjetivo = ({ commit }, data) => {

     axios.put("api/CompletObjetivo/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}


export const completPalanca = ({ commit }, data) => {

     axios.put("api/CompletPalanca/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}


export const completExperimento = ({ commit }, data) => {

     axios.put("api/CompletExperimento/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}

export const completCampana = ({ commit }, data) => {

     axios.put("api/CompletCampana/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}




/*-----------------------Usuarios-----------------------------------*/

// Get usuarios
export const getUsuarios = ({ commit }) => {

    axios.get("api/Users",null).then(function (res) {
        return res.data;
    });

}


// Delete Usuario
export const deleteUser = ({ commit }, data) => {


    http.delete("api/DeleteUser/"+data.id).then(function (res) {

        return res.data;

    });

}


// Status User
export const blockedUser = ({ commit }, data) => {


    http.put("api/BlockedUser/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}


// Get userById
export const userById = ({ commit }, data) => {

    axios.get("api/UserById/"+data.id).then(function (res) {
        return res.data;
    });

}


// Get userById
export const proyectoById = ({ commit }, data) => {


    http.get( "api/ProyectoById/"+data.id).then(function (res) {

        //console.log(res)

   // axios.get("api/ProyectoById//"+data.id).then(function (res) {
        return res.data;
    });

}

// Create Proveedor
export const createProyect = ({ commit }, data) => {


    http.post("api/CreateProyecto",data)
        .then(res => {
            return res.data;
        });

   
   
}



/*-----------------------Usuarios-----------------------------------*/


/*-----------------------Proveedores-----------------------------------*/

// Get Proveedores
export const getProveedores = ({ commit }) => {

    let query = `{
        providers{
            id,
            name,
            rif,
            email,
            phone,
            company,
            active,
            address,
            description
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_PROVEEDORES', res.data.data.providers);
        return res.data;
    })
}

// Create Proveedor
export const createProvider = ({ commit }, data) => {

    let mutation = `mutation {
        createProvider(name:"${data.name}", rif: "${data.rif}", email: "${data.email}", phone: "${data.phone}", company: "${data.company}", address: "${data.address}", description: "${data.description}")
        {
            id,
            name,
            rif,
            email,
            phone,
            company,
            active,
            address,
            description
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.createProvider) {
            commit('CREATE_PROVIDER', res.data.data.createProvider);
        }
        return res.data;
    });
}

// Delete Proveedor
export const deleteProvider = ({ commit }, data) => {

    let mutation = `mutation {
        deleteProvider(id:${data.id})
        {
            id,
            name,
            rif,
            email,
            phone,
            company,
            active,
            address,
            description
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.deleteProvider) {
            commit('DELETE_PROVIDER', res.data.data.deleteProvider);
        }
        return res.data;
    });
}


// Status Proveedor
export const blockedProvider = ({ commit }, data) => {

    let mutation = `mutation {
        blockedProvider(id:${data.id}, status:${data.status})
        {
            id,
            name,
            rif,
            email,
            phone,
            company,
            active,
            address,
            description
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// Get userById
export const providerById = ({ commit }, data) => {

    let query = `{
        providerById(id:${data.id}){
            id,
            name,
            rif,
            email,
            phone,
            company,
            active,
            address,
            description
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('PROVIDER_BYID', res.data.data.providerById);
        return res.data;
    })
}

// update user
export const updateProvider = ({ commit }, data) => {

    let mutation = `mutation {
        updateProvider(id:${data.id}, name:"${data.name}", rif: "${data.rif}", email: "${data.email}", phone: "${data.phone}", company: "${data.company}", description: "${data.description}", address: "${data.address}")
        {
            id,
            name,
            rif,
            email,
            phone,
            company,
            active,
            address,
            description
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


/*-----------------------Proveedores-----------------------------------*/


/*------------------------------Mesas----------------------------------*/

// Get Mesas
export const getMesas = ({ commit }) => {

    let query = `{
        tables{
            id,
            name,
            active,
            status,
            sale
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_MESAS', res.data.data.tables);
        return res.data;
    })
}

// Create Mesa
export const createTable = ({ commit }, data) => {

    let mutation = `mutation {
        createTable(name:"${data.name}")
        {
            id,
            name,
            active,
            status
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.createTable) {
            commit('CREATE_TABLE', res.data.data.createTable);
        }
        return res.data;
    });
}

// Delete Mesa
export const deleteTable = ({ commit }, data) => {

    let mutation = `mutation {
        deleteTable(id:${data.id})
        {
            id,
            name,
            active,
            status

  
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.deleteTable) {
            commit('DELETE_TABLE', res.data.data.deleteTable);
        }
        return res.data;
    });
}


// Active Mesa
export const blockedTable = ({ commit }, data) => {

    let mutation = `mutation {
        blockedTable(id:${data.id}, status:${data.status})
        {
            id,
            name,
            active,
            status
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.blockedTable) {
            commit('BLOCKED_TABLE', res.data.data.blockedTable);
        }
        return res.data;
    });
}

// Status Mesa
export const statusTable = ({ commit }, data) => {

    let mutation = `mutation {
        statusTable(id:${data.id}, status:${data.status})
        {
            id,
            name,
            active,
            status
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.statusTable) {
            commit('STATUS_TABLE', res.data.data.statusTable);
        }
        return res.data;
    });
}


// Get tableById
export const tableById = ({ commit }, data) => {

    let query = `{
        tableById(id:${data.id}){
            id,
            name,
            active,
            status


        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        //if(res.data.data.tableById) {
          //  commit('TABLE_BYID', res.data.data.tableById);
        //}
        return res.data;
    })
}

// update table
export const updateTable = ({ commit }, data) => {

    let mutation = `mutation {
        updateTable(id:${data.id}, name:"${data.name}")
        {
            id,
            name,
            active,
            status   
        
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.updateTable) {
            commit('UPDATE_TABLE', res.data.data.updateTable);
        }
        return res.data;
    });
}


/*-----------------------Mesas-----------------------------------*/



/*------------------------------Categorias----------------------------------*/

// Get Categorias
export const getCategorias = ({ commit }) => {

    let query = `{
        categorys{
            id,
            name,
            active,
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_CATEGORIAS', res.data.data.categorys);
        return res.data;
    })
}

// Create Categoria
export const createCategory = ({ commit }, data) => {

    let mutation = `mutation {
        createCategory(name:"${data.name}")
        {
            id,
            name,
            active,
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.createCategory) {
            commit('CREATE_CATEGORY', res.data.data.createCategory);
        }
        return res.data;
    });
}

// Delete Categoria
export const deleteCategory = ({ commit }, data) => {

    let mutation = `mutation {
        deleteCategory(id:${data.id})
        {
            id,
            name,
            active,
  
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.deleteCategory) {
            commit('DELETE_CATEGORY', res.data.data.deleteCategory);
        }
        return res.data;
    });
}


// Status Categoria
export const blockedCategory = ({ commit }, data) => {

    let mutation = `mutation {
        blockedCategory(id:${data.id}, status:${data.status})
        {
            id,
            name,
            active,

        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// Get categoryById
export const categoryById = ({ commit }, data) => {

    let query = `{
        categoryById(id:${data.id}){
            id,
            name,
            active,

        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('CATEGORY_BYID', res.data.data.categoryById);
        return res.data;
    })
}

// update Categorias
export const updateCategory = ({ commit }, data) => {

    let mutation = `mutation {
        updateCategory(id:${data.id}, name:"${data.name}")
        {
            id,
            name,
            active,
        
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


/*-----------------------Categorias-----------------------------------*/

/*--------------------------Platos-----------------------------------*/

// Get Platos
export const getPlatos = ({ commit }) => {

    let query = `{
        dishs{
            id,
            name,
            price,
            code,
            description,
            active,
            stock,
            image,
            stock_min,
            category{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
       return res.data;
    })
}

// Create Platos
export const createDish = ({ commit }, data) => {

    let mutation = `mutation {
        createDish(name:"${data.name}", price: "${data.price}", code: "${data.code}", description: "${data.description}", category: ${data.category}, unity: "${data.unity}", preparation: "${data.preparation}", image: "${data.image}", duration: "${data.duration}", stock: ${data.stock}, stock_min: ${data.stock_min})
        {
            id,
            name,
            price,
            code,
            description,
            active,
            category{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.createDish) {
            commit('CREATE_DISH', res.data.data.createDish);
        }
        return res.data;
    });
}

// Delete Platos
export const deleteDish = ({ commit }, data) => {

    let mutation = `mutation {
        deleteDish(id:${data.id})
        {
            id,
            name,
            price,
            code,
            description,
            active,
            category{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        if(res.data.data.deleteDish) {
            commit('DELETE_DISH', res.data.data.deleteDish);
        }
        return res.data;
    });
}


// Status Platos
export const blockedDish = ({ commit }, data) => {

    let mutation = `mutation {
        blockedDish(id:${data.id}, status:${data.status})
        {
            id,
            name,
            price,
            code,
            description,
            active,
            category{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// Get DishById
export const dishById = ({ commit }, data) => {

    let query = `{
        dishById(id:${data.id}){
            id,
            name,
            price,
            code,
            description,
            active,
            preparation,
            duration,
            unity,
            stock,
            stock_min,
            category{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('DISH_BYID', res.data.data.dishById);
        return res.data;
    })
}

// update Platos
export const updateDish = ({ commit }, data) => {

    let mutation = `mutation {
        updateDish(id:${data.id}, name:"${data.name}", price: "${data.price}", code: "${data.code}", description: "${data.description}", category: ${data.category}, unity: "${data.unity}", preparation: "${data.preparation}", duration: "${data.duration}", stock: ${data.stock}, stock_min: ${data.stock_min})
        {
            id,
            name,
            price,
            code,
            description,
            active,
            category{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


/*-----------------------Platos-----------------------------------*/

/*-----------------------Ventas-----------------------------------*/
// Get ventas
export const getVentas = ({ commit }) => {

    let query = `{
        sales{
            id,
            total,
            status,
            date,
            numberPeople,
            total,
            created_at,

        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_VENTAS', res.data.data.sales);
        return res.data;
    })
}

// Delete ventas
export const deleteSale = ({ commit }, data) => {

    let mutation = `mutation {
        deleteSale(id:${data.id})
        {
            id,
            total,
            status,
            date,
            numberPeople,
            total,
            created_at,
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


export const createSale = ({ commit }, data) => {


    let formatteAttachments = '';

    data.products.map(product => {
        formatteAttachments += ` { id: ${product.id}, price: "${product.precio}", quantity: ${product.cantidad}, name: "${product.nombre}", category: "${product.categoria}" } `;
    });

    let mutation = `mutation {
        createSale(numberPeople:${data.numberPeople}, total: "${data.total}", table: ${data.table}, waiter: ${data.waiter}, observation: "${data.observation}", products: [${formatteAttachments}])
        {
            id,
            total,
            status,
            date,
            numberPeople,
            total,
            created_at,

        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// Status venta
export const blockedSale = ({ commit }, data) => {

    let mutation = `mutation {
        blockedSale(id:${data.id}, status:${data.status})
        {
            id,
            total,
            status,
            date,
            numberPeople,
            total,
            created_at,
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

// Update venta
export const updateSale = ({ commit }, data) => {


    let formatteAttachments = '';

    data.products.map(product => {
        formatteAttachments += ` { id: ${product.id}, price: "${product.precio}", quantity: ${product.cantidad}, name: "${product.nombre}", category: "${product.categoria}" } `;
    });

    let mutation = `mutation {
        updateSale(id:${data.id}, numberPeople:${data.numberPeople}, total: "${data.total}", table: ${data.table}, waiter: ${data.waiter}, observation: "${data.observation}", products: [${formatteAttachments}])
        {
            id,
            total,
            status,
            date,
            numberPeople,
            total,
            created_at,
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// pagar venta
export const pagarSale = ({ commit }, data) => {




    let mutation = `mutation {
        pagarSale(id:${data.id}, currency:${data.currency}, efectivo : "${data.efectivo}", debito : "${data.debito}", cheque : "${data.cheque}", transferencia : "${data.transferencia}", otros : "${data.otros}")
        {
            id,
            efectivo,
            debito,
            created_at,
  
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}





/*-----------------------Ventas-----------------------------------*/
/*-----------------------Gastos-----------------------------------*/

export const getExpenses = ({ commit }) => {

    let query = `{
        gastos{
            id,
            nombre,
            metodo_pago,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_GASTOS', res.data.data.gastos);
        return res.data;
    })
}


export const createExpense = ({ commit }, data) => {

    let mutation = `mutation {
        createExpense(nombre:"${data.nombre}", metodo_pago: "${data.metodo_pago}", monto: "${data.monto}")
        {
            id,
            nombre,
            metodo_pago,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


export const deleteExpense = ({ commit }, data) => {

    let mutation = `mutation {
        deleteExpense(id:${data.id})
        {
            id,
            nombre,
            metodo_pago,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


export const expenseById = ({ commit }, data) => {

    let query = `{
        expenseById(id:${data.id}){
            id,
            nombre,
            metodo_pago,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const updateExpense = ({ commit }, data) => {

    let mutation = `mutation {
        updateExpense(id:${data.id}, nombre:"${data.nombre}", metodo_pago: "${data.metodo_pago}", monto: "${data.monto}")
        {
            id,
            nombre,
            metodo_pago,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

/*-----------------------Gastos-----------------------------------*/

/*-----------------------Cajas-----------------------------------*/

export const getBoxes = ({ commit }) => {

    let query = `{
        cajas{
            id,
            descripcion,
            tipo,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        commit('GET_CAJAS', res.data.data.cajas);
        return res.data;
    })
}


export const createBoxe = ({ commit }, data) => {

    let mutation = `mutation {
        createBoxe(descripcion:"${data.descripcion}", tipo: "${data.tipo}", monto: "${data.monto}")
        {
            id,
            descripcion,
            tipo,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


export const deleteBoxe = ({ commit }, data) => {

    let mutation = `mutation {
        deleteBoxe(id:${data.id})
        {
            id,
            descripcion,
            tipo,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


export const boxeById = ({ commit }, data) => {

    let query = `{
        boxeById(id:${data.id}){
            id,
            descripcion,
            tipo,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const updateBoxe = ({ commit }, data) => {

    let mutation = `mutation {
        updateBoxe(id:${data.id}, descripcion:"${data.descripcion}", tipo: "${data.tipo}", monto: "${data.monto}")
        {
            id,
            descripcion,
            tipo,
            monto,
            fecha
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

/*-----------------------Cajas-----------------------------------*/


/*-----------------------Empleados-----------------------------------*/

export const getEmpleados = ({ commit }) => {

    let query = `{
        empleados{
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const createEmployee = ({ commit }, data) => {

    let mutation = `mutation {
        createEmployee(nombre:"${data.nombre}", apellido: "${data.apellido}", telefono: "${data.telefono}", role: ${data.role}, sueldo_mensual: "${data.sueldo_mensual}", sueldo_diario: "${data.sueldo_diario}", rut: "${data.rut}")
        {
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


export const deleteEmployee = ({ commit }, data) => {

    let mutation = `mutation {
        deleteEmployee(id:${data.id})
        {
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}



export const employeeById = ({ commit }, data) => {

    let query = `{
        employeeById(id:${data.id}){
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const updateEmployee = ({ commit }, data) => {

    let mutation = `mutation {
        updateEmployee(id:${data.id}, nombre:"${data.nombre}", apellido: "${data.apellido}", telefono: "${data.telefono}", role: ${data.role}, sueldo_mensual: "${data.sueldo_mensual}", sueldo_diario: "${data.sueldo_diario}", rut: "${data.rut}")
        {
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

export const blockedEmployee = ({ commit }, data) => {

    let mutation = `mutation {
        blockedEmployee(id:${data.id}, status:${data.status})
        {
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}



/*-----------------------Empleados-----------------------------------*/

/*-----------------------Pagos-----------------------------------*/


export const getEmpleadosPayment = ({ commit }) => {

    let query = `{
        employeePayments{
            id,
            rut,
            nombre,
            active,
            apellido,
            telefono,
            sueldo_mensual,
            sueldo_diario,
            role{
               id,
               name
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const createPayment = ({ commit }, data) => {


    let formatteAttachments = '';

    data.payments.map(payment => {
        formatteAttachments += ` { id: ${payment.id}, sueldo_diario: "${payment.sueldo_diario}" } `;
    });


    let mutation = `mutation {
        createPaymentEmployee(payments: [${formatteAttachments}])
        {
            id
            
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

export const getPagos = ({ commit }) => {

    let query = `{
        pagos{
            id,
            fecha,
            sueldo_diario,
            employee{
                id,
                rut,
                nombre,
                apellido
            }
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const deletePayment = ({ commit }, data) => {

    let mutation = `mutation {
        deletePaymentEmployee(id:${data.id})
        {
            id,
            fecha,
            sueldo_diario,
            employee{
                id,
                rut,
                nombre,
                apellido
            }

        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

// Get saleById
export const saleById = ({ commit }, data) => {

    let query1 = `{
        saleById(id:${data.id}){
            id,
            status,
            date,
            numberPeople,
            observation,
            total,
            table{
               id
            },
            waiter{
               id
            }
        }
    }`;


    let query = `{
        saleById(id:${data.id}){
            id,
            quantity,
            date,
            price,
            total,
            sales{
               id,
               status,
               date,
               numberPeople,
               observation,
               total,
               table{
                 id
               },
               waiter{
                 id
               }
            }
            dish{
               id,
               code,
               name,
               price,
               description,
               category{
                  id,
                  name
               }
            }
        }
    }`;




    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}

/*-----------------------Pagos-----------------------------------*/
/*-----------------------Cierres-----------------------------------*/

export const getCierres = ({ commit }) => {

    let query = `{
        cierres{
            id,
            fecha,
            total_efectivo,
            total_debito,
            total_cheque,
            total_pago,
            total_otros,
            total_ventas,
            total_gastos,
            total_transferencia,
       
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}


export const deleteClosure = ({ commit }, data) => {

    let mutation = `mutation {
        deleteClosure(id:${data.id})
        {
            id,
            fecha,
            total_efectivo,
            total_debito,
            total_cheque,
            total_pago,
            total_otros,
            total_ventas,
            total_gastos,
            total_transferencia
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}



export const cierreDia = ({ commit }) => {

    let query = `{
        cierreDia{
            gastos {
                id,
                nombre,
                monto,
                fecha
            },
            pagos {
                id,
                employee{
                    id,
                    nombre,
                    apellido
                }
                sueldo_diario,
                fecha
            },
            ventas{
              id,
              date,
              total,
            },
            total_efectivo,
            total_debito,
            total_cheque,
            total_transferencia,
            total_otros,
            caja_apertura,
            caja_cierre,
            total_gastos,
            total_pago,
            total_ventas,
            restante,
            is_closure,
            notas,
            retiro,
            total_cuadre,

        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}

export const createClosure = ({ commit }, data) => {

    let mutation = `mutation {
        createClosure(fecha:"${data.fecha}", total_efectivo:"${data.total_efectivo}", total_debito:"${data.total_debito}", total_cheque:"${data.total_cheque}", total_transferencia:"${data.total_transferencia}", total_otros:"${data.total_otros}", total_ventas:"${data.total_ventas}", total_pago:"${data.total_pago}", total_gastos:"${data.total_gastos}", caja_apertura:"${data.caja_apertura}", caja_cierre:"${data.caja_cierre}", notas:"${data.notas}", retiro:"${data.retiro}", total_cuadre:"${data.total_cuadre}")
        {
            id,
            fecha,
            total_efectivo,
            total_debito,
            total_cheque,
            total_pago,
            total_otros,
            total_ventas,
            total_gastos,
            total_transferencia,
            
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


/*-----------------------Cierres-----------------------------------*/

/*------------------------------Monedas----------------------------------*/

// Get Monedas
export const getMonedas = ({ commit }) => {

    let query = `{
        currencys{
            id,
            description,
            active
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}

// Create Monedas
export const createCurrency = ({ commit }, data) => {

    let mutation = `mutation {
        createCurrency(description:"${data.description}")
        {
            id,
            description,
            active
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

// Delete Monedas
export const deleteCurrency = ({ commit }, data) => {

    let mutation = `mutation {
        deleteCurrency(id:${data.id})
        {
            id,
            description,
            active,
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// Active Monedas
export const blockedCurrency = ({ commit }, data) => {

    let mutation = `mutation {
        blockedCurrency(id:${data.id}, status:${data.status})
        {
            id,
            description,
            active,
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {

        return res.data;
    });
}



// Get MonedaById
export const currencyById = ({ commit }, data) => {

    let query = `{
        currencyById(id:${data.id}){
            id,
            description,
            active,

        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}

// update Monedas
export const updateCurrency = ({ commit }, data) => {

    let mutation = `mutation {
        updateCurrency(id:${data.id}, description:"${data.description}")
        {
            id,
            description,
            active,
        
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


/*-----------------------Monedas-----------------------------------*/
/*------------------------------Tasas----------------------------------*/

// Get Tasas
export const getTasas = ({ commit }) => {

    let query = `{
        rates{
            id,
            value,
            currency{
                id,
                description,
            },
            active
        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}

// Create Tasas
export const createRate = ({ commit }, data) => {

    let mutation = `mutation {
        createRate(value:"${data.value}", currency:${data.currency})
        {
            id,
            value,
            currency{
                id,
                description
            },
            active
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}

// Delete Tasas
export const deleteRate = ({ commit }, data) => {

    let mutation = `mutation {
        deleteRate(id:${data.id})
        {
            id,
            value,
            currency{
                id,
                description
            },
            active
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


// Active Tasas
export const blockedRate = ({ commit }, data) => {

    let mutation = `mutation {
        blockedRate(id:${data.id}, status:${data.status})
        {
            id,
            value,
            currency{
                id,
                description
            },
            active
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}



// Get TasaById
export const rateById = ({ commit }, data) => {

    let query = `{
        rateById(id:${data.id}){
            id,
            value,
            currency{
                id,
                description
            },
            active

        }
    }`;

    return http.get( '/graphql?query=' + str.stripLines(query) ).then(function (res) {
        return res.data;
    })
}

// update Tasas
export const updateRate = ({ commit }, data) => {

    let mutation = `mutation {
        updateRate(id:${data.id}, value:"${data.value}", currency:${data.currency})
        {
            id,
            value,
            currency{
                id,
                description
            },
            active
        
        }
    }`;

    return http.get( '/graphql?query=' + mutation ).then((res) => {
        return res.data;
    });
}


/*-----------------------Tasas-----------------------------------*/



// Delete Rol
export const deletePalanca = ({ commit }, data) => {

    http.delete("api/DeletePalanca/"+data.id).then(function (res) {

        return res.data;

    });

}


// status Rol
export const blockedPalanca = ({ commit }, data) => {

     http.put("api/BlockedPalanca/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}

/***************************************************************************************/



// Delete Rol
export const deleteExperimento = ({ commit }, data) => {

    http.delete("api/DeleteExperimento/"+data.id).then(function (res) {

        return res.data;

    });

}


// status Rol
export const blockedExperimento = ({ commit }, data) => {

     http.put("api/BlockedExperimento/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}



// Delete Rol
export const deleteProyecto = ({ commit }, data) => {

    http.delete("api/DeleteProyecto/"+data.id).then(function (res) {

        return res.data;

    });

}


// status Rol
export const blockedProyecto = ({ commit }, data) => {

    http.put("api/BlockedProyecto/"+data.id+"/"+data.status).then(function (res) {
        return res.data;
    });
}