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

                  <div class="form-group">
                     <label>Nomor Peminjaman</label>
                     <input type="text" name="nopinjam" id="nopinjam" class="form-control" placeholder="Masukan Nomer Peminjaman">
                     <span class="help-block has-error no_anggota_error"></span>
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
                        <option disabled selected>Jenis Buku</option>
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
                     <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control" value="<?php echo Carbon\Carbon::now()->format('Y-m-d') ?>" readonly>
                     <span class="help-block has-error kota_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tanggal Harus Kembali</label>
                     <input type="date" name="tglhrskbl" id="tglhrskbl" class="form-control" value="<?php echo Carbon\Carbon::now()->addDays(2)->format('Y-m-d') ?>" readonly>
                     <span class="help-block has-error kota_error"></span>
                  </div>
            <div class="modal-footer">
               <input type="submit" name="submit" id="aksi" value="Tambah" class="btn btn-info" />
               <input type="button" value="Cancel" class="btn btn-default" data-dismiss="modal"/>
            </div>
               </form>
            </div>
         </div>
      </div>
<script type="text/javascript">
</script>
</body>
</html>