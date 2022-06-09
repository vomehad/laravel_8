@extends('layouts.app')
@section('content')
    @php
    /** @var array $source */
    /** @var array $bubbled */
    @endphp

    <!-- Import the component -->
    <script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>

    <!-- Use it like any other HTML element -->
    <model-viewer alt="Neil Armstrong's Spacesuit from the Smithsonian Digitization Programs Office and National Air and Space Museum"
                  style="width: 100%; height: 100%;"
                  src="state_historical_museum.glb"
                  ar
                  ar-modes="webxr scene-viewer quick-look"
                  poster="shared-assets/models/NeilArmstrong.webp"
                  seamless-poster shadow-intensity="1"
                  camera-controls enable-pan></model-viewer>
   {{-- <form action=""></form>
    <input type="number" value="{{}}" />--}}
    <div class="sorting__begin">{{ implode(' ', $source) }}</div>
    <hr>
    <div class="sorting__bubble">{{ implode(' ', $bubbled) }}</div>
@endsection
