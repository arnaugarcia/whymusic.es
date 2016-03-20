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
        <div class="col-md-6"><a href="<?php echo ROUTER::create_action_url("event/index"); ?>">Ver toda la programación</a></div>
        <table class="table table-hover">
        <?php $concierto = new Concert();
              $login = new ModelLogin(); ?>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Grupo</th>
                    <th>Local</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach ($concierto->getConciertoAll(null,"aceptado") as $row) {
                    echo "<tr>";
                      echo "<td>" .$row['concierto_fecha'] . "</td>";
                      echo "<td>" . $login->getUserDataCampo($row['musico_id'],"usuario_nombre") . "</td>";
                      echo "<td>" . $login->getUserDataCampo($row['local_id'],"usuario_nombre") . "</td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
        </div>

    <!-- Page Content -->
    <div class="container">
        <!-- Sección de los locales -->
        <div class="row">
            <?php
            $local = new Local();
            $local->getLocalAll(6,true);
             ?>
        <div class="row">
        <div class="col-lg-12">
                <h2 class="page-header">Banda</h2>
            </div>
        <?php
            $band = new Band();
            $band->getBandAll(4);
         ?>
        </div>
        <hr>
    </div>
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>