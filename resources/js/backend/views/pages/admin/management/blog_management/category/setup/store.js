import { defineStore } from "pinia"

export const blog_category_setup_store = defineStore('blog_category_setup_store', {
    state: () => ({
        all_data: {},
        single_data: {},
    }),
    getters: {
        doubleCount: (state) => state.count * 2,
    },
    actions: {
        all: async function (url) {

            let response;
            if (url) {
                response = await axios.get(url);
            } else {
                response = await axios.get("blog-categories");
            }
            this.all_data = response.data.data;
        },
        get: async function(id){
            let response = await axios.get('blog-categories/'+id);
            response = response.data.data;
            this.single_data = response;
        },
        store: async function(form){
            let formData = new FormData(form);
            let response = await axios.post('blog-categories',formData)
            return response
        },
        update: async function (form, id) {
            let formData = new FormData(form);
            let response = await axios.post(`blog-categories/${id}?_method=PATCH`, formData);
            return response
        },
        delete: async function(id){
            var data = await window.s_confirm();
            if (data) {
                let response = await axios.delete("blog-categories/" + id);
                window.s_alert("Data successfully deleted");
                this.all();
            }
        },
        bulk_action: async function(action,data){
            let response = await axios.post('blog-category/bulk-action',{action,data})
            if (response.data.status === "success") {
                window.s_alert(response.data.message);
                this.all();
            }
        },
    },
})
