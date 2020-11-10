import React, { Component } from 'react';
import { find, update, rules } from '~/containers/ResearchTeamAdmin';
import { formValid, validate } from '~/containers/Validator';

class Edit extends Component {

  constructor(props) {
    super(props);

    this.state = {
      touched: {},
      requestValidation: {},
      rules,
      id : this.props.match.params.id,

      interests: {},
      researchTeamAdmin: {},
      isEnabledChecked: null,
    };

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleFocus  = this.handleFocus.bind(this);
  }

  componentDidMount() {
    this.getResearchTeamAdmin();
    this.resetValidator();
  }

  getResearchTeamAdmin() {
    find(this.state.id, 'edit').then(data => {
      this.setState({isEnabledChecked: data.user.is_enabled == true ? 1 : 0});
      this.setState({researchTeamAdmin: data});
      this.setState({interests: JSON.parse(data.user.interests)});
    })
  }

  resetValidator() {
    let rulesName = Object.keys(rules);

    rulesName.map((ruleName) => {
      if (rules[ruleName]['required']) {
        rules[ruleName]['isEmpty']   = false;
        rules[ruleName]['isInvalid'] = false;

        this.setState({ rules });
      }
    })
  }

  handleSubmit(e) {
    e.preventDefault();
   
    if (formValid(rules)) {
      update(e.target, this.state.id).then(data => {
        if (data.status === 422)
          this.setState({requestValidation: data.errors});
      });
    }
  };

  handleChange(e) {
    const { name, value } = e.target;
    this.setValidation(rules, value);
  };

  handleFocus(e) {
    const { name } = e.target;

    this.setState({touched: {[name]: true}});
  }

  setValidation(rules, value) {
    let {requestValidation}   = this.state; 
    let {touched}             = this.state;
    const rulesResearchAdmin  = validate(rules, value,requestValidation, touched);

    this.setState({rules: rulesResearchAdmin });
  }

