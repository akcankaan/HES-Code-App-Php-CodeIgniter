<?php $user= get_active_user();?>

<aside id="menubar" class="menubar light">
    <div class="app-user">
        <div class="media">
            <div class="media-left">
                <div class="avatar avatar-md avatar-circle">
                    <a href="javascript:void(0)"><img class="img-responsive" src="<?php echo base_url("assets"); ?>/assets/images/hes-logo.png" alt="avatar"/></a>
                </div><!-- .avatar -->
            </div>
            <div class="media-body">
                <div class="foldable">
                    <h5><a href="javascript:void(0)" class="username"><?php echo $user->full_name; ?></a></h5>
                    <ul>
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle usertitle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <small>İşlemler</small>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu animated flipInY">
                                <li>
                                    <a class="text-color" href="<?php echo base_url(); ?>">
                                        <span class="m-r-xs"><i class="fa fa-home"></i></span>
                                        <span>Anasayfa</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("users/update_form/$user->id"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-user"></i></span>
                                        <span>Profilim</span>
                                    </a>
                                </li>                        
                                <li role="separator" class="divider"></li>
                                <li>
                                    <a class="text-color" href="<?php echo base_url("logout"); ?>">
                                        <span class="m-r-xs"><i class="fa fa-power-off"></i></span>
                                        <span>Çıkış</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div><!-- .media-body -->
        </div><!-- .media -->
    </div><!-- .app-user -->

    <div class="menubar-scroll">
        <div class="menubar-scroll-inner">
            <ul class="app-menu">

                <?php if(isAllowedViewModule("dashboard")){ ?>
                    <li class="<?php echo $viewFolder == "dashboard_v" ? "active" : ""; ?>">
                        <a href="<?php echo base_url("dashboard"); ?>">
                            <i class="menu-icon zmdi zmdi-view-dashboard zmdi-hc-lg"></i>
                            <span class="menu-text">Dashboard</span>
                        </a>
                    </li>
                <?php } ?>

                <?php if(isAllowedViewModule("virusstatus")){ ?>
                    <li class="<?php echo $viewFolder == "virus_status_v" ? "active" : ""; ?>">
                        <a href="<?php echo base_url("virusstatus"); ?>">
                            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
                            <span class="menu-text">Virüs Durumu</span>
                        </a>
                    </li>
                <?php }?>

                <?php if(isAllowedViewModule("users")){ ?>
                    <li class="<?php echo $viewFolder == "users_v" ? "active" : ""; ?>">
                        <a href="<?php echo base_url("users"); ?>">
                            <i class="menu-icon fa fa-user-secret"></i>
                            <span class="menu-text">Kullanıcılar</span>
                        </a>
                    </li>
                <?php }?>

                <?php if(isAllowedViewModule("user_roles")){ ?>
                    <li class="<?php echo $viewFolder == "user_roles_v" ? "active" : ""; ?>">
                        <a href="<?php echo base_url("user_roles"); ?>">
                            <i class="menu-icon fa fa-eye"></i>
                            <span class="menu-text">Kullanıcı Rolü</span>
                        </a>
                    </li>
                <?php }?>

                <?php if(isAllowedViewModule("emailsettings")){ ?>
                    <li class="<?php echo $viewFolder == "email_settings_v" ? "active" : ""; ?>">
                        <a href="<?php echo base_url("emailsettings"); ?>">
                            <i class="menu-icon zmdi zmdi-email zmdi-hc-lg"></i>
                            <span class="menu-text">E-posta Ayarları</span>
                        </a>
                    </li>
                <?php }?>
            </ul><!-- .app-menu -->
        </div><!-- .menubar-scroll-inner -->
    </div><!-- .menubar-scroll -->
</aside>