<template>
    <div>
        <div class="row content">
            <div class="col-md-12 p-5">
                <h3 class="sigin-text text-center mb-5">Reset your password</h3>
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" v-model="users.password">
                        <div class="text-danger">
                            {{ errors.get('password') }}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Confirm New Password</label>
                        <input type="password" class="form-control" v-model="users.confirm_password">
                        <div class="text-danger">
                            {{ errors.get('confirm_password') }}
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
                                <button @click="changePassword()" class="btn btn-class"> Reset my password </button>
                            </div>
                        </div>
                        <div class="float-right">
                            <router-link class="btn btn-outline-dark" :to="{name:'login'}">
                                Back to login
                            </router-link>
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
                confirm_password:'',
                password:'',
            },
            token : this.$route.params.token,
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
        changePassword(){
                this.isDisabled = true;
                axios.post('/api/auth/changePassword',{
                    password:this.users.password,
                    confirm_password:this.users.confirm_password,
                    token:this.token,
                }).then(response => {
                    if(response.status === 200){
                        this.$fire({
                            title: "Success",
                            text: response.data.success,
                            type: "success",
                            timer: 3000,
                            }).then(r => {
                            this.$router.push({name:'login'});
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
                            });
                    }
                    this.isDisabled = false;
                });
                this.users.password = '';
                this.users.confirm_password = '';
            }
    }
}
</script>