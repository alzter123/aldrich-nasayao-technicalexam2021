import Vue from 'vue'
import Vuex from 'vuex'

import axios from 'axios'
// import example from './module-example'

Vue.use(Vuex)

/*
 * If not building with SSR mode, you can
 * directly export the Store instantiation;
 *
 * The function below can be async too; either use
 * async/await or return a Promise which resolves
 * with the Store instance.
 */

export default function (/* { ssrContext } */) {
  const Store = new Vuex.Store({



    actions: {
      SAVE_ALL_INFO({commit}, payload){
        console.log(payload);
        return new Promise((resolve, reject) => {
          axios.post('http://localhost/techexam2/', payload, {
            params: {
              addId: 1
            }
        }).then(response => {
          resolve(response)
        }).
        catch(error => {
          reject(error)
       })
      })

    }
  },

    modules: {
      // example
    },

    // enable strict mode (adds overhead!)
    // for dev mode only
    strict: process.env.DEBUGGING
  })

  return Store
}
