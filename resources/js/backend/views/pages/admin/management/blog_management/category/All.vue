<template>
    <div class="container-fluid">
        <!-- Container-fluid starts -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5> {{ page_title }}</h5>
                        <div v-if="cchild_item.length" class="btn-group m-1 "
                            onclick="document.getElementById('table-actions').classList.toggle('show')">
                            <button type="button" class="btn btn-light waves-effect waves-light">Actions</button>
                            <button type="button"
                                class="btn btn-light split-btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light"
                                data-toggle="dropdown" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <div class="dropdown-menu" style="" id="table-actions">
                                <a href="javaScript:void();" class="dropdown-item" @click="bulkActions('delete')">Delete</a>
                                <a href="javaScript:void();" class="dropdown-item" @click="bulkActions('active')">Active</a>
                                <a href="javaScript:void();" class="dropdown-item"
                                    @click="bulkActions('inactive')">Inactive</a>

                            </div>
                        </div>
                        <div>
                            <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `Create${route_prefix}` }">
                                Create</router-link>
                        </div>
                    </div>
                    <div class="card-body table-responsive h-80vh">
                        <table class="table table-hover text-center table-bordered">
                            <thead style="position: sticky;top: -22px">
                                <tr>
                                    <th class="w-10"><input type="checkbox" v-model="parent_item"
                                            @click="toggleParentCheckbox"></th>
                                    <th class="text-start">SL</th>
                                    <th> Name</th>
                                    <th> Status</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item, index) in all_data.data" :key="item.id">
                                    <td class="w-10">
                                        <input @click="toggleChildCheckbox(item.id)"
                                            :checked="cchild_item.includes(item.id)" type="checkbox">
                                    </td>
                                    <td class="text-start">{{ index + 1 }}</td>

                                    <td>{{ item.title }}</td>
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
        {{ cchild_item }}
    </div>
</template>

<script>
import { mapActions, mapState } from 'pinia'
import { blog_category_setup_store } from './setup/store';
import setup from "./setup";
export default {
    data: () => ({
        route_prefix: '',
        page_title: '',
        cchild_item: [],
        parent_item: false,
        show_bulk_action: false
    }),
    created: async function () {
        this.route_prefix = setup.route_prefix;
        this.page_title = setup.page_title;

        await this.get_all_data()
        console.log(this.all_data);
    },
    methods: {
        ...mapActions(blog_category_setup_store, {
            get_all_data: 'all',
            delete_data: 'delete',
            bulk_action: 'bulk_action'
        }),
        toggleParentCheckbox() {
            this.parent_item = !this.parent_item;
            this.cchild_item = this.parent_item ? this.all_data.data.map(item => item.id) : [];
            console.log("dd", this.cchild_item);
        },
        toggleChildCheckbox(index) {
            let ischecked = event.target.checked
            if (ischecked) {
                this.cchild_item.push(index);
            } else {
                this.cchild_item = this.cchild_item.filter(item => item != index);
            }

            console.log(this.cchild_item, index);
        },
        bulkActions(action) {
            this.bulk_action(action, this.cchild_item)
        }

    },

    computed: {
        ...mapState(blog_category_setup_store, {
            all_data: 'all_data'
        }),
        child_item() {
            // Derive child_item based on parent_item and all_data
            return this.parent_item ? [...this.all_data.data.map(() => true)] : [];
        },
    },




}
</script>

<style></style>
