import React, { Component } from 'react';
import { store, rules } from '~/containers/EducationalInstitution';
import { get } from '~/containers/EducationalInstitutionAdmin';
import { formValid, validate } from '~/containers/Validator';

class Create extends Component {
    constructor(props) {
        super(props);

        this.state = {
            touched: {},
            requestValidation: {},
            educationalInstitutionAdmins: {},
            rules,

        }

        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }
    componentDidMount() {
        this.getEducationalInstitutionAdmin();
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
        const rulesEducationalInstitution = validate(rules, value, requestValidation, touched);

        this.setState({ rules: rulesEducationalInstitution });
    }
    getEducationalInstitutionAdmin() {
        get().then(data => {
            this.setState({ educationalInstitutionAdmins: data })
        })
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
                            <small id="nameHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="name"
                                className={rules.name.isInvalid && rules.name.message !== '' || requestValidation.name ? 'form-control is-invalid' : 'form-control'}
                                id="name"
                                defaultValue=""
                                aria-describedby="nameHelp"
                                maxLength={rules.name.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.name.message ? rules.name.message : requestValidation.name ? requestValidation.name : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="nit">nit</label>
                            <small id="nitHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="number"
                                name="nit"
                                className={rules.nit.isInvalid && rules.nit.message !== '' || requestValidation.nit ? 'form-control is-invalid' : 'form-control'}
                                id="nit"
                                defaultValue=""
                                aria-describedby="nitHelp"
                                maxLength={rules.name.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.nit.message ? rules.nit.message : requestValidation.nit ? requestValidation.nit : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="address">address</label>
                            <small id="addressHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="address"
                                className={rules.address.isInvalid && rules.address.message !== '' || requestValidation.address ? 'form-control is-invalid' : 'form-control'}
                                id="address"
                                defaultValue=""
                                aria-describedby="addressHelp"
                                maxLength={rules.name.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.address.message ? rules.address.message : requestValidation.address ? requestValidation.address : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="phone_number">phone_number</label>
                            <small id="phone_numberHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="phone_number"
                                className={rules.phone_number.isInvalid && rules.phone_number.message !== '' || requestValidation.phone_number ? 'form-control is-invalid' : 'form-control'}
                                id="phone_number"
                                defaultValue=""
                                aria-describedby="phone_numberHelp"
                                maxLength={rules.phone_number.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.phone_number.message ? rules.phone_number.message : requestValidation.phone_number ? requestValidation.phone_number : ''}
                            </span>
                        </div>
                        <div className="form-group">
                            <label htmlFor="website">website</label>
                            <small id="websiteHelp" className="form-text text-muted">
                                Campo requerido
                            </small>
                            <input
                                type="text"
                                name="website"
                                className={rules.website.isInvalid && rules.website.message !== '' || requestValidation.website ? 'form-control is-invalid' : 'form-control'}
                                id="website"
                                defaultValue=""
                                aria-describedby="websiteHelp"
                                maxLength={rules.website.max}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            />
                            <span className="invalid-feedback">
                                {rules.website.message ? rules.website.message : requestValidation.website ? requestValidation.website : ''}
                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="administrator_id">Seleccione un administrador de institucion educativa</label>
                            <small id="administrator_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select
                                id="administrator_id"
                                name="administrator_id"
                                className={rules.administrator_id.isInvalid && rules.administrator_id.message !== '' || requestValidation.administrator_id ? 'form-control is-invalid' : 'form-control'}
                                defaultValue=""
                                aria-describedby="administrator_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value='none'>Seleccione una institución educativa</option>
                                {this.state.educationalInstitutionAdmins.length > 0 ? (
                                    this.state.educationalInstitutionAdmins.map((educationalInstitutionAdmin) => (
                                        <option value={educationalInstitutionAdmin.user.id} key={educationalInstitutionAdmin.user.id}>{educationalInstitutionAdmin.user.name}</option>

                                    ))
                                ) : (
                                        <option value="">No educational institutions admins</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''}

                            </span>
                        </div>

                        <div className="form-group">
                            <label htmlFor="node_id">Nodo</label>
                            <small id="node_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select
                                id="node_id"
                                name="node_id"
                                className={rules.node_id.isInvalid && rules.node_id.message !== '' || requestValidation.node_id ? 'form-control is-invalid' : 'form-control'}
                                defaultValue=""
                                aria-describedby="node_idHelp"
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value=''>Seleccione una institución educativa</option>
                                {this.state.educationalInstitutionAdmins.length > 0 ? (
                                    this.state.educationalInstitutionAdmins.map((educationalInstitutionAdmin) => (
                                        <option
                                            value={educationalInstitutionAdmin.node.id}
                                            key={educationalInstitutionAdmin.node.id}>{educationalInstitutionAdmin.node.state}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No educational institutions</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.node_id.message ? rules.node_id.message : requestValidation.node_id ? requestValidation.node_id : ''}

                            </span>
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
