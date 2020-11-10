import React, { Component } from 'react';
import { store, rules } from '~/containers/EducationalEnvironments';
import { getEducationalInstitutionsByNode } from '~/containers/Node';
import { formValid, validate } from '~/containers/Validator';


class Create extends Component {
    constructor(props) {
        super(props);

        this.state = {
            touched: {},
            educationalInstitutions: null,
            requestValidation: {},
            rules,
        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }
    componentDidMount() {
        this.getEducationalInstitutions();
    }
    getEducationalInstitutions() {
        let nodeId = 1;
        getEducationalInstitutionsByNode(nodeId).then(data => {
            this.setState({ educationalInstitutions: data });
        })
    }
    handleSubmit(e) {
        e.preventDefault();

        if (formValid(rules)) {
            store(e.target).then(data => {
                if (data.status === 422)
                    this.setState({ requestValidation: data.errors });
            });
        }
    }
    handleChange(e) {
        const { name, value } = e.target;

        this.setValidation(rules, value);
    }
    handleFocus(e) {
        const { name } = e.target;

        this.setState({ touched: { [name]: true } });
    }
    setValidation(rules, value) {
        let { requestValidation } = this.state;
        let { touched } = this.state;
        const rulesResearcher = validate(rules, value, requestValidation, touched);

        this.setState({ rules: rulesResearcher });
    }
    render() {
        if (this.state.educationalInstitutions === null) {
            return (
                <p>Cargando...</p>
            )
        }
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
                            <small id="nameHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                className={rules.name.isInvalid && rules.name.message !== '' || requestValidation.name ? 'form-control is-invalid' : 'form-control'}
                                name="name"
                                id="name"
                                maxLength={rules.name.max}
                                required
                                onChange={this.handleChange}
                                onFocus={this.handleFocus}
                            />
                            <span className="invalid-feedback">
                                {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="type">type</label>
                            <small id="typeHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <select
                                name="type"
                                id="type"
                                className={rules.type.isInvalid && rules.type.message !== '' || requestValidation.type ? 'form-control is-invalid' : 'form-control'}
                                onChange={this.handleChange}
                                onFocus={this.handleFocus}
                            >
                                <option value="">Seleccione uno</option>
                                <option value="salon">Salon</option>
                                <option value="laboratorio">Laboratorio</option>
                            </select>

                            <span className="invalid-feedback">
                                {rules.type.message ? rules.type.message : requestValidation.type ? requestValidation.type : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="description">
                                description
                            </label>
                            <small
                                id="cellphone_numberHelp"
                                className="form-text text-muted"
                            >
                                Campo requerido
                            </small>
                            <textarea
                                name="description"
                                id="description"
                                onChange={this.handleChange}
                                onFocus={this.handleFocus}
                                className={rules.description.isInvalid && rules.description.message !== '' || requestValidation.description ? 'form-control is-invalid' : 'form-control'}
                            ></textarea>

                            <span className="invalid-feedback">
                                {rules.description.message ? rules.description.message : requestValidation.description ? requestValidation.description : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="capacity_aprox">capacity_aprox</label>
                            <small
                                id="capacity_aproxHelp"
                                className="form-text text-muted"
                            >
                                Campo requerido
                            </small>
                            <input
                                type="number"
                                name="capacity_aprox"
                                id="capacity_aprox"
                                className={rules.capacity_aprox.isInvalid && rules.capacity_aprox.message !== '' || requestValidation.capacity_aprox ? 'form-control is-invalid' : 'form-control'}
                                onChange={this.handleChange}
                                onFocus={this.handleFocus}
                            />
                            <span className="invalid-feedback">
                                {rules.capacity_aprox.message ? rules.capacity_aprox.message : requestValidation.capacity_aprox ? requestValidation.capacity_aprox : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="document_number">¿Habilitado?</label>
                            <small
                                id="document_numberHelp"
                                className="form-text text-muted"
                            >
                                Campo requerido
                            </small>
                            <div className="form-check form-check-inline">
                                <input className="form-check-input" type="radio" name="is_enabled" id="is_enable_yes" value="1" onChange={this.handleChange} onFocus={this.handleFocus} />
                                <label className="form-check-label" htmlFor="is_enable_yes">Si</label>
                            </div>
                            <div className="form-check form-check-inline">
                                <input className="form-check-input" type="radio" name="is_enabled" id="is_enabled_no" value="0" onChange={this.handleChange} onFocus={this.handleFocus} />
                                <label className="form-check-label" htmlFor="is_enabled_no">No</label>
                            </div>
                            <span className={rules.is_enabled.isInvalid && rules.is_enabled.message !== '' || requestValidation.is_enabled ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                                {rules.is_enabled.message ? rules.is_enabled.message : requestValidation.is_enabled ? requestValidation.is_enabled : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="document_number">Disponible?</label>
                            <small
                                id="document_numberHelp"
                                className="form-text text-muted"
                            >
                                Campo requerido
                            </small>
                            <div className="form-check form-check-inline">
                                <input className="form-check-input" type="radio" name="is_available" id="is_available_yes" value="1" />
                                <label className="form-check-label" htmlFor="is_available_yes">Si</label>
                            </div>
                            <div className="form-check form-check-inline">
                                <input className="form-check-input" type="radio" name="is_available" id="is_available_no" value="0" />
                                <label className="form-check-label" htmlFor="is_available_no">No</label>
                            </div>
                            <span className={rules.is_available.isInvalid && rules.is_available.message !== '' || requestValidation.is_available ? 'invalid-feedback d-block' : 'invalid-feedback'} >
                                {rules.is_available.message ? rules.is_available.message : requestValidation.is_available ? requestValidation.is_available : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="educational_institution_id">Institucion educativa</label>
                            <small
                                id="document_numberHelp"
                                className="form-text text-muted"
                            >
                                Campo requerido
                            </small>
                            <select name="educational_institution_id" id="educational_institution_id" className="form-control">
                                {this.state.educationalInstitutions.map(educationalInstitution => (
                                    <option key={educationalInstitution.id} value={educationalInstitution.id}>{educationalInstitution.name}</option>
                                ))}
                            </select>
                        </div>

                        <button
                            className="btn btn-primary"
                            type="submit"
                            form="form"
                        >
                            Guardar
                        </button>
                    </form>
                </div>
            </div>
        )
    }
}

export default Create;