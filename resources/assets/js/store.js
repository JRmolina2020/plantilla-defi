import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';


Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        item: [],
        dialog: false,
        urlcategorie: 'categorie/'
    },
    mutations: {
        LIST(state, item) {
            state.item = item;
        },
        CREATE(state, item) {
            state.item.unshift(item)
        },

    },
    actions: {
        Listcategorie({
            commit,
            state
        }) {
            axios.get(state.urlcategorie)
                .then(res => {
                    commit('LIST', res.data)
                }).catch(err => {
                    console.log(err)
                })
        },
        Createcategorie({
            commit
        }, item) {
            axios.post(state.urlcategorie, item)
                .then(res => {
                    commit('CREATE', res.data)
                }).catch(err => {
                    console.log(err)
                })

        },
    }
})
