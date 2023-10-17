<template>
  <div v-if="country">
    <div class="px-4 sm:px-6 lg:px-8">
      <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
          <h1 class="text-base font-semibold leading-6 text-gray-900">
            Carbon Intensity in {{ props.country.toUpperCase() }}
          </h1>
          <p class="mt-2 text-sm text-gray-700">
            A list of all the <b>Carbon Intensity</b> (fuel with percentage)
            across United Kingdom
          </p>
        </div>
      </div>
      <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div
            class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8"
          >
            <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th
                    scope="col"
                    class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0"
                  >
                    &nbsp;
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                  >
                    Fuel
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                  >
                    Pecentage
                  </th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200">
                <tr
                  v-for="(reg, index) in country.data[0].generationmix"
                  :key="index"
                >
                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ index + 1 }}
                  </td>
                  <td
                    class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-0"
                  >
                    {{ reg.fuel.toUpperCase() }}
                  </td>

                  <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                    {{ reg.perc }} %
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else>
      loading...
  </div>
</template>
  
  <script setup>
import { ref, onMounted, watchEffect } from "vue";
const props = defineProps(["country"]);
const country = ref(null);
const isCountryLoaded = ref(false)
const fetchData = async () => {
  try {
    const response = await fetch(
      "http://localhost:8000/api/country/" + props.country
    ); // Replace with your API endpoint
    const data = await response.json();
    country.value = data.data[0]; // Assuming the API response is an array of items
    isCountryLoaded.value = true
  } catch (error) {
    console.error("Error fetching data:", error);
  }
};

 onMounted(() => {
   fetchData();
 });

watchEffect(fetchData)
</script>
  