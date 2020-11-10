export const get = async () => {
  try {
    let res = await fetch('/academic-programs', {
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
      uri = `/academic-programs/${id}/edit`;
    } else {
      uri = `/academic-programs/${id}`;
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
    let res = await fetch('/academic-programs', {
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
    let res = await fetch(`/academic-programs/${id}`, {
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
    let res = await fetch(`/academic-programs/${id}`, {
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
  code: {
    name: 'codigo',
    max: 12,
    type: 'number',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  academic_level: {
    name: 'nivel academico',
    max: 50,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  start_date: {
    name: 'fecha de inicio',
    max: 50,
    type: 'date',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  end_date: {
    name: 'fecha final',
    max: 50,
    type: 'date',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  modality: {
    name: 'modalidad',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  daytime: {
    name: 'jornada',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  knowledge_area_id: {
    name: 'area de conocimiento',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  node_id: {
    name: 'nodo',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  educational_institution_id: {
    name: 'institucion educativa',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
}