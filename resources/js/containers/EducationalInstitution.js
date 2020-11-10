export const get = async () => {
  try {
    let res = await fetch('/educational-institutions', {
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
      uri = `/educational-institutions/${id}/edit`
    } else {
      uri = `/educational-institutions/${id}`
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
    fd.append('is_external', false);
    let res = await fetch('/educational-institutions', {
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
    fd.append('is_external', false);
    fd.append('_method', 'PUT');
    let res = await fetch(`/educational-institutions/${id}`, {
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
    let token = document.getElementById('token').content;
    let res = await fetch(`/educational-institutions/${id}`, {
      method: 'Delete',
      'X-CSRF-TOKEN': token,
      headers: {
        Accept: 'application/json'
      }
    });

    let data = await res.json();
    return { 'errors': data.errors, 'status': res.status };
  } catch (error) {
    console.log(error);
  }
}

export const getAcademicProgramsByEducationalInstitution = async (educationalInstitutionID) => {
  try {
    let res = await fetch(`/educational-institutions/get-academic-programs/${educationalInstitutionID}`, {
      headers: {
        Accept: 'application/json',
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
    let res = await fetch(`/educational-institutions/get-research-lines/${researchGroupId}`, {
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

export const getResearchGroupByEducationalInstitution = async (educationalInstitutionID) => {
  try {
    let res = await fetch(`/educational-institutions/get-research-groups/${educationalInstitutionID}`, {
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

// Es el mismo get pero se usa en research lines
export const getEducationalInstitution = async () => {
  try {
    let res = await fetch('/educational-institutions', {
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
  nit: {
    name: 'nit',
    max: 99999999,
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  address: {
    name: 'address',
    max: 150,
    type:'text',
    required: true,
    message:'',
    isEmpty: true,
    isInvalid: true
  },
  phone_number: {
    name: 'número de celular',
    max: 9999999999,
    type: 'numeric',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  website: {
    name: 'website',
    max: 191,
    type: 'url',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
},
administrator_id: {
  name: 'administrador de institucón educativa',
  type: 'text',
  required: true,
  message: '',
  isEmpty: true,
  isInvalid: true
},
node_id: {
  name: 'nodo',
  type: 'text',
  required: true,
  message: '',
  isEmpty: true,
  isInvalid: true
},

}