<?php
    $con=mysqli_connect("127.0.0.1","root","gm2580!!","stlist");

    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    mysqli_query($con, "set session character_set_connection=utf8;");

    mysqli_query($con, "set session character_set_results=utf8;");

    mysqli_query($con, "set session character_set_client=utf8;");

    $today = mysqli_query($con,"SELECT * FROM stconsult WHERE DATE_FORMAT(`time`, '%Y-%m-%d') = CURDATE() ORDER BY `time` DESC");
    $yesterday = mysqli_query($con,"SELECT * FROM stconsult WHERE DATE_FORMAT(`time`, '%Y-%m-%d') = SUBDATE(CURDATE(),1) ORDER BY `time` DESC");
    $oneweekdelay = mysqli_query($con,"SELECT * FROM stconsult WHERE DATE_FORMAT(`time`, '%Y-%m-%d') < (CURDATE() - INTERVAL 7 DAY) ");
    $oneweekdelayin = mysqli_query($con,"SELECT * FROM stconsult WHERE DATE_FORMAT(`time`, '%Y-%m-%d') > (CURDATE() - INTERVAL 7 DAY) ");
    $twoweekdelay = mysqli_query($con,"SELECT * FROM stconsult WHERE DATE_FORMAT(`time`, '%Y-%m-%d') < (CURDATE() - INTERVAL 14 DAY) ");
    $twoweekdelayin = mysqli_query($con,"SELECT * FROM stconsult WHERE DATE_FORMAT(`time`, '%Y-%m-%d') > (CURDATE() - INTERVAL 14 DAY) ");

    

            
?>


<!--begin::Entry-->

<style>
      .info_color{overflow:hidden;}
      .info_color .info_data.hidden{
         white-space:nowrap;
         word-wrap:normal;
         width:90%;
         overflow:hidden;
         text-overflow: ellipsis;
         float:left;
         
      }
      
      .btn-moreInfo{display:none;white-space:nowrap;float:right;}
      
      @media screen and (max-width: 533px){
         .info_color .info_data.hidden{
            width:75%;
         }
      }
   </style>
   <script>
      jQuery(function ($) {
         var colorbox = $('.info_color .info_data');
         colorbox.each( function() {
            $( this ).outerHeight();
            if( $(this).outerHeight() > 21 ){
               $(this).addClass('hidden');
               var btnMoreCmt = $(this).siblings('.btn-moreInfo');
               btnMoreCmt.show();
               btnMoreCmt.on("click",function(){
                  $(this).siblings('.info_data').removeClass('hidden');
                  $(this).remove();
               });
            }
         } );
      });
   </script>

