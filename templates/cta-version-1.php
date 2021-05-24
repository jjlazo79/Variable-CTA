<?php

declare(strict_types=1);

/**
 * Template call to action version 1
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
	<div class="pure-u-1 pure-u-md-1-3 mxw-540 bg-center bg-cover" style="background-image: url(<?php echo $a['background']; ?>);">
		<div class="pure-card pure-card--margin-10-3-4">
			<h2 class="pure-text-accent-color pure-text-uppercase pure-text-bolder">30 minutos</h2>
			<p class="pure-text-bolder">Videncia sin gabinete</p>
			<h2 class="pure-text-accent-color pure-text-uppercase pure-text-bolder">Por solo 30€</h2>
			<p class="pure-text-bolder">Particular <span class="pure-text-accent-color">|</span> 98% acierto</p>
			<div>
				<button class="pure-button pure-button--secondary round"><?php echo $a['phone']; ?></button>
			</div>
			<p class="pure-center">
				<small class="pure-small">Solo mayores edad. Coste 932: Gratis con tarifa plana, móvil en función de tarifa contratada. + Info en Notas legales.</small>
			</p>
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-1-3"></div>
</div>
