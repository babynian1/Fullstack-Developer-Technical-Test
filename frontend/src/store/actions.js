import { LOGIN_ACTION, LOGOUT_ACTION, SET_USER_TOKEN } from "@/store/storeconstant";
import Axios from 'axios';

export default {
    [LOGOUT_ACTION] (context){
        context.commit(SET_USER_TOKEN, {
            username : '',
            token : '',
            id : '',
            role : '',
        });
    },
    async [LOGIN_ACTION] (context, payload) {
        let formData = new FormData();
        formData.append('username', payload.username);
        formData.append('password', payload.password);
        formData.append('_method', 'POST')

        let response = '';
        let res_data = '';
        let data = '';

        try {
            response = await Axios.post(
                'http://localhost:8000/api/users/login',
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            );

            res_data = response.data;

            if(res_data.success)
            {
                data = res_data.data
                context.commit(SET_USER_TOKEN, {
                    username : data.user['username'],
                    token : data.access_token,
                    id : data.user['id'],
                    name : data.user['name'],
                });
            }  else {
                throw res_data;
            }
        } catch (e) {
            const response = e.response.data;
            throw response; 
        } 
    }
};