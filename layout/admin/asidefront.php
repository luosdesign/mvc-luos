<aside>
<div class="asideTit"><h1 class="right">Categor&iacute;as</h1></div>
<nav>
    <ul>
        <?php if(isset($this->categorias) and !empty($this->categorias)): foreach ($this->categorias as $key => $value) {?>

        <li><a href="#"><?php echo $value["category"]; ?></a></li>
        
        <?php } endif; ?>
    </ul>
</nav>
<div class="asideTit"><h1 class="right">Sponsor</h1></div>
</aside>