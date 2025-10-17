<h3>Edit Pembeli</h3>
<form method="post">
  <input type="hidden" name="id" value="<?php echo $pembeli['id_pembeli']; ?>" />
  <div class="mb-3"><label>Nama</label><input required name="nama_pembeli" value="<?php echo $pembeli['nama_pembeli']; ?>" class="form-control" /></div>
  <div class="mb-3"><label>Alamat</label><textarea name="alamat" class="form-control"><?php echo $pembeli['alamat']; ?></textarea></div>
  <button class="btn btn-primary">Update</button>
  <a class="btn btn-secondary" href="index.php?controller=Pembeli">Batal</a>
</form>