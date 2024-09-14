import { createStore } from "vuex";
import loading from "@/store/index";
import { SHOW_LOADING } from "@/store/storeconstant";

const store = createStore({
    modules: {
        loading,
    },
    state() {
        return {
            showLoading : false,
        };
    },
    mutations: {
        [SHOW_LOADING](state, payload) {
            state.showLoading = payload
        }
    }
})

export default store;