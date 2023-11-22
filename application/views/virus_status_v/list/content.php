<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Virus Durumu
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg table-responsive">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır.</p>
                </div>

            <?php } else { ?>
                <div class="table-responsive">
                <table id="example" data-plugin="DataTable" class="table">
                    <thead>
                        <th>Kullanıcı Adı</th>
                        <th>Ad Soyad</th>
                        <th>Hes Kodu</th>
                        <th>Virüs Durumu</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>

                            <tr>
                                <td><?php echo user_name_find($item->user_id); ?></td>
                                <td><?php echo full_name_find($item->user_id); ?></td>
                                <td class="text-center"><?php echo $item->hes_code; ?></td>
                                <?php if(isAllowedUpdateModule()) {?>
                                <td>
                                    <form action="<?php echo base_url("virusstatus/isVirusStatus/$item->id"); ?>" method="post">
                                    	<div>
                                    	    <div class="contact-name">
                                    	        <select required  name="isVirusStatus"  class="form-control" placeholder="Virüs Durumu">
                                    	        	<option value="0">Seçiniz...</option>
                                    	            	<?php foreach ($virus_status as $statu) {?>
                                    	            	<option <?=$statu->id==$item->isVirusStatus ? "selected":"" ?> value="<?=$statu->id?>"> <?=$statu->virus_status?></option>
                                    	            	<?php } ?>
                                    	        </select>
                                    	        <button type="submit" class="btn btn-sm btn-danger btn-block"><i class="fa fa-check"></i>Durum Güncelle</button>
                                    	    </div>
                                    	</div>
                                    	<?php  ?>
                                    </form>
                                    <?php } ?>
                                </td>
                                <?php } ?>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
                </div>
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<script src="<?php echo base_url("assets"); ?>/assets/js/jquery-3.5.1.js"></script>
<script src="<?php echo base_url("assets"); ?>/assets/js/dataTables.min.js"></script>
<script src="<?php echo base_url("assets"); ?>/assets/js/dataTables.bootstrap.min.js"></script>

<script>
        $(document).ready( function () {
            var table = $('#example').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.18/i18n/Turkish.json"
                },
            });
        } );
</script>