import React, { Component } from 'react';
import {find, rules, update} from '~/containers/EducationalTools';
import { get } from '~/containers/EducationalInstitution';
import { getByEducationalInstitution } from '~/containers/EducationalEnvironments';
import { formValid, validate } from '~/containers/Validator';
import Loader from '~/components/Loader.js';

class Edit extends Component{
    constructor(props){
        super(props);
        this.state = {
            id: props.match.params.id,
            educationalTool: null,
            educationalInstitutions: null,
            educationalEnvironments: null,
            touched: {},
            requestValidation: {},
            rules,
        }
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
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

    getEducationTool(){
        find(this.state.id).then(data => {
            this.setState({educationalTool: data});
            this.getEducationalEnvironments(data.educational_environment.educational_institution_id)
        });
    }

    handleSubmit(e){
        e.preventDefault();
        if(formValid(rules)){
            update(e.target, this.state.id).then(data => {
                console.log(data);
            });
        }else{
            confirm('Por favor complete el formulario');
        }
    }

    getEducationalInstitutions(){
        get().then(data => {
            this.setState({educationalInstitutions:data});
        })
    }

    getEducationalEnvironments(id){
        getByEducationalInstitution(id).then(data => {
            this.setState({educationalEnvironments: data});
        })
    }

    handleChange(e) {
        const { name, value } = e.target;

        this.setValidation(rules, value);

        if (name == 'educational_institution_id' && Number(value) > 0) {
            this.getEducationalEnvironments(value);
        }
    };

    setValidation(rules, value) {
        let { requestValidation } = this.state;
        let { touched } = this.state;
        const rulesResearcher = validate(rules, value, requestValidation, touched);

        this.setState({ rules: rulesResearcher });
    }

    handleFocus(e) {
        const { name } = e.target;

        this.setState({ touched: { [name]: true } });
    }


    componentDidMount(){
        this.getEducationTool();
        this.getEducationalInstitutions();
        this.resetValidator();
    }

    render(){
        const {rules, requestValidation} = this.state;
        if(!this.state.educationalTool || !this.state.educationalInstitutions || !this.state.educationalEnvironments){
            return <Loader />
        }
        return (
            <div className="container">
                <p>Editar equipo / herramienta</p>
                <div className="row">
                    <div className="col-6 mx-auto">
                        <form onSubmit={this.handleSubmit}>
                        <div className="form-group">
                                <label htmlFor="">Nombre</label>
                                <input 
                                    type="text" 
                                    name="name" 
                                    id="name" 
                                    className={rules.name.isInvalid && rules.name.message !== '' || requestValidation.name ? 'form-control is-invalid': 'form-control'}
                                    onChange={this.handleChange}
                                    onFocus={this.handleFocus}
                                    defaultValue={this.state.educationalTool.name}
                                />
                                <div className="invalid-feedback">
                                    {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Descripcion</label>
                                <textarea 
                                    name="description" 
                                    id="description" 
                                    className={rules.description.isInvalid && rules.description.message !== '' || requestValidation.description ? 'form-control is-invalid': 'form-control'}
                                    onChange={this.handleChange}
                                    onFocus={this.handleFocus}
                                    defaultValue={this.state.educationalTool.description}
                                ></textarea>
                                <div className="invalid-feedback">
                                    {rules.description.message ? rules.description.message : requestValidation.description ? requestValidation.description : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Cantidad</label>
                                <input 
                                    type="number" 
                                    name="qty" id="qty" 
                                    className={rules.qty.isInvalid && rules.qty.message !== '' || requestValidation.qty ? 'form-control is-invalid': 'form-control'}
                                    onFocus={this.handleFocus}
                                    onChange={this.handleChange}
                                    defaultValue={this.state.educationalTool.qty}
                                />
                                <div className="invalid-feedback">
                                    {rules.qty.message ? rules.qty.message : requestValidation.qty ? requestValidation.qty : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">¿Habilitado?</label>
                                <br />
                                <div className="form-check form-check-inline">
                                    <input 
                                        className="form-check-input" 
                                        type="radio" 
                                        name="is_enabled" 
                                        id="inlineRadio1" 
                                        value="1"
                                        onChange={this.handleChange}
                                        onFocus={this.handleFocus}
                                        defaultChecked={this.state.educationalTool.is_enabled?true:false}
                                    />
                                    <label className="form-check-label" htmlFor="inlineRadio1">Si</label>
                                </div>
                                <div className="form-check form-check-inline">
                                    <input 
                                        className="form-check-input" 
                                        type="radio" 
                                        name="is_enabled" 
                                        id="inlineRadio2" 
                                        value="0"
                                        onChange={this.handleChange}
                                        onFocus={this.handleFocus}
                                        defaultChecked={!this.state.educationalTool.is_enabled?true:false}
                                    />
                                    <label className="form-check-label" htmlFor="inlineRadio2">No</label>
                                </div>
                                <div className={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block': 'invalid-feedback'}>
                                    {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">¿Disponible?</label>
                                <br />
                                <div className="form-check form-check-inline">
                                    <input 
                                        className="form-check-input" 
                                        type="radio" 
                                        name="is_available" 
                                        id="inlineRadio3" 
                                        value="1" 
                                        onChange={this.handleChange}
                                        onFocus={this.handleFocus}
                                        defaultChecked={this.state.educationalTool.is_available?true:false}
                                    />
                                    <label className="form-check-label" htmlFor="inlineRadio3">Si</label>
                                </div>
                                <div className="form-check form-check-inline">
                                    <input 
                                        className="form-check-input" 
                                        type="radio" 
                                        name="is_available" 
                                        id="inlineRadio4" 
                                        value="0" 
                                        onChange={this.handleChange}
                                        onFocus={this.handleFocus}
                                        defaultChecked={!this.state.educationalTool.is_available?true:false}
                                    />
                                    <label className="form-check-label" htmlFor="inlineRadio4">No</label>
                                </div>
                                <div className={rules.is_available.isInvalid && rules.is_available.message !== '' || requestValidation.is_available ? 'invalid-feedback d-block': 'invalid-feedback'}>
                                    {rules.is_available.message ? rules.is_available.message : requestValidation.is_available ? requestValidation.is_available : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Institucion educativa</label>
                                <select 
                                    name="educational_institution_id" 
                                    id="educational_institution_id" 
                                    className={rules.educational_institution_id.isInvalid && rules.educational_institution_id.message !== '' || requestValidation.educational_institution_id ? 'form-control is-invalid': 'form-control'} 
                                    onChange={this.handleChange}
                                    onFocus={this.handleFocus}
                                    defaultValue={this.state.educationalTool.educational_environment.educational_institution_id}
                                >
                                    <option value="">Seleccione uno</option>
                                    {this.state.educationalInstitutions.length > 0 ? (
                                        this.state.educationalInstitutions.map(educationalInstitution => (
                                            <option key={educationalInstitution.id} value={educationalInstitution.id}>{educationalInstitution.name}</option>
                                        ))
                                    ) : (
                                            <option value="">No educational institutions</option>
                                        )}
                                </select>
                                <div className="invalid-feedback">
                                    {rules.educational_institution_id.message ? rules.educational_institution_id.message : requestValidation.educational_institution_id ? requestValidation.educational_institution_id : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <label htmlFor="">Ambiente</label>
                                <select 
                                    name="educational_environment_id" 
                                    id="educational_environment_id" 
                                    className={rules.educational_environment_id.isInvalid && rules.educational_environment_id.message !== '' || requestValidation.educational_environment_id ? 'form-control is-invalid': 'form-control'} 
                                    onChange={this.handleChange}
                                    onFocus={this.handleFocus}
                                    defaultValue={this.state.educationalTool.educational_environment_id}
                                >
                                    <option value="">Seleccion uno</option>
                                    {this.state.educationalEnvironments.length>0?(
                                        this.state.educationalEnvironments.map(educationalEnvironment => (
                                            <option key={educationalEnvironment.id} value={educationalEnvironment.id}>{educationalEnvironment.name}</option>
                                        ))
                                    ):(
                                        <option value="">No educational environments</option>
                                    )}
                                </select>
                                <div className="invalid-feedback">
                                    {rules.educational_environment_id.message ? rules.educational_environment_id.message : requestValidation.educational_environment_id ? requestValidation.educational_environment_id : ''}
                                </div>
                            </div>
                            <div className="form-group">
                                <button className="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Edit;