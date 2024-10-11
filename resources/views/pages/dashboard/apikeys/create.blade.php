@extends('layouts.dashboard.main')

@section('content')

<div class="container">
    <div class="row vh-100 justify-content-center" style="margin-top:10%">
        <div class="col-lg-5">
            <div class="card">
                <div class="card-body">
                   <h6 class="card-title fw-semibold mb-2">API Keys</h6>

                    <form action="{{ route('apikeys.store') }}" method="post">
    @csrf
    @method('post')
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
       {{$error}}
        <button type="button" class="btn-close"  data-bs-dismiss="alert" aria-label="Close">
        </button>
     </div>
@endforeach
    <div class="row">
        <div class="col-lg-12">
            <div class="input-block mb-3">
                <label class="col-form-label">Name<span class="text-danger">*</span></label>
                <input type="text" class="form-control"  name="name" value="{{ old('name')}}" />
            </div>
        </div>

        <div class="col-lg-12">
            <div class="input-block mb-3">
                <label class="col-form-label">Description</label>
                <input type="text" class="form-control"  name="description" value="{{ old('description')}}" />
            </div>
        </div>

        <div class="col-lg-12">
            <div class="input-block mb-3">
                <label class="col-form-label">Company <span class="text-danger">*</span></label>
                <select class="form-select form-control" name="company">
                    @foreach(Auth::user()->companies as $company)
                    <option value="">Select company</option>
                        <option value="{{ $company->uuid }}">{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>


    <div class="col-lg-12">
<button type="submit" class="btn btn-primary">
    Create Key
</button>
    </div>
</div>
                    </form>
                </div>
            </div>
            </div>
        </div>
</div>

@endsection
