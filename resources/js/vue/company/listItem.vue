<template>
    <div class="item">
        <li class="list-group-item">
            <input type="checkbox" /> {{ company.company_name }}
            <button @click="removeItem()" class="trashcan">
                <font-awesome-icon icon="trash"/>
            </button>
        </li>
    </div>
</template>
<script>
export default {
    props: ['company'],
    methods:{
        // remove
    }
}
</script>
<style scoped>
    .item{
        display: flex;
        justify-content: center;
        align-content: center;
    }

    .itemText{
        width: 100%;
        margin-left: 20px;
    }

    .trashcan{
        background: #e6e6e6;
        border: none;
        color: #FF0000;
        outline: none;
    }
</style>