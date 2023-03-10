<div class="row">
    <div class="form-group col-xs-12 col-sm-4">
        {!! Form::label('province_id', 'Provinsi') !!}
        {!! Form::select('province_id', $provinceOptions, null, array('id'=>'province_option', 'class' => 'form-control')) !!}
    </div>
    <div class="form-group col-xs-12 col-sm-4">
        {!! Form::label('city_id', 'Kabupaten / Kota') !!}
        {!! Form::select('city_id', [null=>'Pilih Kabupaten / Kota'], null, array('id'=>'city_option', 'class' => 'form-control', 'disabled' => 'true')) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-sm-4">
        {!! Form::label('name', 'Nama') !!}
        {!! Form::text('name', null, array('placeholder' => 'Name', 'class' => 'form-control')) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-sm-8">
        {!! Form::label('area', 'Area') !!}
        {!! Form::textarea('area', null, array('placeholder' => 'Masukkan point-point batas area dalam format (lat1 lng1;lat2 lng2;...;latn lngn)', 'class' => 'form-control')) !!}
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-6 col-sm-2">
        <a class="btn btn-primary" href="{{ URL::previous() }}" style="width:100%">Back</a>
    </div>
    <div class="form-group col-xs-6 col-sm-2">
        <button type="submit" class="btn btn-success" style="width:100%">Submit</button>
    </div>
</div>

@section('js-inline-data')
window['_<?=$modelName?>FormData'] = <?= json_encode([
    'routeAjaxGetCityByProvinceId' => route('backyard.area.city.ajax.get.city.by.province.id', 999),
])?>;
@endsection

@section('js-include')
<script src="<?= asset('js/backyard/sigarang/area/district/form.js') ?>"></script>
@endsection
