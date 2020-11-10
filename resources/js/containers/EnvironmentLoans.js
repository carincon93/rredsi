export const get = async () => {
  try {
    let res = await fetch('/api/environment-loan-requests', {
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

export const find = async (id, request) => {
  try {
    let uri = '';
    if (request == 'edit') {
      uri = `/api/environment-loan-requests/${id}/edit`
    } else {
      uri = `/api/environment-loan-requests/${id}`
    }
    let res = await fetch(uri, {
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

export const store = async (form) => {
  try {
    let token = document.getElementById('token').content;
    let fd = new FormData(form);
    fd.append('is_returned', 0);
    fd.append('is_accepted', 0);
    let res = await fetch('/loans', {
      method: 'POST',
      body: fd,
      headers: {
        Accept: 'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      }
    });
    let data = await res.json();
    return { 'errors': data.errors, 'status': res.status };

  } catch (error) {
    console.log(error);
  }
}

export const update = async (form, id) => {
  try {
    let fd = new FormData(form);
    let token = document.getElementById('token').content;
    fd.append('_method', 'PUT');
    let res = await fetch(`/loans/${id}`, {
      method: 'POST',
      body: fd,
      headers: {
        Accept: 'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      }
    });
    let data = await res.json();
    return { 'errors': data.errors, 'status': res.status };
  } catch (error) {
    console.log(error);
  }
}

export const check = async (form, id) => {
  try {
    let fd = new FormData(form);
    let token = document.getElementById('token').content;
    fd.append('_method', 'PUT');
    let res = await fetch(`/loans/${id}/check`, {
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

export const returnLoan = async (id)=> {
  try {
    let fd = new FormData();
    let token = document.getElementById('token').content;
    fd.append('returned_at', new Date());
    fd.append('_method', 'PUT');
    let res = await fetch(`/loans/${id}/return`, {
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

export const checkReturn = async  (form, id) => {
  try {
    let fd = new FormData(form);
    fd.append('_method', 'PUT');
    let token = document.getElementById('token').content;
    let res = await fetch(`/loans/${id}/returnCheck`, {
      method: 'POST',
      body: fd,
      headers: {
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

export const destroy = async (id) => {
  try {
    let token = document.getElementById('token').content;
    let fd = new FormData();
    fd.append('_method', 'DELETE');
    let res = await fetch(`/educational-environments/${id}`, {
      method: 'POST',
      body:fd,
      headers: {
        authorization: `Bearer ${localStorage.getItem('token')}`,
        Accept: 'application/json'
      }
    });

    let data = await res.json();
    return { 'errors': data.errors, 'status': res.status };
  } catch (error) {
    console.log(error);
  }
}

export const rules = {
  start_date: {
    name: 'fecha inicio',
    type: 'date',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  end_date: {
    name: 'fecha fin',
    type: 'date',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  project_id: {
    name: 'proyecto',
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  justification: {
    name: 'justificacion',
    max: 255,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  authorization_letter: {
    name: 'carta de autorizacion',
    type: 'file',
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
  },
  is_accepted: {
    name: 'es aceptado',
    type:'radio',
    required: true,
    message:'',
    isEmpty: true,
    isInvalid: true
  },
  annotation:{
    name:'comentario',
    type:'text',
    required:true,
    message: '',
    isEmpty: true,
    isInvalid: true
  }
}