<template>
    <div v-if="intensity">
        

        <dl class="mx-auto grid grid-cols-1 gap-px bg-gray-900/5 sm:grid-cols-2 lg:grid-cols-4">
            <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            
                <dt class="text-sm font-medium leading-6 text-gray-500">From - To</dt>
                
                <dd class="w-full flex-none text-xl font-medium leading-10 tracking-tight text-gray-900">
                    {{ intensity.from }} - {{ intensity.to }}
                </dd>

            </div>

            <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            
                <dt class="text-sm font-medium leading-6 text-gray-500">Forecast</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{ intensity.intensity.forecast}}</dd>

            </div>

            <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            
                <dt class="text-sm font-medium leading-6 text-gray-500">Actual</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{ intensity.intensity.actual}}</dd>

            </div>

            <div class="flex flex-wrap items-baseline justify-between gap-x-4 gap-y-2 bg-white px-4 py-10 sm:px-6 xl:px-8">
            
                <dt class="text-sm font-medium leading-6 text-gray-500">Index</dt>
                <dd class="w-full flex-none text-3xl font-medium leading-10 tracking-tight text-gray-900">{{ intensity.intensity.index}}</dd>

            </div>


        </dl>
    
    </div>
    <div v-else>
        loading carbon intensity...
    </div>
</template>

<script>
export default {

    data() {
        return {
            intensity: null,
        }
    },
    mounted() {
        // 'http://localhost:8000/api/intensity'
        fetch('http://localhost:8000/api/intensity')
            .then(
                res => res.json()
            )
            .then((data) => {
                this.intensity = data.data[0]
                const options = {
                    year: 'numeric', 
                    month: 'numeric', 
                    day: 'numeric', 
                    hour: '2-digit', 
                    minute: '2-digit', 
                    timeZoneName: 'short'
                    };
                const formatter = new Intl.DateTimeFormat('en-GB', options);
                let from = new Date(this.intensity.from)
                let to = new Date(this.intensity.to)
                this.intensity.from = formatter.format(from)
                this.intensity.to = formatter.format(to)


            })
            .catch(err => console.log(err.message))
          
    }
    
}
</script>
