export const get = async () => {
  try {
    let res = await fetch('/nodes', {
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
      uri = `/nodes/${id}/edit`;
    } else {
      uri = `/nodes/${id}`;
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
    let res = await fetch('/nodes', {
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
    let res = await fetch(`/nodes/${id}`, {
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
    let res = await fetch(`/nodes/${id}`, {
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

export const getEducationalInstitutionsByNode = async (nodeID) => {
  try {
    let res = await fetch(`/nodes/get-educational-institutions/${nodeID}`, {
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
export const getNode = async () => {
  try {
    let res = await fetch('/nodes', {
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
  state: {
    name: 'state',
    max: 191,
    type: 'text',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
  administrator_id: {
    name: 'administrador',
    max: 191,
    type: 'number',
    required: true,
    message: '',
    isEmpty: true,
    isInvalid: true
  },
}
export const departamentos = {
  state: {
    name: [
      "Amazonas",
      "Antioquia",
      "Arauca",
      "Atlántico",
      "Bolívar",
      "Boyacá",
      "Caldas",
      "Caquetá",
      "Casanare",
      "Cauca",
      "Cesar",
      "Chocó",
      "Cundinamarca",
      "Córdoba",
      "Guainía",
      "Guaviare",
      "Huila",
      "La Guajira",
      "Magdalena",
      "Meta",
      "Nariño",
      "Norte de Santander",
      "Putumayo",
      "Quindío",
      "Risaralda",
      "San Andrés y Providencia",
      "Santander",
      "Sucre",
      "Tolima",
      "Valle del Cauca",
      "Vaupés",
      "Vichada",
    ]
  }
}