  render() {
    const { rules, researchTeamAdmin, interests, requestValidation } = this.state;
    if (researchTeamAdmin.user?.id == null) {
      return <div>Loading</div>
    }
    return (
      <div className="container">
        <div className="form-wrapper">
          <form
            className="form" onSubmit={this.handleSubmit}
            id="form"
          >
            <div className="form-group">
              <label htmlFor="name">Nombre</label>
              <small id="nameHelp" className="form-text text-muted">Campo requerido</small>
              <input type="text"
                name="name" 
                className={rules.name.isInvalid && rules.name.message !== '' || requestValidation.name ? 'form-control is-invalid': 'form-control'}
                id="name" 
                aria-describedby="nameHelp"
                maxLength={rules.name.max}
                autoFocus
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={researchTeamAdmin.user.name}
              />
              <span className="invalid-feedback">
                {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
              </span>
            </div>
            <div className="form-group">
              <label htmlFor="email">Correo electrónico</label>
              <small id="emailHelp" className="form-text text-muted">Campo requerido</small>
              <input type="email"
                name="email" 
                className={rules.email.isInvalid && rules.email.message !== '' || requestValidation.email ? 'form-control is-invalid': 'form-control'}
                id="email" 
                aria-describedby="emailHelp"
                maxLength={rules.email.max}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={researchTeamAdmin.user.email}
              />
              <span className="invalid-feedback">
                {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''}
              </span>
            </div>
            <div className="form-group">
              <label htmlFor="document_type">Tipo de documento</label>
              <small id="document_typeHelp" className="form-text text-muted">Campo requerido</small>
              <select id="document_type"
                name="document_type" 
                className={rules.document_type.isInvalid && rules.document_type.message !== '' || requestValidation.document_type ? 'form-control is-invalid': 'form-control'}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={researchTeamAdmin.user.document_type}
                key={researchTeamAdmin.user.id}
              >
                <option value=''>Seleccione el tipo de documento</option>
                <option value="CC">Cédula de ciudadanía</option>
                <option value="CE">Cédula de extranjería</option>
                <option value="TI">Tarjeta de identidad</option>
              </select>
              <span className="invalid-feedback">
                {rules.document_type.message ? rules.document_type.message : requestValidation.document_type ? requestValidation.document_type : ''}
              </span>
            </div>
      
            <div className="form-group">
              <label htmlFor="document_number">Número de documento</label>
              <small id="document_numberHelp" className="form-text text-muted">Campo requerido</small>
              <input type="number"
                name="document_number" 
                className={rules.document_number.isInvalid && rules.document_number.message !== '' || requestValidation.document_number ? 'form-control is-invalid': 'form-control'}
                id="document_number" 
                aria-describedby="document_numberHelp"
                min="0"
                max={rules.document_number.max}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={researchTeamAdmin.user.document_number}
              />
              <span className="invalid-feedback">
                {rules.document_number.message ? rules.document_number.message : requestValidation.document_number ? requestValidation.document_number : ''}
              </span>
            </div>
      
            <div className="form-group">
              <label htmlFor="cellphone_number">Número de celular</label>
              <small id="cellphone_numberHelp" className="form-text text-muted">Campo requerido</small>
              <input type="number"
                name="cellphone_number" 
                className={rules.cellphone_number.isInvalid && rules.cellphone_number.message !== '' || requestValidation.cellphone_number ? 'form-control is-invalid': 'form-control'}
                id="cellphone_number" 
                aria-describedby="cellphone_numberHelp"
                min="0"
                max={rules.cellphone_number.max}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={researchTeamAdmin.user.cellphone_number}
              />
              <span className="invalid-feedback">
                {rules.cellphone_number.message ? rules.cellphone_number.message : requestValidation.cellphone_number ? requestValidation.cellphone_number : ''}
              </span>
            </div>
            <div className="form-group">
              <label htmlFor="interests">Intereses</label>
              <small id="interestsHelp" className="form-text text-muted">Campo requerido</small>
              <textarea
                name="interests"
                className={rules.interests.isInvalid && rules.interests.message !== '' || requestValidation.interests ? 'form-control is-invalid': 'form-control'}
                id="interests" 
                rows="3"
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={interests}
              >
              </textarea>
              <span className="invalid-feedback">
                {rules.interests.message ? rules.interests.message : requestValidation.interests ? requestValidation.interests : ''}
              </span>
            </div>
            <div className="form-group">
              <label htmlFor="status">Estado</label>
              <small id="statusHelp" className="form-text text-muted">Campo requerido</small>
              <select id="status"
                name="status" 
                className={rules.status.isInvalid && rules.status.message !== '' || requestValidation.status ? 'form-control is-invalid': 'form-control'}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
                defaultValue={researchTeamAdmin.user.status}
                key={researchTeamAdmin.user.id}
              >
                <option value=''>Seleccione el estado</option>
                <option value="Aceptado">Aceptado</option>
                <option value="En espera">En espera</option>
                <option value="Rechazado">Rechazado</option>
              </select>
              <span className="invalid-feedback">
                {rules.status.message ? rules.status.message : requestValidation.status ? requestValidation.status : ''}
              </span>
            </div>
            <div className="form-group">
              <label>¿Habilitado?</label>
              <p className="text-muted">Campo requerido</p>
              <div className="custom-control custom-radio">
                <input className="custom-control-input" type="radio" name="is_enabled" id="is_enabled_yes" value="1" defaultChecked={this.state.isEnabledChecked == 1 ? true : false} />
                <label className="custom-control-label" htmlFor="is_enabled_yes">Si</label>
              </div>
              <div className="custom-control custom-radio">
                <input className="custom-control-input" type="radio" name="is_enabled" id="is_enabled_no" value="0" defaultChecked={this.state.isEnabledChecked == 0 ? true : false} />
                <label className="custom-control-label" htmlFor="is_enabled_no">No</label>
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="role_id">Rol</label>
              <p className="text-muted">Campo requerido</p>
              <input 
                type="hidden" 
                name="role_id" 
                value="3"
              />
              <input 
                type="text" 
                className={rules.role_id.isInvalid && rules.role_id.message !== '' || requestValidation.role_id ? 'form-control is-invalid': 'form-control'} 
                disabled 
                value="Administrador de semillero"
                onFocus={this.handleFocus}
                onChange={this.handleChange}
              />
              <span className="invalid-feedback">
                {rules.role_id.message ? rules.role_id.message : requestValidation.role_id ? requestValidation.role_id : ''}
              </span>
            </div>
            <div className="form-group">
              <label htmlFor="educationalInstitution">Institución educativa</label>
              <p className="text-muted">Campo requerido</p>
              <input 
                type="hidden" 
                name="educational_institution_id" 
                value="1" 
              />
              <input 
                type="text" 
                className={rules.educational_institution_id.isInvalid && rules.educational_institution_id.message !== '' || requestValidation.educational_institution_id ? 'form-control is-invalid': 'form-control'} 
                disabled 
                value="Inem"
                onFocus={this.handleFocus}
                onChange={this.handleChange}
              />
              <span className="invalid-feedback">
                {rules.educational_institution_id.message ? rules.educational_institution_id.message : requestValidation.educational_institution_id ? requestValidation.educational_institution_id : ''}
              </span>
            </div>
            <div className="form-group">
              <button className="btn btn-block btn-primary" type="submit" form="form">Guardar</button>
            </div>
          </form>
        </div>
      </div>
    )  
  }
  
}

export default Edit;