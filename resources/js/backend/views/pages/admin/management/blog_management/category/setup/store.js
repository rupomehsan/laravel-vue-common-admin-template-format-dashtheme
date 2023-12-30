import { defineStore } from "pinia"

export const contact_message_store = defineStore('contact_message_store', {
    state: () => ({

    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        all: async function(){
            let response = await axios.get('/api/contact-message')
            console.log(response.data);
        },
        get: async function(id){
            let response = await axios.get('/api/contact-message/'+id);
            for (const key in response.data) {
                if (Object.hasOwnProperty.call(response.data, key)) {
                    const value = response.data[key];

                    var el = document.querySelector(`input[name='${key}']`);
                    if(el && (el.type == 'text')){
                        el.value = value
                    }

                    var el = document.querySelector(`textarea[name='${key}']`);
                    if(el && (el.type == 'textarea')){
                        el.value = value
                    }

                    var el = document.querySelector(`select[name='${key}']`);
                    if(el){
                        el.value = value
                    }
                }
            }
            console.log(response.data);
        },
        store: async function(form){
            let formData = new FormData(form);
            let response = await axios.post('/api/contact-message',formData)
            console.log(response.data);
        },
        update: async function(){
            let response = await axios.put('/api/contact-message',{
                name: "somethig",
                sub: "others"
            })
            console.log(response.data);
        },
        delete: async function(){
            let response = await axios.delete('/api/contact-message')
            console.log(response.data);
        },
    },
})
