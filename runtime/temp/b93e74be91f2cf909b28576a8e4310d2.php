<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:91:"G:\phpstudy\PHPTutorial\WWW\yaohao\public/../application/admin\view\building_house\add.html";i:1559052942;s:77:"G:\phpstudy\PHPTutorial\WWW\yaohao\application\admin\view\layout\default.html";i:1557482263;s:74:"G:\phpstudy\PHPTutorial\WWW\yaohao\application\admin\view\common\meta.html";i:1557482263;s:76:"G:\phpstudy\PHPTutorial\WWW\yaohao\application\admin\view\common\script.html";i:1557482263;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="add-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Building_id'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-building_id" data-rule="required" data-source="building/index" data-primary-key="building_id" class="form-control selectpage" name="row[building_id]" type="text" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Tung'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-tung" data-rule="required" class="form-control" name="row[tung]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Unit'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-unit" data-rule="required" class="form-control" name="row[unit]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Floor'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-floor" data-rule="required" class="form-control" name="row[floor]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Number'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-number" data-rule="required" class="form-control" name="row[number]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Room'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-room" data-rule="required" class="form-control" name="row[room]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Saloon'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-saloon" data-rule="required" class="form-control" name="row[saloon]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Toilet'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-toilet" data-rule="required" class="form-control" name="row[toilet]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Balcony'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-balcony" data-rule="required" class="form-control" name="row[balcony]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Area'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-area" data-rule="required" class="form-control" step="0.01" name="row[area]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Category'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-category" data-rule="required" class="form-control selectpicker" name="row[category]">
                <?php if(is_array($categoryList) || $categoryList instanceof \think\Collection || $categoryList instanceof \think\Paginator): if( count($categoryList)==0 ) : echo "" ;else: foreach($categoryList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Renovation'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-renovation" data-rule="required" class="form-control selectpicker" name="row[renovation]">
                <?php if(is_array($renovationList) || $renovationList instanceof \think\Collection || $renovationList instanceof \think\Paginator): if( count($renovationList)==0 ) : echo "" ;else: foreach($renovationList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-price" data-rule="required" class="form-control" step="0.01" name="row[price]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Total_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-total_price" data-rule="required" class="form-control" step="0.01" name="row[total_price]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Three_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-three_price" data-rule="required" class="form-control" step="0.01" name="row[three_price]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Six_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-six_price" data-rule="required" class="form-control" step="0.01" name="row[six_price]" type="number">
        </div>
    </div>

    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo $site['version']; ?>"></script>
    </body>
</html>