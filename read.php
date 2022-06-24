<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$records_per_page = 5;


$stmt = $pdo->prepare('SELECT * FROM buku ORDER BY id LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$daftarbuku = $stmt->fetchAll(PDO::FETCH_ASSOC);


$num_daftarbuku = $pdo->query('SELECT COUNT(*) FROM buku')->fetchColumn();
?>


<?=template_header('Read')?>

<div class="content read">
	<h2>View Book</h2>
	<a href="create.php" class="create-contact">Create Book</a>
	<table>
        <thead>
            <tr>
                <td>#</td>
                <td>Judul Buku</td>
                <td>Penerbit</td>
                <td>Tahun Terbit</td>
                <td>Keterangan</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($daftarbuku as $buku): ?>
            <tr>
                <td><?=$buku['id']?></td>
                <td><?=$buku['judul']?></td>
                <td><?=$buku['penerbit']?></td>
                <td><?=$buku['tahun']?></td>
                <td><?=$buku['keterangan']?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$buku['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$buku['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
	<div class="pagination">
		<?php if ($page > 1): ?>
		<a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
		<?php endif; ?>
		<?php if ($page*$records_per_page < $num_daftarbuku): ?>
		<a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
		<?php endif; ?>
	</div>
</div>

<?=template_footer()?>