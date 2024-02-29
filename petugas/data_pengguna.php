<?php

include "header.php";
include "navbar.php";

?>
	
			
	<div class="card mt-2">
	<div class="card-body">

	<button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#tambah-data">
  			Tambah data 
	</button>
		</div>
				<div class="card-body">
					<?php
							if (isset($_GET['pesan'])) {
								if ($_GET['pesan']=="simpan") { ?>
					<div class="alert alert-success" role="alert">
           Data berhasil di simpan
          </div>

								<?php } ?>
								<?php if ($_GET['pesan']=="update") { ?>
					<div class="alert alert-success" role="alert">
           Data berhasil di perbarui
          </div>
          	<?php } ?>

          	<?php if ($_GET['pesan']=="hapus") { ?>
					<div class="alert alert-success" role="alert">
           Data berhasil di hapus
          </div>
          	<?php } ?>
          	<?php

							}
							?>
					<table class="table">
		<thead>
		
				<th>No</th>
				<th>Nama petugas</th>
				<th>Username</th>
				<th>Akses Petugas</th>
				<th>Aksi</th>
			
		</thead>
			<tbody>
		<?php 
		include '../koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from user");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $d['Nama']; ?></td>
				<td><?php echo $d['username']; ?></td>
				<td>
				
				<?php
					if ($d['level'] == '1') { ?>
						Administrator
					<?php } else { ?>
						Petugas
						<?php } ?>
				</td>
			<td>
			<button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#edit-data<?php echo $d['IDuser']; ?>">
  			Edit
        </button>
        <?php
			if ($d['level'] == $_SESSION['level']) { ?>
			<?php } else { ?>
				<button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapus-data<?php echo $d['IDuser']; ?>">
  			Hapus
        </button>
			<?php } ?>
			
		</td>
		</tr>
		   <!--  modal edit data -->
			<div class="modal fade" id="edit-data<?php echo $d['IDuser']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        	
        </button>
      </div>
      <form action="proses_update_petugas.php" method="post">
      <div class="modal-body">

        <div class="form-group">
        		<label>Nama Petugas</label>
        		<input type="hidden" name="IDuser" value="<?php echo $d['IDuser']; ?>">
        		<input type="text" name="Nama" class="form-control" value="<?php echo $d['Nama']; ?>">

        	</div>
        	<div class="form-group">
        		<label>username</label>
        		<input type="text" name="username" class="form-control" value="<?php echo $d['username']; ?>">
        	</div>
        	<div class="form-group">
        		<label>Password</label>
        		<input type="text" name="password" class="form-control">
        		<small class="text-danger text-sm">*Kosongkan kalau tidak merubah password</small>
        	</div>
        	<div class="form-group">
        		<label>Akses Petugas</label>
        		<select name="level" class="form-control">
        			<option>-- Pilih Akses --</option>
        			<option value="1" <?php if ($d['level'] == '1') { echo "selected";} ?>>Administrator</option>
        			<option value="2" <?php if ($d['level'] == '2') { echo "selected";} ?>>Petugas</option>
        		</select>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Perbarui</button>
      </div>
    </form>
    </div>
  </div>
</div>
<!-- modal hapus data -->
		<div class="modal fade" id="hapus-data<?php echo $d['IDuser']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="proses_hapus_petugas.php" method="post">
      <div class="modal-body">
        <input type="hidden" name="IDuser" value="<?php echo $d['IDuser']; ?>">Apakah anda yakin akan menghapus data? <b>"<?php echo $d['Nama']; ?>"</b>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Hapus</button>
      </div>
    </form>
    </div>
  </div>
</div>
<?php } ?>
		</tbody>
	</table>
					
	</div>
	</div>
	<!-- Modal tambah data -->
<div class="modal fade" id="tambah-data<?php echo $d['IDuser']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah data</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <form method="post" action="proses_simpan_petugas.php">
      <div class="modal-body">
       
        	<div class="form-group">
        		<label>Nama Petugas</label>
        		<input type="text" name="Nama" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>username</label>
        		<input type="text" name="username" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Password</label>
        		<input type="text" name="password" class="form-control">
        	</div>
        	<div class="form-group">
        		<label>Akses Petugas</label>
        		<select name="level" class="form-control">
        			<option>-- Akses Petugas --</option>
        			<option value="1">Administrator</option> 
        			<option value="2">Petugas</option>
        		</select>
        	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-warning">Simpan</button>
      </div>
       </form>
    </div>
  </div>
</div>

<?php

include "footer.php";

?>

			