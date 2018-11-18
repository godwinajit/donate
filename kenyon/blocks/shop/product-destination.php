<?php if (has_term(array('home', 'marine', 'marine-home'), 'pa_destination')) : ?>
<ul class="icons-list align-right">
	<?php if (has_term(array('marine', 'marine-home'), 'pa_destination')) : ?>
    <li class="ico-ship"><span class="tooltip-opener" rel="tooltip" title="This product can be used on a boat">&nbsp; </span></li>
	<?php endif; ?>
	<?php if (has_term(array('home', 'marine-home'), 'pa_destination')) : ?>
    <li class="ico-house"><span class="tooltip-opener" title="This product can be used at home">&nbsp; </span></li>
	<?php endif; ?>
</ul>
<?php endif; ?>