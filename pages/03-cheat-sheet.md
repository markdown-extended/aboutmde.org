data: mde_data
process: phpize

<h2>Markdown Extended syntax cheat sheet</h2>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover tablesorter tablefiltrable">
    <thead>
    <tr>
        <th>Type</th>
        <th>Name</th>
        <th>Sample</th>
        <th>Rendering</th>
    </tr>
    </thead>
    <tbody>

<?php foreach ($page['data']['mde_data'] as $_item) : ?>
    <tr>
        <td rowspan="<?php _echo(count($_item['samples'])); ?>">
        	<?php if ($_item['type'] == 'typo') : ?>
                        <abbr title="Typographic">T</abbr>
        	<?php elseif ($_item['type'] == 'block') : ?>
                        <abbr title="Block">B</abbr>
        	<?php elseif ($_item['type'] == 'misc') : ?>
                        <abbr title="Miscellaneous">M</abbr>
        	<?php endif; ?>
        </td>
        <td id="<?php _echo($_item['name']); ?>" rowspan="<?php _echo(count($_item['samples'])); ?>"><?php _echo($_item['name']); ?></td>
	<?php foreach ($_item['samples'] as $i=>$_sample) : ?>
		<?php if ($i != 0) : ?><tr><?php endif; ?>
        <td><pre><?php _echo(htmlentities($_sample)); ?></pre></td>
        <td><?php _markdownify($_sample); ?></td>
    </tr>
	<?php endforeach; ?>
<?php endforeach; ?>

    </tbody>
</table>
</div>
