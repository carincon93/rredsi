import React, { useEffect, useState } from 'react';
import { Route, Redirect, useHistory } from 'react-router-dom';

function PrivateRoute({ component, path }) {
    const [auth, setAuth] = useState(true);
    const history = useHistory();
    const validateAuth = async () => {
        if (!localStorage.getItem('token')) {
            setAuth(false)
        }else{
            let res = await fetch(`/api/user`, {
                headers:{
                    accept:'application/json',
                    authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            let data = await res.json();
            if(data.message){
                localStorage.removeItem('token');
                history.push('/app/login');
                setAuth(false);
            }
        }

        return auth;
    }
    useEffect(() => {
        validateAuth();
    }, []);

    if (auth) {
        return (
            <Route
                exact
                path={path}
                component={component}
            ></Route>
        );
    }
    return (
        <Redirect 
            to={{
                pathname:"/app/login"
            }}
        />
    )
}

export default PrivateRoute;