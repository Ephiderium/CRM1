import axios from 'axios';
import router from '@/router';

const token = localStorage.getItem('token');
const instance = axios.create({
    baseURL: import.meta.env.VITE_APP_URL,
    withCredentials: true,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + token,
    }
});

instance.interceptors.response.use(
    response => response,
    error => {

        if (error.response?.status === 401) {
            router.push('/login');
        }

        if (error.response?.status === 422) {
            const errors = error.response.data.errors;
            console.error('Validation errors:', errors);
        }

        return Promise.reject(error);
    }
);

export default instance;
