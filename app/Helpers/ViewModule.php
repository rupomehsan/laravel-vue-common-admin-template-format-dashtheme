<?php

use Illuminate\Support\Str;

if (!function_exists('viewAll')) {
    function viewAll($module)
    {

        $content = <<<"EOD"
                    <template>
                    <div class="container-fluid">
                        <!-- Container-fluid starts -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header d-flex justify-content-between">
                                        <h5 class="text-capitalize"> {{ page_title }}</h5>
                                        <div>
                                            <router-link class="btn btn-outline-warning btn-sm"
                                                :to="{ name: `Create\${route_prefix}` }">Create</router-link>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive h-80vh">
                                        <table class="table table-hover text-center table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="w-10"><input type="checkbox"></th>
                                                    <th class="text-start">SL</th>
                                                    <th>Full Name</th>
                                                    <th>Email</th>
                                                    <th>Phone</th>
                                                    <th>image</th>
                                                    <th>status</th>
                                                    <th class="text-end">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(item, index) in all_data.data" :key="item.id">
                                                    <td class="w-10"><input type="checkbox"></td>
                                                    <td class="text-start">{{ index + 1 }}</td>
                                                    <td>{{ item.name }}</td>
                                                    <td>{{ item.email }}</td>
                                                    <td>{{ item.phone }}</td>
                                                    <td>
                                                        <img :src="item.image" height="50" width="70" alt="">
                                                    </td>
                                                    <td>{{ item.status }}</td>
                                                    <td style="width: 100px;">
                                                        <div class="d-flex justify-content-between gap-2">
                                                            <!-- <router-link class="btn btn-sm btn-outline-success "
                                                                :to="{ name: `CreateBlogCategory` }">
                                                                <i class="fa fa-eye"></i>
                                                            </router-link> -->
                                                            <router-link class="btn btn-sm btn-outline-warning mx-2" :to="{
                                                                name: `Create\${route_prefix}`, query: {
                                                                    id: item.id,
                                                                },
                                                            }">
                                                                <i class="fa fa-pencil"></i>
                                                            </router-link>
                                                            <a @click.prevent="delete_data(item.id)" class="btn btn-sm btn-outline-danger ">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <hr>

                                    </div>
                                    <div class="mx-5">
                                        <pagination :data="all_data" :method="get_all_data" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Container-fluid starts -->
                    </div>
                    </template>

                    <script>
                    import { mapActions, mapState } from 'pinia'
                    import { user_setup_store } from './setup/store';
                    import setup from "./setup";
                    export default {
                        data: () => ({
                            route_prefix: '',
                            page_title: ''
                        }),
                        created: function () {
                            this.route_prefix = setup.route_prefix;
                            this.page_title = setup.page_title;
                            this.get_all_data()
                        },
                        methods: {
                            ...mapActions(user_setup_store, {
                                get_all_data: 'all',
                                delete_data: 'delete',
                            }),

                        },
                        computed: {
                            ...mapState(user_setup_store, {
                                all_data: 'all_data',
                            })
                        }
                    }
                    </script>

                    <style></style>

        EOD;

        return $content;
    }
}


