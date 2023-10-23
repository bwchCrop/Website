<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $this->session->userdata(_PREFIX.'photo');?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata(_PREFIX.'name');?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>

    <!-- search form >
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
    <!-- /.search form -->

    <div>
      <ul class="sidebar-menu">
        <!-- LISTING PARENT -->
          <?php foreach ($menu as $parent) { ?>
            <li class="header"><?php echo $parent['menu'];?></li>

            <?php $getPosition = $this->mmenu->getPosition($parent['parent'])->result_array();?>

            <!-- LISTING MENU -->
              <?php foreach ($getPosition as $position) { ?>
                <?php 
                    $getSort = $this->mmenu->getSort($parent['parent'],$position['position'])->result_array();
                    
                    $segment_ex = explode('-', $this->uri->segment(1));
                    $link_ex   = explode('-', $position['link']);

                    $n = 0;
                    foreach ($getSort as $sort){ 
                      $link_ex_sort   = explode('-', $sort['link']);
                      if(isset($segment_ex[1]) && isset($link_ex_sort[1])){ 
                        $segment_ex_1   = $segment_ex[1];
                        $link_ex_sort_1 = $link_ex_sort[1];
                      }else{
                        $segment_ex_1   = 1;
                        $link_ex_sort_1 = 0;
                      }
                      if($this->uri->segment(1) == $sort['link'] || $segment_ex_1 == $link_ex_sort_1){ $n++; } 
                    }

                    if(count($segment_ex)>1){ $segment = $segment_ex[1]; }else{ $segment = '1'; }
                    if(count($link_ex)>1)   { $link    = $link_ex[1];    }else{ $link    = '0'; }
                    
                    if($this->uri->segment(1) == $position['link'] || $n>0 || $segment == $link){
                      $active = 'active';
                    }else{
                      $active = '';
                    }

                    if(count($getSort)>0){
                      $class = 'class="treeview '.$active.'"';
                      $link  = '#';
                      $arrow = '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
                    }else{
                      $class = 'class="'.$active.'"';
                      $link  = base_url('').$position['link'];
                      $arrow = '';
                    }
                ?>
                <li <?php echo $class;?>>
                  <a href="<?php echo $link;?>">
                    <i class="<?php echo $position['icon'];?>"></i> <span><?php echo $position['menu'];?></span>
                    <?php echo $arrow;?>
                  </a>

                  <!-- CHECKING SUB MENU -->
                    <?php if(count($getSort)>0){ ?>
                      <ul class="treeview-menu">
                        <!-- LISTING SUB MENU -->
                          <?php foreach ($getSort as $sort) { ?>
                          <?php 
                            $link_ex_sort   = explode('-', $sort['link']);
                            if(isset($segment_ex[1]) && isset($link_ex_sort[1])){ 
                              $segment_ex_1   = $segment_ex[1];
                              $link_ex_sort_1 = $link_ex_sort[1];
                            }else{
                              $segment_ex_1   = 1;
                              $link_ex_sort_1 = 0;
                            }
                            if($this->uri->segment(1) == $sort['link'] || $segment_ex_1 == $link_ex_sort_1){
                              $active = 'active';
                            }else{
                              $active = '';
                            }
                          ?>
                          <li class="<?php echo $active; ?>">
                            <a href="<?php echo base_url('').$sort['link'];?>">
                              <i class="fa fa-minus"></i><?php echo $sort['menu'];?>
                            </a>
                          </li>
                          <?php } ?>
                        <!-- END LISTING SUB MENU -->
                      </ul>
                    <?php } ?>
                  <!-- END CHECKING SUB MENU -->

                </li>
              <?php } ?>
            <!-- END LISTING MENU -->

          <?php } ?>
        <!-- END LISTING PARENT -->
      </ul>
    </div>
  </section>
</aside>

<div class="content-wrapper">
  <section class="content">