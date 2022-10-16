import axios from 'axios';
async function users(agentForm) {
    const URL = "/api/agent";
    const response = await window.axios.post(URL, agentForm).catch(error => {
        throw new Error(error.response.data.message);
    });
    return response;
}

async function users2() {
    const URL = localAccess.apiSiteURL + "/api/webonars/student";
    const agentForm = {
        username: "imran",
        email: "imranoso734@gmail.com",
        passowrd: ""
    }
    const response = await axios.post(URL, agentForm).catch(error => {
        throw new Error(error.response.data.message);
    });
    console.log(response);
    // return response;
}




export {
    users as
        default,
    users2
};