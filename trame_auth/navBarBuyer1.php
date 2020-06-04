
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
                        <!--<li><a href="panier.php">Votre Panier</a></li>-->
                        <li><a href="hist.php">Historique des commandes</a></li>
                    </ul>
                    <form class="navbar-search pull-left" action="search.php?" method="post">
                          <input type="text" class="search-query span2" placeholder="Recherche" name="search">
                    </form>
                    <ul class="nav pull-right">
                      <!--<li><a href="#">Link</a></li>-->
                      <li class="divider-vertical"></li>
                      <li><a href="<?= $pathFor['logout'] ?>" title="Logout">Se déconnecter</a></li>
                    </ul>
                  </div>
                </div>
              </div>
</div>