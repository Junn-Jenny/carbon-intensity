import {createRouter, createWebHistory} from 'vue-router'
import Dashboard from '/resources/js/Dashboard.vue'
import Intensity from '/resources/js/Intensity.vue'
import ByRegion from '/resources/js/ByRegion.vue'
import ByEnergy from '/resources/js/ByEnergy.vue'
import ByCountry from '/resources/js/ByCountry.vue'
import ByDate from '/resources/js/ByDate.vue'
import Test from '@/js/Test.vue'

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
        path:'/bydate',
        name:'ByDate',
        component:ByDate
    },
    {
        path:'/bycountry/:country',
        name:'ByCountry',
        component:ByCountry,
        props: true,
    },

]

const router = createRouter({
    history: createWebHistory(),
    routes, linkActiveClass: 'bg-indigo-700 text-white',
})
export default router
