import axios from './axios';

export const userAPI = {
    changePassword(data) {
        return axios.post('/api/users/change-password', data);
    },

    disableUser(data) {
        return axios.patch('/api/users/disable-user', data);
    },

    changeRole(data) {
        return axios.patch('/api/users/change-role', data);
    },

    allUser() {
        return axios.get('/api/users/index');
    },

    findUser(id) {
        return axios.get('/api/users/' + id);
    },

    byEmail(email) {
        return axios.post('/api/users/by-email', email);
    },

    createUser(data) {
        return axios.post('/api/users/', data);
    },

    updateUser(id, data) {
        return axios.patch('/api/users/update/' + id, data);
    },

    deleteUser(id) {
        return axios.delete('/api/users/' + id);
    },
}

