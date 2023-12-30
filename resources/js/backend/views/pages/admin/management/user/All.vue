<template>
    <div class="container-fluid">
        <!-- Container-fluid starts -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5> {{ page_title }}</h5>
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
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="i in 10" :key="i">
                                    <td class="w-10"><input type="checkbox"></td>
                                    <td class="text-start">{{ i }}</td>
                                    <td>asd</td>
                                    <td>asdf</td>
                                    <td>asdf</td>
                                    <td>asdf</td>
                                    <td style="width: 100px;">
                                        <div class="d-flex justify-content-between gap-2">
                                            <router-link class="btn btn-sm btn-outline-success "
                                                :to="{ name: `BlogCategoryCreate` }">
                                                <i class="fa fa-eye"></i>
                                            </router-link>
                                            <router-link class="btn btn-sm btn-outline-warning mx-2"
                                                :to="{ name: `BlogCategoryCreate` }">
                                                <i class="fa fa-pencil"></i>
                                            </router-link>
                                            <a @click.prevent="contact_delete(12)" class="btn btn-sm btn-outline-danger ">
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
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="javascript:void();">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void();">1</a></li>
                            <li class="page-item active"><a class="page-link" href="javascript:void();">2</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void();">3</a></li>
                            <li class="page-item"><a class="page-link" href="javascript:void();">Next</a></li>
                        </ul>
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
    },
    methods: {
        ...mapActions(user_setup_store, {
            get_all_data: 'all',
            get_single_data: 'get',
            store_data: 'store',
            update_data: 'update',
            delete_data: 'delete',
        }),
        ...mapState(user_setup_store,{

        })
    }
}
</script>

<style></style>
