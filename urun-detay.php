<?php include 'header.php';

$urunsor=$db->prepare("SELECT * from urun where urun_seourl=:seourl");
$urunsor->execute(array(
	'seourl'=> $_GET['sef'] 
));
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC); 
$say=$urunsor->rowCount();

if ($say==0) {

	header("Location:index.php?durum=oynasma");
	exit;
}
?>

<head>
	
	<!-- fancy Style -->
	<link rel="stylesheet" type="text/css" href="js\product\jquery.fancybox.css?v=2.1.5" media="screen">
</head>


<?php 

if (isset($_GET['durum']) && $_GET['durum'] == "ok") { ?>

	<script type="text/javascript">
		alert("Yorum Başarıyla Eklendi");
	</script> 

<?php } ?>


<div class="container">
	<div class="clearfix"></div>
	<div class="lines"></div>
</div>

<div class="container">
	<div class="row">
	</div>
	<div class="row">
		<div class="col-md-9"><!--Main content-->
			<div class="title-bg">
				<div class="title"><?php echo $uruncek['urun_ad']; ?></div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<div class="dt-img">
						<div class="detpricetag"><div class="inner"><?php echo $uruncek['urun_fiyat']; ?> TL</div></div>
						<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-4.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-4.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-5.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-5.jpg" alt="" class="img-responsive"></a>
					</div>
					<div class="thumb-img">
						<a class="fancybox" href="images\sample-1.jpg" data-fancybox-group="gallery" title="Cras neque mi, semper leon"><img src="images\sample-1.jpg" alt="" class="img-responsive"></a>
					</div>
				</div>
				<div class="col-md-6 det-desc">
					<div class="productdata">
						<div class="infospan">Ürün Kodu <span><?php echo $uruncek['urun_id']; ?></span></div>
						<div class="infospan">Ürün Fiyat <span><?php echo $uruncek['urun_fiyat']; ?></span></div>

						<div class="clearfix"></div>
						<hr>
						<form action="nedmin/netting/islem.php" method="POST">
							<div class="form-group">
								<label for="qty" class="col-sm-2 control-label">Adet</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" value="1" name="urun_adet">
								</div>
								<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">

										<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
								<div class="col-sm-4">
									<button type="submit" name="sepetekle" class="btn btn-default btn-red btn-sm"><span class="addchart">Sepete Ekle</span></button>
								</div>
								<div class="clearfix"></div>
							</div>
						</form>

						<div class="sharing">
							<div class="avatock"><span>
								<?php if($uruncek['urun_stok']>=1){
									echo "stok adedi:" .$uruncek['urun_stok'];
								}else {
									echo "stokta yok"; }?>

								</span></div>
							</div>

						</div>
					</div>
				</div>

				<div class="tab-review">
					<ul id="myTab" class="nav nav-tabs shop-tab">
						<li <?php if (isset($_GET['durum']) && $_GET['durum'] !== "ok") { ?>
							class="active"
							<?php } ?>>
							<a href="#desc" data-toggle="tab">Açıklama</a>
						</li>

						<?php 
						$urun_id=$uruncek['urun_id'];
						$yorumsor=$db->prepare("SELECT * FROM yorumlar WHERE urun_id=:urun_id");
						$yorumsor->execute(array(
							'urun_id'=>$urun_id
						));

					 ?>


						<li <?php if($_GET['durum'] ="ok") { ?>

							class="active"

							<?php } ?>>
							<a href="#rev" data-toggle="tab">Yorumlar (<?php echo $yorumsor->rowCount(); ?>)</a></li>




							<li class="">
								<a href="#video" data-toggle="tab">Ürün Video</a></li>
							</ul>


							<div id="myTabContent" class="tab-content shop-tab-ct">
								<div class="tab-pane fade <?php if (isset($_GET['durum']) && $_GET['durum'] !== "ok") { echo 'active in'; } ?>" id="desc">
									<p>
										<?php echo $uruncek['urun_detay']; ?>
									</p>
								</div>


								<div class="tab-pane fade <?php if ($_GET['durum']=="ok") {?>
									active in
									<?php } ?>" id="rev">


									<?php 


									while($yorumcek=$yorumsor->fetch(PDO::FETCH_ASSOC)) {

									$ykullanici_id=$yorumcek['kullanici_id'];

									$ykullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_id=:id");
									$ykullanicisor->execute(array(
										'id' => $ykullanici_id
										));

										$ykullanicicek=$ykullanicisor->fetch(PDO::FETCH_ASSOC);	
										?>

										<p class="dash">
											<span><?php echo $ykullanicicek['kullanici_adsoyad'] ?></span> (<?php echo $yorumcek['yorum_zaman'] ?>)<br><br>
											<?php echo $yorumcek['yorum_detay'] ?>
										</p>

										<!-- Yorumları Dökeceğiz -->

									<?php } ?>
									
									<h4>Yorum Yazın</h4>
									<?php if(isset($_SESSION['userkullanici_mail'])) { ?>

										<form  action="nedmin/netting/islem.php" method="POST" role="form">



											<div class="form-group">
												<textarea name="yorum_detay" class="form-control" placeholder="Lütfen yorumunuzu buraya yazınız!" id="text"></textarea>
											</div>
											<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']; ?>">
											<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
											<input type="hidden" name="gelen_url" value="<?php 
											echo "http://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']."";
										?>">
										<input type="hidden" name="urun_id" value="<?php echo $uruncek['urun_id'] ?>">
										<button type="submit" name="yorumkaydet" class="btn btn-default btn-red btn-sm">Gönder</button>
									</form>

								<?php } else{ ?> 
									Yorum yazabilmek için <a style="color: skyblue;" href="register">kayıt</a> yapınız!
								<?php } ?>





							</div>

							<div class="tab-pane fade" id="video">
								<p>


									<?php 

									$say=strlen($uruncek['urun_video']);

									if ($say>0) {?>

										<iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $uruncek['urun_video'] ?>" frameborder="0" allowfullscreen></iframe>

									<?php } else {
										echo "Bu ürüne video eklenmemiştir";

									}

									?>
								</p>
							</div>

						</div>
					</div>

					<div id="title-bg">
						<div class="title">Benzer Ürünler</div>
					</div>
					<div class="row prdct"><!--Products-->

						<?php

						$kategori_id=$uruncek['kategori_id'];
						$urunaltsor=$db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id ORDER BY rand() DESC limit 3");
						$urunaltsor->execute(array(
							'kategori_id'=> $kategori_id )); 
						while($urunaltcek=$urunaltsor->fetch(PDO::FETCH_ASSOC)) {
							?>

							<div class="col-md-4">
								<div class="productwrap">
									<div class="pr-img">
										<div class="hot"></div>
										<a href="urun-<?=seo($urunaltcek["urun_ad"])?>"><img src="images\sample-3.jpg" alt="" class="img-responsive"></a>
										<div class="pricetag on-sale"><div class="inner on-sale"><span class="onsale"><span class="oldprice"><?php echo $urunaltcek['urun_fiyat']*1.5 ?> TL</span><?php echo $urunaltcek['urun_fiyat'] ?> TL</span></div></div>
									</div>
									<span class="smalltitle"><a href="urun-<?=seo($urunaltcek["urun_ad"]);?>"><?php echo $urunaltcek['urun_ad'] ?></a></span>
									<span class="smalldesc">Ürün Kodu: <?php echo $urunaltcek['urun_id'] ?></span>
								</div>
							</div>
						<?php } ?>

					</div><!--Products-->
					<div class="spacer"></div>
				</div><!--Main content-->


				<?php include 'sidebar.php' ?>
			</div>
		</div>

		<?php include 'footer.php' ?>