import axios from 'axios';
import router from '@/routes'
import {useToast} from "vue-toastification";
const toast = useToast()
axios.interceptors.request.use(
    (request) => {
        const token = localStorage.getItem('token')
        request.headers['Authorization'] = token ? 'Bearer ' + token : ''
        return request;
    },
);

axios.interceptors.response.use(
    (response) => {
        if (response?.status === 200 || response?.status === 201) {
            return Promise.resolve(response?.data);
        } else {
            return Promise.reject(response);
        }
    },
    (error) => {
        if (error.response) {
            // show toast message
            const message = error.response?.data?.message || error.response?.statusText

            if(message) {
                toast.error(message)
            }

            if (error.response?.status === 401) {
                localStorage.removeItem('token')
                localStorage.removeItem('user')
                router.replace({
                    path: "/admin/login",
                });
            }
            return Promise.reject(error.response);
        }
    },
);

export default axios;
