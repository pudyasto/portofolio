<?= $this->extend('Views/template-frontend/main') ?>

<?= $this->section('content') ?>
<header>
	<div class="container">
		<div class="heading-wrapper">
			<div class="row">
				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="info">
						<i class="icon ion-ios-location-outline"></i>
						<div class="right-area">
							<h5><?= (isset($profile['address'])) ? $profile['address'] : ''; ?></h5>
							<h5><?= (isset($profile['city'])) ? $profile['city'] : ''; ?></h5>
						</div><!-- right-area -->
					</div><!-- info -->
				</div><!-- col-sm-4 -->

				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="info">
						<i class="icon ion-ios-telephone-outline"></i>
						<div class="right-area">
							<h5><?= (isset($profile['phone'])) ? $profile['phone'] : ''; ?></h5>
							<h6>MIN - FRI,8AM - 7PM</h6>
						</div><!-- right-area -->
					</div><!-- info -->
				</div><!-- col-sm-4 -->

				<div class="col-sm-6 col-md-6 col-lg-4">
					<div class="info">
						<i class="icon ion-ios-chatboxes-outline"></i>
						<div class="right-area">
							<h5><?= (isset($profile['email'])) ? $profile['email'] : ''; ?></h5>
							<h6>REPLY IN 24 HOURS</h6>
						</div><!-- right-area -->
					</div><!-- info -->
				</div><!-- col-sm-4 -->
			</div><!-- row -->
		</div><!-- heading-wrapper -->
		<?php if (logged_in()) : ?>
			<a class="downlad-btn" href="/dashboard">Admin Page</a>
		<?php else : ?>
			<a class="downlad-btn" href="/login">Login Page</a>
		<?php endif; ?>
	</div><!-- container -->
</header>

<section class="intro-section">
	<div class="container">
		<div class="row">
			<div class="col-md-1 col-lg-2"></div>
			<div class="col-md-10 col-lg-8">
				<div class="intro">
					<div class="profile-img"><img src="<?= photo_profile(); ?>" alt=""></div>
					<h2><b><?= (isset($profile['full_name'])) ? $profile['full_name'] : ''; ?></b></h2>
					<h4 class="font-yellow"><?= (isset($profile['quotes'])) ? $profile['quotes'] : ''; ?></h4>
					<ul class="information margin-tb-30">
						<li><b>PHONE : </b><?= (isset($profile['phone'])) ? $profile['phone'] : ''; ?></li>
						<li><b>EMAIL : </b><?= (isset($profile['email'])) ? $profile['email'] : ''; ?></li>
					</ul>
					<ul class="social-icons">
						<li><a href="<?= (isset($profile['linkedin'])) ? $profile['linkedin'] : ''; ?>"><i class="ion-social-linkedin"></i></a></li>
						<li><a href="<?= (isset($profile['instagram'])) ? $profile['instagram'] : ''; ?>"><i class="ion-social-instagram"></i></a></li>
						<li><a href="<?= (isset($profile['facebook'])) ? $profile['facebook'] : ''; ?>"><i class="ion-social-facebook"></i></a></li>
						<li><a href="<?= (isset($profile['twitter'])) ? $profile['twitter'] : ''; ?>"><i class="ion-social-twitter"></i></a></li>
					</ul>
				</div><!-- intro -->
			</div><!-- col-sm-8 -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- intro-section -->

<section class="portfolio-section section">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="heading">
					<h3><b>Portfolio</b></h3>
					<h6 class="font-lite-black"><b>MY WORK</b></h6>
				</div>
			</div><!-- col-sm-4 -->
			<div class="col-sm-8">
				<div class="portfolioFilter clearfix margin-b-80">
					<a href="#" data-filter="*" class="current"><b>ALL</b></a>
					<?php foreach ($cat_product as $key => $val) : ?>
						<a href="#" data-filter=".<?= $key; ?>"><b><?= strtoupper($val); ?></b></a>
					<?php endforeach; ?>
				</div><!-- portfolioFilter -->
			</div><!-- col-sm-8 -->
		</div><!-- row -->
	</div><!-- container -->

	<div class="portfolioContainer">

		<?php foreach ($product as $key => $val) : ?>
			<div class="p-item <?= url_title($val['category'], '-', true); ?>">
				<a href="/uploads/products/<?= $val['image']; ?>" class="fluidbox" id="fluidbox-<?= $val['id']; ?>" data-fluidbox>
					<img src="/uploads/products/<?= $val['image']; ?>" alt="" data-name="<?= $val['name']; ?>" data-desc="<?= $val['description']; ?>">
				</a>
			</div><!-- p-item -->
		<?php endforeach; ?>
	</div><!-- portfolioContainer -->

