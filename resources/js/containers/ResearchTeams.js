export const get = async () => {
  try {
    let res  = await fetch('/api/research-teams', {
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
      uri = `/api/research-teams/${id}/edit`;
    } else {
      uri = `/api/research-teams/${id}`;
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
    let fd = new FormData(form);
    await fetch('/api/research-teams', {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      }
    }).then(function(response) {
      return response.json();
    })
  } catch (error) {
    console.log(error);
  }
}

export const update = async (form, id) => {
  try {
    let fd = new FormData(form);
    let token = document.getElementById('token').content;
    fd.append('_method', 'PUT');
    let res = await fetch(`/api/research-teams/${id}`, {
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

export const destroy = async (id) => {
  try {
    let fd = new FormData();
    let token = document.getElementById('token').content;
    fd.append('_method', 'DELETE');
    let res = await fetch(`/api/research-teams/${id}`, {
      method: 'POST',
      body: fd,
      headers:{
        Accept:'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      }
    });
    let data = await res.json();

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
  mentor_name: {
    name: 'nombre del mentor',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  mentor_email: {
    name: 'correo electrónico del mentor',
    max: 191,
    type: 'email',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  mentor_cellphone: {
    name: 'número de celular del mentor',
    max: 9999999999,
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },  
  overall_objective: {
    name: 'objetivo general',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  mission: {
    name: 'misión',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  vision: {
    name: 'visión',
    type: 'text',
    required: true,
    message: '',
    isEmpty: false,
    isInvalid: false
  },
  regional_projection: {
    name: 'proyección regional y comunitaria',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  knowledge_production_strategy: {
    name: 'estrategia de producción de conocimiento',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  thematic_research: {
    name: 'temáticas de investigación',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  creation_date: {
    name: 'fecha de creación',
    type: 'date',
    required: true,
    message: '',
    isEmpty: false,
    isInvalid: false
  },
  knowledge_area_id: {
    name: 'áreas de conocimiento',
    type: 'checkbox',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  research_group_id: {
    name: 'grupo de investigación',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  educational_institution_id: {
    name: 'institución educativa',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  academic_program_id: {
    name: 'programas de formación',
    type: 'checkbox',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  research_line_id: {
    name: 'líneas de investigación',
    type: 'checkbox',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  administrator_id: {
    name: 'administrador de semillero de investigación',
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  }
}