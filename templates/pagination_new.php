<!-- Pagination -->

<?php if (!isset($_GET['year'])){?>

<class="pagination">
<a class="pagination" onclick="changePage(1)"> &laquo </a>
<a class="pagination" onclick="<?php if($page > 1){?>changePage(<?php echo ($page-1);}?>)">Prev</a>

<?php for ($i = 0; $i < $total_pages; $i++) {
	if($page<=9) {
	if($i>0 and $i<$page+9 and $i<$total_pages-10) {?><a class="pagination" onclick="changePage(<?php echo ($i)?>)"><?php echo ($i)?></a><?php } 
	}else{
	if($page-9<=$i and $i<$page+9 and $i<$total_pages-10) {?><a class="pagination" onclick="changePage(<?php echo ($i)?>)"><?php echo ($i)?></a><?php } }	

	if($i==$page+10 and $i<$total_pages-10) {?><a class="pagination" title="<?php echo ($page+9)?> - <?php echo ($page+17)?>" onclick="changePage(<?php echo ($page+9)?>)">...</a> <?php } 
	if(($total_pages - 11)<=$i and $i<$total_pages) { ?><a class="pagination" onclick="changePage(<?php echo ($i + 1)?>)"><?php echo ($i + 1)?></a><?php }  
	}?>
	
<a class="pagination" onclick="<?php if($page < $total_pages){?>changePage(<?php echo ($page+1);}?>)">Next</a>
<a class="pagination" onclick="changePage(<?php echo ($total_pages);?>)"> &raquo </a>
		
<script>activePageNumber(<?php echo ($page) ?>)</script>		
		
<?php }else{ ?>

<class="pagination">
<a class="pagination" onclick="changePage(1, <?php echo ($currentYearFilter); ?>)"> &laquo </a>
<a class="pagination" onclick="<?php if($page > 1){?>changePage(<?php echo ($page-1);}?>, <?php echo ($currentYearFilter); ?> )">Prev</a>

<?php for ($i = 0; $i < $total_pages; $i++) {
		
	if($i>0 and $i<$page+5 and $i<$total_pages-5){?>
	<a class="pagination" onclick="changePage(<?php echo ($i);?>, <?php echo ($currentYearFilter); ?>)"><?php echo ($i);}?></a><?php 
	
	if($i==$page+4 and $i < $total_pages - 6 and $total_pages - $page > 2 and $total_pages > 19){?>
	<a class="pagination" title="<?php echo ($page+5)?> - <?php echo ($page+9)?>" onclick="changePage(<?php echo ($page+5)?>, <?php echo ($currentYearFilter); ?>)">...</a> <?php } 
	
	if(($total_pages - 6) <= $i	and $i < $total_pages) { ?>
	<a class="pagination" onclick="changePage(<?php echo ($i+1);?>, <?php echo ($currentYearFilter); ?>)"><?php echo ($i + 1)?></a> <?php } ?>        
<?php }	?>	

<a class="pagination" onclick="<?php if($page < $total_pages){?>changePage(<?php echo ($page+1);}?>, <?php echo ($currentYearFilter); ?>)">Next</a>
<a class="pagination" onclick="changePage(<?php echo ($total_pages);?>, <?php echo ($currentYearFilter); ?>)"> &raquo </a>

<script>activePageNumber(<?php echo ($page) ?>,<?php echo ($currentYearFilter) ?>)</script>		
		
<?php } ?>	

