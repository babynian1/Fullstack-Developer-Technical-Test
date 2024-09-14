import { GET_TOKEN, IS_AUTH } from "@/store/storeconstant";

export default {
    [GET_TOKEN]: (state) => {
        return state.token;
    },

    [IS_AUTH]: (state) => {
        return !!state.token;
    }

    
};