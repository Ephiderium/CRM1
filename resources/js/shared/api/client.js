import axios from './axios';

export const userAPI = {
    allClients() {
        return axios.get('/api/client/index');
    },
    createClient(data) {
        return axios.post('/api/client/', data);
    },
    byIdClient(id) {
        return axios.get('/api/client/' + id);
    },
    byEmailClient(data) {
        return axios.post('/api/client/by-email', data);
    },
    updateClient(id, data) {
        return axios.patch('/api/client/update/' + id, data);
    },
    deleteClient(id) {
        return axios.post('/api/client/' + id);
    },
    fDeleteClient(id) {
        return axios.post('/api/client/force-delete/' + id);
    },
    changeManager(clientId, managerId) {
        return axios.post('/api/client/manager/' + clientId + '/' + managerId);
    },
}


