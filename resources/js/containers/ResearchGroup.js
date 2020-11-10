export const get = async () => {
  try {
    let res = await fetch('/research-groups', {
      headers: {
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
      uri = `/research-groups/${id}/edit`;
    } else {
      uri = `/research-groups/${id}`;
    }
    let res = await fetch(uri, {
      headers: {
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
    let res = await fetch('/research-groups', {
      method: 'POST',
      body: fd,
      headers: {
        Accept: 'application/json',
        'X-CSRF-TOKEN': token
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
    let res = await fetch(`/research-groups/${id}`, {
      method: 'POST',
      body: fd,
      headers: {
        Accept: 'application/json',
        'X-CSRF-TOKEN': token
      }
    });

    let data = await res.json();
    return { 'errors': data.errors, 'status': res.status };
  } catch (error) {
    console.log(error);
  }
}

export const destroy = async (id) => {
  try {
    let fd = new FormData();
    let token = document.getElementById('token').content;
    fd.append('_method', 'DELETE');
    let res = await fetch(`/research-groups/${id}`, {
      method: 'POST',
      body: fd,
      headers: {
        Accept: 'application/json',
        'X-CSRF-TOKEN': token
      }
    });

    let data = await res.json();
    return { 'errors': data.errors, 'status': res.status };

  } catch (error) {
    console.log(error);
  }
}

export const getResearchTeamsByResearchGroup = async (institutionId) => {
  try {
    let res = await fetch(`/research-groups/get-research-teams/${institutionId}`, {
      headers: {
        Accept: 'application/json',
      },
    });

    let data = await res.json();
    return data;
  } catch (error) {
    console.log(error);
  }
}
// Metodo usado en ResearchLines
export const getResearchGroup = async () => {
  try {
    let res = await fetch('/research-groups', {
      headers: {
        Accept: 'application/json'
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
    name: 'email',
    max: 191,
    type: 'email',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  leader: {
    name: 'lider',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  gruplac: {
    name: 'gruplac',
    max: 191,
    type: 'url',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  minciencias_code: {
    name: 'codigo de minciencias',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  minciencias_category: {
    name: 'Categoría de minciencias',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  website: {
    name: 'sitio web',
    max: 191,
    type: 'url',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
}