import React, { Component } from 'react';
import { getResearchGroupByEducationalInstitution } from '~/containers/EducationalInstitution';
import { getResearchTeamsByResearchGroup } from '~/containers/ResearchGroup';
import { getEducationalInstitutionsByNode } from '~/containers/Node';
import { store, rules } from '~/containers/Researcher';
import { formValid, validate } from '~/containers/Validator';

class Create extends Component {
  constructor(props) {
    super(props);

    this.state = {
      touched: {},
      requestValidation: {},
      researchGroups: {},
      researchTeams: {},
      educationalInstitutions: {},
      rules,
    }

    this.handleSubmit = this.handleSubmit.bind(this);
    this.handleChange = this.handleChange.bind(this);
    this.handleFocus  = this.handleFocus.bind(this);
  }

  componentDidMount() {
    this.getEducationalInstitutions();
  }

  handleSubmit(e) {
    e.preventDefault();
   
    if (formValid(rules)) {
      store(e.target).then(data => {
        if (data.status === 422)
          this.setState({requestValidation: data.errors});
      });
    }
  };

  handleChange(e) {
    const { name, value } = e.target;
  
    this.setValidation(rules, value);

    if (name == 'educational_institution_id' && Number(value) > 0) {
      this.getResearchGroups(value);
    } else if (name == 'research_group_id' && Number(value) > 0) {
      this.getResearchTeams(value);
    }
  };

  handleFocus(e) {
    const { name } = e.target;

    this.setState({touched: {[name]: true}});
  }

  getResearchGroups(educationalInstitutionID) {
    getResearchGroupByEducationalInstitution(educationalInstitutionID).then(data => {
      this.setState({researchGroups: data});
    })
  }

  getResearchTeams(researchGroupID) {
    getResearchTeamsByResearchGroup(researchGroupID).then(data => {
      this.setState({researchTeams: data});
    })
  }

  getEducationalInstitutions() {
    let nodeID = 1; // Quemado
    getEducationalInstitutionsByNode(nodeID).then(data => {
      this.setState({educationalInstitutions: data});
    })
  }

  setValidation(rules, value) {
    let {requestValidation} = this.state; 
    let {touched}           = this.state;
    const rulesResearcher   = validate(rules, value,requestValidation, touched);

    this.setState({rules: rulesResearcher });
  }

