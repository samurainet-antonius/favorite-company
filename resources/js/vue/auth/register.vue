<template>
    <div>
        <div class="row content">
            <div class="col-md-6 mb-3">
                <img :src="showImage()" alt="img" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3 class="sigin-text mb-3">Sign Up</h3>
                    <div class="form-group">
                        <label for="name">Name<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" v-model="users.name">
                        <div class="text-danger">
                            {{ errors.get('name') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" v-model="users.email">
                        <div class="text-danger">
                            {{ errors.get('email') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password<span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" v-model="users.password">
                        <div class="text-danger">
                            {{ errors.get('password') }}
                        </div>
                    </div>

                    <div class="clearfix">
                        <div class="float-left">
                            <div v-if="isDisabled == true">
                                <button :disabled="isDisabled" @click="register()" class="btn btn-class">
                                    <font-awesome-icon icon="spinner"/>
                                    Proccess
                                    </button>
                            </div>
                            <div v-else>
                                <button @click="register()" class="btn btn-class">Create Account</button>
                            </div>
                        </div>
                        <div class="float-right">
                            <p class="mt-2 text-grey">
                                Already a member? <router-link :to="{ name:'login' }">Sign In</router-link>
                            </p>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</template>
<script>
class Errors{

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
        return {
            users:{
                name:null,
                email:null,
                password:null
            },
            errors: new Errors(),
            isDisabled:false,
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
        register(){
            this.isDisabled = true;
            axios.post('/api/auth/register',{
                name:this.users.name,
                email:this.users.email,
                password:this.users.password
            })
            .then(response => {
                this.users.name = '';
                this.users.email = '';
                this.users.password = '';
                if(response.status == 200){
                    this.$fire({
                            title: "Success",
                            text: response.data.success,
                            type: "success",
                            }).then(r => {
                            this.$router.push({name:'login'});
                    });
                }else if(response.status == 400){
                    this.$fire({
                            title: "Error",
                            text: response.data.error,
                            type: "error",
                            timer:3000
                            }).then(r => {
                            this.$router.push({name:'register'});
                    });
                }
                this.isDisabled = false;
            })
            .catch(error => {
                this.errors.record(error.response.data)
                this.isDisabled = false;
            });
            
        },
    }
}
</script>