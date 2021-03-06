
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
 			     <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                      <div class="row">
                          <div class="col-md-10 stretch-card">
                            <h3 class="card-title"> Input Jadwal Pelajaran</h3>
                            <?php echo $jsonJadwal; ?>
                          </div>
                      </div>

                  <form class="form-control" style="border:0px;" action="" method="post">
                    <div class="row" id="tabeldata">
                    </div>
                    <div class="row" id="rowbtnsubmit" align="right" style="margin-top:20px; padding-left:35px;">
                      <button type="button" onclick="sendJSONJadwal()" class="btn btn-success btn-fw">Save</button>
                      <button type="button" class="btn btn-outline-danger btn-fw" style="margin-left:20px;" onclick="btnreset()"><i class="mdi mdi-restart"></i>Cancel</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="http://www.bootstrapdash.com/" target="_blank">Template by Bootstrapdash, </a> <a href="https://www.linkedin.com/in/rayiemas-manggala-putra-a0a0b5152" target="_blank"> Layouting by Masrayiemas</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
          <script src="<?php echo base_url("assets/node_modules/jquery/dist/jquery.min.js");?>"></script>
          <script src="<?php echo base_url("assets/vendor/Select2/dist/js/select2.min.js")?>"></script>
        <script type="text/javascript">
          function generateID(id, idtype){
            $.ajax({
                type: 'post',
                url : "<?php echo base_url().'index.php/JadwalSeluruh/generateIdJadwal/';?>"+id,
                data : '',
                dataType : 'JSON',
                success : function(data){
                    var id_jadwal;
                    id_jadwal = data.id_jadwal;
                    $(idtype).val(id_jadwal);
                    // console.log(data);
                },
                error : function(data){
                  console.log('error di controller');
                }
            });
          }

          function dataMapel(idtype){
            $.ajax({
              type: 'post',
              url : "<?php echo base_url().'index.php/JadwalSeluruh/jsonMapel';?>",
              data : '',
              dataType : 'JSON',
              success : function(data){
                $(idtype).select2({placeholder:'Pilih MataPelajaran', data:data});
              },
              error : function(data){
                console.log('error di controller');
              }
            });
          }

          function dataGuru(idtype){
            $.ajax({
              type: 'post',
              url : "<?php echo base_url().'index.php/JadwalSeluruh/jsonGuru';?>",
              data : '',
              dataType : 'JSON',
              success : function(data){
                $(idtype).select2({placeholder:'Pilih Kode Guru', data:data});
              },
              error : function(data){
                console.log('error di controller');
              }
            });
          }

          function dataShift(idtype){
            $.ajax({
              type: 'post',
              url : "<?php echo base_url().'index.php/JadwalSeluruh/jsonShift';?>",
              data : '',
              dataType : 'JSON',
              success : function(data){
                $(idtype).select2({placeholder:'Pilih Shift', data:data});
              },
              error : function(data){
                console.log('error di controller');
              }
            });
          }

          function outJam(id, idtype1, idtype2, idtype3){
            $.ajax({
              type :'post',
              url :"<?php echo base_url().'index.php/JadwalSeluruh/getJam/'?>"+id,
              data : '',
              dataType : 'JSON',
              success : function(data){
                $(idtype1).val(data.jam_mulai);
                $(idtype2).val(data.jam_selesai);
                $(idtype3).val(data.keterangan);
              },
              error : function(data){
                console.log('error getting');
              }
            });
          }


          $(window).bind('beforeunload', function(){
            localStorage.removeItem("jumlahkelas");
          });

          //Hidden rowmi, rowmts, rowjumkelas, rowbtnsubmit
          document.getElementById("rowbtnsubmit").style.display="none";

          $("#selectmapelku").select2({
            placeholder: "Pilih Matapelajaran",
            allowClear : true,
          });

          $("#selectshift").select2({
            placeholder: "Pilih Shift",
            allowClear : true,
          });

          //handler select2
          $("#selecthariku").on("change", function(){
              $("#selectjenjangku").removeAttr("disabled");
          });

          $("#selectjenjangku").on("change", function(){
              var jenjang
              jenjang = document.getElementById("selectjenjangku").value;
              if(jenjang == 0){
                $("#rowmi").hide();
                $("#rowmts").hide();
                $("#rowjumkelas").show();
                $("#rowjumbaris").show();
              } else if(jenjang == 1){
                $("#rowmi").show();
                $("#rowmts").hide();
                $("#rowjumbaris").show();
                $("#rowjumkelas").show();
              } else {
                $("#rowmts").show();
                $("#rowmi").hide();
                $("#rowjumbaris").show();
                $("#rowjumkelas").show();
              }
          });

          function cekLocalStorage(){
            if(!localStorage.getItem("jumlahkelas")){
              alert("belum ada");
            } else{
              alert(localStorage.getItem("jumlahkelas"));
            }
          }

          //function output tabel dinamis
          function outputTabel(){
            var hari, jenjang, jenjang2, tingkat, jumlahkelas, alphabet, kelasstorage, jumlahbaris
            hari        = document.getElementById("selecthariku").value;
            jenjang     = document.getElementById("selectjenjangku").value;
            jumlahkelas = document.getElementById("jumlahkelas").value;
            jumlahbaris = document.getElementById("jumlahbaris").value;
            alphabet    = "ABCDEFGHIJKLMNOPQRSTUVWXYZ".split('');

            if(!localStorage.getItem("jumlahkelas")){
                kelasstorage = jumlahkelas;
                localStorage.setItem("jumlahkelas", kelasstorage);
            } else{
                kelasstorage = parseInt(localStorage.getItem("jumlahkelas")) + parseInt(jumlahkelas);
                localStorage.setItem("jumlahkelas", kelasstorage);
            }

            if(!localStorage.getItem("jumlahbaris")){
                barisstorage = jumlahbaris;
            } else {
                barisstorage = parseInt(localStorage.getItem("jumlahbaris") + parseInt(jumlahkelas));
                localStorage.setItem("jumlahbaris", barisstorage);
            }

            if(jenjang == 0){
              jenjang2 = "Taman Kanak-Kanak";
            } else if (jenjang==1) {
              jenjang2 = "Madrasah Ibtidaiyah";
              tingkat = document.getElementById("selecttingkatmi").value;
            } else {
              jenjang2 = "Madrasah Tsanawiyah";
              tingkat = document.getElementById("selecttingkatmts").value;
            }

            if(kelasstorage==jumlahkelas){
                counter = 0;
            } else {
                counter = kelasstorage-jumlahkelas;
            }

            if(barisstorage==jumlahbaris){
                counterrow = 0;
            } else {
                counterrow = barisstorage - jumlahbaris;
            }

            var x = 0;
            for (var i = 0; i < jumlahkelas; i++) {
                var kelas
                if(jenjang == 0){
                    kelas = alphabet[(counter+i)];
                    $("#tabeldata").append("<div name='elementabel' class='col-lg-12 grid-margin stretch-card' style='margin-bottom:-20px;'> <div class='card'> <div class='card-body'> <h4 class='card-title'>Jadwal <i>"+ jenjang2 +"</i> /  Hari "+ hari +" / Kelas "+kelas+" </h4> <table class='table table-bordered' name='jadwaltabel' id='tabeljadwal'> <thead> <tr style='vertical-align:top;'> <th width='20%'>ID Jadwal</th> <th width='15%'>Matapelajaran</th> <th width='15%'>Kode Guru</th> <th width='10%'>Shift</th> <th width='10%'>Jam Mulai</th> <th width='10%'>Jam Selesai</th> <th width='10%'>Keterangan</th> </tr> </thead> <tbody id='bodyjadwal"+(counter+i)+"'> </tbody> </table> </div> </div> </div>");
                } else {
                    kelas = tingkat + alphabet[(counter+i)];
                    $("#tabeldata").append("<div name='elementabel' class='col-lg-12 grid-margin stretch-card' style='margin-bottom:-20px;'> <div class='card'> <div class='card-body'> <h4 class='card-title'>Jadwal <i>"+ jenjang2 +"</i> /  Hari "+ hari +" /  Kelas "+kelas+"</h4> <table class='table table-bordered' id='tabeljadwal'> <thead> <tr style='vertical-align:top;'> <th width='20%'>ID Jadwal</th> <th width='15%'>Matapelajaran</th> <th width='15%'>Kode Guru</th> <th width='10%'>Shift</th> <th width='10%'>Jam Mulai</th> <th width='10%'>Jam Selesai</th> <th width='10%'>Keterangan</th> </tr> </thead> <tbody id='bodyjadwal"+(counter+i)+"'> </tbody> </table> </div> </div> </div>");
                }

                for(var j = 0; j < jumlahbaris; j++){
                    x = x+1;;
                    dataMapel('#selectmapelku'+i+(counter+j));
                    dataShift('#selectshift'+i+(counter+j));
                    dataGuru('#selectguru'+i+(counter+j));
                    generateID(x,'#idjadwal'+i+(counter+j));
                    var rowjadwal = "<tr> <td> <input type='hidden' name='kelas' value='"+kelas+"'/> <input type='hidden' name='jenjang' value='"+jenjang+"'/> <input type='hidden' name='hari' value='"+hari+"'/> <input type='text' class='col-sm-12' id='idjadwal"+i+(counter+j)+"' name='id_jadwal' value='' readonly style='border:none;font-size:11.5px;'/> </td> <td> <select name='selectmapelku' id='selectmapelku" + i + (counter+j) + "' class='form form-control-sm'> <option></option> </select> </td> <td> <select id='selectguru" + i + (counter+j) + "' class='form form-control-sm' name='selectguru'><option></option></select> </td> <td> <select id='selectshift" + i + (counter+j) + "'name='selectshift' class='form form-control-sm'> <option></option> </select> </td> <td><input type='text' class='col-sm-12' id='jam_mulai"+i+(counter+j)+"' name='jam_mulai' value='' readonly style='border:none;font-size:12px;'/></td> <td><input type='text' class='col-sm-12' id='jam_selesai"+i+(counter+j)+"' name='jam_selesai' value='' readonly style='border:none;font-size:12px;'/></td> <td><input type='text' class='col-sm-12' name='keterangan'id='keterangan"+i+(counter+j)+"' value='' readonly style='border:none;' /></td> </tr>";
                    $("#bodyjadwal"+(counter+i)).append(rowjadwal);

                    $("#selectshift"+i+(counter+j)).on('change', function(e){
                      var val = $(this).val();
                      var id = this.id.substring(11);
                      outJam(val, '#jam_mulai'+id, '#jam_selesai'+id, '#keterangan'+id);
                    });
                  }
                    $("#rowbtnsubmit").show();
                    $("#rowoperation").hide();
                }
            }

            function btnreset(){
              location.reload();
            }

            function getAllValue(){
              var objAll = {};
              objAll.id_jadwal = $.map($("input[name='id_jadwal']"), function(val, _) {
                  var newObj = {};
                  newObj = val.value;
                  return newObj;
                });
                objAll.mapel = $.map($("select[name='selectmapelku']"), function(val, _) {
                    var newObj = {};
                    newObj = val.value;
                    return newObj;
                  });
                  objAll.kodeguru = $.map($("select[name='selectguru']"), function(val, _) {
                      var newObj = {};
                      newObj = val.value;
                      return newObj;
                    });
                    objAll.shift = $.map($("select[name='selectshift']"), function(val, _) {
                        var newObj = {};
                        newObj = val.value;
                        return newObj;
                      });
                      objAll.jenjang = $.map($("input[name='jenjang']"), function(val, _) {
                          var newObj = {};
                          newObj = val.value;
                          return newObj;
                        });
                        objAll.kelas = $.map($("input[name='kelas']"), function(val, _) {
                            var newObj = {};
                            newObj = val.value;
                            return newObj;
                          });
                          objAll.hari = $.map($("input[name='hari']"), function(val, _) {
                              var newObj = {};
                              newObj = val.value;
                              return newObj;
                            });
              console.log(JSON.stringify(objAll));
              return JSON.stringify(objAll);
              // alert("cek");
            }

            function sendJSONJadwal(){
                var val = getAllValue();
                $.ajax({
                  method:'POST',
                  contentType :'application/json',
                  url : "<?php echo base_url().'index.php/JadwalSeluruh/insertJadwalAll';?>",
                  data : val,
                  success: function(resp){
                    window.location="<?php echo base_url().'index.php/JadwalSeluruh/viewTabelJadwalAll';?>";
                  },
                  error: function(resp){
                    console.log('gagal parsing');
                  }
                });
            }

        </script>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