  render() {
    const { rules, requestValidation } = this.state;
    return (
      <div className="container">
        <div className="form-wrapper">
          <form
            className="form" onSubmit={this.handleSubmit}
            id="form"
          >
            <div className="form-group">
              <label htmlFor="name">name</label>
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
              />
              <span className="invalid-feedback">
                {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
              </span>
            </div>
      
            <div className="form-group">
              <label htmlFor="email">email</label>
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
              />
              <span className="invalid-feedback">
                {rules.email.message ? rules.email.message : requestValidation.email ? requestValidation.email : ''}
              </span>
            </div>

            <div className="form-group">
              <label htmlFor="document_type">document_type</label>
              <small id="document_typeHelp" className="form-text text-muted">Campo requerido</small>
              <select id="document_type"
                name="document_type" 
                className={rules.document_type.isInvalid && rules.document_type.message !== '' || requestValidation.document_type ? 'form-control is-invalid': 'form-control'}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
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
              <label htmlFor="document_number">document_number</label>
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
              />
              <span className="invalid-feedback">
                {rules.document_number.message ? rules.document_number.message : requestValidation.document_number ? requestValidation.document_number : ''}
              </span>
            </div>
      
            <div className="form-group">
              <label htmlFor="cellphone_number">cellphone_number</label>
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
              />
              <span className="invalid-feedback">
                {rules.cellphone_number.message ? rules.cellphone_number.message : requestValidation.cellphone_number ? requestValidation.cellphone_number : ''}
              </span>
            </div>
      
            <div className="form-group">
              <label htmlFor="status">status</label>
              <small id="statusHelp" className="form-text text-muted">Campo requerido</small>
              <select id="status"
                name="status" 
                className={rules.status.isInvalid && rules.status.message !== '' || requestValidation.status ? 'form-control is-invalid': 'form-control'}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
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
              <label htmlFor="interests">interests</label>
              <small id="interestsHelp" className="form-text text-muted">Campo requerido</small>
              <textarea
                name="interests"
                className={rules.interests.isInvalid && rules.interests.message !== '' || requestValidation.interests ? 'form-control is-invalid': 'form-control'}
                id="interests" 
                rows="3"
                onFocus={this.handleFocus}
                onChange={this.handleChange}
              >
              </textarea>
              <span className="invalid-feedback">
                {rules.interests.message ? rules.interests.message : requestValidation.interests ? requestValidation.interests : ''}
              </span>
            </div>
      
            <div>
              <label>is_enabled</label>
              <div className="custom-control custom-radio">
                <input type="radio" id="is_enabled_yes" name="is_enabled" className="custom-control-input" onFocus={this.handleFocus} onChange={this.handleChange} value="1" />
                <label className="custom-control-label" htmlFor="is_enabled_yes">Si</label>
              </div>
              <div className="custom-control custom-radio">
                <input type="radio" id="is_enabled_no" name="is_enabled" className="custom-control-input" onFocus={this.handleFocus} onChange={this.handleChange} value="0" />
                <label className="custom-control-label" htmlFor="is_enabled_no">No</label>
              </div>

              <span className={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block': 'invalid-feedback'} >
                {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : '' }
              </span>
            </div>
      
            <input type="hidden" name="role_id" defaultValue="5" onChange={this.handleChange} />

            <div className="form-group">
              <label htmlFor="educational_institution_id">educational_institution_id</label>
              <small id="educational_institution_idHelp" className="form-text text-muted">Campo requerido</small>
              <select id="educational_institution_id"
                name="educational_institution_id" 
                className={rules.educational_institution_id.message !== '' ? 'form-control is-invalid': 'form-control'}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
              >
                <option value=''>Seleccione una institución educativa</option>
                {this.state.educationalInstitutions.length > 0 ? (
                  this.state.educationalInstitutions.map((educationalInstitution) => (
                    <option value={educationalInstitution.id} key={educationalInstitution.id}>{educationalInstitution.name}</option>
                  ))
                  ) : (
                    <option value="">No educational institutions</option>
                  )}
              </select>
              <span className="invalid-feedback">
                {rules.educational_institution_id.message ? rules.educational_institution_id.message : '' }
              </span>
            </div>

            <div className="form-group">
              <label htmlFor="research_group_id">research_group_id</label>
              <small id="research_group_idHelp" className="form-text text-muted">Campo requerido</small>
              <select id="research_group_id"
                name="research_group_id" 
                className={rules.research_group_id.message !== '' ? 'form-control is-invalid': 'form-control'}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
              >
                <option value=''>Seleccione un grupo de investigación</option>
                {this.state.researchGroups.length > 0 ? (
                  this.state.researchGroups.map((researchGroup) => (
                    <option value={researchGroup.id} key={researchGroup.id}>{researchGroup.name}</option>
                  ))
                  ) : (
                    <option value="">No research groups</option>
                  )  
                }
              </select>
              <span className="invalid-feedback">
                {rules.research_group_id.message ? rules.research_group_id.message : '' }
              </span>
            </div>
      
            <div>
              <label>research_team_id</label>
              {this.state.researchTeams.length > 0 ? (
                this.state.researchTeams.map((researchTeam) => (
                  <div className="custom-control custom-checkbox" key={researchTeam.id}>
                    <input type="checkbox" name="research_team_id[]" className="custom-control-input" id={researchTeam.id} defaultValue={researchTeam.id} onFocus={this.handleFocus} onChange={this.handleChange} />
                    <label className="custom-control-label" htmlFor={researchTeam.id}>{researchTeam.name}</label>
                  </div> 
                ))
                ): (
                  <div>No research teams</div>
                )
              }
              <span className={rules.research_team_id.isInvalid && rules.research_team_id.message !== '' || requestValidation.research_team_id ? 'invalid-feedback d-block': 'invalid-feedback'} >
                {rules.research_team_id.message ? rules.research_team_id.message : requestValidation.research_team_id ? requestValidation.research_team_id : '' }
              </span>
            </div>
      
            <div className="form-group">
              <label htmlFor="cvlac">cvlac</label>
              <small id="cvlacHelp" className="form-text text-muted">Campo requerido</small>
              <input type="url"
                name="cvlac" 
                className={rules.cvlac.isInvalid && rules.cvlac.message !== '' || requestValidation.cvlac ? 'form-control is-invalid': 'form-control'}
                id="cvlac" 
                aria-describedby="cvlacHelp"
                maxLength={rules.cvlac.max}
                required
                onFocus={this.handleFocus}
                onChange={this.handleChange}
              />
              <span className="invalid-feedback">
                {rules.cvlac.message ? rules.cvlac.message : requestValidation.cvlac ? requestValidation.cvlac : ''}
              </span>
            </div>
      
            <div>
              <label>is_accepted</label>
              <div className="custom-control custom-radio">
                <input type="radio" id="is_accepted_yes" name="is_accepted" className="custom-control-input" onFocus={this.handleFocus} onChange={this.handleChange} value="1" />
                <label className="custom-control-label" htmlFor="is_accepted_yes">Si</label>
              </div>
              <div className="custom-control custom-radio">
                <input type="radio" id="is_accepted_no" name="is_accepted" className="custom-control-input" onFocus={this.handleFocus} onChange={this.handleChange} value="0" />
                <label className="custom-control-label" htmlFor="is_accepted_no">No</label>
              </div>

              <span className={rules.is_accepted.isInvalid && rules.is_accepted.message !== '' || requestValidation.is_accepted ? 'invalid-feedback d-block': 'invalid-feedback'} >
                {rules.is_accepted.message ? rules.is_accepted.message : requestValidation.is_accepted ? requestValidation.is_accepted : ''}
              </span>
            </div>
            <button className="btn btn-primary" type="submit" form="form">Guardar</button>
          </form>
        </div>
      </div>
    );
  }
}

export default Create;
