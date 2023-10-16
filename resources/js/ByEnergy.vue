<template>
    <div>
      <h1>Select Energy to view </h1>
      
      <select @change="handleSelectionChange" v-model="selectedItem">
        <option value="">Select an Energy</option>
        <option v-for="(item, index) in items" :key="index" :value="item[0].energy">{{ item[0].energy }}</option>
      </select>
      
      <div v-if="energyFilter[0]" class="mt-5">
           

        <div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
      <div class="sm:flex-auto">
        <h1 class="text-base font-semibold leading-6 text-gray-900">Carbon Intensity by Energy</h1>
        <p class="mt-2 text-sm text-gray-700">A list of all the <b>Carbon Intensity</b> (fuel with percentage) across United Kingdom</p>
      </div>
      
    </div>
    <div class="mt-8 flow-root">
      <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
          <table class="min-w-full divide-y divide-gray-300">
            <thead>
              <tr>
                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Region ID</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Region</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Region Shortname</th>
                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Percentage</th>

              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
              <tr v-for="(energy, index) in energyFilter" :key="index">
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500 ">{{ energy.data.regionid }}</td>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ energy.data.dnoregion }} </td>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ energy.data.shortname }} </td>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0">{{ energy.data.perc }} %</td>
                
                
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
    const energyFilter = ref([]);
    const fetchData = async () => {
        try {
            const response = await fetch('http://localhost:8000/api/energy'); // Replace with your API endpoint
            const data = await response.json();
            items.value = data; // Assuming the API response is an array of items
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    };

      const handleSelectionChange = (event) => {
        // Access the selected value from the event
        const selectedValue = event.target.value;
        selectedItem.value = selectedValue;
        energyData(selectedItem.value);
        // You can perform actions based on the selected value here
        //console.log('Selected Item Changed:', selectedItem.value);
      };
      
      const energyData = async (energy) => {
        let data = items.value
        console.log(data[energy])
        energyFilter.value = data[energy]
        
      };
        onMounted(() => {
            fetchData();
        });

      return {
        items,
        selectedItem,
        handleSelectionChange,
        energyFilter,
        
      };
    },
  };
  </script>
  