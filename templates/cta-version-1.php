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
	<div class="pure-u-1 pure-u-md-1-4 pure-u-lg-7-24 pure-u-xl-1-3"></div>
	<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-10-24 pure-u-xl-1-3 bg-center bg-cover" style="background-image: url(<?php echo $a['background']; ?>);">
		<div class="pure-card pure-card--margin-10-3-4">
			<h2 class="pure-text-18 pure-text-accent-color pure-text-uppercase pure-text-bolder">30 minutos</h2>
			<h5 class="pure-text-12 pure-text-bolder pure-text-uppercase">Videncia sin gabinete</h5>
			<h2 class="pure-text-18 pure-text-accent-color pure-text-uppercase pure-text-bolder">Por solo 30€</h2>
			<h5 class="pure-text-12 pure-text-bolder pure-spacer">Particular <span class="pure-text-accent-color">|</span> 98% acierto</h5>
			<div>
				<button class="pure-button pure-button--secondary round" onclick="dataLayer.push({
						'event': 'event',
						'eventCat': 'interaction',
						'eventAct': 'call',
						'eventVersion': 'call-version-<?php echo $a['version']; ?>',
						'eventAvatar': '<?php echo basename($a['avatar']); ?>',
						'eventBackground': '<?php echo basename($a['background']); ?>',
						'eventPhone': '<?php echo $a['phone']; ?>',
						'eventColor': '<?php echo $a['color']; ?>'
					});
					window.location.assign('tel:<?php echo $a['phone']; ?>');
					return false;">
					<?php echo $a['phone']; ?>
				</button>
			</div>
			<p class="pure-center">
				<small class="pure-small">Solo mayores edad. Coste 932: Gratis con tarifa plana, móvil en función de tarifa contratada. + Info en Notas legales.</small>
			</p>
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-1-4 pure-u-lg-7-24 pure-u-xl-1-3"></div>
</div>
