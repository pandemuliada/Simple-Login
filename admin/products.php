<?php 
  require_once "../init.php";
  
  if ($current_user->id_level != 1) header("Location: " . url('home.php'));

  $DB->connect();
  // Get all products
  $products = $Product->all();

  // Delete product
  if (isset($_GET['delete_code'])) {
    $product_code = $_GET['delete_code'];

    $deleted = $Product->delete($product_code);

    if ($deleted) header("Location:" . url('admin/products.php'));
  }

  // Create new product
  if (isset($_POST['create_product'])) {
    $code = $_POST['code'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $price = $_POST['price'];

    $new_product = [
      'code' => $code,
      'name' => $name,
      'type' => $type,
      'price' => $price,
    ];
    
    $added = $Product->create($new_product);

    if ($added) header("Location:" . url('admin/products.php'));
  }

  // Edit product
  $edited_product = null;
  if (isset($_GET['edit_code'])) {
    $past_code = $_GET['edit_code'];

    $edited_product = $Product->findByCode($past_code) ?? null;

    if (isset($_POST['update_product'])) {
      $code = $_POST['code'];
      $name = $_POST['name'];
      $type = $_POST['type'];
      $price = $_POST['price'];

      $exist_product = [
        'code' => $code,
        'name' => $name,
        'type' => $type,
        'price' => $price,
      ];

      $updated = $Product->update($past_code, $exist_product);

      if ($updated) header("Location:" . url('admin/products.php'));
    }
  }

  // Search product
  // if (isset($_GET['search'])) {
  //   $query = $_GET['search_query'];

  // }
  
  
  // Pagination
  $data = 3; // Jumlah data pada table
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  $start_page = ($page > 1) ? ($page * $data) - $data : 0;
  $results = $Product->all(); 
  $total = count($results);
  $pages = ceil($total / $data);
  $products =  isset($_GET['search_query']) ? $DB->query("SELECT * FROM products WHERE name LIKE '%$_GET[search_query]%'") : $DB->query("SELECT * FROM products LIMIT $start_page, $data");
  $no = $start_page + 1;

  $DB->disconnect();
?>

<?php require_once('../templates/header.php') ?>

  <div class='mb-5 w-64 p-5 border'>
    <form action="" method="POST">
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Kode</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="text" name="code" placeholder="Masukan kode produk"
          value="<?= $edited_product ? $edited_product->code : '' ?>">
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Nama</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="text" name="name" placeholder="Masukan nama produk"
        value="<?= $edited_product ? $edited_product->name : '' ?>">
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Level</label>
        <select name="type" class='rounded border border-gray-400 py-1 px-2 text-gray-600'>
          <option value="">Pilih satuan</option>
          <option value="Pcs" <?= $edited_product && ($edited_product->type == 'Pcs') ? 'selected' : '' ?>>Pcs</option>
          <option value="Lusin" <?= $edited_product && ($edited_product->type == 'Lusin') ? 'selected' : '' ?>>Lusin</option>
          <option value="Kodi" <?= $edited_product && ($edited_product->type == 'Kodi') ? 'selected' : '' ?>>Kodi</option>
        </select>
      </div>
      <div class='flex flex-col mb-2'>
        <label class='text-gray-600 mb-1'>Harga</label>
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="number" name="price" placeholder="Masukan harga produk"
        value="<?= $edited_product ? $edited_product->price : '' ?>">
      </div>
      <div class='flex'>
        <button class='py-2 px-3 bg-blue-500 text-white rounded' type="submit" name="<?= $edited_product ? 'update_product' : 'create_product' ?>"><?= $edited_product ? 'Update' : 'Tambah' ?></button>
        <a href="./products.php" class="ml-2 py-2 px-3 bg-gray-200 text-gray-700 rounded">Clear</a>
      </div>
    </form>
  </div>




  <div class='relative ml-10 w-full'>
    <div class='mb-5'>
      <form action="" method="GET">
        <input class='rounded border border-gray-400 py-1 px-2 text-gray-600' type="text" name='search_query' value="<?= isset($_GET['search_query']) ? $_GET['search_query'] : '' ?>" placeholder="Masukan nama barang">
        <button class='py-1 px-3 bg-blue-500 text-white rounded' type="submit" name='search'>Cari</button>
      </form>
    </div>

    <table>
      <thead>
        <tr>
          <th>Kode Brang</th>
          <th>Nama</th>
          <th>Satuan</th>
          <th>Harga</th>
          <th>Opsi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product) : ?>
          <tr>
            <td><?= $product->code ?></td>
            <td><?= $product->name ?></td>
            <td><?= $product->type ?></td>
            <td>Rp. <?= $product->price ?></td>
            <td>
              <a href="./products.php?delete_code=<?= $product->code ?>">Delete</a>
              <a href="./products.php?edit_code=<?= $product->code ?>">Edit</a>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>

    <?php for ($i=1; $i<=$pages ; $i++) : ?>
      <a href="./products.php?page=<?= $i ?>"><?= $i; ?></a>
    <?php endfor ?>
  </div>
  
<?php require_once('../templates/footer.php') ?>