export const get = async () => {
  try {
    let res  = await fetch('/knowledge-areas', {
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
      uri = `/knowledge-areas/${id}/edit`;
    } else {
      uri = `/knowledge-areas/${id}`;
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
    let res = await fetch('/knowledge-areas', {
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
    let fd = new FormData(form);
    let token = document.getElementById('token').content;
    fd.append('_method', 'PUT');
    let res = await fetch(`/knowledge-areas/${id}`, {
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
    let fd = new FormData();
    let token = document.getElementById('token').content;
    fd.append('_method', 'DELETE');
    let res = await fetch(`/knowledge-areas/${id}`, {
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
}