<template>
    <div>
        <div class="card">
            <div class="card-header">Create new blog category</div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label for="input-11">Name</label>
                        <input type="text" class="form-control form-control-square" id="input-11">
                    </div>
                    <div class="form-group">
                        <label for="input-12">Email</label>
                        <input type="text" class="form-control form-control-square" id="input-12">
                    </div>
                    <div class="form-group">
                        <label for="input-13">Mobile</label>
                        <input type="text" class="form-control form-control-square" id="input-13">
                    </div>
                    <div class="form-group">
                        <label for="input-14">Password</label>
                        <input type="text" class="form-control form-control-square" id="input-14">
                    </div>
                    <div class="form-group">
                        <label for="input-15">Confirm Password</label>
                        <input type="text" class="form-control form-control-square" id="input-15">
                    </div>
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
import { contact_message_store } from './setup/store';
export default {
    created: function () {
    },
    methods: {
        ...mapActions(contact_message_store, {
            store_message: 'store',
        })
    }
}
</script>

<style></style>
