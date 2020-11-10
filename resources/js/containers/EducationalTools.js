let token = document.getElementById('token').content;
export const get = async () => {
    try {
        let res = await fetch('/api/educational-tools', {
            headers:{
                authorization: `Bearer ${localStorage.getItem('token')}`,
                Accept: 'application/json'
            }
        });
        let data = await res.json();
        return data;
    } catch (error) {
        console.log(error);
    }
}

export const store = async (form) => {
    try {
        let fd = new FormData(form);
        let res = await fetch('/api/educational-tools', {
            method: 'POST',
            body: fd,
            headers: {
                Accept: 'application/json',
                authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        let data = await res.json();
        return data;
    } catch (error) {
        console.log(error);
    }
}

export const update = async (form, id) => {
    try {
        let fd = new FormData(form);
        fd.append('_method', 'PUT');
        let res = await fetch(`/api/educational-tools/${id}`, {
            method:'POST',
            body:fd,
            headers:{
                Accept: 'application/json',
                authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        let data = await res.json();
        return data;
    } catch (error) {
        console.log(error);
    }
}

export const destroy = async (id) => {
    try {
        let fd = new FormData();
        fd.append('_method', 'DELETE');
        let res = await fetch(`/api/educational-tools/${id}`, {
            method: 'POST',
            body:fd,
            headers:{
                Accept: 'application/json',
                authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        let data = await res.json();
        return data;
    } catch (error) {
        console.log(error);
    }
}

export const find = async (id) => {
    try {
        let res = await fetch(`/api/educational-tools/${id}`, {
            headers:{
                authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        let data = await res.json();
        return data;
    } catch (error) {
        console.log(error);
    }
}

export const rules = {
    name: {
        name: 'nombre',
        type: 'text',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    },
    description: {
        name: 'descripcion',
        type: 'text',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    },
    qty: {
        name: 'cantidad',
        type: 'numeric',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    },
    is_enabled: {
        name: 'habilitado',
        type: 'radio',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    }
    ,
    is_available: {
        name: 'disponible',
        type: 'radio',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    },
    educational_institution_id: {
        name: 'institucion educativa',
        type: 'numeric',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    },
    educational_environment_id: {
        name: 'ambiente',
        type: 'numeric',
        required: true,
        message: '',
        isEmpty: true,
        isInvalid: true
    }
}