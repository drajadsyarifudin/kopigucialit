@extends('master_user')

@section('content')
<div class="container">
@if (session('error'))
                                @alert(['type' => 'danger'])
                                    {!! session('error') !!}
                                @endalert
                            @endif
<form action="{{url('/updatepay', $payment->id)}}" role="form" method="POST">
     {!! csrf_field() !!}                   
        <table border="0">
                
                <tr>
                <tr>
                <td>Rekening Adm: </td><td><input type="number" name="rek_adm" value="13800111"readonly></td>
                </tr><tr>
                <td>Rekening Customer : </td><td><input type="number" name="rek_cust"></td>
                </tr><tr>
                <td>Bukti Transfer : </td><td><input type="file" name="photo"></td>
                </tr><tr>
                <td>Keterangan : </td><td><input type="text" name="ket"></td>
                </tr>
                <tr>
                    <td> <input type="submit" class="btn btn-success btn-lg" value="Konfirmasi"></td>
                </tr>
            </table>
            </form>
            </div>
            @endsection  