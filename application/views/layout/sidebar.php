
<div class="app-sidebar colored">
    <div class="sidebar-header" style="background-color: #282828;">
        <a class="header-brand" href="<?=base_url();?>">
            <div class="media"><img src="<?= base_url('public/src/img/brand.png')?>" alt="logo" style="width: 100%; max-width: 38px;"></div>
        </a>
        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>
    
    <div class="sidebar-content" style="background-color: #373737;">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-lavel">Páginas</div>
                <div class="nav-item <?= $this->router->fetch_class() == 'home' ? 'active' : '';?>">
                    <a href="/"><i class="ik ik-home"></i><span>Home</span></a>
                </div>
                <div class="nav-item <?= $this->router->fetch_class() == 'usuarios' ? 'active' : '';?>">
                    <a href="<?=base_url('usuarios');?>"><i class="ik ik-users"></i><span>Usuários</span></a>
                </div>
                <div class="nav-lavel">Outros</div>
                <div class="nav-item <?= $this->router->fetch_class() == 'copas' ? 'active' : '';?>">
                    <a href="<?=base_url('copas');?>"><i class="fas fa-trophy"></i><span>Copas</span></a>
                </div>
                <div class="nav-item <?= $this->router->fetch_class() == 'participantes' ? 'active' : '';?>">
                    <a href="<?=base_url('participantes');?>"><i class="ik ik-users"></i><span>Participantes</span></a>
                </div>
                <div class="nav-item <?= $this->router->fetch_class() == 'times' ? 'active' : '';?>">
                    <a href="<?=base_url('times');?>"><i class="fas fa-futbol"></i><span>Times</span></a>
                </div>
                <div class="nav-item <?= $this->router->fetch_class() == 'classificacao' ? 'active' : '';?>">
                    <a href="<?=base_url('classificacao');?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="color: #bcc8d8;" class="bi bi-table" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm15 2h-4v3h4zm0 4h-4v3h4zm0 4h-4v3h3a1 1 0 0 0 1-1zm-5 3v-3H6v3zm-5 0v-3H1v2a1 1 0 0 0 1 1zm-4-4h4V8H1zm0-4h4V4H1zm5-3v3h4V4zm4 4H6v3h4z"/>
                        </svg>
                        <span class="ml-2">Classificação</span>
                    </a>
                </div>
                <div class="nav-item has-sub">
                    <a href="#"><i class="ik ik-lock"></i><span>Autenticação</span></a>
                    <div class="submenu-content">
                        <a href="<?= base_url('login')?>" class="menu-item">Login</a>
                        <a href="<?= base_url('login/logout')?>" class="menu-item">Sair</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>