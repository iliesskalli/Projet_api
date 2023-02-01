<div id ='nav'>

</div>

<div class='bandeau'>
    </div>
    <div class="bienvenue">
        <?php
        if(isset($_SESSION['identification'])){
            echo "<a href='?site=MonCompte'><p>Bienvenue</p><p>" . $_SESSION['identification'] . "</p></a>";
        }
        ?>
    </div>
</div>

<nav class="menuPrincipal">
	<?php
	echo $menuPrincipal;
	?>
</nav>

