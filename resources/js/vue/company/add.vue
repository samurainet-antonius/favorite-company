<template>
    <div class="addCompany">
        <input type="text" v-model="company.company_name"/>
        <input type="number" v-model="company.phone_number"/>
        <font-awesome-icon 
            icon="plus-square"
            @click="addCompany()"
            :class="[company.company_name && company.phone_number ? 'active' : 'inactive', 'plus']" />
    </div>
</template>

<script>
export default {
    data:function(){
        return {
            company:{
                company_name : "",
                phone_number : ""
            }
        }
    },
    methods:{
        addCompany(){
            if(this.company.company_name == ''){
                
            }

            if(this.company.phone_number == ''){
                
            }

            axios.post('api/company/store', {
                company : this.company
            })
            .then(response => {
                if(response.status == 201){
                    this.company.company_name == "";
                }
            })
            .catch(error => {
                console.log( error );
            })
        }
    }
}
</script>

<style scoped>
    .addCompany{
        display: flex;
        justify-content: center;
        align-items: center;
    }

    input{
        background: #f7f7f7;
        border: 0px;
        outline: none;
        padding: 5px;
        margin-right: 10px;
        width: 100%;
    }

    .plus{
        font-size: 20px;
    }

    .active{
        color: #00CE25;
    }

    .inactive{
        color:#9999;
    }
</style>