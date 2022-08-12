<style type="text/css">
   .widget-user-header {
      padding-left: 20px !important;
   }
</style>

<link rel="stylesheet" href="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.css">

<section class="content-header">
    <h1>
        <?= cclang('dashboard') ?>
        <small>
            
        <?= cclang('control_panel') ?>
        </small>
    </h1>
    <ol class="breadcrumb">
        <li>
            <a href="#">
                <i class="fa fa-dashboard">
                </i>
                <?= cclang('home') ?>
            </a>
        </li>
        <li class="active">
            <?= cclang('dashboard') ?>
        </li>
    </ol>
</section>

<section class="content">
<!--     <div class="row">
        
       <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box button" onclick="goUrl('administrator/crud')">
                <span class="info-box-icon bg-aqua">
                    <i class="ion ion-ios-gear">
                    </i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <?= cclang('crud_builder') ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box button" onclick="goUrl('administrator/rest')">
                <span class="info-box-icon bg-yellow">
                    <i class="ion ion-social-chrome">
                    </i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <?= cclang('api_builder') ?>
                    </span>
                </div>
            </div>
        </div>

         <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box button" onclick="goUrl('administrator/page')">
                <span class="info-box-icon bg-aqua">
                    <i class="ion ion-ios-paper">
                    </i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <?= cclang('page_builder') ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box button" onclick="goUrl('administrator/form')">
                <span class="info-box-icon bg-yellow">
                    <i class="ion ion-android-list">
                    </i>
                </span>
                <div class="info-box-content">
                    <span class="info-box-text">
                        <?= cclang('form_builder') ?>
                    </span>
                </div>
            </div>
        </div>

    </div> -->
    
      <!-- /.row -->
</section>
<!-- /.content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?= BASE_ASSET; ?>admin-lte/plugins/morris/morris.min.js"></script>

</script>