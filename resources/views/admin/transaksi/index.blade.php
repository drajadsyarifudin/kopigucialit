@extends('layouts.master')
​
@section('title')
    <title>Manajemen Transaksi</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    
                        
                            
                            @if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
​
                            
                   
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            List Pengiriman
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>ID Shipping</td>
                                            <td>ID Payment</td>
                                            <td>Total Payment</td>
                                            <td>Origin</td>
                                            <td>Destination</td>
                                            <td>Courier</td>
                                            <td>Status</td>
                                            <td>Resi</td>
                                            <td>Option</td>

                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @forelse ($data as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->id }}</td>
                                            <td>{{ $row->payment_id }}</td>
                                            <td>{{ $row->total_payment }}</td>
                                            <td>{{ $row->origin }}</td>
                                            <td>{{ $row->destination }}</td>
                                            <td>{{ $row->courier }}</td>
                                            <td>{{ $row->status }}</td>
                                            <td>{{ $row->resi }}</td>
                                        
                                            <td>
                                                <form action="{{route('transaksi.destroy', $row->id)}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <a href="{{route('transaksi.edit', $row->id)}}" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                                                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">Tidak ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection