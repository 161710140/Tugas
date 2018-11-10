<!DOCTYPE html>
<html>
<head>
	<title>Jenis</title>
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
                     <label>Judul Buku</label>
                     <input type="text" name="judul" id="judul" class="form-control">
                     <span class="help-block has-error no_anggota_error"></span>
                  </div>
                  <div class="form-group {{ $errors->has('id_jenis') ? 'has-error' : '' }}">
                     <label>Jenis Buku</label>
                     <select class="form-control select-dua" name="id_jenis" id="id_jenis" style="width: 468px">
                        <option disabled selected>Jenis Buku</option>
                        @foreach($jenis as $data)
                        <option value="{{$data->id}}">{{$data->jenis}}</option>
                        @endforeach
                     </select>
                     @if ($errors->has('suplier_id'))
                     <span class="help-block has-error jenis_error">
                        <strong>{{$errors->first('id_jenis')}}</strong>
                     </span>
                     @endif
                  </div>
                  <div class="form-group">
                     <label>Pengarang</label>
                     <input type="text" name="pengarang" id="pengarang" class="form-control">
                     <span class="help-block has-error pengarang_error"></span>
                  </div>
                  <div class="form-group">
                     <label>ISBN</label>
                     <input type="number" name="isbn" id="isbn" class="form-control">
                     <span class="help-block has-error isbn_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tahun Terbit</label>
                     <input type="text" name="tahun_terbit" id="tahun_terbit" class="form-control">
                     <span class="help-block has-error tahun_terbit_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Penerbit</label>
                     <input type="text" name="penerbit" id="penerbit" class="form-control">
                     <span class="help-block has-error penerbit_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Tersedia</label>
                     <input type="number" name="tersedia" id="tersedia" class="form-control">
                     <span class="help-block has-error tersedia_error"></span>
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