// Add me user
export const ADD_ME = (state, user) => {
    state.me = user;
}

// get categorys
export const GET_CATEGORYS = (state, categorys) => {

    let cat = {};
    cat.value = 0;
    cat.text = "Por favor seleccione una opción";
    state.categorys.push(cat)

    categorys.forEach((cate) => {
        let cat = {};
        cat.value = cate.id;
        cat.text = cate.name;
        state.categorys.push(cat);
    });
}

// get roles
export const GET_ROLES = (state, roles) => {

    let cat = {};
    cat.value = 0;
    cat.text = "Por favor seleccione una opción";
    state.roles.push(cat);

    roles.forEach((rol) => {
        let cat = {};
        cat.value = rol.id;
        cat.text = rol.name;
        state.roles.push(cat);
    });
}


// get permisos
export const GET_PERMISOS = (state, permisos) => {

    permisos.forEach((rol) => {
        let cat = {};
        cat.agregar = rol.agregar;
        cat.borrar = rol.borrar;
        cat.editar = rol.editar;
        cat.ver = rol.ver;
        cat.inhabilitar = rol.inhabilitar;
        cat.maestro = rol.maestro;
        state.permisos.push(cat);
    });




}
