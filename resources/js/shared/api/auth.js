import axios from './axios';

export const authAPI = {
    login(credentials) {
        return axios.post('/api/login', credentials);
    },

    logout() {
        return axios.delete('/api/logout');
    }
}
