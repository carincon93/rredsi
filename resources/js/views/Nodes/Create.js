import React, { Component } from 'react';
import { store, rules, departamentos } from '~/containers/Node';
import { formValid, validate } from '~/containers/Validator';
import { get } from '~/containers/NodeAdmin';


class Create extends Component {
    constructor(props) {
        super(props);

        this.state = {
            touched: {},
            requestValidation: {},
            departamentos: {},
            nodeAdmins: {},
            rules,
        }
        this.state.departamentos = departamentos;
        console.log(this.state.departamentos.state.name)
        this.handleSubmit = this.handleSubmit.bind(this);
        this.handleChange = this.handleChange.bind(this);
        this.handleFocus = this.handleFocus.bind(this);
    }

    componentDidMount() {
        this.getNodeAdmins();
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
        const nodes = validate(rules, value, requestValidation, touched);

        this.setState({ rules: nodes });
    }

    getNodeAdmins() {
        get().then(data => {
            this.setState({ nodeAdmins: data })
        })
    }
    render() {
        const { rules, requestValidation, } = this.state;
        return (
            <div className="container">
                <div className="form-wrapper">
                    <form
                        className="form" onSubmit={this.handleSubmit}
                        id="form"
                    >
                        <div className="form-group">
                            <label htmlFor="state">state</label>
                            <small id="stateHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="state"
                                name="state"
                                className={rules.state.isInvalid && rules.state.message !== '' || requestValidation.state ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >
                                <option value='none'>Seleccione un departamento</option>
                                {this.state.departamentos.state.name.length > 0 ? (
                                    this.state.departamentos.state.name.map((departamento) => (
                                        // <option value={departamento.state.name} key={departamento.state.name}>{departamento.state.name}</option>
                                        <option value=""></option>
                                    ))
                                ) : (
                                        <option value="">No departamentos</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.state.message ? rules.state.message : requestValidation.state ? requestValidation.state : ''}
                            </span>
                        </div>



                        <div className="form-group">
                            <label htmlFor="administrator_id">administrator_id</label>
                            <small id="administrador_idHelp" className="form-text text-muted">Campo requerido</small>
                            <select id="administrator_id"
                                name="administrator_id"
                                className={rules.administrator_id.isInvalid && rules.administrator_id.message !== '' || requestValidation.administrator_id ? 'form-control is-invalid' : 'form-control'}
                                required
                                onFocus={this.handleFocus}
                                onChange={this.handleChange}
                            >

                                <option value=''>Seleccione una institución educativa</option>
                                {this.state.nodeAdmins.length > 0 ? (
                                    this.state.nodeAdmins.map((nodeAdmin) => (
                                        <option
                                            value={nodeAdmin.user.id}
                                            key={nodeAdmin.user.id}>{nodeAdmin.user.name}
                                        </option>
                                    ))
                                ) : (
                                        <option value="">No educational institutions</option>
                                    )}
                            </select>
                            <span className="invalid-feedback">
                                {rules.administrator_id.message ? rules.administrator_id.message : requestValidation.administrator_id ? requestValidation.administrator_id : ''}
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
