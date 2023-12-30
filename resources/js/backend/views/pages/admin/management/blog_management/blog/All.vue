<template>
    <div class="container-fluid">
        <!-- Container-fluid starts -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5>All Blogs</h5>
                        <div>
                            <router-link class="btn btn-outline-warning btn-sm"
                                :to="{ name: `BlogCreate` }">Create</router-link>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-center">
                            <thead>
                                <tr>
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
                                            <a @click.prevent="contact_delete(12)"
                                                class="btn btn-sm btn-outline-danger ">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div>
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
        </div>
        <!-- Container-fluid starts -->
    </div>
</template>

<script>
import { mapActions } from 'pinia'
import { contact_message_store } from './setup/store';
export default {
    created: function () {
        this.contact_all();
    },
    methods: {
        ...mapActions(contact_message_store, {
            contact_all: 'all',
            contact_delete: 'delete',
        })
    }
}
</script>

<style></style>
