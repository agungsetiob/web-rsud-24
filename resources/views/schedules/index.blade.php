@extends('layouts.header')
@section('content') 

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Schedules</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" 
           data-toggle="modal" data-target="#addSchedule">
           <i class="fas fa-plus fa-sm text-white-50"></i> Add Schedule
        </a>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Schedules</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Doctor</th>
                            <th>Day</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($schedules as $schedule)
                        <tr>
                            <td>{{ $schedule->doctor->name }}</td>
                            <td>{{ $schedule->day }}</td>
                            <td>{{ $schedule->start_time }}</td>
                            <td>{{ $schedule->end_time }}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" title="hapus" data-toggle="modal" data-target="#deleteModal{{$schedule->id}}">
                                    <i class="fas fa-trash"></i> Delete
                                </button>

                                <button class="btn btn-info btn-sm" title="edit" data-target="#editModal{{$schedule->id}}" data-toggle="modal">
                                    <i class="fas fa-pen-square"></i> Edit
                                </button> 
                            </td>      
                        </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data is not available.
                            </div>
                        @endforelse

                        @if(Session::has('success'))
                            <div class="alert alert-success data-dismiss">
                                {{ Session::get('success') }}
                                @php Session::forget('success'); @endphp
                            </div>
                        @elseif (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                                @php Session::forget('error'); @endphp
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Delete Modal -->
@foreach ($schedules as $schedule)
<div class="modal fade" id="deleteModal{{$schedule->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yakin hapus jadwal?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih "Delete" jika kamu yakin ingin menghapus jadwal ini.</div>
            <div class="modal-footer">
                <button class="btn btn-success" type="button" data-dismiss="modal">Cancel</button>
                <form action="{{ route('schedules.destroy', $schedule->id) }}" method="POST">
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
<div class="modal fade" id="addSchedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="doctor_id">Doctor</label>
                        <select name="doctor_id" class="form-control" required>
                            <option value="" disabled selected>Choose doctor</option>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->name }}</option>
                            @endforeach
                        </select>

                        <label for="day">Day</label>
                        <select name="day" class="form-control" required>
                            <option value="" disabled selected>Choose day</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>

                        <label for="start_time">Start Time</label>
                        <input type="time" name="start_time" class="form-control" required>

                        <label for="end_time">End Time</label>
                        <input type="time" name="end_time" class="form-control" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>

<!-- Edit Modal -->
@foreach ($schedules as $schedule)
<div class="modal fade" id="editModal{{$schedule->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="doctor_id">Doctor</label>
                        <select name="doctor_id" class="form-control" required>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}" @selected($schedule->doctor_id == $doc->id)>
                                    {{ $doc->name }}
                                </option>
                            @endforeach
                        </select>

                        <label for="day">Day</label>
                        <select name="day" class="form-control" required>
                            <option value="Senin" @selected($schedule->day == 'Senin')>Senin</option>
                            <option value="Selasa" @selected($schedule->day == 'Selasa')>Selasa</option>
                            <option value="Rabu" @selected($schedule->day == 'Rabu')>Rabu</option>
                            <option value="Kamis" @selected($schedule->day == 'Kamis')>Kamis</option>
                            <option value="Jumat" @selected($schedule->day == 'Jumat')>Jumat</option>
                            <option value="Sabtu" @selected($schedule->day == 'Sabtu')>Sabtu</option>
                            <option value="Minggu" @selected($schedule->day == 'Minggu')>Minggu</option>
                        </select>

                        <label for="start_time">Start Time</label>
                        <input type="time" name="start_time" value="{{ $schedule->start_time }}" class="form-control" required>

                        <label for="end_time">End Time</label>
                        <input type="time" name="end_time" value="{{ $schedule->end_time }}" class="form-control" required>
                    </div>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div> 
        </div>
    </div>
</div>
@endforeach


@endsection
