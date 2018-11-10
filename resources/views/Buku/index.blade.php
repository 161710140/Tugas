@extends('template')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>
          <!-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Tables</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h1 class="card-title">Table Buku</h1>
              <button type="button" name="add" id="Tambah" class="btn btn-primary pull-right" style="margin-left: 960px; margin-top: 10px; margin-bottom: 10px">Add Data</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="tab_buku" class="table table-bordered" style="width:100%">
                  <thead>
                     <tr>
                        <th>Judul</th>
                        <th>Genre buku</th>
                        <th>Pengarang</th>
                        <th>ISBN</th>
                        <th>Tahun Terbit</th>
                        <th>Penerbit</th>
                        <th>Tersedia</th>
                        <th>Action</th>
                     </tr>
                  </thead>
               </table>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('scripts')
@include('Buku.modal')
      <script type="text/javascript">
         $(document).ready(function() {
          $('#tab_buku').DataTable({
            processing: true,
            serverSide: true,
            ajax: '/jsonbuku',
            columns:[
                  { data: 'judul', name: 'judul' },
                  { data: 'jenis'},
                  { data: 'pengarang', name: 'pengarang' },
                  { data: 'isbn', name: 'isbn' },
                  { data: 'tahun_terbit', name: 'tahun_terbit' },
                  { data: 'penerbit', name: 'penerbit' },
                  { data: 'tersedia', name: 'tersedia' },
                  { data: 'action', orderable: false, searchable: false }
              ],
            });
          $('#Tambah').click(function(){

            $('#Modal').modal('show');
            $('.modal-title').text('Add Data');
            $('#aksi').val('Tambah');
            $('.select-dua').select2();
            state = "insert";

            });

           $('#Modal').on('hidden.bs.modal',function(e){
            $(this).find('#form')[0].reset();
            $('span.has-error').text('');
            $('.form-group.has-error').removeClass('has-error');
            });

          $('#form').submit(function(e){
            $.ajaxSetup({
              header: {
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
              }
            });

            //menambah kan data
            e.preventDefault();

            if (state == 'insert'){

              $.ajax({
                type: "POST",
                url: "{{url ('/storebuku')}}",
                data: new FormData(this),
               // data: $('#student_form').serialize(),
                contentType: false,
                processData: false,
                dataType: 'json',

                success: function (data){
                  console.log(data);
                  swal({
                      title:'Success Tambah!',
                      text: data.message,
                      type:'success',
                      timer:'2000'
                    });
                  $('#Modal').modal('hide');
                  $('#jenis_tab').DataTable().ajax.reload();
                },

                //menampilkan validasi error
                error: function (data){

                  $('input').on('keydown keypress keyup click change', function(){
                  $(this).parent().removeClass('has-error');
                  $(this).next('.help-block').hide()
                });

                  var coba = new Array();
                  console.log(data.responseJSON.errors);
                  $.each(data.responseJSON.errors,function(name, value){
                    console.log(name);
                    coba.push(name);

                    $('input[name='+name+']').parent().addClass('has-error');
                    $('input[name='+name+']').next('.help-block').show().text(value);
                  });

                  $('input[name='+coba[0]+']').focus();
                }
              });
            }
            else 
            {
               //mengupdate data yang telah diedit
              $.ajax({
                type: "POST",
                url: "{{url ('buku/edit')}}"+ '/' + $('#id').val(),
                // data: $('#student_form').serialize(),
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data){
                  console.log(data);
                  $('#Modal').modal('hide');
                  swal({
                    title: 'Update Success',
                    text: data.message,
                    type: 'success',
                    timer: '3500'
                  })
                  $('#jenis_tab').DataTable().ajax.reload();
                },
                error: function (data){
                    swal({
                    title: 'Update Error',
                    text: 'Oops...',
                    type: 'error',
                    timer: '3500'
                  })                  
                  $('input').on('keydown keypress keyup click change', function(){
                  $(this).parent().removeClass('has-error');
                  $(this).next('.help-block').hide()
                });
                  var coba = new Array();
                  console.log(data.responseJSON.errors);
                  $.each(data.responseJSON.errors,function(name, value){
                    console.log(name);
                    coba.push(name);
                    $('input[name='+name+']').parent().addClass('has-error');
                    $('input[name='+name+']').next('.help-block').show().text(value);
                  });

                  $('input[name='+coba[0]+']').focus();
                }
             });
            }
         });

          //mengambil data yang ingin diedit
          $(document).on('click', '.edit', function(){
            var bebas = $(this).data('id');
            $('#form_tampil').html('');
            $.ajax({
              url:"{{url('buku/getedit')}}" + '/' + bebas,
              method:'get',
              data:{id:bebas},
              dataType:'json',
              success:function(data){
                console.log(data);
                state = "update";

                $('#id').val(data.id);
                $('#no_anggota').val(data.no_anggota);
                $('#nama').val(data.nama);
                $('#alamat').val(data.alamat);
                $('#kota').val(data.kota);
                $('#no_telp').val(data.no_telp);
                $('#Modal').modal('show');
                $('#aksi').val('Simpan');
                $('.modal-title').text('Edit Data');
                $('.select-dua').select2();
                }
              });
          });

          $(document).on('hide.bs.modal','#Modal', function() {
            $('#tab_buku').DataTable().ajax.reload();
          });

          //proses delete data
          $(document).on('click', '.delete', function(){
            var bebas = $(this).attr('id');
              if (confirm("Yakin Dihapus ?")) {

                $.ajax({
                  url: "{{route('ajaxdata.removedatabuku')}}",
                  method: "get",
                  data:{id:bebas},
                  success: function(data){
                    swal({
                      title:'Success Delete!',
                      text:'Data Berhasil Dihapus',
                      type:'success',
                      timer:'1500'
                    });
                    $('#tab_buku').DataTable().ajax.reload();
                  }
                })
              }
              else
              {
                swal({
                  title:'Batal',
                  text:'Data Tidak Jadi Dihapus',
                  type:'error',
                  });
                return false;
              }
            });
       });
      </script>
@endpush