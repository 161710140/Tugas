<!DOCTYPE html>
<html>
<head>
   <title>PinjamBuku</title>
</head>
<body>
   <div id="Modal" class="modal fade" role="dialog" aria-hidden="true" data-backdrop="static">
      <div class="modal-dialog">
         <div class="modal-content">
            <form method="post" id="form" enctype="multipart/form-data">
               <div class="modal-header" style="background-color: lightblue;">
                  <h4 class="modal-title" >Add Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >&times;</button>
               </div>

               <div class="modal-body">
                  {{csrf_field()}} {{ method_field('POST') }}
                  <span id="form_tampil"></span>
                  <input type="hidden" name="id" id="id">

                  <div class="form-group {{ $errors->has('nopinjam') ? 'has-error' : '' }}">
                     <label>Nomor Pinjam</label>
                     <select class="form-control select-dua" name="nopinjam" id="nopinjam" style="width: 468px">
                        <option disabled selected>Nomor Pinjam Anda</option>
                        @foreach($pinjam as $data)
                        <option value="{{$data->id}}">{{$data->nopinjam}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('nopinjam'))
                     <span class="help-block has-error jenis_error">
                        <strong>{{$errors->first('nopinjam')}}</strong>
                     </span>
                     @endif
                  </div>
                  <div class="form-group {{ $errors->has('id_anggota') ? 'has-error' : '' }}">
                     <label>Nama Anggota</label>
                     <select class="form-control select-dua" name="id_anggota" id="id_anggota" style="width: 468px">
                        <option disabled selected>Nama Anggota</option>
                        @foreach($anggota as $data)
                        <option value="{{$data->id}}">{{$data->nama}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_anggota'))
                     <span class="help-block has-error jenis_error">
                        <strong>{{$errors->first('id_anggota')}}</strong>
                     </span>
                     @endif
                  </div>
                  <div class="form-group {{ $errors->has('id_buku') ? 'has-error' : '' }}">
                     <label>Nama Buku</label>
                     <select class="form-control select-dua" name="id_buku" id="id_buku" style="width: 468px">
                        <option disabled selected>Nama Buku Yang Anda Pinjam</option>
                        @foreach($buku as $data)
                        <option value="{{$data->id}}">{{$data->judul}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('id_buku'))
                     <span class="help-block has-error jenis_error">
                        <strong>{{$errors->first('id_buku')}}</strong>
                     </span>
                     @endif
                  </div>
                  <div class="form-group">
                     <label>Tanggal Pinjam</label>
                     <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" readonly>
                     <span class="help-block has-error kota_error" ></span>
                  </div>
                  <div class="form-group">
                     <label>Tanggal Harus Kembali</label>
                     <input type="date" name="tglhrskbl" id="tglhrskbl" class="form-control" readonly>
                     <span class="help-block has-error kota_error" ></span>
                  </div>
                   <div class="form-group">
                     <label>Tanggal Kembali</label>
                     <input type="date" name="tglkbl" id="tglkbl" class="form-control" >
                     <span class="help-block has-error kota_error"></span>
                  </div>
                  <br>
                   <i><h6><b>Jika Pengembalian Buku Lebih Dari Tanggal Yang Ditetapkan Akan Dikenakan Denda Sebesar 2000xHari Terlambat Pengembalian</b></i></h6>
            <div class="modal-footer">
               <input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
               <input type="button" value="Cancel" class="btn btn-default" data-dismiss="modal"/>
            </div>
               </form>
            </div>
         </div>
      </div>
<script type="text/javascript">
    $(document).ready(function(){
      $('#nopinjam').on('change', function(){
        var ID = $(this).val();
          if(ID){
            $.ajax({
              url: 'pinjam/pengembalian/'+ID,
              type: "GET",
              dataType: "json",
              success: function (data){
                $('#id_anggota').val(data.anggota);
                $('#tanggal_pinjam').val(data.tglpinjam);
                $('#tglhrskbl').val(data.tglhrskbl);
              }
            });
          }
          else
          {
            $('#id_anggota','#id_buku','#tanggal_pinjam','#tglhrskbl').empty();
          }
      });
    });
</script>
</body>
</html>