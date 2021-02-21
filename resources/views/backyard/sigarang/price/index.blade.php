<?php

use App\Models\Sigarang\Price;

/* @var $model Price */
$isPrivilege = Auth::user()->can([
    $routePrefix.".approve",
    $routePrefix.".not.approve",
    $routePrefix.".destroy",
    $routePrefix.".edit",
]);
?>
@extends('backyard.layout')

@section('pagetitle')
    | {{ ucfirst($modelName) }}
@endsection

@section('submodule-header')
    {{ ucfirst($modelName) }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active">{{ ucfirst($modelName) }}</li>
@endsection

@section('content')
<div class="row">
    <div class="table-responsive">
        <table class="table table-hover table-striped" id="<?=$modelName?>-table" width="100%">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>PIC</th>
                    <th>Pasar</th>
                    <th>Barang</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="col-xs-1">
                        Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('js-inline-data')
window['_<?=$modelName?>IndexData'] = <?= json_encode([
    'routeIndexData' => route($routePrefix.'.index.data'),
    'routeDestroyData' => route($routePrefix.'.destroy',999),
    'isPrivilege' => $isPrivilege,
])?>;
@endsection

@section('js-include')
<script src="<?= asset('js/backyard/sigarang/price/index.js') ?>"></script>
@endsection

