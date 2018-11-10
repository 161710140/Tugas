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
                     <label>No Anggota</label>
                     <input type="text" name="no_anggota" id="no_anggota" class="form-control" placeholder="Masukan Nomer Anggota">
                     <span class="help-block has-error no_anggota_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Nama Anggota</label>
                     <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Anda">
                     <span class="help-block has-error nama_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Alamat</label>
                     <textarea name="alamat" id="alamat" class="form-control">
                     </textarea>
                     <span class="help-block has-error alamat_error"></span>
                  </div>
                  <div class="form-group">
                     <label>Asal Kota</label>
                     <input type="text" name="kota" id="kota" class="form-control" placeholder="Dimanakah Anda Berasal?">
                     <span class="help-block has-error kota_error"></span>
                  </div>
                  <div class="form-group">
                     <label>No Telepon</label>
                     <input type="number" name="no_telp" id="no_telp" class="form-control" placeholder="Masukan Nomer Telepon">
                     <span class="help-block has-error no_telp_error"></span>
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