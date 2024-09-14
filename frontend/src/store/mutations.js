import { SET_USER_TOKEN } from "@/store/storeconstant";

export default {
    [SET_USER_TOKEN] (state, payload){
        state.username = payload.username,
        state.id = payload.id,
        state.token = payload.token
    }
};