<?php
 $user= get_active_user();
 $userHasHesCode = $user->hes_code ? true : false;
 ?>
<div class="profile-cover">
	<div class="cover-user m-b-lg">
		<div>
		</div>
	</div>
	<div class="text-center">
	<?php if (!$userHasHesCode): // Eğer hes kodu yoksa ?>
	<a href="<?php echo base_url("dashboard/generate_hes_code/$user->id"); ?>" class="btn btn-md btn-danger btn-outline">Hes Kodu Oluştur</a>
	<?php endif; ?>
		<h4 class="profile-info-name m-b-lg"><a href="javascript:void(0)" class="title-color"><?php echo $user->full_name; ?></a></h4>
		<div>
			<a href="javascript:void(0)" class="theme-color"><i class="fa fa-map-marker m-r-xs"></i><?php echo province_find($user->provinceID); ?></a>
		</div>
	</div>
</div><!-- .profile-cover -->
<div class="promo-footer">
	<div class="row no-gutter">
		<div class="col-sm-2 col-sm-offset-3 col-xs-6 promo-tab">
			<div class="text-center">
				<small>Doğum Tarihi</small>
				<h4 class="m-0 m-t-xs"><?php echo $user->date_of_birth; ?></h4>
			</div>
		</div>
		<div class="col-sm-2 col-xs-6 promo-tab">
			<div class="text-center">
				<small>Hes Kodu</small>
				<?php foreach($items as $item) { ?>
				<?php if($item->user_id==$user->id) { ?>
				<h4 class="m-0 m-t-xs"><?php echo $item->hes_code; ?></h4>
				<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="col-sm-2 col-xs-12 promo-tab">
			<div class="text-center">
				<small>Durumu</small>
				<div class="m-t-xs">
				<?php foreach($items as $item) { ?>
				<?php if($item->user_id==$user->id) { ?>
					<h4 class="m-0 m-t-xs"> <?php echo virusstatus_find($item->isVirusStatus); ?></h4>
				<?php } ?>
				<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- .promo-footer -->