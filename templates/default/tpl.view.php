<div class="view">

<?foreach($results AS $k => $result):?>
<div class="view-item view-item-<?=$k?>">
<?$result->render_in_view()?>
</div>
<?endforeach?>

</div>
