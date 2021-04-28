<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item" :class="menu == 'home' ? 'active' : ''">
                        <router-link class="nav-link" :to="{name:'home'}">Home</router-link>
                    </li>
                    <li class="nav-item" :class="menu == 'favorite' ? 'active' : ''">
                        <router-link class="nav-link" :to="{name:'favorite'}">Favourite Company</router-link>
                    </li>
                </ul>

                <ul class="navbar-nav my-2 my-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name:'logout'}">Logout</router-link>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</template>
<script>
export default {
    data:function(){
      return {
          active : false,
          menu: ''
      }  
    },
    mounted:function(){
        this.menu = this.$route.name;
    }
}
</script>