<template>
    <div>
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5>Create new {{ route_prefix }}</h5>
                <div>
                    <router-link class="btn btn-outline-warning btn-sm" :to="{ name: `All${route_prefix}` }">All {{
                        route_prefix }}</router-link>
                </div>
            </div>
            <div class="card-body">
                <form>
                    <template v-for="(form_field, index) in form_fields" :key="index">
                        <common-input :label="form_field.label" :type="form_field.type" :name="form_field.name"
                            :multiple="form_field.multiple" :value="form_field.value" :data_list="form_field.data_list" />
                    </template>


                    <div class="form-group py-2">
                        <div class="icheck-material-white">
                            <input type="checkbox" id="user-checkbox3" checked="">
                            <label for="user-checkbox3">I Agree Terms &amp; Conditions</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-light btn-square px-5"><i class="icon-lock"></i>
                            Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions } from 'pinia'
import { user_setup_store } from './setup/store';
import setup from "./setup";
import form_fields from "./setup/form_fields";
export default {
    data: () => ({
        route_prefix: '',
        form_fields,
        param_id: null,
    }),
    created: function () {
        this.route_prefix = setup.route_prefix;
    },
    methods: {
        ...mapActions(user_setup_store, {
            store_message: 'store',
        }),

        submitHandler: async function ($event) {
            if (this.param_id) {
                this.user_update($event.target, this.param_id);
            } else {
                let response = await this.user_store($event.target);
                if (response.data.status === "success") {
                    window.s_alert("Data successfully created");
                    this.$router.push({ name: `AllUser` });
                }
            }
        },
    },


}
</script>

<style></style>
