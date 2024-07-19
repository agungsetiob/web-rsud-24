@extends('layouts.header')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Frequently Asked Questions</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#addFaq"><i class="fas fa-plus fa-sm text-white-50"></i> Add FAQ</a>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">List of FAQ</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($faqs as $faq)
                                        <tr>
                                            <td width="30%"> {{$faq->question}} </td>
                                            <td width="60%"> {{$faq->answer}} </td>
                                            <td>
                                                <button class="btn btn-danger btn-sm" title="hapus" data-toggle="modal" onclick="deleteFaq({{$faq->id}})"><i class="fas fa-trash"></i> Delete</button>

                                                <button class="btn btn-info btn-sm" title="edit" data-target="#editModal{{$faq->id}}" data-toggle="modal"><i class="fas fa-pen-square"></i> Edit</button>
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

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- delete Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                    @csrf
                    @method ('delete')
                    <a id="hapusFaq" class="btn btn-danger" type="button">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addFaq" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('faqs.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input value="{{ old('question') }}" type="text" name="question" class="form-control" required placeholder="Masukkan pertanyaan disini">
                            <label for="answer">Answer</label>
                            <textarea rows="6" value="{{ old('answer') }}" type="text" name="answer" class="form-control" id="answer" required placeholder="Masukkan jawaban disini"></textarea>
                        </div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>


    {{-- Edit Modal --}}
    @foreach ($faqs as $faq)
    <div class="modal fade" id="editModal{{$faq->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit FAQ</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
                        @csrf
                        @method ('PUT')

                        <div class="form-group">
                            <input type="hidden" id="idEdit" name="id" />
                            <label for="question">Question</label>
                            <input value="{{ old('question', $faq->question) }}" type="text" name="question" class="form-control" required>
                            <label for="answer">Answer</label>
                            <textarea rows="7" type="text" name="answer" class="form-control" required>{{ old('answer', $faq->answer) }}</textarea>
                        </div>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button id="editLink" type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
    @endforeach

    <!-- delete modal script -->
    <script type="text/javascript">
        function deleteFaq(id){
            var link = document.getElementById('hapusFaq')
            link.href = "{{ url('faqs')}}/" + id
            $('#deleteModal').modal('show')
        }
    </script>
@endsection