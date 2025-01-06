<!-- Pagination -->

<?php if (!isset($_GET['year'])){?>

	<class="pagination">
		<a class="pagination" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=1"; }?>"> &laquo </a>
	<class="<?php if($page <= 1){ echo 'disabled'; } ?>">
        <a class="pagination" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
<?php for ($i = 0; $i < $total_pages; $i++) {
	if($page<=9) {
	if($i>0 and $i<$page+9 and $i<$total_pages-10) {?><a class="pagination" href="<?php echo "?page=".($i); ?>"><?php echo ($i)?></a><?php } 
	}else{
	if($page-9<=$i and $i<$page+9 and $i<$total_pages-10) {?><a class="pagination" href="<?php echo "?page=".($i); ?>"><?php echo ($i)?></a><?php } }	

	if($i==$page+10 and $i<$total_pages-10) {?><a class="pagination" href="<?php echo "?page=".($page + 9); ?>">...</a> <?php } 
	if(($total_pages - 11)<=$i and $i<$total_pages) { ?><a class="pagination" href="<?php echo "?page=".($i + 1); ?>"><?php echo ($i + 1)?></a><?php } 
	}?>	
    <class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
        <a class="pagination" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
		<a class="pagination" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($total_pages);} ?>"> &raquo </a>
		
<script>activePageNumber(<?php echo ($page) ?>)</script>		
		
<?php }else{ ?>

	<class="pagination">
		<a class="pagination" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=1"."&year=".($currentYearFilter); }?>"> &laquo </a>
	<class="<?php if($page <= 1){ echo 'disabled'; } ?>">
        <a class="pagination" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1)."&year=".($currentYearFilter); } ?>">Prev</a>
		
<?php for ($i = 0; $i < $total_pages; $i++) {
		
	if($i>0 and $i<$page+5 and $i<$total_pages-5){?>
	<a class="pagination" href="<?php echo "?page=".($i)."&year=".($currentYearFilter);?>"><?php echo ($i);}?></a><?php 
	
	if($i==$page+4 and $i < $total_pages - 6 and $total_pages - $page > 2 and $total_pages > 19){?>
	<a class="pagination" href="<?php echo "?page=".($page + 5)."&year=".($currentYearFilter); ?>">...</a> <?php } 
	
	if(($total_pages - 6) <= $i	and $i < $total_pages) { ?>
	<a class="pagination" href="<?php echo "?page=".($i + 1)."&year=".($currentYearFilter); ?>"><?php echo ($i + 1)?></a> <?php } ?>        
<?php }	?>	

    <class="<?php if($page >= $total_pages){ echo 'disabled'; } ?>">
        <a class="pagination" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1)."&year=".($currentYearFilter); } ?>">Next</a>
		<a class="pagination" href="<?php if($page >= $total_pages){ echo '#'; } else { echo "?page=".($total_pages)."&year=".($currentYearFilter);} ?>"> &raquo </a>

<script>activePageNumber(<?php echo ($page) ?>,<?php echo ($currentYearFilter) ?>)</script>		
		
<?php } ?>	

