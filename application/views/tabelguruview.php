
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
			
			<div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Data Guru</h4>
                  <p class="card-description">
                    Data Guru Al-Islamiyah Attarbiyah
                  </p>
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          NO
                        </th>
                        <th>
                          NIP
                        </th>
                        <th>
                          Nama
                        </th>
            						<th>
            						  Kode Guru
            						</th>
                        <th>
                          Email
                        </th>
                        <th> Operation </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $no=0;
                        foreach ($guruArr as $as) {
                        $no = $no + 1;
                        ?>
                          <tr>
                              <td><?php echo $no; ?></td>
                              <td><?php echo $as->getNip(); ?></td>
                              <td><?php echo $as->getNamaGuru(); ?></td>
                              <td><?php echo $as->getKodeGuru(); ?></td>
                              <td><?php echo $as->getEmail(); ?></td>
                              <td>
                                      <!-- <?php
                                        if($as->status==0){
                                            echo "<label class='label label-danger' style='font-size: 10px;'>BELUM KEMBALI </label>";
                                        } elseif ($as->status==1) {
                                            echo "<label class='label label-success'style='font-size: 10px;' >SUDAH KEMBALI </label>";
                                        }
                                      ?>   -->
                              </td>
                          </tr>
                        <?php } ?>
                    </tbody>
                  </table>
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
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    