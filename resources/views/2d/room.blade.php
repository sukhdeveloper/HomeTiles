@extends('layouts.room')

@section('content')

<div id="container" class="room-canvas-container">
    <canvas id="roomCanvas" class="room-canvas"></canvas>

    @include('common.applyingTilesAnimation')
</div>

@include('common.logo')

@include('common.' . config('app.product_panel') . 'productPanel')

@include('common.' . config('app.bottom_menu') . 'bottomMenu2d')

@include('common.productInfoPanel')

@if (config('app.tiles_designer'))
    @include('2d.tilesDesigner')
@endif


<script src="/js/room/three.min.js"></script>

@if (config('app.js_as_module'))
<script type="module" src="/js/src/2d/interior2d.js"></script>
@else
<script src="/js/room/2d.min.js"></script>
@endif

@endsection