if (!function_exists('viewForm')) {
    function viewForm($module)
    {
        $content = <<<"EOD"
                    <template>
                    <div>
                        <form @submit.prevent="submitHandler">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="text-capitalize">{{ param_id ? 'Update' : 'Create' }} new {{ route_prefix }}</h5>
                                    <div>
                                        <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All\${route_prefix}` }">All {{
                                            route_prefix }}</router-link>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" v-for="(form_field, index) in form_fields" :key="index">
                                            <common-input :label="form_field.label" :type="form_field.type" :name="form_field.name"
                                                :multiple="form_field.multiple" :value="form_field.value"
                                                :data_list="form_field.data_list" />
                                        </div>


                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-light btn-square px-5"><i class="icon-lock"></i>
                                            Submit</button>
                                    </div>

                                </div>
                            </div>
                            <div class="form-group full_width category_card_dropdown custom_scroll">
                                <label for="" class="mb-2">Select Category Parent</label>
                                <br>
                                <input type="radio" name="parent_id" checked="checked" value="0">
                                <span class="text-sm mx-2"  for="">No parent</span>


                                <nestedCategory :children="all_child_data" :child_parent_id="child_parent_id"></nestedCategory>
                            </div>
                        </form>

                    </div>
                </template>

                <script>
                import { mapActions, mapState } from 'pinia'
                import { blog_category_setup_store } from './setup/store';
                import setup from "./setup";
                import form_fields from "./setup/form_fields";

                export default {


                    data: () => ({
                        route_prefix: '',
                        form_fields,
                        param_id: null,
                        child_parent_id: null
                    }),
                    created: async function () {
                        let id = this.\$route.query.id;
                        this.route_prefix = setup.route_prefix;
                        await this.get_all_data()
                        await this.get_all_data_with_child()
                        if (id) {
                            this.param_id = id;
                            await this.get_single_data(id);
                            if (this.single_data) {
                                this.form_fields.forEach((field, index) => {
                                    Object.entries(this.single_data).forEach((value) => {
                                        if (field.name == value[0]) {
                                            this.form_fields[index].value = value[1];
                                        }
                                        if (value[0] == 'parent_id') {
                                            this.child_parent_id = value[1]
                                        }

                                    });
                                });
                            }
                        } else {
                            this.form_fields.forEach((item) => {
                                item.value = "";
                            });
                        }
                    },
                    methods: {
                        ...mapActions(blog_category_setup_store, {
                            get_all_data: 'all',
                            get_single_data: 'get',
                            store_data: 'store',
                            update_data: 'update',
                            get_all_data_with_child: 'get_all_data_with_child',
                        }),

                        submitHandler: async function (\$event) {
                            if (this.param_id) {
                                let response = await this.update_data(\$event.target, this.param_id);
                                if (response.data.status === "success") {
                                    window.s_alert(response.data.message);
                                    this.\$router.push({ name: `All\${this . route_prefix}` });
                                }
                            } else {
                                let response = await this.store_data(\$event.target);
                                if (response.data.status === "success") {
                                    window.s_alert(response.data.message);
                                    this.\$router.push({ name: `All\${this . route_prefix}` });
                                }
                            }
                        },
                    },

                    computed: {
                        ...mapState(blog_category_setup_store, {
                            single_data: "single_data",
                            all_data: 'all_data',
                            all_child_data: 'all_child_data'
                        }),
                    },


                }
                </script>
        EOD;

        return $content;
    }
}


if (!function_exists('ViewFormField')) {
    function ViewFormField($module)
    {
        $content = <<<"EOD"
        export default [
            {
                name: "name",
                label: "Enter your full name",
                type: "text",
                value: "",
            },
            {
                name: "email",
                label: "Enter your email",
                type: "email",
                value: "",
            },
            {
                name: "password",
                label: "Enter your password",
                type: "password",
                value: "",
            },
            {
                name: "phone",
                label: "Enter your phone number",
                type: "text",
                value: "",
            },

            {
                name: "image",
                label: "Upload your image",
                type: "file",
                value: null,
                multiple: false,
            },


            {
                name: "status",
                label: "Select default status",
                type: "select",
                value: "",
                multiple: false,
                data_list: [
                    {
                        label: "Active",
                        value: "active",
                    },
                    {
                        label: "Inactive",
                        value: "inactive",
                    },
                ],
            },
        ];

        EOD;

        return $content;
    }
}

if (!function_exists('ViewIndex')) {
    function ViewIndex($module)
    {
        $content = <<<"EOD"
        let setup = {
            page_title: `User Management`,
            route_prefix: `User`,
        }

        export default setup;

        EOD;

        return $content;
    }
}

if (!function_exists('ViewLayout')) {
    function ViewLayout($module)
    {
        $content = <<<"EOD"
        <template>
            <router-view></router-view>
        </template>

        <script>
        import setup from ".";

        let page_title = setup.page_title;
        export default {
            data: () => ({
                page_title,
            })
        }
        </script>

        <style></style>

        EOD;

        return $content;
    }
}

if (!function_exists('ViewRoute')) {
    function ViewRoute($module)
    {
        $content = <<<"EOD"
        import setup from ".";
        import All from "../All.vue";
        import Form from "../Form.vue";
        import Layout from "./Layout.vue";

        let route_prefix = setup.route_prefix;

        const routes =
        {
            path: 'users',
            component: Layout,
            children: [
                {
                    path: '',
                    name: "All" + route_prefix,
                    component: All,
                },
                {
                    path: "create",
                    name: "Create" + route_prefix,
                    component: Form,
                },

            ]
        };


        export default routes;

        EOD;

        return $content;
    }
}

if (!function_exists('ViewStore')) {
    function ViewStore($module)
    {
        $content = <<<"EOD"
        import { defineStore } from "pinia";

        export const user_setup_store = defineStore("user_setup_store", {
            state: () => ({
                all_data: {},
                single_data: {},
                role_data: {},
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
                        response = await axios.get("users");
                    }
                    this.all_data = response.data.data;
                },

                get: async function (id) {
                    let response = await axios.get("users/" + id);
                    response = response.data.data;
                    this.single_data = response;
                },

                store: async function (form) {
                    let formData = new FormData(form);
                    let response = await axios.post("users", formData);
                    return response;
                },

                update: async function (form, id) {
                    let formData = new FormData(form);
                    let response = await axios.post(`users/\${id}?_method=PATCH`, formData);
                    return response;
                },

                delete: async function (id) {
                    var data = await window.s_confirm();
                    if (data) {
                        let response = await axios.delete("users/" + id);
                        window.s_alert("Data deleted");
                        this.all();
                        console.log(response.data);
                    }
                },

                // additional function
                // additional function
                get_all_roles: async function (id) {
                    let response = await axios.get("user-roles?get_all=1");
                    response = response.data.data;
                    // console.log("data", response);
                    this.role_data = response;
                },

            },
        });

        EOD;

        return $content;
    }
}
