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
                                :to="{ name: `Create${route_prefix}` }">Create</router-link>
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
                                                name: `Create${route_prefix}`, query: {
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
        page_title: '',
        route:'user'
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
