@extends('_template.master-main')

@section('page_title', 'Template Master')

@section('content')

<div class="row">
    <div class="col-md-12">

        <div class="card card-primary card-outline">
            <div class="card-header d-flex justify-content-between">
                <h5 class="m-0">Tambah Template</h5>
            </div>
            <div class="card-body">
                <!-- form -->
                <form action="" method="post" id="forms">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Nama Template</label>
                            <input type="text" name="Template" id="Template" class="form-control required" placeholder="Template">
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