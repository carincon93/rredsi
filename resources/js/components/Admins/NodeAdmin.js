import React, { useEffect } from 'react';


function NodeAdmin() {
    const get = async ()=>{
        try {
            let res = await fetch('/')
        } catch (error) {
            console.log(error);
        }
    }
    useEffect(()=>{

    }, []);
    return (
        <div className="">
            <div className="row">
                <div className="col">
                    <button className="btn btn-primary">Crear administrador de semillero</button>
                </div>
                <div className="col-2">
                    <input type="text" name="search" id="search" className="form-control" placeholder="Buscar ..." />
                </div>
            </div>
            <div className="row mt-2">
                <div className="col">
                    <table className="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Correo electronico</th>
                                <th>Nodo</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    );
}

export default NodeAdmin;