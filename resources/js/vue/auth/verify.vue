<template>
    <div>
        <div class="row content mt-10">
            <div class="col-md-12">
                <div v-if="isProccess == true">
                    <h1 class="text-center text-bold">
                        <font-awesome-icon icon="spinner"/>
                        Proccess
                    </h1>    
                </div>
                <div v-else>
                    <div v-if="status == true">
                        <h1 class="text-center text-bold">Welcome, Antonius!</h1>
                        <p>Congratulations the account will be activated successfully, please click the link below to log in to your account page. </p>
                        <div class="text-center mt-4">
                            <router-link class="btn btn-class" :to="{ name:'login' }">Sign In Now</router-link>
                        </div>
                    </div>
                    <div v-else>
                        <h1 class="text-center text-bold">Error!</h1>
                        <p>Your account activation token has not passed, it may be that the existing account is already active. </p>
                        <div class="text-center mt-4">
                            <router-link class="btn btn-class" :to="{ name:'login' }">Back To Home</router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data:function(){
        return {
            status : false,
            token : '',
            params : this.$route.params.token,
            isProccess : true,
        }
    },
    mounted:function(){
        if(this.$cookie.get('auth')){
            this.$router.push({name:'home'});
        }
        this.verifyAccount();
    },
    methods:{
        verifyAccount(){
            axios.post('/api/auth/verify',{
                token:this.params
            }).then(response =>{
                console.log(response.data);
                if(response.status == 200){
                    this.status = true;
                }else if(response.status == 400){
                    this.status = false;
                }
                this.isProccess = false;
            }).catch(error => {
                console.log(error);
                this.isProccess = false;
            });
        }
    },
}
</script>
<style>
    .mt-10{
        margin-top: 15%;
    }
</style>