<template>
    <div>
        <div class="margin-8">
            <app-menu></app-menu>
        </div>
        <div class="content">
            <div class="row ">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="company">Search Company</label>
                        <input type="text" class="form-control" v-model.trim="search" @keyup="favouriteCompany()">
                        <div class="text-danger">
                            {{ error }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="clearfix">
                        <h3 class="sigin-text mb-3 float-left">List Favourite Company</h3>
                        <div v-if="isDisabled == true">
                                <button :disabled="isDisabled" class="btn btn-danger float-right">
                                    <font-awesome-icon icon="spinner"/>
                                    Proccess
                                </button>
                        </div>
                        <div v-else>
                            <button class="btn btn-danger float-right" :class="hidden == true ? 'd-none' : ''" @click="remove()">Remove Favourite</button>
                        </div>
                    </div>
                    <div v-if="loading == true" class="mt-5">
                        <h4 class="text-center">
                            <font-awesome-icon icon="spinner"/> Proccess
                        </h4>
                    </div>
                    <div v-else>
                        <div class="scroll" v-if="companies.length > 0">
                            <ul class="list-group" v-for="(company,index) in companies" :key="index">
                                <li class="list-group-item mb-2">
                                    <input type="checkbox" v-on:click="addCheck" v-bind:id="index" v-bind:value="company.id" v-model="checked"> {{ company.company_name }}
                                    <br/>
                                    {{ company.phone_number }} - {{ company.address }}
                                </li>
                            </ul>
                        </div>
                        <div v-else>
                            <div class="alert alert-warning">Company not found.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

import Menu from '../components/menu';

export default {
    data:function(){
        return {
            companies : {},
            search:'',
            error:'',
            loading:true,
            checked:[],
            hidden:true,
            isDisabled:false
        }
    },
    components: {
      'app-menu': Menu
    },
    mounted:function(){
        if(!this.$cookie.get('auth')){
            this.$router.push({name:'login'});
        }
        this.favouriteCompany();
    },
    methods:{
        favouriteCompany(){
            axios.get('/api/user/companies',{
                headers:{
                    'Authorization' : this.$cookie.get('auth'),
                    'x-member' : this.$cookie.get('user'),
                }
            })
            .then(res => {
                if (this.search.length > 2) {
                    this.companies = res.data.filter(companies =>
                    companies.company_name.toLowerCase().includes(this.search.toLowerCase())
                    );
                    this.error = ''
                    this.loading = false
                } else if( this.search.length <= 2 && this.search.length != 0 && this.search != ''){
                    this.error = 'Enter more than 2 characters.'
                    this.loading = false
                } else {
                    this.companies = res.data;
                    this.error = ''
                    this.loading = false
                }
            });
        },
        addCheck(event){
            if(event.target.checked){
                this.checked.push(event.target.value);
            }else{
                this.checked.splice(event.target.id,1);
            }
            
            (this.checked.length > 0) ? this.hidden = false : this.hidden = true;
        },

         remove(){
            this.isDisabled = true;
            axios.delete('/api/user/removeFavourite',{
                data:{
                    company:this.checked,
                    x_member:this.$cookie.get('user')
                }
            })
            .then(response => {
                if(response.status === 200){
                        this.$fire({
                            title: "Success",
                            text: response.data.success,
                            type: "success",
                            timer: 3000,
                            }).then(r => {
                            location.reload(true);
                        });
                    }
                    this.isDisabled = false;
            })
            .catch(error => {
                this.$fire({
                            title: "Error",
                            text: error.response.data.error,
                            type: "error",
                            }).then(r => {
                            this.$router.push({name:'favorite'});
                    });
                    this.isDisabled = false;
            })
        }
    },
}
</script>
<style scoped>
    body{
        background: #fff !important;
    }
    .margin-8{
        margin:8%;
    }
</style>