<?php if($user_activate == '1' or $user_activate == '2' or $_SESSION['is_admin']==1){?>
	<div class="d-flex flex-column-fluid">

		<!--begin::Container-->
		<div class="container-fluid pt-3">

					<!--begin::List Widget 9-->
					<div class="card card-custom card-stretch gutter-b">

						<!--begin::Header-->
						<div class="card-header align-items-center border-0 mt-4">
							<h3 class="card-title align-items-start flex-column">
								<span class="font-weight-bolder text-dark">?????? ????????????</span>
								
							</h3>
						
						</div>

						<!--end::Header-->

						<div class="card-body">
							<!--begin: Datatable-->
							<table class="table" width="100%">

							<colgroup>
							<col style="width:10%" />
							<col style="width:10%" />
							<col style="width:10%" />
							<col style="width:50%" />
							<col style="width:10%" />
							<col style="width:10%" />

							</colgroup>




								<thead>
									<tr>
										<th title="Field #1">????????????</th>
										<th title="Field #2">?????????</th>
										<th title="Field #3">??????</th>
										<th title="Field #4">????????????</th>
										<th title="Field #5">????????????</th>
										<th title="Field #6">????????????</th>
									</tr>
								</thead>
								<tbody>
								
								<script>
                                            // Class definition

                                                var KTAutosize = function () {

                                                // Private functions
                                                var demos = function () {
                                                // basic demo
                                                var demo1 = $('.tah');

                                                autosize(demo1);

                                                
                                                autosize.update(demo1);
                                                }

                                                return {
                                                // public functions
                                                init: function() {
                                                demos();
                                                }
                                                };
                                                }();

                                                jQuery(document).ready(function() {
                                                KTAutosize.init();
                                                });
                                            </script>

								<?php

									while($row = mysqli_fetch_array($today))
									{

									echo "<tr>";
									echo "<td>" . $row['stdname'] . "</td>";
									echo "<td>" . $row['Consultant'] . "</td>";
									echo "<td>" . $row['time'] . "</td>";
									echo "<td><textarea class='form-control tah' style='resize: none; border: none;' readonly>" . $row['content'] . "</textarea></td>";
									echo '<td>  
									
									<form method="POST">
									<div>
									<span class="switch switch-outline switch-icon switch-warning">
									 <label>';

									if($row['allowtest'] == 1){
										echo '<input onchange="this.form.submit()" type="checkbox" name="allowtest" checked/>';
										}else if($row['allowtest'] == 0){
										echo '<input onchange="this.form.submit()" type="checkbox" name="allowtest"/>';
									}
									
									echo '<span></span>
									  <input type="hidden" name="stc" value="'.$row['stid'].'"/>
									  <input type="hidden" name="time" value="'.$row['time'].'"/>
									  <input type="hidden" name="at" value=""/>
									 </label>
									</span>
								   </div>
								   
								   </form>
								   
								 
								   </td>';
									echo '
									<td>  
									
									<form method="POST">
									<div>
									<span class="switch switch-outline switch-icon switch-success">
									 <label>';
									
									if($row['allowok'] == 1){
										echo '<input onchange="this.form.submit()" type="checkbox" name="allowok" checked/>';
										}else if($row['allowok'] == 0){
										echo '<input onchange="this.form.submit()" type="checkbox" name="allowok"/>';
									}

									echo '<span></span>
									<input type="hidden" name="stc" value="'.$row['stid'].'"/>
									  <input type="hidden" name="time" value="'.$row['time'].'"/>
									  <input type="hidden" name="ao" value=""/>
									 </label>
									</span>
									</div>

									</form>
								   
								   </td>';

									echo "</tr>";
									
									}
									echo '<script>
									var txtArea = $(".tah");
									if (txtArea) {
										txtArea.each(function(){
											$(this).height(this.scrollHeight);
										});
									}

								   </script>'
									
									?>
								</tbody>
							</table>
							<!--end: Datatable-->
						</div>

						<!--end: Card Body-->
					</div>

					<!--end: List Widget 9-->

		</div>

		<!--end::Container-->
	</div>
	<script src="assets/js/pages/crud/ktdatatable/base/html-table.js"></script>
<?php }else{?>
	<div class="d-flex flex-column-fluid">

		<!--begin::Container-->
		<div class="container-fluid pt-3">

			<!--[html-partial:begin:{"id":"demo1/dist/inc/view/demos/pages/index","page":"index"}]/-->

			<!--[html-partial:begin:{"id":"demo1/dist/inc/view/partials/content/dashboards/demo1","page":"index"}]/-->

			<!--begin::Dashboard-->

			<!--begin::Row-->
			<div class="row">
				<div class="col-lg-6">

					<!--[html-partial:begin:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->

					<!--begin::List Widget 9-->
					<div class="card card-custom card-stretch gutter-b">

						<!--begin::Header-->
						<div class="card-header align-items-center border-0 mt-4">
							<h3 class="card-title align-items-start flex-column">
								<span class="font-weight-bolder text-dark">?????? ????????????</span>
								
							</h3>
						
						</div>

						<!--end::Header-->

						<!--begin::Body-->
						<div class="card-body pt-4">

							<!--begin::Timeline-->
							<div class="timeline timeline-6 mt-3">
								<?php
								if($user_activate == '1' or $user_activate == '2' or $_SESSION['is_admin']==1){
								
									while($row = mysqli_fetch_array($yesterday)){
										

										echo '
										<!--begin::Item-->
										<div class="timeline-item align-items-start">

											<!--begin::Label-->
											<div class="timeline-label font-weight-bolder text-dark-75">
												<p>'.$row['stdname'].'</p>
												<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

											
											</div>

											<!--end::Label-->

											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="fa fa-genderless text-danger icon-xl"></i>
											</div>

											<!--end::Badge-->

											<!--begin::Text-->
											
											<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">'.$row['content'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

											<!--end::Text-->
										</div>

										<!--end::Item-->
										';
										
									
									}
								}else{
									while($row = mysqli_fetch_array($yesterday)){
										if($row['Consultant'] == $user_profile){

										echo '
										<!--begin::Item-->
										<div class="timeline-item align-items-start">

											<!--begin::Label-->
											<div class="timeline-label font-weight-bolder text-dark-75">
												<p>'.$row['stdname'].'</p>
												<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

											
											</div>

											<!--end::Label-->

											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="fa fa-genderless text-danger icon-xl"></i>
											</div>

											<!--end::Badge-->

											<!--begin::Text-->
											
											<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">'.$row['content'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

											<!--end::Text-->
										</div>

										<!--end::Item-->
										';
										}
									
									}

								}
								?>

							</div>

							<!--end::Timeline-->
						</div>

						<!--end: Card Body-->
					</div>

					<!--end: List Widget 9-->

					<!--[html-partial:end:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->
				</div>
				<div class="col-lg-6">

					<!--[html-partial:begin:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->

					<!--begin::List Widget 9-->
					<div class="card card-custom card-stretch gutter-b">

						<!--begin::Header-->
						<div class="card-header align-items-center border-0 mt-4">
							<h3 class="card-title align-items-start flex-column">
								<span class="font-weight-bolder text-dark">?????? ????????????</span>
								
							</h3>
						
						</div>

						<!--end::Header-->

						<!--begin::Body-->
						<div class="card-body pt-4">

							<!--begin::Timeline-->
							<div class="timeline timeline-6 mt-3">
								<?php
								if($user_activate == '1' or $user_activate == '2' or $_SESSION['is_admin']==1){

									while($row = mysqli_fetch_array($today)){
											

											echo '
											<!--begin::Item-->
											<div class="timeline-item align-items-start overflow-auto">

												<!--begin::Label-->
												<div class="timeline-label font-weight-bolder text-dark-75">
													<p>'.$row['stdname'].'</p>
													<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

												
												</div>

												<!--end::Label-->

												<!--begin::Badge-->
												<div class="timeline-badge">
													<i class="fa fa-genderless text-warning icon-xl"></i>
												</div>

												<!--end::Badge-->

												<!--begin::Text-->
												
												<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">'.$row['content'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

												<!--end::Text-->
											</div>

											<!--end::Item-->
											';
										
									
									}
								}else{

									while($row = mysqli_fetch_array($today)){
										if($row['Consultant'] == $user_profile){
											echo '
											<!--begin::Item-->
											<div class="timeline-item align-items-start">

												<!--begin::Label-->
												<div class="timeline-label font-weight-bolder text-dark-75">
													<p>'.$row['stdname'].'</p>
													<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

												
												</div>

												<!--end::Label-->

												<!--begin::Badge-->
												<div class="timeline-badge">
													<i class="fa fa-genderless text-warning icon-xl"></i>
												</div>

												<!--end::Badge-->

												<!--begin::Text-->
												
												<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">'.$row['content'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

												<!--end::Text-->
											</div>

											<!--end::Item-->
											';
										}
									}

								}
								?>

							</div>

							<!--end::Timeline-->
						</div>

						<!--end: Card Body-->
					</div>

					<!--end: List Widget 9-->

					<!--[html-partial:end:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->
				</div>
			</div>
			<div class="row">
			
				<div class="col-lg-6">

					<!--[html-partial:begin:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->

					<!--begin::List Widget 9-->
					<div class="card card-custom card-stretch gutter-b">

						<!--begin::Header-->
						<div class="card-header align-items-center border-0 mt-4">
							<h3 class="card-title align-items-start flex-column">
								<span class="font-weight-bolder text-dark">7??? ?????? ????????????</span>
								
							</h3>
						
						</div>

						<!--end::Header-->

						<!--begin::Body-->
						<div class="card-body pt-4">

							<!--begin::Timeline-->
							<div class="timeline timeline-6 mt-3">
								<?php
								if($user_activate == '1' or $user_activate == '2' or $_SESSION['is_admin']==1){
								
									while($row = mysqli_fetch_array($oneweekdelay)){
										$start = 0;
										while($rowid = mysqli_fetch_array($oneweekdelayin)){
											if($rowid['stid'] == $row['stid']){
												$start=1;
											}
										}
										
										if($start == 0){
										echo '
										<!--begin::Item-->
										<div class="timeline-item align-items-start">

											<!--begin::Label-->
											<div class="timeline-label font-weight-bolder text-dark-75">
												<p>'.$row['stdname'].'</p>
												<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

											
											</div>

											<!--end::Label-->

											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="fa fa-genderless text-danger icon-xl"></i>
											</div>

											<!--end::Badge-->

											<!--begin::Text-->
											
											<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">????????? ?????? ?????? :'.$row['time'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

											<!--end::Text-->
										</div>

										<!--end::Item-->
										';
										}
										
									
									}
								}else{
									while($row = mysqli_fetch_array($oneweekdelay)){
										$start = 0;
										while($rowid = mysqli_fetch_array($oneweekdelayin)){
											
											// echo "<script>console.log( 'PHP_Console: " . $start . "' );</script>";
											// echo "<script>console.log( 'PHP_Console: " . $rowid['stid']  . "' );</script>";
											echo "<script>console.log( 'PHP_Console: " . $rowid['stid']  . " - " . $row['stid']  . "' );</script>";
											echo "<script>console.log( 'PHP_Console: " . $rowid['Consultant'] ." - " . $user_profile ."' );</script>";
											// echo "<script>console.log( 'PHP_Console: " . $user_profile  . "' );</script>";
											if($rowid['stid'] == $row['stid'] and $rowid['Consultant'] == $user_profile){	
												$start = 1;
											
												
											}
										}

										if($row['Consultant'] == $user_profile and $start==0){

										echo '
										<!--begin::Item-->
										<div class="timeline-item align-items-start">

											<!--begin::Label-->
											<div class="timeline-label font-weight-bolder text-dark-75">
												<p>'.$row['stdname'].'</p>
												<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

											
											</div>

											<!--end::Label-->

											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="fa fa-genderless text-danger icon-xl"></i>
											</div>

											<!--end::Badge-->

											<!--begin::Text-->
											
											<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">????????? ?????? ?????? :'.$row['time'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

											<!--end::Text-->
										</div>

										<!--end::Item-->
										';
										}
									
									}

								}
								?>

							</div>

							<!--end::Timeline-->
						</div>

						<!--end: Card Body-->
					</div>

					<!--end: List Widget 9-->

					<!--[html-partial:end:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->
				</div>
				<div class="col-lg-6">

					<!--[html-partial:begin:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->

					<!--begin::List Widget 9-->
					<div class="card card-custom card-stretch gutter-b">

						<!--begin::Header-->
						<div class="card-header align-items-center border-0 mt-4">
							<h3 class="card-title align-items-start flex-column">
								<span class="font-weight-bolder text-dark">14??? ?????? ????????????</span>
								
							</h3>
						
						</div>

						<!--end::Header-->

						<!--begin::Body-->
						<div class="card-body pt-4">

							<!--begin::Timeline-->
							<div class="timeline timeline-6 mt-3">
								<?php
								if($user_activate == '1' or $user_activate == '2' or $_SESSION['is_admin']==1){
								
									while($row = mysqli_fetch_array($twoweekdelay)){
										

										echo '
										<!--begin::Item-->
										<div class="timeline-item align-items-start">

											<!--begin::Label-->
											<div class="timeline-label font-weight-bolder text-dark-75">
												<p>'.$row['stdname'].'</p>
												<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

											
											</div>

											<!--end::Label-->

											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="fa fa-genderless text-danger icon-xl"></i>
											</div>

											<!--end::Badge-->

											<!--begin::Text-->
											
											<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">????????? ?????? ?????? :'.$row['time'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

											<!--end::Text-->
										</div>

										<!--end::Item-->
										';
										
									
									}
								}else{
									while($row = mysqli_fetch_array($twoweekdelay)){
											echo "<script>console.log( 'PHP_Console: " . $row['stid']  . "' );</script>";
											$start = 0;
										while($rowid = mysqli_fetch_array($twoweekdelayin)){
											
											// echo "<script>console.log( 'PHP_Console: " . $start . "' );</script>";
											// echo "<script>console.log( 'PHP_Console: " . $rowid['stid']  . "' );</script>";
											echo "<script>console.log( 'PHP_Console: " . $rowid['stid']  . " - " . $row['stid']  . "' );</script>";
											echo "<script>console.log( 'PHP_Console: " . $rowid['Consultant'] ." - " . $user_profile ."' );</script>";
											// echo "<script>console.log( 'PHP_Console: " . $user_profile  . "' );</script>";
											if($rowid['stid'] == $row['stid'] and $rowid['Consultant'] == $user_profile){	
												$start = 1;
											
												
											}
										}
										echo "<script>console.log( 'PHP_Console: " . $start ."' );</script>";

										if($row['Consultant'] == $user_profile and $start==0){

										echo '
										<!--begin::Item-->
										<div class="timeline-item align-items-start">

											<!--begin::Label-->
											<div class="timeline-label font-weight-bolder text-dark-75">
												<p>'.$row['stdname'].'</p>
												<p class="font-weight-mormal timeline-content text-muted">'.$row['Consultant'].'</p>

											
											</div>

											<!--end::Label-->

											<!--begin::Badge-->
											<div class="timeline-badge">
												<i class="fa fa-genderless text-danger icon-xl"></i>
											</div>

											<!--end::Badge-->

											<!--begin::Text-->
											
											<div class="info_color">

													<div class="font-weight-mormal font-size-lg timeline-content text-muted pl-3 info_data">????????? ?????? ?????? :'.$row['time'].'</div>

													<button class="btn btn-moreInfo">?????????</button>
													</div>

											<!--end::Text-->
										</div>

										<!--end::Item-->
										';
										}
									
									}

								}
								?>

							</div>

							<!--end::Timeline-->
						</div>

						<!--end: Card Body-->
					</div>

					<!--end: List Widget 9-->

					<!--[html-partial:end:{"id":"demo1/dist/inc/view/partials/content/widgets/lists/widget-9","page":"index"}]/-->
				</div>
			</div>

			<!--end::Row-->



			<!--end::Row-->

			<!--end::Dashboard-->

			<!--[html-partial:end:{"id":"demo1/dist/inc/view/partials/content/dashboards/demo1","page":"index"}]/-->

			<!--[html-partial:end:{"id":"demo1/dist/inc/view/demos/pages/index","page":"index"}]/-->
		</div>

		<!--end::Container-->
	</div>
<?php }?>


<?php

if ( ($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['stc']) and isset($_POST['at'])){

    $conn=mysqli_connect("127.0.0.1","root","gm2580!!","stlist");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    mysqli_query($conn, "set session character_set_connection=utf8;");

    mysqli_query($conn, "set session character_set_results=utf8;");

    mysqli_query($conn, "set session character_set_client=utf8;");
    $stc = $_POST["stc"];
    $time = $_POST["time"];
    $allowtest = (isset($_POST['allowtest'])) ? 1 : 0;


    $sql = "
    UPDATE stconsult

    SET allowtest = '{$allowtest}'

    WHERE time = '{$time}' and stid ='{$stc}';

  ";
  $result = mysqli_query($conn, $sql);
  if($result === false){
    echo '<script>alert("???????????? ???????????? ????????? ???????????????. ??????????????? ??????????????????")</script>';
    error_log(mysqli_error($conn));
  } 

  mysqli_close($conn);

  header("Location: mainpage.php");


}
if ( ($_SERVER['REQUEST_METHOD'] == 'POST') and isset($_POST['stc']) and isset($_POST['ao'])){

    $conn=mysqli_connect("127.0.0.1","root","gm2580!!","stlist");
    // Check connection
    if (mysqli_connect_errno())
    {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    mysqli_query($conn, "set session character_set_connection=utf8;");

    mysqli_query($conn, "set session character_set_results=utf8;");

    mysqli_query($conn, "set session character_set_client=utf8;");
    $stc = $_POST["stc"];
    $time = $_POST["time"];
    $allowok = (isset($_POST['allowok'])) ? 1 : 0;


    $sql = "
    UPDATE stconsult

    SET allowok = '{$allowok}'

    WHERE time = '{$time}' and stid ='{$stc}';

  ";
  $result = mysqli_query($conn, $sql);
  if($result === false){
    echo '<script>alert("???????????? ???????????? ????????? ???????????????. ??????????????? ??????????????????")</script>';
    error_log(mysqli_error($conn));
  } 

  mysqli_close($conn);

  header("Location: mainpage.php");


}

?>
