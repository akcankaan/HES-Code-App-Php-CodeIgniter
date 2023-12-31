<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Kullanıcı Rolleri Listesi
            <?php if(isAllowedWriteModule()) {?>
            <a href="<?php echo base_url("user_roles/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır.</a></p>
                </div>

            <?php } else { ?>

                <table class="table table-hover table-striped table-bordered content-container">
                    <thead>
                        <th>Başlık</th>
                        <th>Durumu</th>
                        <th>İşlem</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>
                            <tr id="ord-<?php echo $item->id; ?>">
                                <td class="text-center"><?php echo $item->title; ?></td>
                                <td class="text-center w100">
                                <?php if(isAllowedUpdateModule()) {?>
                                    <input
                                        data-url="<?php echo base_url("user_roles/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                    />
                                <?php } ?>
                                </td>
                                <td class="text-center w300">
                                    <?php if(isAllowedDeleteModule()) {?>
                                    <button
                                        data-url="<?php echo base_url("user_roles/delete/$item->id"); ?>"
                                        class="btn btn-sm btn-danger btn-outline remove-btn">
                                        <i class="fa fa-trash"></i> Sil
                                    </button>
                                    <?php } ?>
                                    <?php if(isAllowedUpdateModule()) {?>
                                    <a href="<?php echo base_url("user_roles/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                                    <?php } ?>
                                    <?php if(isAllowedUpdateModule()) {?>
                                    <a href="<?php echo base_url("user_roles/permissions_form/$item->id"); ?>" class="btn btn-sm btn-dark btn-outline"><i class="fa fa-eye"></i> Yetki Tanımı</a>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>

            <?php } ?>

        </div><!-- .widget -->
    </div><!-- END column -->
</div>