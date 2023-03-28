@extends('_template.master-main')

@section('page_title', $title . ' Master')

@section('content')

@php
$rute = isset($data) ? route('', ['template' => $data->id]) : route('');
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
                            <label>Nama {{ $title }}</label>
                            <input type="text" id="template" name="template" placeholder="Template" class="form-control required">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
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