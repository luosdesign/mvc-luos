<?php if(isset($this->_paginacion)): ?>

<?php if($this->_paginacion['primero']): ?>
	
	<a href="<?php echo $link . $this->_paginacion['primero']; ?>.html">Primero</a>
	
<?php else: ?>
	
	<!--Primero-->

<?php endif; ?>

&nbsp;

<?php if($this->_paginacion['anterior']): ?>
	
	<a href="<?php echo $link . $this->_paginacion['anterior']; ?>.html">Anterior</a>
	
<?php else: ?>
	
	<!--Anterior-->

<?php endif; ?>

&nbsp;

<?php for($i = 0; $i < count($this->_paginacion['rango']); $i++): ?>
	
	<?php if($this->_paginacion['actual'] == $this->_paginacion['rango'][$i]): ?>
	
		<?php echo $this->_paginacion['rango'][$i]; ?>
	
	<?php else: ?>
		
		<a href="<?php echo $link . $this->_paginacion['rango'][$i]; ?>.html">
			<?php echo $this->_paginacion['rango'][$i]; ?>
		</a>&nbsp;
	
	<?php endif; ?>
	
<?php endfor; ?>


&nbsp;

<?php if($this->_paginacion['siguiente']): ?>
	
	<a href="<?php echo $link . $this->_paginacion['siguiente']; ?>.html">Siguiente</a>
	
<?php else: ?>
	
	<!--Siguiente-->

<?php endif; ?>

&nbsp;

<?php if($this->_paginacion['ultimo']): ?>
	
	<a href="<?php echo $link . $this->_paginacion['ultimo']; ?>.html">Ultimo</a>
	
<?php else: ?>
	
	<!--Ultimo-->

<?php endif; ?>
	
<?php endif; ?>