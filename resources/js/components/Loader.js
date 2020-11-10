import React from 'react';

function Loader() {
    return (
        <div className="container">
            <div className="row">
                <div className="col-6 mx-auto text-center">
                    <p>Cargando...</p>
                    <div className="spinner-border text-primary" role="status">
                        <span className="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    );
}
export default Loader;