    <!-- begin::Body -->
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
          <i class="la la-close"></i>
        </button>
        <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">
          <!-- BEGIN: Aside Menu -->
  <div 
    id="m_ver_menu" 
    class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark " 
    m-menu-vertical="1"
     m-menu-scrollable="0" m-menu-dropdown-timeout="500"  
    >
            <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

              <li class="m-menu__section ">
                <h4 class="m-menu__section-text">
                  Home
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='ttg'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>dashboard/tentangapp" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Tentang Aplikasi
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='skema'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>dashboard/skemaskm" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-file"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Skema SKM
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <!--
              <li class="m-menu__section ">
                <h4 class="m-menu__section-text">
                  Admin
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='unlay'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Unit Layanan
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='jenlay'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Jenis Layanan
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='kelus'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Kelola User
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__section ">
                <h4 class="m-menu__section-text">
                  Fungsi
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='kues'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Kuesioner
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='survey'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Survey
                      </span>
                    </span>
                  </span>
                </a>
              </li>
              -->

              <li class="m-menu__section ">
                <h4 class="m-menu__section-text">
                  IKM
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='peng'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>ikm/dataikm" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Pengolahan Data IKM
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='pub'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>ikm/publikasiikm" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Publikasi IKM
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__section ">
                <h4 class="m-menu__section-text">
                  Grafik
                </h4>
                <i class="m-menu__section-icon flaticon-more-v3"></i>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='gfjenlay'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>ikm/grafikperjenislayanan" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Per Jenis Layanan
                      </span>
                    </span>
                  </span>
                </a>
              </li>

              <li class="m-menu__item <?=$_SESSION['side']=='gfunlay'?'m-menu__item--active':''?>" aria-haspopup="true" >
                <a  href="<?php echo base_url();?>ikm/grafikperunitlayanan" class="m-menu__link ">
                  <i class="m-menu__link-icon flaticon-line-graph"></i>
                  <span class="m-menu__link-title">
                    <span class="m-menu__link-wrap">
                      <span class="m-menu__link-text">
                        Per Unit Layanan
                      </span>
                    </span>
                  </span>
                </a>
              </li>


            </ul>
          </div>
          <!-- END: Aside Menu -->
        </div>
        <!-- END: Left Aside -->

        <div class="m-grid__item m-grid__item--fluid m-wrapper">

