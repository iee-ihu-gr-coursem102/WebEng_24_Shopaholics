<!-- Pagination -->

<?php 

if ($total_pages>1){

if (!isset($_GET['yearFilterValue'])){?>

	<class="pagination">
		<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=1"; }?>"> &laquo </a>
	<class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
<?php for ($i = 0; $i < $total_pages; $i++) {?>
	<?php if($pageno <= $i and $i < $pageno + 9 and $i < $total_pages - 10) { ?><a href="<?php echo "?pageno=".($i); ?>"><?php echo ($i )?></a> <?php } ?>
	<?php if($i == $pageno + 10 and $i < $total_pages - 10) { ?><a href="<?php echo "?pageno=".($pageno + 9); ?>">...</a> <?php } ?>
	<?php if(($total_pages - 11) <= $i and $i < $total_pages) { ?><a href="<?php echo "?pageno=".($i + 1); ?>"><?php echo ($i + 1)?></a> <?php } ?>        
<?php }	?>	
    <class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a>
		<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($total_pages);} ?>"> &raquo </a>

<?php }else{ ?>

	<class="pagination">
		<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=1"."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType); }?>"> &laquo </a>
	<class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1)."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType); } ?>">Prev</a>
<?php for ($i = 0; $i < $total_pages; $i++) {?>
	<?php if($pageno <= $i and $i < $pageno + 9 and $i < $total_pages - 10) { ?><a href="<?php echo "?pageno=".($i)."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType); ?>"><?php echo ($i )?></a> <?php } ?>
	<?php if($i == $pageno + 10 and $i < $total_pages - 10) { ?><a href="<?php echo "?pageno=".($pageno + 9)."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType); ?>">...</a> <?php } ?>
	<?php if(($total_pages - 11) <= $i and $i < $total_pages) { ?><a href="<?php echo "?pageno=".($i + 1)."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType); ?>"><?php echo ($i + 1)?></a> <?php } ?>        
<?php }	?>	
    <class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1)."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType); } ?>">Next</a>
		<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($total_pages)."&yearFilterValue=".($currentYearFilter)."&sortingType=".($sortingType);} ?>"> &raquo </a>

<?php 
}
} ?>	