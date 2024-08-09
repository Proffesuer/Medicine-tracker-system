<div id="topbar" class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php print_link(HOME_PAGE) ?>">
            <img class="img-responsive" src="<?php print_link(SITE_LOGO); ?>" /> <?php echo SITE_NAME ?>
            </a>
            <button type="button" id="sidebarCollapse" class="btn btn-primary">
                <span class="navbar-toggler-icon"></span>
            </button>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse navbar-responsive-collapse">
                <?php Html :: render_menu(Menu :: $navbartopleft  , 'navbar-nav mr-auto' ); ?>
            </div>
        </div>
    </div>
    <nav id="sidebar" class="navbar-dark bg-primary">
        <?php Html :: render_menu(Menu :: $navbarsideleft  , 'nav navbar-nav w-100 flex-column align-self-start'  , "accordion"); ?>
    </nav>
