<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="index.html">
            <span class="text">ThemeKit</span>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>
    
    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Navigation</div>
                <div class="nav-item <?= $this->router->fetch_class() == 'home' ? 'active' : '';?>">
                    <a href="/"><i class="ik ik-home"></i><span>Home</span></a>
                </div>
                <div class="nav-lavel">Pages</div>
                <div class="nav-item <?= $this->router->fetch_class() == 'usuarios' ? 'active' : '';?>">
                    <a href="<?=base_url('usuarios');?>"><i class="ik ik-users"></i><span>Usuários</span></a>
                </div>
                <div class="nav-item has-sub open">
                    <a href="#"><i class="ik ik-lock"></i><span>Authentication</span></a>
                    <div class="submenu-content">
                        <a href="<?= base_url('login')?>" class="menu-item">Login</a>
                        <a href="<?= base_url('login/logout')?>" class="menu-item">Sair</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>