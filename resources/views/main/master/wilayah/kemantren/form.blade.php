@extends('_template.master-main')

@section('page_title', $title . ' Master')

@section('content')

@php
$rute = isset($data) ? route('master.wilayah.kemantren.update', ['kabupaten' => request()->kabupaten, 'kemantren' => $data->id]) : route('master.wilayah.kemantren.store', ['kabupaten' => request()->kabupaten]);
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
                            <input type="text" id="kecamatan_kode" name="kecamatan_kode" placeholder="Kode {{ $title }}" class="form-control required" value="{{ old('kecamatan_kode', @$data->kecamatan_kode) }}">
                        </div>
                        <div class="col-md-12 form-group">
                            <label>Nama {{ $title }}</label>
                            <input type="text" id="kecamatan" name="kecamatan" placeholder="Nama {{ $title }}" class="form-control required" value="{{ old('kecamatan', @$data->kecamatan) }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('master.wilayah.kemantren.index', ['kabupaten' => request()->kabupaten]) }}" class="btn btn-secondary">Batal</a>
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