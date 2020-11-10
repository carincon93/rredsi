export const get = async () => {
  try {
    let res  = await fetch('/educational-institution-admins', {
      headers:{
        Accept: 'application/json'
      }
    });

    let data = await res.json();

    return data;
  } catch (error) {
      console.log(error);
  }
}

export const find = async (id, request) => {
  try {
    let uri = '';
    if (request == 'edit') {
      uri = `/educational-institution-admins/${id}/edit`
    } else {
      uri = `/educational-institution-admins/${id}`
    }
    let res  = await fetch(uri, {
      headers:{
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
    let token = document.getElementById('token').content;
    let fd = new FormData(form);
    fd.append('is_external', false);
    let res = await fetch('/educational-institution-admins', {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
        'X-CSRF-TOKEN': token
      }
    });
    
    let data = await res.json();
    return {'errors': data.errors, 'status': res.status};
      
  } catch (error) {
    console.log(error);
  }
}

export const update = async (form, id) => {
  try {
    let fd      = new FormData(form);
    let token   = document.getElementById('token').content;
    fd.append('is_external', false);
    fd.append('_method', 'PUT');
    let res     = await fetch(`/educational-institution-admins/${id}`, {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
        'X-CSRF-TOKEN': token
      }
    });

    let data = await res.json();
    return {'errors': data.errors, 'status': res.status};
  } catch (error) {
    console.log(error);
  }
}

export const destroy = async (id) => {
  try {
    let token = document.getElementById('token').content;
    let res = await fetch(`/educational-institution-admins/${id}`, {
      method: 'Delete',
      'X-CSRF-TOKEN': token,
      headers:{
        Accept:'application/json'
      }
    });

    let data = await res.json();
    return {'errors': data.errors, 'status': res.status};
  } catch (error) {
      console.log(error);
  }
}    

export const rules = {
  name: {
    name: 'nombre',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  email: {
    name: 'correo electrónico',
    max: 191,
    type: 'email',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  document_type: {
    name: 'tipo de documento',
    max: 2,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  document_number: {
    name: 'número de documento',
    max: 9999999999,
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  cellphone_number: {
    name: 'número de celular',
    max: 9999999999,
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  status: {
    name: 'estado',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  interests: {
    name: 'intereses',
    type: 'text',
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
    isEmpty: false,
    isInvalid: false
  },
  node_id: {
    name: 'nodo',
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: false,
    isInvalid: false
  },
  role_id: {
    name: 'rol',
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: false,
    isInvalid: false
  }
}