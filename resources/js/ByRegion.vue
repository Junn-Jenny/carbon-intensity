<template>
    <div>
      <h1>Select Region to view </h1>
      <select @change="handleSelectionChange" v-model="selectedItem">
        <option value="">Select an Region</option>
        <option v-for="item in items" :key="item.regionid" :value="item.regionid">{{ item.dnoregion }}</option>
      </select>
      
      <div v-if="region[0]" class="mt-5">
           

        <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Carbon Intensity by Region</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the <b>Carbon Intensity</b> (fuel with percentage) across United Kingdom</p>
      </div>
      
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">&nbsp;</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Fuel</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Pecentage</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="(reg, index) in region[0].data[0].generationmix" :key="index">
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 ">{{ index + 1 }}</td>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ reg.fuel.toUpperCase() }} </td>
                
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ reg.perc }} %</td>
                
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

           
        </div>

    </div>
  </template>
  
  <script>
  import { ref, onMounted } from 'vue';
  
  export default {
    setup() {
        
  
    const selectedItem = ref('');
    const items = ref([]);    
    const region = ref([]);
    const fetchData = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/regionlist'); // Replace with your API endpoint
            const data = await response.json();
            items.value = data.data; // Assuming the API response is an array of items
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };
      const handleSelectionChange = (event) => {
        // Access the selected value from the event
        const selectedValue = event.target.value;
        selectedItem.value = selectedValue;
        regionData(selectedItem.value);
        // You can perform actions based on the selected value here
        console.log('Selected Item Changed:', selectedItem.value);
      };
      const updateData = async (id) => {
            try {
                const response = await fetch('http://localhost:8000/api/region/' + id); // Replace with your API endpoint
                const data = await response.json();
                region.value = data.data; // Assuming the API response is an array of items
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
      const regionData = async (id) => {
            try {
                const response = await fetch('http://localhost:8000/api/region/' + id); // Replace with your API endpoint
                const data = await response.json();
                region.value = data.data; // Assuming the API response is an array of items
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        };
        onMounted(() => {
            fetchData();
        });

      return {
        items,
        selectedItem,
        handleSelectionChange,
        region,
        updateData
      };
    },
  };
  </script>
  