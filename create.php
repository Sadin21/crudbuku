<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (!empty($_POST)) {
    $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
    $keterangan = isset($_POST['keterangan']) ? $_POST['keterangan'] : '';

    $stmt = $pdo->prepare('INSERT INTO buku VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$id, $judul, $penerbit, $tahun, $keterangan]);
    $msg = 'Created Successfully!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Add book</h2>
    <form action="create.php" method="post">
        <label for="id">ID</label>
        <label for="judul">Judul Buku</label>
        <input type="text" name="id" value="auto" id="id">
        <input type="text" name="judul" id="judul">
        <label for="penerbit">Penerbit Buku</label>
        <label for="tahun">Tahun Terbit</label>
        <input type="text" name="penerbit" id="penerbit">
        <input type="text" name="tahun" id="tahun">
        <label for="keterangan">Keterangan</label>
        <input type="text" name="keterangan" id="keterangan">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>