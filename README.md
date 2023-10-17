# Educake Code Test – API

Develop a small app that consumes a simple API of your choice and presents
that in a basic UI.

You can do this entirely client side or preferably demonstrate your PHP skills by
fetching and processing data server side. The app should show some simple
querying and aggregating capabilities.

A good example of a suitable API, which you may use if you wish is:
https://carbon-intensity.github.io/api-definitions/#carbon-intensity-api-v2-0-0
This would allow the app to get data for a particular region, filter it by energy
generation type and possibly show the average for a period of time.

Please don’t spend more than 2 – 3 hours on this assignment. It doesn’t need
to be production quality but it would be good to see some abstraction and also
some unit testing.

We will discuss your submission in an interview so you will get a chance to
justify your choices and omissions.

## Dashboard
![Dashboard](https://i.imgur.com/sdSQyfT.png)

![ByRegion](https://i.imgur.com/x4FI363.jpg)

![ByEnergy](https://i.imgur.com/A6sHE1l.jpg)

![ByDate](https://i.imgur.com/Kv2FCOx.png)

## Testing API

```
emera@huni MINGW64 /c/repository/test/carbon-intensity (main)
$ php artisan test

   WARN  Your XML configuration validates against a deprecated schema. Migrate your XML configuration using "--migrate-configuration"!

   PASS  Tests\Feature\IntensityApiTest
  ✓ it intensity has a  esponse                                                                                                                                                                               0.28s  
  ✓ it reach the endpoint and status ok                                                                                                                                                                       0.19s  
  ✓ it attributes exist in an endpoint                                                                                                                                                                        0.31s  
  ✓ it three attributes exist in an endpoint                                                                                                                                                                  0.25s  
  ✓ it attributes from and to should be date time                                                                                                                                                             0.24s  

  Tests:    5 passed (10 assertions)
  Duration: 1.39s
```

## Api Route

```
Route::get('/intensity', [CarbonIntensity::class,'intensity']);
Route::get('/regionlist', [CarbonIntensity::class,'regionlist']);
Route::get('/region/{regionid}', [CarbonIntensity::class,'byregion']);
Route::get('/energy', [CarbonIntensity::class,'byenergy']);
Route::get('/average/{from}/{to}', [CarbonIntensity::class,'average']);
```

## PHP Process and Consume third party API

```
    public function average(Request $request) 
    {
        $from = date('Y-m-dTH:i', strtotime($request->from) );
        $to = date('Y-m-dTH:i', strtotime($request->to));

        $path = '/intensity/'. $from.'/'. $to;
        $response = Http::get($this->api . $path);
        $data = $response->json()['data'];
        $actual = $forecast = 0;
        foreach($data as $temp) {
            $actual += $temp['intensity']['actual'];
            $forecast += $temp['intensity']['forecast'];
            
        }
       
        return response([
            'data' => $data,
            'actual' => round($actual/count($data),2),
            'forecast' => round($forecast/count($data),2)
    ]);
```

A Laravel 10 Single Page Application using Vue.js 3 and  Vite

### Common way

Rename the .env.example file to .env, and fill it with your local info, then:

Install PHP and JavaScript dependencies:

    composer install
    npm install

Generate Laravel keys:

    php artisan key:generate
    
    
Run the Vite development server...

      npm run dev
 
Build and version the assets for production...

      npm run build

Frontend  

```
      http://localhost:8000
```

### Note (Please dont forget to add in .env file)

```
NATIONAL_GRID_API=https://api.carbonintensity.org.uk
```


