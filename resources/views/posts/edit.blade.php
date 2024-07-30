@extends('layouts.header-create')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Article</h1>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card border-0 shadow rounded">
                                <div class="card-body">
                                    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method ('PUT')

                                        <div class="form-group">
                                            <img src="{{ asset('storage/posts/'.$post->image) }}" class="rounded img-fluid mx-auto d-block">
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
                                            <label class="font-weight-bold">Title</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $post->title) }}" placeholder="Masukkan Judul Post">
                                        
                                            <!-- error message untuk title -->
                                            @error('title')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Category</label>
                                                <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                                    <option value="" disabled>Choose category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" 
                                                            @selected($post->category_id == $category->id)>
                                                            {{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                        </div>

                                        <div class="form-group">
                                            <label class="font-weight-bold">Content</label>
                                            <textarea rows="15" id="editor" class="form-control @error('content') is-invalid @enderror" name="content" rows="5" placeholder="Masukkan Konten Post">{{ old('content', $post->content) }}</textarea>
                                        
                                            <!-- error message untuk content -->
                                            @error('content')
                                                <div class="alert alert-danger mt-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-md btn-primary">Publish</button>
                                        <button type="reset" class="btn btn-md btn-warning" disabled>Draft</button>

                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
@endsection