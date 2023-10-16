<template>
  <div>
    <SideBar/>
    <router-view/>
  </div>
</template>

<script>
import Sidebar from '../components/Sidebar.vue'
export default {
    components:{Sidebar}
}
</script>

