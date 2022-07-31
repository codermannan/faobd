<div class="sidebar-menu">
    <header class="logo-env" >

        <!-- logo -->
        <div class="logo" style="">
            <a href="<?php echo base_url(); ?>">
                <img src="uploads/rehan.png"  style="max-height:100px;"/>
            </a>
        </div>

        <!-- logo collapse icon -->
        <div class="sidebar-collapse" style="">
            <a href="#" class="sidebar-collapse-icon with-animation">

                <i class="entypo-menu"></i>
            </a>
        </div>

        <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
        <div class="sidebar-mobile-menu visible-xs">
            <a href="#" class="with-animation">
                <i class="entypo-menu"></i>
            </a>
        </div>
    </header>

    <div style="border-top:1px solid rgba(69, 74, 84, 0.7);"></div>	
    <ul id="main-menu" class="">
        <!-- add class "multiple-expanded" to allow multiple submenus to open -->
        <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->


        <!-- DASHBOARD -->
        <li class="<?php if ($page_name == 'dashboard') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/dashboard">
                <i class="entypo-gauge"></i>
                <span><?php echo get_phrase('dashboard'); ?></span>
            </a>
        </li>

        <!-- FILE UPLOAD -->
        <li class="<?php if ($page_name == 'csv_file_upload') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/file_upload">
                <i class="entypo-upload"></i>
                <span><?php echo get_phrase('file_upload'); ?></span>
            </a>

        </li>

       <!-- indicators_1_json -->
        <li class="<?php if ($page_name == 'indicators_1_json') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/indicators_1_json">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('indicators_1_json'); ?></span>
            </a>

        </li>

        <!-- indicators_advanced_1 -->
        <li class="<?php if ($page_name == 'indicators_advanced_1') echo 'active'; ?> ">
            <a href="<?php echo base_url(); ?>index.php?<?php echo $account_type; ?>/indicators_advanced_1">
                <i class="entypo-chart-area"></i>
                <span><?php echo get_phrase('indicators_advanced_1'); ?></span>
            </a>

        </li>
    </ul>

</div>