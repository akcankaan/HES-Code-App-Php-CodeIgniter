<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Kullanıcı Listesi
            <?php if(isAllowedWriteModule()) {?>
            <a href="<?php echo base_url("users/new_form"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-plus"></i> Yeni Ekle</a>
            <?php } ?>
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget p-lg table-responsive">

            <?php if(empty($items)) { ?>

                <div class="alert alert-info text-center">
                    <p>Burada herhangi bir veri bulunmamaktadır. Eklemek için lütfen <a href="<?php echo base_url("users/new_form"); ?>">tıklayınız</a></p>
                </div>

            <?php } else { ?>
                <div class="table-responsive">
                <table id="example" data-plugin="DataTable" class="table">
                    <thead>
                        <th>Kullanıcı Adı</th>
                        <th>Ad Soyad</th>
                        <th>E-Posta</th>
                        <th>Durumu</th>
                        <th>İşlem</th>
                    </thead>
                    <tbody>

                        <?php foreach($items as $item) { ?>

                            <tr>
                                <td><?php echo $item->user_name; ?></td>
                                <td><?php echo $item->full_name; ?></td>
                                <td class="text-center"><?php echo $item->email; ?></td>
                                <td class="text-center w100">
                                <?php if(isAllowedUpdateModule()) {?>
                                    <input
                                        data-url="<?php echo base_url("users/isActiveSetter/$item->id"); ?>"
                                        class="isActive"
                                        type="checkbox"
                                        data-switchery
                                        data-color="#10c469"
                                        <?php echo ($item->isActive) ? "checked" : ""; ?>
                                    />
                                    <?php } ?>
                                </td>
                                <td class="text-center w400">
                                    <?php if(isAllowedDeleteModule()) {?>
                                        <button
                                            data-url="<?php echo base_url("users/delete/$item->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn">
                                            <i class="fa fa-trash"></i> Sil
                                        </button>
                                    <?php } ?>
                                    <?php if(isAllowedUpdateModule()) {?>
                                    <a href="<?php echo base_url("users/update_form/$item->id"); ?>" class="btn btn-sm btn-info btn-outline"><i class="fa fa-pencil-square-o"></i> Düzenle</a>
                                    <?php } ?>
                                    <?php if(isAllowedUpdateModule()) {?>
                                    <a href="<?php echo base_url("users/password_form/$item->id"); ?>" class="btn btn-sm btn-purple btn-outline"><i class="fa fa-key"></i> Şifre Değiştir</a>
                                    <?php } ?>
                                </td>
                            </tr>

                        <?php } ?>

                    </tbody>

                </table>
                </div>

            <?php } ?>

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