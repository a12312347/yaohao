<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:85:"D:\phpStudy\PHPTutorial\WWW\yaohao\public/../application/admin\view\building\add.html";i:1559037226;s:77:"D:\phpStudy\PHPTutorial\WWW\yaohao\application\admin\view\layout\default.html";i:1557482263;s:74:"D:\phpStudy\PHPTutorial\WWW\yaohao\application\admin\view\common\meta.html";i:1557482263;s:76:"D:\phpStudy\PHPTutorial\WWW\yaohao\application\admin\view\common\script.html";i:1557482263;}*/ ?>
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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Name'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-name" data-rule="required" class="form-control" name="row[name]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Alias'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-alias" data-rule="required" class="form-control" name="row[alias]" type="text">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Detail_img'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-detail_img" data-rule="required" class="form-control" size="50" name="row[detail_img]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-detail_img" class="btn btn-danger plupload" data-input-id="c-detail_img" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-detail_img"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-detail_img" class="btn btn-primary fachoose" data-input-id="c-detail_img" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-detail_img"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-detail_img"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Thumbnail_img'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-thumbnail_img" data-rule="required" class="form-control" size="50" name="row[thumbnail_img]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-thumbnail_img" class="btn btn-danger plupload" data-input-id="c-thumbnail_img" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-thumbnail_img"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-thumbnail_img" class="btn btn-primary fachoose" data-input-id="c-thumbnail_img" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-thumbnail_img"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-thumbnail_img"></ul>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Status'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            
            <div class="radio">
            <?php if(is_array($statusList) || $statusList instanceof \think\Collection || $statusList instanceof \think\Paginator): if( count($statusList)==0 ) : echo "" ;else: foreach($statusList as $key=>$vo): ?>
            <label for="row[status]-<?php echo $key; ?>"><input id="row[status]-<?php echo $key; ?>" name="row[status]" type="radio" value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"10"))): ?>checked<?php endif; ?> /> <?php echo $vo; ?></label> 
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>

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
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Class'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-class" data-rule="required" class="form-control selectpicker" name="row[class]">
                <?php if(is_array($classList) || $classList instanceof \think\Collection || $classList instanceof \think\Paginator): if( count($classList)==0 ) : echo "" ;else: foreach($classList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Sale'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-sale" data-rule="required" class="form-control selectpicker" name="row[sale]">
                <?php if(is_array($saleList) || $saleList instanceof \think\Collection || $saleList instanceof \think\Paginator): if( count($saleList)==0 ) : echo "" ;else: foreach($saleList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',""))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('House_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-house_price" data-rule="required" class="form-control" step="0.01" name="row[house_price]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Total_price'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-total_price" data-rule="required" class="form-control" step="0.01" name="row[total_price]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_hot'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-is_hot" data-rule="required" class="form-control selectpicker" name="row[is_hot]">
                <?php if(is_array($isHotList) || $isHotList instanceof \think\Collection || $isHotList instanceof \think\Paginator): if( count($isHotList)==0 ) : echo "" ;else: foreach($isHotList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"10"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Address'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-address" data-rule="required" data-toggle="addresspicker" data-input-id="c-address" data-lng-id="c-longitude" data-lat-id="c-latitude" class="form-control" name="row[address]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Longitude'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-longitude" data-rule="required" class="form-control" name="row[longitude]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Latitude'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-latitude" data-rule="required" class="form-control" name="row[latitude]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Developer'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-developer" class="form-control" name="row[developer]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Use_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-use_time" class="form-control"   name="row[use_time]" type="number" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Green'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-green" class="form-control" step="0.01" name="row[green]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Volume'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-volume" class="form-control" step="0.01" name="row[volume]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Parking'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-parking" class="form-control" name="row[parking]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Traffic'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-traffic" class="form-control" name="row[traffic]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Addr_area'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-addr_area" class="form-control" step="0.01" name="row[addr_area]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Buld_area'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-buld_area" class="form-control" step="0.01" name="row[buld_area]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Complete_time'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-complete_time" class="form-control datetimepicker" data-date-format="YYYY-MM-DD HH:mm:ss" data-use-current="true" name="row[complete_time]" type="text" value="<?php echo date('Y-m-d H:i:s'); ?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Building'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-building" class="form-control" name="row[building]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Householder'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-householder" class="form-control" name="row[householder]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Floor'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-floor" class="form-control" name="row[floor]" type="number">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Property'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input id="c-property" class="form-control" name="row[property]" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Synopsis'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <textarea id="c-synopsis" class="form-control " rows="5" name="row[synopsis]" cols="50"></textarea>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Is_user'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
                        
            <select  id="c-is_user" data-rule="required" class="form-control selectpicker" name="row[is_user]">
                <?php if(is_array($isUserList) || $isUserList instanceof \think\Collection || $isUserList instanceof \think\Paginator): if( count($isUserList)==0 ) : echo "" ;else: foreach($isUserList as $key=>$vo): ?>
                    <option value="<?php echo $key; ?>" <?php if(in_array(($key), explode(',',"20"))): ?>selected<?php endif; ?>><?php echo $vo; ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Real_images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-real_images" data-rule="required" class="form-control" size="50" name="row[real_images]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-real_images" class="btn btn-danger plupload" data-input-id="c-real_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-real_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-real_images" class="btn btn-primary fachoose" data-input-id="c-real_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-real_images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-real_images"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Periphery_images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-periphery_images" data-rule="required" class="form-control" size="50" name="row[periphery_images]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-periphery_images" class="btn btn-danger plupload" data-input-id="c-periphery_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-periphery_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-periphery_images" class="btn btn-primary fachoose" data-input-id="c-periphery_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-periphery_images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-periphery_images"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Template_images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-template_images" data-rule="required" class="form-control" size="50" name="row[template_images]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-template_images" class="btn btn-danger plupload" data-input-id="c-template_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-template_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-template_images" class="btn btn-primary fachoose" data-input-id="c-template_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-template_images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-template_images"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Effect_images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-effect_images" data-rule="required" class="form-control" size="50" name="row[effect_images]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-effect_images" class="btn btn-danger plupload" data-input-id="c-effect_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-effect_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-effect_images" class="btn btn-primary fachoose" data-input-id="c-effect_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-effect_images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-effect_images"></ul>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Bird_images'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input id="c-bird_images" data-rule="required" class="form-control" size="50" name="row[bird_images]" type="text">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-bird_images" class="btn btn-danger plupload" data-input-id="c-bird_images" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="true" data-preview-id="p-bird_images"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-bird_images" class="btn btn-primary fachoose" data-input-id="c-bird_images" data-mimetype="image/*" data-multiple="true"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-bird_images"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-bird_images"></ul>
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