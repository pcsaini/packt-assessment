<template>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="d-flex align-items-center">
                    <div class="w-100">
                        <div class="row justify-content-center">
                            <div class="col-lg-4">
                                <div class="card mt-5">
                                    <div class="text-center">
                                        <h4 class="mt-5">Sign in to continue to Packt+ Admin.</h4>
                                    </div>

                                    <div class="p-5">
                                        <form @submit.prevent="submitLogin">
                                            <div class="form-group mb-4">
                                                <label for="email">Email</label>
                                                <input
                                                    type="email"
                                                    v-model="login.email"
                                                    class="form-control"
                                                    id="email"
                                                    placeholder="Enter email"
                                                    :class="{ 'is-invalid': submitted && v$.login.email.$error }"
                                                />
                                                <div v-if="submitted && v$.login.email.$error"
                                                     class="invalid-feedback">
                                                    <span
                                                        v-if="v$.login.email.required.$invalid">Email is required.</span>
                                                    <span
                                                        v-if="v$.login.email.email.$invalid">Please enter valid email.</span>
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="password">Password</label>
                                                <input
                                                    v-model="login.password"
                                                    type="password"
                                                    class="form-control"
                                                    id="password"
                                                    placeholder="Enter password"
                                                    :class="{ 'is-invalid': submitted && v$.login.password.$error }"/>
                                                <div v-if="submitted && v$.login.password.required.$invalid"
                                                     class="invalid-feedback">Password is required.
                                                </div>
                                            </div>

                                            <div class="mt-4 text-center">
                                                <button class="btn btn-primary w-md waves-effect waves-light"
                                                        type="submit" :disabled="loader">
                                                    <template v-if="loader">Login...
                                                    </template>
                                                    <template v-else>Login</template>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
import {email, required} from "@vuelidate/validators";
import {apiService} from "@/helpers/api.service";
import useVuelidate from "@vuelidate/core";
import router from "@/routes";
import {useToast} from "vue-toastification";
const toast = useToast()
export default {
    setup() {
        return {v$: useVuelidate()}
    },
    data() {
        return {
            submitted: false,
            loader: false,
            login: {
                email: '',
                password: ''
            }
        };
    },
    validations() {
        return {
            login: {
                email: {required, email},
                password: {required}
            }
        }
    },
    methods: {
        submitLogin() {
            this.submitted = true;
            // stop here if form is invalid
            this.v$.login.$touch();

            if (this.v$.login.$invalid) {
                return false;
            }

            this.loader = true

            apiService.login(this.v$.login.$model)
                .then((res) => {
                    if (res?.status) {
                        localStorage.setItem('token', res?.auth_token)
                        localStorage.setItem('user', JSON.stringify(res?.data?.user))

                        toast.success('Login Successfully')
                        router.push({name: 'dashboard'})
                    } else {
                        if(res?.message) {
                            toast.error(res?.message)
                        }
                    }
                })
                .finally(() => {
                    this.loader = false
                })
        }
    }
}
</script>
