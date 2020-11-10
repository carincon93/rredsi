import React, { Component } from 'react';
import Loader from '~/components/Loader';
import { store, rules } from '~/containers/EducationalTools';
import { get } from '~/containers/EducationalInstitution';
import { getByEducationalInstitution } from '~/containers/EducationalEnvironments';
import { formValid, validate } from '~/containers/Validator';

class Create extends Component {
    constructor(props) {
        super(props);
        this.state = {
            touched: {},
            requestValidation: {},
            educationalInstitutions: null,
            educationalEnvironments: null,
            rules
        }
        this.getEducationalEnvironments = this.getEducationalEnvironments.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    getEducationalInstitutions() {
        get().then(data => {
            this.setState({ educationalInstitutions: data });
        })
    }

    getEducationalEnvironments(id) {
        getByEducationalInstitution(id).then(data => {
            this.setState({ educationalEnvironments: data });
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

    handleSubmit(e){
        e.preventDefault();
        if(formValid(rules)){
            store(e.target).then(data => {
                if(data.success){
                    this.props.history.push('/app/educational-tools/list');
                }
                console.log(data);
            });
        }else{
            confirm('Por favor complete el formulario');
        }
    }

    handleFocus(e) {
        const { name } = e.target;

        this.setState({ touched: { [name]: true } });
    }

    componentDidMount() {
        this.getEducationalInstitutions();
    }

    render() {
        const {rules, requestValidation} = this.state;
        if (!this.state.educationalInstitutions) {
            return <Loader />
        }
        return (
            <div className="">
                <p>Crear equipo / herramientas</p>
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
                            {this.state.educationalEnvironments ? (
                                <div className="form-group">
                                    <label htmlFor="">Ambiente</label>
                                    <select 
                                        name="educational_environment_id" 
                                        id="educational_environment_id" 
                                        className={rules.educational_environment_id.isInvalid && rules.educational_environment_id.message !== '' || requestValidation.educational_environment_id ? 'form-control is-invalid': 'form-control'}
                                        onChange={this.handleChange}
                                        onFocus={this.handleFocus}
                                    >
                                        <option value="">Seleccione un ambiente</option>
                                        {this.state.educationalEnvironments.length > 0 ? (
                                            this.state.educationalEnvironments.map(educationalEnvironment => (
                                                <option key={educationalEnvironment.id} value={educationalEnvironment.id}>{educationalEnvironment.name}</option>
                                            ))
                                        ) : (
                                                <option value="">No educational environments</option>
                                            )}
                                    </select>
                                    <div className="invalid-feedback">
                                        {rules.educational_environment_id.message ? rules.educational_environment_id.message : requestValidation.educational_environment_id ? requestValidation.educational_environment_id : ''}
                                    </div>
                                </div>
                            ) : (
                                    <div></div>
                                )}

                            <div className="form-group">
                                <button type="submit" className="btn btn-primary btn-block">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        )
    }
}

export default Create;