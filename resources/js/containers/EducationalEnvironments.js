export const get = async () => {
  try {
    let res = await fetch('/api/educational-environments', {
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
      uri = `/api/educational-environments/${id}/edit`
    } else {
      uri = `/api/educational-environments/${id}`
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
    fd.append('is_external', false);
    let res = await fetch('/api/educational-environments', {
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
    fd.append('is_external', false);
    fd.append('_method', 'PUT');
    let res = await fetch(`/api/educational-environments/${id}`, {
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

export const destroy = async (id) => {
  try {
    let token = document.getElementById('token').content;
    let fd = new FormData();
    fd.append('_method', 'DELETE');
    let res = await fetch(`/api/educational-environments/${id}`, {
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

export const getByEducationalInstitution = async (id) => {
  try {
    let res = await fetch(`/api/educational-environments/getByEducationalInstitution/${id}`, {
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

export const getAcademicProgramsByEducationalInstitution = async (educationalInstitutionID) => {
  try {
    let res = await fetch(`/api/educational-environments/get-academic-programs/${educationalInstitutionID}`, {
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

export const getResearchLinesByResearchGroup = async (researchGroupId) => {
  try {
    let res = await fetch(`/api/educational-environments/get-research-lines/${researchGroupId}`, {
      headers: {
        Accept: 'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      },
    });

    let data = await res.json();
    return data;
  } catch (error) {
    console.log(error);
  }
}

export const getResearchGroupByEducationalInstitution = async (educationalInstitutionID) => {
  try {
    let res = await fetch(`/api/educational-environments/get-research-groups/${educationalInstitutionID}`, {
      headers: {
        Accept: 'application/json',
        authorization: `Bearer ${localStorage.getItem('token')}`
      },
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
  type: {
    name: 'tipo',
    max: 12,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  description: {
    name: 'descripcion',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  capacity_aprox: {
    name: 'capacidad aproximada',
    max: 191,
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
    isEmpty: false,
    isInvalid: false
  },
  is_available: {
    name: 'disponible',
    type: 'radio',
    required: true,
    message: '',
    isEmpty: false,
    isInvalid: false
  },
}