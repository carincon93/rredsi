export const authenticate = async (form) => {
    try {
        let fd = new FormData(form);
        let res = await fetch('/api/login', {
            method: 'POST',
            body: fd,
            headers:{
                accept: 'application/json'
            }
        });
        let data = await res.json();
        return data;
    } catch (error) {
        console.log(error);
    }
}