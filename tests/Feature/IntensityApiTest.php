<?php
use Illuminate\Http\Client\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

it( 'intensity has a response ', function() {
    $response = Http::get('https://api.carbonintensity.org.uk');    
    expect(
        value: $response, 
    )->toBeInstanceOf(
        class: Response::class,
    );

});

it( 'reach the endpoint and status ok', function() {
    $response = Http::get('https://api.carbonintensity.org.uk');    
    expect(
        value: $response->status()
    )->toBe(200);
    

});

it( 'attributes exist in an endpoint', function() {
    $response = Http::get('https://api.carbonintensity.org.uk/intensity');  
    $attributes = array_keys($response->json()['data'][0]);    

    expect(
        value: $attributes
    )->toHaveAttribute('to');
    expect(
        value: $attributes
    )->toHaveAttribute('from');
    expect(
        value: $attributes
    )->toHaveAttribute('intensity');

});

it( 'three attributes exist in an endpoint', function() {
    $response = Http::get('https://api.carbonintensity.org.uk/intensity');  
    
    $attributes = array_keys($response->json()['data'][0]['intensity']);    

    expect(
        value: $attributes
    )->toHaveAttribute('forecast');
    expect(
        value: $attributes
    )->toHaveAttribute('actual');
    expect(
        value: $attributes
    )->toHaveAttribute('index');
  
});

it( 'attributes from and to should be date time', function() {


    $response = Http::get('https://api.carbonintensity.org.uk/intensity');      

    $fromAttributes = $response->json()['data'][0]['from'];    
    $toAttributes = $response->json()['data'][0]['to'];    

    $now = Carbon::now('UTC')->format('Y-m-dTH:i');

    expect(
        value: $fromAttributes
    )->toHaveAttribute($now);
   
    expect(
        value: $toAttributes
    )->toHaveAttribute($now);

});