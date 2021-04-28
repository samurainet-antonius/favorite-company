<template>
    <div>
        <div class="row content mt-10">
            <div class="col-md-12">
                <h2 class="text-center text-bold">Forgot Password?</h2>
                <div class="mt-3">
                    <p class="text-grey">Enter the email address you used when you joined and we’ll send you instructions to reset your password.
                        <br/>
                        For security reasons, we do NOT store your password. So rest assured that we will never send your password via email.
                    </p>
                </div>
                <div class="text-left mt-4">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" v-model="users.email">
                        <div class="text-danger">
                            {{ errors.get('email') }}
                        </div>
                    </div>
                    <div v-if="isDisabled == true">
                                <button :disabled="isDisabled" @click="login()" class="btn btn-class">
                                    <font-awesome-icon icon="spinner"/>
                                    Proccess
                                </button>
                            </div>
                            <div v-else>
                                <button @click="sendToken()" class="btn btn-class"> Send Reset Intructions </button>
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
        return {
            users:{
                email:'',
            },
            isDisabled :false,
            errors:new Error()
        }
    },
    mounted:function(){
        if(this.$cookie.get('auth')){
            this.$router.push({name:'home'});
        }
    },
    methods:{
        sendToken(){
            this.isDisabled = true;
            axios.post('/api/auth/requestToken',{
                email : this.users.email
            })
            .then(response =>{
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
            })
            .catch(error => {
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
            })
        }
    },
}
</script>
<style scoped>
    .text-grey{
            font-size: 14px;
            color:#495057
        }
</style>