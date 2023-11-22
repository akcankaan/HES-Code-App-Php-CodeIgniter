<div class="simple-page-wrap">
		<div class="simple-page-logo animated swing">
			<a href="<?php echo base_url(); ?>">
                <img class="" src="<?php echo base_url("assets"); ?>/assets/images/hes-logo.png" alt="Logo"/>
			</a>
		</div><!-- logo -->		
<div class="simple-page-form animated flipInY" id="signup-form">
	<h4 class="form-title m-b-xl text-center">Yeni Bir Hesap İçin Kaydolun</h4>
	<form action="<?php echo base_url("kaydet"); ?>" method="post">
			<div class="form-group">
    			<input class="form-control" placeholder="Kullanıcı Adı" name="user_name" value="<?php echo isset($form_error) ? set_value("user_name") : ""; ?>">
    			<?php if(isset($form_error)){ ?>
    			    <small class="pull-right input-form-error"> <?php echo form_error("user_name"); ?></small>
    			<?php } ?>
			</div>
			<div class="form-group">
			    <input class="form-control" placeholder="Adı Soyad" name="full_name" value="<?php echo isset($form_error) ? set_value("full_name") : ""; ?>">
			    <?php if(isset($form_error)){ ?>
			        <small class="pull-right input-form-error"> <?php echo form_error("full_name"); ?></small>
			    <?php } ?>
			</div>
			<div class="form-group">
    			<label>Doğum Tarihi</label>
    			<input class="form-control" placeholder="Doğum Tarihi" name="date_of_birth" type="date" value="<?php echo isset($form_error) ? set_value("date_of_birth") : ""; ?>">
    			<?php if(isset($form_error)){ ?>
    			    <small class="pull-right input-form-error"> <?php echo form_error("date_of_birth"); ?></small>
    			<?php } ?>
			</div>

			<div class="form-group">
    			<div class="contact-name">
    			    <span>İller</span>
    			    <i class="flaticon-user-11"></i>
    			    <select required  name="provinceID"  class="form-control" placeholder="İl">
    			    <option value="0">Seçiniz...</option>
    			        <?php foreach ($provinces as $province) {?>
    			        <option value="<?=$province->id?>"> <?=$province->provinceName?></option>
    			        <?php } ?>
    			        <?php if(isset($form_error)){ ?>
    			        <small class="pull-right input-form-error"> <?php echo form_error("provinceID"); ?></small>
    			        <?php } ?>
    			    </select>
						
    			</div>
			</div>
			<div class="form-group">
			    <input class="form-control" type="email" placeholder="E-Posta Adresi" name="email" value="<?php echo isset($form_error) ? set_value("email") : ""; ?>">
			    <?php if(isset($form_error)){ ?>
			        <small class="pull-right input-form-error"> <?php echo form_error("email"); ?></small>
			    <?php } ?>
			</div>
			<div class="form-group">
			    <input class="form-control" type="password" placeholder="Şifre" name="password">
			    <?php if(isset($form_error)){ ?>
			        <small class="pull-right input-form-error"> <?php echo form_error("password"); ?></small>
			    <?php } ?>
			</div>
			<div class="form-group">
			    <input class="form-control" type="password" placeholder="Şifre Tekrar" name="re_password">
			    <?php if(isset($form_error)){ ?>
			        <small class="pull-right input-form-error"> <?php echo form_error("re_password"); ?></small>
			    <?php } ?>
			</div>
		<button type="submit" class="btn btn-primary">Kayıt Ol</button>
	</form>
</div><!-- #login-form -->

<div class="simple-page-footer">
	<p>
		<small>Bir hesabın var mı ?</small>
		<a href="<?php echo base_url("login"); ?>">Giriş Yap</a>
	</p>
</div><!-- .simple-page-footer -->