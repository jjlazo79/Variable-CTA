<?php

declare(strict_types=1);

/**
 * Template call to action version 6
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
	<div class="pure-u-1 pure-u-md-1-2 pure-u-lg-10-24 pure-u-xl-1-3">
		<div class="bg-center bg-cover bg-padding" style="background-image: url(<?php echo $a['background']; ?>);">
			<div class="pure-card">
				<h2 class="pure-text-18 pure-text-accent-color pure-text-uppercase pure-text-bolder">Promo especial</h2>
				<h5 class="pure-text-12 pure-text-bolder">10 minutos <span class="pure-text-accent-color">gratis</span> en tu próxima llamada</h5>
				<h2 class="pure-text-18 pure-text-accent-color pure-text-bolder">Llámame</h2>
			</div>
		</div><!-- .bg-cover -->
		<div class="bg-transparent">
			<div class="pure-button-advisory">
				<button class="pure-button pure-button--secondary round" onclick="dataLayer.push({
						'event': 'variableCTAs',
						'eventCat': 'interaction',
						'eventAct': 'call',
						'eventVersion': 'call-version-<?php echo $a['version']; ?>',
						'eventAvatar': '<?php echo $a['avatar']; ?>',
						'eventBackground': '<?php echo $a['background']; ?>',
						'eventPhone': '<?php echo $a['phone']; ?>',
						'eventColor': '<?php echo $a['color']; ?>'
					});
					window.location.assign('tel:<?php echo $a['phone']; ?>');
					return false;">
					<?php echo $a['phone']; ?>
				</button>
				<p class="pure-center">
					<small class="pure-small">Solo mayores edad. Coste 932: Gratis con tarifa plana, móvil en función de tarifa contratada. + Info en Notas legales.</small>
				</p>
			</div>
			<div class="pure-g pure-center">
				<div class="pure-u-1-2 pure-u-sm-2-5 pure-u-md-2-5">
					<img class="pure-img pure-rounded" src="<?php echo $a['avatar']; ?>">
				</div>
				<div class="pure-u-1 pure-u-sm-3-5 pure-u-md-3-5">
					<h5 class="pure-text-12 pure-text-bolder">Soy Conchi Serrano…</h5>
					<ul class="checklist pure-text-left">
						<li>20 años de experiencia</li>
						<li>Atiendo desde casa</li>
						<li>98% de acierto</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="pure-u-1 pure-u-md-1-4 pure-u-lg-7-24 pure-u-xl-1-3"></div>
</div>
