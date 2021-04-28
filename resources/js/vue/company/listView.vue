<template>
    <div>
        <div v-for="(company, index) in companies" :key="index">
            <list-item-company
            :company="company"
            class="item"/>
        </div>
    </div>
</template>
<script>
import listItemCompany from "./listItem"

export default {
    props:['companies'],
    components: { 
        listItemCompany 
    }
}
</script>

<style scoped>
    .item{
        background: #e6e6e6;
        padding: 5px;
        margin-top: 5px;
    }
</style>