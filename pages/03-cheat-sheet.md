data: mde_data
process: phpize

<?php
$cheat_sheet = $about_mde->getCheatSheet();
$cheat_sheet->parseData();
?>

<h1>MDE syntax cheat sheet</h1>

<p class="lead">The table below lists all Markdown Extended syntax rules with examples. You can use the search field to filter table entries, or the selector to reach a specific section.</p>

<div class="alert alert-info dismissable visible-xs"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
<strong>NOTE</strong> - As this table is quite large, you should go to the "landscape" view of your device to view it under optimal conditions.
</div>

<br class="clearfix">
<div class="row">
<div class="col-xs-12 col-sm-6">
<form class="form-horizontal form-nav" role="form" id="filter-field">
<label class="sr-only control-label" for="tableFilter">Filter table entries</label>
<span class="fa fa-search" id="tableFilter-icon-empty"></span>
<a href="#" title="Empty this search field" id="tableFilter-icon-filled"><span class="fa fa-times"></span></a>
<input type="search" name="filter-table" id="tableFilter" class="form-control search-query" placeholder="Filter table values" title="Type a string to filter table entries" tabindex="1" value="<?php if (!empty($search_query)) _echo($search_query); ?>">
<p class="help-block">Presets: <span id="quick-list-container"></span></p>
</form>
</div>
<div class="col-xs-12 col-sm-6">
<select class="form-control" id="gotoSelector">
  <option value="" class="disabled">Go to a section</option>
<?php foreach ($cheat_sheet->getItems() as $_item) : ?>
  <option value="<?php _echo($_item['name']); ?>"><?php _echo($_item['name']); ?></option>
<?php endforeach; ?>
</select>
</div>
</div>
<br class="clearfix">

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover tablefiltrable">
    <thead>
    <tr>
        <th>Type</th>
        <th>Name</th>
        <th>Sample</th>
        <th>Rendering</th>
    </tr>
    </thead>
    <tbody>

<?php foreach ($cheat_sheet->getItems() as $_item) : ?>
    <tr data-rows="<?php _echo(count($_item['samples'])); ?>">
        <td rowspan="<?php _echo(count($_item['samples'])); ?>" data-filter-value="<?php _echo($_item['long_type']); ?>">
        	<?php if ($_item['type'] == 'typo') : ?>
                        <abbr title="Typographic">T</abbr>
        	<?php elseif ($_item['type'] == 'block') : ?>
                        <abbr title="Block">B</abbr>
        	<?php elseif ($_item['type'] == 'misc') : ?>
                        <abbr title="Miscellaneous">M</abbr>
        	<?php endif; ?>
        </td>
        <td id="<?php _echo($_item['name']); ?>" rowspan="<?php _echo(count($_item['samples'])); ?>" data-filter-value="<?php _echo($_item['name']); ?>">
            <?php _echo($_item['name']); ?>
        </td>
	<?php foreach ($_item['samples'] as $i=>$_sample) : ?>
		<?php if ($i != 0) : ?><tr><?php endif; ?>
        <td class="large"><pre><?php _echo(htmlentities($_sample)); ?></pre></td>
        <td class="large"><?php _echo($_item['mde_samples'][$i]); ?></td>
    </tr>
	<?php endforeach; ?>
<?php endforeach; ?>

    </tbody>
</table>
</div>

<?php
$_footnotes = $cheat_sheet->getFootnotes();
if (!empty($_footnotes)) : ?>
<div class="footnotes">
    <ol>
    <?php foreach ($_footnotes as $id=>$note_content) : ?>
        <li id="<?php echo $note_content['note-id']; ?>"><?php echo $note_content['text']; ?></li>
    <?php endforeach; ?>
    </ol>
</div>
<?php endif; ?>


<?php
$_template->getTemplateObject('JavascriptTag')->set(array("

function switchSearchfieldIcon(_el, _noblur){
    var _val = $(_el).val();
    if (_val=='') {
        $('#tableFilter-icon-empty').show();
        $('#tableFilter-icon-filled').hide();
        if (_noblur===undefined || _noblur==false) {
            $(_el).blur();
        }
    } else {
        $('#tableFilter-icon-empty').hide();
        $('#tableFilter-icon-filled').show();
    }
}

$(function() {
    switchSearchfieldIcon($('#tableFilter'));
    $('#tableFilter')
        .bind('keyup', function() {
            switchSearchfieldIcon($(this));
        })
        .bind('focus', function() {
            switchSearchfieldIcon($(this), true);
        })
        ;
    $('#tableFilter-icon-filled').on('click', function(){
        $('#tableFilter').val('');
        switchSearchfieldIcon($('#tableFilter'));
    });
    $('#gotoSelector').bind('change', function(){
        document.location.hash = $(this).val();
    });
    $('.tablefiltrable').filterTable({
        filterContainer: '#filter-field',
        inputName:       'filter-table',
        quickList:      ['typographic', 'block', 'miscellaneous'],
        quickListContainer:'#quick-list-container'
    });
});
"));
?>
