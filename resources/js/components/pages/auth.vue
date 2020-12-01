<template>
    <div class="d-flex justify-content-center">
        <div class="container no-gutters authContainer">
            <div class="row">
                <div class="col-12 authCol">
                    <div class="AuthHeading text-center ">
                        Welcome to OnlineShopper
                    </div>
                    <div :style="{display:signInScreen?'block':'none'}">
                        <form>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input
                                        type="email"
                                        v-model="signin.email"
                                        class="form-control signinEntry"
                                        placeholder="Email"
                                    />
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input
                                        type="password"
                                        class="form-control signinEntry"
                                        placeholder="password"
                                        v-model="signin.password"
                                    />
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col text-left">
                                    <input
                                        type="checkbox"
                                        class="form-control chkKeepSigned"
                                        v-model="signin.keepSigned"
                                    />
                                    <a href="" class="forgotPass">
                                        Keep me signed in
                                    </a>
                                </div>
                                <div class="col text-right">
                                    <a href="" class="forgotPass">
                                        Forgot password?
                                    </a>
                                </div>
                            </div>
                            <div class="form-row mb-3 text-center">
                                <div class="col">
                                    <button
                                        type="button"
                                        class="btn btn-auth btn-warning btn-signin"
                                        @click="cpSignin()"
                                    >
                                        Sign in
                                    </button>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col text-center signUpWrap">
                                    Don't have an account?&nbsp;
                                    <a href="" class="signUp" @click.prevent="signInScreen=false">
                                        Sign Up
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div :style="{display:signInScreen?'none':'block'}">
                        <form>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input
                                        type="text"
                                        v-model="signup.username"
                                        class="form-control signinEntry"
                                        placeholder="Username"
                                    />
                                </div>
                                <div class="col">
                                    <input
                                        type="text"
                                        v-model="signup.address"
                                        class="form-control signinEntry"
                                        placeholder="address"
                                    />
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input
                                        type="email"
                                        v-model="signup.email"
                                        class="form-control signinEntry"
                                        placeholder="Email"
                                    />
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input
                                        type="password"
                                        v-model="signup.password"
                                        class="form-control signinEntry"
                                        placeholder="Password"
                                    />
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col">
                                    <input
                                        type="password"
                                        v-model="signup.conf_password"
                                        class="form-control signinEntry"
                                        placeholder="Confirm Password"
                                    />
                                </div>
                            </div>
                            <div class="form-row mb-3 text-center">
                                <div class="col">
                                    <button
                                        type="button"
                                        class="btn btn-auth btn-warning btn-signin"
                                        @click="cpSignup()"
                                    >
                                        Sign up
                                    </button>
                                </div>
                            </div>
                            <div class="form-row mb-3">
                                <div class="col text-center signUpWrap">
                                    Have an account?&nbsp;
                                    <a href="" class="signUp" @click.prevent="signInScreen=true">
                                        Sign In
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/javascript">
    export default {
        data(){
            return {
                signInScreen: true,
                signin:{
                    email:"",
                    password:"",
                    keepSigned:""
                },
                signup:{
                    username:"",
                    email:"",
                    password:"",
                    conf_password:"",
                    address:""
                }
            }
        },
        methods:{
            cpSignin: function(){
                axios.post("api/login/",{
                    // username:this.signup.username,
                    // email:this.signup.email,
                    // password:this.signup.password,
                    // password_confirmation:this.signup.conf_password,
                    // address:this.signup.address
                })
                .then(
                    // response => this.products = response.data
                    response => console.log(response.data)
                )
            },
            cpSignup: function(){
                axios.post("api/register/",{
                    username:this.signup.username,
                    email:this.signup.email,
                    password:this.signup.password,
                    password_confirmation:this.signup.conf_password,
                    address:this.signup.address
                })
                .then(
                    // response => this.products = response.data
                    response => console.log(response.data)
                )
            }
            //php artisan vendor:publish --tags=passport-components
        }
    }
</script>

<style scoped>
.authContainer{
    max-width: 700px;
}

.authCol{
    padding: 95px;
}
.AuthHeading{
    font-size: 20px;
    margin-bottom: 20px;
}

.chkKeepSigned{
    display: inline;
    width: auto;
    height: auto;
    margin-right: 5px;
}

.btn-label {
    position: relative;
    left: -26px;
    display: inline-block;
    padding: 6px 12px;
    background: rgba(0,0,0,0.15);
    border-radius: 3px 0 0 3px;
    width: 31.88px;
}

.btn-label-google{
    width: 34px;
}

.btn-text {
    position: relative;
    display: inline-block;
    width: 55.25px;
}

.btn-labeled {
    padding-top: 0;
    padding-bottom: 0;
    border: none;
}

.btn-auth {
    margin-bottom:10px;
    min-width: 140px;
}

.btn-facebook{
    color: #fff;
    background-color:#3b5998;
}

.btn-google{
    color: #fff;
    background-color:#d62d20;
}

</style>
