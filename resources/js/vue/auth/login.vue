<template>
    <div>
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img :src="showImage()" alt="img" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3 class="sigin-text mb-3">Sign In</h3>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" v-model="users.email">
                        <div class="text-danger">
                            {{ errors.get('email') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="clearfix">
                            <label for="password">Password</label>
                            <div class="float-right">
                                <p class="text-grey">
                                    <router-link :to="{ name:'password_resets_new' }">Forgot password? </router-link>
                                </p>
                            </div>
                        </div>
                        
                        <input type="password" class="form-control" v-model="users.password">
                        <div class="text-danger">
                            {{ errors.get('password') }}
                        </div>
                    </div>

                    <div class="clearfix">
                        <div class="float-left">
                            <div v-if="isDisabled == true">
                                <button :disabled="isDisabled" class="btn btn-class">
                                    <font-awesome-icon icon="spinner"/>
                                    Proccess
                                </button>
                            </div>
                            <div v-else>
                                <button @click="login()" class="btn btn-class"> Login </button>
                            </div>
                        </div>
                        <div class="float-right">
                            <p class="mt-2 text-grey">
                                Not a member? <router-link :to="{ name:'register' }">Sign Up Now</router-link>
                            </p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
class Error{

    constructor(){
        this.errors = {};
    }

    get(field){
        if(this.errors[field]){
            return this.errors[field][0];
        }
    }

    record(errors){
        this.errors = errors.errors;
    }
}


export default {
    data:function(){
        return{
            users:{
                email:'',
                password:'',
            },
            user:{},
            token:'',
            isDisabled:false,
            errors:new Error()
        }
    },
    mounted:function(){
        if(this.$cookie.get('auth')){
            this.$router.push({name:'home'});
        }
    },
    methods:{
        showImage(){
            return 'img/img-login.svg'
        },
        login(){
                this.isDisabled = true;
                axios.post('/api/auth/login',{
                    email:this.users.email,
                    password:this.users.password
                }).then(response => {
                    if(response.status === 200){
                        this.token = response.data.access_token;
                        this.user = response.data.user.id;
                        this.$cookie.set("auth",this.token);
                        this.$cookie.set("user",this.user);
                        this.$fire({
                            title: "Success",
                            text: response.data.success,
                            type: "success",
                            timer: 3000,
                            }).then(r => {
                            this.$router.push({name:'home'});
                        });
                    }
                    this.isDisabled = false;
                }).catch(error => {
                    if(!error.response.data.error){
                        this.errors.record(error.response.data)
                    }else{
                        this.$fire({
                            title: "Error",
                            text: error.response.data.error,
                            type: "error",
                            }).then(r => {
                            this.$router.push({name:'register'});
                    });
                    }
                    this.isDisabled = false;
                });

                this.users.email = '';
                this.users.password = '';
            }
    }
}
</script>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body{
        font-family: 'Poppins', sans-serif;
        background-color: #00ac96;
    }

    .content{
        margin: 8%;
        background-color: #fff;
        padding: 4rem 1rem 4rem 1rem;
        box-shadow: 0 0 5px 5px rgba(0, 0, 0, .05);
    }

    .sigin-text{
        font-style: normal;
        font-weight: 600 !important;
    }

    .form-control{
        display: block;
        width: 100%;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        border-color: #00ac96 !important;
        border-style: solid !important;
        border-width: 0 0 1px 0 !important;
        padding: 0px !important;
        color: #495057;
        height: auto;
        border-radius: 0;
        background-color: #fff;
        background-clip: padding-box;

    }

    .form-control:focus{
        color: #495057;
        background-color: #fff;
        border-color: #fff;
        outline: 0;
        box-shadow: none;
    }

    .btn-class{
        border-color: #00ac96;
        color: #00ac96;
    }

    .btn-class:hover{
        background-color: #00ac96;
        color: #fff;
    }

    .text-grey{
        font-size: 14px;
        color:#495057
    }

    .text-grey a{
        color:#00ac96;
    }

    @keyframes spinner {
    to { transform: rotate(360deg); }
    }
    /* This is the class name given by the Font Awesome component when icon contains 'spinner' */
    .fa-spinner {
    /* Apply 'spinner' keyframes looping once every second (1s)  */
    animation: spinner 1s linear infinite;
    }
</style>