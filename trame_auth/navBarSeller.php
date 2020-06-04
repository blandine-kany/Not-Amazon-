
<div class="navbar navbar-inverse">
              <div class="navbar-inner">
                <div class="container">
                  <a class="btn btn-navbar collapsed" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </a>
                  <!--<a class="brand" href="#">Title</a>-->
                  <div class="nav-collapse navbar-responsive-collapse collapse" style="height: 0px;">
                    <ul class="nav">
                        <li><a href="home.php">Accueil</a></li>
                        <li><a href="comm.php">Commandes</a></li>
                        <li><a href="vhist.php">Historique des commandes</a></li>
<!--                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li class="nav-header">Nav header</li>
                          <li><a href="#">Separated link</a></li>
                          <li><a href="#">One more separated link</a></li>
                        </ul>
                      </li>-->
                    </ul>
                      <form class="navbar-search pull-left" action="v_search.php?" method="post">
                          <input type="text" class="search-query span2" placeholder="Recherche" name="search">
                    </form>
                    <ul class="nav pull-right">
                      <!--<li><a href="#">Link</a></li>-->
                      <li class="divider-vertical"></li>
                      <!--<li class="dropdown">-->
                      <li><a href="<?= $pathFor['logout'] ?>" title="Logout">Se déconnecter</a></li>
                        <!--<a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>-->
<!--                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                        </ul>
                      </li>-->
                    </ul>
                  </div><!-- /.nav-collapse -->
                </div>
              </div><!-- /navbar-inner -->
</div>