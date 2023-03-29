@extends('_template.master-main')

@section('page_title', $title . ' Master')

@section('content')

@php
$rute = isset($data) ? route('master.wilayah.kelurahan.update', ['kemantren' => request()->kemantren, 'kelurahan' => $data->id]) : route('master.wilayah.kelurahan.store', ['kemantren' => request()->kemantren]);
$desa_kode = substr(@$data->desa_kode, 2);
@endphp
<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0">{{ $page_title }}</h5>
            </div>
            <div class="card-body">
                <!-- form -->
                <form action="{{ $rute }}" method="post" id="forms">
                    @csrf
                    @if (isset($data))
                    {{ method_field('PUT') }}
                    @endif
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Kode {{ $title }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">{{ $kemantren->kecamatan_kode }}</span>
                                </div>
                                <input type="text" id="desa_kode" name="desa_kode" placeholder="Kode {{ $title }}" class="form-control required" value="{{ old('desa_kode', @$desa_kode) }}">
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Nama {{ $title }}</label>
                            <input type="text" id="desa" name="desa" placeholder="Nama {{ $title }}" class="form-control required" value="{{ old('desa', @$data->desa) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('master.wilayah.kelurahan.index', ['kemantren' => request()->kemantren]) }}" class="btn btn-secondary">Batal</a>
                </form>
                <!-- /.form -->
            </div>
        </div>
        <!-- /.card -->

    </div>
</div>
<!-- /.row -->

@endsection

@push('scripts')
<script type="text/javascript">
    $(function() {
        // js
    });
</script>
@endpush