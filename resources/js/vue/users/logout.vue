<template>
    
</template>
<script>
export default {
    mounted:function(){
        if(this.$cookie.delete('auth') && this.$cookie.delete('user')){
            this.$router.push({name:'login'});
        }
        this.$router.push({name:'home'});
    }
}
</script>