import React, { useState } from 'react';
import { authenticate } from '~/containers/Auth.js';
import { useHistory } from 'react-router-dom';

function Login() {
    const history = useHistory();
    const [message, setMessage] = useState(null);
    const handleSubmit = async (e) => {
        e.preventDefault();
        let data = await authenticate(e.target);
        if (data.message) {
            setMessage(data.message);
        }
        if(data.access_token){
            localStorage.setItem('token', data.access_token);
            history.push('/app/researchers/list');
        }
    }
    return (
        <div className="row">
            <div className="col-6 mx-auto">
                <div className="card">
                    <div className="card-header">
                        <h4>Login</h4>
                    </div>
                    <div className="card-body">
                        {message ? (
                            <div className="alert alert-info">{message}</div>
                        ) : (<div></div>)}
                        <form onSubmit={handleSubmit}>
                            <div className="form-group">
                                <label htmlFor="email">Email</label>
                                <input type="email" name="email" id="email" className="form-control" required />
                            </div>
                            <div className="form-group">
                                <label htmlFor="password">Password</label>
                                <input type="password" className="form-control" name="password" id="password" autoComplete="off" aria-required />
                            </div>
                            <button type="submit" className="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default Login;