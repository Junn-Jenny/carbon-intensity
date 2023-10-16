<template>
    <div class="w-1/2 flex">
        <div class="mr-5">
            <div>From</div>
            <VueDatePicker v-model="from"></VueDatePicker>
        </div>
        <div class="mr-5 ">
            <div>To</div>
            <VueDatePicker v-model="to"></VueDatePicker>
        </div>
        <div>
            <div>&nbsp;</div>
            <button @click="processAverage" type="button"
                class="rounded-full bg-white py-1.5 text-sm px-5 font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Get
                Average</button>

        </div>
    </div>
    <div v-if="intensity" class="mt-5">
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-base font-semibold leading-6 text-gray-900">Carbon Intensity by Date</h1>
                    <p class="mt-2 text-sm text-gray-700">A list of all the <b>Carbon Intensity</b> (fuel with percentage)
                        across United Kingdom</p>
                </div>

            </div>
            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">
                                        &nbsp;</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-900">Actual
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-bold text-gray-900">
                                        Forecast</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                <tr>
                                    <td class="whitespace-nowrap px-3 py-4 text-2xl font-bold text-gray-900 ">Average</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-2xl font-bold text-red-600">{{ intensity.actual  }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-2xl font-bold text-red-600 ">{{ intensity.forecast }}</td>
                                </tr>
                                <tr v-for="(intensitydata, index) in intensity.data" :key="index">
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 ">{{ index + 1 }}</td>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">
                                        {{ intensitydata.intensity.actual }} </td>

                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{
                                        intensitydata.intensity.forecast }} </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
  
<script>
import { ref } from 'vue';
import VueDatePicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default {
    components: { VueDatePicker },
    setup() {
        const from = ref(null);
        const to = ref(null);
        const intensity = ref(null);
        const processAverage = () => {
            let tmpFrom = from.value
            let tmpTo = to.value
            from.value = Date.parse(from.value)
            to.value = Date.parse(to.value)
            let now = new Date()
            if (from.value > to.value) {
                alert('From should not be greater than To.')
                return
            }

            if (from.value > now || to.value > now) {
                alert('From or To should not be greater than Today.')
                return
            }

            if (from.value == to.value) {
                alert('From cannot be equal to To.')
                return
            }
            from.value = String(tmpFrom).substring(4, 33)
            to.value = String(tmpTo).substring(4, 33)
            //console.log(from.value)
            //console.log(to.value)
            fetchData(from.value, to.value)

        }

        const fetchData = async (from, to) => {
            try {
                const url = 'http://localhost:8000/api/average/' + from + '/' + to
                const response = await fetch(url); // Replace with your API endpoint
                const data = await response.json();
                intensity.value = data; 
                from.value = null
                to.value = null// Assuming the API response is an array of items
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
        return {
            from, to, processAverage, intensity, fetchData,
        }
    }
};
</script>
  