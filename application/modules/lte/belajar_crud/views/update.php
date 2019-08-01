<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Input Data</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<h2>Edit Data</h2>
	<?php foreach ($content -> result_array() as $key): ?>
	 	<form action="<?php echo base_url(); ?>belajar_crud/action_update/<?php echo $key['id'] ?>" method="post" accept-charset="utf-8">
			<input type="text" name="nama" placeholder="Masukkan Nama" value="<?php echo $key['nama'] ?>"><br>
			<input type="text" name="status" placeholder="Masukkan Status" value="<?php echo $key['status'] ?>"><br>
			<input type="text" name="jurusan" placeholder="Masukkan Jurusan" value="<?php echo $key['jurusan'] ?>"><br><br>
			<input type="submit" value="Save">
		</form>
	<?php endforeach ?>

</body>
</html>