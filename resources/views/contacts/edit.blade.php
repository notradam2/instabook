@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Edit Contact</div>

                    <div class="card-body col-md-6">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('contacts.update',$contact->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="firstNameInput">First Name</label>
                                <input type="text" value="{{ $contact->first_name }}" name="first_name" class="form-control" id="firstNameInput" aria-describedby="emailHelp" placeholder="Enter Your Fist Name">
                            </div>

                            <div class="form-group">
                                <label for="lastNameInput">Last Name</label>
                                <input type="text" value="{{ $contact->last_name }}" name="last_name" class="form-control" id="lastNameInput"  placeholder="Enter Your Last Name">
                            </div>

                            <div class="form-group">
                                <label for="emailInput">Email</label>
                                <input type="text" value="{{ $contact->email }}" name="email" class="form-control" id="emailInput"  placeholder="Enter Your Email">
                            </div>

                            <div class="form-group">
                                <label for="photoInputFile">Avatar</label>
                                <input type="file" name="photo" class="form-control-file" id="photoInputFile">
                            </div>
                            <a class="btn btn-primary" href="{{ route('contacts.index') }}">Back</a>
                            <button type="submit" class="btn btn-primary">Save</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection