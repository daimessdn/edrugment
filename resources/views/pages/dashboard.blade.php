@extends('layouts.master')

@section('title')
  Dashboard
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      @if (session('sukses'))
        <div class="alert alert-success mt-2">
          {{ session('sukses') }}
        </div>
      @endif
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <h3>Pemberitahuan</h3>
            </div>
            
            <div class="card-body">
              @if ($count != 0)
                <table class="table table-dark">
                  @foreach ($messages as $msg)
                    <tr>
                      <td>
                        <span class="badge badge-warning">{{ $msg->created_date }}</span><br />
                        {{ $msg->content }}<br />
                        <a href="/dashboard/{{ $msg->id }}/dismiss" class="btn btn-primary btn-sm">DISMISS</a>
                      </td>
                    </tr>
                  @endforeach
                </table>
              @else
                <p>Anda belum memiliki pemberitahuan.</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection