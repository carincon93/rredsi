export const get = async () => {
  try {
    let res  = await fetch('/api/research-team-admins', {
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

export const find = async (id, request) => {
  try {
    let uri = '';
    if (request == 'edit') {
      uri = `/api/research-team-admins/${id}/edit`;
    } else {
      uri = `/api/research-team-admins/${id}`;
    }
    let res  = await fetch(uri, {
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

export const store = async (form) => {
  try {
    let token = document.getElementById('token').content;
    let fd  = new FormData(form);
    let res = await fetch('/api/research-team-admins', {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })

    let data = await res.json();
    return {'errors': data.errors, 'status': res.status};
  } catch (error) {
    console.log(error);
  }
}

export const update = async (form, id) => {
  try {
    let fd = new FormData(form);
    let token = document.getElementById('token').content;
    fd.append('_method', 'PUT');
    let res = await fetch(`/api/research-team-admins/${id}`, {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
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
    let fd = new FormData();
    let token = document.getElementById('token').content;
    fd.append('_method', 'DELETE');
    let res = await fetch(`/api/research-team-admins/${id}`, {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
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
  educational_institution_id: {
      name: 'institución educativa',
      type: 'text',
      required: true,
      message: '',
      isEmpty: false,
      isInvalid: false
  },
  role_id: {
      name: 'rol',
      type: 'text',
      required: true,
      message: '',
      isEmpty: false,
      isInvalid: false
  }
}
