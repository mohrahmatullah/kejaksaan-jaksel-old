        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">

          <!-- Branding -->
          <div class="navbar-header col-md-2">
            <a class="navbar-brand" href="<?= base_url() ?>">
              <img src="<?= ASSETS_IMAGE ?>/logo.png" style="height:45px; margin-top:-10px;">
            </a>
            <div class="sidebar-collapse">
              <a href="#">
                <i class="fa fa-bars"></i>
              </a>
            </div>
          </div>
          <!-- Branding end -->

          <!-- .nav-collapse -->
          <div class="navbar-collapse">
            
            <!-- Sidebar -->
            <ul class="nav navbar-nav side-nav" id="navigation">
              <li class="collapsed-content">
                <!-- Collapsed content pasting here at 768px -->
              </li>
              <li class="user-status status-online" id="user-status">
                <div class="profile-photo">
                  <img src="<?= ASSETS_IMAGE ?>user.jpg" alt />
                </div>
                <div class="user">
                  <strong><?= ucwords($this->session->userdata('user_login_nama')) ?></strong>
                  <span class="role"><?= $this->session->userdata('user_login_level') ?></span>
                  <div class="status">
                    <ul>
                      <li class="dropdown change-status">
                        <a class="dropdown-toggle my-status" data-toggle="dropdown" href="#">Online</a>
                      </li>
                    </ul>

                    
                  </div>
                </div>
              </li>
              <li class="dropdown <?= $nav_active == 'home' ? 'active' : '' ?>">
                <a href="<?= base_url()?>" title="Dashboard">
                  <i class="fa fa-dashboard">
                    <span class="overlay-label red"></span>
                  </i> 
                  Dashboard
                </a>
              </li>
              <? if ($this->session->userdata('user_login_level') == 'superadmin'){ ?>
              <li class="dropdown <?= $nav_active == 'master' ? 'active' : '' ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Data Master">
                  <i class="fa fa-list-alt">
                    <span class="overlay-label green"></span>
                  </i>
                  Data Master <b class="fa fa-angle-left dropdown-arrow"></b>
                </a>
                <ul class="dropdown-menu">
                  <? if ($this->session->userdata('user_login_level') == 'superadmin'){ ?>
                  <li>
                    <a href="<?= base_url('pegawai') ?>" title="Pegawai">
                      <i class="fa fa-users"><span class="overlay-label green80"></span></i>
                      Pegawai
                    </a>
                  </li>
                  <? } ?>
                  <li>
                    <a href="<?= base_url('peraturan-jaksa-agung') ?>" title="Peraturan Jaksa Agung">
                      <i class="fa fa-book"><span class="overlay-label green80"></span></i>
                      Peraturan Jaksa Agung
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url('sop') ?>" title="SOP">
                      <i class="fa fa-tasks"><span class="overlay-label green80"></span></i>
                      SOP
                    </a>
                  </li>
                  <li>
                    <a href="<?= base_url('uraian-kerja') ?>" title="Sprint">
                      <i class="fa fa-exchange"><span class="overlay-label green40"></span></i>
                      Sprint
                    </a>
                  </li>
                </ul>
              </li>
              <? } ?>
              <li class="dropdown <?= $nav_active == 'verification' ? 'active' : '' ?>">
                <a href="<?= base_url('verification-file')?>" title="Verifikasi Sprint">
                  <i class="fa fa-file-text-o">
                    <span class="overlay-label cyan"></span>
                  </i> 
                  Verifikasi Sprint 
                </a>
              </li>
              <li class="dropdown <?= $nav_active == 'report' ? 'active' : '' ?>">
                <a href="<?= base_url('report')?>" title="Report Sprint">
                  <i class="fa fa-outdent" aria-hidden="true">
                    <span class="overlay-label cyan"></span>
                  </i> 
                  Report 
                </a>
              </li>
              <? if ($this->session->userdata('user_login_level') == 'superadmin'){ ?>
              <!--  
              <li class="dropdown <?= $nav_active == 'verification-report' ? 'active' : '' ?>">
                <a href="<?= base_url('verification-file-report')?>" title="Verification Report">
                  <i class="fa fa-line-chart">
                    <span class="overlay-label cyan"></span>
                  </i> 
                  Verification Report
                </a>
              </li>
              -->
              <? } ?>
              <li class="dropdown <?= $nav_active == 'setting' ?'active' : '' ?>">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Setting">
                  <i class="fa fa-gear">
                    <span class="overlay-label orange"></span>
                  </i>
                  Setting <b class="fa fa-angle-left dropdown-arrow"></b>
                </a>
                <ul class="dropdown-menu">
									<? if ($this->session->userdata('user_login_level') == 'superadmin'){ ?>
                  <li>
                    <a href="<?= base_url('user') ?>" title="Data User">
                      <i class="fa fa-user"><span class="overlay-label orange60"></span></i>
                      Data Users
                    </a>
                  </li>
									<? } ?>
                  <li>
                    <a href="<?= base_url('change-password') ?>" title="Change Password">
                      <i class="fa fa-lock"><span class="overlay-label orange60"></span></i>
                      Change Password
                    </a>
                  </li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="<?= base_url('logout') ?>" title="Logout">
                  <i class="fa fa-key">
                    <span class="overlay-label amethyst"></span>
                  </i>
                  Logout 
                </a>
              </li>
            </ul>
            <!-- Sidebar end -->

          </div>
          <!--/.nav-collapse -->

        </div>
        <!-- Fixed navbar end -->
        
