<!-- Header Carousel -->
<div class="col-md-8" style="margin-top: 1%; ">
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('http://www.hellfest.fr/wp-content/uploads/2015/10/hellfest-home-annoucement-2016-10.jpg');"></div>
                <div class="carousel-caption">
                    <h2>HellFest</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('https://www.sala-apolo.com/_images/a_homeslide/288/10430_homeslide.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 2</h2>
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('https://www.sala-apolo.com/_images/a_homeslide/288/10430_homeslide.jpg');"></div>
                <div class="carousel-caption">
                    <h2>Caption 3</h2>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
</div>
    <div class="col-md-4 pre-scrollable" style="margin-top: 1%; height: 50%;">
        <div class="col-md-6"><h4>Calendario</h4></div>
        <div class="col-md-6"><a href="">Ver toda la programació</a></div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Concierto</th>
                    <th>Grupo</th>
                    <th>Local</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                <tr>
                  <td>Barcelona Beach Festival</td>
                  <td>Martin Garrix</td>
                  <td>Barcelona</td>
                </tr>
                <tr>
                  <td>Guns And Roses</td>
                  <td>Guns And Roses</td>
                  <td>La Bóveda</td>
                </tr>
                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
                                <tr>
                  <td>Black Festival</td>
                  <td>Iron Maiden</td>
                  <td>Razzmataz</td>
                </tr>
              </tbody>
            </table>
        </div>

    <!-- Page Content -->
    <div class="container">
        <!-- Sección de los locales -->
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Locales</h2>
            </div>
            <?php 
            $local = new Local();
            $local->getLocalAll(6);
             ?>
        <!-- /.row -->

        <!-- Features Section -->
        <div class="row">
        <?php
        $banda = new Banda();
            $reverse = false;
            foreach ($banda->getBanda(null, 4) as $row) {
                if ($reverse == false) {
                $reverse=true;
                echo '<div class="col-lg-12">';
                    echo '<h2 class="page-header">'.$row['usuario_nombre'].'</h2>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<p>'.$row['usuario_nombre'].'</p>';
                    if ($row['usuario_descripcion']=="") {
                        echo '<p>Descripción del grupo aún no insertada</p>';
                    }else{
                        echo '<p>'.$row['usuario_descripcion'].'</p>';
                    }
            echo '</div>';
            echo '<div class="col-md-6">';
                echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="">';
            echo '</div>';
                }else {
                echo '<div class="col-lg-12">';
                    echo '<h2 class="page-header">'.$row['usuario_nombre'].'</h2>';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<img class="img-responsive" src="http://placehold.it/600x250" alt="">';
                    echo '</div>';
                    echo '<div class="col-md-6">';
                    echo '<p>'.$row['usuario_nombre'].'</p>';
                    if ($row['usuario_descripcion']=="") {
                        echo '<p>Descripción del grupo aún no insertada</p>';
                    }else{
                        echo '<p>'.$row['usuario_descripcion'].'</p>';
                    }
            echo '</div>';
            $reverse=false;
                }
            }
         ?>
        </div>
        <!-- /.row -->
        <hr>
    </div>
    <!-- /.container -->

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>