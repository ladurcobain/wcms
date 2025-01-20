<nav class="collapse">
    <?php
            
        $slug = app()->view->getSections()['slug']; 
        $slug = trim($slug);

        $parent = array();
        $access = array();
        $uri = Curl::endpoint();
        $url = $uri .'/'.'v1/menu-navigation';
        $param = array('slug' => $slug);
        $res = Curl::requestPost($url, $param);
        
        $is_mega = 0;
        if($res->status == true) {
            $is_mega = $res->data->is_mega;
            $access  = $res->data->access;
            $parent  = $res->data->parent;
        }
        else {
            $parent = array(
                "menu_id"           =>  1,
                "menu_name"         => "Beranda",
                "menu_label"        => "Home",
                "menu_description"  => "",
                "menu_icon"         => "fa-home",
                "menu_url"          => "home",
                "menu_nav"          => "1",
                "menu_active"       => "home",
                "menu_parent"       => 0,
                "menu_status"       => 1,
            );
        }
        
        //$parent[] = Dbase::getParentNavigationHome();
         
        /*
        $access = Curl::getAccesssNavigationMenu($slug);
        //echo json_encode($access); die();
        if(!empty($access)) {
            $parent = Dbase::getParentNavigationMenu();
        }
        
        $is_mega = 0;
        $arr_not_mega = array(3,4,5,6);
        for($iu=0; $iu<count($access); $iu++) {
            if (in_array($access[$iu], $arr_not_mega)) {
                $is_mega = 1;
            }
        }
        */
    ?>
    <ul class="nav nav-pills" id="mainNav">
        <?php
        foreach($parent as $row) :
            if (in_array($row->menu_id, $access)) {
            //$child = Dbase::getChildNavigationMenu($row->menu_id);
            $child = $row->child;
            if($row->menu_id == 1) { ?>
        <li>
            <a class="<?php echo Request::is('*'. $row->menu_active.'*') ? 'active' : ''; ?>" href="<?php echo url($row->menu_url) ?>"><?php echo Session::get('flag') == 'uk'? $row->menu_label : $row->menu_name; ?></a>
        </li>
        <?php } else if($row->menu_id == 2) { ?>
        
            <?php if($is_mega == 1) { ?>
            <li class="dropdown dropdown-mega">
                <a class="dropdown-item dropdown-toggle <?php echo Request::is('*'. $row->menu_active.'*') ? 'active' : ''; ?>" href="javascript:void(0);">
                    <?php echo Session::get('flag') == 'uk'? $row->menu_label : $row->menu_name; ?>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <div class="dropdown-mega-content">
                            <div class="row">
                                <?php $ix = 0; ?>
                                <?php foreach($child as $rows) : ?>
                                <?php if (in_array($rows->menu_id, $access)) { ?>
                                <?php 
                                    $ix = $ix + 1; 
                                ?>  
                                
                                <?php if($ix == 1) { ?>
                                <div class="col-lg-6">
                                    <span class="dropdown-mega-sub-title"><?php echo Session::get('flag') == 'uk'? 'Introduction' : 'Sekilas'; ?></span>
                                    <ul class="dropdown-mega-sub-nav">
                                <?php } ?>
                                        
                                        <li><a <?php echo Request::is('*'. $rows->menu_active.'*') ? 'style="background-color: #00AC69; color: #fff;"' : ''; ?> class="dropdown-item" href="<?php echo url($rows->menu_url) ?>"><?php echo Session::get('flag') == 'uk'? $rows->menu_label : $rows->menu_name; ?></a></li>
                                        
                                <?php if($ix == 5) { ?>        
                                    </ul>
                                </div>
                                <div class="col-lg-6">
                                    <span class="dropdown-mega-sub-title"><?php echo Session::get('flag') == 'uk'? 'Profile' : 'Profil'; ?></span>
                                    <ul class="dropdown-mega-sub-nav">
                                <?php } ?>

                                <?php if($ix == 10) { ?>        
                                    </ul>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
            <?php } else { ?>
            <li class="dropdown">
                <a class="dropdown-item dropdown-toggle <?php echo Request::is('*'. $row->menu_active.'*') ? 'active' : ''; ?>" href="javascript:void(0);">
                    <?php echo Session::get('flag') == 'uk'? $row->menu_label : $row->menu_name; ?>
                </a>
                <ul class="dropdown-menu">
                    <?php foreach($child as $rows) : ?>
                    <?php if (in_array($rows->menu_id, $access)) { ?>
                    <li><a <?php echo Request::is('*'. $rows->menu_active.'*') ? 'style="background-color: #00AC69; color: #fff;"' : ''; ?>  class="dropdown-item" href="<?php echo url($rows->menu_url) ?>"><?php echo Session::get('flag') == 'uk'? $rows->menu_label : $rows->menu_name; ?></a></li>
                    <?php } ?>
                    <?php endforeach; ?>
                </ul>
            </li>
            <?php } ?>

        <?php } else if($row->menu_id == 7) { ?>
        <li>
            <a class="<?php echo Request::is('*'. $row->menu_active.'*') ? 'active' : ''; ?>" href="<?php echo url($row->menu_url) ?>"><?php echo Session::get('flag') == 'uk'? $row->menu_label : $row->menu_name; ?></a>
        </li>
        <?php } else {
        ?>
        <li class="dropdown">
            <a class="dropdown-item dropdown-toggle <?php echo Request::is('*'. $row->menu_active.'*') ? 'active' : ''; ?>" href="javascript:void(0);">
                <?php echo Session::get('flag') == 'uk'? $row->menu_label : $row->menu_name; ?>
            </a>
            <ul class="dropdown-menu">
                <?php foreach($child as $rows) : ?>
                <?php if (in_array($rows->menu_id, $access)) { ?>
                <li><a <?php echo Request::is('*'. $rows->menu_active.'*') ? 'style="background-color: #00AC69; color: #fff;"' : ''; ?>  class="dropdown-item" target='<?php echo (($rows->menu_id == 51)?"_blank":""); ?>' href="<?php echo (($rows->menu_id == 51)?"https://jdih.kejaksaan.go.id/":url($rows->menu_url)); ?>"><?php echo Session::get('flag') == 'uk'? $rows->menu_label : $rows->menu_name; ?></a></li>
                <?php } ?>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php        
            }
        }
        endforeach;
        ?>

        
    </ul>
</nav>