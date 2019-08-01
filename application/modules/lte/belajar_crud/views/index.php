<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Halaman CRUD</title>
	<link rel="stylesheet" href="">
</head>
<body>
	<a href="<?php echo base_url() ?>belajar_crud/add">Create</a>
	<table border="2">
		<tr>
			<td>ID</td>
			<td>NAMA</td>
			<td>STATUS</td>
			<td>JURUSAN</td>
			<td>ACTION</td>			
		</tr>
		<?php foreach ($content -> result_array() as $key): ?>
		 	<tr>
				<td><?php echo $key['id'] ?></td>
				<td><?php echo $key['nama'] ?></td>
			 	<td><?php echo $key['status'] ?></td>
				<td><?php echo $key['jurusan'] ?></td>
				<td>
					<a href="<?php echo base_url() ?>belajar_crud/update/<?php echo $key['id'] ?>">Edit</a>
					<a href="<?php echo base_url() ?>belajar_crud/delete/<?php echo $key['id'] ?>">Delete</a>
				</td>
			</tr>	
		<?php endforeach ?>
		
	</table>
</body>
</html>