<div class="dashboard">
  <h2>List Karyawan</h2>
  <div class="d-flex justify-content-between align-items-center">
    <button id="btn-addKaryawan" type="button" class="mt-3 mb-2 btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addKaryawan">
      Add Karyawan
    </button>
    <form  class="bg-body" role="search">
      <div class="d-flex">
        <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </div>
    </form>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Nik</th>
        <th scope="col">Nama</th>
        <th scope="col">Alamat</th>
        <th scope="col">Action</th>
        <th scope="col">Nilai</th>
      </tr>
    </thead>
    <tbody>
      <?php $i = 1;
      foreach ($model["karyawan"] as $karyawan) : ?>
        <tr>
          <th scope="row"><?= $i + $model["mainPage"] ?></th>
          <td><?= $karyawan["nik"] ?></td>
          <td><?= $karyawan["nama"] ?></td>
          <td><?= $karyawan["alamat"] ?></td>
          <td>
            <a href="" class="delete" value="<?= $karyawan["id"] ?>"><i class="bi bi-trash"></i></a>
            <a href="" class="update" data-bs-toggle="modal" data-bs-target="#addKaryawan" value="<?= $karyawan["id"] ?>"><i class="bi bi-tools"></i></a>
          </td>
          <td>
            <a href="" class="nilai" value="<?= $karyawan["id"] ?>" data-bs-toggle="modal" data-bs-target="#addNilai"><i class="bi bi-clipboard2-pulse-fill"></i></a>
          </td>
        </tr>

      <?php $i++;
      endforeach; ?>
    </tbody>
  </table>
  <nav aria-label="...">
    <ul class="pagination justify-content-center">
      <li class="page-item <?= $model["activePage"] == 1 ? "disabled" : "" ?>">
        <a class="page-link" href="?page=<?= isset($_GET["search"]) ? $model["activePage"] - 1 . "&search=" . $_GET["search"]  : $model["activePage"] - 1 ?>">Previous</a>
      </li>
      <?php for ($i = 1; $i <= $model["totalPage"]; $i++) : ?>
        <li class="page-item <?= $model["activePage"] == $i || !isset($_GET["page"]) && $i == 1 ? "active" : "" ?>"><a class="page-link" href="?page=<?= isset($_GET["search"]) ? $i . "&search=" . $_GET["search"] : $i ?>"><?= $i ?></a></li>
      <?php endfor; ?>
      <li class="page-item <?= $model["activePage"] == $model["totalPage"] ? "disabled" : "" ?>">
        <a class="page-link" href="?page=<?=  isset($_GET["search"]) ? $model["activePage"] + 1 . "&search=" . $_GET["search"]  : $model["activePage"] + 1 ?>">Next</a>
      </li>
    </ul>
  </nav>

</div>


<!-- Modal -->
<div class="modal fade" id="addKaryawan" tabindex="-1" aria-labelledby="karyawan" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="karyawan">Tambah Karyawan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/addKaryawan" class="bg-body" method="POST">
          <div class="mb-3 form-floating">
            <input type="text" inputmode="numeric" class="form-control" name="nik" minlength="16" maxlength="16" id="Nik" placeholder="Masukkan Nik Anda..." required>
            <label for="Nik">Nik</label>
          </div>
          <div class="mb-3 form-floating">
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda..." required>
            <label for="nama">Nama</label>
          </div>
          <div class="mb-3 form-floating">
            <textarea class="form-control" placeholder="Leave a comment here" name="alamat" id="alamat" style="height: 150px; resize:none;" required></textarea>
            <label for="alamat">Alamat</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addNilai" tabindex="-1" aria-labelledby="nilai" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="nilai">Beri Nilai</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/addNilai" class="bg-body" method="POST">
          <div class="mb-3 form-floating">
            <input type="number" class="form-control" name="disiplin" min="0" max="100" id="disiplin" placeholder="Masukkan Nilai Disiplin Karyawan..." required>
            <label for="displin">Disiplin</label>
          </div>
          <div class="mb-3 form-floating">
            <input type="number" min="0" max="100" class="form-control" id="kerapian" name="kerapian" placeholder="Masukkan Nilai Kerapian Karyawan..." required>
            <label for="kerapian">Kerapian</label>
          </div>
          <div class="mb-3 form-floating">
          <input type="number" min="0" max="100" class="form-control" id="kreativitas" name="kreativitas" placeholder="Masukkan Nilai Kreativitas Karyawan..." required>
            <label for="kreativitas">Kreativitas</label>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Nilai</button>
      </div>
      </form>
    </div>
  </div>
</div>