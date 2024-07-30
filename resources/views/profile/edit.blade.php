@extends('layouts.header-create')
@section('content')
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 shadow rounded">
                                <div class="card-body">
                                    <form action="{{ url('profile/update', $profile->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method ('PUT')
                                        <div class="form-group">
                                            <img src="{{ asset('storage/posts/'.$profile->image) }}" class="rounded img-fluid mx-auto d-block">
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group ">
                                                <label class="input-group-btn">
                                                    <span class="btny btn-outline-primary">
                                                        Browse<input accept="image/*" id="uploadBtn" type="file" style="display: none;" multiple name="image">
                                                    </span>
                                                </label>
                                                <input id="uploadFile" type="text" class="form-control @error('image') is-invalid @enderror" readonly placeholder="Choose an image">
                                            </div>
                                            @error('image')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror  
                                        </div>
                                        <script type="text/javascript">
                                            document.getElementById("uploadBtn").onchange = function () {
                                            document.getElementById("uploadFile").value = this.value;};
                                        </script>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Heading</label>
                                            <input type="text" class="form-control @error('heading') is-invalid @enderror" name="heading" value="{{ old('heading', $profile->heading) }}" placeholder="Masukkan heading profile">
                                        
                                            <!-- error message untuk title -->
                                            @error('heading')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="font-weight-bold">Profile RSUD</label>
                                            <textarea rows="19" id="editor" class="form-control @error('about') is-invalid @enderror" name="about" placeholder="Masukkan visi, misi, dan profil">{{ old('about', $profile->about) }}</textarea>
                                        
                                            <!-- error message untuk content -->
                                            @error('profile')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-md btn-primary">Save</button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection