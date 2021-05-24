<?php

declare(strict_types=1);

/**
 * Template call to action version 2
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WordPress
 * @subpackage VariableCTAs
 * @since VariableCTAs 1.0.0
 */

?>
<div id="version-<?php echo $a['version']; ?>" class="version-<?php echo $a['version']; ?> pure-g pure-text-center">
	<div class="pure-u-1 pure-u-md-1-3"></div>
	<div class="pure-u-1 pure-u-md-1-3 mxw-540">
		<div class="bg-center bg-cover bg-padding" style="background-image: url(<?php echo $a['background']; ?>);">
			<div class="pure-card">
				<h2 class="pure-text-accent-color pure-text-uppercase pure-text-bolder">30 minutos</h2>
				<p class="pure-text-bolder">Videncia sin gabinete</p>
				<h2 class="pure-text-accent-color pure-text-uppercase pure-text-bolder">Por solo 30€</h2>
			</div>
		</div><!-- .bg-cover -->
		<div class="bg-transparent">
			<p class="pure-text-bolder">Particular <span class="pure-text-accent-color">|</span> 98% acierto</p>
			<div>
				<button class="pure-button pure-button--secondary round"><?php echo $a['phone']; ?></button>
			</div>
			<p class="pure-center">
				<small class="pure-small">Solo mayores edad. Coste 932: Gratis con tarifa plana, móvil en función de tarifa contratada. + Info en Notas legales.</small>
			</p>
			<div class="pure-g">
				<div class="pure-u-1 pure-u-md-2-5">
					<img class="pure-img pure-rounded" src="<?php echo $a['avatar']; ?>">
				</div>
				<div class="pure-u-1 pure-u-md-3-5">
					<h5 class="pure-text-bolder">Soy Conchi Serrano…</h5>
					<ul class="checklist pure-text-left">
						<li>20 años de experiencia</li>
						<li>Atiendo desde casa</li>
						<li>98% de acierto</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-1-3"></div>
</div>