</section><!-- portfolio-section -->


<section class="about-section section">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="heading">
					<h3><b>About me</b></h3>
					<h6 class="font-lite-black"><b>PROFESSIONAL PATH</b></h6>
				</div>
			</div><!-- col-sm-4 -->
			<div class="col-sm-8">
				<p class="margin-b-50">
					<?= (isset($profile['about_me'])) ? $profile['about_me'] : ''; ?>
				</p>

				<div class="row">
					<?php foreach ($skill as $key => $val) : ?>
						<div class="col-sm-6 col-md-6 col-lg-3">
							<div class="radial-prog-area margin-b-30">
								<div class="radial-progress" data-prog-percent=".<?= $val['percent']; ?>">
									<div></div>
									<h6 class="progress-title"><?= $val['name']; ?></h6>
								</div>
							</div><!-- radial-prog-area-->
						</div><!-- col-sm-6-->
					<?php endforeach; ?>

				</div><!-- row -->
			</div><!-- col-sm-8 -->
		</div><!-- row -->
	</div><!-- container -->
</section><!-- about-section -->

<section class="experience-section section">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="heading">
					<h3><b>Work Experience</b></h3>
					<h6 class="font-lite-black"><b>PREVIOUS JOBS</b></h6>
				</div>
			</div><!-- col-sm-4 -->
			<div class="col-sm-8">


				<?php foreach ($work as $key => $val) : ?>


					<div class="experience margin-b-50">
						<h4><b><?= $val['position']; ?></b></h4>
						<h5 class="font-yellow"><b><?= $val['company']; ?></b></h5>
						<h6 class="margin-t-10">
							<?= datetime_short_id($val['date_start']); ?> - <?= (datetime_short_id($val['date_finish'])) ? datetime_short_id($val['date_finish']) : 'Present'; ?>
							(<?= hitung_umur($val['date_start'], $val['date_finish'], 'Y') . ' Yr'; ?>)
						</h6>
						<p class="font-semi-white margin-tb-30">
							<?= $val['description']; ?>
						</p>
					</div><!-- experience -->
				<?php endforeach; ?>
			</div><!-- col-sm-8 -->
		</div><!-- row -->
	</div><!-- container -->

</section><!-- experience-section -->

<section class="education-section section">
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="heading">
					<h3><b>Education</b></h3>
					<h6 class="font-lite-black"><b>ACADEMIC / NON-ACADEMIC CAREER</b></h6>
				</div>
			</div><!-- col-sm-4 -->
			<div class="col-sm-8">
				<div class="education-wrapper">

					<?php foreach ($education as $key => $val) : ?>

						<div class="education margin-b-50">
							<h4><b><?= $val['graduate']; ?></b></h4>
							<h5 class="font-yellow"><b><?= $val['institute']; ?></b></h5>
							<h6 class="font-lite-black margin-t-10">
								<?= datetime_short_id($val['date_start']); ?> - <?= (datetime_short_id($val['date_finish'])) ? datetime_short_id($val['date_finish']) : 'Present'; ?>
							</h6>
							<p class="margin-tb-30">
								<?= $val['description']; ?>
							</p>
						</div><!-- education -->
					<?php endforeach; ?>
				</div><!-- education-wrapper -->
			</div><!-- col-sm-8 -->
		</div><!-- row -->
	</div><!-- container -->

</section><!-- about-section -->

<?= $this->endSection() ?>