@extends('layouts.header')
@section('content') 

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Doctors</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addDoctor"><i class="fas fa-plus fa-sm text-white-50"></i> Add Doctor</a>
                    </div>
                </div>
                <!-- /.container-fluid -->


                 <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of Doctor</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Specialization</th>
                                            <th>photo</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($doctors as $doc)
                                        <tr>
                                            <td> {{$doc->name}} </td>
                                            <td> {{$doc->specialization}} </td>
                                            <td> 
                                                @if ($doc->photo)
                                                <img class="img-profile" src="storage/doctor/{{$doc->photo}}" height="60px">
                                                @endif 
                                            </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" title="hapus" data-toggle="modal" data-target="#deleteModal{{$doc->id}}"><i class="fas fa-trash"></i> Delete</button>

                                                <button class="btn btn-info btn-sm" title="edit" data-target="#editModal{{$doc->id}}" data-toggle="modal"><i class="fas fa-pen-square"></i> Edit</button> 
                                            </td>      
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Data  is not available.
                                            </div>
                                        @endforelse
                                        @if(Session::has('success'))
                                            <div class="alert alert-success data-dismiss">
                                                {{ Session::get('success') }}
                                                    @php
                                                        Session::forget('success');
                                                    @endphp
                                            </div>
                                        @elseif (Session::has('error'))
                                            <div class="alert alert-danger">
                                                {{ Session::get('error') }}
                                                    @php
                                                        Session::forget('error');
                                                    @endphp
                                            </div>
                                        @endif
                                        @error('photo')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->



    <!-- delete Modal-->
    @foreach ($doctors as $doc)
    <div class="modal fade" id="deleteModal{{$doc->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tenane Lur?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Delete" below if you are sure to delete this data.</div>
                <div class="modal-footer">
                    <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{url('delete/doctor', $doc->id)}}" method="POST">
                            @csrf
                            @method ('delete')
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <!-- Add Modal -->
    <div class="modal fade" id="addDoctor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Doctor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('add/doctor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ old('name') }}" type="text" name="name" class="form-control" id="name" required>
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option value="" disabled selected>Choose category</option>
                                <option value="umum" {{ old('category') == 'umum' ? 'selected' : '' }}>Umum</option>
                                <option value="spesialis" {{ old('category') == 'spesialis' ? 'selected' : '' }}>Spesialis</option>
                            </select>
                            <label for="specialization">Specialization</label>
                            <input value="{{ old('specialization') }}" type="text" name="specialization" class="form-control" id="Specialization" required>
                            <label for="photo">Choose photo</label>
                            <div class="form-group">
                                <div class="input-group ">
                                    <label class="input-group-btn">
                                        <span class="btny btn-outline-primary">
                                            Browse<input accept="image/*" id="uploadBtn" type="file" style="display: none;" multiple name="photo">
                                        </span>
                                    </label>
                                    <input id="uploadFile" type="text" class="form-control @error('photo') is-invalid @enderror" readonly placeholder="Choose an image">
                                </div>
                                @error('photo')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror  
                            </div>
                        </div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    @foreach ($doctors as $doc)
    <div class="modal fade" id="editModal{{$doc->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Doctor Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('update/doctor', $doc->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method ('PUT')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ old('name', $doc->name) }}" type="text" name="name" class="form-control" id="nameEdit" required>
                            <label for="category">Category</label>
                            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                                <option disabled>Choose category</option>
                                <option value="umum" @selected($doc->category == 'umum')>Umum</option>
                                <option value="spesialis" @selected($doc->category == 'spesialis')>Spesialis</option>
                            </select>
                            <label for="specialization">Specialization</label>
                            <input value="{{ old('specialization', $doc->specialization) }}" type="text" name="specialization" class="form-control" id="Specialization" required>
                            <label for="photo">Choose photo</label>
                            <div class="form-group">
                                <div class="input-group ">
                                    <label class="input-group-btn">
                                        <input accept="image/*" type="file" multiple name="photo">
                                    </label>
                                </div>
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror  
                            </div>

                        </div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button id="editLink" type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    @endforeach

    <!-- -->
    <script type="text/javascript">
        // function deleteDoctor(id){
        //     var link = document.getElementById('deleteLink')
        //     link.href = "{{ url('delete/doctor')}}/" + id
        //     $('#deleteModal').modal('show')
        // }

        document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;};
        
    </script>
@endsection