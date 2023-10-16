import {createRouter, createWebHistory} from 'vue-router'
import Dashboard from '/resources/js/Dashboard.vue'
import Intensity from '/resources/js/Intensity.vue'
import ByRegion from '/resources/js/ByRegion.vue'
import ByEnergy from '/resources/js/ByEnergy.vue'
import England from '/resources/js/England.vue'
import ByDate from '/resources/js/ByDate.vue'

const routes = [
    {
        path:'/',
        name:'Dashboard',
        component:Dashboard
    },
    {
        path:'/intensity',
        name:'Intensity',
        component:Intensity
    },
    {
        path:'/byregion',
        name:'ByRegion',
        component:ByRegion
    },
    {
        path:'/byenergy',
        name:'ByEnergy',
        component:ByEnergy
    },
    {
        path:'/england',
        name:'England',
        component:England
    },
    {
        path:'/bydate',
        name:'ByDate',
        component:ByDate
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes
})
export default router